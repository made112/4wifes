<?php

namespace App\Console\Commands;
use Kreait\Firebase\Factory;
use Illuminate\Console\Command;
use App\Models\Notification;


class SendFirebaseNotifications extends Command
{
    protected $signature = 'notifications:send-firebase';
    protected $description = 'Send notifications to Firebase Cloud Messaging';

    public function handle()
    {
        $firebase = (new Factory)
            ->withServiceAccount(__DIR__.'/path-to-your-firebase-service-account-file.json')
            ->create();

        $notifications = Notification::all();

        foreach ($notifications as $notification) {
            $message = [
                'notification' => [
                    'title' => $notification->title,
                    'body' => $notification->body,
                ],
                // Other FCM options as needed
            ];

            // Send the notification to FCM
            $firebase->getMessaging()->sendToTopic('users', $message);

            // Delete the stored notification
            $notification->delete();
        }

        $this->info('Notifications sent to Firebase.');
    }
}
