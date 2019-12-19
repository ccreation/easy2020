@extends("admin.parts.app")

@section("content")

    <div class="container pb-5">

        <a href="{{route("admin.images.categories")}}" class="btn general-btn-sm-blue float-left"><i class="fa fa-list"></i> <span>تصنيفات الصور</span></a>
        <a href="#" class="btn general-btn-sm-blue float-left btn-open ml-2" data-target="#add_image"><i class="fa fa-plus"></i> <span>إضافة صورة</span></a>
        <div class="clearfix mb-4"></div>

        <form action="{{route("admin.images.image_save")}}" method="post" class="formi mb-3" id="add_image">
            @csrf

            <div class="row">

                <div class="col-sm-8">

                    <div class="form-group">
                        <label><span>الإسم عربي</span> <span class="text-danger">*</span></label>
                        <input type="text" name="name_ar" value="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label><span>الإسم إنجليزي</span> <span class="text-danger">*</span></label>
                        <input type="text" name="name_en" value="" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label><span>التصنيف</span></label>
                        <select name="category_id" value="" class="form-control">
                            <option value="">إختر</option>
                            @foreach($image_categories as $image_category)
                                <option value="{{$image_category->id}}">{{$image_category->name_ar}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label><span>الرابط</span> <span class="text-danger">*</span></label>
                        <input type="text" name="url" id="url" value="" class="form-control" required>
                    </div>

                </div>

                <div class="col-sm-4">
                    <div id="image_preview"></div>
                </div>

            </div>

            <div class="form-group">
                <button type="submit" class="btn general-btn-sm-blue"><i class="fa fa-save"></i> <span>إضافة</span></button>
            </div>

        </form>

        <table class="table table-ticket mt-2">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th width="60" class="text-center">#</th>
                    <th width="50">الصورة</th>
                    <th>الإسم عربي</th>
                    <th>الإسم إنجليزي</th>
                    <th>التصنيف</th>
                    <th width="120">الأوامر</th>
                </tr>
            </thead>
            <tbody>
                @foreach($images as $image)
                    <tr class="ticketlistproperties">
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td width="50" style="padding: 0.75rem;"><img src="{{$image->url}}" style="width: 50px; height: 50px;"></td>
                        <td>{{$image->name_ar}}</td>
                        <td>{{$image->name_en}}</td>
                        <td>{{@$image->category->name_ar}}</td>
                        <td width="120" class="text-center">
                            <div class="action">
                                <a href="{{$image->url}}" target="_blank" title="مشاهدة">
                                    <img src="{{asset("public/dashboard/images/eye.png")}}" alt="">
                                </a>
                                <a href="#" data-target="#edit_image{{$image->id}}" class="btn-open" title="تعديل">
                                    <img src="{{asset("public/dashboard/images/settings.png")}}" alt="">
                                </a>
                                <a href="{{route("admin.images.image_delete", $image->id)}}" onclick="return confirm('هل انت متأكد ؟')" title="حذف">
                                    <img src="{{asset("public/dashboard/images/cpanel/delete.png")}}" alt="">
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-0" colspan="6" style="border: none;">
                            <form action="{{route("admin.images.image_update")}}" method="post" class="formi" id="edit_image{{$image->id}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$image->id}}">

                                <div class="row">

                                    <div class="col-sm-8">

                                        <div class="form-group">
                                            <label><span>الإسم عربي</span> <span class="text-danger">*</span></label>
                                            <input type="text" name="name_ar" value="{{$image->name_ar}}" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label><span>الإسم إنجليزي</span> <span class="text-danger">*</span></label>
                                            <input type="text" name="name_en" value="{{$image->name_en}}" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label><span>التصنيف</span></label>
                                            <select name="category_id" value="" class="form-control">
                                                <option value="">إختر</option>
                                                @foreach($image_categories as $image_category)
                                                    <option value="{{$image_category->id}}" @if($image_category->id == $image->category_id) selected @endif>{{$image_category->name_ar}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label><span>الرابط</span> <span class="text-danger">*</span></label>
                                            <input type="text" name="url" id="url" value="{{$image->url}}" class="form-control" required>
                                        </div>

                                    </div>

                                    <div class="col-sm-4">
                                        <div id="image_preview"></div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary w200"><i class="fa fa-save"></i> <span>إضافة</span></button>
                                </div>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection

@section("scripts")

    <script>

        $(function () {

            $(document).on("change paste keyup blur", "#url", function () {
                var url =  $(this).val();
                var html = '<img src="'+url+'" style="width: 100%;">';
                $(this).closest(".row").find("#image_preview").html(html);
            });

        });

    </script>

@endsection
