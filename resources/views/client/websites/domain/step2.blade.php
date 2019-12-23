@extends("client.parts.app")

@section("content")

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("client.home")}}"><i class="fa fa-home"></i> <span>{{__("l.home")}}</span></a></li>
            <li class="breadcrumb-item"><a href="{{route("client.websites.index")}}"><i class="fa fa-globe"></i> <span>{{__("l.my_websites")}}</span></a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fab fa-internet-explorer"></i> <span>إضافة دومين جديد للموقع</span></li>
        </ol>
    </nav>

    <div class="kt-portlet">

        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fab fa-internet-explorer"></i>
                </span>
                <h3 class="kt-portlet__head-title"><span>إضافة دومين جديد </span> <span>"{{$domain}}"</span> <span>للموقع</span> "<span>{{$website->{"name_".app()->getLocale()} }}</span>"</h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{route("client.websites.index")}}" class="btn btn-brand btn-elevate btn-icon-sm"><i class="fa fa-list"></i> <span>{{__("l.websites_list")}}</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <h5><span class="plix" style="width: 27px; height: 27px; line-height: 26px; font-size: 17px;">2</span> <span>أضف هذه الإعدادات إلى الحساب الخاص بالدومين الجديد</span></h5>

            <div style="border: 1px solid #eee; padding: 15px 15px 0px; margin-top: 15px; background: #f5f5f5;">

                <form id="step3_form" action="{{route("client.websites.add_domain_step_3")}}" method="post" style=" ">
                    @csrf

                    <table class="table table-bordered mt-15" style="font-size: 1.1em;">
                        <tr>
                            <td width="20%">DNS Record</td>
                            <td>CNAME</td>
                        </tr>
                        <tr>
                            <td>Host</td>
                            <td>@</td>
                        </tr>
                        <tr>
                            <td>Answer</td>
                            <td style="direction: initial;">{{env("cname_sub_domain")}}</td>
                        </tr>
                    </table>

                    <h4 class="text-center" style="direction: initial;">
                        <span>{{urldecode(route("website.index", $website->slug))}}</span>
                        <span> ==> </span>
                        <span>http://{{$domain}}</span>
                    </h4>

                    <input type="hidden" name="id" value="{{$website->id}}">
                    <input type="hidden" name="domain" value="{{$domain}}">

                    <p class="text-center">قد يأخذ بضعة دقائق لربط الدومين الجديد</p>

                    <div class="form-group mb-20 mt-15 text-center">
                        <button type="submit" class="btn btn-primary w200"><i class="fa fa-check"></i> <span>التحقق من الدومين</span></button>
                    </div>

                </form>

                <form id="step4_form" action="{{route("client.websites.add_domain_step_4")}}" method="post" style="display: none;">
                    @csrf

                    <input type="hidden" name="id" value="{{$website->id}}">
                    <input type="hidden" name="domain" value="{{$domain}}">

                    <div class="form-group mb-20 mt-15 text-center">
                        <button type="submit" class="btn btn-success w200"><i class="fa fa-check"></i> <span>نشر الموقع</span></button>
                    </div>

                </form>

            </div>

        </div>
    </div>



@endsection

@section("scripts")

    <script>
        $(function () {
            $(document).on("submit", "#step3_form", function (e) {
                e.preventDefault();
                var url = $(this).attr("action");
                var data = $(this).serialize();
                $.post(url, data, function (json) {
                    console.log(json);
                    if(json.error)
                        goNotif("error", json.error);
                    if(json.success){
                        goNotif("success", json.success);
                        $("#step4_form").slideDown();
                    }
                });
                return false;
            })
        });
    </script>

@endsection
