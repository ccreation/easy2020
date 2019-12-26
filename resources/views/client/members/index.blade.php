@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="position: relative; min-height: 500px;">

        @if(cpermissions("users_section_add"))
            <a href="{{route("client.members.add")}}" class="btn general-btn-sm-blue float-left"><i class="fa fa-plus"></i> <span>{{__("l.add_user")}}</span></a>
        @endif

        <div class="clearfix pb-3"></div>

        <table class="table table-ticket">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th class="text-center" width="40">#</th>
                    <th width="55">{{__("l.image")}}</th>
                    <th>{{__("l.name")}}</th>
                    <th>{{__("l.email")}}</th>
                    <th>{{__("l.website")}}</th>
                    <th>{{__("l.status")}}</th>
                    <th>{{__("l.actions")}}</th>
                </tr>
            </thead>
            <tbody>
            @if(count($visitors)>0)
                @foreach($visitors as $visitor)
                    <tr class="ticketlistproperties">
                        <td class="text-center" width="40"><b>{{$loop->iteration}}</b></td>
                        <td class="text-center p-1" width="55">
                            @if($visitor->image)
                                <img src="{{asset("storage/app/".$visitor->image)}}" style="width: 50px; height: 50px; display: block; margin: 0px auto; border: 1px solid #eee; border-radius: 4px;" />
                            @else
                                <img src="{{asset("public/no-image.png")}}" style="width: 50px; height: 50px; display: block; margin: 0px auto; border: 1px solid #eee; border-radius: 4px;" />
                            @endif
                        </td>
                        <td>{{$visitor->name}}</td>
                        <td>{{$visitor->email}}</td>
                        <td>{{@$visitor->website->{"name_".app()->getLocale()} }}</td>
                        <td class="text-center">
                            @if($visitor->status==1)
                                <div class="status-prj enabled">{{__("l.active")}}</div>
                            @else
                                <div class="status-prj unacceptable">{{__("l.inactive")}}</div>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="action">
                                @if(cpermissions("members_management_update"))
                                    @if($visitor->status==1)
                                        <a title="{{__("l.deactivate")}}" href="{{route("client.members.deactivate", $visitor->id)}}"><i class="fa fa-thumbs-down text-white"></i></a>
                                    @else
                                        <a title="{{__("l.activate")}}" href="{{route("client.members.activate", $visitor->id)}}"><i class="fa fa-thumbs-up"></i></a>
                                    @endif
                                    <a title="{{__("l.edit")}}" href="{{route("client.members.edit", $visitor->id)}}"><i class="fa fa-edit"></i></a>
                                @endif
                                @if(cpermissions("members_management_delete"))
                                    <a title="{{__("l.delete")}}" onclick="return confirm('{{__("l.are_you_sure")}}')"
                                       href="{{route("client.members.delete", $visitor->id)}}"><i class="fa fa-trash"></i></a>
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
