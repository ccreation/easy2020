@extends("admin.parts.app")

@section("content")

    <div class="dropdown_widget-2 pt-4 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="row mx-auto">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-2">
                            <a href="#setting1" class="widget__item_dropdown-link @if(!session('settingsTab2') or session('settingsTab2') == 1) link-active @endif">
                                <div class="widget__item_dropdown-icon">
                                    <i class="fab fa-amazon-pay"></i>
                                </div>
                                <h3 class="widget__item_dropdown-title">إعدادات هايبرباي</h3>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a href="#setting2" class="widget__item_dropdown-link @if(session('settingsTab2') == 2) link-active @endif">
                                <div class="widget__item_dropdown-icon">
                                    <i class="fa fa-plug"></i>
                                </div>
                                <h3 class="widget__item_dropdown-title">الإضافات</h3>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a href="#setting3" class="widget__item_dropdown-link @if(session('settingsTab2') == 3) link-active @endif">
                                <div class="widget__item_dropdown-icon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <h3 class="widget__item_dropdown-title">الأشهر</h3>
                            </a>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content pt-5">
        <div class="container">

            <div class="setting_tab @if(!session('settingsTab2') or session('settingsTab2') == 1) active @endif" id="setting1">

                <form action="{{route("admin.settings.save_settings")}}" class="form-setting" method="post">
                    @csrf

                    <div class="row">

                        <div class="col-lg-4 mx-auto">

                            <div class="form-group">
                                <label><span>Entity ID</span> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{@$settings["entity_id"]->value}}" name="entity_id" required>
                                    </div>

                            <div class="form-group">
                                <label><span>Access Token</span> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{@$settings["access_token"]->value}}" name="access_token" required>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12 mx-auto">
                            <div class="form-group text-center mt-5">
                                <button type="submit" class="btn general-btn-sm-blue rounded">حفظ</button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

            <div class="setting_tab @if(session('settingsTab2') == 2) active @endif" id="setting2">

                <div class="row">

                    <div class="col-lg-6 mx-auto">

                        <table class="table table-ticket">
                            <thead>
                                <tr class="ticketlistheaderrow">
                                    <th class="text-center" width="30">#</th>
                                    <th width="50">الصورة</th>
                                    <th>الإسم (عربي)</th>
                                    <th>الإسم (إنجليزي)</th>
                                    <th>الأوامر</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($plugins as $plugin)
                                <tr class="ticketlistproperties">
                                    <td class="text-center"><strong>{{$loop->iteration}}</strong></td>
                                    <td class="text-center">
                                        <img src="{{asset("storage/app/".$plugin->image)}}" style="display: block; margin: 0px auto; width: 50px; height: 50px; border: 1px solid #eee; border-radius: 3px;">
                                    </td>
                                    <td class="text-left">{{$plugin->name_ar}}</td>
                                    <td class="text-right">{{$plugin->name_en}}</td>
                                    <td class="text-center">
                                        <div class="action">
                                            <a href="#" title="تعديل" class="btn-open" data-target="#edit_plugin{{$plugin->id}}">
                                                <img src="{{asset("public/dashboard/images/settings.png")}}" alt="">
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="p-0" style="border: none;">
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
                                                <button type="submit" class="btn general-btn-sm-blue"><i class="fa fa-save"></i> <span>حفظ</span></button>
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

            <div class="setting_tab @if(session('settingsTab2') == 3) active @endif" id="setting3">

                <div class="row">

                    <div class="col-lg-6 mx-auto">

                        <a href="#" class="btn general-btn-sm-blue btn-open" data-target="#add_month"><i class="fa fa-plus"></i> <span>إضافة جديد</span></a>

                        <form id="add_month" action="{{route("admin.settings.add_month")}}" method="post" class="formi mt-3">
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
                                <button type="submit" class="btn general-btn-sm-blue"><i class="fa fa-save"></i> <span>حفظ</span></button>
                            </div>

                        </form>

                        @if(@$settings["months"]->value and is_array(unserialize(@$settings["months"]->value)))

                            <table class="table table-ticket mt-3">
                                <thead>
                                    <tr class="ticketlistheaderrow">
                                        <th class="text-center" width="30">#</th>
                                        <th>الأشهر</th>
                                        <th width="100">الأوامر</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach(unserialize(@$settings["months"]->value) as $k => $v)
                                    <tr class="ticketlistproperties">
                                        <td class="text-center" width="30"><strong>{{$loop->iteration}}</strong></td>
                                        <?php $m = $v % 12; $y = intval( $v / 12 ); ?>
                                        <td class="text-center">
                                            <strong>
                                                @if($y>0) <span>{{$y}}</span> <span>سنة</span> @endif @if($m>0) @if($y>0)<span>و</span>@endif <span>{{$m}}</span> <span>شهر</span> @endif
                                            </strong>
                                        </td>
                                        <td width="100" class="text-center">
                                            <div class="action">
                                                <a href="#" title="تعديل" class="btn-open" data-target="#edit_month{{$v}}">
                                                    <img src="{{asset("public/dashboard/images/settings.png")}}" alt="">
                                                </a>
                                                <a href="{{route("admin.settings.remove_month", $k)}}" title="حذف" onclick="return confirm('هل أنت متأكد ؟')">
                                                    <img src="{{asset("public/dashboard/images/cpanel/delete.png")}}" alt="">
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="p-0" style="border:none;">
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
                                                    <input type="number" min="0" class="form-control" value="{{$y}}" name="year" required>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn general-btn-sm-blue "><i class="fa fa-save"></i> <span>حفظ</span></button>
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

        </div>
    </div>

@endsection

@section("scripts")

    <style>
    .setting_tab:not(.active){
        display: none;
    }
    .permissions_form label{
        display: block;
    }
    .nav-link{
        background-color: #512293;
        color: #fff;
        border-color: #AF96D3 !important;
        font-weight: bold;
    }
    .nav-link.active, .nav-link:hover{
        background-color: #fff !important;
        color: #512293 !important;
    }
    .text-dark{
        font-weight: bold;
        display: block;
        margin-bottom: 15px;
    }
    .tab-content{
        border: 1px solid #AF96D3;
        border-top: none;
        padding: 15px 10px;
    }
    .nav-tabs{
        border-color: #AF96D3;
    }
    </style>

    <script>

        $(function () {

            $(document).on("click", ".widget__item_dropdown-link", function (e) {
                e.preventDefault();
                $(".widget__item_dropdown-link").removeClass("link-active");
                $(this).addClass("link-active");
                $(".setting_tab").removeClass("active");
                var id = $(this).attr("href");
                $(id).addClass("active");
            });

        });

    </script>

@endsection
