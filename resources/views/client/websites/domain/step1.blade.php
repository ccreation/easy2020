@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">

        <h4 class="mb-4 text-center" style="color: #512293"><b><span>إضافة دومين جديد للموقع</span> "<span>{{$website->{"name_".app()->getLocale()} }}</span>"</b></h4>

        <h5><span class="plix" style="width: 27px; height: 27px; line-height: 26px; font-size: 17px;">1</span> <span>ضع الدومين الجديد هنا</span></h5>

        <form action="{{route("client.websites.add_domain_step_2")}}" method="post" style="border: 1px solid #eee; padding: 15px 15px 0px; margin-top: 15px; background: #f5f5f5; ">
            @csrf
            <input type="hidden" name="id" value="{{$website->id}}">

            <div class="form-group">
                <label><span>إسم الدومين</span> <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="domain" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn general-btn-sm-blue rounded"><i class="fa fa-check"></i> <span>التحقق من الدومين</span></button>
            </div>

        </form>

    </div>

@endsection
