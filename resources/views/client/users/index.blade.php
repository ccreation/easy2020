@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="position: relative; min-height: 500px;">
        @if(cpermissions("users_section_add"))
            <a href="{{route("client.users.add")}}" class="btn general-btn-sm-blue float-left"><i class="fa fa-plus"></i> <span>{{__("l.add_user")}}</span></a>
        @endif

        <a href="javascript:void(0)" onclick="$('#users_filter').slideToggle();" class="btn general-btn-sm-blue float-left" style="margin-left: 15px;"> <i class="fa fa-filter"></i> <span>{{__("l.filters")}}</span> </a>

        <form id="users_filter" class="row" action="javascript:void(0);">

            <div class="col-sm-12"><h4 class="mb-2" style="color: #543C93;">{{__("l.filters")}} : </h4></div>

            <div class="col-sm-12 mb-2">
                <input type="text" class="name form-control" placeholder="{{__("l.name")}}">
            </div>

            <div class="col-sm-12 mb-2">
                <select class="role form-control">
                    <option value="all">{{__("l.role")}}</option>
                    <option value="0">{{__("l.admin")}}</option>
                    @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-12 mb-2">
                <input type="text" class="mobile form-control" placeholder="{{__("l.mobile")}}">
            </div>

            <div class="col-sm-12 mb-2">
                <input type="text" class="email form-control" placeholder="{{__("l.email")}}">
            </div>

            <div class="col-sm-12 mb-2">
                <select class="status form-control">
                    <option value="all">{{__("l.status")}}</option>
                    <option value="1">{{__("l.active")}}</option>
                    <option value="0">{{__("l.inactive")}}</option>
                </select>
            </div>

            <div class="col-sm-12">
                <div class="row">
                    <div class="text-center col-sm-6" style="padding-top: 5px">
                        <button type="submit" class="btn general-btn-sm-blue">{{__("l.filter")}}</button>
                    </div>

                    <div class="text-center col-sm-6" style="padding-top: 5px">
                        <button type="reset" class="btn general-btn-sm-black">{{__("l.reset")}}</button>
                    </div>
                </div>
            </div>

        </form>

        <div class="clearfix pb-3"></div>

        <table class="table table-ticket" id="clients_table">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th width="50" class="text-center">#</th>
                    <th width="80">{{__("l.image")}}</th>
                    <th>{{__("l.name")}}</th>
                    <th>{{__("l.role")}}</th>
                    <th>{{__("l.mobile")}}</th>
                    <th>{{__("l.email")}}</th>
                    <th>{{__("l.status")}}</th>
                    <th>{{__("l.actions")}}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="ticketlistproperties" data-name0="{{$user->name}}" data-role0="{{$user->role_id}}" data-mobile0="{{$user->mobile}}" data-email0="{{$user->email}}" data-status0="{{$user->status}}">
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="text-center">
                        @if($user->image)
                            <img src="{{asset("storage/app/".$user->image)}}" style="background: #fff; width: 50px; height: 50px; display: block; margin: 0px auto; border: 1px solid #543c93; border-radius: 4px;" />
                        @else
                            <img src="{{asset("public/no-image.png")}}" style="background: #fff; width: 50px; height: 50px; display: block; margin: 0px auto; border: 1px solid #543c93; border-radius: 4px;" />
                        @endif
                    </td>
                    <td>{{$user->name}}</td>
                    <td>{{ (@$user->role) ? @$user->role->name : __("l.admin") }}</td>
                    <td>{{$user->mobile}}</td>
                    <td>{{$user->email}}</td>
                    <td class="text-center">
                        @if($user->status==1)
                            <div class="status-prj enabled">{{__("l.active")}}</div>
                        @else
                            <div class="status-prj unacceptable">{{__("l.inactive")}}</div>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="action">
                            @if(cpermissions("users_section_edit"))
                                <a title="{{__("l.edit")}}" href="{{route("client.users.edit", $user->id)}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            @endif
                            @if(cpermissions("users_section_delete"))
                                @if($user->default==0)
                                    <a title="{{__("l.delete")}}"
                                       onclick="return confirm('{{__("l.are_you_sure")}}')"
                                       href="{{route("client.users.delete", $user->id)}}">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                @else
                                    <a class="disabled" title="{{__("l.delete")}}" disabled style="cursor: not-allowed" href="javascript:void(0)">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                @endif
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $users->links() }}

    </div>

@endsection

@section("scripts")

    <style>
        #users_filter{
            display: none;
            padding: 10px 10px 20px;
            width: 300px;
            background: #E4D8F0;
            border: 1px solid #543C93;
            position: absolute;
            top: 54px;
            left: 96px;
            z-index: 333;
        }
    </style>

    <script>

        $(function () {

            $(document).on("submit", "#users_filter", function (e) {
                e.preventDefault();
                var name        = $("#users_filter .name").val()+"";
                var role        = $("#users_filter .role").val()+"";
                var mobile      = $("#users_filter .mobile").val()+"";
                var email       = $("#users_filter .email").val()+"";
                var status      = $("#users_filter .status").val()+"";

                $("#clients_table tbody tr").hide();
                $("#clients_table tbody tr").filter(function () {

                    var namex = true;
                    var name0 = $(this).data('name0')+"";
                    if(name!=""){
                        if(!name0.includes(name))
                            namex = false;
                    }

                    var rolex = true;
                    var role0 = $(this).data('role0')+"";
                    if(role != "all"){
                        if(role0 != role)
                            rolex = false;
                    }

                    var mobilex = true;
                    var mobile0 = $(this).data('mobile0')+"";
                    if(mobile != ""){
                        if(!mobile0.includes(mobile))
                            mobilex = false;
                    }

                    var emailx = true;
                    var email0 = $(this).data('email0')+"";
                    if(email != ""){
                        if(!email0.includes(email))
                            emailx = false;
                    }

                    var statusx = true;
                    var status0 = $(this).data('status0')+"";
                    if(status!="all"){
                        if(status0!=status)
                            statusx = false;
                    }

                    return ( namex && rolex && mobilex && emailx && statusx);

                }).show();
                $('#users_filter').slideUp();

            });

            $(document).on("reset", "#users_filter", function (e) {
                e.preventDefault();
                $('#users_filter .name').val("");
                $('#users_filter .role').val("all");
                $('#users_filter .mobile').val("");
                $('#users_filter .email').val("");
                $('#users_filter .status').val("all");
                $("#clients_table tbody tr").show();
                $('#users_filter').slideUp();
            });

        });

    </script>

@endsection
