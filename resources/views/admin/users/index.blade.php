@extends("admin.parts.app")

@section("content")

    <div class="container">

        @if(permissions("banks_add"))
            <a href="{{route("admin.users.add")}}" class="btn general-btn-sm-blue float-left "><i class="fa fa-plus"></i> <span>إضافة مستخدم</span></a>
            <div class="clearfix"></div>
        @endif

        <table class="table table-ticket mt-3">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th width="50" class="text-center">#</th>
                    <th>الإسم</th>
                    <th>الجوال</th>
                    <th>الإيميل</th>
                    <th>الدور</th>
                    <th>الأوامر</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="ticketlistproperties">
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->mobile}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{@$user->role->name}}</td>
                    <td class="text-center" width="120">
                        @if($user->id!=1)
                            <div class="action">
                                @if(permissions("update_user"))
                                    <a href="{{route("admin.users.edit", $user->id)}}" title="تعديل">
                                        <img src="{{asset("public/dashboard/images/settings.png")}}" alt="">
                                    </a>
                                @endif
                                @if(permissions("remove_user"))
                                    <a href="{{route("admin.users.delete", $user->id)}}" onclick="return confirm('هل أنت متأكد ؟')" title="حذف">
                                        <img src="{{asset("public/dashboard/images/cpanel/delete.png")}}" alt="">
                                    </a>
                                @endif
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

@endsection
