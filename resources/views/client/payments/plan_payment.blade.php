@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">

        <h4 class="mb-3 text-center" style="color: {{$plan->color}};"><span>{{$plan->{"name_".app()->getLocale()} }}</span> <span>({{$plan->monthly_subscription}} <span>{{__("l.rs")}}</span>/<small style="color: {{$plan->color}};">{{__("l.monthly")}}</small>)</span></h4>

        <div class="row">
            <div class="col-lg-7 mx-auto">

                <div class="bg-white rounded-lg shadow-sm mb-5" style="padding: 3rem!important;">
                    <h4 class="text-center mt-0 mb-3">{{__("l.amount_required")}}</h4>
                    <table class="table table-bordered">
                        @if($tamdid)
                            <tr>
                                <td colspan="2" class="text-center"><b>تمديد الإشتراك</b></td>
                            </tr>
                        @endif
                        <tr>
                            <td width="70%">{{__("l.annual_subscription")}}</td>
                            <td><span>{{$plan->annual_subscription}}</span> <span>{{__("l.rs")}}</span></td>
                        </tr>
                        <tr>
                            <td>{{__("l.monthly_subscription")}}</td>
                            <td><span>{{$plan->monthly_subscription}}</span> <span>{{__("l.rs")}}</span></td>
                        </tr>
                        <tr>
                            <td width="70%">{{__("l.years_number")}}</td>
                            <td><span>{{$years_number}}</span></td>
                        </tr>
                        <tr>
                            <td>{{__("l.months_number")}}</td>
                            <td><span>{{$months_number}}</span></td>
                        </tr>
                        <tr>
                            <td><b>{{__("l.total")}}</b></td>
                            @php
                                $total = $plan->monthly_subscription * $months_number+$plan->annual_subscription*$years_number;

                                $total = ($total<=0)?0:$total;
                                $total = number_format($total, 1);
                            @endphp
                            <td><b>{{$total}}</b> <b>{{__("l.rs")}}</b></td>
                        </tr>
                        @if(@$promocode->data["reward_type"]!==null)
                            <tr class="text-danger">
                                <td>{{__("l.coupon")}} : {{@$promocode->data["name"]}}</td>
                                <td>
                                    @if($promocode->data["reward_type"]==0)
                                        <span>{{$promocode->reward}}</span> <span>%</span>
                                    @else
                                        <span>{{$promocode->reward}}</span> <span>{{__("l.rs")}}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>{{__("l.final_total")}}</b></td>
                                @php
                                    $total = $plan->monthly_subscription * $months_number+$plan->annual_subscription*$years_number;

                                    if(@$promocode->data["reward_type"]==0)
                                        $total = ($total - ($total/100*floatval($promocode->reward)));
                                    else
                                        $total = $total - floatval($promocode->reward);

                                    $total = ($total<=0)?0:$total;
                                    $total = number_format($total, 1);
                                @endphp
                                <td><b>{{$total}}</b> <b>{{__("l.rs")}}</b></td>
                            </tr>
                        @endif
                    </table>
                </div>

                <div class="bg-white rounded-lg shadow-sm" style="padding: 3rem!important;">

                    <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill" style="margin-bottom: 1rem!important;">
                        <li class="nav-item">
                            <a data-toggle="pill" href="#nav-tab-bank" class="nav-link active rounded-pill">
                                <i class="fa fa-university"></i>
                                <span>{{__("l.bank_transfer")}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="pill" href="#nav-tab-card" class="nav-link rounded-pill">
                                <i class="fa fa-credit-card"></i>
                                <span>{{__("l.credit_card")}}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="pill" href="#nav-tab-paypal" class="nav-link rounded-pill">
                                <i class="la la-paypal"></i>
                                <span>{{__("l.paypal")}}</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" style="min-height: 500px;">

                        <div id="nav-tab-bank" class="tab-pane fade show active">
                            <form action="{{route("client.payments.do_plan_payment")}}" method="post" class="mt-40" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="plan_id" value="{{$plan->id}}">
                                <input type="hidden" name="months_number" value="{{$months_number}}">
                                <input type="hidden" name="years_number" value="{{$years_number}}">
                                <input type="hidden" name="payment_method" value="bank_transfer">
                                @if($tamdid)
                                    <input type="hidden" name="tamdid" value="1">
                                @endif
                                <div class="form-group">
                                    <label><span>{{__("l.transfer_to_bank")}}</span> <span class="text-danger">*</span></label>
                                    <select name="bank_id" id="bank_id" class="form-control" required>
                                        <option value="">{{__("l.choose_bank")}}</option>
                                        @foreach($banks as $bank)
                                            <option value="{{$bank->id}}" data-bank_name="{{$bank->name}}" data-account_number="{{$bank->account_number}}" data-iban="{{$bank->iban}}">{{$bank->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="bank-deails" style="padding: 15px; background: #eee; border-radius: 3px; border: 1px solid #cccccc; margin-bottom: 15px; display: none;">
                                    <dl>
                                        <dt>{{__("l.bank")}}</dt>
                                        <dd id="bank_name"></dd>
                                    </dl>
                                    <dl>
                                        <dt>{{__("l.account_number")}}</dt>
                                        <dd id="account_number"></dd>
                                    </dl>
                                    <dl>
                                        <dt>{{__("l.iban")}}</dt>
                                        <dd id="iban"></dd>
                                    </dl>
                                </div>

                                @if(@$promocode->data["reward_type"]!==null)
                                    <input type="hidden" name="coupon_code" value="{{$promocode->code}}">
                                @endif

                                <div class="form-group">
                                    <label><span>{{__("l.transferer_name")}}</span> <span class="text-danger">*</span></label>
                                    <input type="text" name="transferer_name" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label><span>{{__("l.transferer_bank")}}</span> <span class="text-danger">*</span></label>
                                    <select name="transferer_bank" id="transferer_bank" class="form-control" required>
                                        <option value="">{{__("l.choose_bank")}}</option>
                                        @foreach($banks2 as $bank2)
                                            <option value="{{$bank2->id}}">{{$bank2->{"name_".app()->getLocale()} }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><span>{{__("l.transferer_account_number")}}</span> <span class="text-danger">*</span></label>
                                    <input type="text" name="transferer_account_number" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label><span>{{__("l.transferer_date")}}</span> <span class="text-danger">*</span></label>
                                    <input type="text" name="transferer_date" autocomplete="off" required class="form-control datepicker" style="width: 100%; text-align: right;">
                                </div>
                                <div class="form-group">
                                    <label><span>{{__("l.transferer_image")}}</span> <span class="text-danger">*</span></label>
                                    <input type="file" accept="image/*" name="transferer_image" required class="form-control">
                                </div>
                                <div class="text-center mt-20">
                                    <button type="submit" class="subscribe btn general-btn-sm-blue"> {{__("l.confirmation")}}  </button>
                                </div>
                            </form>
                        </div>

                        <div id="nav-tab-card" class="tab-pane fade pt-20">
                            @if($checkoutId)
                                <script> var wpwlOptions = {locale: "{{app()->getLocale()}}", maskCvv: true} </script>
                                <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$checkoutId}}"></script>
                                <form action="{{route("client.payments.hyperpay_plan")}}" class="paymentWidgets" data-brands="VISA MASTER AMEX"></form>
                                <div class="mt-10 text-right">
                                    <small>Powered By <a href="https://www.hyperpay.com/" target="_blank">HyperPay</a></small>
                                </div>
                            @endif
                        </div>

                        <div id="nav-tab-paypal" class="tab-pane fade">

                            <p class="alert alert-danger">قيد العمل عليها</p>
                            <p>{{__("l.paypal_note_1")}}</p>
                            <p>
                                <button type="button" class="btn btn-primary rounded-pill"><i class="fab fa-paypal mr-2"></i> {{__("l.paypal_note_2")}}</button>
                            </p>
                            <p class="text-muted">{{__("l.paypal_note_3")}}</p>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection

@section("scripts")

    <link rel="stylesheet" href="{{asset("public/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css")}}" />
    <script src="{{asset("public/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}"></script>
    <script src="{{asset("public/bootstrap-datepicker/bootstrap-datepicker.init.js")}}"></script>
    <script src="{{asset("public/bootstrap-datepicker/dist/locales/bootstrap-datepicker.ar.min.js")}}"></script>

    <style>
        .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
            background-color: #543c93;
        }
        .rounded-lg {
            border-radius: 1rem;
        }

        .nav-pills .nav-link {
            color: #555;
        }

        .nav-pills .nav-link.active {
            color: #fff;
        }
    </style>

    <script>

        $(function () {

            $('[data-toggle="tooltip"]').tooltip();

            $(".datepicker").datepicker({ language: "{{app()->getLocale()}}", format: "yyyy-mm-dd", autoclose : true});

            $(document).on("change", "#bank_id", function () {
                var bank_id = $(this).val();
                if(bank_id){
                    $("#bank-deails").slideDown();
                    var option = $("option:selected", this);
                    $("#bank_name").html($(option).data("bank_name"));
                    $("#account_number").html($(option).data("bank_name"));
                    $("#iban").html($(option).data("bank_name"));

                }else{
                    $("#bank-deails").slideUp();
                }
            });

        });

    </script>

@endsection
