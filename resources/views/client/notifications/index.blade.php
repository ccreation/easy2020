@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">

        <h4 class="text-center mb-4" style="color: #543c93;"><b>{{__("l.notifications_list")}}</b></h4>

        <table class="table table-ticket">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th width="50" class="text-center">#</th>
                    <th>الإشعار</th>
                    <th>الموقع</th>
                    <th width="50%">نص الإشعار</th>
                    <th style="width: 100">االتاريخ</th>
                </tr>
            </thead>
            <tbody>
                @if(count($notifications) > 0)
                    @foreach($notifications as $notification)
                        <tr class="ticketlistproperties" id="notification{{$notification->id}}">
                            <td width="50" class="text-center"><b>{{$loop->iteration}}</b></td>
                            <td>{{__("l.".$notification->type)}}</td>
                            <td>{{@$notification->website->{"name_".app()->getLocale()} }}</td>
                            <td>
                                <div style="border: 1px solid #eee; background: #f7f7f7; padding: 15px;">{!! $notification->message !!}</div>
                            </td>
                            <td>
                                <div>{{$notification->created_at}}</div>
                                <div>{{$notification->created_at->diffForHumans()}}</div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="ticketlistproperties">
                        <td colspan="5" class="text-center"><b>{{__("l.no_data")}}</b></td>
                    </tr>
                @endif
            </tbody>
        </table>

    </div>

@endsection
