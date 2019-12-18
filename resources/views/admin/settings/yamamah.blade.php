<form action="{{route('admin.settings.save_yamamah_settings')}}" method="post" class="form-setting">
    @csrf

    <div class="row">

        <div class="col-lg-4 mx-auto">

            <div class="form-group row">
                <div class="col-sm-6">
                    <h5>يمامه</h5>
                </div>
                <div class="col-sm-6">
                    <h5>الرصيد : {{$smsnum}} رسالة</h5>
                </div>
            </div>

            <div class="form-group">
                <label>رابط الشركة</label>
                <input type="text" autocomplete="off" class="form-control rounded bg-control" name="yamamah_url" value="{{@$settings["yamamah_url"]->value}}" required>
            </div>

            <div class="form-group">
                <label>إسم المرسل</label>
                <input type="text" autocomplete="off" class="form-control rounded bg-control" name="yamamah_sender" value="{{@$settings["yamamah_sender"]->value}}" required>
            </div>

            <div class="form-group">
                <label>إسم المستخدم</label>
                <input type="text" autocomplete="off" class="form-control rounded bg-control" name="yamamah_username" value="{{@$settings["yamamah_username"]->value}}" required>
            </div>

            <div class="form-group">
                <label>كلمة المرور</label>
                <input type="password" autocomplete="off" class="form-control rounded bg-control" name="yamamah_password" value="{{@$settings["yamamah_password"]->value}}" required>
            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-4 mx-auto">

            <div class="form-group">
                <hr style="margin: 10px 0px 20px">
            </div>

            <div class="row">

                <div class="col-sm-12">
                    <div class="form-group">
                        <label>أرسل رسالة تجربة إلى :</label>
                        <input type="text" class="form-control rounded bg-control" name="sms_test">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="form-group text-center mt-5">
                        <button type="submit" class="btn general-btn-sm-blue rounded">حفظ البيانات</button>
                    </div>
                </div>
            </div>

        </div>

    </div>

</form>
