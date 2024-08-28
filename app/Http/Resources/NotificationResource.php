<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $notificationData = json_decode($this->data, true);
        $date = Carbon::parse($notificationData['date']);
        $daysRemaining = $date->diffInDays(Carbon::now());
        $formattedDaysRemaining = "باقي " . $daysRemaining . " يوم";
        return [
            'title' => $notificationData['title'],
            'body' => $notificationData['body'],
            'house' => $notificationData['house'],
            'date' => $date->format('d-m-Y'),
            'days_remaining' => $formattedDaysRemaining,
        ];
    }


}
