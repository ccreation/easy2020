<header class="main-header">
    <div class="main-header-top">
        <div class="container">
            <div class="s-container">
                <div class="main-header-logo">
                    <a href="{{route("admin.home")}}"><img src="{{asset("public/dashboard/images/favicon.jpg")}}" alt="Logo"/></a>
                </div>
                <div class="header__topbar">
                    <div class="header__topbar-item dropdown ml-5">
                        <div class="header__topbar-wrapper" data-toggle="dropdown" aria-expanded="false">
                            <span class="header__topbar-icon"><img src="{{asset("public/dashboard/images/cpanel/user.png")}}" alt="" /></span><span
                                class="header__topbar-text">{{Auth::guard("web")->user()->name}}</span>
                        </div>
                    </div>
                    <div class="header__topbar-item dropdown ml-2">
                        <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="header__topbar-wrapper" data-toggle="dropdown" aria-expanded="false">
                            <span class="header__topbar-icon"><i class="far fa-sign-out"></i></span>
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                    <div class="header__topbar-item dropdown ml-2">
                        <div class="header__topbar-wrapper" data-toggle="dropdown" aria-expanded="false">
                            <span class="header__topbar-icon"><i class="far fa-bell"></i></span>
                            <span class="header__topbar-text">0</span>
                        </div>
                        <div class="dropdown-menu dropdown-menu-fit   dropdown-menu-lg">
                            <div class="a-notification ">
                                <a href="myProfile.html" class="a-notification__item">
                                    <div class="a-notification__item-details flex-row">
                                        <div class="a-notification__item-title">
                                            رسالة جديدة من احمد
                                        </div>
                                    </div>
                                </a>
                                <a href="balance.html" class="a-notification__item">
                                    <div class="a-notification__item-details flex-row">
                                        <div class="a-notification__item-title">
                                            رسالة جديدة من احمد الريس
                                        </div>
                                    </div>
                                </a>
                                <a href="fav.html" class="a-notification__item">
                                    <div class="a-notification__item-details flex-row">
                                        <div class="a-notification__item-title">
                                            رسالة جديدة من تسجين يوسف
                                        </div>
                                    </div>
                                </a>
                                <a href="login.html" class="a-notification__item">
                                    <div class="a-notification__item-details flex-row">
                                        <div class="a-notification__item-title">
                                            رسالة جديدة من خالد احمد
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="header__topbar-item dropdown ml-2">
                        <div class="header__topbar-wrapper" data-toggle="dropdown" aria-expanded="false">
                            <span class="header__topbar-icon"><i class="fal fa-envelope-open-text"></i></span>
                            <span class="header__topbar-text">0 </span>
                        </div>
                        <div class="dropdown-menu dropdown-menu-fit   dropdown-menu-lg">
                            <div class="a-notification ">
                                <a href="myProfile.html" class="a-notification__item">
                                    <div class="a-notification__item-details flex-row">
                                        <div class="a-notification__item-title">
                                            رسالة جديدة من احمد
                                        </div>
                                    </div>
                                </a>
                                <a href="balance.html" class="a-notification__item">
                                    <div class="a-notification__item-details flex-row">
                                        <div class="a-notification__item-title">
                                            رسالة جديدة من احمد الريس
                                        </div>
                                    </div>
                                </a>
                                <a href="fav.html" class="a-notification__item">
                                    <div class="a-notification__item-details flex-row">
                                        <div class="a-notification__item-title">
                                            رسالة جديدة من تسجين يوسف
                                        </div>
                                    </div>
                                </a>
                                <a href="login.html" class="a-notification__item">
                                    <div class="a-notification__item-details flex-row">
                                        <div class="a-notification__item-title">
                                            رسالة جديدة من خالد احمد
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-header-bottom">
        <div class="container">
            <div class="header_menu">
                <ul class="header_menu_nav">
                    @if(permissions("statistics"))
                        <li class="menu-item">
                            <a class="menu-item-link @if(Request::url() == route("admin.home")) active @endif" href="{{route("admin.home")}}"><span class="menu-item-icon"><i class="fa fa-home fa-2x text-white"></i></span><span class="menu-item-text">الرئيسية</span></a>
                        </li>
                    @endif
                    @if(permissions("users"))
                        <li class="menu-item">
                            <a class="menu-item-link @if(Request::is("users/*")) active @endif" href="{{route("admin.users.index")}}"><span class="menu-item-icon"><i class="fa fa-user-secret fa-2x text-white"></i></span><span class="menu-item-text">قسم المستخدمين</span></a>
                        </li>
                    @endif
                    @if(permissions("clients"))
                        <li class="menu-item">
                            <a class="menu-item-link @if(Request::is("clients/*")) active @endif" href="{{route("admin.clients.index")}}"><span class="menu-item-icon"><i class="fa fa-users fa-2x text-white"></i></span><span class="menu-item-text">قسم العملاء</span></a>
                        </li>
                    @endif
                    @if(permissions("settings"))
                        <li class="menu-item">
                            <a class="menu-item-link @if(Request::is("settings/*")) active @endif" href="{{route("admin.settings.index")}}"><span class="menu-item-icon"><i class="fa fa-cogs fa-2x text-white"></i></span><span class="menu-item-text">الإعدادات</span></a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</header>
