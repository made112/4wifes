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

class SendListReminderWeaklyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $list;

    public function __construct()
    {
    }

    public function handle()
    {

        $lists = Lists::where('code','needs')->with('houses.user')
            ->where('save_status_weakly', true) // Fetch lists with save_status_weekly set to true
            ->whereDate('date', '>', now()->addWeek()) // Filter lists with a date greater than one week from now
            ->get();

        foreach ($lists as $list) {
            $list->houses->user->notify(new ListReminderNotification($list));
        }
    }
}
