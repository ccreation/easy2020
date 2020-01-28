@extends("client.parts.app")

@section("content")

    <div class="container pt-3 pb-5" style="min-height: 500px;">

        <h4 class="mb-4 text-center" style="color: #512293"><b><span>إضافة دومين جديد </span> <span>"{{$domain}}"</span> <span>للموقع</span> "<span>{{$website->{"name_".app()->getLocale()} }}</span>"</b></h4>

        <div class="card card-primary">
            <div class="card-header"><span class="plix" style="width: 27px; height: 27px; line-height: 26px; font-size: 17px;">2</span> <span>أضف هذه الإعدادات إلى الحساب الخاص بالدومين الجديد</span></div>
            <div class="card-body">

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
                            <td style="direction: initial; text-align: right;">{{env("cname_sub_domain")}}</td>
                        </tr>
                    </table>

                    <h4 class="text-center" style="direction: initial;">
                        <span>{{urldecode(route("website.index", $website->slug))}}</span>
                        <span> ==> </span>
                        <span>http://{{$domain}}</span>
                    </h4>

                    <input type="hidden" name="id" value="{{$website->id}}">
                    <input type="hidden" name="domain" value="{{$domain}}">

                    <p class="text-center mt-2">قد يأخذ بضعة دقائق لربط الدومين الجديد</p>

                    <div class="form-group mt-2 text-center">
                        <button type="submit" class="general-btn-md btn" style="background-color: #512293;"><i class="fa fa-check"></i> <span>التحقق من الدومين</span></button>
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
