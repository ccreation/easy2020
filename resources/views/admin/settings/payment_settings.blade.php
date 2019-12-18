@extends("admin.parts.app")

@section("content")

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route("admin.home")}}"><i class="fa fa-home"></i> <span>{{__("l.home")}}</span></a></li>
            <li class="breadcrumb-item"><a href="{{route("admin.settings.index")}}"><i class="fa fa-cogs"></i> <span>الإعدادات العامة</span></a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-cog"></i> <span>إعدادات الدفع</span></li>
        </ol>
    </nav>

    <div class="row">

        <div class="col-md-5">

            <div class="kt-portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand fab fa-amazon-pay"></i>
                    </span>
                        <h3 class="kt-portlet__head-title">إعدادات هايبرباي</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body" style="min-height: inherit">

                    <form action="{{route("admin.settings.save_settings")}}" method="post">
                        @csrf

                        <div class="form-group">
                            <label><span>Entity ID</span> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{@$settings["entity_id"]->value}}" name="entity_id" required>
                        </div>

                        <div class="form-group">
                            <label><span>Access Token</span> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{@$settings["access_token"]->value}}" name="access_token" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <span>حفظ</span></button>
                        </div>

                    </form>

                </div>
            </div>

            <div class="kt-portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-cog"></i>
                </span>
                        <h3 class="kt-portlet__head-title">الأشهر</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">

                    <a href="#" class="btn btn-primary btn-open" style="width: 150px;" data-target="#add_month"><i class="fa fa-plus"></i> <span>إضافة جديد</span></a>

                    <form id="add_month" action="{{route("admin.settings.add_month")}}" method="post" class="formi mt-20">
                        @csrf

                        <div class="form-group">
                            <label><span>عدد الأشهر</span> <span class="text-danger">*</span></label>
                            <input type="number" min="0" class="form-control" value="0" name="month" required>
                        </div>

                        <div class="form-group">
                            <label><span>عدد السنوات</span> <span class="text-danger">*</span></label>
                            <input type="number" min="0" class="form-control" value="0" name="year" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <span>حفظ</span></button>
                        </div>

                    </form>

                    @if(@$settings["months"]->value and is_array(unserialize(@$settings["months"]->value)))
                        <table class="table table-bordered mt-20">
                            <thead>
                            <tr>
                                <th width="30">#</th>
                                <th>الأشهر</th>
                                <th>الأوامر</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(unserialize(@$settings["months"]->value) as $k => $v)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <?php $m = $v % 12; $y = intval( $v / 12 ); ?>
                                    <td class="text-center">
                                        <strong>
                                            @if($y>0) <span>{{$y}}</span> <span>سنة</span> @endif @if($m>0) @if($y>0)<span>و</span>@endif <span>{{$m}}</span> <span>شهر</span> @endif
                                        </strong>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" title="تعديل" class="btn btn-xs btn-success btn-open" data-target="#edit_month{{$v}}"><i class="fa fa-edit"></i></a>
                                        <a href="{{route("admin.settings.remove_month", $k)}}" title="حذف" onclick="return confirm('هل أنت متأكد ؟')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="p-0">
                                        <form id="edit_month{{$v}}" action="{{route("admin.settings.update_month")}}" method="post" class="formi mt-20">
                                            @csrf
                                            <input type="hidden" name="index" value="{{$k}}">
                                            <?php $m = $v % 12; $y = intval( $v / 12 ); ?>

                                            <div class="form-group">
                                                <label><span>عدد الأشهر</span> <span class="text-danger">*</span></label>
                                                <input type="number" min="0" class="form-control" value="{{$m}}" name="month" required>
                                            </div>

                                            <div class="form-group">
                                                <label><span>عدد السنوات</span> <span class="text-danger">*</span></label>
                                                <input type="number" min="0" class="form-control" value="{{$v}}" name="year" required>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <span>حفظ</span></button>
                                            </div>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>

        </div>

        <div class="col-md-7">

            <div class="kt-portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-plug"></i>
                </span>
                        <h3 class="kt-portlet__head-title">الإضافات</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">

                    <a href="#" class="btn btn-primary btn-open" style="width: 150px;" data-target="#add_plugin"><i class="fa fa-plus"></i> <span>إضافة جديد</span></a>

                    <form id="add_plugin" action="{{route("admin.settings.add_plugin")}}" method="post" class="formi mt-20" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label><span>الإسم</span> <small>(عربي)</small> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name_ar" required>
                        </div>

                        <div class="form-group">
                            <label><span>الإسم</span> <small>(إنجليزي)</small> <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name_en" required>
                        </div>

                        <div class="form-group">
                            <label><span>السعر</span> <span class="text-danger">*</span></label>
                            <input type="number" min="0" class="form-control" value="0" step="0.1" name="price" required>
                        </div>

                        <div class="form-group">
                            <label><span>الصورة</span> <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" accept="image/*" name="image" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <span>حفظ</span></button>
                        </div>

                    </form>

                    <table class="table table-bordered mt-20">
                        <thead>
                        <tr>
                            <th width="30">#</th>
                            <th width="50">الصورة</th>
                            <th>الإسم (عربي)</th>
                            <th>الإسم (إنجليزي)</th>
                            <th>الأوامر</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($plugins as $plugin)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">
                                    <img src="{{asset("storage/app/".$plugin->image)}}" style="display: block; margin: 0px auto; width: 50px; height: 50px; border: 1px solid #eee; border-radius: 3px;">
                                </td>
                                <td class="text-left">{{$plugin->name_ar}}</td>
                                <td class="text-right">{{$plugin->name_en}}</td>
                                <td class="text-center">
                                    <a href="#" title="تعديل" class="btn btn-xs btn-success btn-open" data-target="#edit_plugin{{$plugin->id}}"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="p-0">
                                    <form id="edit_plugin{{$plugin->id}}" action="{{route("admin.settings.update_plugin")}}" method="post" class="formi mt-20" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$plugin->id}}">

                                        <div class="form-group">
                                            <label><span>الإسم</span> <small>(عربي)</small> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name_ar" value="{{$plugin->name_ar}}" required>
                                        </div>

                                        <div class="form-group">
                                            <label><span>الإسم</span> <small>(إنجليزي)</small> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name_en" value="{{$plugin->name_en}}" required>
                                        </div>

                                        <div class="form-group">
                                            <label><span>السعر</span> <span class="text-danger">*</span></label>
                                            <input type="number" min="0" class="form-control" value="{{$plugin->price}}" step="0.1" name="price" required>
                                        </div>

                                        <div class="form-group">
                                            <label><span>الصورة</span></label>
                                            <input type="file" class="form-control" accept="image/*" name="image">
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <span>حفظ</span></button>
                                        </div>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>

    </div>


@endsection
