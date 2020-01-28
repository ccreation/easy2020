@extends("client.parts.app")

@section("content")

    <div class="container pt-3 pb-5" style="min-height: 500px;">

        <h4 class="mb-4 text-center" style="color: #512293"><b><span>إضافة دومين جديد للموقع</span> "<span>{{$website->{"name_".app()->getLocale()} }}</span>"</b></h4>

        <div class="card card-primary">
            <div class="card-header"><span class="plix" style="width: 27px; height: 27px; line-height: 26px; font-size: 17px;">1</span> <span>ضع الدومين الجديد هنا</span></div>
            <div class="card-body">

                <form action="{{route("client.websites.add_domain_step_2")}}" method="post" style="padding: 15px 15px 0px; margin-top: 15px;">
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
        </div>

    </div>

@endsection
