@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">

        <h4 class="mb-4 text-center" style="color: #512293"><b>{{__("l.add_new_website")}}</b></h4>

        <form class="form-register" id="form-register" action="{{route("client.websites.save")}}" method="post" enctype="multipart/form-data">
            @csrf
            <div id="form-total">
                <!-- SECTION 1-->
                <h2 class="h2"><span class="step-icon"><img src="{{asset("public/dashboard/images/website/options.png")}}" alt=""/></span><span class="step-text">تصنيف موقعك</span></h2>
                <section class="section">
                    <div class="inner">
                        <div class="row">
                            @foreach($catgeories as $category)
                                <div class="fivecolumns col-sm-6">
                                    <div class="widget_item widget__item_7" data-id="{{$category->id}}">
                                        <div class="widget__item-icon">
                                            @if($category->image)
                                                <img alt="" src="{{asset("storage/app/".$category->image)}}"/>
                                            @else
                                                <img alt="" src="{{asset("public/no-image2.png")}}" />
                                            @endif
                                        </div>
                                        <div class="widget__item-title">
                                            <h3>{{$category->name_ar}}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                <!-- SECTION 2-->
                <h2 class="h2"><span class="step-icon"><img src="{{asset("public/dashboard/images/website/check-list.png")}}" alt=""/></span><span class="step-text">بياناتك</span></h2>
                <section class="section">
                    <div class="inner">
                        <div class="row">
                            <div class="col-lg-9 mx-auto">
                                <div class="yourDomain">
                                    <div class="form-group">
                                        <div class="input-group align-items-center">
                                            <input class="form-control" type="text" name="slug" id="slug" value="{{old('slug')}}" autocomplete="off" required style="padding-left: 250px;" />
                                            <label class="yourDomainText" style="left: 3rem;">https://{{request()->getHost()}}/</label>
                                            <img src="{{asset("public/dashboard/images/website/link.png")}}" alt="" />
                                        </div>
                                        <small>{{__("l.website_slug_note")}}</small>
                                    </div>
                                </div>
                                <div class="switch_languages">
                                    <div class="d-flex align-items-center mb-4 mb-lg-0">
                                        <h5 class="label-languages">تفعيل لغتين</h5>
                                        <span class="sh-switch"><label class="mb-0"><input type="checkbox" checked id="multi_lang" name="multi_lang" value="1"/><span></span></label></span>
                                    </div>
                                    <div class="switch_languages-btn">
                                        <div class="d-flex align-items-center flex-wrap">
                                            <h5 class="label-languages">اللغة الإفتراضية</h5>
                                            <div class="switch_languages_toggle">
                                                <lable class="switch_languages-link ar active">العربية</lable>
                                                <lable class="switch_languages-link en">English</lable>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tabbable tabs-right">
                                    <ul class="nav nav-tabs flex-column" id="myTab">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"><span>العربية</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"><span>English</span></a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home">
                                            <div class="form-group">
                                                <input type="text" name="name_ar" id="name_ar" value="{{old('name_ar')}}" class="form-control rounded" placeholder="اسم الموقع" />
                                            </div>
                                            <div class="form-group mb-0">
                                                <textarea name="description_ar" id="description_ar" rows="5" class="form-control rounded" placeholder="وصف الموقع ">{{old('description_ar')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile">
                                            <div class="form-group">
                                                <input type="text" name="name_en" id="name_en" value="{{old('name_en')}}" class="form-control rounded" placeholder="Website name" />
                                            </div>
                                            <div class="form-group mb-0">
                                                <textarea name="description_en" id="description_en" rows="5" class="form-control rounded" placeholder="Website Description">{{old('description_en')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="inputfile mr-lg-5 pr-lg-2">
                                        <input type="file" id="file" accept="image/*" name="logo" class="inputfile" onchange="uploadFile(this)" />
                                        <label for="file">
                                            <span class="file-box" id="file-name">اضغط هنا لرفع</span>
                                            <span class="file-button">
                                                    <img src="{{asset("public/dashboard/images/website/img-sm.png")}}" alt=""/>
                                                </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- SECTION 3-->
                <h2 class="h2"><span class="step-icon"><img src="{{asset("public/dashboard/images/website/start-2.png")}}" alt=""/></span><span class="step-text">انطلق</span></h2>
                <section class="section">
                    <div class="inner">
                        <h1 style="color: #512293; font-size: 1.7em; font-weight: bold;" class="text-center">قم الان بتحرير موقعك</h1>
                    </div>
                </section>
            </div>
        </form>

        {{--
        <form id="websites_save" action="{{route("client.websites.save")}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-md-11 mx-auto">
                    <div class="form-group row">
                        <label class="col-md-2"><span>{{__("l.website_slug")}}</span> <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" name="slug" id="slug" value="{{old('slug')}}" class="form-control" required>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                            <small>{{__("l.website_slug_note")}}</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 mx-auto">

                    <div class="form-group">
                        <label><span>{{__("l.website_category")}}</span> <span class="text-danger">*</span></label>
                        <select name="category_id" value="{{old('category_id')}}" class="form-control" required>
                            <option value="">إختر</option>
                            @foreach($catgeories as $category)
                                <option value="{{$category->id}}">{{$category->name_ar}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="col-md-5 mx-auto">
                    <div class="form-group">
                        <label><span>{{__("l.logo")}}</span></label>
                        <input type="file" accept="image/*" name="logo" class="form-control" />
                    </div>
                </div>

                <div class="col-md-12 mt-2 mb-2"></div>

                <div class="col-md-5 mx-auto">

                    <div class="form-group">
                        <label><span>{{__("l.website_multi_lang")}}</span> <span class="text-danger">*</span></label>
                        <select name="multi_lang" id="multi_lang" class="form-control" required>
                            <option value="1">{{__("l.yes")}}</option>
                            <option value="0">{{__("l.no")}}</option>
                        </select>
                    </div>

                </div>

                <div class="col-md-5 mx-auto">

                    <div class="form-group">
                        <label><span>{{__("l.website_default_lang")}}</span> <span class="text-danger">*</span></label>
                        <div class="kt-radio-list">
                            <label class="kt-radio mt-10">
                                <input type="radio" name="default_lang" class="default_lang" value="ar" checked> <strong>{{__("l.arabic")}}</strong>
                                <span style="background: #fff"></span>
                            </label>
                            <label class="kt-radio">
                                <input type="radio" name="default_lang" class="default_lang" value="en"> <strong>{{__("l.english")}}</strong>
                                <span style="background: #fff"></span>
                            </label>
                        </div>
                    </div>

                </div>

                <div class="col-md-12 mt-15 mb-15"></div>

                <div class="col-md-5 mx-auto" id="lang_ar">

                    <div class="form-group">
                        <label><span>{{__("l.website_name")}}</span> <small>({{__("l.arabic")}})</small></label>
                        <input type="text" name="name_ar" value="{{old('name_ar')}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label><span>{{__("l.website_brief")}}</span> <small>({{__("l.arabic")}})</small></label>
                        <textarea name="description_ar" rows="5" class="form-control">{{old('description_ar')}}</textarea>
                    </div>

                </div>

                <div class="col-md-5 mx-auto" id="lang_en">

                    <div class="form-group">
                        <label><span>{{__("l.website_name")}}</span> <small>({{__("l.english")}})</small></label>
                        <input type="text" name="name_en" value="{{old('name_en')}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label><span>{{__("l.website_brief")}}</span> <small>({{__("l.english")}})</small></label>
                        <textarea name="description_en" rows="5" class="form-control">{{old('description_en')}}</textarea>
                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="form-group text-center mt-4 mb-5">
                        <button type="submit" class="btn general-btn-sm-blue rounded"><i class="fa fa_save"></i> <span>{{__("l.save")}}</span></button>
                    </div>
                </div>
            </div>

        </form>
        --}}

    </div>

@endsection

@section("scripts")

    <link rel="stylesheet" href="{{asset("public/dashboard/css/wizard.css")}}" />
    <script src="{{asset("public/dashboard/js/jquery.steps.js")}}"></script>

    <style>
        .content{
            padding-top: 30px !important;
        }
        .yourDomain .form-control {
            border-radius: 0;
            border: 0px;
            background-color: #d3cedb;
            border: 1px solid #b7b3be;
            text-align: left;
            box-shadow: none !important;
        }
        .form-control.is-valid{
            border: 1px solid #28a745 !important;
        }
        .form-control.is-invalid {
            border: 1px solid #dc3545 !important;
        }
        .inputfile .file-box{
            background-color: #fff;
        }
    </style>

    <script>

        $(function(){

            var category_id = 0;
            var sluggable = false;
            var default_lang = "ar";

            $("#form-total").steps({
                headerTag: "h2.h2",
                bodyTag: "section.section",
                transitionEffect: "slideLeft",
                // enableAllSteps: true,
                autoFocus: true,
                transitionEffectSpeed: 500,
                titleTemplate: '<div class="title">#title#</div>',
                labels: {
                    previous : 'السابق',
                    next: 'التالي',
                    finish: 'انطلق',
                    current: ''
                },
                onStepChanging: function (event, currentIndex, newIndex) {
                    if(currentIndex == 0){
                        $.each($(".fivecolumns").find(".widget_item.widget__item_7"), function (i, e) {
                            if($(e).hasClass("active"))
                                category_id = $(e).data("id");
                        });
                        return  true;
                    }else if(currentIndex == 1){
                        if($("#slug").val() == "" || !sluggable){
                            alert("يجب كتابة رابط الموقع");
                            return  false;
                        }
                        return  true;
                    }
                }, onFinishing: function (event, currentIndex) {
                    $("#form-register").remove(".category_id");
                    $("#form-register").append('<input class="category_id" name="category_id" value="'+category_id+'">');
                    $("#form-register").remove(".default_lang");
                    $("#form-register").append('<input class="default_lang" name="default_lang" value="'+default_lang+'">');
                    $("#form-register").submit();
                }
            });

            $(document).on("click", ".widget_item.widget__item_7",function () {
                $('.widget_item.widget__item_7').removeClass('active')
                $(this).addClass('active')
            });

            $(document).on("click", ".switch_languages-link", function () {
                $('.switch_languages .switch_languages-link').removeClass('active')
                if ($(this).hasClass('ar')) {
                    $(this).addClass('active')
                    default_lang = "ar";
                }
                if ($(this).hasClass('en')) {
                    $(this).addClass('active')
                    default_lang = "en";
                }
            });

            $(document).on("submit", "form", function () {
                $(this).find('button[type="submit"]').prop("disabled", true);
            });

            $(document).on("keyup change paste", "#slug", function () {
                var slug  = $(this).val();
                var input = $(this);
                var url = "{{route("client.websites.sluggable")}}";
                $(".valid-feedback, .invalid-feedback").html("");
                if(slug != ""){
                    $.post(url,
                        { "_token": "{{ csrf_token() }}", slug : slug},
                        function (data) {
                            if(data=="OK"){
                                sluggable =true;
                                $(input).removeClass("is-invalid");
                                $(input).addClass("is-valid");
                                $(".valid-feedback").html("{{__("l.slug_note_ok")}}");
                            }else{
                                sluggable =false;
                                $(input).removeClass("is-valid");
                                $(input).addClass("is-invalid");
                                $(".invalid-feedback").html("{{__("l.slug_note_bad")}}");
                            }
                        });
                }else{
                    sluggable =false;
                    $(input).removeClass("is-valid");
                    $(input).removeClass("is-invalid");
                }
            })

            /*
            function define_lang_config(){
                var multi_lang      = $("#multi_lang").val();
                var default_lang    = $(".default_lang:checked").val();
                if(multi_lang==1){
                    $("#lang_en").show("slow");
                    $("#lang_ar").show("slow");
                }else{
                    if(default_lang=="ar"){
                        $("#lang_en").hide("fast");
                        $("#lang_ar").show("slow");
                    }else{
                        $("#lang_en").show("slow");
                        $("#lang_ar").hide("fast");
                    }

                }

            }

            ;

            $(document).on("change", "#multi_lang", function () {
                define_lang_config();
            });

            $(document).on("change", ".default_lang", function () {
                define_lang_config();
            });

            $(document).on("submit", "#websites_save", function () {
                if(!sluggable){
                    goNotif("error", "{{__("l.slug_note_bad")}}");
                    return false;
                }
                else{
                    $(this).find('button[type="submit"]').prop("disabled", true);
                }
            });
            */

        });

    </script>

@endsection
