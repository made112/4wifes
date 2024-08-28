<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Lists extends Model
{
    use Notifiable;

    use HasFactory;
    protected $table = 'lists';
    protected $fillable = ['title','description','date','parent_id ','reminder_day','reminder_hour','house_id','code','save_status_weakly','status'];
    protected $hidden = ['parent_id','created_at','updated_at'];
    protected $casts = [
        'house_id'=>'int',
        'save_status_weakly'=>'int'

    ];


    public function houses()
    {
        return $this->belongsTo(House::class,'house_id');
    }
    protected static function booted()
    {
        static::addGlobalScope('user', function(Builder $builder) {
            if ($id = Auth::guard('sanctum')->id()) {
                $builder->whereExists(function ($builder) use ($id) {
                    $builder->select(DB::raw('1'))
                        ->from('houses')
                        ->whereColumn('houses.id', '=', 'lists.house_id')
                        ->where('houses.user_id', '=', $id);
                });
            }
        });
    }


    public function scopeFilterColumn(Builder $builder, $filters)
    {
        // this scope filters requests by (house_id, color, code, date (d-m-Y), list_id)
        $builder->when($filters['house_id'] ?? null, function ($builder, $value) {
            $builder->where('house_id', $value);
        });

        $builder->when($filters['code'] ?? null, function ($builder, $value) {
            $builder->where('code', $value);
        });

        $builder->when($filters['date_from'] ?? null, function ($builder, $value) {
            $date = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
            $builder->whereDate('date', '>=', $date);
        });

        $builder->when($filters['date_to'] ?? null, function ($builder, $value) {
            $date = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
            $builder->whereDate('date', '<=', $date);
        });
    }

//    public function deleteList($list)
//    {
//        $user = auth()->user();
//        if ($list->code == 'needs') {
//            // Load the houses along with their lists
//            $user->load('houses.lists');
//            foreach ($user->houses as $house) {
//                // Delete all lists associated with this house
//                $house->lists()->where('code', 'needs')->delete();
//            }
//        }
//        // Delete the original list
//        $list->delete();
//    }




}
