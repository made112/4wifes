<?php

namespace App\Listeners;

use App\Events\ListCreated;
use App\Models\Lists;
use App\Models\Setting;
use Database\Seeders\SettingSeeder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckActivationStatusListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //

    }

    /**
     * Handle the event.
     */
    public function handle(ListCreated $event)
    {
        $list = $event->list;
        $user = auth()->user();

        if ($list->code == 'needs' && $user->synchronization == 1) {
            if($user->houses){
                foreach ($user->houses->where('id', '!=', $list->house_id) as $row) {
                    Lists::create([
                        'title' => $list->title,
                        'description' => $list->description,
                        'save_status_weakly' => $list->save_status_weakly,
                        'code' => $list->code,
                        'house_id' => $row->id,
                        'date' => $list->date,
                        'time' => $list->time,
                        'reminder_day' => $list->reminder_day,
                        'reminder_hour' => $list->reminder_hour
                    ]);

                }
            }


        }

    }
}
