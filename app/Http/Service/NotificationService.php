<?php


namespace App\Http\Service;


use App\Notification;

class NotificationService{

    public function newNotification($notification, $url, $for = 1) {
        $notification = new Notification();
        $notification->notification = $notification;
        $notification->link = $url;
        $notification->user_id = $for;
        $notification->save();
    }
}
