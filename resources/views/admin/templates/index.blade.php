@extends("admin.parts.app")

@section("content")

    <div class="container">

        @if(permissions("templates_edit"))
            <a href="{{route("admin.templates.add")}}" class="btn general-btn-sm-blue float-left"><i class="fa fa-plus"></i> <span>إنشاء قالب جديد</span></a>
        @endif

        @if(permissions("templates_cat_add"))
            <a class="btn general-btn-sm-blue float-left ml-2 btn-open" data-target="#add_cat" href="#"><i class="fa fa-plus"></i> <span>إضافة تصنيف جديد</span></a>
        @endif

        <div class="clearfix mb-3"></div>

        @if(permissions("templates_cat_add"))

            <form id="add_cat" enctype="multipart/form-data" class="formi mt-20 mb-20" action="{{route("admin.templates.add_category")}}" method="post">
                @csrf
                <div class="form-group">
                    <label><span>الإسم</span><small>(عربي)</small> <span class="text-danger">*</span></label>
                    <input type="text" name="name_ar" class="form-control" required>
                </div>
                <div class="form-group">
                    <label><span>الإسم</span><small>(إنجليزي)</small> <span class="text-danger">*</span></label>
                    <input type="text" name="name_en" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>الصورة </label>
                    <input type="file" name="image" accept="image/*" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn general-btn-sm-blue "><i class="fa fa-save"></i> <span>حفظ</span></button>
                </div>
            </form>

        @endif

        <div class="main-template pannel">
            <div class="header-template bg-transparent">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="nav-template ">
                                <ul class="nav nav-pills mb-0 border-0" id="pills-tab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-id="all" id="all_websites" href="#">{{__("l.all")}}</a></li>
                                    @foreach($catgeories as $category)
                                        <li class="nav-item"><a class="nav-link" data-id="{{$category->id}}" href="#">{{$category->name_ar}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <select class="form-control selectpaicker" id="website_price_filter">
                                    <option value="all">السعر</option>
                                    <option value="0">مجاني</option>
                                    <option value="1">مدفوع</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="body-template">
                <div class="categories mb-4">
                    @foreach($catgeories as $category)
                        <div class="category category_{{$category->id}}">
                            <h4 class="clearfix pb-3">
                                <h3 class="text-center mb-1" style="color: #543c93;">{{$category->name_ar}}</h3>
                                <div class="text-center">
                                    @if(permissions("templates_cat_edit"))
                                        <a href="#" class="text-success" style="text-decoration: underline;" data-toggle="modal" data-target="#catModal{{$category->id}}">تعديل</a>
                                    @endif
                                    @if(permissions("templates_cat_remove"))
                                        <a href="{{route("admin.templates.delete_category", $category->id)}}" onclick="return confirm('هل أنت متأكد ؟')" class="text-danger" style="text-decoration: underline;">حذف</a>
                                    @endif
                                </div>
                            </h4>
                            @if(permissions("templates_cat_edit"))
                                <div class="modal fade" id="catModal{{$category->id}}">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h5 class="modal-title" id="exampleModalLabel">تعديل التصنيف</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form class="" enctype="multipart/form-data" action="{{route("admin.templates.update_category")}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$category->id}}">
                                                    <div class="form-group">
                                                        <label><span>الإسم</span><small>(عربي)</small> <span class="text-danger">*</span></label>
                                                        <input type="text" name="name_ar" value="{{$category->name_ar}}" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label><span>الإسم</span><small>(إنجليزي)</small> <span class="text-danger">*</span></label>
                                                        <input type="text" name="name_en" value="{{$category->name_en}}" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>الصورة </label>
                                                        <input type="file" name="image" accept="image/*" class="form-control">
                                                    </div>
                                                    @if($category->image)
                                                        <img src="{{asset("storage/app/".$category->image)}}" style="width:80px; height: 80px; border: 1px solid #333; margin-left: 10px;" />
                                                    @else
                                                        <img src="{{asset("public/no-image2.png")}}" style="width:80px; height: 80px; border: 1px solid #333; margin-left: 10px;" />
                                                    @endif
                                                    <div class="clearfix"></div>
                                                    <br>
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn general-btn-sm-blue"><i class="fa fa-save"></i> <span>حفظ</span></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="row websites">
                    @foreach($websites as $website)
                        <div class="col-lg-4 col-sm-6 website" data-category_id="{{$website->category_id}}" data-price="{{$website->price ? 1 : 0}}">
                            @php
                                $image_desktop  = ($website->image) ? asset("storage/app/".$website->image) : asset("public/no-image2.png");
                                $image_ipad     = ($website->image_ipad) ? asset("storage/app/".$website->image_ipad) : asset("public/no-image2.png");
                                $image_mobile   = ($website->image_mobile) ? asset("storage/app/".$website->image_mobile) : asset("public/no-image2.png");
                            @endphp
                            <div class="widget__item_3">
                                <div class="widget__item_option">
                                    <a class="widget__item_option_link option_link_desktop active_link"><i class="fas fa-desktop"></i></a>
                                    <a class="widget__item_option_link option_link_tablet"><i class="fas fa-tablet-alt"></i></a>
                                    <a class="widget__item_option_link option_link_mobile"><i class="fas fa-mobile-alt"></i></a>
                                </div>
                                <div class="widget__item_content">
                                    <div class="widget__list_image">
                                        <div class="widget__item_overlay">
                                            @if($website->slug)
                                                <a href="{{route("website.index", [$website->slug, app()->getLocale()])}}" title="رابط القالب" target="_blank"><img src="{{asset("public/dashboard/images/eye.png")}}" alt="" /></a>
                                            @endif
                                            @if(permissions("templates_edit"))
                                                <a href="{{route("editor.edit", $website->id)}}" title="محرر الصفحات"><i class="fa fa-edit" style="color: #dfdfdf"></i></a>
                                                <a href="{{route("admin.templates.edit", $website->id)}}" title="تعديل البيانات العامة للقالب"><img src="{{asset("public/dashboard/images/settings.png")}}" alt="" /></a>
                                            @endif
                                            @if(permissions("templates_remove"))
                                                <a href="{{route("admin.templates.delete", $website->id)}}" onclick="return confirm('هل انت متأكد ؟')" title="حذف للقالب"><img src="{{asset("public/dashboard/images/cpanel/delete.png")}}" alt="" /></a>
                                            @endif
                                        </div>
                                        <div class="widget__image image-desktop">
                                            <img src="{{asset("public/dashboard/images/flat-desctop.png")}}" alt="">
                                            <div class="container_image">
                                                <picture><img src="{{$image_desktop}}" alt="" /></picture>
                                            </div>
                                        </div>
                                        <div class="widget__image image-tablet">
                                            <img src="{{asset("public/dashboard/images/flat-tablet.png")}}" alt="">
                                            <div class="container_image">
                                                <picture><img src="{{$image_ipad}}" alt="" /></picture>
                                            </div>
                                        </div>
                                        <div class="widget__image image-mobile">
                                            <img src="{{asset("public/dashboard/images/flat-mobile.png")}}" alt="">
                                            <div class="container_image">
                                                <picture><img src="{{$image_mobile}}" alt="" /></picture>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget__details image-mobile">
                                        <h4 class="name_website">{{$website->name_ar}}</h4>
                                        <h4 class="type_website">
                                            @if($website->price)
                                                <span>{{$website->price}}</span> <span>رس</span>
                                            @else
                                                <span>مجاني</span>
                                            @endif
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

@endsection

@section("scripts")

    <style>
        .nav-link{
            border: 1px solid #81b234;
            margin: 0px 0px 10px 5px;
            color: #81b234 !important;
        }
        .nav-link.active{
            color: #fff !important;
        }
        .category{
            display: none;
        }
        .categories{
            min-height: 50px;
        }
        .websites{
            min-height: 500px;
        }
    </style>

    <script>

        $(function () {

            $(document).on("click", ".nav-link", function (e) {
                e.preventDefault();
                var id = $(this).data("id")+"";
                $(".category").css("display", "none");
                $(".selectpaicker").selectpicker("val", "all");
                $(".nav-link").removeClass("active");
                $(this).addClass("active");
                if(id == "all"){
                    $(".website").fadeIn("fast");
                }else{
                    $(".website").css("display", "none");
                    $.each($(".websites").find(".website"), function (i, el) {
                        var _id = $(el).data("category_id")+"";
                        if(id == _id)
                            $(el).fadeIn("fast");
                    });
                }
                $(".category_"+id).fadeIn("fast");
            });

            $(document).on("change", "#website_price_filter", function () {
                $(".nav-link").removeClass("active");
                $("#all_websites").addClass("active");
                $(".category").css("display", "none");
                var val = $(this).val()+"";
                if(val == "all"){
                    $(".website").fadeIn("fast");
                }else{
                    $(".website").css("display", "none");
                    $.each($(".websites").find(".website"), function (i, el) {
                        var _val = $(el).data("price")+"";
                        if(val == _val)
                            $(el).fadeIn("fast");
                    });
                }
            });

        });

    </script>

@endsection
