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
                    @foreach($templates as $template)
                        <div class="col-lg-4 col-sm-6 website" data-category_id="{{$template->category_id}}" data-price="{{$template->price ? 1 : 0}}">
                            @php
                                $image_desktop  = ($template->image) ? asset("storage/app/".$template->image) : asset("public/no-image2.png");
                                $image_ipad     = ($template->image_ipad) ? asset("storage/app/".$template->image_ipad) : asset("public/no-image2.png");
                                $image_mobile   = ($template->image_mobile) ? asset("storage/app/".$template->image_mobile) : asset("public/no-image2.png");
                            @endphp
                            <div class="widget__item_3">
                                <div class="widget__item_option">
                                    <a class="widget__item_option_link option_link_desktop active_link"><i class="fas fa-desktop"></i></a>
                                    <a class="widget__item_option_link option_link_tablet"><i class="fas fa-tablet-alt"></i></a>
                                    <a class="widget__item_option_link option_link_mobile"><i class="fas fa-mobile-alt"></i></a>
                                </div>
                                <div class="widget__item_content">
                                    <div class="widget__list_image">
                                        @foreach($sold_templates as $t)
                                            @if(@$t->pivot->template_id == $template->id)
                                                @if(@$t->pivot->status==1)
                                                    <span class="sold">{{__("l.sold")}}</span>
                                                @else
                                                    <span class="sold" style="background: orange">{{__("l.pending")}}</span>
                                                @endif
                                            @endif
                                        @endforeach
                                        <div class="widget__item_overlay">
                                            @if(cpermissions("templates_purchase_use"))
                                                <a href="{{route("client.websites.templating", ["from_id" => $template->id, "to_id" => @$website->id])}}" class="choose_this" title="{{__("l.choose_this")}}"><i class="fab fa-paypal text-white"></i></a>
                                            @endif
                                            @if($template->slug)
                                                <a href="{{--route("template.website.index2", [$template->slug])--}}" title="رابط القالب" target="_blank"><img src="{{asset("public/dashboard/images/eye.png")}}" alt="" /></a>
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
                                        <h4 class="name_website">{{$template->name_ar}}</h4>
                                        <h4 class="type_website">
                                            @if($template->price)
                                                <span>{{$template->price}}</span> <span>رس</span>
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
        .widget__list_image{
            background: rgb(233, 227, 242);
            overflow: hidden;
            padding: 25px 0px;
            margin-right: 5px;

        }
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
            width: 150px;
            transform: rotateZ(-45deg);
            z-index: 1;
            text-align: center;
            position: absolute;
            top: 30px;
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
