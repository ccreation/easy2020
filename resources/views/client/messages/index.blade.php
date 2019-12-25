@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">

        <table class="table table-ticket">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th width="30">#</th>
                    <th>{{__("l.website")}}</th>
                    <th>{{__("l.name")}}</th>
                    <th>{{__("l.email")}}</th>
                    <th>{{__("l.subject")}}</th>
                    <th>{{__("l.date")}}</th>
                    <th>{{__("l.actions")}}</th>
                </tr>
            </thead>
            <tbody>
            @if(count($messages)>0)
                @foreach($messages as $message)
                    <tr class="ticketlistproperties">
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{@$message->website->{"name_".app()->getLocale()} }}</td>
                        <td>{{$message->name}}</td>
                        <td>{{$message->email}}</td>
                        <td style="word-wrap:break-word;">{{$message->subject}}</td>
                        <td>{{$message->created_at}}</td>
                        <td class="text-center">
                            <div class="action">
                                @if(cpermissions("visitor_messages_preview"))
                                    <a href="{{route("client.messages.preview", $message->id)}}" title="{{__("l.preview")}}"><i class="fa fa-eye"></i></a>
                                @endif
                                @if(cpermissions("visitor_messages_delete"))
                                    <a href="{{route("client.messages.delete", $message->id)}}" onclick="return confirm ('{{__("l.are_you_sure")}}')" title="{{__("l.delete")}}"><i class="fa fa-trash"></i></a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="ticketlistproperties">
                    <td colspan="7" class="text-center"><b>{{__("l.no_data")}}</b></td>
                </tr>
            @endif
            </tbody>
        </table>

    </div>

@endsection
