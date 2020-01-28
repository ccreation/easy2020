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
use App\Form;
use App\ClientVideo;
use App\Color;

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
            if(Auth::guard("web")->check())
                $client = Client::find(1);
            else
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
        $website            = Website::with("color")->where(["id" => $id, "client_id" => $client_id])->first();
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
                $website    = Website::where(["id" => $id, "client_id" => $client_id])->first();
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

        $forms              = Form::where(["client_id" => $client_id])->orderby("created_at", "desc")->get();

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
                    //array_push($my_images, $image);
                    $my_images[$dir->getMTime()] = $image;
                }
            }
        }
        krsort($my_images);
        $my_videos = ClientVideo::where("client_id", $client_id)->orderby("created_at", "desc")->get();
        foreach ($my_videos as $my_video){
            $my_video->url = createVideo($my_video->url);
        }
        $colors = Color::where("client_id", $client_id)->orderby("created_at", "desc")->get();

        return  view("editor.edit", compact("website", "page", "websites", "pages",
            "website_lang", "real_page_url", "page_url", "forms", "my_images", "my_videos", "colors"));
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
     * Delete the page
     * @param  Page id  $id
     * @return a redirect to pages list (index)
     */
    public function delete_page($id=null){
        if(Auth::guard("client")->check())
            if(!cpermissions("pages_list_delete"))
                return redirect()->route("client.settings.no_permissions");

        $page           = Page::where(["id" => $id, "client_id"=>$this->client->id])->first();
        if(!$page)
            return back();
        $website_id = $page->website_id;

        $page->delete();

        return redirect()->route("editor.edit", $website_id)->with("success", __("l.success_delete"));
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

    public function get_custom_form(Request $request){
        $client_id  = @$this->client->id;
        $form = Form::where(["client_id" => $client_id, "id" => $request->id])->first();
        if(!$form)
            return;

        $website = Website::where(["id" => $request->website_id, "client_id" => $client_id])->first();
        if(!$website)
            return back();
        $lang = $request->lang;

        return view('editor.custom_form', compact("form", "website", "lang"));
    }

    /**
     * upload image from computer
     * @param  Request $request
     * @return  void
     */
    public function images_upload_save(Request $request){
        $client_id      = @$this->client->id;

        $path           = $request->file->store("uploads/clients/".$client_id);
        $value          = asset("storage/app/".$path);
        return $value;
    }

    public function images_upload_delete(Request $request){
        $client_id      = @$this->client->id;

        try{
            $path           = "uploads/clients/".$client_id;
            $path2          = asset("storage/app/".$path);
            if (strpos($request->image, $path2) !== false) {
                $file = str_replace(asset(""), "", $request->image);
                $file = base_path($file);
                if($file and file_exists($file) and is_file($file))
                    unlink($file);
            }
        }catch (\Exception $e){
            dd($e->getMessage());
        }
    }

    public function videos_upload_save(Request $request){
        $client_id          = @$this->client->id;
        $video              = new ClientVideo;
        $video->client_id   = $client_id;
        $video->url         = $request->video_url_youtube_or_vimeo;
        $video->save();
    }

    public function videos_upload_delete(Request $request){
        $client_id      = @$this->client->id;
        $video          = ClientVideo::where("client_id", $client_id)->where("id", $request->id)->delete();
    }

    public function change_font(Request $request){
        $client_id      = @$this->client->id;
        $website        = Website::where(["client_id" => $client_id, "id" => $request->id])->first();
        if($website){
            if($request->font and $request->font != "")
                $website->font = $request->font;
            else
                $website->font = null;
            $website->save();
        }
    }

    public function save_color(Request $request){
        $client_id          = @$this->client->id;

        $color              = new Color;
        $color->client_id   = $client_id;
        $color->name        = $request->name;
        $color->color1      = $request->color1;
        $color->color2      = $request->color2;
        $color->save();
    }

    public function change_color_default(Request $request){
        $client_id          = @$this->client->id;

        $website            = Website::where(["id" => $request->website_id, "client_id" => $client_id])->first();
        if($website){
            $website->color_id = ($request->color_id and $request->color_id != "0") ? $request->color_id : null;
            $website->save();
        }
    }

    public function update_color(Request $request){
        $client_id          = @$this->client->id;

        $color              = Color::where(["id" => $request->color_id, "client_id" => $client_id])->first();
        if($color){
            $color->name        = $request->name;
            $color->color1      = $request->color1;
            $color->color2      = $request->color2;
            $color->save();
        }
    }

    public function remove_color(Request $request){
        $client_id          = @$this->client->id;

        $website            = Website::where(["id" => $request->website_id, "client_id" => $client_id])->first();
        $color              = Color::where(["id" => $request->color_id, "client_id" => $client_id])->first();

        if($color){
            $color->delete();
        }

        if($website){
            if($website->color_id == $request->color_id){
                $website->color_id = null;
                $website->save();
            }
        }
    }

}
