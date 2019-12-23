@extends("client.parts.app")

@section("content")

    <div class="dropdown_widget-2 pt-4 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="row">
                        <div class="col-lg-3">
                            <a href="#setting1" class="widget__item_dropdown-link @if(!session('settingsTab') or session('settingsTab') == 1) link-active @endif">
                                <div class="widget__item_dropdown-icon">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <h3 class="widget__item_dropdown-title">{{__("l.website_settings")}}</h3>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="#setting2" class="widget__item_dropdown-link @if(session('settingsTab') == 2) link-active @endif">
                                <div class="widget__item_dropdown-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h3 class="widget__item_dropdown-title">{{__("l.smtp_settings")}}</h3>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="#setting3" class="widget__item_dropdown-link @if(session('settingsTab') == 3) link-active @endif">
                                <div class="widget__item_dropdown-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h3 class="widget__item_dropdown-title">رسالة إسترداد كلمة المرور العضو</h3>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="#setting4" class="widget__item_dropdown-link @if(session('settingsTab') == 4) link-active @endif">
                                <div class="widget__item_dropdown-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h3 class="widget__item_dropdown-title">رسالة تفعيل حساب العضو</h3>
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

                <form action="{{route("client.settings.save_settings1")}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <div class="col-lg-4 mx-auto">

                            <div class="form-group">
                                <lable class="form-label">{{__("l.default_lang")}}</lable>
                                <div class="kt-radio-list">
                                    <label class="kt-radio mt-10">
                                        <input type="radio" name="default_lang" value="ar" @if(@$settings["default_lang"]->value=="ar" or !@$settings["default_lang"]) checked @endif> <strong>{{__("l.arabic")}}</strong>
                                        <span></span>
                                    </label>
                                    <label class="kt-radio">
                                        <input type="radio" name="default_lang" value="en" @if(@$settings["default_lang"]->value=="en") checked @endif> <strong>{{__("l.english")}}</strong>
                                        <span></span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <lable class="form-label">{{__("l.enable_register_visitors")}}</lable>
                                <select name="enable_register_visitors" class="form-control mt-10">
                                    <option value="0" @if(@$settings["enable_register_visitors"]->value=="0" or !@$settings["enable_register_visitors"]) selected @endif>{{__("l.disabled")}}</option>
                                    <option value="1" @if(@$settings["enable_register_visitors"]->value=="1") selected @endif>{{__("l.login_only")}}</option>
                                    <option value="2" @if(@$settings["enable_register_visitors"]->value=="2") selected @endif>{{__("l.login_and_signup")}}</option>
                                </select>
                            </div>

                            @if(@$settings["enable_register_visitors"]->value=="1")
                                <div class="form-group">
                                    <lable class="form-label">{{__("l.visitor_activation_method")}}</lable>
                                    <select name="visitor_activation_method" class="form-control mt-10">
                                        <option value="0" @if(@$settings["visitor_activation_method"]->value=="0" or !@$settings["visitor_activation_method"]) selected @endif>{{__("l.automatically")}}</option>
                                        <option value="1" @if(@$settings["visitor_activation_method"]->value=="1") selected @endif>{{__("l.by_email")}}</option>
                                        <option value="2" @if(@$settings["visitor_activation_method"]->value=="2") selected @endif>{{__("l.by_dashboard_only")}}</option>
                                    </select>
                                </div>
                            @endif

                            <div class="form-group">
                                <lable class="form-label">{{__("l.enable_comments")}}</lable>
                                <select name="enable_comments" class="form-control mt-10">
                                    <option value="0" @if(@$client->enable_comments == 0 ) selected @endif>{{__("l.no")}}</option>
                                    <option value="1" @if(@$client->enable_comments == 1 ) selected @endif>{{__("l.only_registered")}}</option>
                                    <option value="2" @if(@$client->enable_comments == 2 ) selected @endif>{{__("l.registered_users_and_visitors")}}</option>
                                </select>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12 mx-auto text-center">
                            <div class="form-group text-center mt-5">
                                <button type="submit" class="btn general-btn-sm-blue rounded"><i class="fa fa-save"></i> <span>{{__("l.save")}}</span></button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

            <div class="setting_tab @if(session('settingsTab') == 2) active @endif" id="setting2">

                <form action="{{route("client.settings.save_settings2")}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <div class="col-lg-4 mx-auto">

                            <div class="form-group">
                                <label>أرسل من الإيميل التالي :</label>
                                <input type="text" class="form-control" name="email_sent_from_address" value="{{@$settings["email_sent_from_address"]->value}}" required>
                            </div>

                            <div class="form-group">
                                <label>إسم المرسل :</label>
                                <input type="text" class="form-control" name="email_sent_from_name" value="{{@$settings["email_sent_from_name"]->value}}" required>
                            </div>

                            <div class="form-group">
                                <label>مضيف الSMTP : </label>
                                <input type="text" class="form-control" name="email_smtp_host" value="{{@$settings["email_smtp_host"]->value}}">
                            </div>

                            <div class="form-group">
                                <label>اسم المستخدم SMTP : </label>
                                <input type="text" class="form-control" name="email_smtp_user" value="{{@$settings["email_smtp_user"]->value}}" autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>كلمة المرور SMTP : </label>
                                <input type="text" class="form-control" name="email_smtp_password" value="{{@$settings["email_smtp_password"]->value}}"  autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label>منفذ ال SMTP : </label>
                                <input type="text" class="form-control" name="email_smtp_port" value="{{@$settings["email_smtp_port"]->value}}">
                            </div>

                            <div class="form-group">
                                <hr style="margin-top: 30px">
                            </div>

                            <div class="form-group">
                                <label>أرسل رسالة تجربة إلى</label>
                                <input type="text" class="form-control" name="send_test_mail_to"/>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12 mx-auto text-center">
                            <div class="form-group text-center mt-5">
                                <button type="submit" class="btn general-btn-sm-blue rounded"><i class="fa fa-save"></i> <span>{{__("l.save")}}</span></button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

            <div class="setting_tab @if(session('settingsTab') == 3) active @endif" id="setting3">

                <form action="{{route("client.settings.save_settings2")}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <div class="col-lg-8 mx-auto">

                            <div class="form-group">
                                <textarea row="5" class="form-control summernote" name="reset_password_html" required>{{@$settings["reset_password_html"]->value}}</textarea>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12 mx-auto text-center">
                            <div class="form-group text-center mt-5">
                                <button type="submit" class="btn general-btn-sm-blue rounded"><i class="fa fa-save"></i> <span>{{__("l.save")}}</span></button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

            <div class="setting_tab @if(session('settingsTab') == 4) active @endif" id="setting4">

                <form action="{{route("client.settings.save_settings2")}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <div class="col-lg-8 mx-auto">

                            <div class="form-group">
                                <textarea row="5" class="form-control summernote" name="activation_html" required>{{@$settings["activation_html"]->value}}</textarea>
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12 mx-auto text-center">
                            <div class="form-group text-center mt-5">
                                <button type="submit" class="btn general-btn-sm-blue rounded"><i class="fa fa-save"></i> <span>{{__("l.save")}}</span></button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection

@section("scripts")

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/lang/summernote-ar-AR.min.js" integrity="sha256-q9MLAOH++5Xn68U2GKNu9ufu7FJ7NB1SN/U9eoI9uJ0=" crossorigin="anonymous"></script>

    <style>
        .popover-content.note-children-container{
            display: none;
        }
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

            $(".summernote").summernote({height: 300, lang: 'ar-AR'});

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
