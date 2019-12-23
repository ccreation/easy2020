<html lang="ar">

@include("front.parts.head")

<body>

    <div class="main-grid-fluid @if(@$inernal) inernal inernal_2 @endif">

        @include("front.parts.header")

            @section("content")@show

        @include("front.parts.footer")

    </div>

@include("front.parts.foot")

</body>

</html>
