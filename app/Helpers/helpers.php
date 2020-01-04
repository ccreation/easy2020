<?php

use App\Mail\TestMail;
use App\Setting;
use Illuminate\Support\Facades\Auth as Auth;
use App\Archive;
use App\User;
use App\Notif;
use App\Client;
use App\Notification;
use App\ClientSetting;
use App\Website;
use App\Page;

if (!function_exists('permissions')) {
    function permissions($permission)
    {
        if (Auth::guard("web")->user()->role_id == 1)
            return true;
        $permissions = unserialize(Auth::guard("web")->user()->role->permissions);
        $permissions = is_array($permissions) ? $permissions : [];
        return in_array($permission, $permissions);
    }
}

if (!function_exists('getExcerpt')) {
    function getExcerpt($text, $textb=200){
        $text = strip_tags($text);
        if (strlen($text) > $textb) {
            $text = substr($text, 0, $textb);
            $text = substr($text, 0, strrpos($text, " "));
            $text = $text . '...';
        }
        return $text;
    }
}

function init($client_id = null)
{

    Config::set('mail.encryption', "tls");
    Config::set('mail.driver', "smtp");
    Config::set('app.name', "منصة سهل");
    Config::set('mail.from.name', 'منصة سهل');
    Config::set('mail.from.address', "s@alsalo.me");
    Config::set('mail.host', "smtp.gmail.com");
    Config::set('mail.port', "587");
    Config::set('mail.username', "issam.web.technologie@gmail.com");
    Config::set('mail.password', "helloBabyx123");

    if(!$client_id){
        $client = Auth::guard("client")->user();
    } else{
        $client = Client::find($client_id);
    }

    if(!$client)
        return;

    $settings = ClientSetting::where("client_id", $client->id)->get()->keyBy("key");

    if(@$settings["email_sent_from_address"]){

        $email_sent_from_address = @$settings["email_sent_from_address"]->value;
        $email_sent_from_name = @$settings["email_sent_from_name"]->value;
        $email_smtp_host = @$settings["email_smtp_host"]->value;
        $email_smtp_user = @$settings["email_smtp_user"]->value;
        $email_smtp_password = @$settings["email_smtp_password"]->value;
        $email_smtp_port = @$settings["email_smtp_port"]->value;

        Config::set('app.name', $email_sent_from_name);
        Config::set('mail.from.name', '"' . $email_sent_from_name . '"');
        Config::set('mail.from.address', $email_sent_from_address);

        if ($email_smtp_host and $email_smtp_user and $email_smtp_password and $email_smtp_port) {
            Config::set('mail.host', $email_smtp_host);
            Config::set('mail.port', $email_smtp_port);
            Config::set('mail.username', $email_smtp_user);
            Config::set('mail.password', $email_smtp_password);
        }
    }

}

if (!function_exists('mailit')) {
    function mailit($to, $subject, $body, $attachment = null, $from=null){
        try {
            init();
            $x = Mail::to($to)->sendNow(new TestMail($subject, $body, $attachment, $from));
        } catch (\Exception $e) {
            //dd($e->getMessage());
            //dd(config("mail"));
        }
    }
}

if (!function_exists('cpermissions')) {
    function cpermissions($permission)
    {
        if (Auth::guard("client")->user()->role_id == 0)
            return true;
        $permissions = unserialize(Auth::guard("client")->user()->role->permissions);
        $permissions = is_array($permissions) ? $permissions : [];
        return in_array($permission, $permissions);
    }
}

if (!function_exists('notification')) {
    function notification($type, $client_id, $website_id = null, $message = null){
        $notification = new Notification;
        $notification->type = $type;
        $notification->client_id = $client_id;
        $notification->website_id = $website_id;
        $notification->message = $message;
        $notification->status = 0;
        $notification->save();
    }
}

function init_admin(){

    Config::set('mail.encryption', "tls");
    Config::set('mail.driver', "smtp");
    Config::set('yamamah.sender', "1click");
    Config::set('yamamah.username', "966502480256");
    Config::set('yamamah.password', "Aa@0502480256");

    $settings       = Setting::all()->keyby("key");

    if(@$settings["email_sent_from_address"]){

        $email_sent_from_address = @$settings["email_sent_from_address"]->value;
        $email_sent_from_name = @$settings["email_sent_from_name"]->value;
        $email_smtp_host = @$settings["email_smtp_host"]->value;
        $email_smtp_user = @$settings["email_smtp_user"]->value;
        $email_smtp_password = @$settings["email_smtp_password"]->value;
        $email_smtp_port = @$settings["email_smtp_port"]->value;

        Config::set('app.name', $email_sent_from_name);
        Config::set('mail.from.name', '"' . $email_sent_from_name . '"');
        Config::set('mail.from.address', $email_sent_from_address);

        if ($email_smtp_host and $email_smtp_user and $email_smtp_password and $email_smtp_port) {
            Config::set('mail.host', $email_smtp_host);
            Config::set('mail.port', $email_smtp_port);
            Config::set('mail.username', $email_smtp_user);
            Config::set('mail.password', $email_smtp_password);
        }
    }

    if(@$settings["yamamah_sender"]){

        $yamamah_sender = @$settings["yamamah_sender"]->value;
        $yamamah_username = @$settings["yamamah_username"]->value;
        $yamamah_password = @$settings["yamamah_password"]->value;

        if ($yamamah_sender and $yamamah_username and $yamamah_password) {
            Config::set('yamamah.sender', $yamamah_sender);
            Config::set('yamamah.username', $yamamah_username);
            Config::set('yamamah.password', $yamamah_password);
        }
    }

}

if (!function_exists('mailit_admin')) {
    function mailit_admin($to, $subject, $body, $attachment = null, $from=null){
        try {
            init_admin();
            Mail::to($to)->sendNow(new TestMail($subject, $body, $attachment, $from));
        } catch (\Exception $e) {
            //dd($e->getMessage());
            //dd(config("mail"));
        }
    }
}

if (!function_exists('sms_yamamah')) {
    function sms_yamamah($receiver, $message)
    {
        try {
            init_admin();
            $receiver = str_replace(" ", "", $receiver);
            $receiver = str_replace("-‎", "", $receiver);
            $receiver = str_replace("(‎", "", $receiver);
            $receiver = str_replace(")‎", "", $receiver);
            $receiver = convert($receiver);

            if (0 === strpos($receiver, '00') or 0 === strpos($receiver, '+'))
                $receiver = $receiver;
            else
                $receiver = "00966" . substr($receiver, -9);

            $login = config("yamamah.username");
            $pass = config("yamamah.password");
            $sender = urlencode(config("yamamah.sender"));
            $data = array(
                'Username' => $login,
                'Password' => $pass,
                'Tagname' => $sender,
                'RecepientNumber' => str_replace('+', '00', $receiver),
                'Message' => $message,
                'SendDateTime' => 0,
                'EnableDR' => true
            );
            $data_string = json_encode($data, JSON_UNESCAPED_UNICODE);
            $ch = curl_init('http://api.yamamah.com/SendSMS');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json; charset=utf-8',
                    'Content-Length: ' . strlen($data_string))
            );

            $result = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($result);
            return (@$response->Status) ? @$response->Status : 0;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}

if (!function_exists('convert')) {
    function convert($string)
    {
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
        $num = range(9, 0);
        $englishNumbersOnly = str_replace($arabic, $num, $string);
        return $englishNumbersOnly;
    }
}

if (!function_exists('image_popup')) {
    function image_popup($client_id){
        $ch     = curl_init(route("image_api"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data   = curl_exec($ch);
        curl_close($ch);
        $data   = json_decode($data);
        $dir_path = base_path("storage/app/uploads/clients/".$client_id);
        $dirs = new \DirectoryIterator($dir_path);
        $my_images = [];
        foreach ($dirs as $dir) {
            if(!$dir->isDir() and !$dir->isDot()){
                $name = $dir->getBasename();
                if(@is_array(getimagesize($dir_path."/".$name))){
                    $image = new \stdClass();
                    $image->url = asset("storage/app/uploads/clients/".$client_id."/".$name);
                    $image->name_ar = $image->name_en = "";
                    array_push($my_images, $image);
                }
            }
        }
        return view("common.pages.images_api.image_popup", compact("data", "my_images"));
    }
}

if(!function_exists("parseVideo")){
    function parseVideo($url = null){
        preg_match('/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/', $url, $m );
        if (strpos(@$m[3], 'youtu') !== false)
            return ["type" => "youtube", "id" => @$m[6]];
        if (strpos(@$m[3], 'vimeo') !== false)
            return ["type" => "vimeo", "id" => @$m[6]];
        else
            return ["type" => "video", "id" => $url];
    }
}

if(!function_exists("createVideo")){
    function createVideo($url = null, $width = null, $height = null, $style = "background: #000"){
        if($url){
            $obj = parseVideo($url);
            $iframe = "";
            if (@$obj["type"] == 'youtube'){
                $urll = "https://www.youtube.com/embed/" . @$obj["id"];
                $iframe = "<iframe src='$urll' width='$width' height='$height' frameborder='0' style='$style'></iframe>";
            } elseif(@$obj["type"] == 'vimeo'){
                $urll = "https://player.vimeo.com/video/" . @$obj["id"];
                $iframe = "<iframe src='$urll' width='$width' height='$height' frameborder='0' style='$style'></iframe>";
            } else{
                $urll = @$obj["id"];
                $iframe = "<video preload='none' width='$width' height='$height' frameborder='0' style='$style' controls><source src='$urll'></video>";
            }
            return $iframe;
        }
    }
}

if (!function_exists('video_popup')) {
    function video_popup($client_id){
        $ch     = curl_init(route("video_api"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data   = curl_exec($ch);
        curl_close($ch);
        $data   = json_decode($data);
        $dir_path = base_path("storage/app/uploads/clients/".$client_id);
        $dirs = new \DirectoryIterator($dir_path);
        $my_videos = [];
        foreach ($dirs as $dir) {
            if(!$dir->isDir() and !$dir->isDot()){
                $name = $dir->getBasename();
                $x = explode(".",$name);
                if(strtolower(end($x)) =="mp4"){
                    $video = new \stdClass();
                    $video->url = asset("storage/app/uploads/clients/".$client_id."/".$name);
                    $video->name_ar = $video->name_en = $name;
                    array_push($my_videos, $video);
                }
            }
        }
        return view("common.pages.videos_api.video_popup", compact("data", "my_videos"));
    }
}

if (!function_exists('create_homepage')) {
    function create_homepage($website_id, $client_id, $user_id){

        $page               = new Page;
        $page->client_id    = $client_id;
        $page->user_id      = $user_id;
        $page->name         = "الرئيسية";
        $page->name_en      = "Homepage";
        $page->status       = 1;
        $page->website_id   = $website_id;
        $page->slug         = create_slug_helper($client_id);
        $page->save();

        if(@$page->website){
            $page->website->homepage = $page->id;
            $page->website->save();
        }
    }
}

if (!function_exists('create_slug_helper')) {
    function create_slug_helper($client_id, $id=null, $name = null){
        if($name)
            $slug0  = str_replace(" ", "_", trim($name));
        else
            $slug0  = rand(11111, 99999);
        $slug       = $slug0;
        $search     = true;
        $repeated   = 1;
        while($search){
            if($id)
                $pagex = Page::where("id", "!=", $id)->where("client_id", $client_id)->where("slug", $slug)->first();
            else
                $pagex = Page::where("client_id", $client_id)->where("slug", $slug)->first();
            if(!$pagex){
                $search = false;
            }else{
                $slug = $slug0."(".$repeated.")";
                $repeated ++;
            }
        }
        return $slug;
    }
}
