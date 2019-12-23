<header class="main-header">
    <div class="main-header-top">
        <div class="container">
            <div class="s-container">
                <div class="main-header-logo">
                    <a href="{{route("admin.home")}}">
                        <img src="{{asset("public/favicon.jpg")}}" alt="Logo"/>
                        <div style="color: #fff; font-weight: bold; text-align: center; width: 137px; height: 71px; display: inline-block; background: #282a3c; line-height: 74px; border-radius: 5px; background: {{@$my_plan->color}}">{{@$my_plan->{"name_".@$lang} }}</div>
                    </a>
                </div>
                <div class="header__topbar">
                    <div class="header__topbar-item dropdown ml-5">
                        <div class="header__topbar-wrapper" data-toggle="dropdown" aria-expanded="false">
                            <span class="header__topbar-icon"><img src="{{asset("public/dashboard/images/cpanel/user.png")}}" alt="" /></span><span
                                class="header__topbar-text">{{Auth::guard("client")->user()->name}}</span>
                        </div>
                    </div>
                    <div class="header__topbar-item dropdown ml-2">
                        <a href="{{ route('client.logout') }}" onclick="window.location.href='{{ route('client.logout') }}'" class="header__topbar-wrapper" data-toggle="dropdown" aria-expanded="false">
                            <span class="header__topbar-icon"><i class="far fa-sign-out"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-header-bottom">
        <div class="container">
            <div class="header_menu">
                <ul class="header_menu_nav">
                    @if(cpermissions("home_preview"))
                        <li class="menu-item">
                            <a class="menu-item-link @if(Request::url() == route("client.home")) active @endif" href="{{route("client.home")}}"><span class="menu-item-icon"><i class="fa fa-home fa-2x text-white"></i></span><span class="menu-item-text">{{__("l.home")}}</span></a>
                        </li>
                    @endif
                    @if(cpermissions("users_section_list"))
                        @if(@$my_plan->multiple_users==1)
                            <li class="menu-item">
                                <a class="menu-item-link @if(Request::is("client/users/*")) active @endif" href="{{route("client.users.index")}}"><span class="menu-item-icon"><i class="fa fa-home fa-2x text-white"></i></span><span class="menu-item-text">{{__("l.users_section")}}</span></a>
                            </li>
                        @endif
                    @endif
                    @if(cpermissions("my_websites_list_all") or cpermissions("my_websites_list_only_mine"))
                        <li class="menu-item">
                            <a class="menu-item-link @if(Request::is("client/websites/*")) active @endif" href="{{route("client.websites.index")}}"><span class="menu-item-icon"><i class="fa fa-globe fa-2x text-white"></i></span><span class="menu-item-text">{{__("l.my_websites")}}</span></a>
                        </li>
                    @endif
                    @if(cpermissions("settings_general"))
                        <li class="menu-item">
                            <a class="menu-item-link @if(Request::url()==route("client.settings.index")) active @endif" href="{{route("client.settings.index")}}"><span class="menu-item-icon"><i class="fa fa-cog fa-2x text-white"></i></span><span class="menu-item-text">{{__("l.general_settings")}}</span></a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</header>
