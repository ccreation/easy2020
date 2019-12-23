@extends("client.parts.app")

@section("content")

    <div class="container pt-1 pb-5">

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

                                </div>
                            </h4>
                        </div>
                    @endforeach
                </div>
                <div class="row websites">
                    @foreach($templates as $website)
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

    <div class="kt-portlet">

        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-brush "></i>
                </span>
                @if($website)
                    <h3 class="kt-portlet__head-title">{{__("l.choose_a_template_for_your_website")}} "{{$website->{"name_".app()->getLocale()} }}"</h3>
                @else
                    <h3 class="kt-portlet__head-title">{{__("l.templates")}}</h3>
                @endif
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="javascript:void(0)" onclick="$('#templates_filter0').slideToggle();" class="btn btn-brand btn-elevate btn-icon-sm ml-10" style="width: 150px"> <i class="fa fa-filter"></i> <span>{{__("l.filters")}}</span> </a>
                        <a href="{{route("client.websites.index")}}" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-list"></i> <span>{{__("l.websites_list")}}</span></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet__body">

            <div class="row">

                <div class="col-sm-12 mb-15">

                    <form id="templates_filter0" action="javascript:void(0);" style="display: none; padding: 20px; border: 1px solid #eee; width: 300px; background: #eee; border: 1px solid #dadada; position: absolute; top: -20px; left: 0px; z-index: 333;max-height: 320px; overflow-y: auto;">

                        <div class="col-sm-12"><h4 style="margin-top: 0px;">{{__("l.filters")}} : </h4></div>

                        <div class="col-sm-12 mb-10">
                            <input type="text" class="form-control names" autocomplete="off" name="from" placeholder="{{__("l.name")}}">
                        </div>

                        <div class="col-sm-12 mb-10">
                            <select class="select2x types form-control" autocomplete="off">
                                <option value="0">{{__("l.category")}}</option>
                                @foreach($catgeories as $category)
                                    <option value="{{$category->id}}">{{$category->{"name_".app()->getLocale()} }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 mb-20">
                            <select class="select2x prices form-control" autocomplete="off">
                                <option value="all">{{__("l.price")}}</option>
                                <option value="0">{{__("l.free")}}</option>
                                <option value="1">{{__("l.payed")}}</option>
                            </select>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">{{__("l.filter")}}</button>
                            </div>

                            <div class="col-md-6">
                                <button type="reset" class="btn btn-info btn-block">{{__("l.reset")}}</button>
                            </div>

                        </div>

                        <div class="clearfix"></div>

                    </form>
                    <div class="clearfix"></div>
                    <div class="clearfix"><hr></div>

                </div>

                <div class="col-md-12 text-center">
                    <h3>{{__("l.website_templates")}}</h3>
                    <h4>{{__("l.website_templates_note")}}</h4>
                </div>

            </div>

            <div class="row mt-40" id="tableTemplates">

                @foreach($templates as $template)

                    @if($template->homepage)

                        @if($template->logo)
                            @php $image = asset("storage/app/".$template->logo); @endphp
                        @else
                            @php $image = asset("public/no-image2.png"); @endphp
                        @endif
                        <div class="col-md-4 template" data-name0="{{$template->{"name_".app()->getLocale()} }}" data-type0="{{$template->category_id}}" data-price0="{{($template->price)?1:0}}">
                        <div class="kt-portlet kt-portlet--height-fluid kt-widget19">
                            @foreach($sold_templates as $t)
                                @if(@$t->pivot->template_id == $template->id)
                                    @if(@$t->pivot->status==1)
                                        <span class="sold">{{__("l.sold")}}</span>
                                    @else
                                        <span class="sold" style="background: orange">{{__("l.pending")}}</span>
                                    @endif
                                @endif
                            @endforeach
                            <div class="kt-portlet__body plix kt-portlet__body--fit kt-portlet__body--unfill" style="position: relative; width: 100%;">
                                <div class="overlay" style="display:none; width: 100%;height: 100%;background: #fff;z-index: 11; position: absolute;">
                                    @if(cpermissions("templates_purchase_use"))
                                        <a href="{{route("client.websites.templating", ["from_id" => $template->id, "to_id" => @$website->id])}}" class="choose_this btn btn-lg btn-primary btn-bold" style="display: block;margin: 45% auto;width: 200px;border-radius: 30px;">{{__("l.choose_this")}}</a>
                                    @endif
                                </div>
                                <div class="kt-portlet__head kt-portlet__head--right kt-portlet__head--noborder  kt-ribbon kt-ribbon--clip kt-ribbon--left kt-ribbon--info" style="position: absolute;">
                                    <div class="kt-ribbon__target" style="top: 12px;">
                                        <span class="kt-ribbon__inner"></span> <div style="min-width: 110px;text-align: center;font-weight: bold;">{{@$template->category->{"name_".app()->getLocale()} }}</div>
                                    </div>
                                </div>
                                <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides" style="min-height: 300px; background-image: url('{{$image}}');height: 400px;background-position: center;background-size: cover;">
                                    <h3 class="kt-widget19__title kt-font-light">{{$template->{"name_".app()->getLocale()} }}</h3>
                                    <div class="kt-widget19__shadow"></div>
                                    <div class="kt-widget19__labels">
                                        @if($template->price)
                                            <span class="btn btn-label-light-o2 btn-bold float-left not-free">{{$template->price}} {{__("l.rs")}}</span>
                                        @else
                                            <span class="btn btn-label-light-o2 btn-bold float-left free">{{__("l.free")}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="kt-portlet__body p-10" style="min-height: inherit;">
                                <div class="kt-widget19__wrapper mb-0">
                                    <div class="kt-widget19__content mb-0">
                                        <div class="kt-widget19__info">
                                            <div class="kt-widget19__action mb-0 mt-0">
                                                @if($template->homepage)
                                                    <a target="_blank" href="{{--route("template.website.index2", [$template->slug])--}}" class="btn btn-sm btn-label-brand btn-bold">{{__("l.template_preview")}}</a>
                                                @endif
                                                <div class="previews dib float-right">
                                                    <div class="preview dib laptop">
                                                        <svg width="30px" height="16px" viewBox="0 0 30 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <g id="New-Template-page" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <g id="template_grid_03" transform="translate(-1252.000000, -939.000000)" fill-rule="nonzero" fill="#313131">
                                                                    <g id="computer-copy" transform="translate(1252.000000, 939.000000)">
                                                                        <path d="M5,12 L26,12 L26,1 L5,1 L5,12 Z M5,0 L26,0 C26.5522847,-1.01453063e-16 27,0.44771525 27,1 L27,13 L4,13 L4,1 C4,0.44771525 4.44771525,1.01453063e-16 5,0 Z" id="Rectangle-13"></path>
                                                                        <path d="M14,13 L17,13 L14,13 Z M14,12 L17,12 C17.5522847,12 18,12.4477153 18,13 C18,13.5522847 17.5522847,14 17,14 L14,14 C13.4477153,14 13,13.5522847 13,13 C13,12.4477153 13.4477153,12 14,12 Z" id="Rectangle-3"></path>
                                                                        <path d="M1,13 L1,14 C1,14.5522847 1.44771525,15 2,15 L28,15 C28.5522847,15 29,14.5522847 29,14 L29,13 L1,13 Z M1,12 L29,12 C29.5522847,12 30,12.4477153 30,13 L30,14 C30,15.1045695 29.1045695,16 28,16 L2,16 C0.8954305,16 1.3527075e-16,15.1045695 0,14 L0,13 C-6.76353751e-17,12.4477153 0.44771525,12 1,12 Z" id="Rectangle-2"></path>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="preview dib tablet">
                                                        <svg width="20px" height="25px" viewBox="0 0 20 25" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <g id="New-Template-page" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <g id="template_grid_03" transform="translate(-1304.000000, -933.000000)" fill="#313131">
                                                                    <g id="tablet-copy" transform="translate(1304.000000, 933.000000)">
                                                                        <path d="M2,1 C1.44771525,1 1,1.44771525 1,2 L1,23 C1,23.5522847 1.44771525,24 2,24 L18,24 C18.5522847,24 19,23.5522847 19,23 L19,2 C19,1.44771525 18.5522847,1 18,1 L2,1 Z M2,0 L18,0 C19.1045695,-2.02906125e-16 20,0.8954305 20,2 L20,23 C20,24.1045695 19.1045695,25 18,25 L2,25 C0.8954305,25 1.3527075e-16,24.1045695 0,23 L0,2 C-1.3527075e-16,0.8954305 0.8954305,2.02906125e-16 2,0 Z" id="Rectangle-4" fill-rule="nonzero"></path>
                                                                        <path d="M3,5 L3,20 L17,20 L17,5 L3,5 Z M2,4 L18,4 L18,21 L2,21 L2,4 Z" id="Rectangle-4-Copy" fill-rule="nonzero"></path>
                                                                        <path d="M9,2 L9,3 L9,2 Z M12,2 L8,2 L8,3 L12,3 L12,2 Z M8,2 L12,2 L12,3 L8,3 L8,2 Z" id="Rectangle-4-Copy-2" fill-rule="nonzero"></path>
                                                                        <rect id="Rectangle" x="8" y="2" width="4" height="1"></rect>
                                                                        <rect id="Rectangle-Copy" x="9" y="22" width="2" height="1"></rect>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="preview dib mobile">
                                                        <svg width="12px" height="21px" viewBox="0 0 12 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <g id="New-Template-page" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <g id="template_grid_03" transform="translate(-1348.000000, -937.000000)">
                                                                    <g id="mobile-copy" transform="translate(1348.000000, 937.000000)">
                                                                        <path d="M2,0.5 C1.17157288,0.5 0.5,1.17157288 0.5,2 L0.5,19 C0.5,19.8284271 1.17157288,20.5 2,20.5 L10,20.5 C10.8284271,20.5 11.5,19.8284271 11.5,19 L11.5,2 C11.5,1.17157288 10.8284271,0.5 10,0.5 L2,0.5 Z" id="Rectangle-4" stroke="#313131"></path>
                                                                        <path d="M2.5,4.5 L2.5,16.5 L9.5,16.5 L9.5,4.5 L2.5,4.5 Z" id="Rectangle-4-Copy" stroke="#313131"></path>
                                                                        <rect id="Rectangle" fill="#313131" x="4" y="2" width="4" height="1"></rect>
                                                                        <rect id="Rectangle-Copy" fill="#313131" x="5" y="18" width="2" height="1"></rect>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif

                @endforeach

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

    <!-- jquery-confirm -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha256-VxlXnpkS8UAw3dJnlJj8IjIflIWmDUVQbXD9grYXr98=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha256-Ka8obxsHNCz6H9hRpl8X4QV3XmhxWyqBpk/EpHYyj9k=" crossorigin="anonymous"></script>

    <style>
        .sold{
            height: 27px;
            background: #21d232;
            padding: 3px 8px;
            font-weight: bold;
            color: #fff;
            width: 130px;
            transform: rotateZ(-45deg);
            z-index: 1;
            text-align: center;
            position: absolute;
            top: 20px;
            left: -30px;
            font-size: 1.2em;
        }
        #tableTemplates{
            min-height: 500px;
        }
        .kt-portlet{
            box-shadow: 0px 0px 13px 4px rgba(82, 63, 105, 0.1);
            overflow: hidden;
            position: relative;
        }
        .kt-widget19 .kt-widget19__pic .kt-widget19__labels{
            left: 25px;
            right: inherit;
        }
        .btn.btn-label-light-o2.free{
            background-color: rgba(0, 255, 24, 0.42);
        }
         .btn.btn-label-light-o2.not-free{
             background-color: rgba(255, 0, 33, 0.56);
         }
        .jconfirm-title-c{
            display: none !important;
        }
        .jconfirm-content-pane{
            font-size: 1.2em;
        }
        .jconfirm-content{
            height: auto;
            overflow: hidden !important;
            animation: blinker 1s linear infinite;
            color: crimson;
        }
        @keyframes blinker {
            25% {
                opacity: 0;
            }
        }
    </style>

    <script>
        $(function() {

            $(document).on("submit", "#templates_filter0", function (e){
                var names   = $("#templates_filter0 .names").val();
                var types   = $("#templates_filter0 .types").val()+"";
                var prices  = $("#templates_filter0 .prices").val()+"";

                $('#tableTemplates .template').hide();
                $('#tableTemplates .template').filter(function () {
                    var namex = true;
                    var name0 = $(this).data("name0");
                    if(names!=""){
                        if(!name0.includes(names))
                            namex = false;
                    }

                    var typex = true;
                    var type0 = $(this).data("type0");
                    if(types!="0"){
                        if(type0!=types)
                            typex = false;
                    }

                    var pricex = true;
                    var price0 = $(this).data("price0");
                    if(prices!="all"){
                        if(price0!=prices)
                            pricex = false;
                    }

                    return (namex && typex && pricex);
                }).show();
                $('#templates_filter0').slideToggle();
            });

            $(document).on("reset", "#templates_filter0", function (e){
                e.preventDefault();
                $('#tableTemplates .template').show();
                $("#templates_filter0 .names").val("");
                $('#templates_filter0 .types').val("0");
                $('#templates_filter0 .prices').val("all");
                $('#templates_filter0').slideToggle();
            });

            $(document).on("mouseenter", ".plix", function () {
                $(".overlay", this).fadeIn("slow");
            });

            $(document).on("mouseleave", ".plix", function () {
                $(".overlay", this).fadeOut("fast");
            });

            $(document).on("click", ".choose_this", function (e) {
                e.preventDefault();
                var url = $(this).attr("href");
                $.confirm({
                    title: "{{__("l.confirmation")}}",
                    content: "{{__("l.are_you_sure")}}<br>{{__("l.choose_a_template_for_your_website_note")}}",
                    icon: 'fa fa-question-circle',
                    animation: 'scale',
                    closeAnimation: 'scale',
                    backgroundDismiss: true,
                    opacity: 0.5,
                    buttons: {
                        'cancel': {
                            text: '{{__("l.no")}}',
                            btnClass: 'btn-red pull-left',
                        },
                        'confirm': {
                            text: '{{__("l.yes")}}',
                            btnClass: 'btn-blue',
                            action: function () {
                                window.location.href = url;
                            }
                        }
                    }
                });
            })

        });
    </script>


@endsection
