<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use App\Ticket;
use Carbon\Carbon as Carbon;
use App\ImageCatgeory;
use App\Image;
use App\VideoCategory;
use App\Video;
use App\CatgeoryWebsite;
use App\Website;
use Auth;
use App\Message2;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        date_default_timezone_set('Asia/Riyadh');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $page_title     = "الرئيسية";
        $page_num       = 1;
        $catgeories     = CatgeoryWebsite::withCount("templates")->orderby("created_at", "asc")->get();
        $websites       = Website::withCount("pages")->where("client_id", 1)->orderby("created_at", "desc")->get();

        return view('front.index', compact("page_title", "page_num", "catgeories", "websites"));
    }

    public function about_us(){
        $page_title = "من نحن";
        $page_num = 2;

        return view('front.about_us', compact("page_title", "page_num"));
    }

    public function wizard(){
        $page_title = "تصنيف موقعك";
        $inernal = true;
        $catgeories = CatgeoryWebsite::orderby("created_at", "asc")->get();

        return view('front.wizard', compact("page_title", "inernal", "catgeories"));
    }

    public function templates(){
        $page_title = "القوالب";
        $page_num = 4;
        $catgeories     = CatgeoryWebsite::withCount("templates")->orderby("created_at", "asc")->get();
        $websites       = Website::withCount("pages")->where("client_id", 1)->orderby("created_at", "desc")->get();

        return view('front.templates', compact("page_title", "page_num", "catgeories", "websites"));
    }

    public function contact_us(){
        $page_title = "إتصل بنا";
        $page_num = 5;

        return view('front.contact_us', compact("page_title", "page_num"));
    }

    public function login(){
        $page_title = "تسجيل الدخول";

        return view('front.login', compact("page_title"));
    }

    public function logout(Request $request){
        Auth::guard("client")->logout();
        $request->session()->forget("client");

        return redirect()->route("login");
    }

    public function register(){
        $page_title = "التسجيل";

        return view('front.register', compact("page_title"));
    }

    public function policy(){
        $page_title = "الشروط و الأحكام";

        return view('front.policy', compact("page_title"));
    }

    public function how_it_works(){
        $page_title = "كيف نعمل";
        $page_num = 3;

        return view('front.how_it_works', compact("page_title", "page_num"));
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

    public function contact_us_send(Request $request){
        $message            = new Message2;
        $message->name      = $request->name;
        $message->email     = $request->email;
        $message->subject   = $request->subject;
        $message->message   = $request->message;
        $message->save();

        return back()->with("success", "تم الإرسال بنجاح");
    }



    public function editor(){
        return view('editor');
    }

    public function locale($locale = "ar"){
        Session::put('locale', $locale);
        return redirect()->back();
    }

    public function cronjob_close_ticket(){
        $settings           = Setting::all()->keyby("key");
        $ticket_lifetime    = (@$settings["ticket_lifetime"]) ? @$settings["ticket_lifetime"]->value : 6;
        $today              = Carbon::now();
        $date               = $today->subDays(intval($ticket_lifetime));
        $tickets        = Ticket::with("replies")->where("status", 0)->orderby("created_at", "desc")->get()->keyby("id");
        foreach ($tickets as $ticket){
            $dates = [$ticket->created_at];
            foreach ($ticket->replies as $reply)
                array_push($dates, $reply->created_at);
            if($date > max($dates)){
                $ticket->status = 1;
                $ticket->save();
            }
        }
    }

    public function image_api(){
        $image_categories   = ImageCatgeory::get();
        $images             = Image::with("category");
        $lang = "ar";
        if(isset($_GET["lang"]))
            $lang = $_GET["lang"];
        if(isset($_GET["name"]))
            $images         = $images->where("name_".$lang, "like", "%".$_GET["name"]."%");
        if(isset($_GET["category_id"]))
            $images         = $images->where("category_id", $_GET["category_id"]);
        $images             = $images->get();
        $data               = ["images" => $images, "categories" => $image_categories];
        return response($data, 200);
    }

    public function video_api(){
        $video_categories   = VideoCategory::get();
        $videos             = Video::with("category");
        $lang = "ar";
        if(isset($_GET["lang"]))
            $lang = $_GET["lang"];
        if(isset($_GET["name"]))
            $videos         = $videos->where("name_".$lang, "like", "%".$_GET["name"]."%");
        if(isset($_GET["category_id"]))
            $videos         = $videos->where("category_id", $_GET["category_id"]);
        $videos             = $videos->get();
        $data               = ["videos" => $videos, "categories" => $video_categories];
        return response($data, 200);
    }

}
