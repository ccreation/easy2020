<div id="loading-wrapper">
    <div id="loading"><i class="fa fa-spinner fa-spin fa-5x"></i></div>
</div>
<script src="{{asset("public/dashboard/js/popper.js")}}"></script>
<script src="{{asset("public/dashboard/js/bootstrap.min.js")}}"></script>
<script src="{{asset("public/dashboard/js/bootstrap-select.js")}}"></script>
<script src="{{asset("public/dashboard/js/wow.min.js")}}"></script>
<script src="{{asset("public/dashboard/js/owl.carousel.min.js")}}"></script>
<script src="{{asset("public/dashboard/js/mCustomScrollbar.min.js")}}"></script>
<script src="{{asset("public/dashboard/js/ion.rangeSlider.min.js")}}"></script>
<script src="{{asset("public/dashboard/js/Chart.bundle.min.js")}}"></script>
<script src="{{asset("public/dashboard/js/chartjs-datalabels.js")}}"></script>
<script src="{{asset("public/dashboard/js/function.js")}}"></script>
<script src="{{asset("public/jquery.playSound.js")}}"></script>
<script src="{{asset("public/notif/notifIt.min.js")}}"></script>
<link rel="stylesheet" href="{{asset("public/notif/notifIt.min.css")}}">
<audio controls style="display: none">
    <source src="{{asset("public/notif.mp3")}}" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>
<!-- iCheck -->
<link rel="stylesheet" href="{{asset("public/iCheck/square/purple.css")}}">
<script src="{{asset("public/iCheck/icheck.min.js")}}"></script>

<style>
    #loading{
        text-align: center;
        padding: 30px 0px;
    }

    #loading .fa{
        color: #286090;
        font-size: 8em;
    }

    #loading-wrapper{
        display: none;
    }
    .main-header .main-header-top .main-header-logo img {
        height: 70px;
        border-radius: 4px;
    }

    .dropdown_widget-2 {
        margin-top: -1.5rem !important;
    }

    #ui_notifIt p {
        font-size: 1.2em;
        font-weight: bold;
    }

    .formi {
        border: 1px solid #512293;
        padding: 15px 20px 0px;
        display: none;
    }
</style>

<script>

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

        $(document).on("click", ".btn-open", function (e) {
            e.preventDefault();
            var id = $(this).data("target");
            $(".formi:not("+id+")").slideUp("fast");
            setTimeout(function () {
                $(id).slideToggle();
            }, 200);
        });

        $('input:not(.no_ichek)').iCheck({
            checkboxClass: 'icheckbox_square-purple',
            radioClass: 'iradio_square-purple',
            increaseArea: '20%'
        });

    });

</script>

@section("scripts")@show
