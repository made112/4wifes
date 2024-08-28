<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key' , 'label' , 'value' , 'group'];
    public function user()
    {
        return $this->belongsTo(Setting::class, 'user_id');
    }
}