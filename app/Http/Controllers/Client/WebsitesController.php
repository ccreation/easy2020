<?php

namespace App\Http\Controllers\Client;

use App\ClientUser;
use http\Env\Response;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Client;
use App\Website;
use App\CatgeoryWebsite;
use App\PageBlockMeta;
use App\PageBlock;
use App\Page;
use App\Post;
use App\Slider;
use App\Category;
use App\Menu;
use App\Plan;
use Intervention\Image\ImageManagerStatic as Image;
use App\Comment;
use App\CategoryDocumentation;
use App\Documentation;


class WebsitesController extends ClientBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the website.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if(!cpermissions("my_websites_list_all") and !cpermissions("my_websites_list_only_mine"))
            return redirect()->route("client.settings.no_permissions");


        $client         = $this->client;
        $user_id        = Auth::guard("client")->user()->id;
        if(cpermissions("my_websites_list_all"))
            $websites   = Website::with("user")->withCount("pages")->where("client_id", $client->id)->orderby("created_at", "desc")->paginate(20);
        else
            $websites   = Website::with("user")->withCount("pages")->where("client_id", $client->id)->where("user_id", $user_id)->orderby("created_at", "desc")->paginate(20);
        $client         = Client::find($client->id);
        $plan           = Plan::find($client->plan_id);
        $users          = ClientUser::where("client_id", $client->id)->orderby("created_at", "desc")->get();

        return view("client.websites.index", compact("websites", "plan", "users"));
    }

    /**
     * Show the form for creating a new website.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(){
        if(!cpermissions("my_websites_add"))
            return redirect()->route("client.settings.no_permissions");
        
        $client          = $this->client;
        $c          = Client::find($client->id);
        $plan       = Plan::find($c->plan_id);
        $my_websites     = Website::where("client_id", $client->id)->count();

        if(($my_websites < @$plan->website_numbers and @$plan->website_numbers!=0) or @$plan->website_numbers==0){
            $catgeories = CatgeoryWebsite::orderby("created_at", "desc")->get();

            return view("client.websites.add", compact("catgeories", "plan"));
        }else{
            return back()->with("error", __("l.website_numbers_error"));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request){
        if(!cpermissions("my_websites_add"))
            return redirect()->route("client.settings.no_permissions");

        if($request->hasFile("logo")){
            $request->validate(["logo" => "image"]);
        }

        $client                     = $this->client;
        $website                    = new Website;
        $user_id                    = Auth::guard("client")->user()->id;
        $website->client_id         = $client->id;
        $website->user_id           = $user_id;
        if($request->slug){
            $slug0                  = str_replace(" ", "_", trim($request->slug));
            $websitex               = Website::where("slug", $slug0)->first();
            if($websitex)
                return redirect()->back()->with("error", __("l.website_slug_error"));
            $website->slug          = $slug0;
        }
        $website->category_id       = $request->category_id;
        $website->multi_lang        = ($request->multi_lang) ? 1 : 0;
        $website->default_lang      = $request->default_lang;
        $website->name_ar           = ($request->name_ar)?$request->name_ar:"";
        $website->name_en           = ($request->name_en)?$request->name_en:"";
        $website->description_ar    = ($request->description_ar)?$request->description_ar:"";
        $website->description_en    = ($request->description_en)?$request->description_en:"";
        if($request->hasFile("logo")){
            $image1                 = $request->file("logo");
            $filename1              = time().$image1->getClientOriginalName();
            $image_resize1          = Image::make($image1->getRealPath());
            $image_resize1->resize(150, 150);
            $image_resize1->save(storage_path("app/uploads/clients/".$client->id."/".$filename1));
            $website->logo          = asset("storage/app/uploads/clients/".$client->id."/".$filename1);
        }
        $website->save();

        create_homepage($website->id, $website->client_id, $website->user_id);

        if($request->type == __("l.use_template"))
            return redirect()->route("client.websites.choose_template_by_id", $website->id)->with("success", __("l.success_save"));

        return redirect()->route("editor.edit", $website->id)->with("success", __("l.success_save"));
    }

    /**
     * Display the specified website step2.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function step2($id =null){
        $client     = $this->client;
        $website    = Website::where(["id" => $id, "client_id" => $client->id])->first();
        if(!$website)
            return redirect()->route("client.website.index");

        return  view("client.websites.step2", compact("website"));
    }

    /**
     * Show the "choose template" form
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function choose_template($id = null){
        if(!cpermissions("templates_list"))
            return redirect()->route("client.settings.no_permissions");

        $client         = $this->client;
        $website        = Website::where(["id" => $id, "client_id" => $client->id])->first();

        $catgeories     = CatgeoryWebsite::orderby("created_at", "desc")->get();
        $templates      = Website::with("category")->where("client_id", 1)->orderby("created_at", "desc")->get();

        $c              = Client::find($client->id);
        $sold_templates = [];

        foreach ($c->templates as $t){
            array_push($sold_templates, $t);
        }

        return view("client.websites.choose_template", compact("website", "catgeories", "templates", "sold_templates"));
    }
    /*
     *
        if(!$client->templates()->where('template_id', 4)->exists())
            $client->templates()->attach(4);
        $client->templates()->detach();
        dd($client->templates);
     */

    /**
     * Show the form for editing the specified website.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        if(!cpermissions("my_websites_update"))
            return redirect()->route("client.settings.no_permissions");

        $client         = $this->client;
        $website        = Website::where(["id" => $id, "client_id" => $client->id])->first();
        if(!$website)
            return redirect()->route("client.website.index");

        $catgeories     = CatgeoryWebsite::orderby("created_at", "desc")->get();
        $lang           = app()->getLocale();
        $c              = Client::find($client->id);
        $plan           = Plan::find($c->plan_id);

        return view("client.websites.edit", compact("website", "catgeories", "lang", "plan"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        if(!cpermissions("my_websites_update"))
            return redirect()->route("client.settings.no_permissions");

        if($request->hasFile("logo")){
            $request->validate(["logo" => "image"]);
        }
        $client                     = $this->client;
        $website                    = Website::where(["client_id" => $client->id, "id" => $request->id])->first();
        if(!$website)
            return redirect()->route("client.websites.index");

        if($request->slug){
            if($request->slug){
                $slug0                  = str_replace(" ", "_", trim($request->slug));
                $websitex               = Website::where("slug", $slug0)->where("id", "!=", $request->id)->first();
                if($websitex)
                    return redirect()->back()->with("error", __("l.website_slug_error"));
                $website->slug          = $slug0;
            }
        }
        $website->category_id       = $request->category_id;
        $website->multi_lang        = $request->multi_lang;
        $website->name_ar           = ($request->name_ar)?$request->name_ar:"";
        $website->name_en           = ($request->name_en)?$request->name_en:"";
        $website->description_ar    = ($request->description_ar)?$request->description_ar:"";
        $website->description_en    = ($request->description_en)?$request->description_en:"";
        $website->default_lang      = $request->default_lang;
        if($request->hasFile("logo")){
            if($website->logo){
                $path               = str_replace(route("client.homepage"), base_path(), $website->logo);
                if($path and file_exists($path) and is_file($path))
                    unlink($path);
            }
            $image1                 = $request->file("logo");
            $filename1              = time().$image1->getClientOriginalName();
            $image_resize1          = Image::make($image1->getRealPath());
            $image_resize1->resize(150, 150);
            $image_resize1->save(storage_path("app/uploads/clients/".$client->id."/".$filename1));
            $website->logo          = asset("storage/app/uploads/clients/".$client->id."/".$filename1);
        }
        $socials                    = [];
        if($request->icon){
            for ($i=0; $i<count($request->icon); $i++){
                array_push($socials, ["icon" => @$request->icon[$i], "title" => @$request->title[$i], "link" => @$request->link[$i]]);
            }
            if($request->description_ar)
                $website->socials_ar    = serialize($socials);
            else
                $website->socials_en    = serialize($socials);
        }
        $website->save();

        return redirect()->route("client.websites.index")->with("success", __("l.success_update"));
    }

    /**
     * Remove the specified website from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        if(!cpermissions("my_websites_delete"))
            return redirect()->route("client.settings.no_permissions");

        $client                     = $this->client;
        $website                    = Website::where(["client_id" => $client->id, "id" => $id])->first();
        if(!$website)
            return redirect()->route("client.websites.index");

        if($website->logo){
            $path               = str_replace(route("client.homepage"), base_path(), $website->logo);
            if($path and file_exists($path) and is_file($path))
                unlink($path);
        }
        foreach ($website->pages as $page){
            foreach ($page->blocks as $block){
                $pageBlockMetas      = PageBlockMeta::where(["block_id" => $block->id, "client_id" => $client->id])->get();
                foreach ($pageBlockMetas as $item){
                    if($item->type =="image" or $item->type=="image" or $item->type=="links" or $item->type=="youtube"){
                        if($item->value){
                            $path   = str_replace(route("client.homepage"), base_path(), $item->value);
                            if($path and file_exists($path) and is_file($path))
                                unlink($path);
                        }
                    }
                    if($item->old_image){
                        $path   = str_replace(route("client.homepage"), base_path(), $item->old_image);
                        if($path and file_exists($path) and is_file($path))
                            unlink($path);
                    }
                    $item->delete();
                }
                $posts              = Post::where(["client_id" => $client, "block_id" => $block->id])->get();
                foreach ($posts as $item){
                    if($item->image){
                        $path       = str_replace(route("client.homepage"), base_path(), $item->image);
                        if($path and file_exists($path) and is_file($path))
                            unlink($path);
                    }if($item->old_image){
                        $path       = str_replace(route("client.homepage"), base_path(), $item->old_image);
                        if($path and file_exists($path) and is_file($path))
                            unlink($path);
                    }
                    $item->delete();
                }
                Category::where(["client_id" => $client, "block_id" => $block->id])->delete();
                $block->delete();
            }
            $posts              = Post::where(["client_id" => $client, "page_id" => $page->id])->get();
            foreach ($posts as $item){
                if($item->image){
                    $path       = str_replace(route("client.homepage"), base_path(), $item->image);
                    if($path and file_exists($path) and is_file($path))
                        unlink($path);
                }if($item->old_image){
                    $path       = str_replace(route("client.homepage"), base_path(), $item->old_image);
                    if($path and file_exists($path) and is_file($path))
                        unlink($path);
                }
                $item->delete();
            }
            $page->delete();
        }
        PageBlock::where(["website_id" => $website->id, "client_id" => $client->id])->delete();
        $sliders                    = Slider::where(["website_id" => $website->id, "client_id" => $client->id])->get();
        foreach ($sliders as $item){
            if($item->image){
                $path       = str_replace(route("client.homepage"), base_path(), $item->image);
                if($path and file_exists($path) and is_file($path))
                    unlink($path);
            }if($item->old_image){
                $path       = str_replace(route("client.homepage"), base_path(), $item->old_image);
                if($path and file_exists($path) and is_file($path))
                    unlink($path);
            }
            $item->delete();
        }
        Menu::where(["website_id" => $website->id, "client_id" => $client->id])->delete();
        $posts              = Post::where("client_id", $client->id)->whereNull("page_id")->get();
        foreach ($posts as $item){
            if($item->image){
                $path       = str_replace(route("client.homepage"), base_path(), $item->image);
                if($path and file_exists($path) and is_file($path))
                    unlink($path);
            }if($item->old_image){
                $path       = str_replace(route("client.homepage"), base_path(), $item->old_image);
                if($path and file_exists($path) and is_file($path))
                    unlink($path);
            }
            $item->delete();
        }
        $website->delete();

        return redirect()->route("client.websites.index")->with("success", __("l.success_delete"));
    }

    /**
     * copy data from template to website.
     *
     * @param int $from_id
     * @param int $to_id
     * @return \Illuminate\Http\Response
     */
    public function templating($from_id = null, $to_id = null){
        if(!cpermissions("templates_purchase_use"))
            return redirect()->route("client.settings.no_permissions");

        $client         = $this->client;
        $user_id        = Auth::guard("client")->user()->id;


        $template       = Website::where(["client_id" => 1, "id" => $from_id])->first();
        if(!$template)
            return back();

        $c              = Client::find($client->id);
        $sold_templates = [];
        foreach ($c->templates as $t){
            array_push($sold_templates, $t->id);
        }

        if(in_array($from_id, $sold_templates)){
            $x = DB::table("client_template")->where(["client_id" => $c->id, "template_id" => $from_id, "status" => 0])->latest("id")->first();
            if($x)
                return back();
        }

        $website        = Website::where(["client_id" => $client->id, "id" => $to_id])->first();

        if(in_array($from_id, $sold_templates) or $template->price==0){

            if(!$c->templates()->where('template_id', $from_id)->where('website_id', $to_id)->exists())
                $c->templates()->attach($from_id, ["website_id" => $to_id, "price" => $template->price, "status" => 1]);

            $sold_templates = [];
            foreach ($c->templates as $t){
                array_push($sold_templates, $t);
            }
            foreach ($sold_templates as $t){
                if(@$t->pivot->template_id == $template->id){
                    if(@$t->pivot->status-=1){
                        return back()->with("error", __("l.template")." ".__("l.pending"));
                    }
                }
            }

            if($website){
                // Delete website data
                foreach ($website->pages as $page){
                    $page->delete();
                }

                // Copy template general configurations
                $website->multi_lang    = $template->multi_lang;
                $website->default_lang  = $template->default_lang;
                $website->homepage      = $template->homepage;
                $website->topbar_type   = $template->topbar_type;
                $website->templatee_id  = $template->id;
                $website->save();

                // Copy pages data
                foreach ($template->pages as $page){
                    // Copy pages
                    $new_page                       = $page->replicate();
                    $new_page->client_id            = $client->id;
                    $new_page->website_id           = $website->id;
                    $new_page->user_id              = $user_id;
                    $new_page->slug                 = $this->create_slug();
                    $new_page->name                 = $page->name;
                    $new_page->content              = $page->content;
                    $new_page->name_en              = $page->name_en;
                    $new_page->content_en           = $page->content_en;
                    $new_page->status               = $page->status;
                    $new_page->default_content_ar   = $page->default_content_ar;
                    $new_page->default_content_en   = $page->default_content_en;
                    $new_page->html_content_ar      = $page->html_content_ar;
                    $new_page->html_content_en      = $page->html_content_en;
                    $new_page->save();

                    // Copy homepage
                    if($page->id==$template->homepage){
                        $website->homepage  = $new_page->id;
                        $website->save();
                    }

                }

                return redirect()->route("editor.edit", $website->id)->with("success", __("l.success_save"));
            }else{
                return redirect()->back();
            }
        }else{
         return redirect()->route("client.payments.template_payment", [$from_id, $to_id]);
        }
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
            $slug0  = rand(111, 999);
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

    public function get_page(){
        $url = @$_GET["url"];
        dd(file_get_contents($url));
        return $this->url_get_contents($url);
    }

    function url_get_contents ($Url) {
        if (!function_exists('curl_init')){
            die('CURL is not installed!');
        }

        $useragent = $_SERVER['HTTP_USER_AGENT'];
        $strCookie = 'PHPSESSID=' . $_COOKIE['laravel_session'] . '; path=/';
        $cookieFile = base_path("storage/framework/sessions/".$_COOKIE['laravel_session']);
        $cookieFileUrl = asset("storage/framework/sessions/".$_COOKIE['laravel_session']);
        if(!file_exists($cookieFile)) {
            $fh = fopen($cookieFile, "w");
            fwrite($fh, "");
            fclose($fh);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch,CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);

        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public function sluggable(Request $request){
        if(@$request->slug == "" or !$request->slug)
            return "OK";

        $website  = Website::where("slug", $request->slug)->whereNotNull("slug");
        if($request->id)
            $website = $website->where("id", "!=", $request->id);
        $website = $website->first();
        if($website)
            return "BAD SLUG";

        return "OK";
    }

    public function comments(){
        if(!cpermissions("comments_list"))
            return redirect()->route("client.settings.no_permissions");

        $client         = $this->client;
        $comments       = Comment::with("author", "page", "website")->where("client_id", $client->id)->orderby("created_at", "desc")->get();

        return view("client.comments.comments", compact("comments"));
    }

    public function change_comment_status($id = null, $status = 0){
        if(!cpermissions("comments_publish_draft"))
            return redirect()->route("client.settings.no_permissions");

        $client             = $this->client;
        $comment            = Comment::where(["id" => $id, "client_id" => $client->id])->first();
        if(!$comment)
            return back();

        $comment->status    = $status;
        $comment->save();

        return back()->with("success", __("l.success_save"));
    }

    public function delete_comment($id = null){
        if(!cpermissions("comments_delete"))
            return redirect()->route("client.settings.no_permissions");

        $client             = $this->client;
        $comment            = Comment::where(["id" => $id, "client_id" => $client->id])->first();
        if(!$comment)
            return back();

        $comment->delete();

        return back()->with("success", __("l.success_delete"));
    }

    public function update_comment(Request $request){
        if(!cpermissions("comments_update"))
            return redirect()->route("client.settings.no_permissions");

        $client             = $this->client;
        $comment            = Comment::where(["id" => $request->id, "client_id" => $client->id])->first();
        if(!$comment)
            return back();

        $comment->message   = $request->message;

        $comment->save();

        return back()->with("success", __("l.success_update"));
    }

    // First time add website

    public function categories(){
        $catgeories = CatgeoryWebsite::orderby("created_at", "desc")->get();

        return view("client.categories", compact("catgeories"));
    }

    public function category($id = null){
        $category = CatgeoryWebsite::find($id);
        if(!$category)
            return back();

        return view("client.category", compact("category"));
    }

    // Documentations

    public function documentations(){
        $categories         = CategoryDocumentation::with("documentations")->orderby("created_at", "asc")->get();
        $plan_id            = $this->client->plan_id;

        foreach ($categories as $category){
            $x              = 0;
            foreach ($category->documentations as $documentation){
                if($documentation->plans){
                    $plans  = explode(";", $documentation->plans);
                    if(!in_array($plan_id, $plans)){
                        $category->documentations->forget($x);
                    }
                }else{
                }
                $x++;
            }
        }

        $plans              = Plan::orderby("created_at", "asc")->get();

        return view("client.documentations.index", compact("categories", "plans"));
    }

    public function documentations_search(Request $request){
        $plan_id            = $this->client->plan_id;

        $result = [[]];
        if($request->q and $request->q != ""){
            $documentations = Documentation::where("question", "like" , "%".$request->q."%")->orderby("category_id")->get();
            foreach ($documentations as $documentation){
                $plans  = explode(";", $documentation->plans);
                if(in_array($plan_id, $plans)){
                    if(isset($result[$documentation->category_id]))
                        array_push($result[$documentation->category_id], $documentation->id);
                    else
                        $result[$documentation->category_id] = [$documentation->id];
                }
            }
        }
        return response()->json($result);

    }

    // Domains

    public function add_domain_step_1($id = null){
        $client_id  = @$this->client->id;
        $website    = Website::where(["id" => $id, "status" => 1, "client_id" => $client_id])->first();
        if(!$website)
            return back();

        return view("client.websites.domain.step1", compact("website"));
    }

    public function add_domain_step_2(Request $request){
        $client_id      = @$this->client->id;
        $website        = Website::where(["id" => $request->id, "status" => 1, "client_id" => $client_id])->first();
        if(!$website)
            return back();

        $websites       = Website::where("domain", $request->domain)->whereNotNull("domain")->count();
        if($websites > 0)
            return back()->with("error", "عذرا هذا الدومين مستعمل من قبل");

        if ( !checkdnsrr($request->domain.'.', 'ANY') )
            return back()->with("error", "عذرا هذا الدومين غير موجود");

        $domain = $request->domain;

        return view("client.websites.domain.step2", compact("website", "domain"));
    }

    public function add_domain_step_3(Request $request){
        $client_id      = @$this->client->id;
        $website        = Website::where(["id" => $request->id, "status" => 1, "client_id" => $client_id])->first();
        if(!$website)
            return back();

        $domain = $request->domain;

        $dns_result = dns_get_record($domain, DNS_CNAME);

        if(empty($dns_result))
            return response()->json(["error" => "مازال إسم الدومين غير مفعل", "data" => $dns_result]);
        if(isset($dns_result[0]["target"])){
            if($dns_result[0]["target"] == env("cname_sub_domain"))
                return response()->json(["success" => "تم التحقق من الإعدادات", "data" => $dns_result]);
            else{
                return response()->json(["error" => "مازال إسم الدومين غير مفعل", "data" => $dns_result]);
            }
        }
        return response()->json(["error" => "مازال إسم الدومين غير مفعل", "data" => $dns_result]);
    }

    public function add_domain_step_4(Request $request){
        $client_id      = @$this->client->id;
        $website        = Website::where(["id" => $request->id, "status" => 1, "client_id" => $client_id])->first();
        if (!$website)
            return back();

        $domain         = $request->domain;
        $old_url        = env("client_sub_domain")."/".$website->slug;

        $blocks         = PageBlock::where("website_id", $website->id)->get();
        $blocks_ids     = [];
        foreach ($blocks as $block)
            array_push($blocks_ids, $block->id);
        //
        $metas          = PageBlockMeta::whereIn("block_id", $blocks_ids)->where("value", "like", "%".$old_url."%")->get();
        foreach ($metas as $meta){
            $meta->value = str_replace($old_url, $domain, $meta->value);
            $meta->save();
        }
        //
        $menus          = Menu::where("website_id", $website->id)->where("link0", "like", "%".$old_url."%")->get();
        foreach ($menus as $menu){
            $menu->link0 = str_replace($old_url, $domain, $menu->link0);
            $menu->save();
        }
        $sliders        = Slider::where("website_id", $website->id)->where("image", "like", "%".$old_url."%")->get();
        foreach ($sliders as $slider){
            $slider->image = str_replace($old_url, $domain, $slider->image);
            $slider->save();
        }
        //
        $sliders        = Slider::where("website_id", $website->id)->where("link0", "like", "%".$old_url."%")->get();
        foreach ($sliders as $slider){
            $slider->link0 = str_replace($old_url, $domain, $slider->link0);
            $slider->save();
        }
        $posts          = Post::whereIn("block_id", $blocks_ids)->where("image", "like", "%".$old_url."%")->get();
        foreach ($posts as $post){
            $post->image = str_replace($old_url, $domain, $post->image);
            $post->save();
        }
        //
        $posts          = Post::whereIn("block_id", $blocks_ids)->where("link0", "like", "%".$old_url."%")->get();
        foreach ($posts as $post){
            $post->link0 = str_replace($old_url, $domain, $post->link0);
            $post->save();
        }

        $website->domain = $request->domain;
        $website->save();

        return redirect()->route("client.websites.index")->with("success", "تم تحويل الدومين الجديد للموقع");
    }

}
