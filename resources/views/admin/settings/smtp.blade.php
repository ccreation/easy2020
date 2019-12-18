<form action="{{route('admin.settings.save_smtp_settings')}}" method="post" enctype="multipart/form-data" class="form-setting">
    @csrf


    <div class="row">

        <div class="col-lg-4 mx-auto">

            <div class="form-group">
                <label>أرسل من الإيميل التالي :</label>
                <input type="text" class="form-control rounded bg-control" name="email_sent_from_address" value="{{@$settings["email_sent_from_address"]->value}}" required autocomplete="off">
            </div>

            <div class="form-group">
                <label>إسم المرسل :</label>
                <input type="text" class="form-control rounded bg-control" name="email_sent_from_name" value="{{@$settings["email_sent_from_name"]->value}}" required autocomplete="off">
            </div>

            <div class="form-group">
                <label>مضيف الSMTP : </label>
                <input type="text" class="form-control rounded bg-control" name="email_smtp_host" value="{{@$settings["email_smtp_host"]->value}}" autocomplete="off">
            </div>

            <div class="form-group">
                <label>اسم المستخدم SMTP : </label>
                <input type="text" class="form-control rounded bg-control" name="email_smtp_user" value="{{@$settings["email_smtp_user"]->value}}" autocomplete="off">
            </div>

            <div class="form-group">
                <label>كلمة المرور SMTP : </label>
                <input type="password" class="form-control rounded bg-control" name="email_smtp_password" value="{{@$settings["email_smtp_password"]->value}}" autocomplete="off">
            </div>

            <div class="form-group">
                <label>منفذ ال SMTP : </label>
                <input type="text" class="form-control rounded bg-control" name="email_smtp_port" value="{{@$settings["email_smtp_port"]->value}}" autocomplete="off">
            </div>

            <div class="form-group">
                <hr style="margin-top: 30px">
            </div>

            <div class="form-group">
                <label>أرسل رسالة تجربة إلى</label>
                <input type="text" class="form-control rounded bg-control" name="send_test_mail_to"/>
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

</form>
