<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Video;
use App\VideoCategory;

class VideosController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $video_categories   = VideoCategory::all();
        $videos             = Video::with("category")->get();

        return view("admin.videos.index", compact("video_categories", "videos"));
    }

    public function video_save(Request $request){
        $video              = new Video;
        $video->name_ar     = $request->name_ar;
        $video->name_en     = $request->name_en;
        $video->category_id = $request->category_id;
        $video->url = $request->url;
        $video->save();

        return back()->with("success", "تم حفظ البيانات بنجاح");
    }

    public function video_update(Request $request){
        $video              = Video::find($request->id);
        if(!$video)
            return back();

        $video->name_ar     = $request->name_ar;
        $video->name_en     = $request->name_en;
        $video->category_id = $request->category_id;
        $video->url = $request->url;
        $video->save();

        return back()->with("success", "تم تعديل البيانات بنجاح");
    }

    public function video_delete($id = null){
        $video              = Video::find($id);
        if(!$video)
            return back();

        $video->delete();

        return back()->with("success", "تم حذف البيانات بنجاح");
    }

    public function categories(){
        $video_categories = VideoCategory::all();

        return view("admin.videos.categories", compact("video_categories"));
    }

    public function category_save(Request $request){
        $video_category             = new VideoCategory;
        $video_category->name_ar    = $request->name_ar;
        $video_category->name_en    = $request->name_en;
        $video_category->save();

        return back()->with("success", "تم حفظ البيانات بنجاح");
    }

    public function category_delete($id = null){
        $video_category             = VideoCategory::find($id);
        if(!$video_category)
            return back();

        $video_category->delete();

        return back()->with("success", "تم حذف البيانات بنجاح");
    }

    public function category_update(Request $request){
        $video_category             = VideoCategory::find($request->id);
        $video_category->name_ar    = $request->name_ar;
        $video_category->name_en    = $request->name_en;
        $video_category->save();

        return back()->with("success", "تم تعديل البيانات بنجاح");
    }


}
