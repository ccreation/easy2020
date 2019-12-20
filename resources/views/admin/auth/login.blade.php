<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" href="{{asset("public/favicon.ico")}}" />
    <title>لوحة تحكم إدارة سهل</title>
    <meta property="og:type" content="" />
    <meta property="og:title" content="" />
    <meta property="og:description" content=" " />
    <meta property="og:image" content="" />
    <meta property="og:image:width" content="" />
    <meta property="og:image:height" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content=" " />
    <meta property="og:ttl" content="" />
    <meta name="twitter:card" content="" />
    <meta name="twitter:domain" content="" />
    <meta name="twitter:site" content="" />
    <meta name="twitter:creator" content="" />
    <meta name="twitter:image:src" content="" />
    <meta name="twitter:description" content="" />
    <meta name="twitter:title" content=" " />
    <meta name="twitter:url" content="" />
    <meta name="description" content="  " />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="copyright" content=" " />
    <link rel="stylesheet" href="{{asset("public/dashboard/css/animate.min.css")}}" />
    <link rel="stylesheet" href="{{asset("public/dashboard/css/fontawesome.css")}}" />
    <link rel="stylesheet" href="{{asset("public/dashboard/css/bootstrap-select.css")}}" />
    <link rel="stylesheet" href="{{asset("public/dashboard/css/animate.min.css")}}" />
    <link rel="stylesheet" href="{{asset("public/dashboard/css/bootstrap.css")}}" />
    <link rel="stylesheet" href="{{asset("public/dashboard/css/main.css")}}" />
    <link rel="stylesheet" href="{{asset("public/dashboard/custom.css")}}" />
    <script src="{{asset("public/dashboard/js/jquery.js")}}"></script>
</head>


<body>
<div class="main-wrapper">
    <div class="wrapper-login">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mx-auto">
                    <h2 class="title-logo">سهل</h2>
                    <h5 class="title-login">تسجيل الدخول</h5>

                    <form action="{{ route('admin.login') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <input type="email" name="email" required value="{{old("email")}}" class="form-control" placeholder="البريد الالكتروني">
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" required class="form-control" placeholder="كلمة المرور ">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="d-flex align-items-center mb-4 mb-lg-0">
                                <span class="sh-switch">
                                    <label class="mb-0">
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span></span>
                                    </label>
                                </span>
                                <h5 class="label-languages text-white ml-2">تذكرني</h5>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn-submit">دخول</button>
                        </div>

                        @if (Route::has('admin.password.request'))
                        <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
