<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserSettingRequest;
use App\Models\House;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function user()
    {
        $user = User::where('id', auth()->user()->id)->firstOrFail();
        return response()->json([
            'status' => 'true',
            'code' => 200,
            'object' => $user
        ]);


    }


    public function updateUserInfo(UserRequest $request)
    {
        $user = auth()->user();
        if ($user) {
            if ($request->hasFile('image')) {
                $file = $request->image;
                $newImagePath = $file->store('uploads/', 'public');
                $user->image = $newImagePath;
            }

            // Update other user attributes based on the request (excluding 'image')
            $user->update($request->except('image')); // Update all other fields except 'image'

            // Get the full path to the saved image


            return response()->json([
                'status' => 'true',
                'object' => $user,
                'code' => 200,
                'message' => __('messages.user_update_info')
            ]);
        }
        return response()->json([
            'status' => 'false',
            'code' => 200,
            'message' => __('messages.error_code')
        ]);
    }

    public function deleteAccount()
    {
        $user = Auth::user();

        if ($user) {

            // Delete the user account
            auth()->user()->tokens->each(function ($token, $key) {
                $token->delete();
            });

            $user->delete();


            // Redirect or return a response
            return response()->json([
                'status' => 'true',
                'code' => 200,
                'message' => __('messages.user_delete')
            ]);
        }

        // Handle the case where the user is not authenticated
        return response()->json([
            'status' => 'false',
            'code' => 402,
            'message' => __('messages.user_auth')

        ]);
    }
    public function updateStatus(Request $request)
    {
        $user = Auth::user();

        $user->update([
            'synchronization'=>$request->value
        ]);

        return response()->json([
            'status' => 'true',
            'code' => 200,
            'message' => __('messages.update_setting')
        ]);

    }



}
