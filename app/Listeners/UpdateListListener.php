<?php

namespace App\Listeners;

use App\Events\UpdateListEvent;
use App\Models\Lists;
use App\Models\Setting;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class UpdateListListener
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
    public function handle(UpdateListEvent $event): void
    {
        //
        $list = $event->list;
        $user = auth()->user();
        if ($list->code == 'needs' && $user->synchronization == 1 && $event->isUpdate) {
            if ($user->houses) {
                foreach ($user->houses as $row) {
                    foreach ($row->lists as $houseList) {
                        $houseList->update([
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
}
