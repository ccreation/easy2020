<?php

namespace App\Http\Controllers\Client;

use App\ClientSetting;
use Illuminate\Http\Request;
use App\Message;
use App\Newsletter;
use Auth;
use App\Exports\FormDataExport;
use Excel;

class MessagesController extends ClientBaseController
{
    protected $handle = null;
    protected $delimiter = ',';
    protected $enclosure = '"';
    protected $escape = '\\';

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        if(!cpermissions("visitor_messages_list"))
            return redirect()->route("client.settings.no_permissions");

        $client     = $this->client;
        $messages   = Message::with("website")->where("client_id", $client->id)->orderby("created_at", "desc")->get();

        return view("client.messages.index", compact("messages"));
    }

    public function preview($id = null){
        if(!cpermissions("visitor_messages_preview"))
            return redirect()->route("client.settings.no_permissions");

        $client     = $this->client;
        $message    = Message::with("website")->where("client_id", $client->id)->where("id", $id)->first();
        if(!$message)
            return back();

        return view("client.messages.preview", compact("message"));
    }

    public function delete($id){
        if(!cpermissions("visitor_messages_delete"))
            return redirect()->route("client.settings.no_permissions");

        $client     = $this->client;
        $message    = Message::with("website")->where("client_id", $client->id)->where("id", $id)->first();
        if(!$message)
            return back();

        $message->delete();
        return back()->with("success", __("l.success_delete"));
    }

    public function newsletter_index(){
        if(!cpermissions("newsletter_list_list"))
            return redirect()->route("client.settings.no_permissions");

        $client         = $this->client;
        $newsletters    = Newsletter::with("website")->where("client_id", $client->id)->orderby("created_at", "desc")->get();
        $settings       = ClientSetting::where("client_id", $client->id)->get()->keyby("key");

        $number_phone_newsletter_subscribers = Newsletter::whereNotNull("phone")->count();
        $number_email_newsletter_subscribers = Newsletter::whereNotNull("email")->count();

        return view("client.messages.newsletters", compact("newsletters", "number_email_newsletter_subscribers", "number_phone_newsletter_subscribers", "settings"));
    }

    protected function s_save($k, $v){
        $client_id          = @$this->client->id;
        $setting            = ClientSetting::where("client_id", $client_id)->where("key", $k)->first();
        if(!$setting){
            $setting        = new ClientSetting;
            $setting->client_id = $client_id;
            $setting->key   = $k;
        }
        $setting->value     = $v;
        $setting->save();
    }

    public function newsletter_export_excel(){
        if(!cpermissions("newsletter_list_list"))
            return redirect()->route("client.settings.no_permissions");

        $client         = $this->client;
        $newsletters    = Newsletter::with("website")->where("client_id", $client->id)->orderby("created_at", "desc")->get();
        if(count($newsletters) <= 0)
            return back();

        $user = Auth::guard("client")->user();
        $this->s_save("newsletter_export_excel_date", date("Y-m-d"));
        $this->s_save("newsletter_export_excel_time", date("H:i:s"));
        $this->s_save("newsletter_export_excel_number", count($newsletters));
        $this->s_save("newsletter_export_excel_nuser", $user->name);

        $data           = [["#", __("l.website"), __("l.name"), __("l.email"), __("l.phone"), __("l.date")]];
        $i              = 1;
        foreach ($newsletters as $newsletter){
            $x          = [
                            $i++,
                            @$newsletter->website->{"name_".app()->getLocale()},
                            $newsletter->name." ",
                            $newsletter->email,
                            $newsletter->phone." ",
                            $newsletter->created_at->format("Y-m-d h:s:i"),
                        ];
            array_push($data, $x);
        }

        return Excel::download(new FormDataExport($data), 'Newsletter.xlsx');
    }

}
