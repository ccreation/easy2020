@extends("front.parts.app")

@section("content")

    <section class="home-intro inernal">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 order-1 order-lg-0">
                    <div class="content-text-right pl-lg-5">
                        <h3 class="text-title">تسجيل دخول</h3>
                    </div>
                </div>
                <div class="col-lg-7 order-0 order-lg-1">
                    <div class="image">
                        <img
                            class="home-image home-image-animate"
                            src="{{asset("public/dashboard/images/website/img-login.png")}}"
                            alt=""
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="main-grid-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="content-text-right">
                        <h3 class="text-title-register text-center">قم بتسجيل الدخول بحسابك </h3>
                        <div class="content__regsiter">
                            <form action="{{ route('client.do_login') }}"  method="post">
                                @csrf

                                <div class="widget__item_5">
                                    <div class="widget__item_lable">
                                        <div class="widget__item-icon">
                                            <img src="{{asset("public/dashboard/images/envelope-sm.png")}}" alt="alt" />
                                        </div>
                                        <div class="widget__item-text">
                                            <h4>البريد الالكتروني</h4>
                                        </div>
                                    </div>
                                    <div class="widget__item_input">
                                        <input class="form-control @error('email') is-invalid @enderror" type="email" value="{{ old('email') }}" required="" placeholder="البريد الإلكتروني" name="email" autocomplete="off" style="font-family: Arial;">
                                    </div>
                                </div>

                                @error('email')
                                <div class="invalid-feedback"style="display: block;" role="alert"><strong>{{ $message }}</strong></div>
                                @enderror

                                <div class="widget__item_5">
                                    <div class="widget__item_lable">
                                        <div class="widget__item-icon">
                                            <img src="{{asset("public/dashboard/images/lock.png")}}" alt="alt" />
                                        </div>
                                        <div class="widget__item-text">
                                            <h4>كلمة المرور</h4>
                                        </div>
                                    </div>
                                    <div class="widget__item_input">
                                        <input class="form-control" type="password" required="" placeholder="كلمة المرور" name="password" autocomplete="off">
                                    </div>
                                </div>
                                @error('password')
                                <div class="invalid-feedback" style="display: block;" role="alert"><strong>{{ $message }}</strong></div>
                                @enderror
                                <div class="widget__item_5 pl-2 text-right">
                                    <label class="m-checkbox">تذكرني <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}/><span class="checkmark"></span></label>
                                </div>
                                <div class="widget__item_5 mt-5 text-center">
                                    <button class="general-btn-md-green px-5 btn_submit" type="submit">
                                        تسجيل الدخول
                                    </button>
                                </div>
                                <div class="widget__item_5 text-center">
                                    <a href="{{route("register")}}">تسجيل حساب جديد</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
