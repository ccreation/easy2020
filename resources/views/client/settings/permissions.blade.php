@extends("client.parts.app")

@section("content")

    <div class="container pb-5 pt-3">

        <h3 class="float-right" style="color: #543c93; line-height: 40px;">{{__("l.roles_list")}}</h3>

        <a href="#" data-target="#add_role" class="btn-open float-left btn general-btn-sm-blue"><i class="fa fa-plus"></i> <span>{{__("l.add_new")}}</span></a>

        <div class="clearfix mb-2"></div>

        <form action="{{route("client.settings.save_role")}}" id="add_role" class="formi" method="post">
            @csrf

            <div class="form-group">
                <label><span>{{__("l.name")}}</span> <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn general-btn-sm-blue"><i class="fa fa-save"></i> <span>{{__("l.save")}}</span></button>
            </div>

        </form>

        <table class="table table-ticket mt-3">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th width="50" class="text-center">#</th>
                    <th>{{__("l.name")}}</th>
                    <th width="150" class="text-center">{{__("l.actions")}}</th>
                </tr>
            </thead>
            <tbody>
                <tr class="ticketlistproperties">
                    <td class="text-center">1</td>
                    <td>الأدمن</td>
                    <td></td>
                </tr>
            @foreach($roles as $role)
                <tr class="ticketlistproperties">
                    <td width="50" class="text-center"><b>{{$loop->iteration + 1}}</b></td>
                    <td>{{$role->name}}</td>
                    <td class="text-center">
                        <div class="action">
                            <a href="#" data-target="#edit_role{{$role->id}}" class="btn-open"title="{{__("l.edit")}}"><i class="fa fa-edit"></i></a>
                            <a href="{{route("client.settings.delete_role", $role->id)}}"
                               onclick="return confirm('{{__("l.are_you_sure")}}')" title="{{__("l.remove")}}"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <tr class="ticketlistproperties">
                    <td class="p-0" colspan="3" style="border: none;">
                        <form action="{{route("client.settings.update_role")}}" method="post" class="formi" id="edit_role{{$role->id}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$role->id}}">

                            <div class="form-group">
                                <label><span>{{__("l.name")}}</span> <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{$role->name}}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn general-btn-sm-blue"><i class="fa fa-save"></i> <span>{{__("l.save")}}</span></button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <h3 style="color: #543c93; line-height: 40px;">{{__("l.permissions")}}</h3>

        <div class="kt-portlet__body">

            <ul class="nav nav-tabs">
                @foreach($roles as $role)
                    <li class="nav-item">
                        <a class="nav-link @if($loop->iteration == 1) active @endif" data-toggle="tab" href="#role{{$role->id}}">{{$role->name}}</a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach($roles as $role)
                    <div class="tab-pane container @if($loop->iteration == 1) active @endif" id="role{{$role->id}}">
                        <?php $permissions = unserialize($role->permissions); $permissions = (is_array($permissions)) ? $permissions : []; ?>
                            <h2 class="text-center mb-5 mt-0" style="color: #512293">{{$role->name}}</h2>
                        <form action="{{route("client.settings.save_permissions")}}" method="post" class="permissions_form">
                            @csrf
                            <input type="hidden" name="role_id" value="{{$role->id}}">

                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="kt-checkbox"><input class="all_permissions" type="checkbox" > <strong>{{__("l.all_permissions")}}</strong><span></span></label>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-3">
                                    <div style="font-size: 1.2em;" class="mb-15"><strong>{{__("l.home")}}</strong></div>
                                    <ul class="p-0 m-0" style="list-style: none;">
                                        <li><label class="kt-checkbox"><input name="home_preview" @if(in_array("home_preview", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.preview")}}</strong><span></span></label></li>
                                    </ul>
                                </div>

                                <div class="col-sm-3">
                                    <div style="font-size: 1.2em;" class="mb-15"><strong>{{__("l.users_section")}}</strong></div>
                                    <ul class="p-0 m-0" style="list-style: none;">
                                        <li><label class="kt-checkbox"><input name="users_section_list" @if(in_array("users_section_list", $permissions)) checked @endif type="checkbox"  class="checkboxx"> <strong>{{__("l.the_list")}}</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="users_section_add" @if(in_array("users_section_add", $permissions)) checked @endif type="checkbox"  class="checkboxx"> <strong>{{__("l.add")}}</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="users_section_edit" @if(in_array("users_section_edit", $permissions)) checked @endif type="checkbox"  class="checkboxx"> <strong>{{__("l.edit")}}</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="users_section_delete" @if(in_array("users_section_delete", $permissions)) checked @endif type="checkbox"  class="checkboxx"> <strong>{{__("l.delete")}}</strong><span></span></label></li>
                                    </ul>
                                </div>

                                <div class="col-sm-3">
                                    <div style="font-size: 1.2em;" class="mb-15"><strong>{{__("l.my_websites")}}</strong></div>
                                    <ul class="p-0 m-0" style="list-style: none;">
                                        <li><label class="kt-checkbox"><input name="my_websites_list_all" @if(in_array("my_websites_list_all", $permissions)) checked @endif type="checkbox"  class="checkboxx"> <strong>القائمة : كل المواقع</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="my_websites_list_only_mine" @if(in_array("my_websites_list_only_mine", $permissions)) checked @endif type="checkbox"  class="checkboxx"> <strong>القائمة : فقط مواقعي</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="my_websites_add" @if(in_array("my_websites_add", $permissions)) checked @endif type="checkbox"  class="checkboxx"> <strong>إنشاء موقع</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="my_websites_update" @if(in_array("my_websites_update", $permissions)) checked @endif type="checkbox"  class="checkboxx"> <strong>تعديل</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="my_websites_delete" @if(in_array("my_websites_delete", $permissions)) checked @endif type="checkbox"  class="checkboxx"> <strong>حذف</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="my_websites_choose_template" @if(in_array("my_websites_choose_template", $permissions)) checked @endif type="checkbox"  class="checkboxx"> <strong>تغيير القالب</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="my_websites_pages" @if(in_array("my_websites_pages", $permissions)) checked @endif type="checkbox"  class="checkboxx"> <strong>صفحات الموقع</strong><span></span></label></li>
                                    </ul>
                                </div>

                                <div class="col-sm-3">
                                    <div style="font-size: 1.2em;" class="mb-15"><strong>{{__("l.pages_list")}}</strong></div>
                                    <ul class="p-0 m-0" style="list-style: none;">
                                        <li><label class="kt-checkbox"><input name="pages_list_add" @if(in_array("pages_list_add", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.add")}}</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="pages_list_update" @if(in_array("pages_list_update", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.update")}}</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="pages_list_delete" @if(in_array("pages_list_delete", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.delete")}}</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="pages_list_publish_draft" @if(in_array("pages_list_publish_draft", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.publish")}} / {{__("l.save_as_draft")}}</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="pages_list_change_homepage" @if(in_array("pages_list_change_homepage", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.change_homepage")}}</strong><span></span></label></li>
                                    </ul>
                                </div>

                            </div>

                            <div class="row mt-40">

                                <div class="col-sm-3">
                                    <div style="font-size: 1.2em;" class="mb-15"><strong>{{__("l.comments")}}</strong></div>
                                    <ul class="p-0 m-0" style="list-style: none;">
                                        <li><label class="kt-checkbox"><input name="comments_list" @if(in_array("comments_list", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.the_list")}}</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="comments_publish_draft" @if(in_array("comments_publish_draft", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.publish")}} / {{__("l.save_as_draft")}}</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="comments_update" @if(in_array("comments_update", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.update")}}</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="comments_delete" @if(in_array("comments_delete", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.delete")}}</strong><span></span></label></li>
                                    </ul>
                                </div>

                                <div class="col-sm-3">
                                    <div style="font-size: 1.2em;" class="mb-15"><strong>{{__("l.templates")}}</strong></div>
                                    <ul class="p-0 m-0" style="list-style: none;">
                                        <li><label class="kt-checkbox"><input name="templates_list" @if(in_array("templates_list", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.templates")}}</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="templates_purchase_use" @if(in_array("templates_purchase_use", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.purchase")}} / {{__("l.use")}}</strong><span></span></label></li>
                                    </ul>
                                </div>

                                <div class="col-sm-3">
                                    <div style="font-size: 1.2em;" class="mb-15"><strong>{{__("l.plans")}}</strong></div>
                                    <ul class="p-0 m-0" style="list-style: none;">
                                        <li><label class="kt-checkbox"><input name="plans_list" @if(in_array("plans_list", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.templates")}}</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="plans_purchase_use" @if(in_array("plans_purchase_use", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.purchase")}} / {{__("l.use")}}</strong><span></span></label></li>
                                    </ul>
                                </div>

                                <div class="col-sm-3">
                                    <div style="font-size: 1.2em;" class="mb-15"><strong>{{__("l.plugins")}}</strong></div>
                                    <ul class="p-0 m-0" style="list-style: none;">
                                        <li><label class="kt-checkbox"><input name="plugins_list" @if(in_array("plugins_list", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.the_list")}}</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="plugins_purchase" @if(in_array("plugins_purchase", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.purchase")}}</strong><span></span></label></li>
                                        @foreach($client->my_plugins as $plugin)
                                            <li><label class="kt-checkbox"><input name="plugins_settings_{{$plugin->id}}" @if(in_array("plugins_settings_".$plugin->id, $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{$plugin->{"name_".app()->getLocale()} }}</strong><span></span></label></li>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>

                            <div class="row mt-40">

                                <div class="col-sm-3">
                                    <div style="font-size: 1.2em;" class="mb-15"><strong>{{__("l.my_subscriptions")}}</strong></div>
                                    <ul class="p-0 m-0" style="list-style: none;">
                                        <li><label class="kt-checkbox"><input name="my_subscriptions_list" @if(in_array("my_subscriptions_list", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.the_list")}}</strong><span></span></label></li>
                                    </ul>
                                </div>

                                <div class="col-sm-3">
                                    <div style="font-size: 1.2em;" class="mb-15"><strong>{{__("l.members_management")}}</strong></div>
                                    <ul class="p-0 m-0" style="list-style: none;">
                                        <li><label class="kt-checkbox"><input name="members_management_list" @if(in_array("members_management_list", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.the_list")}}</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="members_management_add" @if(in_array("members_management_add", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.add")}}</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="members_management_update" @if(in_array("members_management_update", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.update")}}</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="members_management_delete" @if(in_array("members_management_delete", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.delete")}}</strong><span></span></label></li>
                                    </ul>
                                </div>

                                <div class="col-sm-3">
                                    <div style="font-size: 1.2em;" class="mb-15"><strong>{{__("l.visitor_messages")}}</strong></div>
                                    <ul class="p-0 m-0" style="list-style: none;">
                                        <li><label class="kt-checkbox"><input name="visitor_messages_list" @if(in_array("visitor_messages_list", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.the_list")}}</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="visitor_messages_preview" @if(in_array("visitor_messages_preview", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.preview")}}</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="visitor_messages_delete" @if(in_array("visitor_messages_delete", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.delete")}}</strong><span></span></label></li>
                                    </ul>
                                </div>

                                <div class="col-sm-3">
                                    <div style="font-size: 1.2em;" class="mb-15"><strong>{{__("l.newsletter_list")}}</strong></div>
                                    <ul class="p-0 m-0" style="list-style: none;">
                                        <li><label class="kt-checkbox"><input name="newsletter_list_list" @if(in_array("newsletter_list_list", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.the_list")}}</strong><span></span></label></li>
                                    </ul>
                                </div>

                            </div>

                            <div class="row mt-40">

                                <div class="col-sm-3">
                                    <div style="font-size: 1.2em;" class="mb-15"><strong>{{__("l.statistics")}}</strong></div>
                                    <ul class="p-0 m-0" style="list-style: none;">
                                        <li><label class="kt-checkbox"><input name="statistics_preview" @if(in_array("statistics_preview", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.preview")}}</strong><span></span></label></li>
                                    </ul>
                                </div>

                                <div class="col-sm-3">
                                    <div style="font-size: 1.2em;" class="mb-15"><strong>{{__("l.settings")}}</strong></div>
                                    <ul class="p-0 m-0" style="list-style: none;">
                                        <li><label class="kt-checkbox"><input name="settings_general" @if(in_array("settings_general", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.general_settings")}}</strong><span></span></label></li>
                                        <li><label class="kt-checkbox"><input name="settings_permissions" @if(in_array("settings_permissions", $permissions)) checked @endif type="checkbox" class="checkboxx"> <strong>{{__("l.permissions")}}</strong><span></span></label></li>
                                    </ul>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-12 text-center mt-80">
                                    <div class="form-group">
                                        <button type="submit" class="btn general-btn-sm-blue rounded"><i class="fa fa-save"></i> <span>{{__("l.save")}}</span></button>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                @endforeach
            </div>

        </div>

    </div>

@endsection

@section("scripts")

    <style>
        .tab-pane.container strong{
            font-size: 1.1em;
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
