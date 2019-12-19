@extends("admin.parts.app")

@section("content")

        <div class="container pb-5">

            <h3 class="mb-4 mt-2 text-center" style="color: #543c93;">تعديل كوبون</h3>

            <form action="{{route("admin.promocodes.update")}}" method="post">
                @csrf

                <input type="hidden" name="id" value="{{$promocode->id}}">

                <div class="row">

                    <div class="form-group col-md-6">
                        <label><span>الإسم</span> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{@$promocode->data["name"]}}" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label><span>الكود</span> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="code" value="{{@$promocode->code}}" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label><span>الحالة</span> <span class="text-danger">*</span></label>
                        <select class="form-control" name="status" required>
                            <option value="1" @if(@$promocode->data["status"]==1) selected @endif>مفعل</option>
                            <option value="0" @if(@$promocode->data["status"]==0) selected @endif>غير مفعل</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label><span>إنتهاء الصلوحية</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" autocomplete="off" value="{{(@$promocode->expires_at)?@$promocode->expires_at->format("Y-m-d"):""}}" name="expires_at" id="expires_at" style="text-align: right;">
                            <div class="input-group-prepend">
                                <label for="expires_at" class="input-group-text"  style="cursor: pointer;"><i class="fa fa-calendar-alt"></i></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label><span>نوع الكوبون</span> <span class="text-danger">*</span></label>
                        <select class="form-control" name="type" required>
                            <option value="0" @if(@$promocode->data["type"]==0) selected @endif>للإستعمال عدة مرات من قبل نفس العميل</option>
                            <option value="1" @if(@$promocode->data["type"]==1) selected @endif>للإستعمال مرة واحدة</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label><span>نوع التخفيض</span> <span class="text-danger">*</span></label>
                        <select class="form-control" name="reward_type" required>
                            <option value="0" @if(@$promocode->data["reward_type"]==0) selected @endif>نسبة</option>
                            <option value="1" @if(@$promocode->data["reward_type"]==1) selected @endif>مبلغ</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label><span>قيمة التخفيض</span> <span class="text-danger">*</span></label>
                        <input type="number" min="0" value="{{@$promocode->reward}}" step="0.01" class="form-control" name="reward" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label><span>العدد المتوفر</span> <span class="text-danger">*</span></label>
                        <input type="number" min="0" value="{{@$promocode->quantity}}" class="form-control" name="quantity" required>
                    </div>

                    <div class="form-group col-md-6">
                        <button type="submit" class="btn general-btn-sm-blue"><i class="fa fa-save"></i> <span>حفظ</span></button>
                    </div>

                </div>

            </form>

        </div>
    </div>

@endsection

@section("scripts")

    <link rel="stylesheet" href="{{asset("public/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css")}}" />
    <script src="{{asset("public/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}"></script>
    <script src="{{asset("public/bootstrap-datepicker/bootstrap-datepicker.init.js")}}"></script>
    <script src="{{asset("public/bootstrap-datepicker/dist/locales/bootstrap-datepicker.ar.min.js")}}"></script>

    <script>

        $(function () {

            $(".datepicker").datepicker({ language: "ar", format: "yyyy-mm-dd", autoclose: true});

        });

    </script>

@endsection
