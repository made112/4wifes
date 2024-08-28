<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'otp',
        'is_phone_verified',
        'phone',
        'house_count',
        'divisor_type',
        'image',
        'start_house_id',
        'synchronization'


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp',
        'created_at',
        'updated_at',
        'deleted_at',
        "email_verified_at",
        "is_phone_verified",
        'image',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'house_count' => 'int'
    ];
    protected $appends = ['image_url'];

    public function houses()
    {
        return $this->hasMany(House::class);
    }


    public function lists()
    {
        return $this->hasManyThrough(Lists::class, House::class);
    }

    public function devices()
    {
        return $this->hasMany(DevicesToken::class , 'user_id' , 'id');
    }
    public function routeNotificationForFcm()
    {
        return $this->devices()->pluck('fcm_token')->toArray();
    }
    public function getImageUrlAttribute(){
        return $this->image !==null ? asset('storage/'.$this->image):null;

    }



}
