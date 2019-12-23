<script src="{{asset("public/dashboard/js/jquery.js")}}"></script>
<script src="{{asset("public/dashboard/js/popper.js")}}"></script>
<script src="{{asset("public/dashboard/js/bootstrap.min.js")}}"></script>
<script src="{{asset("public/dashboard/js/bootstrap-select.js")}}"></script>
<script src="{{asset("public/dashboard/js/wow.min.js")}}"></script>
<script src="{{asset("public/dashboard/js/owl.carousel.min.js")}}"></script>
<script src="{{asset("public/dashboard/js/jquery.steps.js")}}"></script>
<script src="{{asset("public/dashboard/js/jquery.countTo.js")}}"></script>
<script src="{{asset("public/dashboard/js/function.js")}}"></script>
<script>

    $(".timer-1").countTo();
    $(".timer-2").countTo();
    $(".timer-3").countTo();
    $(".timer-4").countTo();

    @if(count($errors)>0)
        @foreach($errors->all() as $error)
            alert("{{$error}}");
        @endforeach
    @endif

    @if(session()->has('error'))
        alert("{{session('error')}}");
    @endif

    @if(session()->has('success'))
        alert("{{session('success')}}");
    @endif
</script>

@section("scripts")@show
