<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Mail\OtpMail;
use App\Models\User;
use App\Services\OtpService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Services\DivecTokensService;

class AuthController extends Controller

{
    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => 'false',
                'code' => 400,
                'message' => __('messages.error_code')
            ], 400);
        }
        // Generate a new OTP code and store it
        $newCode = $this->otpService->generateOtp($user);
        $user->otp = $newCode;
        $isSaved = $user->save();

        if ($isSaved) {
            Mail::to($user->email)->send(new OtpMail($newCode)); // Assuming you have an OtpMail class
            return response()->json([
                'message' => __('messages.code_sent'),
                'status' => 'true',
                'code' => 200
            ], 200);

        }
        return response()->json([
            'message' => __('messages.error_code'),
            'status' => 'false',
            'code' => 422
        ], 422);
    }

    public function verifyOtp(VerifyOtpRequest $request, DivecTokensService $divecTokensService)
    {
        $email = $request->input('email');
        $otpCode = $request->input('otp');

        // Call the confirmOtp method from the OtpService
        $isOtpValid = $this->otpService->confirmOtp($email, $otpCode);

        if ($isOtpValid) {
            // OTP code is valid, proceed with token generation
            $user = User::where('email', $email)->first();
            $user->update(['is_phone_verified' => 1]);
            $dataForToken = [
                'fcm_token' => $request->fcm_token,
                'user_id' => $user->id,
                'device_name' => $request->device_name,
            ];
            $user->email_verified_at = Carbon::now();
            $user->is_phone_verified = 1;
            $user->save();
            $divecTokensService->handle($dataForToken);


            if (!$user) {
                return response()->json([
                    'status' => 'false',
                    'code' => 400,
                    'message' => __('messages.error_code')
                ], 400);
            }

            // Create a token for the user
            $token = $user->createToken($request->email, ['*']);

            return response()->json([
                'token' => $token->plainTextToken,
                'object' => $user,
                'code' => 200,
                'status' => 'true',
                'message' => __('messages.login_success')

            ], 200);
        }
        return response()->json([
            'message' => __('messages.code_otp_error'),
            'status' => 'false',
            'code' => 400
        ], 400);

    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        auth()->user()->devices()->each(function ($fcmtoken, $key) {
            $fcmtoken->delete();
        });
        return response()->json([
            'status' => 'true',
            'code' => 200,
            'message' => __('messages.user_logout')
        ], 200);
    }

}
