@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">

        <h4 class="mb-3 text-center" style="color: #512293"><b>إضافة مستخدم</b></h4>

        <form action="{{route("client.users.update")}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$user->id}}">

            <div class="row">

                <div class="col-lg-4 mx-auto">

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.name")}}</span> <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{$user->name}}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.mobile")}}</span> <span class="text-danger">*</span></label>
                        <input type="text" name="mobile" value="{{$user->mobile}}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.email")}}</span> <span class="text-danger">*</span></label>
                        <input type="email" name="email" value="{{$user->email}}" class="form-control" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.password")}}</span></label>
                        <input type="password" name="password" class="form-control" autocomplete="off">
                        <br><small>{{__("l.password_edit_note")}}</small>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.role")}}</span> <span class="text-danger">*</span></label>
                        <select name="role_id" class="form-control" required>
                            <option value="">{{__("l.choose")}}</option>
                            <option value="0" @if($user->role_id == 0) selected @endif>{{__("l.admin")}}</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}" @if($user->role_id == $role->id) selected @endif>{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.image")}}</span></label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <br>
                        @if($user->image)
                            <img src="{{asset("storage/app/".$user->image)}}" style="background: #fff; width: 150px; height: 150px;  border: 1px solid #eee; border-radius: 4px;" />
                        @else
                            <img src="{{asset("public/no-image.png")}}" style="background: #fff; width: 150px; height: 150px; border: 1px solid #eee; border-radius: 4px;" />
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span>{{__("l.status")}}</span></label>
                        <select name="status" class="form-control">
                            <option value="1" @if($user->status==1) selected @endif>{{__("l.active")}}</option>
                            <option value="0" @if($user->status==0) selected @endif>{{__("l.inactive")}}</option>
                        </select>
                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="form-group text-center mt-4 mb-5">
                        <button type="submit" class="btn general-btn-sm-blue rounded"><i class="fa fa_save"></i> <span>{{__("l.update")}}</span></button>
                    </div>
                </div>
            </div>

        </form>

    </div>

@endsection
