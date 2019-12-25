@extends("client.parts.app")

@section("content")

    <div class="container pb-5 pt-3">

        <h4 class="text-center" style="color: {{$plan->color}};"><b>{{$plan->{"name_".app()->getLocale()} }}</b> <b>({{$plan->monthly_subscription}} <b>{{__("l.rs")}}</b>/<b style="color: {{$plan->color}};"><small>{{__("l.monthly")}}</small></b>)</b></h4>

        <div class="row mt-4">

            <div class="col-md-5">
                <div class="card">
                    <div class="card-header"><b>تفاصيل الباقة</b></div>
                    <div class="card-body">
                        <ul style="width: 100%; padding: 0px; margin: 0px; padding-right: 10px" class="m-0">
                            <li class="mb-10 mt-10"><span>{{__("l.annual_subscription")}}</span> <span class="fa-li" style="width: auto"><smal>{{$plan->annual_subscription}}</smal> <small>{{__("l.rs")}}</small></span></li>
                            <li class="mb-10"><span>{{__("l.discount_percentage")}}</span> <span class="fa-li" style="width: auto"><span>{{$plan->discount_percentage}}</span> <span>%</span></span></li>
                            <li class="mb-10"><span>{{__("l.minimum_subscription_period")}}</span> <span class="fa-li" style="width: auto"><span>{{$plan->minimum_subscription_period}}</span> <span>{{__("l.month")}}</span></span></li>
                            <li class="mb-10"><span>{{__("l.website_numbers")}}</span> <span class="fa-li" style="width: auto">@if($plan->website_numbers==0)<span>{{__("l.unlimited")}}</span>@else<span>{{$plan->website_numbers}}</span> <span>{{__("l.awebsite")}}</span></span>@endif</li>
                            <li class="mb-10"><span>{{__("l.space")}}</span> <span class="fa-li" style="width: auto">@if($plan->disk_space==0)<span>{{__("l.unlimited")}}</span>@else<span>{{$plan->disk_space}}</span> <span>MB</span></span>@endif</li>
                            @if($plan->templates and is_array(unserialize($plan->templates)))
                                <?php $i = count(unserialize($plan->templates)); ?>
                            @else
                                <?php $i=0; ?>
                            @endif
                            <li class="mb-10"><span>{{__("l.free_templates")}}</span> <span class="fa-li" style="width: auto"><span>{{$i}}</span> <span>{{__("l.atemplate")}}</span></span></li>
                            <li class="mb-10"><span class="fa-li">@if($plan->root_domain==1)<i class="fas fa-check"></i>@else<i class="fas fa-times"></i>@endif</span>{{__("l.main_domain")}}</li>
                            <li class="mb-10"><span class="fa-li">@if($plan->multiple_users==1)<i class="fas fa-check"></i>@else<i class="fas fa-times"></i>@endif</span>{{__("l.multi_users")}}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card">
                    <div class="card-header"><b>تمديد الإشتراك</b></div>
                    <div class="card-body">
                        <form id="plan_payment" action="{{route("client.payments.plan_payment")}}" method="post" class="container-fluid pt-10 pl-15 pr-10">
                            @csrf
                            <input type="hidden" name="plan_id" id="plan_id" value="{{$plan->id}}">
                            <input type="hidden" name="tamdid" value="1">

                            <div class="form-group row">
                                <label class="col-sm-4">{{__("l.months_number")}}</label>
                                <select class="form-control col-sm-8" name="months_number" id="months_number">
                                    @foreach(unserialize(@$settings_admin["months"]->value) as $k => $v)
                                        <?php $m = $v % 12; $y = intval( $v / 12 ); ?>
                                        <option value="{{$v}}">
                                            @if($y>0) <span>{{$y}}</span> <span>{{__("l.year")}}</span> @endif @if($m>0) @if($y>0)<span>{{__("l.and")}}</span>@endif <span>{{$m}}</span> <span>{{__("l.month")}}</span> @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4">{{__("l.coupon")}}</label>
                                <div class="input-group col-sm-8 p-0">
                                    <input type="text" class="form-control" name="coupon" id="coupon_code" />
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" id="coupon"><i class="fa fa-check text-white"></i> <span>{{__("l.confirmation")}}</span></button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4"></label>
                                <div class="col-sm-8 p-0"><span>{{__("l.total")}} : </span><span id="total">{{number_format($plan->monthly_subscription, 1)}}</span> <span>{{__("l.rs")}}</span></div>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn general-btn-sm-blue"><i class="fa fa-money-bill"></i> <span>{{__("l.continue")}}</span></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-20">
                <div class="card">
                    <div class="card-header"><b>الإشتراك الحالي</b></div>
                    <div class="card-body">

                        <table class="table table-ticket">
                            <thead>
                                <tr class="ticketlistheaderrow">
                                    <th>{{__("l.plan")}}</th>
                                    <th>{{__("l.duration")}}</th>
                                    <th>{{__("l.total")}}</th>
                                    <th>{{__("l.subscription_date")}}</th>
                                    <th>{{__("l.subscription_end")}}</th>
                                    <th>{{__("l.remaining_duration")}}</th>
                                    <th>{{__("l.status")}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($subscription)
                                <tr class="ticketlistproperties">
                                    <td>
                                        <a href="{{route("client.plans.buy", $subscription->plan_id)}}" class="btn btn-sm btn-label-brand btn-bold btn-block" target="_blank" style="color: #ffffff; background: {{@$subscription->plan->color}}">{{@$subscription->plan->{"name_".app()->getLocale()} }}</a>
                                    </td>
                                    <td>
                                        <b>
                                            @if($subscription->years_number and $subscription->years_number!=0)
                                                <span>{{$subscription->years_number}}</span> <span>{{__("l.year")}}</span> <span>{{__("l.and")}}</span>
                                            @endif
                                            <span>{{$subscription->months_number}}</span> <span>{{__("l.month")}}</span>
                                        </b>
                                    </td>
                                    <td class="text-center">
                                        <span>{{$subscription->total}}</span> <span>{{__("l.rs")}}</span>
                                    </td>
                                    <td class="text-center">
                                        <?php $subscription_date = \Carbon\Carbon::parse($subscription->subscription_date); ?>
                                        <span>{{$subscription_date->format("Y-m-d")}}</span>
                                    </td>
                                    <td class="text-center">
                                        <?php $subscription_end =  $subscription_date->addMonth(intval($subscription->months_number))->addYear(intval($subscription->years_number)); ?>
                                        <span>{{$subscription_end->format("Y-m-d")}}</span>
                                    </td>
                                    <td class="text-center">
                                        <span>{{$subscription_end->shortRelativeToNowDiffForHumans(3)}}</span>
                                    </td>
                                    <td class="text-center">
                                        @if($subscription->status=="pending")
                                            <span class="btn btn-sm btn-bold btn-block btn-warning">{{__("l.".$subscription->status)}}</span>
                                        @elseif($subscription->status=="rejected")
                                            <span class="btn btn-sm btn-bold btn-block btn-danger">{{__("l.".$subscription->status)}}</span>
                                        @else
                                            <span class="btn btn-sm btn-bold btn-block btn-success">{{__("l.".$subscription->status)}}</span>
                                        @endif
                                    </td>
                                </tr>
                            @else
                                <tr class="ticketlistproperties">
                                    <td colspan="7" class="text-center"><strong>{{__("l.no_data")}}</strong></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>


        </div>

    </div>

@endsection

@section("scripts")

    <style>
        .card-header{
            background-color: #543c93;
            color: #fff;
            font-weight: bold;
        }
        .card{
            border-color: #543c93;
        }
        #coupon{
            border-radius: 0px;
            background-color: #543c93;
            border-color: #543c93;
        }
        .mb-10{
            margin-bottom: 10px;
        }
        .mt-10{
            margin-top: 10px;
        }
        .mt-20{
            margin-top: 20px;
        }
        .fa-li{
            left: 10px;
        }
        .sold{
            height: 27px;
            background: #21d232;
            padding: 3px 8px;
            font-weight: bold;
            color: #fff;
            width: 130px;
            transform: rotateZ(-45deg);
            z-index: 1;
            text-align: center;
            position: absolute;
            top: 20px;
            left: -30px;
            font-size: 1.2em;
        }
        .kt-portlet{
            box-shadow: 0px 0px 13px 4px rgba(82, 63, 105, 0.1);
            overflow: hidden;
            position: relative;
        }
        .kt-widget19 .kt-widget19__pic .kt-widget19__labels{
            left: 25px;
            right: inherit;
        }
        .btn.btn-label-light-o2.free{
            background-color: rgba(0, 255, 24, 0.42);
        }
        .btn.btn-label-light-o2.not-free{
            background-color: rgba(255, 0, 33, 0.56);
        }
    </style>

    <script>

        $(function () {

            var monthly_subscription    = "{{$plan->monthly_subscription}}";
            var annual_subscription     = "{{$plan->annual_subscription}}";

            function calculate_total(){
                var months_number   = $("#months_number").val();
                var years_number    = parseInt(months_number/12);
                months_number       = parseInt(months_number%12);
                if(months_number){
                    var total = months_number * (parseFloat(monthly_subscription)) + years_number * (parseFloat(annual_subscription));
                    total = parseFloat(total).toFixed(1);
                    $("#total").html(total);
                }
            }

            $(document).on("change", "#months_number", function () {
                calculate_total();
            });

            $(document).on("submit", "#plan_payment", function () {
                if($("#months_number").val()==0 && $("#years_number").val()==0){
                    return false;
                }
            });

            $(document).on("click", "#coupon", function () {
                var coupon_code     = $("#coupon_code").val();
                if(!coupon_code || coupon_code=="")
                    return;

                var btn             = $(this);
                $(".fa", btn).attr("class", "fa fa-spin fa-spinner text-white");
                $(btn).prop("disabled", true);
                var plan_id         = $("#plan_id").val();
                var months_number   = $("#months_number").val();
                var years_number    = parseInt(months_number/12);
                months_number       = parseInt(months_number%12);
                var url             = "{{route("client.plans.coupon")}}";
                $.post(url, { "_token" : "{{csrf_token()}}","coupon_code" : coupon_code, "plan_id" : plan_id, "months_number" : months_number, "years_number" : years_number }, function (html) {
                    $("#total").html(html.total);
                }).fail(function(data) {
                    goNotif("error", "{{__("l.coupon_error")}}")
                }).always(function() {
                    $(".fa", btn).attr("class", "fa fa-check text-white");
                    $(btn).prop("disabled", false);
                });

            });

        });

    </script>

@endsection
