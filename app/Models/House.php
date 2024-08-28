<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class House extends Model
{
    use HasFactory;

    protected $fillable = ['name','address','image','arrange','user_id','color'];

    protected $hidden = ['user_id','created_at','updated_at','deleted_at','image'];
    protected $appends = ['image_url'];
    protected static function booted()
    {
        static::addGlobalScope('user', function(Builder $builder) {
            if ($id = Auth::guard('sanctum')->id()) {
                $builder->where('user_id', '=', $id);
            }
        });



        static::created(function ($house) {
            // Update the house_count for the related user
            $user = $house->user;
            if ($user) {
                $user->increment('house_count');
            }
        });
        static::deleting(function ($house) {
            // Update the house_count for the related user
            $user = $house->user;
            if ($user) {
                $user->decrement('house_count');
            }
        });


    }
    protected $casts = [
        'arrange'=>'int'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lists()
    {
        return $this->hasMany(Lists::class,'house_id');
    }
    public function getImageUrlAttribute(){
        return $this->image !==null ? asset('storage/'.$this->image):null;

    }





}
