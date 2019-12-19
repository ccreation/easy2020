@extends("admin.parts.app")

@section("content")

    <div class="container-fluid" style="position: relative; min-height: 500px;">

        <a href="javascript:void(0)" onclick="$('#clients_show').slideToggle();" class="btn general-btn-sm-blue float-left"><i class="fa fa-list"></i> <span>عرض</span></a>
        <form id="clients_show" class="row" action="javascript:void(0);">
            @csrf
            <div class="col-sm-12"><h4 class="mb-2" style="color: #543C93;">عرض : </h4></div>

            <div class="col-sm-12 mb-2">
                <label>
                    <input type="checkbox" value="name" class="website_columns" name="website_columns[]" @if(in_array("name", @$website_columns)) checked @endif> <span>الإسم</span>
                </label>
            </div>

            <div class="col-sm-12 mb-2">
                <label>
                    <input type="checkbox" value="category" class="website_columns" name="website_columns[]" @if(in_array("category", @$website_columns)) checked @endif> <span>التخصص</span>
                </label>
            </div>

            <div class="col-sm-12 mb-2">
                <label>
                    <input type="checkbox" value="client" class="website_columns" name="website_columns[]" @if(in_array("client", @$website_columns)) checked @endif> <span>العميل</span>
                </label>
            </div>

            <div class="col-sm-12 mb-2">
                <label>
                    <input type="checkbox" value="plan" class="website_columns" name="website_columns[]" @if(in_array("plan", @$website_columns)) checked @endif> <span>الباقة</span>
                </label>
            </div>

            <div class="col-sm-12 mb-2">
                <label>
                    <input type="checkbox" value="subscription_date" class="website_columns" name="website_columns[]" @if(in_array("subscription_date", @$website_columns)) checked @endif> <span>ينتهي الاشتراك بعد</span>
                </label>
            </div>

            <div class="col-sm-12 mb-2">
                <label>
                    <input type="checkbox" value="visitors" class="website_columns" name="website_columns[]" @if(in_array("visitors", @$website_columns)) checked @endif> <span>عدد الزوار</span>
                </label>
            </div>

            <div class="col-sm-12 mb-2">
                <label>
                    <input type="checkbox" value="space" class="website_columns" name="website_columns[]" @if(in_array("space", @$website_columns)) checked @endif> <span>المساحة</span>
                </label>
            </div>

            <div class="col-sm-12 mb-2">
                <label>
                    <input type="checkbox" value="status" class="website_columns" name="website_columns[]" @if(in_array("status", @$website_columns)) checked @endif> <span>الحالة</span>
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
                <select class="category form-control">
                    <option value="all">التخصص</option>
                    @foreach($catgeories as $catgeory)
                        <option value="{{$catgeory->id}}">{{$catgeory->name_ar}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-12 mb-2">
                <select class="client form-control">
                    <option value="all">العميل</option>
                    @foreach($clients as $client)
                        <option value="{{$client->id}}">{{$client->name}}</option>
                    @endforeach
                </select>
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
                <select class="status form-control">
                    <option value="all">الحالة</option>
                    <option value="1">مفتوح</option>
                    <option value="0">محظور</option>
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
                    <th class="display" style="display: table-cell;" width="50">#</th>
                    <th class="name" style="@if(in_array("name", @$website_columns)) display: table-cell; @endif">الإسم</th>
                    <th class="category" style="@if(in_array("category", @$website_columns)) display: table-cell; @endif">التخصص</th>
                    <th class="client" style="@if(in_array("client", @$website_columns)) display: table-cell; @endif">العميل</th>
                    <th class="plan" style="@if(in_array("plan", @$website_columns)) display: table-cell; @endif">الباقة</th>
                    <th class="subscription_date" style="@if(in_array("subscription_date", @$website_columns)) display: table-cell; @endif" width="200">ينتهي الاشتراك بعد</th>
                    <th class="visitors" style="@if(in_array("visitors", @$website_columns)) display: table-cell; @endif">عدد الزوار</th>
                    <th class="space" style="@if(in_array("space", @$website_columns)) display: table-cell; @endif">المساحة</th>
                    <th class="status" style="@if(in_array("status", @$website_columns)) display: table-cell; @endif">الحالة</th>
                    <th class="display" style="display: table-cell;">الأوامر</th>
                </tr>
            </thead>
            <tbody>
            @foreach($websites as $website)
                <?php $client = @$website->client; ?>
                <tr class="ticketlistproperties" data-name0="{{$website->name_ar}}" data-category0="{{@$website->category->id}}" data-client0="{{@$website->client_id}}"
                    data-plan0="{{@$client->plan_id}}" data-status0="{{$website->status}}">
                    <td class="text-center display" style="display: table-cell;">{{$loop->iteration}}</td>
                    <td class="name" style="@if(in_array("name", @$website_columns)) display: table-cell; @endif"><a style="text-decoration: underline;" target="_blank" href="{{--route("website.index2", $website->slug)--}}">{{$website->name_ar}}</a></td>
                    <td class="category" style="@if(in_array("category", @$website_columns)) display: table-cell; @endif">{{@$website->category->name_ar}}</td>
                    <td class="client" style="@if(in_array("client", @$website_columns)) display: table-cell; @endif">@if($client) <a style="text-decoration: underline;" href="{{route("admin.clients.show", $client->id)}}" target="_blank">{{@$client->name}}</a> @endif</td>
                    <td class="plan" style="@if(in_array("plan", @$website_columns)) display: table-cell; @endif"><strong style="color: {{@$client->plan->color}}">{{@$client->plan->name_ar}}</strong></td>
                    <td class="subscription_date" style="@if(in_array("subscription_date", @$website_columns)) display: table-cell; @endif">
                        @if($client)
                            @if($client->subscription)
                                <?php
                                $subscription_date = \Carbon\Carbon::parse($client->subscription->subscription_date);
                                $subscription_end =  $subscription_date->addMonth(intval($client->subscription->months_number))->addYear(intval($client->subscription->years_number));
                                $now = \Carbon\Carbon::now();
                                ?>
                                <span>{{$subscription_end->diffInDays($now)}}</span> <span>يوم</span>
                            @endif
                        @endif
                    </td>
                    <td class="visitors" style="@if(in_array("visitors", @$website_columns)) display: table-cell; @endif"><span>{{$website->visits_count}}</span> <span>زائر</span></td>
                    <td class="space" style="@if(in_array("space", @$website_columns)) display: table-cell; @endif">
                        <div>
                            <span>المساحة المتوفر : </span>
                            <span>@if(($client)) {{(@$client->plan->disk_space==0) ? "غير محدودة" : @$client->plan->disk_space. "MB"}} @else 0 MB @endif </span>
                        </div>
                        <div>
                            <span>المساحة المستخدمة : </span>
                            <span>@if(($client)) {{@$client->my_size. "MB"}} @else 0 MB @endif </span>
                        </div>
                        <div>
                            <span>النسبة :</span>
                            <strong>
                                @if(($client))
                                    @if(@$client->plan->disk_space==0)
                                        <span>0 %</span>
                                    @else
                                        <span>{{intval(@$client->my_size/@$client->plan->disk_space*100)}} %</span>
                                    @endif
                                @else
                                    <span>0 %</span>
                                @endif
                            </strong>
                        </div>
                    </td>
                    <td class="text-center status" style="@if(in_array("status", @$website_columns)) display: table-cell; @endif">
                        @if($website->status == 1)
                            <span class="status-prj enabled">مفتوح</span>
                        @else
                            <span class="status-prj unacceptable">محظور</span>
                        @endif
                    </td>
                    <td class="text-center display" style="display: table-cell;">
                        <div class="action">
                            @if(permissions("websites_block"))
                                @if($website->status == 1)
                                    <a href="#" onclick="return confirm('هل أنت متأكد ؟')"data-toggle="modal" data-target="#block_website_Modal{{$website->id}}" title="حظر الموقع"><i class="fa fa-thumbs-down"></i></a>
                                @else
                                    <a href="{{route("admin.websites.unblock", $website->id)}}"
                                       onclick="return confirm('هل أنت متأكد ؟')" title="رفع الحظر"><i class="fa fa-thumbs-up"></i></a>
                                @endif
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        @foreach($websites as $website)
            <div class="modal" id="block_website_Modal{{$website->id}}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">حظر موقع "{{$website->name_ar}}"</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{route("admin.websites.block")}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$website->id}}">

                                <div class="form-group">
                                    <label><span>سبب الحظر</span> <span class="text-danger">*</span></label>
                                    <textarea name="block_reason" class="form-control" required rows="5"></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary w200"><i class="fa fa-thumbs-down"></i> <span>حظر</span></button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

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
            left: 26px;
            z-index: 333;
        }
        #clients_show{
            left: 30px;
        }
        .general-btn-lg-black{
            padding: 10px 40px;
        }
    </style>

    <script>

        $(function () {

            $(document).on("submit", "#clients_filter", function (e) {
                e.preventDefault();
                var name        = $("#clients_filter .name").val()+"";
                var category    = $("#clients_filter .category").val()+"";
                var client      = $("#clients_filter .client").val()+"";
                var plan        = $("#clients_filter .plan").val()+"";
                var status      = $("#clients_filter .status").val()+"";

                $("#clients_table tbody tr").hide();
                $("#clients_table tbody tr").filter(function () {

                    var namex = true;
                    var name0 = $(this).data('name0')+"";
                    if(name!=""){
                        if(!name0.includes(name))
                            namex = false;
                    }

                    var categoryx = true;
                    var category0 = $(this).data('category0')+"";
                    if(category!="all"){
                        if(category0 != category)
                            categoryx = false;
                    }

                    var clientx = true;
                    var client0 = $(this).data('client0')+"";
                    if(client!="all"){
                        if(client0 != client)
                            clientx = false;
                    }

                    var planx = true;
                    var plan0 = $(this).data('plan0')+"";
                    if(plan != "all"){
                        if(plan0 != plan)
                            planx = false;
                    }

                    var statusx = true;
                    var status0 = $(this).data('status0')+"";
                    if(status != "all"){
                        if(status0 != status)
                            statusx = false;
                    }

                    return (namex && categoryx && clientx && planx && statusx);
                }).show();
                $('#clients_filter').slideUp();

            });

            $(document).on("reset", "#clients_filter", function (e) {
                e.preventDefault();
                $('#clients_filter .name').val("");
                $('#clients_filter .category').val("all");
                $('#clients_filter .client').val("all");
                $('#clients_filter .plan').val("all");
                $('#clients_filter .status').val("all");
                $("#clients_table tbody tr").show();
                $('#clients_filter').slideUp();
            });

            $(document).on("submit", "#clients_show", function (e){
                e.preventDefault();
                $("#clients_table th:not(.display), #clients_table td:not(.display)").css("display", "none");
                $.each($('.website_columns:checkbox:checked'), function (i, e) {
                    var classs = $(e).val();
                    $("#clients_table th."+classs+", #clients_table td."+classs).css("display", "table-cell");
                });
                var url = "{{route("admin.websites.website_columns")}}";
console.log($("#clients_show").serialize());
                $.post(url, $("#clients_show").serialize(), function () {

                });
            });

        });

    </script>

@endsection
