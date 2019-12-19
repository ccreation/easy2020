@extends("admin.parts.app")

@section("content")

    <div class="container-fluid" style="position: relative; min-height: 500px;">

        @if(permissions("add_client"))
            <a href="{{route("admin.clients.add")}}" class="btn general-btn-sm-blue float-left"><i class="fa fa-plus"></i> <span>إضافة عميل</span></a>
        @endif

        <a href="javascript:void(0)" onclick="$('#clients_show').slideToggle();" class="btn general-btn-sm-blue float-left" style="margin-left: 15px;"><i class="fa fa-list"></i> <span>عرض</span></a>
        <form id="clients_show" class="row" action="javascript:void(0)">
            @csrf

            <div class="col-sm-12"><h4 class="mb-2" style="color: #543C93;">عرض : </h4></div>

            <div class="col-sm-12 mb-2">
                <label>
                    <input type="checkbox" value="image" class="employee_columns" name="employee_columns[]" @if(in_array("image", @$employee_columns)) checked @endif> <span>الصورة</span>
                </label>
            </div>

            <div class="col-sm-12 mb-2">
                <label>
                    <input type="checkbox" value="name" class="employee_columns" name="employee_columns[]" @if(in_array("name", @$employee_columns)) checked @endif> <span>الإسم</span>
                </label>
            </div>

            <div class="col-sm-12 mb-2">
                <label>
                    <input type="checkbox" value="email" class="employee_columns" name="employee_columns[]" @if(in_array("email", @$employee_columns)) checked @endif> <span>الإيميل</span>
                </label>
            </div>

            <div class="col-sm-12 mb-2">
                <label>
                    <input type="checkbox" value="mobile" class="employee_columns" name="employee_columns[]" @if(in_array("mobile", @$employee_columns)) checked @endif> <span>الجوال</span>
                </label>
            </div>

            <div class="col-sm-12 mb-2">
                <label>
                    <input type="checkbox" value="plan" class="employee_columns" name="employee_columns[]" @if(in_array("plan", @$employee_columns)) checked @endif> <span>الباقة</span>
                </label>
            </div>

            <div class="col-sm-12 mb-2">
                <label>
                    <input type="checkbox" value="subscription_date" class="employee_columns" name="employee_columns[]" @if(in_array("subscription_date", @$employee_columns)) checked @endif> <span>ينتهي الاشتراك بعد	</span>
                </label>
            </div>

            <div class="col-sm-12 mb-2">
                <label>
                    <input type="checkbox" value="promocode" class="employee_columns" name="employee_columns[]" @if(in_array("promocode", @$employee_columns)) checked @endif> <span>الكوبون</span>
                </label>
            </div>

            <div class="col-sm-12 mb-2">
                <label>
                    <input type="checkbox" value="status" class="employee_columns" name="employee_columns[]" @if(in_array("status", @$employee_columns)) checked @endif> <span>الحالة</span>
                </label>
            </div>

            <div class="col-sm-12 mb-2">
                <div class="row">
                    <div class="text-center col-sm-12" style="padding-top: 5px">
                        <button type="submit" class="btn general-btn-sm-blue">عرض</button>
                    </div>
                </div>
            </div>

        </form>

        <a href="javascript:void(0)" onclick="$('#clients_filter').slideToggle();" class="btn general-btn-sm-blue float-left" style="margin-left: 15px;"><i class="fa fa-filter"></i> <span>الفلاتر</span></a>
        <form id="clients_filter" class="row" action="javascript:void(0);">

            <div class="col-sm-12"><h4 class="mb-2" style="color: #543C93;">الفلاتر : </h4></div>

            <div class="col-sm-12 mb-2">
                <input type="text" class="name form-control" placeholder="الإسم">
            </div>

            <div class="col-sm-12 mb-2">
                <input type="text" class="email form-control" placeholder="الإيميل">
            </div>

            <div class="col-sm-12 mb-2">
                <input type="text" class="mobile form-control" placeholder="الجوال">
            </div>

            <div class="col-sm-12 mb-2">
                <select class="plan form-control">
                    <option value="all">الباقة</option>
                    @foreach($plans as $plan)
                        <option value="{{$plan->id}}">{{$plan->name_ar}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-12 mb-2">
                <select class="promocode form-control">
                    <option value="all">الكوبون</option>
                    @foreach($promocodes as $promocode)
                        <option value="{{$promocode->id}}">{{$promocode->data["name"]}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-12 mb-2">
                <select class="status form-control">
                    <option value="all">الحالة</option>
                    <option value="1">مفعل</option>
                    <option value="0">موقوف</option>
                </select>
            </div>

            <div class="col-sm-12 mb-2">
                <div class="row">
                    <div class="text-center col-sm-6" style="padding-top: 5px">
                        <button type="submit" class="btn general-btn-sm-blue">فلتر</button>
                    </div>

                    <div class="text-center col-sm-6" style="padding-top: 5px">
                        <button type="reset" class="btn general-btn-lg-black">فسخ</button>
                    </div>
                </div>
            </div>

        </form>

        <div class="clearfix mb-3"></div>

        <table class="table table-ticket" id="clients_table">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th class="text-center display" style="display: table-cell;" width="20">#</th>
                    <th class="image" style="@if(in_array("image", @$employee_columns)) display: table-cell; @endif" width="50">الصورة</th>
                    <th class="name" style="@if(in_array("name", @$employee_columns)) display: table-cell; @endif">الإسم</th>
                    <th class="email" style="@if(in_array("email", @$employee_columns)) display: table-cell; @endif">الإيميل</th>
                    <th class="mobile" style="@if(in_array("mobile", @$employee_columns)) display: table-cell; @endif">الجوال</th>
                    <th class="plan" style="@if(in_array("plan", @$employee_columns)) display: table-cell; @endif">الباقة</th>
                    <th class="subscription_date" style="@if(in_array("subscription_date", @$employee_columns)) display: table-cell; @endif" width="200">ينتهي الاشتراك بعد</th>
                    <th class="promocode" style="@if(in_array("promocode", @$employee_columns)) display: table-cell; @endif">الكوبون</th>
                    <th class="status" style="@if(in_array("status", @$employee_columns)) display: table-cell; @endif">الحالة</th>
                    <th class="display" style="display: table-cell;">الأوامر</th>
                </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
                <tr class="ticketlistproperties" data-name0="{{$client->name}}" data-mobile0="{{@$client->default_user[0]->mobile}}"
                    data-email0="{{@$client->default_user[0]->email}}" data-plan0="{{@$client->plan_id}}"
                    data-status0="{{$client->status}}" data-promocode0="{{@$client->subscription->payment->promocode->id}}">
                    <td class="text-center display" style="display: table-cell;"><strong>{{$loop->iteration}}</strong></td>
                    <td class="text-center image" style="@if(in_array("image", @$employee_columns)) display: table-cell; @endif">
                        @if($client->image)
                            <img src="{{asset("storage/app/".$client->image)}}" style="width: 50px; height: 50px; display: block; margin: 0px auto; border: 1px solid #eee; border-radius: 4px;" />
                        @else
                            <img src="{{asset("public/no-image.png")}}" style="width: 50px; height: 50px; display: block; margin: 0px auto; border: 1px solid #eee; border-radius: 4px;" />
                        @endif
                    </td>
                    <td class="name" style="@if(in_array("name", @$employee_columns)) display: table-cell; @endif">{{$client->name}}</td>
                    <td class="email" style="@if(in_array("email", @$employee_columns)) display: table-cell; @endif">{{@$client->default_user[0]->email}}</td>
                    <td class="mobile" style="@if(in_array("mobile", @$employee_columns)) display: table-cell; @endif">{{@$client->default_user[0]->mobile}}</td>
                    <td class="plan" style="@if(in_array("plan", @$employee_columns)) display: table-cell; @endif" class="text-center">
                        <strong style="color: {{@$client->plan->color}}">{{@$client->plan->name_ar}}</strong>
                    </td>
                    <td class="subscription_date" style="@if(in_array("subscription_date", @$employee_columns)) display: table-cell; @endif">
                        @if($client->subscription)
                            <?php
                            $subscription_date = \Carbon\Carbon::parse($client->subscription->subscription_date);
                            $subscription_end =  $subscription_date->addMonth(intval($client->subscription->months_number))->addYear(intval($client->subscription->years_number));
                            $now = \Carbon\Carbon::now();
                            ?>
                            <span>{{$subscription_end->diffInDays($now)}}</span> <span>يوم</span>
                        @endif
                    </td>
                    <td class="promocode" style="@if(in_array("promocode", @$employee_columns)) display: table-cell; @endif">
                        @if($client->subscription)
                            <?php $data = json_decode(@$client->subscription->payment->promocode->data); ?>
                            <span>{{@$data->name}}</span>
                        @endif
                    </td>
                    <td class="status" style="@if(in_array("status", @$employee_columns)) display: table-cell; @endif">
                        @if($client->status)
                            <div class="status-prj enabled">مفعل</div>
                        @else
                            <div class="status-prj unacceptable">موقوف</div>
                        @endif
                    </td>
                    <td class="text-center display" style="display: table-cell;">
                        <div class="action">
                            @if(permissions("show_client"))
                                <a href="{{route("admin.clients.show", $client->id)}}" title="عرض">
                                    <img src="{{asset("public/dashboard/images/eye.png")}}" alt="" />
                                </a>
                            @endif
                            @if(permissions("update_client"))
                                <a href="{{route("admin.clients.edit", $client->id)}}" title="تعديل">
                                    <img src="{{asset("public/dashboard/images/settings.png")}}" alt="">
                                </a>
                            @endif
                            @if(permissions("remove_client"))
                                <a data-toggle="tooltip" title="حذف" href="{{route("admin.clients.delete", $client->id)}}" onclick="return confirm('هل أنت متأكد ؟')">
                                    <img src="{{asset("public/dashboard/images/cpanel/delete.png")}}" alt="">
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection

@section("scripts")

    <style>
        #clients_table th, #clients_table td{
            display: none;
        }
        #clients_show, #clients_filter{
            display: none;
            padding: 10px 10px 20px;
            width: 300px;
            background: #E4D8F0;
            border: 1px solid #543C93;
            position: absolute;
            top: 46px;
            left: 224px;
            z-index: 333;
        }
        #clients_show{
            left: 64px;
        }
        .general-btn-lg-black{
            padding: 10px 40px;
        }
    </style>

    <script>
        $(function () {

            $(document).on("submit", "#clients_show", function (e){
                e.preventDefault();
                $("#clients_table th:not(.display), #clients_table td:not(.display)").css("display", "none");
                $.each($('.employee_columns:checkbox:checked'), function (i, e) {
                    var classs = $(e).val();
                    $("#clients_table th."+classs+", #clients_table td."+classs).css("display", "table-cell");
                });
                var url = "{{route("admin.clients.employee_columns")}}";

                $.post(url, $("#clients_show").serialize(), function () {

                });
            });

            $(document).on("submit", "#clients_filter", function (e) {
                e.preventDefault();
                var name        = $("#clients_filter .name").val()+"";
                var email       = $("#clients_filter .email").val()+"";
                var mobile      = $("#clients_filter .mobile").val()+"";
                var plan        = $("#clients_filter .plan").val()+"";
                var promocode   = $("#clients_filter .promocode").val()+"";
                var status      = $("#clients_filter .status").val()+"";

                $("#clients_table tbody tr").hide();
                $("#clients_table tbody tr").filter(function () {

                    var namex = true;
                    var name0 = $(this).data('name0')+"";
                    if(name!=""){
                        if(!name0.includes(name))
                            namex = false;
                    }

                    var emailx = true;
                    var email0 = $(this).data('email0')+"";
                    if(email != ""){
                        if(!email0.includes(email))
                            emailx = false;
                    }

                    var mobilex = true;
                    var mobile0 = $(this).data('mobile0')+"";
                    if(mobile != ""){
                        if(!mobile0.includes(mobile))
                            mobilex = false;
                    }

                    var planx = true;
                    var plan0 = $(this).data('plan0')+"";
                    if(plan != "all"){
                        if(plan0 != plan)
                            planx = false;
                    }

                    var promocodex = true;
                    var promocode0 = $(this).data('promocode0')+"";
                    if(promocode != "all"){
                        if(promocode0 != promocode)
                            promocodex = false;
                    }

                    var statusx = true;
                    var status0 = $(this).data('status0')+"";
                    if(status!="all"){
                        if(status0!=status)
                            statusx = false;
                    }

                    return (namex && emailx && mobilex && planx && promocodex && statusx);
                }).show();
                $('#clients_filter').slideUp();

            });

            $(document).on("reset", "#clients_filter", function (e) {
                e.preventDefault();
                $('#clients_filter .name').val("");
                $('#clients_filter .email').val("");
                $('#clients_filter .mobile').val("");
                $('#clients_filter .plan').val("all");
                $('#clients_filter .promocode').val("all");
                $('#clients_filter .status').val("all");
                $("#clients_table tbody tr").show();
                $('#clients_filter').slideUp();
            });

        });
    </script>

@endsection
