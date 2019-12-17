<html lang="ar">

@include("admin.parts.head")

<body>

<div class="main-wrapper">

    @include("admin.parts.header")

    <div class="main-template">

        <div class="main-content px-0 py-4">

            @section("content")@show

        </div>

    </div>

    @include("admin.parts.footer")

</div>

@include("admin.parts.foot")

</body>
</html>
