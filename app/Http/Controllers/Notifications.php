<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NotificationsModel;

class Notifications extends Controller
{
    public function restockNotifications(){
        $notification = new NotificationsModel();

        return json_encode($notification->getNotifications());
    }
}
