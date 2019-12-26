<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Role;
use App\Setting;
use App\Plugin;
use App\TicketType;

class SettingsController extends AdminBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }

    public function payment_settings(){
        if(!permissions("payment_settings"))
            return redirect()->route("admin.settings.no_permissions");

        $settings   = Setting::all()->KeyBy("key");
        $plugins    = Plugin::orderby("created_at", "desc")->get();

        return view('admin.settings.payment_settings', compact("settings", "plugins"));
    }

    public function add_month(Request $request){
        session(['settingsTab2' => 3]);
        $months = intval($request->month)+(12*intval($request->year));
        $s = Setting::where("key", "months")->first();
        if($s and is_array(unserialize($s->value))){
            $m = unserialize($s->value);
            array_push($m, $months);
            $s->value = serialize($m);
            $s->save();
        }else{
            $setting        = new Setting;
            $setting->key   = "months";
            $setting->value = serialize([$months]);
            $setting->save();
        }

        return back()->with("success", __("l.success_save"));
    }

    public function remove_month($index = 0){
        session(['settingsTab2' => 3]);
        $s = Setting::where("key", "months")->first();
        if($s and is_array(unserialize($s->value))){
            $m = unserialize($s->value);
            if(isset($m[$index]))
                unset($m[$index]);
            $s->value = serialize($m);
            $s->save();
        }else{
            return back();
        }

        return back()->with("success", __("l.success_save"));
    }

    public function update_month(Request $request){
        session(['settingsTab2' => 3]);
        $months = intval($request->month)+(12*intval($request->year));
        $s = Setting::where("key", "months")->first();
        if($s and is_array(unserialize($s->value))){
            $m = unserialize($s->value);
            if(isset($m[$request->index]))
                $m[$request->index] = $months;
            $s->value = serialize($m);
            $s->save();
        }else{
            return back();
        }

        return back()->with("success", __("l.success_save"));
    }

    /**
     * Save settings by key/value
     *
     * @return void
     */
    protected function s_save($k, $v, $request){
        $setting            = Setting::where("key", $k)->first();
        if(!$setting){
            $setting        = new Setting;
            $setting->key   = $k;
        }
        $setting->value     = $v;
        $setting->save();
    }

    /**
     * Show general settings
     *
     * @return a view of settings index
     */
    public function index(){
        if(!permissions("settings"))
            return redirect()->route("admin.settings.no_permissions");

        $roles          = Role::orderby("created_at", "desc")->get();
        $settings       = Setting::all()->keyby("key");
        $ticketTypes    = TicketType::orderby("created_at", "desc")->get();

        $smsnum = 0;
        if(@$settings["yamamah_username"]->value and @$settings["yamamah_password"]->value){
            $u = @$settings["yamamah_username"]->value;
            $p = @$settings["yamamah_password"]->value;
            ini_set("allow_url_fopen", 1);
            try{
                $ch = curl_init("http://api.yamamah.com/GetCredit/".$u."/".urlencode($p));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',));
                $result = json_decode(curl_exec($ch));
                curl_close($ch);
                if(@$result->GetCreditResult->Status==1)
                    $smsnum = @$result->GetCreditResult->Credit;
            }
            catch (\Exception $e){}
        }

        return view('admin.settings.index', compact("roles", "settings", "ticketTypes", "smsnum"));
    }

    public function save_settings(Request $request){
        session(['settingsTab' => 1]);
        if($request->has("entity_id"))
            session(['settingsTab2' => 1]);
        foreach ($request->except("_token") as $k => $v) {
            $this->s_save($k, $v, $request);
        }

        return back()->with("success", __("l.success_save"));
    }

    /**
     * Add new role
     * @param Request $request
     * @return a redirect to settings page
     */
    public function save_role(Request $request){
        session(['settingsTab' => 5]);
        $role       = new Role;
        $role->name = $request->name;
        $role->save();

        return back()->with("success", __("l.success_save"));
    }

    /**
     * Delete role
     * @param Role id $id
     * @return a redirect to settings page
     */
    public function delete_role($id=null){
        session(['settingsTab' => 5]);
        $role       = Role::find($id);
        if($role)
            $role->delete();

        return back()->with("success", __("l.success_delete"));
    }

    /**
     * Update role
     * @param Request $request
     * @return a redirect to settings page
     */
    public function update_role(Request $request){
        session(['settingsTab' => 5]);
        $role       = Role::find($request->id);
        $role->name = $request->name;
        $role->save();

        return back()->with("success", __("l.success_update"));
    }

    public function no_permissions(){
        return view("admin.settings.no_permissions");
    }

    /**
     * Update role ermissions
     * @param Request $request
     * @return a redirect to settings page
     */
    public function save_permissions(Request $request){
        session(['settingsTab' => 6]);
        $role       = Role::find($request->role_id);

        if($role){
            $permissions = [];

            if($request->statistics)
                array_push($permissions, "statistics");

            if($request->users)
                array_push($permissions, "users");
            if($request->add_user)
                array_push($permissions, "add_user");
            if($request->update_user)
                array_push($permissions, "update_user");
            if($request->remove_user)
                array_push($permissions, "remove_user");

            if($request->clients)
                array_push($permissions, "clients");
            if($request->add_client)
                array_push($permissions, "add_client");
            if($request->update_client)
                array_push($permissions, "update_client");
            if($request->remove_client)
                array_push($permissions, "remove_client");
            if($request->show_client)
                array_push($permissions, "show_client");

            if($request->templates_index)
                array_push($permissions, "templates_index");
            if($request->templates_cat_add)
                array_push($permissions, "templates_cat_add");
            if($request->templates_cat_edit)
                array_push($permissions, "templates_cat_edit");
            if($request->templates_cat_remove)
                array_push($permissions, "templates_cat_remove");
            if($request->templates_add)
                array_push($permissions, "templates_add");
            if($request->templates_edit)
                array_push($permissions, "templates_edit");
            if($request->templates_remove)
                array_push($permissions, "templates_remove");

            if($request->websites_index)
                array_push($permissions, "websites_index");
            if($request->websites_block)
                array_push($permissions, "websites_block");

            if($request->blocks)
                array_push($permissions, "blocks");

            if($request->documentations_index)
                array_push($permissions, "documentations_index");
            if($request->documentations_cat_add)
                array_push($permissions, "documentations_cat_add");
            if($request->documentations_cat_edit)
                array_push($permissions, "documentations_cat_edit");
            if($request->documentations_cat_remove)
                array_push($permissions, "documentations_cat_remove");
            if($request->documentations_add)
                array_push($permissions, "documentations_add");
            if($request->documentations_edit)
                array_push($permissions, "documentations_edit");
            if($request->documentations_remove)
                array_push($permissions, "documentations_remove");

            if($request->plans_index)
                array_push($permissions, "plans_index");
            if($request->plans_add)
                array_push($permissions, "plans_add");
            if($request->plans_edit)
                array_push($permissions, "plans_edit");
            if($request->plans_remove)
                array_push($permissions, "plans_remove");

            if($request->promocodes_index)
                array_push($permissions, "promocodes_index");
            if($request->promocodes_add)
                array_push($permissions, "promocodes_add");
            if($request->promocodes_edit)
                array_push($permissions, "promocodes_edit");
            if($request->promocodes_remove)
                array_push($permissions, "promocodes_remove");

            if($request->banks_index)
                array_push($permissions, "banks_index");
            if($request->banks_add)
                array_push($permissions, "banks_add");
            if($request->banks_edit)
                array_push($permissions, "banks_edit");
            if($request->banks_remove)
                array_push($permissions, "banks_remove");

            if($request->payments_index)
                array_push($permissions, "payments_index");
            if($request->payments_accept_reject)
                array_push($permissions, "payments_accept_reject");
            if($request->payments_details)
                array_push($permissions, "payments_details");

            if($request->tickets_index)
                array_push($permissions, "tickets_index");
            if($request->tickets_open_close)
                array_push($permissions, "tickets_open_close");
            if($request->tickets_add)
                array_push($permissions, "tickets_add");
            if($request->tickets_show)
                array_push($permissions, "tickets_show");
            if($request->tickets_edit)
                array_push($permissions, "tickets_edit");
            if($request->tickets_remove)
                array_push($permissions, "tickets_remove");

            if($request->payment_settings)
                array_push($permissions, "payment_settings");

            if($request->settings)
                array_push($permissions, "settings");

            $permissions = serialize($permissions);
            $role->permissions = $permissions;
            $role->save();
        }

        $role->save();

        return back()->with("success", __("l.success_update"));
    }

    public function add_plugin(Request $request){
        $request->validate(["image" => "image"]);

        $plugin             = new Plugin;
        $plugin->name_ar    = $request->name_ar;
        $plugin->name_en    = $request->name_en;
        $plugin->price      = $request->price;
        $plugin->image      = $request->image->store("uploads");
        $plugin->save();

        return back()->with("success", __("l.success_save"));
    }

    public function update_plugin(Request $request){
        session(['settingsTab2' => 2]);

        if($request->hasFile("image"))
            $request->validate(["image" => "image"]);

        $plugin             = Plugin::find($request->id);
        if(!$plugin)
            return back();

        $plugin->name_ar    = $request->name_ar;
        $plugin->name_en    = $request->name_en;
        $plugin->description_ar    = $request->description_ar;
        $plugin->description_en    = $request->description_en;
        $plugin->price      = $request->price;
        if($request->hasFile("image")){
            if($plugin->image and file_exists(storage_path("app/".$plugin->image)) and is_file(storage_path("app/".$plugin->image)))
                unlink(storage_path("app/".$plugin->image));
            $plugin->image  = $request->image->store("uploads");
        }
        $plugin->save();

        return back()->with("success", __("l.success_update"));
    }

    public function save_ticket_type(Request $request){
        session(['settingsTab' => 4]);
        $ticket_type = new TicketType;
        $ticket_type->name = $request->name;
        $ticket_type->save();

        return back()->with("success", "تم إضافة البيانات بنجاح");
    }

    public function delete_ticket_type($id =null){
        session(['settingsTab' => 4]);
        $ticket_type = TicketType::find($id);
        if(!$ticket_type)
            return back();

        $ticket_type->delete();

        return back()->with("success", "تم حذف البيانات بنجاح");
    }

    public function update_ticket_type(Request $request){
        session(['settingsTab' => 4]);
        $ticket_type = TicketType::find($request->id);
        if(!$ticket_type)
            return back();

        $ticket_type->name = $request->name;
        $ticket_type->save();

        return back()->with("success", "تم تعديل البيانات بنجاح");
    }

    public function save_smtp_settings(Request $request){
        session(['settingsTab' => 2]);
        foreach ($request->except("_token", "send_test_mail_to") as $k => $v) {
            $this->s_save($k, $v, $request);
        }

        if($request->send_test_mail_to and $request->send_test_mail_to != ""){
            mailit_admin($request->send_test_mail_to, "رسالة تجربة", "هذه رسالة تجريبية من لوحة تحكم أدمن منصة سهل");
        }

        return back()->with("success", __("l.success_save"));
    }

    public function save_yamamah_settings(Request $request){
        session(['settingsTab' => 3]);
        foreach ($request->except("_token", "sms_test") as $k => $v) {
            $this->s_save($k, $v, $request);
        }

        if($request->sms_test and $request->sms_test != ""){
            sms_yamamah($request->sms_test, "هذه رسالة تجريبية من لوحة تحكم أدمن منصة سهل");
        }

        return back()->with("success", __("l.success_save"));
    }


}
