@extends("admin.parts.app")

@section("content")

    <form action="{{route("admin.clients.update")}}" method="post" class="form-setting" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$client->id}}">

        <div class="row">

            <div class="col-lg-4 mx-auto">

                <h4 class="mb-3" style="color: #512293">تعديل بيانات العميل</h4>

                <div class="form-group">
                    <label class="control-label"><span>الإسم</span> <span class="text-danger">*</span></label>
                    <input type="text" name="name" value="{{$client->name}}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="control-label"><span>الصورة</span></label>
                    <input type="file" name="image" accept="image/*" class="form-control" >
                    <br>
                    @if($client->image)
                        <img src="{{asset("storage/app/".$client->image)}}" style="background: #fff; width: 100px; height: 100px; border: 1px solid #eee; margin-top: 5px; display: block;" />
                    @else
                        <img src="{{asset("public/no-image.png")}}" style="background: #fff; width: 100px; height: 100px; border: 1px solid #eee; margin-top: 5px; display: block;" />
                    @endif
                </div>

                <div class="form-group">
                    <label class="control-label"><span>الباقة</span> <span class="text-danger">*</span></label>
                    <select class="form-control" name="plan_id" required>
                        <option value="">إختر</option>
                        @foreach($plans as $plan)
                            <option value="{{$plan->id}}" @if($client->plan_id == $plan->id) selected @endif>{{$plan->name_ar}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="control-label"><span>الحالة</span> <span class="text-danger">*</span></label>
                    <select class="form-control" name="status" required>
                        <option value="1" @if($client->status==1) selected @endif>مفعل</option>
                        <option value="0" @if($client->status==0) selected @endif>موقوف</option>
                    </select>
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
