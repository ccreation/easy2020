<form action="{{route("admin.settings.save_settings")}}" method="post" class="form-setting">
    @csrf

    <div class="row">

        <div class="col-lg-4 mx-auto">

            <div class="form-group">
                <label class="d-block"><span>عدد الأيام بدون رد قبل إغلاق تذكرة</span> <span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                    <input type="number" min="1" name="ticket_lifetime" value="{{(@$settings["ticket_lifetime"]) ? @$settings["ticket_lifetime"]->value : 6}}" class="form-control  rounded bg-control" required>
                    <div class="input-group-prepend">
                        <span class="input-group-text">يوم</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label><span>مدة حفظ الجلسة</span> <span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                    <input type="number" min="1" name="SESSION_LIFETIME" value="{{@$settings["SESSION_LIFETIME"]->value}}" class="form-control rounded bg-control" required>
                    <div class="input-group-prepend">
                        <span class="input-group-text">دقيقة</span>
                    </div>
                </div>
            </div>

            <div class="form-group mb-0">
                <label><span>عدد الدقائق بدون نشاط قبل تسجيل الخروج</span> <span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                    <input type="number" min="1" name="idel_time_minutes" value="{{@$settings["idel_time_minutes"]->value}}" class="form-control rounded bg-control" required>
                    <div class="input-group-prepend">
                        <span class="input-group-text">دقيقة</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="form-group text-center mt-5">
                <button type="submit" class="btn general-btn-sm-blue rounded">حفظ</button>
            </div>
        </div>
    </div>

</form>
