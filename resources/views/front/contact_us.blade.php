@extends("front.parts.app")

@section("content")

    <section class="home-intro inernal">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 order-1 order-lg-0">
                    <div class="content-text-right pl-lg-5">
                        <h3 class="text-title">نسعد بخدمتكم ومقترحاتكم</h3>
                    </div>
                </div>
                <div class="col-lg-7 order-0 order-lg-1">
                    <div class="image">
                        <img
                            class="home-image home-image-animate"
                            src="{{asset("public/dashboard/images/website/img-contact.png")}}"
                            alt=""
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="main-grid-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="main_widget_contact">
                        <div class="row">
                            <div class="col-lg-8">
                                <form action="{{route("contact_us_send")}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input name="name" required class="form-control" type="text" placeholder="الاسم"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input name="email" required class="form-control" type="text" placeholder="البريد الالكتروني"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input name="subject" required class="form-control" type="text" placeholder="الموضوع"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <textarea name="message" required class="form-control" rows="8" placeholder="نص الرسالة"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mr-auto">
                                            <div class="form-group">
                                                <button type="submit" class="general-btn-lg-blue">
                                                    ارسال
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-4">
                                <div class="widget_contact_text">
                                    <div class="icon col-auto">
                                        <i class="fas fa-at"></i>
                                    </div>
                                    <div class="details">
                                        <h3>البريد الإلكتروني</h3>
                                        <h4>info@ccreation.sa</h4>
                                    </div>
                                </div>
                                <div class="widget_contact_text">
                                    <div class="icon col-auto">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="details_contact">
                                        <h3>الجوال</h3>
                                        <h4 class="details_contact_number">920007750</h4>
                                    </div>
                                </div>
                                <div class="widget_contact_text">
                                    <div class="icon col-auto">
                                        <i class="fa fa-map-marker-alt"></i>
                                    </div>
                                    <div class="details_contact">
                                        <h3>العنوان</h3>
                                        <h4>الرياض - شارع أنس بن مالك</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
