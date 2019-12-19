<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;
use App\CatgeoryWebsite;
use App\Website;

class TemplatesController extends AdminBaseController
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

    // Templates

    /**
     * Show the templates list
     *
     * @return View
     */
    public function index(){
        if(!permissions("templates_index"))
            return redirect()->route("admin.settings.no_permissions");

        $catgeories = CatgeoryWebsite::withCount("templates")->orderby("created_at", "asc")->get();
        $websites   = Website::withCount("pages")->where("client_id", 1)->orderby("created_at", "desc")->get();

        return view('admin.templates.index', compact("catgeories", "websites"));
    }

    /**
     * Show the templates add form
     *
     * @return View
     */
    public function add(){
        if(!permissions("templates_add"))
            return redirect()->route("admin.settings.no_permissions");

        $catgeories = CatgeoryWebsite::orderby("created_at", "asc")->get();

        return view('admin.templates.add', compact("catgeories"));
    }

    /**
     * Add template
     * @param Request $request
     * @return Response
     */
    public function save(Request $request){
        if(!permissions("templates_add"))
            return redirect()->route("admin.settings.no_permissions");

        if($request->hasFile("logo")){
            $request->validate(["logo" => "image"]);
        }
        $request->validate(["image" => "image|required", "image_ipad" => "image|required", "image_mobile" => "image|required"]);

        $website                    = new Website;
        $website->client_id         = 1;
        $website->category_id       = $request->category_id;
        if($request->slug){
            $slug0                  = str_replace(" ", "_", trim($request->slug));
            $websitex               = Website::where("slug", $slug0)->first();
            if($websitex)
                return redirect()->back()->with("error", __("l.website_slug_error"));
            $website->slug          = $slug0;
        }
        $website->name_ar           = $request->name_ar;
        $website->name_en           = $request->name_en;
        $website->description_ar    = $request->description_ar;
        $website->description_en    = $request->description_en;
        if($request->hasFile("logo"))
            $website->logo          = $request->logo->store("uploads");
        if($request->hasFile("image"))
            $website->image         = $request->image->store("uploads");
        if($request->hasFile("image_ipad"))
            $website->image_ipad    = $request->image_ipad->store("uploads");
        if($request->hasFile("image_mobile"))
            $website->image_mobile  = $request->image_mobile->store("uploads");
        if($request->price==0 and $request->has("the_price"))
            $website->price         = $request->the_price;
        else
            $website->price         = null;
        $website->save();

        return redirect()->route("admin.templates.index")->with("success", "تم إضافة البيانات بنجاح");
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

    /**
     * Add template
     * @param Request $request
     * @return Response
     */
    public function update(Request $request){
        if(!permissions("templates_edit"))
            return redirect()->route("admin.settings.no_permissions");

        if($request->hasFile("logo")){
            $request->validate(["logo" => "image"]);
        }
        if($request->hasFile("image")){
            $request->validate(["image" => "image"]);
        }
        if($request->hasFile("image_ipad")){
            $request->validate(["image_ipad" => "image"]);
        }
        if($request->hasFile("image_mobile")){
            $request->validate(["image_mobile" => "image"]);
        }

        $website                    = Website::find($request->id);
        if(!$website)
            return back();

        $website->category_id       = $request->category_id;
        if($request->slug){
            if($request->slug){
                $slug0                  = str_replace(" ", "_", trim($request->slug));
                $websitex               = Website::where("slug", $slug0)->where("id", "!=", $request->id)->first();
                if($websitex)
                    return redirect()->back()->with("error", __("l.website_slug_error"));
                $website->slug          = $slug0;
            }
        }
        $website->name_ar           = $request->name_ar;
        $website->name_en           = $request->name_en;
        $website->description_ar    = $request->description_ar;
        $website->description_en    = $request->description_en;
        if($request->hasFile("logo")){
            if($website->logo and file_exists(storage_path("app/".$website->logo)) and is_file(storage_path("app/".$website->logo))){
                unlink(storage_path("app/".$website->logo));
            }
            $website->logo          = $request->logo->store("uploads");
        }
        if($request->hasFile("image")){
            if($website->image and file_exists(storage_path("app/".$website->image)) and is_file(storage_path("app/".$website->image))){
                unlink(storage_path("app/".$website->image));
            }
            $website->image          = $request->image->store("uploads");
        }
        if($request->hasFile("image_ipad")){
            if($website->image_ipad and file_exists(storage_path("app/".$website->image_ipad)) and is_file(storage_path("app/".$website->image_ipad))){
                unlink(storage_path("app/".$website->image_ipad));
            }
            $website->image_ipad          = $request->image_ipad->store("uploads");
        }
        if($request->hasFile("image_mobile")){
            if($website->image_mobile and file_exists(storage_path("app/".$website->image_mobile)) and is_file(storage_path("app/".$website->image_mobile))){
                unlink(storage_path("app/".$website->image_mobile));
            }
            $website->image_mobile          = $request->image_mobile->store("uploads");
        }
        if($request->price==0 and $request->has("the_price"))
            $website->price         = $request->the_price;
        else
            $website->price         = null;
        $website->save();

        return redirect()->route("admin.templates.index")->with("success", "تم تعديل البيانات بنجاح");
    }

    /**
     * Delete template
     * @param $id
     * @return Response
     */
    public function delete($id=null){
        if(!permissions("templates_remove"))
            return redirect()->route("admin.settings.no_permissions");

        $website    = Website::find($id);
        if(!$website)
            return back();

        if($website->logo and file_exists(storage_path("app/".$website->logo)) and is_file(storage_path("app/".$website->logo))){
            unlink(storage_path("app/".$website->logo));
        }
        if($website->image and file_exists(storage_path("app/".$website->image)) and is_file(storage_path("app/".$website->image))){
            unlink(storage_path("app/".$website->image));
        }
        if($website->image_ipad and file_exists(storage_path("app/".$website->image_ipad)) and is_file(storage_path("app/".$website->image_ipad))){
            unlink(storage_path("app/".$website->image_ipad));
        }
        if($website->image_mobile and file_exists(storage_path("app/".$website->image_mobile)) and is_file(storage_path("app/".$website->image_mobile))){
            unlink(storage_path("app/".$website->image_mobile));
        }
        $website->delete();

        return back()->with("success", "تم حذف البيانات بنجاح");
    }

    /**
     * Show the templates add form
     *
     * @return View
     */
    public function edit($id=null){
        if(!permissions("templates_edit"))
            return redirect()->route("admin.settings.no_permissions");

        $website    = Website::find($id);
        if(!$website)
            return back();

        $catgeories = CatgeoryWebsite::orderby("created_at", "asc")->get();

        return view('admin.templates.edit', compact("catgeories", "website"));
    }

    // Category

    /**
     * Add category
     * @param Request $request
     * @return Void
     */
    public function add_category(Request $request){
        if(!permissions("templates_cat_add"))
            return redirect()->route("admin.settings.no_permissions");

        $catgeoryWebsite            = new CatgeoryWebsite;
        $catgeoryWebsite->name_ar   = $request->name_ar;
        $catgeoryWebsite->name_en   = $request->name_en;
        if($request->hasFile("image")){
            $catgeoryWebsite->image = $request->image->store("uploads");
        }
        $catgeoryWebsite->save();

        return back()->with("success", "تم إضافة البيانات بنجاح");
    }

    /**
     * Update category
     * @param Request $request
     * @return Void
     */
    public function update_category(Request $request){
        if(!permissions("templates_cat_edit"))
            return redirect()->route("admin.settings.no_permissions");

        $catgeoryWebsite            = CatgeoryWebsite::find($request->id);
        if(!$catgeoryWebsite)
            return back();

        $catgeoryWebsite->name_ar   = $request->name_ar;
        $catgeoryWebsite->name_en   = $request->name_en;
        if($request->hasFile("image")){
            if($catgeoryWebsite->image and file_exists(storage_path("app/".$catgeoryWebsite->image)))
                unlink(storage_path("app/".$catgeoryWebsite->image));
            $catgeoryWebsite->image = $request->image->store("uploads");
        }
        $catgeoryWebsite->save();

        return back()->with("success", "تم تعديل البيانات بنجاح");
    }

    /**
     * delete category
     * @param CatgeoryWebsite::id $id
     * @return Void
     */
    public function delete_category($id = null){
        if(!permissions("templates_cat_remove"))
            return redirect()->route("admin.settings.no_permissions");

        $catgeoryWebsite            = CatgeoryWebsite::find($id);
        if($catgeoryWebsite){
            Website::where("category_id", $id)->delete();
            $catgeoryWebsite->delete();
        }
        if($catgeoryWebsite->image and file_exists(storage_path("app/".$catgeoryWebsite->image)))
            unlink(storage_path("app/".$catgeoryWebsite->image));

        return back()->with("success", "تم حذف البيانات بنجاح");
    }

    public function get_page(){
        $url = @$_GET["url"];
        return $this->url_get_contents($url);
    }

    function url_get_contents ($Url) {
        if (!function_exists('curl_init')){
            die('CURL is not installed!');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

}
