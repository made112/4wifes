<?php

namespace App\Notifications;

use App\Models\Lists;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;


class ListReminderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $list;

    public function __construct(Lists $list)
    {
        $this->list = $list;
    }

    public function via(object $notifiable): array
    {
        return ['database', FcmChannel::class];
    }

    public function toFcm($notifiable): FcmMessage
    {

        return FcmMessage::create()
            ->setData([ 'icon_url' => asset('assets/logo.png'), 'data2' => 'value2'])
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle($this->list->title)
                ->setBody('(' . ($this->list->houses ? $this->list->houses->name : 'N/A') . ') ' . $this->list->description)
                ->setImage('http://example.com/url-to-image-here.png'))
            ->setAndroid(
                AndroidConfig::create()
                    ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
                    ->setNotification(AndroidNotification::create()->setColor('#0A0A0A'))
            )->setApns(
                ApnsConfig::create()
                    ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios')));
    }
    public function toDatabase($notifiable)
    {

        // Store the notification in the database
       return [
           'title' => $this->list->title,
           'body' =>$this->list->description,
           'date' =>$this->list->date,
           'house'=>$this->list->houses?$this->list->houses->name:''

       ];

    }


    public function fcmProject($notifiable, $message)
    {
        // $message is what is returned by `toFcm`
        return 'app'; // name of the firebase project to use
    }
}
