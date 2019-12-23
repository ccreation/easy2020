@extends("front.parts.app")

@section("content")

    <section class="home-intro inernal">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 order-1 order-lg-0">
                    <div class="content-text-right pl-lg-5">
                        <h3 class="text-title">قوالب جاهزة تتناسب مع الجميع</h3>
                    </div>
                </div>
                <div class="col-lg-7 order-0 order-lg-1">
                    <div class="image">
                        <img
                            class="home-image home-image-animate"
                            src="{{asset("public/dashboard/images/website/img-template.png")}}"
                            alt=""
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="main-grid-content">
        <div class="container">
            <section class="section_template section_template">
                <div class="imageOverlay"></div>
                <div class="main-template pannel">

                    <div class="container">

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
                                        <h3 class="text-center mb-1" style="color: #543c93;">{{$category->name_ar}}</h3>
                                    </div>
                                @endforeach
                            </div>

                            <div class="row websites">
                                @foreach($websites as $website)
                                    <div class="col-lg-4 website" data-category_id="{{$website->category_id}}" data-price="{{$website->price ? 1 : 0}}">
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
                                                            <a href="{{--route("template.website.index2", [$website->slug])--}}" title="رابط القالب" target="_blank"><img src="{{asset("public/dashboard/images/eye.png")}}" alt="" /></a>
                                                        @else
                                                            <a href="javascript:void(0)" class="disabled" style="cursor: pointer !important; pointer-events: inherit;"
                                                               onclick="event.preventDefault();alert('يجب عليك إختيار رابط للقالب أولا !')"
                                                               title="هذا القالب لا يملك رابط خاص به"><img src="{{asset("public/dashboard/images/eye.png")}}" alt="" /></a>
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
            </section>
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
                setTimeout(function () {
                    $(".category_"+id).fadeIn("fast");
                }, 100);
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
