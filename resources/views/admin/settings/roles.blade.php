<a href="#" class="btn general-btn-sm-blue float-left btn-open" data-target="#addRole"><i class="fa fa-plus"></i> <span>إضافة دور</span></a>
<div class="clearfix"></div>

<form action="{{route("admin.settings.save_role")}}" method="post" class="formi form-setting mt-3" id="addRole">
    @csrf
    <div class="form-group">
        <label><span>الإسم</span> <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group mt-20">
        <button type="submit" class="btn general-btn-sm-blue rounded"><i class="fa fa-save"></i> <span>حفظ</span></button>
    </div>
</form>

<table class="table table-ticket mt-3">
    <thead>
        <tr class="ticketlistheaderrow">
            <th width="20" class="text-center">#</th>
            <th>الإسم</th>
            <th width="100">الأوامر</th>
        </tr>
    </thead>
    <tbody>
    @foreach($roles as $role)
        <tr class="ticketlistproperties">
            <td width="20" class="text-center"><strong>{{$loop->iteration}}</strong></td>
            <td>{{$role->name}}</td>
            <td class="text-center" width="120">
                @if($role->id!=1)
                    <div class="action">
                        <a href="#" class="btn-open" data-target="#editRole{{$role->id}}" title="تعديل">
                            <img src="{{asset("public/dashboard/images/settings.png")}}" alt=""></a>
                        <a href="{{route("admin.settings.delete_role", $role->id)}}" onclick="return confirm('هل أنت متأكد ؟')" title="حذف">
                            <img src="{{asset("public/dashboard/images/cpanel/delete.png")}}" alt="">
                        </a>
                    </div>
                @endif
            </td>
        </tr>
        @if($role->id!=1)
            <tr class="p-0">
                <td colspan="3" class="p-0" style="border: none;">
                    <div class="formi" id="editRole{{$role->id}}">
                        <form action="{{route("admin.settings.update_role")}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$role->id}}">
                            <div class="form-group">
                                <label><span>الإسم</span> <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{$role->name}}" required>
                            </div>
                            <div class="form-group mt-20">
                                <button type="submit" class="btn general-btn-sm-blue rounded"><i class="fa fa-save"></i> <span>تعديل</span></button>
                            </div>
                        </form>
                    </div>
                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
