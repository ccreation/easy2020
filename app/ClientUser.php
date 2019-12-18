<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use App\Client;

class ClientUser extends Authenticatable
{
    use Notifiable;

    public function client()
    {
        return $this->belongsTo("App\Client", "client_id");
    }

    /*public function sendPasswordResetNotification($token)
    {
        $c = Client::find($this->id);
        $this->notify(new CustomPassword($token, $c));
    }

    public function role(){
        return $this->belongsTo("App\ClientRole", "role_id");
    }*/
}

/*
class CustomPassword extends ResetPassword{

    private $client = null;

    public function __construct(string $token, $c){
        parent::__construct($token);
        $this->client = $c;
    }

    public function toMail($notifiable){
        return (new MailMessage)
            ->subject('إستعادة كلمة المرور')
            ->line('نحن نرسل هذه الرسالة الإلكترونية لأننا تلقينا طلبًا بنسيان كلمة المرور.')
            ->action('إعادة ضبط كلمة المرور', url(route('client.password.reset') . "/" . $this->token))
            ->line('إذا لم تطلب إعادة تعيين كلمة المرور ، فلا يلزم اتخاذ أي إجراء آخر. يرجى الاتصال بنا إذا لم ترسل هذا الطلب.');
    }
}
*/
