<?php

namespace App\Http\Controllers\Client;


use Illuminate\Http\Request;
use Auth;
use App\ClientUser;
use App\ClientSetting;
use App\ClientRole;

class SettingsController extends ClientBaseController{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Client settings main page
     *
     * @return view to settings main page
     */
    public function index(){
        if(!cpermissions("settings_general"))
            return redirect()->route("client.settings.no_permissions");

        $settings = ClientSetting::where("client_id", @$this->client->id)->get()->keyBy("key");

        return view("client.settings.index", compact("settings"));
    }

    /**
     * Save website settings
     * @param Request $request
     * @return a redirect to settings main page
     */
    public function save_settings1(Request $request){
        session(['settingsTab' => 1]);

        foreach ($request->except("_token", "client", "redirectTo", "enable_comments") as $k => $v) {
            $this->s_save($k, $v, $request);
        }

        if($request->default_lang){
            \Session::forget('locale');
            \Session::put('locale', $request->default_lang);
            \App::setlocale($request->default_lang);
        }

        $client = $this->client;
        $client->enable_comments = $request->enable_comments;
        $client->save();

        return back()->with("success", __("l.success_update"));
    }

    public function save_settings2(Request $request){

        if($request->has("email_sent_from_address"))
            session(['settingsTab' => 2]);
        elseif($request->has("reset_password_html"))
            session(['settingsTab' => 3]);
        elseif($request->has("activation_html"))
            session(['settingsTab' => 4]);

        foreach ($request->except("_token", "client", "redirectTo", "enable_comments", "langg", "frontLang") as $k => $v) {
            $this->s_save($k, $v, $request);
        }

        init();

        if ($request->send_test_mail_to) {
            mailit($request->send_test_mail_to, "رسالة إختبار", "هذه رسالة إختبار من نظام سهل");
        }

        return back()->with("success", __("l.success_update"));
    }

    /**
     * Save settings by key/value
     *
     * @return void
     */
    protected function s_save($k, $v, $request){
        $client_id          = @$this->client->id;
        $setting            = ClientSetting::where("client_id", $client_id)->where("key", $k)->first();
        if(!$setting){
            $setting        = new ClientSetting;
            $setting->client_id = $client_id;
            $setting->key   = $k;
        }
        if($k=="logo_ar" and $request->hasFile("logo_ar"))
            $v              = $request->logo_ar->store("uploads/client/".$client_id);
        if($k=="logo_en" and $request->hasFile("logo_en"))
            $v              = $request->logo_en->store("uploads/client/".$client_id);
        $setting->value     = $v;
        $setting->save();
    }

    /**
     * Remove website settings
     * @param String $key
     * @return void
     */
    public function remove_settings($key=null){
        $client_id          = @$this->client->id;
        $setting            = ClientSetting::where("client_id", $client_id)->where("key", $key)->first();
        $setting->delete();
    }

    public function permissions(){
        if(!cpermissions("settings_permissions"))
            return redirect()->route("client.settings.no_permissions");

        $roles = ClientRole::where("client_id", $this->client->id)->orderby("created_at", "asc")->get();

        return view("client.settings.permissions", compact("roles"));
    }

    public function save_role(Request $request){
        $request->validate(["name" => "required|string"]);

        $role               = new ClientRole;
        $role->client_id    = $this->client->id;
        $role->name         = $request->name;
        $role->save();

        return back()->with("success", __("l.success_save"));
    }

    public function update_role(Request $request){
        $request->validate(["name" => "required|string"]);

        $role               = ClientRole::where(["id" => $request->id, "client_id" => $this->client->id])->first();
        if(!$role)
            return back();

        $role->name         = $request->name;
        $role->save();

        return back()->with("success", __("l.success_update"));
    }

    public function delete_role($id = null){
        $role               = ClientRole::where(["id" => $id, "client_id" => $this->client->id])->first();
        if(!$role)
            return back();

        $role->delete();

        return back()->with("success", __("l.success_delete"));
    }

    public function save_permissions(Request $request){

        $role               = ClientRole::where(["id" => $request->role_id, "client_id" => $this->client->id])->first();
        if(!$role)
            return back();

        $permissions        = [];

        if($request->home_preview)
            array_push($permissions, "home_preview");

        if($request->users_section_list)
            array_push($permissions, "users_section_list");
        if($request->users_section_add)
            array_push($permissions, "users_section_add");
        if($request->users_section_edit)
            array_push($permissions, "users_section_edit");
        if($request->users_section_delete)
            array_push($permissions, "users_section_delete");

        if($request->my_websites_list_all)
            array_push($permissions, "my_websites_list_all");
        if($request->my_websites_list_only_mine)
            array_push($permissions, "my_websites_list_only_mine");
        if($request->my_websites_add)
            array_push($permissions, "my_websites_add");
        if($request->my_websites_update)
            array_push($permissions, "my_websites_update");
        if($request->my_websites_delete)
            array_push($permissions, "my_websites_delete");
        if($request->my_websites_choose_template)
            array_push($permissions, "my_websites_choose_template");
        if($request->my_websites_pages)
            array_push($permissions, "my_websites_pages");

        if($request->pages_list_add)
            array_push($permissions, "pages_list_add");
        if($request->pages_list_update)
            array_push($permissions, "pages_list_update");
        if($request->pages_list_delete)
            array_push($permissions, "pages_list_delete");
        if($request->pages_list_publish_draft)
            array_push($permissions, "pages_list_publish_draft");
        if($request->pages_list_change_homepage)
            array_push($permissions, "pages_list_change_homepage");

        if($request->comments_list)
            array_push($permissions, "comments_list");
        if($request->comments_publish_draft)
            array_push($permissions, "comments_publish_draft");
        if($request->comments_update)
            array_push($permissions, "comments_update");
        if($request->comments_delete)
            array_push($permissions, "comments_delete");

        if($request->templates_list)
            array_push($permissions, "templates_list");
        if($request->templates_purchase_use)
            array_push($permissions, "templates_purchase_use");

        if($request->plans_list)
            array_push($permissions, "plans_list");
        if($request->plans_purchase_use)
            array_push($permissions, "plans_purchase_use");

        if($request->plugins_list)
            array_push($permissions, "plugins_list");
        if($request->plugins_purchase)
            array_push($permissions, "plugins_purchase");
        foreach ($this->client->my_plugins as $plugin):
            if($request->{"plugins_settings_".$plugin->id})
                array_push($permissions, "plugins_settings_".$plugin->id);
        endforeach;

        if($request->my_subscriptions_list)
            array_push($permissions, "my_subscriptions_list");

        if($request->members_management_list)
            array_push($permissions, "members_management_list");
        if($request->members_management_add)
            array_push($permissions, "members_management_add");
        if($request->members_management_update)
            array_push($permissions, "members_management_update");
        if($request->members_management_delete)
            array_push($permissions, "members_management_delete");

        if($request->visitor_messages_list)
            array_push($permissions, "visitor_messages_list");
        if($request->visitor_messages_preview)
            array_push($permissions, "visitor_messages_preview");
        if($request->visitor_messages_delete)
            array_push($permissions, "visitor_messages_delete");

        if($request->newsletter_list_list)
            array_push($permissions, "newsletter_list_list");

        if($request->statistics_preview)
            array_push($permissions, "statistics_preview");

        if($request->settings_general)
            array_push($permissions, "settings_general");
        if($request->settings_permissions)
            array_push($permissions, "settings_permissions");

        $permissions        = serialize($permissions);
        $role->permissions  = $permissions;
        $role->save();

        return back()->with("success", __("l.success_update"));
    }

    public function no_permissions(){
        return view("client.settings.no_permissions");
    }

}


