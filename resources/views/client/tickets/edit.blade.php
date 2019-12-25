@extends("client.parts.app")

@section("content")

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("client.home")}}"><i class="fa fa-home"></i> <span>{{__("l.home")}}</span></a></li>
            <li class="breadcrumb-item"><a href="{{route("client.tickets.index")}}"><i class="fas fa-ticket-alt"></i> <span>{{__("l.tickets_system")}}</span></a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-ticket-alt"></i> <span>التذكرة</span></li>
        </ol>
    </nav>

    <div class="kt-portlet">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-ticket-alt"></i>
                </span>
                <h3 class="kt-portlet__head-title">التذكرة {{$ticket->id+1000}}</h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{route("client.tickets.index")}}" class="btn btn-primary pull-right"><i class="fa fa-list"></i> <span>{{__("l.tickets_list")}}</span></a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <form action="{{route("client.tickets.update")}}" method="post" id="send_ticket" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$ticket->id}}">

                <div class="row">

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label><span>عنوان التذكرة</span> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{$ticket->name}}" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><span>نوع التذكرة</span> <span class="text-danger">*</span></label>
                            <select class="form-control" name="ticket_type_id" required>
                                <option value="">إختر</option>
                                @foreach ($ticket_types as $ticket_type)
                                    <option value="{{$ticket_type->id}}" @if($ticket->ticket_type_id == $ticket_type->id) selected @endif>{{$ticket_type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><span>{{__("l.website")}}</span></label>
                            <select class="form-control" name="website_id" >
                                <option value="">عام</option>
                                @foreach ($websites as $website)
                                    <option value="{{$website->id}}" @if($ticket->website_id == $website->id) selected @endif>{{$website->{"name_".app()->getLocale()} }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label><span>نص التذكرة</span> <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="message" required rows="8" >{{$ticket->message}}</textarea>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label><span>المرفقات</span></label>
                            <div class="row">
                                <div class="col-sm-11">
                                    <input type="file" class="form-control" name="images[]" accept="image/*">
                                </div>
                                <div class="col-sm-1">
                                    <a href="#" class="btn btn-primary text-center btn-add-file" title="إضافة مرفق"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                            <div id="files"></div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary w120"><i class="fa fa-save"></i> <span>{{__("l.send")}}</span></button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <div id="files_wrapper" style="display: none;">
        <div class="row mt-15">
            <div class="col-sm-11">
                <input type="file" class="form-control" name="images[]" accept="image/*">
            </div>
            <div class="col-sm-1">
                <a href="#" class="btn btn-danger text-center btn-remove-file" title="حذف"><i class="fa fa-trash"></i></a>
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
