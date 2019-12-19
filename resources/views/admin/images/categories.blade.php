@extends("admin.parts.app")

@section("content")

    <div class="container pb-5">

        <a href="{{route("admin.images.index")}}" class="btn general-btn-sm-blue float-left"><i class="fa fa-list"></i> <span>قائمة الصور</span></a>
        <a href="#" class="btn general-btn-sm-blue float-left btn-open ml-2" data-target="#add_image_category"><i class="fa fa-plus"></i> <span>إضافة تصنيف</span></a>
        <div class="clearfix mb-4"></div>

        <form action="{{route("admin.images.category_save")}}" method="post" class="formi mb-2" id="add_image_category">
            @csrf

            <div class="form-group">
                <label><span>الإسم عربي</span> <span class="text-danger">*</span></label>
                <input type="text" name="name_ar" class="form-control" required>
            </div>

            <div class="form-group">
                <label><span>الإسم إنجليزي</span> <span class="text-danger">*</span></label>
                <input type="text" name="name_en" class="form-control" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn general-btn-sm-blue"><i class="fa fa-save"></i> <span>حفظ</span></button>
            </div>

        </form>

        <table class="table table-ticket mt-2">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th width="60" class="text-center">#</th>
                    <th>الإسم عربي</th>
                    <th>الإسم إنجليزي</th>
                    <th width="180">الأوامر</th>
                </tr>
            </thead>
            <tbody>
                @foreach($image_categories as $image_category)
                    <tr class="ticketlistproperties">
                        <td class="text-center"><strong>{{$loop->iteration}}</strong></td>
                        <td>{{$image_category->name_ar}}</td>
                        <td>{{$image_category->name_en}}</td>
                        <td class="text-center">
                            <div class="action">
                                <a href="#" data-target="#edit_image_category{{$image_category->id}}" class="btn-open" title="تعديل">
                                    <img src="{{asset("public/dashboard/images/settings.png")}}" alt="">
                                </a>
                                <a href="{{route("admin.images.category_delete", $image_category->id)}}" onclick="return confirm('هل أنت متأكد ؟')" title="حفظ">
                                    <img src="{{asset("public/dashboard/images/cpanel/delete.png")}}" alt="">
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-0" colspan="4" style="border: none;">
                            <form action="{{route("admin.images.category_update")}}" method="post" class="formi" id="edit_image_category{{$image_category->id}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$image_category->id}}">

                                <div class="form-group">
                                    <label><span>الإسم عربي</span> <span class="text-danger">*</span></label>
                                    <input type="text" name="name_ar" value="{{$image_category->name_ar}}" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label><span>الإسم إنجليزي</span> <span class="text-danger">*</span></label>
                                    <input type="text" name="name_en" value="{{$image_category->name_en}}" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn general-btn-sm-blue"><i class="fa fa-save"></i> <span>تعديل</span></button>
                                </div>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection
