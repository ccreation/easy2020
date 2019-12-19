<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Image;
use App\ImageCatgeory;

class ImagesController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $image_categories   = ImageCatgeory::all();
        $images             = Image::with("category")->get();

        return view("admin.images.index", compact("image_categories", "images"));
    }

    public function image_save(Request $request){
        $image              = new Image;
        $image->name_ar     = $request->name_ar;
        $image->name_en     = $request->name_en;
        $image->category_id = $request->category_id;
        $image->url = $request->url;
        $image->save();

        return back()->with("success", "تم حفظ البيانات بنجاح");
    }

    public function image_update(Request $request){
        $image              = Image::find($request->id);
        if(!$image)
            return back();

        $image->name_ar     = $request->name_ar;
        $image->name_en     = $request->name_en;
        $image->category_id = $request->category_id;
        $image->url = $request->url;
        $image->save();

        return back()->with("success", "تم تعديل البيانات بنجاح");
    }

    public function image_delete($id = null){
        $image              = Image::find($id);
        if(!$image)
            return back();

        $image->delete();

        return back()->with("success", "تم حذف البيانات بنجاح");
    }

    public function categories(){
        $image_categories = ImageCatgeory::all();

        return view("admin.images.categories", compact("image_categories"));
    }

    public function category_save(Request $request){
        $image_category             = new ImageCatgeory;
        $image_category->name_ar    = $request->name_ar;
        $image_category->name_en    = $request->name_en;
        $image_category->save();

        return back()->with("success", "تم حفظ البيانات بنجاح");
    }

    public function category_delete($id = null){
        $image_category             = ImageCatgeory::find($id);
        if(!$image_category)
            return back();

        $image_category->delete();

        return back()->with("success", "تم حذف البيانات بنجاح");
    }

    public function category_update(Request $request){
        $image_category             = ImageCatgeory::find($request->id);
        $image_category->name_ar    = $request->name_ar;
        $image_category->name_en    = $request->name_en;
        $image_category->save();

        return back()->with("success", "تم تعديل البيانات بنجاح");
    }


}
