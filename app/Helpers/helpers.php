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

if (!function_exists('submeta')) {
    function submeta($meta, $page, $lang)
    {
        if($meta->type=="url"):
            $client_id  = $page->client_id;
            $client     = App\Client::where("id", $client_id)->first();
            $blocks     = App\PageBlock::where(["page_id" => $page->id, "client_id" => $client_id])->orderby("order", "desc")->get();
            $pages      = App\Page::where("client_id", $client_id)->orderby("id", "desc")->get();
        endif;
        /*$website    = App\Website::where("id", $page->website_id)->orderby("id", "desc")->first();
        $default_font = @$website->font;*/
        ?>
        <div class="custom_collapse" id="collapse<?=$meta->id;?>">
            <div class="card card-body" style="background: #f5f5f5">
                <button type="button" class="close" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div>
                    <!-- text or textarea -->
                    <?php if($meta->type=="text" or $meta->type=="textarea"): ?>
                        <?php if(count($meta->metas)>0): ?>
                            <?php foreach($meta->metas as $mtaa): ?>
                                <div class="input-group">
                                    <label class="w100 db"><?=__("l.".$mtaa->type); ?></label>
                                    <?php if($mtaa->type=="color"): ?>
                                        <input type="text" name="<?=$meta->id;?>-submeta-<?=$mtaa->key;?>" value="<?=$mtaa->value?>" class="form-control colorpicker mb-10">
                                    <?php elseif($mtaa->type=="font_size"): ?>
                                        <select name="<?=$meta->id;?>-submeta-<?=$mtaa->key;?>" class="form-control mb-10">
                                            <?php for($i=8; $i<=100; $i++): ?>
                                                <option value="<?=$i;?>" <?= ($mtaa->value==$i)?"selected":""; ?>><?=$i;?></option>
                                            <?php endfor; ?>
                                        </select>
                                    <?php elseif($mtaa->type=="font_weight"): ?>
                                        <select class="form-control mb-10" name="<?=$meta->id;?>-submeta-<?=$mtaa->key;?>">
                                            <option value="normal" <?= ($mtaa->value=="normal")?"selected":""; ?>><?=__("l.normal");?></option>
                                            <option value="bold" <?= ($mtaa->value=="bold")?"selected":""; ?>><?=__("l.bold");?></option>
                                        </select>
                                    <?php elseif($mtaa->type=="text_align"): ?>
                                        <select class="form-control mb-10" name="<?=$meta->id;?>-submeta-<?=$mtaa->key;?>">
                                            <option value="right" <?= ($mtaa->value=="right")?"selected":""; ?>><?=__("l.right");?></option>
                                            <option value="center" <?= ($mtaa->value=="center")?"selected":""; ?>><?=__("l.center");?></option>
                                            <option value="left" <?= ($mtaa->value=="left")?"selected":""; ?>><?=__("l.left");?></option>
                                            <option value="justify" <?= ($mtaa->value=="justify")?"selected":""; ?>><?=__("l.justify");?></option>
                                        </select>
                                    <?php elseif($mtaa->type=="font_family"): ?>
                                        <select class="form-control mb-10" name="<?=$meta->id;?>-submeta-<?=$mtaa->key;?>">
                                            <option value="" <?= ($mtaa->value == "")?"selected":""; ?>><?= __("l.no_font");?></option>
                                            <option value="Droid Arabic Kufi" <?= ($mtaa->value=="Droid Arabic Kufi")?"selected":""; ?>>Droid Arabic Kufi</option>
                                            <option value="Amiri" <?= ($mtaa->value=="Amiri")?"selected":""; ?>>Amiri</option>
                                            <option value="Cairo" <?= ($mtaa->value=="Cairo")?"selected":""; ?>>Cairo</option>
                                            <option value="Tajawal" <?= ($mtaa->value=="Tajawal")?"selected":""; ?>>Tajawal</option>
                                            <option value="Changa" <?= ($mtaa->value=="Changa")?"selected":""; ?>>Changa</option>
                                            <option value="Lalezar" <?= ($mtaa->value=="Lalezar")?"selected":""; ?>>Lalezar</option>
                                            <option value="El Messiri" <?= ($mtaa->value=="El Messiri")?"selected":""; ?>>El Messiri</option>
                                            <option value="Reem Kufi" <?= ($mtaa->value=="Reem Kufi")?"selected":""; ?>>Reem Kufi</option>
                                            <option value="Lateef" <?= ($mtaa->value=="Lateef")?"selected":""; ?>>Lateef</option>
                                            <option value="Scheherazade" <?= ($mtaa->value=="Scheherazade")?"selected":""; ?>>Scheherazade</option>
                                            <option value="Lemonada" <?= ($mtaa->value=="Lemonada")?"selected":""; ?>>Lemonada</option>
                                            <option value="Markazi Text" <?= ($mtaa->value=="Markazi Text")?"selected":""; ?>>Markazi Text</option>
                                            <option value="Mada" <?= ($mtaa->value=="Mada")?"selected":""; ?>>Mada</option>
                                            <option value="Baloo Bhaijaan" <?= ($mtaa->value=="Baloo Bhaijaan")?"selected":""; ?>>Baloo Bhaijaan</option>
                                            <option value="Mirza" <?= ($mtaa->value=="Mirza")?"selected":""; ?>>Mirza</option>
                                            <option value="Aref Ruqaa" <?= ($mtaa->value=="Aref Ruqaa")?"selected":""; ?>>Aref Ruqaa</option>
                                            <option value="Harmattan" <?= ($mtaa->value=="Harmattan")?"selected":""; ?>>Harmattan</option>
                                            <option value="Katibeh" <?= ($mtaa->value=="Katibeh")?"selected":""; ?>>Katibeh</option>
                                            <option value="Rakkas" <?= ($mtaa->value=="Rakkas")?"selected":""; ?>>Rakkas</option>
                                            <option value="Jomhuria" <?= ($mtaa->value=="Jomhuria")?"selected":""; ?>>Jomhuria</option>
                                        </select>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php elseif($meta->type=="url"): ?>
                        <div class="form-group">
                            <label><?=__("l.url_to_block_from_this_page");?></label>
                            <select class="form-control choose_button_link">
                                <option value=""><?=__("l.choose");?></option>
                                <?php foreach ($blocks as $b): ?>
                                    <option value="<?=$b->id;?>"
                                            data-url="#block<?=$b->id;?>"><?=__("l.a.".$b->type)." ".$b->block;?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label><?=__("l.url_to_other_pages");?></label>
                            <select class="form-control choose_button_link">
                                <option value=""><?=__("l.choose");?></option>
                                <?php foreach ($pages as $p): ?>
                                    <option value="<?=$p->id;?>"
                                            data-url="<?=route("website.page", ["slug" => @$page->website->slug, "frontLang" => $lang, "id" => $page->id]);?>"><?=(app()->getLocale()=="ar")?$p->name:$p->name_en;?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }
}

if (!function_exists('submeta2')) {
    function submeta2($text)
    {
        ?>
        <div class="custom_collapse" id="collapse<?=$text->id?>">
            <div class="card card-body" style="background: #f5f5f5">
                <button type="button" class="close" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div>
                    <div class="form-group">
                        <label class="w100 db"><?=__("l.font_size"); ?></label>
                        <select name="font_size<?=$text->id;?>" class="form-control mb-10">
                            <?php for($i=8; $i<=100; $i++): ?>
                                <option value="<?=$i;?>" <?= ($text->font_size==$i)?"selected":""; ?>><?=$i;?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="w100 db"><?=__("l.font_weight"); ?></label>
                        <select name="font_weight<?=$text->id;?>" class="form-control mb-10">
                            <option value="normal" <?= ($text->font_weight=="normal")?"selected":""; ?>><?=__("l.normal");?></option>
                            <option value="bold" <?= ($text->font_weight=="bold")?"selected":""; ?>><?=__("l.bold");?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="w100 db"><?=__("l.color"); ?></label>
                        <input type="text" name="color<?=$text->id;?>" value="<?=$text->color?>" class="form-control colorpicker mb-10">
                    </div>
                    <div class="form-group">
                        <label class="w100 db"><?=__("l.text_align"); ?></label>
                        <select name="text_align<?=$text->id;?>" class="form-control mb-10">
                            <option value="right" <?= ($text->text_align=="right")?"selected":""; ?>><?=__("l.right");?></option>
                            <option value="center" <?= ($text->text_align=="center")?"selected":""; ?>><?=__("l.center");?></option>
                            <option value="left" <?= ($text->text_align=="left")?"selected":""; ?>><?=__("l.left");?></option>
                            <option value="justify" <?= ($text->text_align=="justify")?"selected":""; ?>><?=__("l.justify");?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="w100 db"><?=__("l.font_family"); ?></label>
                        <select name="font_family<?=$text->id;?>" class="form-control mb-10">
                            <option value="" <?= ($text->font_family=="")?"selected":""; ?>><?= __("l.default_font");?></option>
                            <option value="Droid Arabic Kufi" <?= ($text->font_family=="Droid Arabic Kufi")?"selected":""; ?>>Droid Arabic Kufi</option>
                            <option value="Amiri" <?= ($text->font_family=="Amiri")?"selected":""; ?>>Amiri</option>
                            <option value="Cairo" <?= ($text->font_family=="Cairo")?"selected":""; ?>>Cairo</option>
                            <option value="Tajawal" <?= ($text->font_family=="Tajawal")?"selected":""; ?>>Tajawal</option>
                            <option value="Changa" <?= ($text->font_family=="Changa")?"selected":""; ?>>Changa</option>
                            <option value="Lalezar" <?= ($text->font_family=="Lalezar")?"selected":""; ?>>Lalezar</option>
                            <option value="El Messiri" <?= ($text->font_family=="El Messiri")?"selected":""; ?>>El Messiri</option>
                            <option value="Reem Kufi" <?= ($text->font_family=="Reem Kufi")?"selected":""; ?>>Reem Kufi</option>
                            <option value="Lateef" <?= ($text->font_family=="Lateef")?"selected":""; ?>>Lateef</option>
                            <option value="Scheherazade" <?= ($text->font_family=="Scheherazade")?"selected":""; ?>>Scheherazade</option>
                            <option value="Lemonada" <?= ($text->font_family=="Lemonada")?"selected":""; ?>>Lemonada</option>
                            <option value="Markazi Text" <?= ($text->font_family=="Markazi Text")?"selected":""; ?>>Markazi Text</option>
                            <option value="Mada" <?= ($text->font_family=="Mada")?"selected":""; ?>>Mada</option>
                            <option value="Baloo Bhaijaan" <?= ($text->font_family=="Baloo Bhaijaan")?"selected":""; ?>>Baloo Bhaijaan</option>
                            <option value="Mirza" <?= ($text->font_family=="Mirza")?"selected":""; ?>>Mirza</option>
                            <option value="Aref Ruqaa" <?= ($text->font_family=="Aref Ruqaa")?"selected":""; ?>>Aref Ruqaa</option>
                            <option value="Harmattan" <?= ($text->font_family=="Harmattan")?"selected":""; ?>>Harmattan</option>
                            <option value="Katibeh" <?= ($text->font_family=="Katibeh")?"selected":""; ?>>Katibeh</option>
                            <option value="Rakkas" <?= ($text->font_family=="Rakkas")?"selected":""; ?>>Rakkas</option>
                            <option value="Jomhuria" <?= ($text->font_family=="Jomhuria")?"selected":""; ?>>Jomhuria</option>
                        </select>
                    </div>

                </div>
            </div>
        </div>
        <?php
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

if (!function_exists('submetax')) {
    function submetax($meta)
    {
        ?>
        <div class="custom_collapse" id="collapse<?=$meta->name;?>">
            <div class="card card-body" style="background: #f5f5f5">
                <button type="button" class="close" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div>
                    <?php if($meta->submetas): ?>
                        <?php foreach($meta->submetas->children() as $mtaa): ?>
                            <div class="input-group">
                                <label class="w100 db"><?=__("l.".$mtaa->name); ?></label>
                                <?php if($mtaa->type=="color"): ?>
                                    <input type="text" name="<?=$meta->name;?>-submeta-<?=$mtaa->name;?>" value="<?=$mtaa->value?>" class="form-control colorpicker mb-10">
                                <?php elseif($mtaa->type=="font_size"): ?>
                                    <select name="<?=$meta->name;?>-submeta-<?=$mtaa->name;?>" class="form-control mb-10">
                                        <?php for($i=8; $i<=100; $i++): ?>
                                            <option value="<?=$i;?>" <?= ($mtaa->value==$i)?"selected":""; ?>><?=$i;?></option>
                                        <?php endfor; ?>
                                    </select>
                                <?php elseif($mtaa->type=="font_weight"): ?>
                                    <select class="form-control mb-10" name="<?=$meta->name;?>-submeta-<?=$mtaa->name;?>">
                                        <option value="normal" <?= ($mtaa->value=="normal")?"selected":""; ?>><?=__("l.normal");?></option>
                                        <option value="bold" <?= ($mtaa->value=="bold")?"selected":""; ?>><?=__("l.bold");?></option>
                                    </select>
                                <?php elseif($mtaa->type=="text_align"): ?>
                                    <select class="form-control mb-10" name="<?=$meta->name;?>-submeta-<?=$mtaa->name;?>">
                                        <option value="right" <?= ($mtaa->value=="right")?"selected":""; ?>><?=__("l.right");?></option>
                                        <option value="center" <?= ($mtaa->value=="center")?"selected":""; ?>><?=__("l.center");?></option>
                                        <option value="left" <?= ($mtaa->value=="left")?"selected":""; ?>><?=__("l.left");?></option>
                                        <option value="justify" <?= ($mtaa->value=="justify")?"selected":""; ?>><?=__("l.justify");?></option>
                                    </select>
                                <?php elseif($mtaa->type=="font_family"): ?>
                                    <select class="form-control mb-10" name="<?=$meta->name;?>-submeta-<?=$mtaa->name;?>">
                                        <option value="" <?= ($mtaa->value=="")?"selected":""; ?>><?= __("l.default_font");?></option>
                                        <option value="Droid Arabic Kufi" <?= ($mtaa->value=="Droid Arabic Kufi")?"selected":""; ?>>Droid Arabic Kufi</option>
                                        <option value="Amiri" <?= ($mtaa->value=="Amiri")?"selected":""; ?>>Amiri</option>
                                        <option value="Cairo" <?= ($mtaa->value=="Cairo")?"selected":""; ?>>Cairo</option>
                                        <option value="Tajawal" <?= ($mtaa->value=="Tajawal")?"selected":""; ?>>Tajawal</option>
                                        <option value="Changa" <?= ($mtaa->value=="Changa")?"selected":""; ?>>Changa</option>
                                        <option value="Lalezar" <?= ($mtaa->value=="Lalezar")?"selected":""; ?>>Lalezar</option>
                                        <option value="El Messiri" <?= ($mtaa->value=="El Messiri")?"selected":""; ?>>El Messiri</option>
                                        <option value="Reem Kufi" <?= ($mtaa->value=="Reem Kufi")?"selected":""; ?>>Reem Kufi</option>
                                        <option value="Lateef" <?= ($mtaa->value=="Lateef")?"selected":""; ?>>Lateef</option>
                                        <option value="Scheherazade" <?= ($mtaa->value=="Scheherazade")?"selected":""; ?>>Scheherazade</option>
                                        <option value="Lemonada" <?= ($mtaa->value=="Lemonada")?"selected":""; ?>>Lemonada</option>
                                        <option value="Markazi Text" <?= ($mtaa->value=="Markazi Text")?"selected":""; ?>>Markazi Text</option>
                                        <option value="Mada" <?= ($mtaa->value=="Mada")?"selected":""; ?>>Mada</option>
                                        <option value="Baloo Bhaijaan" <?= ($mtaa->value=="Baloo Bhaijaan")?"selected":""; ?>>Baloo Bhaijaan</option>
                                        <option value="Mirza" <?= ($mtaa->value=="Mirza")?"selected":""; ?>>Mirza</option>
                                        <option value="Aref Ruqaa" <?= ($mtaa->value=="Aref Ruqaa")?"selected":""; ?>>Aref Ruqaa</option>
                                        <option value="Harmattan" <?= ($mtaa->value=="Harmattan")?"selected":""; ?>>Harmattan</option>
                                        <option value="Katibeh" <?= ($mtaa->value=="Katibeh")?"selected":""; ?>>Katibeh</option>
                                        <option value="Rakkas" <?= ($mtaa->value=="Rakkas")?"selected":""; ?>>Rakkas</option>
                                        <option value="Jomhuria" <?= ($mtaa->value=="Jomhuria")?"selected":""; ?>>Jomhuria</option>
                                    </select>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
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
