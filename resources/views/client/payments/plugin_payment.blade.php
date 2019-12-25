@extends("client.parts.app")

@section("content")

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("client.home")}}"><i class="fa fa-home"></i> <span>{{__("l.home")}}</span></a></li>
            <li class="breadcrumb-item"><a href="{{route("client.plugins.index")}}"><i class="fa fa-plug"></i> <span>{{__("l.plugins")}}</span></a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-plug"></i> <span>{{$plugin->{"name_".app()->getLocale()} }}</span>
            <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-money-bill"></i> <span>{{__("l.payment_form")}}</span>
            </li>
        </ol>
    </nav>

    <div class="kt-portlet">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-plug"></i>
                </span>
                <h3 class="kt-portlet__head-title"><span>{{$plugin->{"name_".app()->getLocale()} }}</span></h3>
            </div>
        </div>
        <div class="kt-portlet__body pricing py-5" style="background: #f5f5f5;">

            <div class="row">
                <div class="col-lg-7 mx-auto">

                    <div class="bg-white rounded-lg shadow-sm mb-25" style="padding: 3rem!important;">
                        <h4 class="text-center mt-0 mb-25">{{__("l.amount_required")}}</h4>
                        <table class="table table-bordered">
                            <tr>
                                <td width="70%">{{__("l.plugin")}}</td>
                                <td><span></span> <span>{{$plugin->{"name_".app()->getLocale()} }}</span></td>
                            </tr>
                            <tr>
                                <td><b>{{__("l.price")}}</b></td>
                                <td><b>{{$plugin->price}}</b> <b>{{__("l.rs")}}</b></td>
                            </tr>
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
                                <form action="{{route("client.payments.do_plugin_payment")}}" method="post" class="mt-40" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="plugin_id" value="{{$plugin->id}}">
                                    <input type="hidden" name="payment_method" value="bank_transfer">

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
                                        <button type="submit" class="subscribe btn btn-primary w200 rounded-pill shadow-sm"> {{__("l.confirmation")}}  </button>
                                    </div>
                                </form>
                            </div>

                            <div id="nav-tab-card" class="tab-pane fade pt-20">
                                @if($checkoutId)
                                    <script> var wpwlOptions = {locale: "{{app()->getLocale()}}", maskCvv: true} </script>
                                    <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$checkoutId}}"></script>
                                    <form action="{{route("client.payments.hyperpay_plugin")}}" class="paymentWidgets" data-brands="VISA MASTER AMEX"></form>
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
    </div>

@endsection

@section("scripts")

    <style>
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
