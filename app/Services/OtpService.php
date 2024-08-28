<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class OtpService
{

    protected $otpStorage = [];

    public function generateOtp($user)
    {
        $otpCode = rand(1000, 9999);
        $this->otpStorage[$user->email] = $otpCode;
        $user->otp = $otpCode;
        // Save user details
        $isSaved = $user->save();
        return $otpCode;
    }

    public function confirmOtp($email, $otpCode)
    {
        // Retrieve the stored OTP code from the database
        $otp_user = User::where('email', $email)->first();
        if ($otp_user->otp === $otpCode) {
            return true;
        }

        return false;
    }

}
