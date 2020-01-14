<script src="{{asset("public/dashboard/js/jquery.js")}}"></script>
<script src="{{asset("public/dashboard/js/popper.js")}}"></script>
<script src="{{asset("public/dashboard/js/bootstrap.min.js")}}"></script>
<script src="{{asset("public/dashboard/js/bootstrap-select.js")}}"></script>
<script src="{{asset("public/dashboard/js/wow.min.js")}}"></script>
<script src="{{asset("public/dashboard/js/owl.carousel.min.js")}}"></script>
<script src="{{asset("public/dashboard/js/perfect-scrollbar.min.js")}}"> </script>
<script src="{{asset("public/dashboard/js/ion.rangeSlider.min.js")}}"></script>
<script src="{{asset("public/dashboard/js/function.js")}}"></script>
<script src="{{asset("public/jquery.playSound.js")}}"></script>
<script src="{{asset("public/notif/notifIt.min.js")}}"></script>
<link rel="stylesheet" href="{{asset("public/notif/notifIt.min.css")}}">
<audio controls style="display: none">
    <source src="{{asset("public/notif.mp3")}}" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<style>
    #ui_notifIt p {
        font-size: 1.2em;
        font-weight: bold;
    }
    .widget__item_dropdown_inner_content{
        min-height: 140px;
    }
    .main_header_option .widget__item-list{
        margin: 0px auto;
    }
    .widght-single-image{
        background: #fff;
        height: 110px;
        width: 110px;
        position: relative;
    }
    .widght-single-image .image_name{
        width: 100%;
        color: #fff;
        font-size: 0.9em;
        background: #0000008f;
        overflow: hidden;
        height: 17px;
        text-align: center;
        line-height: 17px;
        position: absolute;
        bottom: 0px;
    }
</style>

<script>

    $.fn.confirm = function(methods) {
        $("#ModalPannel_3").modal("show");
        $("#ModalPannel_3 .conf").unbind("click");
        $("#ModalPannel_3 .conf").on("click", function () {
            methods.conf();
            setTimeout(function () {
                $("#ModalPannel_3 .conf").unbind("click");
                $("#ModalPannel_3").modal("hide");
            }, 200);
        })
    };

    function goNotif(type, text) {
        notif({msg: text, type: type});
        $.playSound('{{asset("public/notif.mp3")}}');
    }

    $(function () {

        @if(count($errors)>0)
        @foreach($errors->all() as $error)
        goNotif("error", "{{$error}}");
        @endforeach
        @endif

        @if(session()->has('error'))
        goNotif("error", "{{session('error')}}");
        @endif

        @if(session()->has('success'))
        goNotif("success", "{!! session('success') !!}");
        @endif

    });
    
    $('body .scroll').each(function(){ const ps = new PerfectScrollbar($(this)[0]); });
    $(".rangeSlider").ionRangeSlider({
        min: 0,
        max: 100,
        from: 50
    });

    $('.toggle-sticky-toolbar').click(function(){
        $('.main-sticky-toolbar').toggleClass('sticky-toolbar-active')
    })

</script>

@section("scripts")@show
