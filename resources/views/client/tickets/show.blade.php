@extends("client.parts.app")

@section("content")

    <div class="container pb-5 pt-1">

        <h3 class="mb-3 text-center" style="color: #543c93;">
            <span>التذكرة {{$ticket->id+1000}}</span>
            @if($ticket->status == 0)
                <span class="text-success">مفتوحة</span>
            @else
                <span class="text-danger">مغلقة</span>
            @endif
        </h3>

        <h5 style="margin-bottom: 10px; color: #543c93;"><b>نص التذكرة : </b></h5>
        <p style="border: 1px solid #eee; background: #f7f7f7; padding: 15px; border-radius: 2px; min-height: 200px;">
            <strong class="float-right pb-5">{{$ticket->created_at}}</strong>
            <span class="clearfix"></span>
            <span>{{$ticket->message}}</span>
        </p>
        <?php $files = ($ticket->files) ? explode(";", $ticket->files) : []; ?>
        @if(!empty($files))
            <h5 style="margin-bottom: 10px; margin-top: 15px; color: #543c93;"><b>المرفقات : </b></h5>
            @foreach($files as $file)
                <a href="{{route("client.tickets.download_attachement", [$ticket->id, $loop->index])}}" target="_blank" class="mt-1 btn general-btn-sm-blue btn-xs" style="display: block; width: 120px; border-radius: 0px;"><i class="fa fa-download"></i> <span>{{__("l.attachement")}} {{$loop->iteration}}</span></a>
            @endforeach
        @endif

        <h5 style="margin: 40px 0px 20px; color: #543c93;"><b>الردود : </b></h5>

        <div id="replies" style="margin-bottom: 50px;">
            @if(count($ticket->replies) > 0)
                @foreach($ticket->replies as $reply)
                    @if($reply->client_id==1)
                        <div class="row" style=" margin-top: 10px;">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <h6 style="color: #543c93; margin-bottom: 10px;"><b>الإدارة</b></h6>
                                <p style="border: 1px solid #eee; background: #fff1d3; padding: 15px; border-radius: 2px; min-height: 100px;">
                                    <strong class="float-right pb-5">{{$reply->created_at}}</strong>
                                    <span class="clearfix"></span>
                                    <span>{{$reply->message}}</span>
                                    <?php $files = ($reply->files) ? explode(";", $reply->files) : []; ?>
                                    @if(!empty($files))
                                        @foreach($files as $file)
                                            <a href="{{route("client.tickets.download_attachement", [$reply->id, $loop->index])}}" target="_blank" class="mt-1 btn general-btn-sm-blue btn-xs" style="display: block; width: 120px; border-radius: 0px;"><i class="fa fa-download"></i> <span>{{__("l.attachement")}} {{$loop->iteration}}</span></a>
                                        @endforeach
                                    @endif
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="row" style=" margin-top: 10px;">
                            <div class="col-sm-10">
                                <h6 style="color: #543c93; margin-bottom: 10px;"><b>{{@$client->name}}</b></h6>
                                <p style="border: 1px solid #eee; background: #f7f7f7; padding: 15px; border-radius: 2px; min-height: 100px;">
                                    <strong class="float-right pb-5">{{$reply->created_at}}</strong>
                                    <span class="clearfix"></span>
                                    <span>{{$reply->message}}</span>
                                    <?php $files = ($reply->files) ? explode(";", $reply->files) : []; ?>
                                    @if(!empty($files))
                                        @foreach($files as $file)
                                            <a href="{{route("client.tickets.download_attachement", [$reply->id, $loop->index])}}" target="_blank" class="mt-1 btn general-btn-sm-blue btn-xs" style="display: block; width: 120px; border-radius: 0px;"><i class="fa fa-download"></i> <span>{{__("l.attachement")}} {{$loop->iteration}}</span></a>
                                        @endforeach
                                    @endif
                                </p>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                    @endif
                @endforeach
            @else
                <h4 class="text-center">{{__("l.no_data")}}</h4>
            @endif
        </div>

        @if($ticket->status == 0)

            <h5 style="margin-top: 40px; margin-bottom: 20px; color: #543c93;"><b>إرسال رد : </b></h5>

            <form action="{{route("client.tickets.reply")}}" method="post" id="send_ticket" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$ticket->id}}">

                <div class="row">

                    <div class="col-lg-12 mx-auto">

                        <div class="form-group">
                            <label><span>نص التذكرة</span> <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="message" required rows="8" ></textarea>
                        </div>

                        <div class="form-group">
                            <label><span>المرفقات</span></label>
                            <div class="row">
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="images[]" accept="image/*">
                                </div>
                                <div class="col-sm-2">
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
                            <button type="submit" class="btn general-btn-sm-blue rounded">{{__("l.send")}}</button>
                        </div>
                    </div>
                </div>

            </form>

        @endif

    </div>

    <div id="files_wrapper" style="display: none;">
        <div class="row mt-2">
            <div class="col-sm-10">
                <input type="file" class="form-control" name="images[]" accept="image/*">
            </div>
            <div class="col-sm-2">
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
