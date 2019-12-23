@extends("front.parts.app")

@section("content")

    <section class="home-intro inernal">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 order-1 order-lg-0">
                    <div class="content-text-right pl-lg-5">
                        <h3 class="text-title">أول منصة عربية بإمكانيات عالمية</h3>
                    </div>
                </div>
                <div class="col-lg-7 order-0 order-lg-1">
                    <div
                        class="d-flex justify-content-center align-items-center flex-wrap flex-lg-nowrap"
                    >
                        <div class="image">
                            <img
                                class="home-image-animate"
                                src="{{asset("public/dashboard/images/website/ing-home-intro.png")}}"
                                alt=""
                            />
                        </div>
                        <div class="content-text-left">
                            <h3 class="text-info">
                                أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                الإحترافية، بكل يسر وسهولة
                            </h3>
                            <a href="{{route("login")}}">
                                <div class="wight_text">
                                    <h5 class="wight_text-title">
                                        صمم موقعك
                                        <h6 class="wight_text-info">بضغطة واحدة</h6>
                                    </h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section_service">
        <div class="container">
            <div class="row">
                <div class="fivecolumns col-sm-6">
                    <div class="widget_item widget__item_6">
                        <div class="widget__item-icon">
                            <img
                                src="{{asset("public/dashboard/images/website/service/business-and-finance.png")}}"
                                alt=""
                            />
                        </div>
                        <div class="widget__item-title">
                            <h3>سعر رمزي</h3>
                        </div>
                        <div class="widget__item-info">
                            <h5>
                                أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                الإحترافية، بكل يسر وسهولة
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="fivecolumns col-sm-6">
                    <div class="widget_item widget__item_6">
                        <div class="widget__item-icon">
                            <img src="{{asset("public/dashboard/images/website/service/startup.png")}}"alt="" />
                        </div>
                        <div class="widget__item-title">
                            <h3>سرعة تنفيذ</h3>
                        </div>
                        <div class="widget__item-info">
                            <h5>
                                أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                الإحترافية، بكل يسر وسهولة
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="fivecolumns col-sm-6">
                    <div class="widget_item widget__item_6 widget_center">
                        <div class="widget__item-icon">
                            <img src="{{asset("public/dashboard/images/website/service/award.png")}}"alt="" />
                        </div>
                        <div class="widget__item-title">
                            <h3>جودة عالية</h3>
                        </div>
                        <div class="widget__item-info">
                            <h5>
                                أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                الإحترافية، بكل يسر وسهولة
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="fivecolumns col-sm-6">
                    <div class="widget_item widget__item_6">
                        <div class="widget__item-icon">
                            <img src="{{asset("public/dashboard/images/website/service/layers.png")}}"alt="" />
                        </div>
                        <div class="widget__item-title">
                            <h3>قوالب متعددة</h3>
                        </div>
                        <div class="widget__item-info">
                            <h5>
                                أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                الإحترافية، بكل يسر وسهولة
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="fivecolumns col-sm-6">
                    <div class="widget_item widget__item_6">
                        <div class="widget__item-icon">
                            <img
                                src="{{asset("public/dashboard/images/website/service/business-and-finance.png")}}"
                                alt=""
                            />
                        </div>
                        <div class="widget__item-title">
                            <h3>سعر رمزي</h3>
                        </div>
                        <div class="widget__item-info">
                            <h5>
                                أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                الإحترافية، بكل يسر وسهولة
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section_information">
        <div class="container">
            <div class="row ">
                <div class="col-lg-8 mx-auto">
                    <div class="row no-guttera align-items-center">
                        <div class="col-lg-6">
                            <h3 class="number d-flex">
                    <span
                        class="counter timer-1"
                        data-from="0"
                        data-to="75"
                        data-speed="3000"
                    >0</span
                    >
                                <span
                                    class="counter timer-2"
                                    data-from="10"
                                    data-to="33"
                                    data-speed="3000"
                                >0</span
                                >
                                <span
                                    class="counter timer-3"
                                    data-from="50"
                                    data-to="75"
                                    data-speed="3000"
                                >0</span
                                >
                                <span
                                    class="counter timer-4"
                                    data-from="125"
                                    data-to="675"
                                    data-speed="3000"
                                >9</span
                                >
                            </h3>
                            <h3 class="info">
                                بمعدل موقع كل<span class="pr-2">ساعة</span>
                            </h3>
                        </div>
                        <div class="col-lg-6">
                            <div class="image">
                                <img src="{{asset("public/dashboard/images/website/information.png")}}"alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section_template bg-images-template">
        <div class="imageOverlay"></div>
        <div class="main-template pannel">

            <div class="container">

                <div class="header-template bg-transparent">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 mr-auto">
                                <h3 class="title_section mb-4 mb-lg-0 ">
                                    القوالب
                                </h3>
                            </div>
                            <div class="col-lg-7">
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

    <section class="section_faq">
        <div class="container">
            <div class="imageOverlay"></div>
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="main-faq">
                        <div class="header-faq">
                            <h3 class="title_section mb-0">الأسئلة الشائعة</h3>
                        </div>
                        <div class="body-faq">
                            <div id="accordion">
                                <div class="card mb-3">
                                    <div class="card-header ">
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link arrow"
                                                data-toggle="collapse"
                                                data-target="#collapse-1"
                                            >
                                                كيف يمكنني الاشتراك في ماي اوفرز
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        class="collapse show"
                                        id="collapse-1"
                                        data-parent="#accordion"
                                    >
                                        <div class="card-body">
                                            تمتع بالحماية الكاملة لجميع بياناتك المستخدمة … كما
                                            يوفر الموقع نسخة إحتياطية للرجوع إليها حسب
                                            إحتياجاتكمتمتع بالحماية الكاملة لجميع بياناتك
                                            المستخدمة … كما يوفر الموقع نسخة إحتياطية للرجوع إليها
                                            حسب إحتياجاتكم
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header ">
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link arrow collapsed"
                                                data-toggle="collapse"
                                                data-target="#collapse-2"
                                            >
                                                كيف يمكنني الاشتراك في ماي اوفرز
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        class="collapse"
                                        id="collapse-2"
                                        data-parent="#accordion"
                                    >
                                        <div class="card-body">
                                            تمتع بالحماية الكاملة لجميع بياناتك المستخدمة … كما
                                            يوفر الموقع نسخة إحتياطية للرجوع إليها حسب
                                            إحتياجاتكمتمتع بالحماية الكاملة لجميع بياناتك
                                            المستخدمة … كما يوفر الموقع نسخة إحتياطية للرجوع إليها
                                            حسب إحتياجاتكم
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link arrow collapsed"
                                                data-toggle="collapse"
                                                data-target="#collapse-3"
                                            >
                                                كيف يمكنني الاشتراك في ماي اوفرز
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        class="collapse "
                                        id="collapse-3"
                                        data-parent="#accordion"
                                    >
                                        <div class="card-body">
                                            تمتع بالحماية الكاملة لجميع بياناتك المستخدمة … كما
                                            يوفر الموقع نسخة إحتياطية للرجوع إليها حسب
                                            إحتياجاتكمتمتع بالحماية الكاملة لجميع بياناتك
                                            المستخدمة … كما يوفر الموقع نسخة إحتياطية للرجوع إليها
                                            حسب إحتياجاتكم
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header " id="headingOne">
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link arrow collapsed"
                                                data-toggle="collapse"
                                                data-target="#collapse-4"
                                            >
                                                كيف يمكنني الاشتراك في ماي اوفرز
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        class="collapse "
                                        id="collapse-4"
                                        data-parent="#accordion"
                                    >
                                        <div class="card-body">
                                            تمتع بالحماية الكاملة لجميع بياناتك المستخدمة … كما
                                            يوفر الموقع نسخة إحتياطية للرجوع إليها حسب
                                            إحتياجاتكمتمتع بالحماية الكاملة لجميع بياناتك
                                            المستخدمة … كما يوفر الموقع نسخة إحتياطية للرجوع إليها
                                            حسب إحتياجاتكم
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header " id="headingOne">
                                        <h5 class="mb-0">
                                            <button
                                                class="btn btn-link arrow collapsed"
                                                data-toggle="collapse"
                                                data-target="#collapse-5"
                                            >
                                                كيف يمكنني الاشتراك في ماي اوفرز
                                            </button>
                                        </h5>
                                    </div>
                                    <div
                                        class="collapse "
                                        id="collapse-5"
                                        data-parent="#accordion"
                                    >
                                        <div class="card-body">
                                            تمتع بالحماية الكاملة لجميع بياناتك المستخدمة … كما
                                            يوفر الموقع نسخة إحتياطية للرجوع إليها حسب
                                            إحتياجاتكمتمتع بالحماية الكاملة لجميع بياناتك
                                            المستخدمة … كما يوفر الموقع نسخة إحتياطية للرجوع إليها
                                            حسب إحتياجاتكم
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="image text-left">
                        <img src="{{asset("public/dashboard/images/website/bg-index/img-question.png")}}"alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section_lastSites">
        <div class="imageOverlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 text-center text-lg-right">
                    <h3 class="title_section color-general">أخر المواقع</h3>
                    <div class="sliderLastSites owl-carousel owl-theme">
                        <div class="item-lastSites">
                            <img src="{{asset("public/dashboard/images/2-logo.jpg")}}"alt="" class="img_site mx-auto mx-lg-0">
                            <h3 class="title_site">شركة دايتشن</h3>
                            <h5 class="info_site">
                                يهدف دايتشن إلى أن يكون المصدر المفضل للتعرف على نمط الحياة الصحية عبر تقديم حلول و خطط غذائية
                            </h5>
                        </div>
                        <div class="item-lastSites">
                            <img src="{{asset("public/dashboard/images/4-logo.webp")}}"alt="" class="img_site mx-auto mx-lg-0">
                            <h3 class="title_site">متجر فيض التميز</h3>
                            <h5 class="info_site">
                                فيض التميز.. قرطاسية و اكثر.. دفاتر بتصاميم مميزة.. واقلام وحقائب..
                            </h5>
                        </div>
                        <div class="item-lastSites">
                            <img src="{{asset("public/dashboard/images/30idZ1QK_400x400.jpg")}}"alt="" class="img_site mx-auto mx-lg-0">
                            <h3 class="title_site"> شركة الجنيد</h3>
                            <h5 class="info_site">
                                تأسست شركة الجنيد للتجارة من قبل الشيخ/ أحمد عبدالمعطي الجنيد رحمه الله في عام 1967م
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="serversWatch mt-5 mt-lg-0">
                        <img src="https://salla.sa/site/wp-content/themes/salla/assets/images/iMac.png">
                        <div class="bg_tv-overlay">
                            <a href="" class="play-button"
                            ><img class="imageShowVideo" src="{{asset("public/dashboard/images/eye.png")}}"alt=""
                                /></a>
                            <div class="sliderImageVideo owl-carousel owl-theme">
                                <div class="image-video">
                                    <img src="{{asset("public/dashboard/images/2-screenshot.jpg")}}"alt="" class="img-video">
                                </div>
                                <div class="image-video">
                                    <img src="{{asset("public/dashboard/images/4-screenshot.jpg")}}"alt="" class="img-video">
                                </div>
                                <div class="image-video">
                                    <img src="{{asset("public/dashboard/images/7-screenshot.jpg")}}"alt="" class="img-video">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section_testimonial">
        <div class="container">
            <div class="d-flex align-items-center justify-content-center">
                <h3 class="title_section color-general ml-3 mb-0">قالو عنا</h3>
                <img src="{{asset("public/dashboard/images/logo_3.png")}}"alt="" width="100" />
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="sliderTestimonial owl-carousel owl-theme">
                        <div class="item-testimonial">
                            <div class="testimonial-header">
                                <div class="testimonial-avatar">
                                    <img src="{{asset("public/dashboard/images/website/bg-index/avatar.png")}}"alt="" />
                                </div>
                                <div class="testimonial-author">
                                    <h4 class="testimonial-author-name">احمد محمد</h4>
                                    <h4 class="testimonial-author-service">
                                        الخدمات الاستشارية
                                    </h4>
                                </div>
                            </div>
                            <div class="testimonial-content">
                                <h5 class="testimonial-content-text">
                                    أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                    الإحترافية، بكل يسر وسهولة أول منصة عربية بإمكانيات عالمية
                                    لتصميم وإدارة المواقع الإحترافية، بكل يسر وسهولة أول منصة
                                    عربية بإمكانيات عالمية لتصميم وإدارة المواقع الإحترافية،
                                    بكل يسر وسهولة أول منصة عربية بإمكانيات عالمية لتصميم
                                    وإدارة المواقع الإحترافية، بكل يسر وسهولة أول منصة عربية
                                </h5>
                            </div>
                        </div>
                        <div class="item-testimonial">
                            <div class="testimonial-header">
                                <div class="testimonial-avatar">
                                    <img src="{{asset("public/dashboard/images/website/bg-index/avatar-3.png")}}"alt="" />
                                </div>
                                <div class="testimonial-author">
                                    <h4 class="testimonial-author-name">خالد يوسف</h4>
                                    <h4 class="testimonial-author-service">
                                        الخدمات الاستشارية
                                    </h4>
                                </div>
                            </div>
                            <div class="testimonial-content">
                                <h5 class="testimonial-content-text">
                                    أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                    الإحترافية، بكل يسر وسهولة أول منصة عربية بإمكانيات عالمية
                                    لتصميم وإدارة المواقع الإحترافية، بكل يسر وسهولة أول منصة
                                    عربية بإمكانيات عالمية لتصميم وإدارة المواقع الإحترافية،
                                    بكل يسر وسهولة أول منصة عربية بإمكانيات عالمية لتصميم
                                    وإدارة المواقع الإحترافية، بكل يسر وسهولة أول منصة عربية
                                </h5>
                            </div>
                        </div>
                        <div class="item-testimonial">
                            <div class="testimonial-header">
                                <div class="testimonial-avatar">
                                    <img src="{{asset("public/dashboard/images/website/bg-index/avatar-2.png")}}"alt="" />
                                </div>
                                <div class="testimonial-author">
                                    <h4 class="testimonial-author-name">هند الريس</h4>
                                    <h4 class="testimonial-author-service">
                                        الخدمات الاستشارية
                                    </h4>
                                </div>
                            </div>
                            <div class="testimonial-content">
                                <h5 class="testimonial-content-text">
                                    أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                    الإحترافية، بكل يسر وسهولة أول منصة عربية بإمكانيات عالمية
                                    لتصميم وإدارة المواقع الإحترافية، بكل يسر وسهولة أول منصة
                                    عربية بإمكانيات عالمية لتصميم وإدارة المواقع الإحترافية،
                                    بكل يسر وسهولة أول منصة عربية بإمكانيات عالمية لتصميم
                                    وإدارة المواقع الإحترافية، بكل يسر وسهولة أول منصة عربية
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section_packages">
        <div class="imageOverlay"></div>
        <div class="container">
            <h3 class="title_section text-center">الباقات</h3>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="widget_item widget__item_4 widget_1">
                        <div class="widget__item-icon">
                            <img src="{{asset("public/dashboard/images/img-7.png")}}"alt="" />
                        </div>
                        <div class="widget__item-content">
                            <ul class="widget__item-content-list">
                                <li class="widget__item-content-text">
                                    أول منصة عربية بإمكانيات عالمية لتصميم
                                </li>
                                <li class="widget__item-content-text">
                                    وإدارة المواقع الإحترافية، بكل يسر وسهولة
                                </li>
                                <li class="widget__item-content-text">
                                    وإدارة المواقع الإحترافية، بكل يسر وسهولة
                                </li>
                            </ul>
                        </div>
                        <div class="widget__item-cart widget_cart_1">
                            <div class="widget__item-cart-icon">
                                <img src="{{asset("public/dashboard/images/shopping-cart.png")}}"alt="alt" />
                            </div>
                            <div class="widget__item-cart-title">
                                <span class="widget__item-cart-price">300</span>ريال سعودي
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget_item widget__item_4 widget_2 widget__item-bg">
                        <div class="widget__item-icon ">
                            <img src="{{asset("public/dashboard/images/img-8.png")}}"alt="" />
                        </div>
                        <div class="widget__item-content">
                            <ul class="widget__item-content-list">
                                <li class="widget__item-content-text">
                                    أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                    الإحترافية، بكل يسر وسهولة
                                </li>
                                <li class="widget__item-content-text">
                                    أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                    الإحترافية، بكل يسر وسهولة
                                </li>
                                <li class="widget__item-content-text">
                                    أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                    الإحترافية، بكل يسر وسهولة
                                </li>
                                <li class="widget__item-content-text">
                                    أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                    الإحترافية، بكل يسر وسهولة
                                </li>
                            </ul>
                        </div>
                        <div class="widget__item-cart widget_cart_2">
                            <div class="widget__item-cart-icon">
                                <img src="{{asset("public/dashboard/images/shopping-cart.png")}}"alt="alt" />
                            </div>
                            <div class="widget__item-cart-title">
                                <span class="widget__item-cart-price">100</span>ريال سعودي
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget_item widget__item_4 widget_3">
                        <div class="widget__item-icon ">
                            <img src="{{asset("public/dashboard/images/img-9.png")}}"alt="" />
                        </div>
                        <div class="widget__item-content">
                            <ul class="widget__item-content-list">
                                <li class="widget__item-content-text">
                                    أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                    الإحترافية، بكل يسر وسهولة
                                </li>
                                <li class="widget__item-content-text">
                                    أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                    الإحترافية، بكل يسر وسهولة
                                </li>
                                <li class="widget__item-content-text">
                                    أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                    الإحترافية، بكل يسر وسهولة
                                </li>
                                <li class="widget__item-content-text">
                                    أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                    الإحترافية، بكل يسر وسهولة
                                </li>
                            </ul>
                        </div>
                        <div class="widget__item-cart widget_cart_3">
                            <div class="widget__item-cart-icon">
                                <img src="{{asset("public/dashboard/images/shopping-cart.png")}}"alt="alt" />
                            </div>
                            <div class="widget__item-cart-title">
                                <span class="widget__item-cart-price">141</span>ريال سعودي
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget_item widget__item_4 widget_4">
                        <div class="widget__item-icon ">
                            <img src="{{asset("public/dashboard/images/img-10.png")}}"alt="" />
                        </div>
                        <div class="widget__item-content">
                            <ul class="widget__item-content-list">
                                <li class="widget__item-content-text">
                                    أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                    الإحترافية، بكل يسر وسهولة
                                </li>
                                <li class="widget__item-content-text">
                                    أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                    الإحترافية، بكل يسر وسهولة
                                </li>
                                <li class="widget__item-content-text">
                                    أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                    الإحترافية، بكل يسر وسهولة
                                </li>
                                <li class="widget__item-content-text">
                                    أول منصة عربية بإمكانيات عالمية لتصميم وإدارة المواقع
                                    الإحترافية، بكل يسر وسهولة
                                </li>
                            </ul>
                        </div>
                        <div class="widget__item-cart widget_cart_4">
                            <div class="widget__item-cart-icon">
                                <img src="{{asset("public/dashboard/images/shopping-cart.png")}}"alt="alt" />
                            </div>
                            <div class="widget__item-cart-title">
                                <span class="widget__item-cart-price">200</span>ريال سعودي
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section_client">
        <div class="container">
            <h3 class="title_section text-center">عملاؤنا</h3>
            <div class="row">
                <div class="col-lg-11 mx-auto">
                    <div class="sliderClient owl-carousel owl-theme">
                        <div class="item-client">
                            <div class="image-client">
                                <img src="{{asset("public/dashboard/images/website/bg-index/client.png")}}"alt="" />
                            </div>
                        </div>
                        <div class="item-client">
                            <div class="image-client">
                                <img src="{{asset("public/dashboard/images/website/NAV15.png")}}"alt="" />
                            </div>
                        </div>
                        <div class="item-client">
                            <div class="image-client">
                                <img src="{{asset("public/dashboard/images/website/Puma_Logo.png")}}"alt="" />
                            </div>
                        </div>
                        <div class="item-client">
                            <div class="image-client">
                                <img src="{{asset("public/dashboard/images/website/bg-index/client.png")}}"alt="" />
                            </div>
                        </div>
                        <div class="item-client">
                            <div class="image-client">
                                <img src="{{asset("public/dashboard/images/website/bg-index/client-4.png")}}"alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section_download">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-6">
                            <div class="image-lg">
                                <img src="{{asset("public/dashboard/images/website/bg-index/download.png")}}"alt="" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-column align-items-center ">
                                <div
                                    class="d-flex justify-content-center mb-4 align-items-center"
                                >
                                    <h3 class="ml-2">يمكنك الأن تحميل تطبيق</h3>
                                    <img src="{{asset("public/dashboard/images/logo_3.png")}}"alt="" width="80" />
                                </div>
                                <div
                                    class="d-flex justify-content-center align-items-center flex-wrap"
                                >
                                    <a class="mb-2 mb-md-0" href="" target="_blank"
                                    ><img
                                            class="playstore"
                                            src="{{asset("public/dashboard/images/website/bg-index/playstore.png")}}"
                                            alt=""/></a
                                    ><a href="" target="_blank"
                                    ><img
                                            class="playstore"
                                            src="{{asset("public/dashboard/images/website/bg-index/istore.png")}}"
                                            alt=""
                                        /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
