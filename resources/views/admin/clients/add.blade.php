@extends("admin.parts.app")

@section("content")

    <form action="{{route("admin.clients.save")}}" method="post" class="form-setting" enctype="multipart/form-data">
        @csrf

        <div class="row">

            <div class="col-lg-4 mx-auto">

                <h4 class="mb-3" style="color: #512293">بيانات العميل</h4>

                <div class="form-group">
                    <label class="control-label"><span>الإسم</span> <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="control-label"><span>الصورة</span></label>
                    <input type="file" name="image" accept="image/*" class="form-control" >
                </div>

                <div class="form-group">
                    <label class="control-label"><span>الباقة</span> <span class="text-danger">*</span></label>
                    <select class="form-control" name="plan_id" required>
                        <option value="">إختر</option>
                        @foreach($plans as $plan)
                            <option value="{{$plan->id}}" @if(old('plan_id') == $plan->id) selected @endif>{{$plan->name_ar}}</option>
                        @endforeach
                    </select>
                </div>

                <h4 class="mb-3" style="color: #512293">بيانات مستخدم العميل</h4>

                <div class="form-group">
                    <label class="control-label"><span>الإسم</span> <span class="text-danger">*</span></label>
                    <input type="text" name="name2" value="{{old('name2')}}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="control-label"><span>الجوال</span> <span class="text-danger">*</span></label>
                    <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="control-label"><span>البريد الإلكتروني</span> <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{old('email')}}" required autocomplete="off">
                </div>

                <div class="form-group">
                    <label class="control-label"><span>كلمة المرور</span> <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control" required autocomplete="off">
                </div>

            </div>

        </div>

        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="form-group text-center mt-4 mb-5">
                    <button type="submit" class="btn general-btn-sm-blue rounded">حفظ</button>
                </div>
            </div>
        </div>

    </form>

@endsection
