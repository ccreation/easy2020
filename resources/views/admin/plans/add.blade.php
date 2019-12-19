@extends("admin.parts.app")

@section("content")

    <div class="container mt-3">
        <form action="{{route("admin.plans.save")}}" method="post" class="row">
            @csrf

            <div class="form-group col-md-6">
                <label><span>إسم الباقة</span> <small>(عربي)</small> <span class="text-danger">*</span></label>
                <input type="text" name="name_ar" class="form-control" required />
            </div>

            <div class="form-group col-md-6">
                <label><span>إسم الباقة</span> <small>(إنجليزي)</small> <span class="text-danger">*</span></label>
                <input type="text" name="name_en" class="form-control" required />
            </div>

            <div class="col-md-12 mt-10 mb-10"></div>

            <div class="form-group col-md-6">
                <label><span>مبلغ اشتراك الباقة الشهري</span> <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="number" min="0" max="1000000" step="0.1" value="0" name="monthly_subscription" class="monthly_subscription form-control" required />
                    <div class="input-group-prepend">
                        <div class="input-group-text">رس</div>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-6">
                <label><span>مبلغ اشتراك الباقة السنوي</span> <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="number" min="0" max="1000000" step="0.1" value="0" name="annual_subscription" class="annual_subscription form-control" required />
                    <div class="input-group-prepend">
                        <div class="input-group-text">رس</div>
                    </div>
                </div>
                <label><span>نسبة الخصم</span> <small>(نسبة مائوية)</small> <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="number" min="0" max="1000000" step="0.1" value="0" name="discount_percentage" class="discount_percentage form-control" required />
                    <div class="input-group-prepend">
                        <div class="input-group-text">%</div>
                    </div>
                </div>
                <label><span>مبلغ الخصم</span> <small>(مبلغ)</small> <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="number" min="0" max="1000000" step="0.1" value="0" name="discount_amount" class="discount_amount form-control" required />
                    <div class="input-group-prepend">
                        <div class="input-group-text">رس</div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-10 mb-10"></div>

            <div class="form-group col-md-6">
                <label><span>اقل مدة اشتراك</span> <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="number" min="1" max="100" value="1" name="minimum_subscription_period" class="form-control" required />
                    <div class="input-group-prepend">
                        <div class="input-group-text">شهر</div>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-6">
                <label><span>اللون المميز</span></label>
                <input type="color" value="#cccccc" name="color" class="form-control">
            </div>

            <div class="col-md-12 mt-10 mb-10"></div>

            <div class="form-group col-md-6">
                <label><span>عدد المواقع</span> <span class="text-danger">*</span></label>
                <input type="number" min="0" max="10000" value="1" name="website_numbers" class="form-control" required />
                <small>لعدد لا محدود من المواقع ضع 0</small>
            </div>

            <div class="form-group col-md-6">
                <label><span>المساحة</span> <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="number" min="0" max="1000000" name="disk_space" value="1" class="form-control" required />
                    <div class="input-group-prepend">
                        <div class="input-group-text">MB</div>
                    </div>
                </div>
                <small>المساحة بالميقابايت</small>
                <small>لمساحة غير محدودة ضع 0</small>
            </div>

            <div class="col-md-12 mt-10 mb-10"></div>

            <div class="form-group col-md-4">
                <label class="db"><span>دعم دومين رئيسي</span></label>
                <label class="kt-radio kt-radio--bold kt-radio--brand">
                    <input type="radio" name="root_domain" value="1" checked> <i>نعم</i>
                    <span></span>
                </label>
                <label class="kt-radio kt-radio--bold kt-radio--brand">
                    <input type="radio" name="root_domain" value="0"> <i>لا</i>
                    <span></span>
                </label>
            </div>

            <div class="form-group col-md-4">
                <label class="db"><span>متعدد المستخدمين</span></label>
                <label class="kt-radio kt-radio--bold kt-radio--brand">
                    <input type="radio" name="multiple_users" value="1" checked> <i>نعم</i>
                    <span></span>
                </label>
                <label class="kt-radio kt-radio--bold kt-radio--brand">
                    <input type="radio" name="multiple_users" value="0"> <i>لا</i>
                    <span></span>
                </label>
            </div>

            <div class="form-group col-md-4">
                <label class="db"><span>{{__("l.website_multi_lang")}}</span></label>
                <label class="kt-radio kt-radio--bold kt-radio--brand">
                    <input type="radio" name="default_lang" value="1" checked> <i>نعم</i>
                    <span></span>
                </label>
                <label class="kt-radio kt-radio--bold kt-radio--brand">
                    <input type="radio" name="default_lang" value="0"> <i>لا</i>
                    <span></span>
                </label>
            </div>

            <div class="col-md-12 mt-10 mb-10"></div>

            <div class="form-group col-md-12">
                <label><span>القوالب</span></label>
                <select name="templates[]" class="form-control select2" multiple>
                    @foreach($websites as $website)
                        <option value="{{$website->id}}">{{$website->name_ar}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12 mt-10 mb-10"></div>

            <div class="col-md-12 text-center">
                <button type="submit" class="btn general-btn-sm-blue"><i class="fa fa-save"></i> <span>حفظ</span></button>
            </div>

        </form>
    </div>

@endsection

@section("scripts")

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

    <style>
        .select2-selection{
            border: 1px solid #ced4da !important;
            border-radius: 0px !important;
            padding: 8px;
        }
    </style>

    <script>

        $(function () {

            $(".select2").select2({dir: "rtl"});

            $(document).on("change", ".monthly_subscription, .annual_subscription", function () {
                var monthly_subscription    = $(".monthly_subscription").val();
                var annual_subscription     = $(".annual_subscription").val();
                var discount_percentage     = $(".discount_percentage").val();
                var discount_amount         = $(".discount_amount").val();
                discount_amount             = ((monthly_subscription * 12) - annual_subscription);
                discount_amount             = parseFloat(Math.round(discount_amount * 100) / 100).toFixed(1);
                $(".discount_amount").val(discount_amount);
                discount_percentage         = 100 - ( annual_subscription/(monthly_subscription * 12) * 100 );
                discount_percentage         = parseFloat(Math.round(discount_percentage * 100) / 100).toFixed(1);
                $(".discount_percentage").val(discount_percentage);
            });

            $(document).on("change", ".discount_percentage", function () {
                var monthly_subscription    = $(".monthly_subscription").val();
                var annual_subscription     = $(".annual_subscription").val();
                var discount_percentage     = $(".discount_percentage").val();
                var discount_amount         = $(".discount_amount").val();
                annual_subscription         = (monthly_subscription*12)/100*(100-discount_percentage);
                annual_subscription         = parseFloat(Math.round(annual_subscription * 100) / 100).toFixed(1);
                $(".annual_subscription").val(annual_subscription);
                discount_amount             = ((monthly_subscription * 12) - annual_subscription);
                discount_amount             = parseFloat(Math.round(discount_amount * 100) / 100).toFixed(1);
                $(".discount_amount").val(discount_amount);
            });

            $(document).on("change", ".discount_amount", function () {
                var monthly_subscription    = $(".monthly_subscription").val();
                var annual_subscription     = $(".annual_subscription").val();
                var discount_percentage     = $(".discount_percentage").val();
                var discount_amount         = $(".discount_amount").val();
                annual_subscription         = (monthly_subscription*12)-discount_amount;
                annual_subscription         = parseFloat(Math.round(annual_subscription * 100) / 100).toFixed(1);
                $(".annual_subscription").val(annual_subscription);
                discount_percentage         = 100 - ( annual_subscription/(monthly_subscription * 12) * 100 );
                discount_percentage         = parseFloat(Math.round(discount_percentage * 100) / 100).toFixed(1);
                $(".discount_percentage").val(discount_percentage);
            });

        });

    </script>

@endsection
