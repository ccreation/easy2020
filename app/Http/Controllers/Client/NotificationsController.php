<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Notification;
use App\Website;

class NotificationsController extends ClientBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $client_id = @$this->client->id;
        $notifications = Notification::with("website")->where("client_id", $client_id)->orderby("created_at", "desc")->get();
        foreach ($notifications as $notification){
            if($notification->status == 0){
                $notification->status = 1;
                $notification->save();
            }
        }

        return view("client.notifications.index", compact("notifications"));
    }

}
