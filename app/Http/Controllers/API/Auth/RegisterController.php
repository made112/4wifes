<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllersService;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\DevicesToken;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Services\OtpService;
use App\Mail\OtpMail; // Make sure you have this mail class
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    protected $otpService;

    //
    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function register(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->post('name');
        $user->email = $request->email;
        $fcmToken = $request->input('fcm_token');


        $newCode = $this->otpService->generateOtp($user);
        if ($request->hasFile('image')) {
            $file = $request->image;
            $user->image = $file->store('uploads/', 'public');
        }
        $user->save();
        event(new Registered($user));

        if ($user->save()) {
            Mail::to($user->email)->send(new OtpMail($newCode)); // Assuming you have an OtpMail class

            return response()->json([
                'status'=>'true',
                'code'=>'201',
                'message' =>  __('messages.code_sent'),

            ], 201);
        }
        return response()->json([
            'status' => 'false',
            'code' => 400,
            'message' =>  __('messages.error_code')
        ], 400);

    }
}
