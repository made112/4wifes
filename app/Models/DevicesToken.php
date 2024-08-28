<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DevicesToken extends Model
{
    use Notifiable;

    protected $table = 'devices_tokens';

    protected $fillable = ['fcm_token', 'user_id', 'device_name'];


}
