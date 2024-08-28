<?php

namespace App\Jobs;

use App\Models\Lists;
use App\Notifications\ListReminderNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendListReminderHourlyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $lists = Lists::with('houses.user')
            ->whereDate('date', '=', now())
            ->whereRaw("
            time(`date`) = (
                case reminder_hour
                    when 'one_hour' then ?
                    when 'two_hour' then ?
                    when 'three_hour' then ?
                end
            )
        ", [
                now()->addHours(1)->setSecond(0)->format('H:i:s'),
                now()->addHours(2)->setSecond(0)->format('H:i:s'),
                now()->addHours(3)->setSecond(0)->format('H:i:s'),
            ])
            ->lazy();

        foreach ($lists as $list) {
            $list->house->user->notify(new ListReminderNotification($list));
        }
    }
}
