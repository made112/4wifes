<?php

namespace App\Jobs;

use App\Models\Lists;
use App\Models\User;
use App\Notifications\ListReminderNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

// Import the Cache facade

class SendListReminderDailyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $list;

    public function __construct()
    {
    }

    public function handle()
    {
        $lockKey = 'send_list_reminder_daily_lock';

        // Attempt to acquire a lock for a limited time (e.g., 60 seconds)

            $lists = Lists::with('houses.user')
                ->whereRaw("
                    date(`date`) = (
                        case reminder_day
                            when 'one_day' then ?
                            when 'two_day' then ?
                            when 'three_day' then ?
                        end
                    )
                ", [
                    now()->addDays(1)->format('Y-m-d'),
                    now()->addDays(2)->format('Y-m-d'),
                    now()->addDays(3)->format('Y-m-d')
                ])
                ->get();

            foreach ($lists as $list) {
                $list->houses->user->notify(new ListReminderNotification($list));
            }

    }
}
