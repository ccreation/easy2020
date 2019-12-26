<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Plugin;
use App\Client;
use App\Form;
use App\FormField;
use App\FormData;
use App\ClientSetting;
use App\Website;
use App\Newsletter;
use App\PluginData;
use App\Exports\FormDataExport;
use Excel;

class PluginsController extends ClientBaseController
{

    protected $handle = null;
    protected $delimiter = ',';
    protected $enclosure = '"';
    protected $escape = '\\';

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        if(!cpermissions("plugins_list"))
            return redirect()->route("client.settings.no_permissions");

        $client = $this->client;
        $c = Client::find($client->id);
        $plugins = Plugin::orderby("created_at", "desc")->get();
        $maplugins = $c->plugins;

        foreach ($plugins as $plugin) {
            foreach ($maplugins as $p) {
                if ($plugin->id == @$p->pivot->plugin_id) {
                    $plugin->status = @$p->pivot->status;
                }
            }
        }

        return view("client.plugins.index", compact("plugins", "maplugins"));
    }

    public function settings($id = null){
        if(!cpermissions("plugins_list"))
            return redirect()->route("client.settings.no_permissions");

        if(!cpermissions("plugins_settings_".$id))
            return redirect()->route("client.settings.no_permissions");

        $client         = $this->client;
        if (!@$this->my_plugins[$id])
            return back();

        $plugin         = @$this->my_plugins[$id];
        $forms          = collect();
        if($id==2){
            $forms      = Form::withCount(["data"=>function ($req) use($client) {return $req->where("client_id", $client->id);}])
            ->with(["fields"=>function ($req) use($client) {return $req->where("client_id", $client->id)->orderby("order", "asc");}])->where("client_id", $client->id)->get();
        }

        $settings       = ClientSetting::where("client_id", @$this->client->id)->get()->keyBy("key");
        $websites       = Website::where("client_id", @$this->client->id)->get();

        $mailchimp_lists =[];
        $newsletter_count = 0;
        if($id == 6){
            $newsletter_count = Newsletter::count();
            if(@$settings["enable_mailchimp"]->value==1)
                if(@$settings["mailchimp_api_key"] and @$settings["mailchimp_api_key"]->value!=""){
                    $api_key = $settings["mailchimp_api_key"]->value;
                    try{
                        $url = explode("-", $api_key)[1];
                        $ch = curl_init('https://'.$url.'.api.mailchimp.com/3.0/lists');
                        curl_setopt_array($ch, array(
                            CURLOPT_RETURNTRANSFER => TRUE,
                            CURLOPT_HTTPHEADER => array(
                                'Authorization: apikey '.$api_key,
                                'Content-Type: application/json'
                            )
                        ));
                        $response = json_decode(curl_exec($ch));
                        if(count($response->lists)>0){
                            foreach ($response->lists as $list){
                                array_push($mailchimp_lists, ["id" => $list->id, "name" => $list->name]);
                            }
                        }
                    }catch (\Exception $e){}
                }
        }

        $plugin_datas = PluginData::with("website")->where(["client_id" => $client->id, "plugin_id" => $id])->get();

        return view("client.plugins.settings_" . $id, compact("plugin", "forms", "settings", "websites", "mailchimp_lists", "newsletter_count", "plugin_datas"));
    }

    public function save_plugin_data(Request $request){
        $plugin_data                = new PluginData;
        $plugin_data->plugin_id     = $request->plugin_id;
        $plugin_data->client_id     = $request->client_id;
        $plugin_data->website_id    = $request->website_id;
        $plugin_data->code          = $request->code;
        $plugin_data->status        = 1;
        $plugin_data->save();

        return back()->with("success", __("l.success_save"));
    }

    public function update_plugin_data(Request $request){
        $client             = $this->client;
        $plugin_data        = PluginData::where(["client_id" => $client->id, "id" => $request->id])->first();
        if(!$plugin_data)
            return back();

        $plugin_data->status = $request->status;
        $plugin_data->website_id = $request->website_id;
        $plugin_data->code = $request->code;
        $plugin_data->save();

        return back()->with("success", __("l.success_update"));
    }

    public function delete_plugin_data($id = null){
        $client             = $this->client;
        $plugin_data        = PluginData::where(["client_id" => $client->id, "id" => $id])->first();
        if(!$plugin_data)
            return back();

        $plugin_data->delete();

        return back()->with("success", __("l.success_delete"));
    }

    public function save_app(Request $request){
        if(!cpermissions("plugins_list"))
            return redirect()->route("client.settings.no_permissions");

        $client                     = $this->client;

        $form                       = new Form;
        $form->client_id            = $client->id;
        $form->name                 = $request->name;
        $form->save();

        $i=0;
        foreach ($request->names as $name){
            $formField              = new FormField;
            $formField->client_id   = $client->id;
            $formField->form_id     = $form->id;
            $formField->name        = $name;
            $formField->order       = $i+1;
            $formField->placeholder = @$request->placeholders[$i];
            $formField->type        = @$request->types[$i];
            $formField->space       = @$request->space[$i];
            $formField->required    = (@$request->requireds[$i])?1:0;
            $formField->options     = (@$request->{'option'.$i})?implode(";", @$request->{'option'.$i}):null;
            $formField->save();
            $i++;
        }

        return redirect()->route("client.plugins.settings", 2)->with("success", __("l.success_save"));
    }

    public function remove_app($id = null)
    {
        $client = $this->client;
        $form   = Form::where(["client_id" => $client->id, "id" => $id])->first();
        if(!$form)
            return back();

        FormField::where(["client_id" => $client->id, "form_id" => $id])->delete();
        $form->delete();

        return redirect()->route("client.plugins.settings", 2)->with("success", __("l.success_delete"));
    }

    public function show_app_field ($id=null){
        $client     = $this->client;
        if (!@$this->my_plugins[2])
            return back();

        $plugin     = @$this->my_plugins[2];
        $form       = Form::with(["fields"=>function ($req) use($client) {return $req->where("client_id", $client->id)->orderby("order", "asc");}])->where("client_id", $client->id)->where("id", $id)->first();
        if (!@$form)
            return back();

        return view("client.plugins.show_app_field", compact("form", "plugin"));
    }

    public function edit_app ($id=null){
        $client     = $this->client;
        if (!@$this->my_plugins[2])
            return back();

        $plugin     = @$this->my_plugins[2];
        $form       = Form::with(["fields"=>function ($req) use($client) {return $req->where("client_id", $client->id)->orderby("order", "asc");}])
            ->where("client_id", $client->id)->where("id", $id)->first();
        if (!@$form)
            return back();

        return view("client.plugins.edit_app", compact("form", "plugin"));
    }

    public function update_app(Request $request){
        $client             = $this->client;
        $form               = Form::where("client_id", $client->id)->where("id", $request->id)->first();
        if(!$form)
            return back();

        $form->name         = $request->name;
        $form->form         = $request->form;
        $form->placeholder  = $request->placeholder;
        $form->save();

        return back()->with("success", __("l.success_update"));
    }

    public function save_app_field(Request $request){
        $client                 = $this->client;
        $formField              = ($request->field_id==0)? new FormField() : FormField::where("id", $request->field_id)->where("client_id", $client->id)->first();
        if(!$formField)
            return;

        $formField->client_id   = $client->id;
        $formField->form_id     = $request->id;
        $formField->name        = $request->name;
        $formField->placeholder = @$request->placeholder;
        $formField->type        = @$request->type;
        $formField->space       = @$request->space;
        $formField->required    = (@$request->required)?1:0;;
        $formField->options     = @$request->options;
        $formField->save();
    }

    public function reorder_form_fields($id = null, $order = 0){
        $client                 = $this->client;
        $formField              = FormField::where("id", $id)->where("client_id", $client->id)->first();
        if($formField){
            $formField->order   = $order;
            $formField->save();
        }
    }

    public function remove_app_field(Request $request){
        $client         = $this->client;
        $formField      = FormField::where("id", $request->field_id)->where("client_id", $client->id)->first();
        if(!$formField)
            return;
        $formField->delete();
    }

    public function duplicate_app_field(Request $request){
        $client         = $this->client;
        $formField      = FormField::where("id", $request->field_id)->where("client_id", $client->id)->first();
        if(!$formField)
            return;

        $new_formField              = new FormField();
        $new_formField->client_id   = $formField->client_id;
        $new_formField->order       = @$formField->order;
        $new_formField->form_id     = $formField->form_id;
        $new_formField->name        = $formField->name."(1)";
        $new_formField->placeholder = @$formField->placeholder;
        $new_formField->type        = @$formField->type;
        $new_formField->space       = @$formField->space;
        $new_formField->required    = @$formField->required;
        $new_formField->options     = @$formField->options;
        $new_formField->save();
    }

    public function app_data ($id=null){
        $client     = $this->client;
        if (!@$this->my_plugins[2])
            return back();

        $plugin     = @$this->my_plugins[2];
        $form       = Form::with(["data"=>function ($req) use($client) {return $req->where("client_id", $client->id);}])->with(["fields"=>function ($req) use($client) {return $req->where("client_id", $client->id);}])->where("client_id", $client->id)->where("id", $id)->first();
        if (!@$form)
            return back();

        return view("client.plugins.app_data", compact("form", "plugin"));
    }

    public function remove_app_data ($id=null){
        $client     = $this->client;
        if (!@$this->my_plugins[2])
            return back();

        $formdata   = FormData::where("client_id", $client->id)->where("id", $id)->first();
        if (!@$formdata)
            return back();

        $formdata->delete();

        return back()->with("success", __("l.success_delete"));
    }

    public function save_settings1(Request $request){
        if(!cpermissions("plugins_list"))
            return redirect()->route("client.settings.no_permissions");

        if($request->has("enable_live_chat"))
            $this->s_save("enable_live_chat", 1);
        else
            $this->s_save("enable_live_chat", 0);
        $this->s_save("live_chat_code", $request->live_chat_code);
        $this->s_save("live_chat_website_id", implode(";", $request->live_chat_website_id));

        return back()->with("success", __("l.success_update"));
    }

    public function save_settings2(Request $request){
        if(!cpermissions("plugins_list"))
            return redirect()->route("client.settings.no_permissions");

        if($request->has("enable_jivo_chat"))
            $this->s_save("enable_jivo_chat", 1);
        else
            $this->s_save("enable_jivo_chat", 0);
        $this->s_save("jivo_chat_code", $request->jivo_chat_code);
        $this->s_save("jivo_chat_website_id", implode(";", $request->jivo_chat_website_id));

        return back()->with("success", __("l.success_update"));
    }

    public function save_settings5(Request $request){
        if(!cpermissions("plugins_list"))
            return redirect()->route("client.settings.no_permissions");

        if($request->has("enable_google_analytics"))
            $this->s_save("enable_google_analytics", 1);
        else
            $this->s_save("enable_google_analytics", 0);
        $this->s_save("google_analytics_code", $request->google_analytics_code);
        $this->s_save("google_analytics_website_id", implode(";", $request->google_analytics_website_id));

        return back()->with("success", __("l.success_update"));
    }

    public function save_settings6(Request $request){
        if(!cpermissions("plugins_list"))
            return redirect()->route("client.settings.no_permissions");

        if($request->has("enable_mailchimp"))
            $this->s_save("enable_mailchimp", 1);
        else
            $this->s_save("enable_mailchimp", 0);
        if($request->has("mailchimp_api_key") and @$request->mailchimp_api_key!="")
            $this->s_save("mailchimp_api_key", $request->mailchimp_api_key);
        //$this->s_save("live_chat_website_id", implode(";", $request->live_chat_website_id));

        return back()->with("success", __("l.success_update"));
    }

    public function save_settings7(Request $request){
        if(!cpermissions("plugins_list"))
            return redirect()->route("client.settings.no_permissions");

        if($request->has("enable_whatsapp"))
            $this->s_save("enable_whatsapp", 1);
        else
            $this->s_save("enable_whatsapp", 0);
        if($request->has("whatsapp_code") and @$request->whatsapp_code!="")
            $this->s_save("whatsapp_code", $request->whatsapp_code);
        $this->s_save("whatsapp_website_id", implode(";", $request->whatsapp_website_id));

        return back()->with("success", __("l.success_update"));
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

    public function export_excel ($id=null){
        $client     = $this->client;
        if (!@$this->my_plugins[2])
            return back();

        $plugin     = @$this->my_plugins[2];
        $form       = Form::with(["data"=>function ($req) use($client) {return $req->where("client_id", $client->id);}])->with(["fields"=>function ($req) use($client) {return $req->where("client_id", $client->id);}])->where("client_id", $client->id)->where("id", $id)->first();
        if (!@$form)
            return back();

        $heardess_names = [__("l.website"), __("l.date")];
        foreach($form->fields as $f):
            array_push($heardess_names, $f->name);
        endforeach;
        $datas = [$heardess_names];
        $heardess = [__("l.website"), __("l.date")];
        foreach($form->fields as $f):
            array_push($heardess, $f);
        endforeach;
        $i = 1;
        foreach($form->data as $data):
            $arr = [];
            $j= 0;
            foreach ($heardess as $k => $h):
                if($k == 0)
                    @$arr[$j] = @$data->website->{"name_".app()->getLocale()};
                elseif ($k == 1)
                    @$arr[$j] = @$data->created_at->format("Y-m-d h:i:s");
                else{
                    $values = [];
                    $options = ($h->options)?explode(";", $h->options):[];
                    $values[$h->id] = "";
                    $datax = unserialize($data->values);
                    foreach ($datax as $value)
                        foreach($value as $p => $x)
                            $values[$p] = $x;
                    if($h->type=="text" or $h->type=="date" or $h->type=="number" or $h->type=="textarea"):
                        @$arr[$j] = @$values[$h->id];
                    elseif($h->type=="select" or $h->type=="selectmultiple"):
                        $selectvalues = explode(";", @$values[$h->id]);
                        $vv = "";
                        foreach($selectvalues as $s):
                            $vv = $vv. "\n". @$options[$s];
                        endforeach;
                        @$arr[$j] = $vv;
                    endif;
                    @$arr[$j] = (@$arr[$j] and @$arr[$j]!="")?@$arr[$j]:" ";
                }
                $j++;
            endforeach;
            $datas[(string)$i] = $arr;
            $i++;
        endforeach;

        return Excel::download(new FormDataExport($datas), $form->name.'.xlsx');
    }

    public function export_to_mailchimp(Request $request){
        $settings   = ClientSetting::where("client_id", @$this->client->id)->get()->keyBy("key");
        $api_key    = $settings["mailchimp_api_key"]->value;
        $list_id    = $request->list;
        $newsletters = Newsletter::all();
        if(count($newsletters) == 0)
            return back();

        try{
            foreach ($newsletters as $newsletter){
                $name = ($newsletter->name)?$newsletter->name:"";
                $phone = ($newsletter->phone)?$newsletter->phone:"";
                $subscriber = ["email_address" => $newsletter->email, "status" => "subscribed", "merge_fields" => array("FNAME"=> $name, "PHONE"=> $phone)];
                $url = explode("-", $api_key)[1];
                $ch = curl_init('https://'.$url.'.api.mailchimp.com/3.0/lists/'.$list_id.'/members/');
                curl_setopt_array($ch, array(
                    CURLOPT_POST => TRUE,
                    CURLOPT_RETURNTRANSFER => TRUE,
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: apikey '.$api_key,
                        'Content-Type: application/json'
                    ),
                    CURLOPT_POSTFIELDS => json_encode($subscriber)
                ));
                $response = json_decode(curl_exec($ch));
            }
        }catch (\Exception $e){
        }

        return back();
    }
}
