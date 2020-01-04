<div class="mobile-menu-overlay active"></div>
<div class="menu-mobile ">
    <i class="fas fa-times p-2"></i>
    <ul class="menu">
        <li class="nav_item">
            <a class="nav_link @if(@$page_num == 1) active @endif" href="{{route("home")}}">الرئيسية </a>
        </li>
        <li class="nav_item">
            <a class="nav_link @if(@$page_num == 2) active @endif" href="{{route("about_us")}}">من نحن </a>
        </li>
        <li class="nav_item">
            <a class="nav_link @if(@$page_num == 3) active @endif" href="{{route("how_it_works")}}"> كيف نعمل </a>
        </li>
        <li class="nav_item">
            <a class="nav_link @if(@$page_num == 4) active @endif" href="{{route("templates")}}"> القوالب</a>
        </li>
        <li class="nav_item">
            <a class="nav_link @if(@$page_num == 5) active @endif" href="{{route("contact_us")}}"> تواصل معنا</a>
        </li>
        @auth("client")
            <li class="nav_item">
                <a class="nav_link login_link" href="{{route("client.home")}}">لوحة التحكم</a>
            </li>
            <li class="nav_item">
                <a class="nav_link login_link" href="{{route("logout")}}">تسجيل الخروج</a>
            </li>
        @else
            <li class="nav_item">
                <a class="nav_link login_link" href="{{route("login")}}">تسجيل الدخول</a>
            </li>
        @endauth
    </ul>
</div>
<header class="main-navigation">
    <div class="container">
        <div class="d-flex align-items-center">
            <div class="ml-4">
                <div class="d-flex align-items-center">
                    <div class="logo d-none d-lg-block">
                        <a href="{{route("home")}}"><img src="{{asset("public/dashboard/images/logo_2.png")}}"alt=""/></a>
                    </div>
                    <div class="logo d-lg-none">
                        <a href="{{route("home")}}"><img src="{{asset("public/dashboard/images/logo-footer.png")}}"alt=""/></a>
                    </div>
                </div>
            </div>
            <div class="menu-container d-flex mr-auto">
                <ul class="main-menu main-nav d-none d-lg-block">
                    <li class="nav_item">
                        <a class="nav_link @if(@$page_num == 1) active @endif" href="{{route("home")}}">الرئيسية </a>
                    </li>
                    <li class="nav_item">
                        <a class="nav_link @if(@$page_num == 2) active @endif" href="{{route("about_us")}}">من نحن </a>
                    </li>
                    <li class="nav_item">
                        <a class="nav_link @if(@$page_num == 3) active @endif" href="{{route("how_it_works")}}"> كيف نعمل </a>
                    </li>
                    <li class="nav_item">
                        <a class="nav_link @if(@$page_num == 4) active @endif" href="{{route("templates")}}"> القوالب</a>
                    </li>
                    <li class="nav_item">
                        <a class="nav_link @if(@$page_num == 5) active @endif" href="{{route("contact_us")}}"> تواصل معنا</a>
                    </li>
                    @auth("client")
                        <li class="nav_item">
                            <a class="nav_link login_link" href="{{route("client.home")}}">لوحة التحكم</a>
                        </li>
                        <li class="nav_item">
                            <a class="nav_link login_link" href="{{route("logout")}}">تسجيل الخروج</a>
                        </li>
                    @else
                        <li class="nav_item">
                            <a class="nav_link login_link" href="{{route("login")}}">تسجيل الدخول</a>
                        </li>
                    @endauth
                </ul>
            </div>
            <a class="d-block d-lg-none" href="#menu" id="toggle"><span></span></a>
        </div>
    </div>
</header>
