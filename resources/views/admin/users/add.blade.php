@extends("admin.parts.app")

@section("content")

    <div class="container">

        <form action="{{route("admin.users.save")}}" method="post" class="form-setting">
            @csrf

            <div class="row">

                <div class="col-lg-4 mx-auto">

                    <div class="form-group">
                        <label class="control-label"><span>الإسم</span> <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control rounded bg-control" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>الدور</span> <span class="text-danger">*</span></label>
                        <select class="form-control custom-select rounded bg-control" name="role_id" required>
                            <option value="">إختر</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>رقم الجوال</span> <span class="text-danger">*</span></label>
                        <input type="text" name="mobile" class="form-control rounded bg-control" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>كلمة المرور</span> <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control rounded bg-control" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>البريد الإلكتروني</span> <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control rounded bg-control" required autocomplete="off">
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

    </div>

@endsection
