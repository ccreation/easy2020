<!DOCTYPE html>

<html class="wide wow-animation" dir="{{($lang=="ar")?"rtl":"ltr"}}" lang="{{$lang}}">

@include("website.parts.head")

<body class="stretched {{($lang=="ar")?"rtl":"ltr"}}">

@if($website->multi_lang==1)
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
    <div class="nav-item dropdown language-switcher">
        @if($lang=="ar")
            <a class="dropdown-item language_switcher_link" href="{{route("website.setLocal", [$website->slug, $lang, "en"])}}">
                <div style="display: inline-block; width: 94px; padding-right: 10px;"><span class="flag-icon flag-icon-us"> </span> <span>{{__("l.english")}}</span></div>
                <div class="show-language-switcher" style="display: inline-block; width: 40px; text-align: center;"><i class="fas fa-language" style="font-size: 1.5em; padding-top: 3px;"></i></div>
            </a>
        @else
            <a class="dropdown-item language_switcher_link" href="{{route("website.setLocal", [$website->slug, $lang, "ar"])}}">
                <div style="display: inline-block; width: 94px; padding-right: 10px;"><span class="flag-icon flag-icon-sa"> </span> <span>{{__("l.arabic")}}</span></div>
                <div class="show-language-switcher" style="display: inline-block; width: 40px; text-align: center;"><i class="fas fa-language" style="font-size: 1.5em; padding-top: 3px;"></i></div>
            </a>
        @endif
    </div>
@endif

@if(@$settings["enable_register_visitors"]->value=="1" or @$settings["enable_register_visitors"]->value=="2")
    @auth("visitor")
        <div class="nav-item dropdown language-switcher language-switcher2">
            <a class="dropdown-item" href="{{route("visitor.profile", $lang)}}" title="{{__("l.profile")}}">
                <div style="display: inline-block; width: 94px; padding-right: 10px;"><span>{{__("l.profile")}}</span></div>
                <div class="show-language-switcher2" style="display: inline-block; width: 40px; text-align: center;"><i class="fa fa-user-cog" style="font-size: 1.5em; padding-top: 3px;"></i></div>
            </a>
        </div>
        <div class="nav-item dropdown language-switcher language-switcher3">
            <a class="dropdown-item" href="{{route("visitor.logout", $lang)}}" title="{{__("l.logout")}}">
                <div style="display: inline-block; width: 94px; padding-right: 10px;"><span>{{__("l.logout")}}</span></div>
                <div class="show-language-switcher3" style="display: inline-block; width: 40px; text-align: center;"><i class="fa fa-sign-out-alt" style="font-size: 1.5em; padding-top: 3px;"></i></div>
            </a>
        </div>
    @else
        <div class="nav-item dropdown language-switcher language-switcher2">
            <a class="dropdown-item" href="{{route("website.login", [$website->slug, $lang])}}" title="{{__("l.login")}}">
                <div style="display: inline-block; width: 94px; padding-right: 10px;"><span>{{__("l.login")}}</span></div>
                <div class="show-language-switcher2" style="display: inline-block; width: 40px; text-align: center;"><i class="fa fa-sign-in-alt" style="font-size: 1.5em; padding-top: 3px;"></i></div>
            </a>
        </div>
    @endauth
@endif

<div id="wrapper" class="clearfix">

    <section id="content">

        <div class="content-wrap p-0">

            @section("content")@show

        </div>

    </section>

</div>

@include("website.parts.foot")
</body>
</html>
