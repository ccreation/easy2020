@extends("admin.parts.app")

@section("content")

    <div class="container pb-5">

        @if(permissions("plans_add"))
            <a href="{{route("admin.plans.add")}}" class="btn general-btn-sm-blue float-left"><i class="fa fa-plus"></i> <span>إنشاء باقة جديدة</span></a>
        @endif
        <div class="clearfix mb-3"></div>

        <div class="container p-0">
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
                                            @if($plan->id!=1)
                                                @if(permissions("plans_edit"))
                                                    <a href="{{route("admin.plans.edit", $plan->id)}}" class="btn btn-block btn-success text-uppercase"><i class="fa fa-edit"></i> <span>تعديل</span></a>
                                                @endif
                                                @if(permissions("plans_remove"))
                                                    <a href="{{route("admin.plans.delete", $plan->id)}}" onclick="return confirm('هل أنت متأكد')" class="btn btn-block btn-danger text-uppercase"><i class="fa fa-trash"></i> <span>حذف</span></a>
                                                @endif
                                            @else
                                                @if(permissions("plans_edit"))
                                                    <a href="javascript:void(0)" class="btn btn-block btn-dark text-uppercase disabled" disabled style="cursor: not-allowed;"><i class="fa fa-edit"></i> <span>تعديل</span></a>
                                                @endif
                                                @if(permissions("plans_remove"))
                                                    <a href="javascript:void(0)" class="btn btn-block btn-dark text-uppercase disabled" disabled style="cursor: not-allowed;"><i class="fa fa-trash"></i> <span>حذف</span></a>
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

    </div>

@endsection
