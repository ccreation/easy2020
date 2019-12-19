@extends("admin.parts.app")

@section("content")

    <div class="container">

        @if($client->image)
            <img src="{{asset("storage/app/".$client->image)}}" style="background: #fff; width: 120px; height: 120px; display: block; margin: 0px auto; border: 1px solid #eee; border-radius: 60px;" />
        @else
            <img src="{{asset("public/no-image.png")}}" style="background: #fff; width: 120px; height: 120px; display: block; margin: 0px auto; border: 1px solid #eee; border-radius: 60px;" />
        @endif
        <h4 class="text-center mt-10">{{$client->name}}</h4>
        <h5 class="text-center">{{@$client->default_user[0]->email}}</h5>
        <h5 class="text-center">{{@$client->default_user[0]->mobile}}</h5>

        <div class="row mt-25">
            <div class="col-sm-4">
                <div><b>الباقة :</b></div>
                <div><strong style="color: {{@$client->plan->color}}">{{@$client->plan->name_ar}}</strong></div>
            </div>
            <div class="col-sm-4">
                <div><b>ينتهي الاشتراك بعد :</b></div>
                <div>
                    @if($client->subscription)
                        <?php
                        $subscription_date = \Carbon\Carbon::parse($client->subscription->subscription_date);
                        $subscription_end =  $subscription_date->addMonth(intval($client->subscription->months_number))->addYear(intval($client->subscription->years_number));
                        $now = \Carbon\Carbon::now();
                        ?>
                        <span>{{$subscription_end->diffInDays($now)}}</span> <span>يوم</span>
                    @else
                        <span>لا يوجد اشتراك</span>
                    @endif
                    <div id="aaa" style="height: 40px; width: 100%; margin-top: 13px; margin-right: 10px;"></div>
                </div>
            </div>
            <div class="col-sm-4">
                <div><b>الكوبون :</b></div>
                <div>
                    @if($client->subscription)
                        <span>{{@$client->subscription->payment->promocode->data["name"]}}</span>
                    @else
                        <span>لا يوجد كوبون</span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12 mt-20">
                <div><b>المواقع :</b></div>

                <table class="table table-ticket mt-15">
                    <thead style="background: #fafafa;">
                        <tr class="ticketlistheaderrow">
                            <th width="30">#</th>
                            <th width="42">{{__("l.logo")}}</th>
                            <th><span>{{__("l.name")}}</span> <small>({{__("l.arabic")}})</small></th>
                            <th><span>{{__("l.name")}}</span> <small>({{__("l.english")}})</small></th>
                            @if(@$client->plan->root_domain==1)
                                <th><span>{{__("l.website_slug")}}</span></th>
                            @endif
                            <th><span>{{__("l.page_numbers")}}</span></th>
                            <th>عدد الزيارات</th>
                            <th>{{__("l.actions")}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($client->websites)>0)
                        @foreach($client->websites as $website)
                            <tr class="ticketlistproperties">
                                <td class="text-center" width="30">{{$loop->iteration}}</td>
                                <td>
                                    @if($website->logo)
                                        <img src="{{$website->logo}}" style="width: 40px; display: block; margin: 0px auto; height: 40px; border: 1px solid #eee; border-radius: 2px;">
                                    @else
                                        <img src="{{asset("public/no-image2.png")}}" style="width: 40px; display: block; margin: 0px auto; height: 40px; border: 1px solid #eee; border-radius: 2px;">
                                    @endif
                                </td>
                                <td>{{$website->name_ar}}</td>
                                <td style="text-align: left;direction: ltr;">{{$website->name_en}}</td>
                                @if(@$client->plan->root_domain==1)
                                    <td class="text-center">
                                        @if($website->slug)
                                            <a href="{{--route("website.index2", [$website->slug])--}}" class="text-primary" target="_blank">{{$website->slug}}</a>
                                        @endif
                                    </td>
                                @endif
                                <td class="text-center">{{count($website->pages)}}</td>
                                <td class="text-center">{{count($website->visits)}}</td>
                                <td class="text-center">
                                    <div class="action">
                                        @if($website->slug)
                                            <a href="{{--route("website.index2", [$website->slug])--}}" target="_blank" title="رابط القالب"><img src="{{asset("public/dashboard/images/eye.png")}}" alt="" /></a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="ticketlistproperties"><td colspan="@if(@$client->plan->root_domain==1) 8 @else 7 @endif" class="text-center"><b>{{__("l.no_data")}}</b></td></tr>
                    @endif
                    </tbody>
                </table>

            </div>
        </div>

    </div>

@endsection


@section("scripts")
    <script src="{{asset("public/dashboard_client/js/demo1/scripts.bundle.js")}}" type="text/javascript"></script>
    <!--end::Global Theme Bundle -->

    <script src="{{asset("public/dashboard_client/vendors/custom/flot/flot.bundle.js")}}" type="text/javascript"></script>
    <script>

        $(function () {
                @if(@$client->plan->website_numbers!="0")
            var val = parseInt( {{@$my_size}} / {{@$client->plan->disk_space}} * 100);
            var data = [
                {label: "{{__("l.available_space")}} <small><b>{{@$client->plan->disk_space}} MB</b></span>", data: parseInt(100-val), color:  "lightgray"},
                {label: "{{__("l.available_used")}} <small><b>{{@$my_size}} MB</b></span>", data: val, color:  "#246bdc"},
            ];
            $.plot($("#aaa"), data, {
                series: {
                    pie: {
                        show: true
                    }
                }
            });
            @endif
        });
    </script>

@endsection
