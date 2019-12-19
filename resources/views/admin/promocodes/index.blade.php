@extends("admin.parts.app")

@section("content")

    <div class="container py-5">

        @if(permissions("promocodes_add"))

            <a href="#" class="btn general-btn-sm-blue float-left btn-open" data-target="#add_coupon"><i class="fa fa-plus"></i> <span>إنشاء كوبون جديد</span></a>
            <div class="clearfix mb-2"></div>

            <form id="add_coupon" class="formi" action="{{route("admin.promocodes.save")}}" method="post">
                @csrf

                <div class="row">

                    <div class="form-group col-md-6">
                        <label><span>الإسم</span> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="form-group col-md-6">
                    </div>

                    <div class="form-group col-md-6">
                        <label><span>الحالة</span> <span class="text-danger">*</span></label>
                        <select class="form-control" name="status" required>
                            <option value="1">مفعل</option>
                            <option value="0">غير مفعل</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label><span>إنتهاء الصلوحية</span></label>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" autocomplete="off" value="{{date("Y-m-d")}}" name="expires_at" id="expires_at" style="text-align: right;">
                            <div class="input-group-prepend">
                                <label for="expires_at" class="input-group-text"  style="cursor: pointer;"><i class="fa fa-calendar-alt"></i></label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label><span>نوع الكوبون</span> <span class="text-danger">*</span></label>
                        <select class="form-control" name="type" required>
                            <option value="0">للإستعمال عدة مرات من قبل نفس العميل</option>
                            <option value="1">للإستعمال مرة واحدة</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label><span>نوع التخفيض</span> <span class="text-danger">*</span></label>
                        <select class="form-control" name="reward_type" required>
                            <option value="0">نسبة</option>
                            <option value="1">مبلغ</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label><span>قيمة التخفيض</span> <span class="text-danger">*</span></label>
                        <input type="number" min="0" value="0" step="0.01" class="form-control" name="reward" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label><span>العدد المتوفر</span> <span class="text-danger">*</span></label>
                        <input type="number" min="0" value="0" class="form-control" name="quantity" required>
                    </div>

                    <div class="form-group col-md-6">
                        <button type="submit" class="btn general-btn-sm-blue"><i class="fa fa-save"></i> <span>حفظ</span></button>
                    </div>

                </div>

            </form>

        @endif

        <div class="clearfix mb-4"></div>

        <table class="table table-ticket">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th width="30">#</th>
                    <th>الإسم</th>
                    <th>الكود</th>
                    <th>إنتهاء الصلوحية</th>
                    <th>نوع الكوبون</th>
                    <th>قيمة التخفيض</th>
                    <th>العدد المتوفر</th>
                    <th>الحالة</th>
                    <th>الأوامر</th>

                </tr>
            </thead>
            <tbody>
            @if(count($promocodes)>0)
                @foreach($promocodes as $promocode)
                    <tr class="ticketlistproperties">
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{$promocode->data["name"]}}</td>
                        <td class="text-center" style="position: relative">
                            <a href="#" class="copy_code"><i class="far fa-copy"></i></a>
                            <span>{{$promocode->code}}</span>
                        </td>
                        <td class="text-center">@if(@$promocode->expires_at){{@$promocode->expires_at->format("Y-m-d")}}@endif</td>
                        <td class="p-2">
                            @if($promocode->data["type"]==0)
                                <span>للإستعمال عدة مرات</span>
                            @else
                                <span>للإستعمال مرة واحدة</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($promocode->data["reward_type"]==0)
                                <span>{{$promocode->reward}}</span> <span>%</span>
                            @else
                                <span>{{$promocode->reward}}</span> <span>{{__("l.rs")}}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <strong>{{$promocode->quantity}}</strong>
                        </td>
                        <td>
                            @if($promocode->data["status"]==0)
                                <span class="status-prj unacceptable">غير مفعل</span>
                            @else
                                <span class="status-prj enabled">مفعل</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="action">
                                @if(permissions("promocodes_edit"))
                                    <a href="{{route("admin.promocodes.edit", $promocode->id)}}" title="تعديل">
                                        <img src="{{asset("public/dashboard/images/settings.png")}}" alt="">
                                    </a>
                                @endif
                                @if(permissions("promocodes_remove"))
                                    <a href="{{route("admin.promocodes.delete", $promocode->id)}}" title="حذف" onclick="return confirm('هل أنت متأكد ؟')">
                                        <img src="{{asset("public/dashboard/images/cpanel/delete.png")}}" alt="">
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8"><strong>لا توجد كوبونات</strong></td>
                </tr>
            @endif
            </tbody>
        </table>

    </div>

@endsection

@section("scripts")

    <link rel="stylesheet" href="{{asset("public/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css")}}" />
    <script src="{{asset("public/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}"></script>
    <script src="{{asset("public/bootstrap-datepicker/bootstrap-datepicker.init.js")}}"></script>
    <script src="{{asset("public/bootstrap-datepicker/dist/locales/bootstrap-datepicker.ar.min.js")}}"></script>

    <style>
        .copy_code{
            text-decoration: none;
            position: absolute;
            top: 5px;
            left: 5px;
            color: #212529;
        }
    </style>

    <script>

        $(function () {

            $(".datepicker").datepicker({ language: "ar", format: "yyyy-mm-dd", autoclose: true});

            $(document).on("click", ".copy_code", function (e) {
                e.preventDefault();
                var elem = $(this).closest("tr").find("span");
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val($(elem).html()).select();
                document.execCommand("copy");
                $temp.remove();
                goNotif("success", "تم نسخ الكود");
            });

        });

    </script>

@endsection
