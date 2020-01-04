<?php

namespace App\Http\Controllers\Common;

use App\FormData;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\RegistersUsers;
use Hash;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Validator;
use Illuminate\Http\Request;
use View;
use Auth;
use Config;
use App\Client;
use App\ClientUser;
use App\Page;
use App\PageBlock;
use App\PageBlockMeta;
use App\Post;
use App\Category;
use App\ClientSetting;
use App\Menu;
use App\Slider;
use App\Website;
use App\Plan;
use App\Visitor;
use App\Form;
use App\Comment;
use VisitLog;
use App\PluginData;

class WebsiteController extends Controller
{
    use RegistersUsers;
    use SendsPasswordResetEmails;
    use ResetsPasswords;

    public $client = null;
    public $frontLang = null;
    public $website = null;
    public $slug = null;
    public $client_settings = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        date_default_timezone_set('Asia/Riyadh');
        $this->middleware("guest:visitor")->only("login", "do_login", "showRegistrationForm", "showLinkRequestForm", "showResetForm", "register", "sendResetLinkEmail", "reset");
        $this->middleware(function($request,$next) {
            $slug               = request("slug");
            $this->slug         = $slug;
            $website            = Website::where("slug", $slug)->first();
            if(!$website)
                return abort("404");

            $this->website      = $website;
            $client             = Client::find($website->client_id);
            if(!$client)
                return abort("404");
            $this->client       = $client;

            if($website->status == 0)
                return abort("405");

            $frontLang          = request("frontLang");
            if(!$frontLang)
                $frontLang      = $this->website->default_lang;
            $this->frontLang    = $frontLang;

            if($website->multi_lang != 1 and $website->default_lang != $frontLang)
                abort(404);
            \App::setlocale($frontLang);
            View::share("website", $website);
            /*

            if($this->website->domain and request()->getHost() == $this->website->domain)
                Config::set('session.domain', ".".$this->website->domain);
            else
                Config::set('session.domain', env("SESSION_DOMAIN"));

            View::share("client", $client);
            $settings           = ClientSetting::where("client_id", $client->id)->get()->keyBy("key");
            View::share("settings", $settings);

            $this->my_plugins   = $client->my_plugins->KeyBy("id");
            View::share("my_plugins", $this->my_plugins);


            View::share("frontLang", $frontLang);
            View::share("lang", $frontLang);
            View::share("topbar_type", $website->topbar_type);
            View::share("homepage", $website->homepage);

            $menus              = Menu::with("children")->where(["client_id" => $client->id, "lang" => $frontLang, "parent_id" => 0, "website_id" => $website->id])->orderby("order")->get();
            $sliders            = Slider::where(["client_id" => @$client->id, "lang" => $frontLang, "website_id" => $website->id])->orderby("order", "asc")->get();
            View::share("menus", $menus);
            View::share("sliders", $sliders);

            View::share("footer_type", $website->footer_type);
            $footer      = PageBlock::with(["metas"=>function($q)use($frontLang){return $q->where("language", $frontLang);}])
                ->where(["type" => "footer", "client_id" => $client->id, "lang" => $frontLang, "website_id" => $website->id])->first();
            if($footer and @$footer->metas){
                $footer->metask = $footer->metas->keyby("key");
                foreach ($footer->metask as $meta){
                    $meta->metask = $meta->metas->keyby("key");
                }
            }
            $footer_links   = Post::where(["block_id"=>@$footer->id, "client_id"=>@$client->id, "language" => $frontLang])->orderby("order", "asc")->get();
            View::share("footer", $footer);
            View::share("footer_links", $footer_links);

            $logo = ($website->logo)?($client->id!=1)?$website->logo:asset("storage/app/".$website->logo):asset("public/logo.jpg");
            View::share("logo", $logo);

            $settings           = ClientSetting::where("client_id", $client->id)->get()->keyBy("key");
            $this->client_settings= $settings;
            View::share("settings", $settings);

            $plugin_datas       = PluginData::with("website")->where(["client_id" => $client->id, "website_id" => $website->id, "status" => 1])->get()->keyby("plugin_id");
            View::share("plugin_datas", $plugin_datas);
            */
            return $next($request);
        });
    }

    public function setLocal(){
        $slug       = $this->slug;
        $language   = request("local");
        $url        = url()->previous();
        $url        = str_replace("/ar", "/".$language, $url);
        $url        = str_replace("/en", "/".$language, $url);
        return redirect($url);
    }

    /**
     * Home page
     * @return the view of the home page
     */
    public function index(){
        VisitLog::save(@$this->website->id);
        $slug       = $this->slug;
        $lang       = $this->frontLang;
        $client_id  = @$this->website->client_id;
        $page       = Page::where(["id"=>$this->website->homepage, "client_id"=>@$this->client->id])->first();


        if(!$page){
            return view("website.no_homepage");
        }else{
            return view("website.page", compact("page", "header", "lang"));
        }
    }

    /**
     * Show cms page
     * @params page id $id
     * @return the view of the cms page
     */

    public function page(){
        $slug           = $this->slug;
        $lang           = $this->frontLang;
        $id             = request("id");
        VisitLog::save(@$this->website->id);
        $client_id      = @$this->website->client_id;
        $page           = Page::where(["id" => $id, "client_id" => $client_id])->first();
        if(!$page)
            $page       = Page::where(["slug"=>$id, "client_id"=>@$this->client->id])->first();

        if(!$page)
            return abort("404");

        $images = null;
        /*$ch     = curl_init(route("image_api"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $data   = curl_exec($ch);
        curl_close($ch);
        $data   = json_decode($data);
        $images = @$data->images;*/

        return view("website.page", compact("page","lang", "images"));
    }

















    public function page______________old(){
        $slug       = $this->slug;
        $l          = $this->frontLang;
        $id         = request("id");
        VisitLog::save(@$this->website->id);
        $client_id = @$this->website->client_id;
        $host = request()->getHost();
        if($client_id != 1 and $host == env("admin_sub_domain"))
            return redirect(str_replace(env("admin_sub_domain"), env("client_sub_domain"), route("website.page", [$slug, $l, $id])));
        if($client_id == 1 and $host == env("client_sub_domain"))
            return redirect(str_replace(env("client_sub_domain"), env("admin_sub_domain"), route("website.page", [$slug, $l, $id])));

        $page = Page::with(["blocks.metas"=>function($q)use($l){return $q->where("language", $l);}])->where(["id"=>$id, "client_id"=>@$this->client->id])->first();
        if(!$page)
            $page = Page::with(["blocks.metas"=>function($q)use($l){return $q->where("language", $l);}])->where(["slug"=>$id, "client_id"=>@$this->client->id])->first();

        if(!$page)
            return abort("404");

        if($page->status==0){
            if($page->client_id==1 and !Auth::guard("web")->check()){
                return abort("403");
            }

            if($page->client_id!=1 and !Auth::guard("client")->check())
                return abort("403");
        }

        foreach ($page->blocks as $block){
            $block->custom_form             = null;
            $block->metask = $block->metas->keyby("key");
            foreach ($block->metask as $meta){
                $meta->metask               = $meta->metas->keyby("key");
                if($meta->key == "choose_form" and $meta->value!="0"){
                    $client_id              = $this->client->id;
                    $block->custom_form     = Form::with(["fields"=>function ($req) use($client_id) {return $req->where("client_id", $client_id)->orderby("order", "asc");}])->where("client_id", $client_id)->where("id", $meta->value)->first();
                }
            }
            if(in_array($block->type, ["team", "products", "testimonials", "blog", "faq", "partners", "portfolio", "icons", "how_it_works",  "features", "gallery", "slider", "pricing"])){
                $posts          = Post::where(["block_id"=>$block->id, "client_id"=>@$this->client->id, "language" => $l])->orderby("order", "asc")->get();
                $block->posts   = $posts;
                $categories     = Category::where(["block_id"=>$block->id, "client_id"=>@$this->client->id, "language" => $l])->orderby("id", "asc")->get();
                $block->categories = $categories;
            }
        }
        $header      = PageBlock::where(["type" => "header", "client_id" => @$this->client->id, "lang" => $l, "page_id" => $page->id, "status" => 1])->first();

        return view("cms.page", compact("page", "header"));
    }

    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    /**
     * get external images to Tinymce image editor
     *
     * @return string
     */
    public function proxy(){
        $validMimeTypes = array("image/gif", "image/jpeg", "image/png");

        if (!isset($_GET["url"]) || !trim($_GET["url"])) {
            header("HTTP/1.0 500 Url parameter missing or empty.");
            return;
        }

        $scheme = parse_url($_GET["url"], PHP_URL_SCHEME);
        if ($scheme === false || in_array($scheme, array("http", "https")) === false) {
            header("HTTP/1.0 500 Invalid protocol.");
            return;
        }

        $content = file_get_contents($_GET["url"]);
        $info = getimagesizefromstring($content);

        if ($info === false || in_array($info["mime"], $validMimeTypes) === false) {
            header("HTTP/1.0 500 Url doesn't seem to be a valid image.");
            return;
        }

        header('Content-Type:' . $info["mime"]);
        echo $content;
    }

    /**
     * Get Images from admin api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function image_list(){
        $ch     = curl_init(route("image_api"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data   = curl_exec($ch);
        curl_close($ch);
        $data   = json_decode($data);
        $images = [];
        foreach($data->images as $image):
        array_push($images, ["title" => $image->name_ar, "value" => $image->url]);
        endforeach;

        return response()->json($images);
    }

    // Authentication Routes...

    public function login(Request $request){
        $slug = $this->slug;
        $l = $request->frontLang;
        $website            = Website::where(["id"=>@$this->website->id, "client_id"=>@$this->client->id])->first();

        if($this->website->domain and request()->getHost() == $this->website->domain){
            if(\Request::route()->getName() == "website.login")
                return  redirect()->route("domain.login", [$l]);
        }

        if(!@$this->client_settings["enable_register_visitors"] or @$this->client_settings["enable_register_visitors"]->value == "0")
            return abort("404");

        if($website){
            $page           = new \stdClass();
            $page->name     = __("l.login");
            $page->name_en  = __("l.login");
            return view("cms2.auth.login", compact("page", "l"));
        }else{
            return abort("404");
        }
    }

    public function do_login(Request $request){

        $request->validate([
            'email'     => 'required|string',
            'password'  => 'required|string',
        ]);
        $credentials    = ['email' => $request->email, 'password' => $request->password
            , "client_id" => @$this->client->id, "website_id" => @$this->website->id];
        $visitor        = Visitor::where("email", $request->email)->first();

        if(!$visitor or !$visitor->client or !$visitor->website or @$visitor->client->status!=1){
            throw ValidationException::withMessages(['email' => [trans('auth.failed')]]);
        }
        if(Auth::guard("visitor")->attempt($credentials, $request->filled('remember'))){
            if($this->website->domain and request()->getHost() == $this->website->domain){
                Config::set('session.domain', $this->website->domain);
                return redirect()->route("domain.visitor.profile", request("frontLang"));
            }
            return redirect()->route("visitor.profile", request("frontLang"));
        }else{
            throw ValidationException::withMessages(['email' => [trans('auth.failed')]]);
        }
    }

    public function showRegistrationForm(){
        $frontLang          = $this->frontLang;
        $website            = Website::where(["id"=>@$this->website->id, "client_id"=>@$this->client->id])->first();

        if(!@$this->client_settings["enable_register_visitors"] or @$this->client_settings["enable_register_visitors"]->value == "0")
            return abort("404");

        if($website){
            $page           = new \stdClass();
            $page->name     = __("l.register");
            $page->name_en  = __("l.register");
            return view("cms.auth.register", compact("page"));
        }else{
            return abort("404");
        }
    }

    public function showLinkRequestForm(){
        $frontLang          = $this->frontLang;
        $website            = Website::where(["id"=>@$this->website->id, "client_id"=>@$this->client->id])->first();
        $l = $frontLang;

        if($website){
            $page           = new \stdClass();
            $page->name     = __("l.reset_password");
            $page->name_en  = __("l.reset_password");
            return view("cms2.auth.passwords.email", compact("page", "l"));
        }else{
            return abort("404");
        }
    }

    public function showResetForm(){
        $token              = request("token");
        $frontLang          = $this->frontLang;
        $website            = Website::where(["id"=>@$this->website->id, "client_id"=>@$this->client->id])->first();
        $l = $frontLang;
        if($website){
            $page           = new \stdClass();
            $page->name     = __("l.reset_password");
            $page->name_en  = __("l.reset_password");
            return view("cms2.auth.passwords.reset", compact("page", "l"))->with(['token' => $token]);
        }else{
            return abort("404");
        }
    }

    public function sendResetLinkEmail(Request $request){
        $request->validate(['email' => 'required|email']);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    public function broker()
    {
        return Password::broker("visitors");
    }

    protected function credentials(Request $request){
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }

    protected function guard()
    {
        return "visitor";
    }

    protected function resetPassword($user, $password){
        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));

        Auth::guard("visitor")->login($user);
    }

    protected function reset(Request $request){
        $request->validate($this->rules(), $this->validationErrorMessages());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
            $this->resetPassword($user, $password);
        }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:visitors'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return Visitor::create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
            "client_id"     => $data["client_id"],
            "website_id"    => $data["website_id"],
        ]);
    }

    public function register(Request $request)
    {
        $request->merge(["client_id" => @$this->client->id, "website_id" => @$this->website->id, "frontLang" => request("frontLang")]);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:visitors'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if(!$this->client_settings or !@$this->client_settings["visitor_activation_method"] or @$this->client_settings["visitor_activation_method"]->value == "0"){

            $user = $this->create($request->all());
            $user->status = 1;
            $user->save();
        }else{
            $user = $this->create($request->all());
            $user->status = 0;
            $user->save();
            $user->sendEmailVerificationNotification();
        }
        Auth::guard("visitor")->login($user);

        if($this->website->domain and request()->getHost() == $this->website->domain){
            return redirect()->route("domain.visitor.profile", $request->frontLang);
        }
        return redirect()->route("visitor.profile", $request->frontLang);

    }

    public function contact_us(Request $request){
        $message                = new Message;
        $message->client_id     = $this->client->id;;
        $message->website_id    = $this->website->id;;
        $message->name          = $request->name;
        $message->email         = $request->email;
        $message->subject       = $request->subject;
        $message->message       = $request->message;
        $message->save();

        return back()->with("success", __("l.success_send"));
    }

    public function save_custom_form(Request $request){
        $formData               = new FormData;
        $formData->client_id    = $this->client->id;
        $formData->website_id   = $this->website->id;
        $formData->form_id      = $request->form_id;
        $formData->name         = $request->name;
        $formData->email        = $request->email;
        $formData->values       = "";
        $formData->save();

        $values = [];
        foreach ($request->all() as $k => $v) {
            if (strpos($k, 'field_') !== false) {
                $form_field_id = str_replace("field_", "", $k);
                if($request->hasFile($k)){
                    $paths = [];
                    foreach ($request->$k as $file){
                        $path   = $file->store("uploads/clients/".@$this->client->id);
                        array_push($paths, $path);
                    }
                    $value = implode(";", $paths);
                }
                else if (is_array($v)) {
                    $value = implode(";", $v);
                }else{
                    $value = $v;
                }
                $arr = [$form_field_id => $value];
                array_push($values, $arr);
            }
        }
        $formData->values = serialize($values);
        $formData->save();

        return back()->with("success", __("l.success_send"));
    }

    public function save_comment(Request $request){
        $frontLang  = $this->frontLang;
        $client_id  = $this->client->id;
        $id         = request("post_id");
        $post = Post::where(["id"=>$id, "client_id"=>$client_id, "language" => $frontLang])->first();
        if(!$post)
            return back();

        $page = Page::with(["blocks.metas"=>function($q)use($frontLang){return $q->where("language", $frontLang);}])->where(["id"=>$post->page_id, "client_id"=>$client_id])->first();
        if(!$page)
            $page = Page::with(["blocks.metas"=>function($q)use($frontLang){return $q->where("language", $frontLang);}])->where(["slug"=>$post->page_id, "client_id"=>$client_id])->first();
        if(!$page)
            return abort("404");

        $comment                = new Comment;
        $comment->client_id     = $client_id;
        $comment->website_id    = $page->website_id;
        $comment->page_id       = $page->id;
        $comment->post_id       = $id;
        if(Auth::guard("visitor")->check())
            $comment->visitor_id = Auth::guard("visitor")->user()->id;
        $comment->name          = $request->name;
        $comment->message       = $request->message;
        $comment->ip            = $request->ip();
        $comment->status        = 0;
        $comment->save();

        return back()->with("success", __("l.success_send"));
    }


    public function index2(){

        VisitLog::save(@$this->website->id);
        $slug = $this->slug;
        $l = $this->frontLang;

        $client_id = @$this->website->client_id;
        $host = request()->getHost();
        if($client_id != 1 and $host == env("admin_sub_domain"))
            return redirect(str_replace(env("admin_sub_domain"), env("client_sub_domain"), route("website.index2", [$slug, $l])));
        if($client_id == 1 and $host == env("client_sub_domain"))
            return redirect(str_replace(env("client_sub_domain"), env("admin_sub_domain"), route("website.index2", [$slug, $l])));

        $page               = Page::with(["blocks.metas"=>function($q)use($l){return $q->where("language", $l);}])
            ->where(["id"=>$this->website->homepage, "client_id"=>@$this->client->id])->first();
        if(!$page){
            $page           = new \stdClass();
            $page->name     = __("l.home");
            $page->name_en  = __("l.home");
            return view("cms.home", compact("page"));
        }else{
            return view("cms2.page2", compact("page", "l"));
        }
    }

    public function page2(){
    $slug       = $this->slug;
    $l          = $this->frontLang;
    $id         = request("id");
    VisitLog::save(@$this->website->id);
    $client_id = @$this->website->client_id;
    $page = Page::with(["blocks.metas"=>function($q)use($l){return $q->where("language", $l);}])->where(["id"=>$id, "client_id"=>@$this->client->id])->first();
    if(!$page)
        $page = Page::with(["blocks.metas"=>function($q)use($l){return $q->where("language", $l);}])->where(["slug"=>$id, "client_id"=>@$this->client->id])->first();

    if(!$page)
        return abort("404");

    $ch     = curl_init(route("image_api"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    $data   = curl_exec($ch);
    curl_close($ch);
    $data   = json_decode($data);
    $images = @$data->images;

    return view("cms2.page2", compact("page","l", "images"));
}

    /**
     * Show product page
     * @params Post:id $id
     * @return View
     */
    public function product(){
        $slug       = $this->slug;
        $l          = $this->frontLang;
        $id         = request("post_id");
        if($this->website->domain and request()->getHost() == $this->website->domain){
            if(\Request::route()->getName() == "website.product")
                return  redirect()->route("domain.product", [$l, $id]);
        }

        VisitLog::save(@$this->website->id);

        $product = Post::where(["id"=>$id, "client_id"=>@$this->client->id, "language" => $l])->first();
        if(!$product)
            return back();

        $page = Page::with(["blocks.metas"=>function($q)use($l){return $q->where("language", $l);}])->where(["id"=>$product->page_id, "client_id"=>@$this->client->id])->first();
        if(!$page)
            $page = Page::with(["blocks.metas"=>function($q)use($l){return $q->where("language", $l);}])->where(["slug"=>$product->page_id, "client_id"=>@$this->client->id])->first();

        if(!$page)
            return abort("404");

        $page->name = $product->name;

        return view("cms.product", compact("product", "page"));
    }

    /**
     * Show post page
     * @params Post:id $id
     * @return View
     */
    public function post(){
        $slug       = $this->slug;
        $l          = $this->frontLang;
        $id         = request("post_id");
        if($this->website->domain and request()->getHost() == $this->website->domain){
            if(\Request::route()->getName() == "website.post")
                return  redirect()->route("domain.post", [$l, $id]);
        }
        VisitLog::save(@$this->website->id);

        $post = Post::where(["id"=>$id, "client_id"=>@$this->client->id, "language" => $l])->first();
        if(!$post)
            return back();

        $page = Page::with(["blocks.metas"=>function($q)use($l){return $q->where("language", $l);}])->where(["id"=>$post->page_id, "client_id"=>@$this->client->id])->first();
        if(!$page)
            $page = Page::with(["blocks.metas"=>function($q)use($l){return $q->where("language", $l);}])->where(["slug"=>$post->page_id, "client_id"=>@$this->client->id])->first();

        if(!$page)
            return abort("404");

        $posts = Post::where(["page_id"=>$page->id, "client_id"=>@$this->client->id, "language" => $l, "type" => "blog"])->get();
        $comments       = Comment::with("author")->where("client_id", @$this->client->id)->where("post_id", $id)->where("status", 1)->orderby("created_at", "desc")->get();

        return view("cms.post", compact("post", "page", "posts", "comments"));
    }

    public function block($cid = 1, $lang = "ar", $section = "", $blockk = ""){
        if($section == "" or $blockk == ""){
            return abort("404");
        }
        $block       = PageBlock::where(["client_id" =>1, "page_id" => 1, "type" => $section, "block" => $blockk])->first();
        if(!$block)
            return "!!!";

        $website            = Website::where(["id" => 1, "client_id" => 1])->first();
        if(!$website)
            return "!!!";

        $block->custom_form             = null;
        $block->metask = $block->metas->keyby("key");
        foreach ($block->metask as $meta){
            $meta->metask               = $meta->metas->keyby("key");
            if($meta->key == "choose_form" and $meta->value!="0"){
                $block->custom_form     = Form::with(["fields"=>function ($req) use($client_id) {return $req->where("client_id", 1)->orderby("order", "asc");}])->where("client_id", 1)->where("id", $meta->value)->first();
            }
        }
        if(in_array($block->type, ["team", "products", "testimonials", "blog", "faq", "partners", "portfolio", "icons", "how_it_works", "features", "gallery", "slider", "pricing"])){
            $posts          = Post::where(["block_id"=>$block->id, "client_id"=>1, "language" => $lang])->orderby("order", "asc")->get();
            $block->posts   = $posts;
            $categories     = Category::where(["block_id"=>$block->id, "client_id"=>1, "language" => $lang])->orderby("id", "asc")->get();
            $block->categories = $categories;
        }

        $title = __("l.a.".$section)." ".$blockk;
        $sliders            = Slider::where(["client_id" => 1, "lang" => $lang, "website_id" => 1])->orderby("order", "asc")->get();

        return view("cms.block", compact("section", "blockk", "block", "lang", "website", "title", "sliders"));
    }

    public function save_newsletter(Request $request)
    {
        $request->validate(["email" => "email|unique:newsletters"]);

        $newsletter             = new Newsletter;
        $newsletter->client_id  = $this->client->id;
        $newsletter->website_id = $this->website->id;
        $newsletter->name       = $request->name;
        $newsletter->email      = $request->email;
        $newsletter->phone      = $request->phone;
        $newsletter->save();

        return back()->with("success", __("l.success_save"));
    }

    public function update_meta(Request $request){
        $meta           = PageBlockMeta::find($request->id);
        $meta->value    = $request->value;
        $meta->save();
    }

    public function update_post_title(Request $request){
        $post               = Post::find($request->id);
        $post->name         = $request->value;
        $post->save();
    }

    public function update_post_dsecription(Request $request){
        $post                   = Post::find($request->id);
        $post->dsecription      = $request->value;
        $post->save();
    }

    public function update_post_other(Request $request){
        $post                   = Post::find($request->id);
        $post->other            = $request->value;
        $post->save();
    }

    public function update_post_other2(Request $request){
        $post                   = Post::find($request->id);
        $post->other2           = $request->value;
        $post->save();
    }

    public function update_post_pricing1(Request $request){
        $post                   = Post::find($request->id);
        $post->pricing1         = $request->value;
        $post->save();
    }

    public function update_post_pricing2(Request $request){
        $post                   = Post::find($request->id);
        $post->pricing2         = $request->value;
        $post->save();
    }

    public function update_post_pricing3(Request $request){
        $post                   = Post::find($request->id);
        $post->pricing3         = $request->value;
        $post->save();
    }

    public function update_post_pricing4(Request $request){
        $post                   = Post::find($request->id);
        $post->pricing4         = $request->value;
        $post->save();
    }

    public function update_post_pricing5(Request $request){
        $post                   = Post::find($request->id);
        $post->pricing5         = $request->value;
        $post->save();
    }

    public function update_post_pricing6(Request $request){
        $post                   = Post::find($request->id);
        $post->pricing6         = $request->value;
        $post->save();
    }

    public function update_post_pricing7(Request $request){
        $post                   = Post::find($request->id);
        $post->pricing7         = $request->value;
        $post->save();
    }

    public function update_post_pricing8(Request $request){
        $post                   = Post::find($request->id);
        $post->pricing8         = $request->value;
        $post->save();
    }

    public function delete_post(){
        $slug       = $this->slug;
        $l          = $this->frontLang;
        $id         = request("id");
        $post = Post::where(["id"=>$id, "client_id"=>@$this->client->id])->first();
        if(!$post)
            return;

        if($post->image){
            $x = str_replace([$slug, "/".$l], "", route("website.index2", [$slug, $l]));
            $path = base_path(str_replace($x, "", $post->image));
            $path = str_replace("//storage", "/storage", $path);
            if(file_exists($path) and is_file($path))
                unlink($path);
        }

        $post->delete();
    }

    public function duplicate_post(){
        $slug       = $this->slug;
        $l          = $this->frontLang;
        $id         = request("id");
        $post = Post::where(["id"=>$id, "client_id"=>@$this->client->id])->first();
        if(!$post)
            return;

        $new_post = $post->replicate();
        $new_post->save();
    }

    public function move_less_post(){
        $slug       = $this->slug;
        $l          = $this->frontLang;
        $id         = request("id");
        $post = Post::where(["id"=>$id, "client_id"=>@$this->client->id])->first();
        if(!$post)
            return;

        $order = $post->order;
        $order--;
        $post->order = $order;
        $post->save();
    }

    public function move_more_post(){
        $slug       = $this->slug;
        $l          = $this->frontLang;
        $id         = request("id");
        $post = Post::where(["id"=>$id, "client_id"=>@$this->client->id])->first();
        if(!$post)
            return;

        $order = $post->order;
        $order++;
        $post->order = $order;
        $post->save();
    }

}
