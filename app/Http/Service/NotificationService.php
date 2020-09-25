<?php


namespace App\Http\Service;


use App\Notification;

class NotificationService{

    public function newNotification($notification, $url, $for = 1) {
        $newNotification = new Notification();
        $newNotification->notification = $notification;
        $newNotification->link = $url;
        $newNotification->user_id = $for;
        $newNotification->save();
    }
}
