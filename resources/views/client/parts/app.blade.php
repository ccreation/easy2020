<html lang="ar">

@include("client.parts.head")

<body>

<div class="main-wrapper">

    @include("client.parts.header")

    <div class="main-template">

        <div class="main-content px-0 py-4">

            @section("content")@show

        </div>

    </div>

    @include("client.parts.footer")

</div>

@include("client.parts.foot")

</body>
</html>
