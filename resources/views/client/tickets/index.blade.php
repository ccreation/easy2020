@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="position: relative; min-height: 500px;">

        <a href="{{route("client.tickets.add")}}" class="btn general-btn-sm-blue float-left"><i class="fa fa-plus"></i> <span>{{__("l.open_ticket")}}</span></a>
        <div class="clearfix mb-4"></div>

        <table class="table table-ticket">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th class="text-center" width="50">#</th>
                    <th>عنوان التذكرة</th>
                    <th>نوع التذكرة</th>
                    <th>الموقع</th>
                    <th>تاريخ آخر رد</th>
                    <th>الحالة</th>
                    <th>الأوامر</th>
                </tr>
            </thead>
            <tbody>
                @if(count($tickets) > 0)
                    @foreach ($tickets as $ticket)
                        <tr class="ticketlistproperties">
                            <td class="text-center" width="50"><b>{{$ticket->id+1000}}</b></td>
                            <td>{{$ticket->name}}</td>
                            <td>{{@$ticket->type->name}}</td>
                            <td>
                                @if(@$ticket->website)
                                    <a target="_blank" href="{{--route("website.index2", [@$ticket->website->slug, "ar"])--}}">{{@$ticket->website->{"name_".app()->getLocale()} }}</a>
                                @else
                                    <span>عام</span>
                                @endif
                            </td>
                            <td>{{@$ticket->the_date}}</td>
                            <td class="text-center">
                                @if($ticket->status == 0)
                                    <span class="status-prj enabled">مفتوحة</span>
                                @else
                                    <span class="status-prj unacceptable">مغلقة</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="action">
                                    <a title="{{__("l.preview")}}" href="{{route("client.tickets.show", $ticket->id)}}"><i class="fa fa-eye"></i></a>
                                </div>
                                {{--
                                <a class="btn btn-xs btn-success" data-toggle="tooltip" title="{{__("l.edit")}}"
                                   href="{{route("client.tickets.edit", $ticket->id)}}"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-xs btn-danger" data-toggle="tooltip" title="{{__("l.delete")}}"
                                   onclick="return confirm('{{__("l.are_you_sure")}}')"
                                   href="{{route("client.tickets.delete", $ticket->id)}}"><i class="fa fa-trash"></i></a>
                                   --}}
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
