@extends("admin.parts.app")

@section("content")

    <div class="container pb-5 pt-1">

        @if(permissions("tickets_add"))
            <a href="{{route("admin.tickets.add")}}" class="btn general-btn-sm-blue float-left"><i class="fa fa-plus"></i> <span>{{__("l.open_ticket")}}</span></a>
        @endif
        <div class="clearfix mb-2"></div>

        <table class="table table-ticket">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th width="50" class="text-center">#</th>
                    <th>العميل</th>
                    <th>عنوان التذكرة</th>
                    <th>نوع التذكرة</th>
                    <th>الموقع</th>
                    <th>تاريخ آخر رد</th>
                    <th> آخر رد من</th>
                    <th>الحالة</th>
                    <th width="200">الأوامر</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($tickets as $ticket)
                <tr class="ticketlistproperties">
                    <td  width="50" class="text-center"><strong>{{$ticket->id+1000}}</strong></td>
                    <td><a target="_blank" href="{{route("admin.clients.edit", @$ticket->client_id)}}">{{@$ticket->client->name}}</a></td>
                    <td>{{$ticket->name}}</td>
                    <td>{{@$ticket->type->name}}</td>
                    <td>
                        @if(@$ticket->website)
                            <a target="_blank" href="{{--route("website.index2", [@$ticket->website->slug, "ar"])--}}">{{@$ticket->website->{"name_".app()->getLocale()} }}</a>
                        @else
                            <span>عام</span>
                        @endif
                    </td>
                    <td>
                        @if($ticket->last_reply_type)
                            {{@$ticket->the_date}}
                        @endif
                    </td>
                    <td>
                        @if($ticket->last_reply_type)
                            @if($ticket->last_reply_type == "client")
                                <strong>العميل : </strong> <span>{{@$ticket->last_reply_user}}</span>
                            @else
                                <strong>المستخدم : </strong> <span>{{@$ticket->last_reply_user}}</span>
                            @endif
                        @endif
                    </td>
                    <td class="text-center">
                        @if($ticket->status == 0)
                            <span class="status-prj enabled">مفتوح</span>
                        @else
                            <span class="status-prj unacceptable">مغلق</span>
                        @endif
                    </td>
                    <td width="200" class="text-center">
                        <div class="action">
                            @if(permissions("tickets_open_close"))
                                @if($ticket->status == 0)
                                    <a title="إغلاق" href="{{route("admin.tickets.status", [$ticket->id, 1])}}"><i class="fa fa-thumbs-down" style="color: #ebebeb;"></i></a>
                                @else
                                    <a title="إعادة فتح" href="{{route("admin.tickets.status", [$ticket->id, 0])}}"><i class="fa fa-thumbs-up" style="color: #ebebeb;"></i></a>
                                @endif
                            @endif
                            @if(permissions("tickets_show"))
                                <a title="{{__("l.preview")}}" href="{{route("admin.tickets.show", $ticket->id)}}">
                                    <img src="{{asset("public/dashboard/images/eye.png")}}" alt="" />
                                </a>
                            @endif
                            @if(permissions("tickets_edit"))
                                <a data-toggle="tooltip" title="{{__("l.edit")}}" href="{{route("admin.tickets.edit", $ticket->id)}}">
                                    <img src="{{asset("public/dashboard/images/settings.png")}}" alt="">
                                </a>
                            @endif
                            @if(permissions("tickets_remove"))
                                <a title="{{__("l.delete")}}" onclick="return confirm('{{__("l.are_you_sure")}}')" href="{{route("admin.tickets.delete", $ticket->id)}}">
                                    <img src="{{asset("public/dashboard/images/cpanel/delete.png")}}" alt="">
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection
