<?php

namespace App\Services;

use App\Models\DevicesToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class DivecTokensService
{
    public function handle($data)
    {
        try {
            $oldFcm = DevicesToken::where('fcm_token', $data['fcm_token'])->first();
            if (!$oldFcm) {
                DevicesToken::create([
                    'fcm_token' => $data['fcm_token'],
                    'user_id' => $data['user_id'],
                    'device_name' => $data['device_name'],
                ]);
            }
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
