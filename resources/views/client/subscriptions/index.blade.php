@extends("client.parts.app")

@section("content")

    <div class="main-template">
        <div class="main-content px-0 py-4">
            <div class="container">

                <div class="main_list_users wow fadeInUp animate" data-wow-duration="1.5s" data-wow-delay=".1s">

                    <h3 class="text-center main-title mb-3">{{__("l.plans")}}</h3>

                    <table class="table table-ticket mb-5">
                        <thead>
                            <tr class="ticketlistheaderrow">
                                <th width="50" class="text-center">#</th>
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
                        <?php $tamdid = false; ?>
                        @if(count($subscriptions)>0)
                            @foreach($subscriptions as $subscription)
                                <tr class="ticketlistproperties">
                                    <td class="text-center"><b>{{$loop->iteration}}</b></td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-label-brand btn-bold btn-block" style="color: #ffffff; background: {{@$subscription->plan->color}}">{{@$subscription->plan->{"name_".app()->getLocale()} }}</a>
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
                                    @if($subscription->tamdid)
                                        <td colspan="3" class="text-center"><span>تمديد الإشتراك</span></td>
                                    @else
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
                                    @endif
                                    <td class="text-center">
                                        @if($subscription->status=="pending")
                                            <span class="status-prj pending">{{__("l.".$subscription->status)}}</span>
                                        @elseif($subscription->status=="rejected")
                                            <span class="status-prj unacceptable">{{__("l.".$subscription->status)}}</span>
                                        @else
                                            <span class="status-prj enabled">{{__("l.".$subscription->status)}}</span>
                                        @endif
                                        @if($subscription->plan_id!=1 and $my_plan->id == $subscription->plan_id and !$tamdid)
                                            <a href="{{route("client.plans.details", $subscription->plan_id)}}" class="btn general-btn-lg-blue rounded btn-block">تمديد الإشتراك</a>
                                            <?php $tamdid = true; ?>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="ticketlistproperties">
                                <td colspan="7" class="text-center"><strong>{{__("l.no_data")}}</strong></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>

                    <h3 class="text-center main-title mb-3">{{__("l.templates")}}</h3>
                    <table class="table table-ticket mb-5">
                        <thead>
                            <tr class="ticketlistheaderrow">
                                <th width="50" class="text-center">#</th>
                                <th>{{__("l.image")}}</th>
                                <th>{{__("l.template_name")}}</th>
                                <th>{{__("l.template_price")}}</th>
                                <th>{{__("l.template_preview")}}</th>
                                <th>{{__("l.website_name")}}</th>
                                <th>{{__("l.preview_site")}}</th>
                                <th>{{__("l.plan")}}</th>
                                <th>{{__("l.status")}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($templates)>0)
                                @foreach($templates as $template)
                                    <tr class="ticketlistproperties">
                                        <td class="text-center" width="50"><b>{{$loop->iteration}}</b></td>
                                        <td>
                                            @if($template->logo)
                                                @php $image = asset("storage/app/".$template->logo); @endphp
                                            @else
                                                @php $image = asset("public/no-image2.png"); @endphp
                                            @endif
                                            <img src="{{$image}}" class="avatar-user" alt="">
                                        </td>
                                        <td>{{$template->{"name_".app()->getLocale()} }}</td>
                                        <td class="text-center">
                                            @if($template->price)
                                                <span class="btn btn-block btn-bold float-left not-free">{{$template->price}} {{__("l.rs")}}</span>
                                            @else
                                                <span class="btn btn-block btn-bold float-left free">{{__("l.free")}}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($template->homepage)
                                                <a target="_blank" href="{{--route("website.index2", [$template->slug])--}}" class="btn general-btn-lg-blue">{{__("l.template_preview")}}</a>
                                            @endif
                                        </td>
                                        <td>{{@$template->website->{"name_".app()->getLocale()} }}</td>
                                        <td class="text-center">
                                            @if(@$template->website->homepage)
                                                <a href="{{--route("website.index2", [$template->slug])--}}" class="btn general-btn-lg-blue" target="_blank">{{__("l.preview_site")}}</a>
                                            @else
                                                <a href="javascript:void(0)" class="btn general-btn-lg-blue disabled"  style="cursor: pointer !important; pointer-events: inherit;"
                                                   onclick="event.preventDefault();alert('{{__("l.you_should_choose_hompage_first")}}')"
                                                   data-toggle="tooltip" title="{{__("l.you_didnt_specify_the_homepage")}}">{{__("l.preview_site")}}</a>
                                            @endif
                                        </td>
                                        <td></td>
                                        <td>
                                            @if(@$template->pivot->status==1)
                                                <span class="status-prj enabled">{{__("l.sold")}}</span>
                                            @else
                                                <span class="status-prj pending">{{__("l.pending")}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="ticketlistproperties">
                                    <td colspan="7" class="text-center"><strong>{{__("l.no_data")}}</strong></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <!--
                    <h3 class="text-center main-title mb-3">الإضافات</h3>
                    <table class="table table-ticket mb-5">
                        <thead>
                        <tr class="ticketlistheaderrow">
                            <th width="5%">م</th>
                            <th width="10%">الصورة</th>
                            <th width="40%">اسم الإضافة</th>
                            <th width="15%">المبلغ</th>
                            <th width="20%">تاريخ الإشتراك</th>
                            <th width="10&">الحالة</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="ticketlistproperties">
                            <td data-title="#" class="number">01</td>
                            <td data-title="الصورة"><img src="../images/avatar-1.png" alt="" class="avatar-user"></td>
                            <td data-title="اسم الإضافة">قالب توت</td>
                            <td data-title="المبلغ" class="number">2,300</td>
                            <td data-title="تاريخ الإشتراك" class="number">27/09/2019</td>
                            <td data-title="الحالة">
                                <span class="status-prj pending">قيد الإنتظار</span>
                            </td>
                        </tr>
                        <tr class="ticketlistproperties">
                            <td data-title="#" class="number">01</td>
                            <td data-title="الصورة"><img src="../images/avatar-1.png" alt="" class="avatar-user"></td>
                            <td data-title="اسم الإضافة">قالب توت</td>
                            <td data-title="المبلغ" class="number">2,300</td>
                            <td data-title="تاريخ الإشتراك" class="number">27/09/2019</td>
                            <td data-title="الحالة">
                                <span class="status-prj enabled">مفعل</span>
                            </td>
                        </tr>
                        <tr class="ticketlistproperties">
                            <td data-title="#" class="number">01</td>
                            <td data-title="الصورة"><img src="../images/avatar-1.png" alt="" class="avatar-user"></td>
                            <td data-title="اسم الإضافة">قالب توت</td>
                            <td data-title="المبلغ" class="number">2,300</td>
                            <td data-title="تاريخ الإشتراك" class="number">27/09/2019</td>
                            <td data-title="الحالة">
                                <span class="status-prj unacceptable">مرفوض</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    -->

                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-columns"></i>
                </span>
                <h3 class="kt-portlet__head-title">{{__("l.plugins")}}</h3>
            </div>
        </div>
        <div class="kt-portlet__body pricing py-5">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th width="55">{{__("l.image")}}</th>
                    <th>{{__("l.plugin")}}</th>
                    <th>{{__("l.total")}}</th>
                    <th>{{__("l.subscription_date")}}</th>
                    <th width="167">{{__("l.status")}}</th>
                </tr>
                </thead>
                <tbody>
                @if(count($plugins)>0)
                    @foreach($plugins as $plugin)
                        <tr>
                            <td class="text-center"><b>{{$loop->iteration}}</b></td>
                            <td class="text-center">
                                <img src="{{asset("storage/app/".$plugin->image)}}" style="background: #eee; width: 55px; height: 55px; display: block; margin: 0px auto; border: 1px solid #eee; border-radius: 4px;">
                            </td>
                            <td>{{$plugin->{"name_".app()->getLocale()} }}</td>
                            <td class="text-center"><span>{{@$plugin->pivot->price}}</span> <span>{{__("l.rs")}}</span></td>
                            <td class="text-center"><span>{{@$plugin->pivot->created_at->format("Y-m-d")}}</span></td>
                            <td class="text-center">
                                @if(@$plugin->pivot->status=="pending")
                                    <span class="btn btn-sm btn-bold btn-block btn-warning">{{__("l.".@$plugin->pivot->status)}}</span>
                                @elseif(@$plugin->pivot->status=="rejected")
                                    <span class="btn btn-sm btn-bold btn-block btn-danger">{{__("l.".@$plugin->pivot->status)}}</span>
                                @else
                                    <span class="btn btn-sm btn-bold btn-block btn-success">{{__("l.".@$plugin->pivot->status)}}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center"><strong>{{__("l.no_data")}}</strong></td>
                    </tr>
                @endif
                </tbody>
            </table>

        </div>
    </div>

    <style>
        .btn.btn-label-light-o2.free{
            background-color: rgba(0, 255, 24, 0.42);
        }
        .btn.btn-label-light-o2.not-free{
            background-color: rgba(255, 0, 33, 0.56);
        }
    </style>

@endsection
