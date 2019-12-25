@extends("client.parts.app")

@section("content")

    <div class="container pb-5 pt-3">

        <h4 style="color: {{$plan->color}};"><b>{{$plan->{"name_".app()->getLocale()} }}</b> <b>({{$plan->monthly_subscription}} <b>{{__("l.rs")}}</b>/<b style="color: {{$plan->color}};"><small>{{__("l.monthly")}}</small></b>)</b></h4>

        <div class="row mt-5">
            <div class="col-md-5">

                <div class="card">
                    <div class="card-header">{{__("l.plan")}}</div>
                    <div class="card-body">

                        <ul style="font-size: 1.3em; width: 100%;" class="m-0">
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
                    <div class="card-header">{{__("l.buy_this_plan")}}</div>
                    <div class="card-body">

                        <div style="width: 100%; font-size: 1.2em;">
                            <form id="plan_payment" action="{{route("client.payments.plan_payment")}}" method="post" class="container-fluid pt-10 pl-15 pr-10">
                                @csrf
                                <input type="hidden" name="plan_id" id="plan_id" value="{{$plan->id}}">

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

            </div>

            @if($plan->templates and is_array(unserialize($plan->templates)) and count($templates)>0)
                <div class="col-md-12 mt-15">
                    <hr>

                    <h4 class="mt-30 mb-40 text-center">{{__("l.these_templates_will_become_your_free")}}</h4>

                    <div class="row">

                        @foreach($templates as $template)

                            @if($template->homepage)

                                @if($template->logo)
                                    @php $image = asset("storage/app/".$template->logo); @endphp
                                @else
                                    @php $image = asset("public/no-image2.png"); @endphp
                                @endif
                                <div class="col-md-4 template"
                                     data-name0="{{$template->{"name_".app()->getLocale()} }}" data-type0="{{$template->category_id}}"
                                     data-price0="{{($template->price)?1:0}}">
                                    <div class="kt-portlet kt-portlet--height-fluid kt-widget19">
                                        @foreach($sold_templates as $t)
                                            @if(@$t->pivot->template_id == $template->id)
                                                @if(@$t->pivot->status==1)
                                                    <span class="sold">{{__("l.sold")}}</span>
                                                @else
                                                    <span class="sold" style="background: orange">{{__("l.pending")}}</span>
                                                @endif
                                            @endif
                                        @endforeach
                                        <div class="kt-portlet__body plix kt-portlet__body--fit kt-portlet__body--unfill" style="position: relative; width: 100%;">
                                            <div class="kt-portlet__head kt-portlet__head--right kt-portlet__head--noborder  kt-ribbon kt-ribbon--clip kt-ribbon--left kt-ribbon--info" style="position: absolute;">
                                                <div class="kt-ribbon__target" style="top: 12px;">
                                                    <span class="kt-ribbon__inner"></span> <div style="min-width: 110px;text-align: center;font-weight: bold;">{{@$template->category->{"name_".app()->getLocale()} }}</div>
                                                </div>
                                            </div>
                                            <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides" style="min-height: 300px; background-image: url('{{$image}}');height: 400px;background-position: center;background-size: cover;">
                                                <h3 class="kt-widget19__title kt-font-light">{{$template->{"name_".app()->getLocale()} }}</h3>
                                                <div class="kt-widget19__shadow"></div>
                                                <div class="kt-widget19__labels">
                                                    @if($template->price)
                                                        <span class="btn btn-label-light-o2 btn-bold float-left not-free">{{$template->price}} {{__("l.rs")}}</span>
                                                    @else
                                                        <span class="btn btn-label-light-o2 btn-bold float-left free">{{__("l.free")}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body p-10" style="min-height: inherit;">
                                            <div class="kt-widget19__wrapper mb-0">
                                                <div class="kt-widget19__content mb-0">
                                                    <div class="kt-widget19__info">
                                                        <div class="kt-widget19__action mb-0 mt-0">
                                                            @if($template->homepage)
                                                                <a target="_blank" href="{{route("website.index2", [$template->slug])}}" class="btn btn-sm btn-label-brand btn-bold">{{__("l.preview_site")}}</a>
                                                            @endif
                                                            <div class="previews dib float-right">
                                                                <div class="preview dib laptop">
                                                                    <svg width="30px" height="16px" viewBox="0 0 30 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                        <g id="New-Template-page" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <g id="template_grid_03" transform="translate(-1252.000000, -939.000000)" fill-rule="nonzero" fill="#313131">
                                                                                <g id="computer-copy" transform="translate(1252.000000, 939.000000)">
                                                                                    <path d="M5,12 L26,12 L26,1 L5,1 L5,12 Z M5,0 L26,0 C26.5522847,-1.01453063e-16 27,0.44771525 27,1 L27,13 L4,13 L4,1 C4,0.44771525 4.44771525,1.01453063e-16 5,0 Z" id="Rectangle-13"></path>
                                                                                    <path d="M14,13 L17,13 L14,13 Z M14,12 L17,12 C17.5522847,12 18,12.4477153 18,13 C18,13.5522847 17.5522847,14 17,14 L14,14 C13.4477153,14 13,13.5522847 13,13 C13,12.4477153 13.4477153,12 14,12 Z" id="Rectangle-3"></path>
                                                                                    <path d="M1,13 L1,14 C1,14.5522847 1.44771525,15 2,15 L28,15 C28.5522847,15 29,14.5522847 29,14 L29,13 L1,13 Z M1,12 L29,12 C29.5522847,12 30,12.4477153 30,13 L30,14 C30,15.1045695 29.1045695,16 28,16 L2,16 C0.8954305,16 1.3527075e-16,15.1045695 0,14 L0,13 C-6.76353751e-17,12.4477153 0.44771525,12 1,12 Z" id="Rectangle-2"></path>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </svg>
                                                                </div>
                                                                <div class="preview dib tablet">
                                                                    <svg width="20px" height="25px" viewBox="0 0 20 25" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                        <g id="New-Template-page" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <g id="template_grid_03" transform="translate(-1304.000000, -933.000000)" fill="#313131">
                                                                                <g id="tablet-copy" transform="translate(1304.000000, 933.000000)">
                                                                                    <path d="M2,1 C1.44771525,1 1,1.44771525 1,2 L1,23 C1,23.5522847 1.44771525,24 2,24 L18,24 C18.5522847,24 19,23.5522847 19,23 L19,2 C19,1.44771525 18.5522847,1 18,1 L2,1 Z M2,0 L18,0 C19.1045695,-2.02906125e-16 20,0.8954305 20,2 L20,23 C20,24.1045695 19.1045695,25 18,25 L2,25 C0.8954305,25 1.3527075e-16,24.1045695 0,23 L0,2 C-1.3527075e-16,0.8954305 0.8954305,2.02906125e-16 2,0 Z" id="Rectangle-4" fill-rule="nonzero"></path>
                                                                                    <path d="M3,5 L3,20 L17,20 L17,5 L3,5 Z M2,4 L18,4 L18,21 L2,21 L2,4 Z" id="Rectangle-4-Copy" fill-rule="nonzero"></path>
                                                                                    <path d="M9,2 L9,3 L9,2 Z M12,2 L8,2 L8,3 L12,3 L12,2 Z M8,2 L12,2 L12,3 L8,3 L8,2 Z" id="Rectangle-4-Copy-2" fill-rule="nonzero"></path>
                                                                                    <rect id="Rectangle" x="8" y="2" width="4" height="1"></rect>
                                                                                    <rect id="Rectangle-Copy" x="9" y="22" width="2" height="1"></rect>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </svg>
                                                                </div>
                                                                <div class="preview dib mobile">
                                                                    <svg width="12px" height="21px" viewBox="0 0 12 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                                        <g id="New-Template-page" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <g id="template_grid_03" transform="translate(-1348.000000, -937.000000)">
                                                                                <g id="mobile-copy" transform="translate(1348.000000, 937.000000)">
                                                                                    <path d="M2,0.5 C1.17157288,0.5 0.5,1.17157288 0.5,2 L0.5,19 C0.5,19.8284271 1.17157288,20.5 2,20.5 L10,20.5 C10.8284271,20.5 11.5,19.8284271 11.5,19 L11.5,2 C11.5,1.17157288 10.8284271,0.5 10,0.5 L2,0.5 Z" id="Rectangle-4" stroke="#313131"></path>
                                                                                    <path d="M2.5,4.5 L2.5,16.5 L9.5,16.5 L9.5,4.5 L2.5,4.5 Z" id="Rectangle-4-Copy" stroke="#313131"></path>
                                                                                    <rect id="Rectangle" fill="#313131" x="4" y="2" width="4" height="1"></rect>
                                                                                    <rect id="Rectangle-Copy" fill="#313131" x="5" y="18" width="2" height="1"></rect>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif

                        @endforeach

                    </div>

                </div>
            @endif

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
