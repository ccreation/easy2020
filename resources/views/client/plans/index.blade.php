@extends("client.parts.app")

@section("content")

    <div class="container pb-5 pt-3">

        <div class="main-packages wow fadeInUp animate" data-wow-duration="1.5s" data-wow-delay=".1s">

            <div class="header-packages">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="text-white text-center">الباقة</h3>
                    </div>
                    @foreach($plans as $plan)
                        <div class="col">
                            <div class="thumb-packages text-center" style="background: {{$plan->color}} !important;">
                                <b style="color:#ffffff">{{$plan->name_ar}}</b>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="body-packages require_packages">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="widget__item-packages">
                            <h4 class="widget__item-packages-title">ثمن الباقة السنوي</h4>
                        </div>
                    </div>
                    @foreach($plans as $plan)
                        @if(!$plan->annual_subscription or $plan->annual_subscription == 0)
                            <div class="col">
                                <div class="widget__item-packages packages-bg">
                                    <span class="widget__item-packages-content font-family-sans-serif price">مجاناً</span>
                                </div>
                            </div>
                        @else
                            <div class="col">
                                <div class="widget__item-packages packages-bg">
                                    <span class="widget__item-packages-content font-family-sans-serif price">{{$plan->annual_subscription}} <span>ريال</span></span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="row align-items-center mb-5">
                    <div class="col"></div>
                    @foreach($plans as $plan)
                        <div class="col">
                            <div class="widget__item-packages">
                                @if(@$plan->status=="accepted")
                                    <span class="sold">{{__("l.sold")}}</span>
                                @endif
                                @if(@$plan->status=="pending")
                                    <span class="sold" style="background: orange">{{__("l.pending")}}</span>
                                @endif
                                @if($c->plan_id==$plan->id)
                                    <span class="default_plan">{{__("l.default_plan")}}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="require_packages">
                <div class="require_packages-header">
                    <h3 class="require_packages-title">خصائص الباقة</h3>
                </div>
                <div class="require_packages-body">
                    <div class="require_packages-row">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="widget__item-packages">
                                    <h4 class="widget__item-packages-title">نسبة الخصم :</h4>
                                </div>
                            </div>
                            @foreach($plans as $plan)
                                <div class="col">
                                    <div class="widget__item-packages packages-bg">
                                        <span class="widget__item-packages-content"><strong><span>{{$plan->discount_percentage}}</span> <span>%</span></strong></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="require_packages-row">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="widget__item-packages">
                                    <h4 class="widget__item-packages-title">اقل مدة اشتراك :</h4>
                                </div>
                            </div>
                            @foreach($plans as $plan)
                                <div class="col">
                                    <div class="widget__item-packages packages-bg">
                                        <span class="widget__item-packages-content"><strong><span>{{$plan->minimum_subscription_period}}</span> <span>شهر</span></strong></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="require_packages-row">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="widget__item-packages">
                                    <h4 class="widget__item-packages-title">عدد المواقع :</h4>
                                </div>
                            </div>
                            @foreach($plans as $plan)
                                <div class="col">
                                    <div class="widget__item-packages packages-bg">
                                        <span class="widget__item-packages-content"><strong>@if($plan->website_numbers==0)<span>غير محدود</span>@else<span>{{$plan->website_numbers}}</span> <span>موقع</span>@endif</strong></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="require_packages-row">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="widget__item-packages">
                                    <h4 class="widget__item-packages-title">المساحة :</h4>
                                </div>
                            </div>
                            @foreach($plans as $plan)
                                <div class="col">
                                    <div class="widget__item-packages packages-bg">
                                        <span class="widget__item-packages-content"><strong>@if($plan->disk_space==0)<span>غير محدود</span>@else<span>{{$plan->disk_space}}</span> <span>MB</span>@endif</strong></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="require_packages-row">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="widget__item-packages">
                                    <h4 class="widget__item-packages-title">القوالب المجانية :</h4>
                                </div>
                            </div>
                            @foreach($plans as $plan)
                                @if($plan->templates and is_array(unserialize($plan->templates)))
                                    <?php $i = count(unserialize($plan->templates)); ?>
                                @else
                                    <?php $i=0; ?>
                                @endif
                                <div class="col">
                                    <div class="widget__item-packages packages-bg">
                                        <span class="widget__item-packages-content"><strong><span>{{$i}}</span> <span>قالب</span></strong></span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="require_packages">
                <div class="require_packages-header">
                    <h3 class="require_packages-title">المتطلبات الأساسية</h3>
                </div>
                <div class="require_packages-body">
                    <div class="require_packages-row">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="widget__item-packages">
                                    <h4 class="widget__item-packages-title">دومين رئيسي :</h4>
                                </div>
                            </div>
                            @foreach($plans as $plan)
                                @if($plan->root_domain == 1)
                                    <div class="col">
                                        <div class="widget__item-packages packages-bg">
                                            <span class="widget__item-packages-dote dote-active"></span>
                                        </div>
                                    </div>
                                @else
                                    <div class="col">
                                        <div class="widget__item-packages packages-bg">
                                            <span class="widget__item-packages-dote none-active"></span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="require_packages-row">
                        <div class="row  align-items-center">
                            <div class="col">
                                <div class="widget__item-packages">
                                    <h4 class="widget__item-packages-title">متعدد المستخدمين :</h4>
                                </div>
                            </div>
                            @foreach($plans as $plan)
                                @if($plan->multiple_users == 1)
                                    <div class="col">
                                        <div class="widget__item-packages packages-bg">
                                            <span class="widget__item-packages-dote dote-active"></span>
                                        </div>
                                    </div>
                                @else
                                    <div class="col">
                                        <div class="widget__item-packages packages-bg">
                                            <span class="widget__item-packages-dote none-active"></span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="require_packages-row">
                        <div class="row  align-items-center">
                            <div class="col">
                                <div class="widget__item-packages">
                                    <h4 class="widget__item-packages-title">{{__("l.website_multi_lang")}} :</h4>
                                </div>
                            </div>
                            @foreach($plans as $plan)
                                @if($plan->default_lang == 1)
                                    <div class="col">
                                        <div class="widget__item-packages packages-bg">
                                            <span class="widget__item-packages-dote dote-active"></span>
                                        </div>
                                    </div>
                                @else
                                    <div class="col">
                                        <div class="widget__item-packages packages-bg">
                                            <span class="widget__item-packages-dote none-active"></span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="require_packages mt-4">
                <div class="require_packages-body">
                    <div class="require_packages-row" style="border: none;">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="widget__item-packages"></div>
                            </div>
                            @foreach($plans as $plan)
                                <div class="col">
                                    <div class="widget__item-packages">
                                        @if($c->plan_id!=$plan->id and (!@$plan->status or @$plan->status == "rejected"))
                                            @if(cpermissions("plans_purchase_use"))
                                                <a href="{{route("client.plans.buy", $plan->id)}}" class="btn general-btn-sm-blue btn-block text-uppercase"><span>{{__("l.buy_this_plan")}}</span></a>
                                            @endif
                                        @elseif($c->plan_id==$plan->id )
                                            @if(cpermissions("plans_purchase_use"))
                                                <a href="{{route("client.plans.details", $plan->id)}}" class="btn general-btn-sm-black btn-block text-uppercase"><span>{{__("l.plan_details")}}</span></a>
                                            @endif
                                        @else
                                            @if(cpermissions("plans_purchase_use"))
                                                <a href="javascript:void(0)" class="btn general-btn-sm-blue text-uppercase btn-block disabled" disabled style="opacity: 0;cursor: not-allowed;"><span>{{__("l.buy_this_plan")}}</span></a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <style>
        .default_plan, .sold{
            border-radius: 10px;
            background: #21d232;
            padding: 10px;
            font-weight: bold;
            color: #fff;
            width: 100%;
            text-align: center;
            font-size: 1.2em;
            display: block;
        }

        .default_plan{
        background: #7d58ae;
        }

        .pricing {
            background: #007bff;
            background: linear-gradient(to right, #0062E6, #33AEFF);
        }

        .pricing .card {
            border: none;
            border-radius: 1rem;
            transition: all 0.2s;
            box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
        }

        .pricing hr {
            margin: 1.5rem 0;
        }

        .pricing .card-title {
            margin: 0.5rem 0;
            font-size: 0.9rem;
            letter-spacing: .1rem;
            font-weight: bold;
        }

        .pricing .card-price {
            font-size: 3rem;
            margin: 0;
        }

        .pricing .card-price .period {
            font-size: 0.8rem;
        }

        .pricing ul li {
            margin-bottom: 1rem;
        }

        .pricing .text-muted {
            opacity: 0.7;
        }

        .pricing .btn {
            font-size: 80%;
            border-radius: 5rem;
            letter-spacing: .1rem;
            font-weight: bold;
            padding: 1rem;
            opacity: 0.7;
            transition: all 0.2s;
        }

        /* Hover Effects on Card */

        @media (min-width: 992px) {
            .pricing .card:hover {
                margin-top: -.25rem;
                margin-bottom: .25rem;
                box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);
            }
            .pricing .card:hover .btn {
                opacity: 1;
            }
        }
    </style>

@endsection
