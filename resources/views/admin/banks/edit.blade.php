@extends("admin.parts.app")

@section("content")

    <div class="container pb-5 pt-1">

        <h3 class="mb-3 text-center" style="color: #543c93;">تعديل بنك</h3>

        <form action="{{route("admin.banks.update", $bank->id)}}" method="post">
            @csrf
            {{method_field("put")}}

            <div class="row">

                <div class="col-lg-4 mx-auto">

                    <div class="form-group">
                        <label><span>إسم البنك</span> <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{$bank->name}}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label><span>رقم الحساب</span> <span class="text-danger">*</span></label>
                        <input type="text" name="account_number" value="{{$bank->account_number}}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label><span>الآيبان</span> <span class="text-danger">*</span></label>
                        <input type="text" name="iban" value="{{$bank->iban}}" class="form-control" required>
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
