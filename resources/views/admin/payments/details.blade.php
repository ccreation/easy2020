@extends("admin.parts.app")

@section("content")

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("admin.home")}}"><i class="fa fa-home"></i> <span>{{__("l.home")}}</span></a></li>
            <li class="breadcrumb-item"><a href="{{route("admin.payments.index")}}"><i class="fa fa-money-bill-wave"></i> <span>قائمة الدفعات</span></a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-money-bill-wave"></i> <span>الدفعة #{{$payment->id}}</span>
            </li>
        </ol>
    </nav>

    <div class="kt-portlet">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-money-bill-wave"></i>
                </span>
                <h3 class="kt-portlet__head-title">الدفعة #{{$payment->id}}</h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        @if($payment->status=="pending")
                            <a class="btn btn-success" onclick="return confirm('هل أنت متأكد ؟')" href="{{route("admin.payments.accept", $payment->id)}}"><i class="fa fa-check"></i> <span>موافقة</span></a>
                            <a class="btn btn-danger" onclick="return confirm('هل أنت متأكد ؟')" href="{{route("admin.payments.reject", $payment->id)}}"><i class="fa fa-times"></i> <span>رفض</span></a>
                        @endif
                        <a class="btn btn-primary" href="{{route("admin.payments.index")}}"><i class="fa fa-list"></i> <span>قائمة الدفعات</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body py-5">

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">تفاصيل عامة</div>
                        <div class="card-body">
                            <ul class="fa-ul" style="margin: 0px; padding: 0px">
                                <li><span>حالة الدفع</span> <span class="fa-li" style="width: auto">{{__("l.".$payment->status)}}</span></li>
                                <li><span>إسم العميل</span> <span class="fa-li" style="width: auto">{{@$payment->client->name}}</span></li>
                                <li><span>إسم المستخدم</span> <span class="fa-li" style="width: auto">{{@$payment->client_user->name}}</span></li>
                                <li><span>طريقة الدفع</span> <span class="fa-li" style="width: auto">{{__("l.".@$payment->payment_method)}}</span></li>
                                <li><span>تاريخ الدفع</span> <span class="fa-li" style="width: auto">{{@$payment->payment_date}}</span></li>
                                <li><span>المبلغ</span> <span class="fa-li" style="width: auto"><span>{{@$payment->total}}</span> <span>رس</span></span></li>
                            </ul>
                        </div>
                    </div>
                </div>

                @if($payment->plan)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">الباقة</div>
                            <div class="card-body">
                                <ul class="fa-ul" style="margin: 0px; padding: 0px">
                                    <li style="color: {{@$payment->plan->color}}"><span>إسم الباقة</span> <span class="fa-li" style="width: auto"><smal>{{@$payment->plan->name_ar}}</smal></span></li>
                                    <li><span>ثمن الباقة الشهري</span> <span class="fa-li" style="width: auto"><smal>{{@$payment->plan->monthly_subscription}}</smal> <small>رس</small></span></li>
                                    <li><span>ثمن الباقة السنوي</span> <span class="fa-li" style="width: auto"><smal>{{@$payment->plan->annual_subscription}}</smal> <small>رس</small></span></li>
                                    <li><span>نسبة الخصم</span> <span class="fa-li" style="width: auto"><span>{{@$payment->plan->discount_percentage}}</span> <span>%</span></span></li>
                                    <li><span>اقل مدة اشتراك</span> <span class="fa-li" style="width: auto"><span>{{@$payment->plan->minimum_subscription_period}}</span> <span>شهر</span></span></li>
                                    <li><span>عدد المواقع</span> <span class="fa-li" style="width: auto">@if(@$payment->plan->website_numbers==0)<span>غير محدود</span>@else<span>{{@$payment->plan->website_numbers}}</span> <span>موقع</span></span>@endif</li>
                                    <li><span>المساحة</span> <span class="fa-li" style="width: auto">@if(@$payment->plan->disk_space==0)<span>غير محدود</span>@else<span>{{@$payment->plan->disk_space}}</span> <span>MB</span></span>@endif</li>
                                    @if(@$payment->plan->templates and is_array(unserialize(@$payment->plan->templates)))
                                        <?php $i = count(unserialize(@$payment->plan->templates)); ?>
                                    @else
                                        <?php $i=0; ?>
                                    @endif
                                    <li><span>القوالب المجانية</span> <span class="fa-li" style="width: auto"><span>{{$i}}</span> <span>قالب</span></span></li>
                                    <li><span class="fa-li">@if(@$payment->plan->root_domain==1)<i class="fas fa-check"></i>@else<i class="fas fa-times"></i>@endif</span>دومين رئيسي</li>
                                    <li><span class="fa-li">@if(@$payment->plan->multiple_users==1)<i class="fas fa-check"></i>@else<i class="fas fa-times"></i>@endif</span>متعدد المستخدمين</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">الثمن</div>
                            <div class="card-body">
                                <ul class="fa-ul" style="margin: 0px; padding: 0px">
                                    <li>
                                        <span>{{__("l.annual_subscription")}}</span>
                                        <span class="fa-li"><span>{{@$payment->plan->annual_subscription}}</span> <small>{{__("l.rs")}}</small></span>
                                    </li>
                                    <li>
                                        <span>{{__("l.monthly_subscription")}}</span>
                                        <span class="fa-li"><span>{{@$payment->plan->monthly_subscription}}</span> <small>{{__("l.rs")}}</small></span>
                                    </li>
                                    <li>
                                        <span width="70%">{{__("l.years_number")}}</span>
                                        <span class="fa-li"><span>{{$payment->years_number}}</span></span>
                                    </li>
                                    <li>
                                        <span>{{__("l.months_number")}}</span>
                                        <span class="fa-li"><span>{{$payment->months_number}}</span></span>
                                    </li>
                                    <li>
                                        <span><b>{{__("l.total")}}</b></span>
                                        @php
                                            $total = @$payment->plan->monthly_subscription * $payment->months_number+@$payment->plan->annual_subscription*$payment->years_number;

                                            $total = ($total<=0)?0:$total;
                                            $total = number_format($total, 1);
                                        @endphp
                                        <span class="fa-li"><b>{{$total}}</b> <small>{{__("l.rs")}}</small></span>
                                    </li>
                                    @if(@@$payment->promocode->data["reward_type"]!==null)
                                        <li class="text-danger">
                                            <span>{{__("l.coupon")}} : {{@@$payment->promocode->data["name"]}}</span>
                                            <span class="fa-li">
                                                @if(@$payment->promocode->data["reward_type"]==0)
                                                    <span>{{@$payment->promocode->reward}}</span> <small>%</small>
                                                @else
                                                    <span>{{@$payment->promocode->reward}}</span> <small>{{__("l.rs")}}</small>
                                                @endif
                                            </span>
                                        </li>
                                        <li>
                                            <span><b>{{__("l.final_total")}}</b></span>
                                            @php
                                                $total = @$payment->plan->monthly_subscription * $payment->months_number+@$payment->plan->annual_subscription*$payment->years_number;

                                                if(@@$payment->promocode->data["reward_type"]==0)
                                                    $total = ($total - ($total/100*floatval(@$payment->promocode->reward)));
                                                else
                                                    $total = $total - floatval(@$payment->promocode->reward);

                                                $total = ($total<=0)?0:$total;
                                                $total = number_format($total, 1);
                                            @endphp
                                            <span class="fa-li"><b>{{$total}}</b> <small>{{__("l.rs")}}</small></span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @if($payment->template)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">القالب</div>
                            <div class="card-body">
                                <ul class="fa-ul" style="margin: 0px; padding: 0px">
                                    <li><span>إسم القالب</span> <span class="fa-li" style="width: auto"><smal>{{@$payment->template->name_ar}}</smal></span></li>
                                    <li><span>تصنيف القالب</span> <span class="fa-li" style="width: auto"><smal>{{@$payment->template->category->name_ar}}</smal></span></li>
                                    <li><span>عدد الصفحات</span> <span class="fa-li" style="width: auto"><smal>{{@$payment->template->pages_count}}</smal> <small>صفحة</small></span></li>
                                    @if(@$payment->template->homepage)
                                        <li>
                                            <span>
                                                <a href="{{route("website.index2", [@$payment->template->slug])}}" target="_blank" style="width: 100%; text-decoration: underline;">مشاهدة القالب</a>
                                            </span>
                                        </li>
                                    @endif
                                    <li><span>ثمن القالب</span> <span class="fa-li" style="width: auto"><smal>{{@$payment->template->price}}</smal> <small>رس</small></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @if(@$payment->payment_method != "credit_card")
                    <div class="col-md-12 mt-20">
                        <div class="card">
                            <div class="card-header">{{__("l.".@$payment->payment_method)}}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="fa-ul" style="margin: 0px; padding: 0px">
                                            <li><span>البنك المحول إليه</span> <span class="fa-li" style="width: auto"><smal>{{@$payment->to_bank->name}}</smal></span></li>
                                            <li><span>البنك المحول منه</span> <span class="fa-li" style="width: auto"><smal>{{@$payment->from_bank->name_ar}}</smal></span></li>
                                            <li><span>{{__("l.transferer_name")}}</span> <span class="fa-li" style="width: auto"><smal>{{@$payment->transferer_name}}</smal></span></li>
                                            <li><span>{{__("l.transferer_account_number")}}</span> <span class="fa-li" style="width: auto"><smal>{{@$payment->transferer_account_number}}</smal></span></li>
                                            <li><span>{{__("l.transferer_date")}}</span> <span class="fa-li" style="width: auto"><smal>{{@$payment->transferer_date}}</smal></span></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="db mb-10">{{__("l.transferer_image")}}</span>
                                        <img src="{{asset("storage/app/".$payment->transferer_image)}}" style="width: 200px; border-radius: 3px; border:2px solid #eee;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>

    </div>

    <style>
        ul.fa-ul li{
            margin-bottom: 10px;
        }
        .fa-li {
            left: 0px;
            width: auto;
            min-width: 100px;
            display: inline-block;
            text-align: left;
        }
    </style>

@endsection
