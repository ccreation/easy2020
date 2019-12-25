@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="position: relative; min-height: 500px;">

        <h4 class="text-center mb-3" style="color: #543c93"><b>{{__("l.open_ticket")}}</b></h4>

        <form action="{{route("client.tickets.send")}}" method="post" id="send_ticket" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-lg-6 mx-auto">

                    <div class="form-group">
                        <label><span>عنوان التذكرة</span> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="form-group">
                        <label><span>نوع التذكرة</span> <span class="text-danger">*</span></label>
                        <select class="form-control" name="ticket_type_id" required>
                            <option value="">إختر</option>
                            @foreach ($ticket_types as $ticket_type)
                                <option value="{{$ticket_type->id}}">{{$ticket_type->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label><span>{{__("l.website")}}</span></label>
                        <select class="form-control" name="website_id" >
                            <option value="">عام</option>
                            @foreach ($websites as $website)
                                <option value="{{$website->id}}">{{$website->{"name_".app()->getLocale()} }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label><span>نص التذكرة</span> <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="message" required rows="8" ></textarea>
                    </div>

                    <div class="form-group">
                        <label><span>المرفقات</span></label>
                        <div class="row">
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="images[]" accept="image/*">
                            </div>
                            <div class="col-sm-3">
                                <a href="#" class="pt-3 btn general-btn-sm-blue rounded btn-block btn-add-file" title="إضافة مرفق"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div id="files"></div>
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

    <div id="files_wrapper" style="display: none;">
        <div class="row mt-2">
            <div class="col-sm-9">
                <input type="file" class="form-control" name="images[]" accept="image/*">
            </div>
            <div class="col-sm-3">
                <a href="#" class="pt-3 btn general-btn-sm-blue rounded btn-block btn-remove-file" title="حذف" style="background: red;"><i class="fa fa-trash"></i></a>
            </div>
        </div>
    </div>

@endsection

@section("scripts")

    <script>
        $(function () {

            $(document).on("click", ".btn-add-file", function (e) {
               e.preventDefault();
              var html = $("#files_wrapper").html();
              $("#files").append(html);
           });

           $(document).on("click", ".btn-remove-file", function (e) {
                e.preventDefault();
                $(this).closest(".row").remove();
            });

        });
    </script>

@endsection
