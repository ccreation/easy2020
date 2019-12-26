<?php

namespace App;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use App\Website;
use App\Client;
use App\ClientSetting;

class Visitor extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', "client_id", "website_id", "status"
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function website(){
        return $this->BelongsTo("App\Website", "website_id");
    }

    public function client(){
        return $this->BelongsTo("App\Client", "client_id");
    }

    public function sendPasswordResetNotification($token)
    {
        $v = Visitor::find($this->id);
        init($this->client_id);
        $client_id = $this->client_id;
        $this->notify(new CustomPasswordVisitor($token, $v, $client_id));
    }

    public function sendEmailVerificationNotification()
    {
        init($this->client_id);
        $client_id = $this->client_id;
        $this->notify(new CustomVerifyEmail(request("frontLang"), $this->id, $client_id));
    }

}

class CustomPasswordVisitor extends ResetPassword{

    private $visitor = null;
    private $client_id = null;

    public function __construct(string $token, $v, $client_id){
        parent::__construct($token);
        $this->visitor = $v;
        $this->client_id = $client_id;
    }

    public function toMail($notifiable){
        $website    = Website::find($this->visitor->website_id);
        if(!$website)
            return;

        $slug       = $website->slug;
        $lang       = $website->default_lang;

        $client = Client::find($this->client_id);  
        $settings = ClientSetting::where("client_id", $client->id)->get()->keyBy("key");

        if(@$settings["reset_password_html"])
            $body = @$settings["reset_password_html"]->value;
        else
            $body = "نحن نرسل هذه الرسالة الإلكترونية لأننا تلقينا طلبًا بنسيان كلمة المرور.";

        $mail       = new MailMessage();
        $mail->subject('إستعادة كلمة المرور')
        ->markdown('emails.password', ["body" => $body, "url" => url(route('website.password.reset', ["slug" => $slug, "frontLang" => $lang,  "token" => $this->token]))]);

        return $mail;
            
    }
}

class CustomVerifyEmail extends Notification{


    private $frontLang = null;
    public $id;
    private $client_id = null;

    public function __construct($frontLang, $id, $client_id){
        $this->frontLang = $frontLang;
        $this->id = $id;
        $this->client_id = $client_id;
    }

    public function toMail($notifiable)
    {
        $rand = rand(9999,9999999999);
        $visitor = Visitor::find($this->id);
        $visitor->remember_token = $rand;
        $visitor->save();
        $verificationUrl = route("visitor.verification.verify", ["frontLang" => $this->frontLang, "token" => $rand]);
        
        $client = Client::find($this->client_id);  
        $settings = ClientSetting::where("client_id", $client->id)->get()->keyBy("key");

        if(@$settings["activation_html"])
            $body = @$settings["activation_html"]->value;
        else
            $body = "قبل المتابعة ، يرجى التحقق من بريدك الإلكتروني لمعرفة رابط التحقق.";

        $mail       = new MailMessage();
        
        $mail->subject('تفعيل الحساب')
        ->markdown('emails.reset', ["body" => $body, "url" => $verificationUrl]);

        return $mail;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

}
