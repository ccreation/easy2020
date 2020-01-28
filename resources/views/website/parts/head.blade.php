<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="{{@$website->{"description_".$lang} }}" />
    <link rel="icon" href="{{@$logo}}" />
    <title>{{($lang=="ar")?@$website->name_ar." | ".$page->name:@$website->name_en." | ".$page->name_en}}</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="{{asset("public/easy/assets/css/bootstrap.css")}}" type="text/css" />
    <link rel="stylesheet" href="{{asset("public/easy/assets/css/bootstrap-rtl.css")}}" type="text/css" />
    <link rel="stylesheet" href="{{asset("public/easy/assets/fontawesome/css/all.min.css")}}" type="text/css" />
    <link rel="stylesheet" href="{{asset("public/easy/assets/css/style.css")}}" type="text/css" />
    <link rel="stylesheet" href="{{asset("public/easy/assets/css/colors.css")}}" type="text/css" />
    <link rel="stylesheet" href="{{asset("public/easy/assets/css/animate.css")}}" type="text/css" />

    <script src="{{asset("public/easy/assets/js/jquery.js")}}"></script>

    @if(@$my_plugins["5"])
        @if(@$plugin_datas["5"])
            {!! @$plugin_datas["5"]->code !!}
        @endif
    @endif

</head>
