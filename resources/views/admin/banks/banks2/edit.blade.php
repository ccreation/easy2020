@extends("admin.parts.app")

@section("content")

    <div class="container pb-5 pt-1">

        <h3 class="mb-3 text-center" style="color: #543c93;">تعديل بنك</h3>

        <form action="{{route("admin.banks.banks2.update", $bank->id)}}" method="post">
            @csrf
            {{method_field("put")}}

            <div class="row">

                <div class="col-lg-4 mx-auto">

                    <div class="form-group">
                        <label><span>إسم البنك</span> <small>(عربي)</small> <span class="text-danger">*</span></label>
                        <input type="text" name="name_ar" value="{{$bank->name_ar}}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label><span>إسم البنك</span> <small>(إنجليزي)</small> <span class="text-danger">*</span></label>
                        <input type="text" name="name_en" value="{{$bank->name_en}}" class="form-control" required>
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
