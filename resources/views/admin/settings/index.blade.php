@extends("admin.parts.app")

@section("content")

    <div class="dropdown_widget-2 pt-4 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="row">
                        <div class="col-lg-2">
                            <a href="#setting1" class="widget__item_dropdown-link @if(!session('settingsTab') or session('settingsTab') == 1) link-active @endif">
                                <div class="widget__item_dropdown-icon">
                                    <i class="fas fa-award"></i>
                                </div>
                                <h3 class="widget__item_dropdown-title">اعدادات عامة</h3>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a href="#setting2" class="widget__item_dropdown-link @if(session('settingsTab') == 2) link-active @endif">
                                <div class="widget__item_dropdown-icon">
                                    <i class="fas fa-award"></i>
                                </div>
                                <h3 class="widget__item_dropdown-title">اعدادات ال smtp</h3>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a href="#setting3" class="widget__item_dropdown-link @if(session('settingsTab') == 3) link-active @endif">
                                <div class="widget__item_dropdown-icon">
                                    <i class="fas fa-award"></i>
                                </div>
                                <h3 class="widget__item_dropdown-title">اعدادات ال sms</h3>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a href="#setting4" class="widget__item_dropdown-link @if(session('settingsTab') == 4) link-active @endif">
                                <div class="widget__item_dropdown-icon">
                                    <i class="fas fa-award"></i>
                                </div>
                                <h3 class="widget__item_dropdown-title">أنواع التذاكر</h3>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a href="#setting5" class="widget__item_dropdown-link @if(session('settingsTab') == 5) link-active @endif">
                                <div class="widget__item_dropdown-icon">
                                    <i class="fas fa-award"></i>
                                </div>
                                <h3 class="widget__item_dropdown-title">قائمة الأدوار</h3>
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a href="#setting6" class="widget__item_dropdown-link @if(session('settingsTab') == 6) link-active @endif">
                                <div class="widget__item_dropdown-icon">
                                    <i class="fas fa-award"></i>
                                </div>
                                <h3 class="widget__item_dropdown-title">قائمة الصلاحيات</h3>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content pt-5">
        <div class="container">

            <div class="setting_tab @if(!session('settingsTab') or session('settingsTab') == 1) active @endif" id="setting1">
                <div class="wow fadeInUp animate" data-wow-duration="1.5s" data-wow-delay=".1s">
                    @include("admin.settings.general")
                </div>
            </div>

            <div class="setting_tab @if(session('settingsTab') == 2) active @endif" id="setting2">
                @include("admin.settings.smtp")
            </div>

            <div class="setting_tab @if(session('settingsTab') == 3) active @endif" id="setting3">
                @include("admin.settings.yamamah")
            </div>

            <div class="setting_tab @if(session('settingsTab') == 4) active @endif" id="setting4">
                @include("admin.settings.tickets_types")
            </div>

            <div class="setting_tab @if(session('settingsTab') == 5) active @endif" id="setting5">
                @include("admin.settings.roles")
            </div>

            <div class="setting_tab @if(session('settingsTab') == 6) active @endif" id="setting6">
                @include("admin.settings.permissions")
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

            $(document).on("ifChanged", ".all_permissions", function () {
                if($(this). prop("checked") == true){
                    $(".checkboxx", $(this).closest("form")).iCheck('check');
                }else{
                    $(".checkboxx", $(this).closest("form")).iCheck('uncheck');
                }
            }) ;

            $(document).on("ifChanged", ".checkboxx", function () {
                $(".all_permissions", $(this).closest("form")).iCheck('uncheck');
            }) ;

        });
    </script>

@endsection
