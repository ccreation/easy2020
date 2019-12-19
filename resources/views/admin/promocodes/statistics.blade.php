@extends("admin.parts.app")

@section("content")

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("admin.home")}}"><i class="fa fa-home"></i> <span>{{__("l.home")}}</span></a></li>
            <li class="breadcrumb-item"><a href="{{route("admin.promocodes.index")}}"><i class="fa fa-money-check-alt"></i> <span>الكوبونات</span></a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-chart-bar"></i> <span>إحصائيات كوبون</span> <span>"{{@$promocode->data["name"]}}"</span></li>
        </ol>
    </nav>

    <div class="kt-portlet">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-chart-bar"></i>
                </span>
                <h3 class="kt-portlet__head-title"><span>إحصائيات كوبون</span> <span>"{{@$promocode->data["name"]}}"</span></h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{route("admin.promocodes.index")}}" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-money-check-alt"></i> <span>قائمة الكوبونات</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body pricing py-5">

            Coming Soon...

        </div>
    </div>

@endsection

@section("scripts")

    <script>

        $(function () {



        });

    </script>

@endsection
