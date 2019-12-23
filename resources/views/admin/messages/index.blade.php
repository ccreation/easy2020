@extends("admin.parts.app")

@section("content")

    <div class="container">

        <table class="table table-ticket mt-3">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th width="50" class="text-center">#</th>
                    <th>الإسم</th>
                    <th>الإيميل</th>
                    <th>الموضوع</th>
                    <th>التاريخ</th>
                    <th>الأوامر</th>
                </tr>
            </thead>
            <tbody>
            @foreach($messages as $message)
                <tr class="ticketlistproperties">
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td>{{$message->name}}</td>
                    <td>{{$message->email}}</td>
                    <td>{{$message->subject}}</td>
                    <td>{{$message->created_at}}</td>
                    <td class="text-center" width="120">
                        <div class="action">
                            <a href="#" data-toggle="modal" data-target="#myModal{{$message->id}}" title="عرض">
                                <img src="{{asset("public/dashboard/images/eye.png")}}" alt="">
                            </a>
                            <a href="{{route("admin.messages.delete", $message->id)}}" onclick="return confirm('هل أنت متأكد ؟')" title="حذف">
                                <img src="{{asset("public/dashboard/images/cpanel/delete.png")}}" alt="">
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    @foreach($messages as $message)
        <div class="modal" id="myModal{{$message->id}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">نص الرسالة</h4>
                    </div>
                    <div class="modal-body">{{$message->message}}</div>
                </div>
            </div>
        </div>
    @endforeach


@endsection
