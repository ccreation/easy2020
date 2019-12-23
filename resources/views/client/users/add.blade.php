@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">

        <h4 class="mb-3 text-center" style="color: #512293"><b>إضافة مستخدم</b></h4>

        <form action="{{route("client.users.save")}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-lg-4 mx-auto">

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.name")}}</span> <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.mobile")}}</span> <span class="text-danger">*</span></label>
                        <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.email")}}</span> <span class="text-danger">*</span></label>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.password")}}</span> <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.role")}}</span> <span class="text-danger">*</span></label>
                        <select name="role_id" class="form-control" required>
                            <option value="">{{__("l.choose")}}</option>
                            <option value="0">{{__("l.admin")}}</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.image")}}</span></label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="form-group text-center mt-4 mb-5">
                        <button type="submit" class="btn general-btn-sm-blue rounded"><i class="fa fa_save"></i> <span>{{__("l.save")}}</span></button>
                    </div>
                </div>
            </div>

        </form>

    </div>

@endsection
