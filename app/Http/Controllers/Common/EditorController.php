<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use View;
use App\Category;
use App\ClientUser;
use App\Page;
use App\Website;
use App\Client;
use App\Plan;

class EditorController extends Controller{

    public $client = null;
    public $redirectTo = "home";
    public $lang = "ar";
    public $my_plan = null;
    public $my_size = 0;
    public $my_plugins = null;
    public $default_lang = "ar";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('language');
        $this->middleware('pages');
        $this->middleware(function ($request, $next) {
            $client = Client::find($request->client->id);
            $this->client = $client;
            View::share("client", $this->client);
            $this->lang = $request->langg;
            View::share("lang", $this->lang);
            $this->frontLang = $request->frontLang;
            View::share("frontLang", $this->frontLang);
            /*
            $this->redirectTo = $request->redirectTo;
            $plan = Plan::find($c->plan_id);
            $this->my_plan = $plan;
            View::share("my_plan", $plan);
            $this->my_plugins = $c->my_plugins->KeyBy("id");
            View::share("my_plugins", $this->my_plugins);

            $websites = Website::where("client_id", $c->id)->count();
            View::share("my_websites", $websites);

            $size0 = 0;
            $f = storage_path("app/uploads/client/" . $c->id);
            if (is_dir($f)) {
                $io = popen('/usr/bin/du -sk ' . $f, 'r');
                $size = fgets($io, 4096);
                $size = substr($size, 0, strpos($size, "\t"));
                $size0 += $size;
                pclose($io);
            }
            $f = storage_path("app/uploads/clients/" . $c->id);
            if (is_dir($f)) {
                $io = popen('/usr/bin/du -sk ' . $f, 'r');
                $size = fgets($io, 4096);
                $size = substr($size, 0, strpos($size, "\t"));
                $size0 += $size;
                pclose($io);
            }
            $this->my_size = intval($size0 / 1024);
            View::share("my_size", intval($size0 / 1024));


            $settings = ClientSetting::where("client_id", @$this->client->id)->get()->keyBy("key");
            $default_lang = (!@$settings["default_lang"]) ? "ar" : @$settings["default_lang"]->value;
            $this->default_lang = $default_lang;
            View::share("default_lang", $default_lang);


            $admin_settings = Setting::all()->keyby("key");
            View::share("admin_settings", $admin_settings);

            $new_notifications = Notification::where(["client_id" => $c->id, "status" => 0])->orderby("created_at", "desc")->get();
            $new_notifications = ($new_notifications) ? $new_notifications : collect();
            View::share("new_notifications", $new_notifications);*/

            return $next($request);
        });
    }

    /**
     * Page edit from.
     * @param Page:id $id
     * @return a view
     */
    public function edit($id = null, $page_id = null){
        $client_id          = @$this->client->id;
        $website            = Website::where(["id" => $id, "client_id" => $client_id])->first();
        $websites           = Website::where("client_id", $client_id)->where("id", "!=", $id)->orderby("created_at", "desc")->get();
        if(!$website)
            return back();

        if($page_id){
            $page           = Page::where(["id" => $page_id, "website_id" => $id, "client_id" => $client_id])->first();
            if(!$page)
                return back();
        }else{
            $page           = Page::where(["id"=>$website->homepage, "website_id" => $id, "client_id" => $client_id])->first();
            if(!$page){
                create_homepage($website->id, $client_id, 0);
                $page       = Page::where(["id"=>$website->homepage, "website_id" => $id, "client_id" => $client_id])->first();
            }
        }
        $pages              = Page::where(["website_id" => $id, "client_id" => $client_id])->orderby("created_at", "desc")->get();

        $website_lang       = $website->default_lang;
        $real_page_url      = route("website.page", [$website->slug, $website_lang, $page->slug]);
        if(Auth::guard("client")->check()):
            $page_url       = route("client.websites.get_page")."?url=".urlencode($real_page_url);
        else:
            $page_url       = route("admin.templates.get_page")."?url=".urlencode($real_page_url);
        endif;

        return  view("editor.edit", compact("website", "page", "websites", "pages",
            "website_lang", "real_page_url", "page_url"));
    }

    /**
     * Save the Page
     * @param  Request  $request
     * @return a redirect to ediror
     */
    public function save_page(Request $request){
        $client_id          = @$this->client->id;
        $website            = Website::where(["id" => $request->website_id, "client_id" => $client_id])->first();
        if(!$website)
            return back();

        $page               = new Page;
        $page->client_id    = $client_id;
        $page->user_id      = (Auth::guard("client")->check())?Auth::guard("client")->user()->id:1;
        $page->name         = ($request->name and $request->name != "") ? $request->name : "غير مسمى";
        $page->name_en      = ($request->name_en and $request->name_en != "") ? $request->name_en : "unnamed";
        $page->status       = 0;
        $page->website_id   = $request->website_id;
        $page->slug         = $this->create_slug();
        $page->save();

        return redirect()->route("editor.edit", [$website->id, $page->id])->with("success", __("l.success_save"));
    }

    /**
     * Create the Page slug
     * @param  name from the request $request
     * @return the formatted slug
     */
    protected function create_slug($id=null, $name = null){
        if($name)
            $slug0  = str_replace(" ", "_", trim($name));
        else
            $slug0  = rand(11111, 99999);
        $slug       = $slug0;
        $search     = true;
        $repeated   = 1;
        while($search){
            if($id)
                $pagex = Page::where("id", "!=", $id)->where("client_id", $this->client->id)->where("slug", $slug)->first();
            else
                $pagex = Page::where("client_id", $this->client->id)->where("slug", $slug)->first();
            if(!$pagex){
                $search = false;
            }else{
                $slug = $slug0."(".$repeated.")";
                $repeated ++;
            }
        }
        return $slug;
    }

    /**
     * update the Page
     * @param  Request  $request
     * @return a redirect to ediror
     */
    public function update_page(Request $request){
        $client_id          = @$this->client->id;
        $page               = Page::where(["id" => $request->page_id, "client_id" => $client_id])->first();
        if(!$page)
            return back();

        $website            = Website::where(["id" => $page->website_id, "client_id" => $client_id])->first();
        if(!$website)
            return back();

        $page->name         = ($request->name and $request->name != "") ? $request->name : "غير مسمى";
        $page->name_en      = ($request->name_en and $request->name_en != "") ? $request->name_en : "unnamed";
        $page->save();

        return back()->with("success", __("l.success_update"));
    }

    /**
     * change the Page slug
     * @param  slug from the request $request
     * @return the formatted slug
     */
    protected function update_slug(Request $request){
        $page       = Page::where(["id" => $request->page_id, "client_id"=>$this->client->id])->first();
        if(!$page)
            return back();
        $slug       = $this->create_slug($page->page_id, $request->slug);
        $page->slug = $slug;
        $page->save();

        return back()->with("success", __("l.success_update"));
    }

    public function save_page_html_content(Request $request){
        $client_id  = @$this->client->id;
        $page = Page::where(["client_id" => $client_id, "id" =>$request->id])->first();
        if(!$page)
            return back();
        $page->{"html_content_".$request->lang} = $request->html;
        $page->status = $request->status;
        $page->save();

        return back()->with("success", __("l.success_save"));
    }

}
