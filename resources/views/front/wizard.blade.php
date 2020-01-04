@extends("front.parts.app")

@section("content")

    <div class="main-wizard-step">
        <div class="container">
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
                            <h1 class="text-center">قم الان بتحرير موقعك</h1>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>

@endsection


@section("scripts")

<script>
    $(function () {

        var category_id = 0;
        var sluggable = false;
        var default_lang = "ar";

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

        $(document).on("change paste keyup", "#slug", function (e) {
            e.preventDefault();
            var slug  = $(this).val();
            console.log(slug);
            var input = $(this);
            var url = "{{route("sluggable")}}";
            $(".valid-feedback, .invalid-feedback").html("");
            if(slug != ""){
                $.post(url,
                    { "_token": "{{ csrf_token() }}", slug : slug},
                    function (data) {
                        if(data=="OK"){
                            sluggable = true;
                            $(input).removeClass("is-invalid");
                            $(input).addClass("is-valid");
                            $(".valid-feedback").html("{{__("l.slug_note_ok")}}");
                        }else{
                            sluggable = false;
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
        });

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
    });
</script>

<style>
    .is-valid{
        border: 1px solid #28a745 !important;
    }
    .is-invalid{
        border: 1px solid crimson !important;
    }
</style>

@endsection
