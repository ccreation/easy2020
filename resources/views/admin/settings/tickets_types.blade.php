<a href="#" class="btn general-btn-sm-blue float-left btn-open" data-target="#add_ticket_type"><i class="fa fa-plus"></i> <span>إضافة نوع تذكرة</span></a>
<div class="clearfix"></div>

<form action="{{route("admin.settings.save_ticket_type")}}" method="post" id="add_ticket_type" class="formi form-setting mt-3">
    @csrf

    <div class="form-group">
        <label><span>الإسم</span> <span class="text-danger">*</span></label>
        <input type="text" class="form-control" required name="name">
    </div>

    <div class="form-group mb-15">
        <button type="submit" class="btn general-btn-sm-blue rounded"><i class="fa fa-save"></i> <span>حفظ</span></button>
    </div>

</form>

<table class="table table-ticket mt-3">
    <thead>
        <tr class="ticketlistheaderrow">
            <th width="60" class="text-center">#</th>
            <th>الإسم</th>
            <th width="120">الأوامر</th>
        </tr>
    </thead>
    <tbody>
    @if(count($ticketTypes) > 0)
        @foreach($ticketTypes as $ticketType)
            <tr class="ticketlistproperties">
                <td class="text-center"><strong>{{$loop->iteration}}</strong></td>
                <td>{{$ticketType->name}}</td>
                <td class="text-center" width="120">
                    <div class="action">
                        <a href="#" class="btn-open" data-target="#edit_ticket_type{{$ticketType->id}}" title="تعديل">
                                <img src="{{asset("public/dashboard/images/settings.png")}}" alt=""></a>
                        <a href="{{route("admin.settings.delete_ticket_type", $ticketType->id)}}" onclick="return confirm('هل أنت متأكد ؟')" title="حذف">
                            <img src="{{asset("public/dashboard/images/cpanel/delete.png")}}" alt="">
                        </a>
                    </div>
                </td>
            </tr>
            <tr class="p-0">
                <td colspan="3" class="p-0" style="border: none;">
                    <form action="{{route("admin.settings.update_ticket_type")}}" method="post" id="edit_ticket_type{{$ticketType->id}}" class="formi">
                        @csrf
                        <input type="hidden" name="id" value="{{$ticketType->id}}">

                        <div class="form-group">
                            <label><span>الإسم</span> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required name="name" value="{{$ticketType->name}}">
                        </div>

                        <div class="form-group mb-15">
                            <button type="submit" class="btn general-btn-sm-blue"><i class="fa fa-save"></i> <span>تعديل</span></button>
                        </div>

                    </form>
                </td>
            </tr>
        @endforeach
    @else
        <tr class="ticketlistproperties">
            <td colspan="3" class="text-center"><b>{{__("l.no_data")}}</b></td>
        </tr>
    @endif
    </tbody>
</table>
