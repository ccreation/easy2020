<ul class="nav nav-tabs">
    @foreach($roles as $role)
        @if($role->id != 1)
            <li class="nav-item">
                <a class="nav-link @if($loop->iteration == 1) active @endif" data-toggle="tab" href="#role{{$role->id}}">{{$role->name}}</a>
            </li>
        @endif
    @endforeach
</ul>

<div class="tab-content">
    @foreach($roles as $role)
        <div class="tab-pane container @if($loop->iteration == 1) active @endif" id="role{{$role->id}}">
            <h2 class="text-center mb-5 mt-0" style="color: #512293">{{$role->name}}</h2>
            @if($role->id != 1)
                <?php $permissions = unserialize($role->permissions); $permissions = (is_array($permissions)) ? $permissions : []; ?>
                <form action="{{route("admin.settings.save_permissions")}}" method="post" class="permissions_form">
                    @csrf
                    <input type="hidden" name="role_id" value="{{$role->id}}">

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <input class="all_permissions" type="checkbox" > <strong>{{__("l.all_permissions")}}</strong>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-3">
                            <h4 class="text-dark mb-10">الإحصائيات</h4>
                            <label><input class="checkboxx" type="checkbox" name="statistics" value="1" @if(in_array("statistics", $permissions)) checked @endif> <span>صفحة الإحصائيات</span></label>
                        </div>

                        <div class="col-sm-3">
                            <h4 class="text-dark mb-10">قسم المستخدمين</h4>
                            <label><input class="checkboxx" type="checkbox" name="users" value="1" @if(in_array("users", $permissions)) checked @endif> <span>صفحة المستخدمين</span></label>
                            <label><input class="checkboxx" type="checkbox" name="add_user" value="1" @if(in_array("add_user", $permissions)) checked @endif> <span>إضافة مستخدم</span></label>
                            <label><input class="checkboxx" type="checkbox" name="update_user" value="1" @if(in_array("update_user", $permissions)) checked @endif> <span>تعديل مستخدم</span></label>
                            <label><input class="checkboxx" type="checkbox" name="remove_user" value="1" @if(in_array("remove_user", $permissions)) checked @endif> <span>حذف مستخدم</span></label>
                        </div>

                        <div class="col-sm-3">
                            <h4 class="text-dark mb-10">قسم العملاء</h4>
                            <label><input class="checkboxx" type="checkbox" name="clients" value="1" @if(in_array("clients", $permissions)) checked @endif> <span>صفحة العملاء</span></label>
                            <label><input class="checkboxx" type="checkbox" name="add_client" value="1" @if(in_array("add_client", $permissions)) checked @endif> <span>إضافة عميل</span></label>
                            <label><input class="checkboxx" type="checkbox" name="update_client" value="1" @if(in_array("update_client", $permissions)) checked @endif> <span>تعديل عميل</span></label>
                            <label><input class="checkboxx" type="checkbox" name="remove_client" value="1" @if(in_array("remove_client", $permissions)) checked @endif> <span>حذف عميل</span></label>
                            <label><input class="checkboxx" type="checkbox" name="show_client" value="1" @if(in_array("show_client", $permissions)) checked @endif> <span>تفاصيل عميل</span></label>
                        </div>

                        <div class="col-sm-3">
                            <h4 class="text-dark mb-10">إدارة القوالب</h4>
                            <label><input class="checkboxx" type="checkbox" name="templates_index" value="1" @if(in_array("templates_index", $permissions)) checked @endif> <span>صفحة القوالب</span></label>
                            <label><input class="checkboxx" type="checkbox" name="templates_cat_add" value="1" @if(in_array("templates_cat_add", $permissions)) checked @endif> <span>إضافة تصنيف</span></label>
                            <label><input class="checkboxx" type="checkbox" name="templates_cat_edit" value="1" @if(in_array("templates_cat_edit", $permissions)) checked @endif> <span>تعديل تصنيف</span></label>
                            <label><input class="checkboxx" type="checkbox" name="templates_cat_remove" value="1" @if(in_array("templates_cat_remove", $permissions)) checked @endif> <span>حذف تصنيف</span></label>
                            <label><input class="checkboxx" type="checkbox" name="templates_add" value="1" @if(in_array("templates_add", $permissions)) checked @endif> <span>إنشاء قالب</span></label>
                            <label><input class="checkboxx" type="checkbox" name="templates_edit" value="1" @if(in_array("templates_edit", $permissions)) checked @endif> <span>تعديل قالب</span></label>
                            <label><input class="checkboxx" type="checkbox" name="templates_remove" value="1" @if(in_array("templates_remove", $permissions)) checked @endif> <span>حذف قالب</span></label>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-3">
                            <h4 class="text-dark mb-10">قائمة المواقع</h4>
                            <label><input class="checkboxx" type="checkbox" name="websites_index" value="1" @if(in_array("websites_index", $permissions)) checked @endif> <span>صفحة قائمة المواقع</span></label>
                            <label><input class="checkboxx" type="checkbox" name="websites_block" value="1" @if(in_array("websites_block", $permissions)) checked @endif> <span>حظر/رفع حظر تصنيف</span></label>
                        </div>

                        <div class="col-sm-3">
                            <h4 class="text-dark mb-10">إدارة البلوكات</h4>
                            <label><input class="checkboxx" type="checkbox" name="blocks" value="1" @if(in_array("blocks", $permissions)) checked @endif> <span>إدارة البلوكات</span></label>
                        </div>

                        <div class="col-sm-3">
                            <h4 class="text-dark mb-10">قسم الشروحات</h4>
                            <label><input class="checkboxx" type="checkbox" name="documentations_index" value="1" @if(in_array("documentations_index", $permissions)) checked @endif> <span>صفحة الشروحات</span></label>
                            <label><input class="checkboxx" type="checkbox" name="documentations_cat_add" value="1" @if(in_array("documentations_cat_add", $permissions)) checked @endif> <span>إضافة قسم</span></label>
                            <label><input class="checkboxx" type="checkbox" name="documentations_cat_edit" value="1" @if(in_array("documentations_cat_edit", $permissions)) checked @endif> <span>تعديل قسم</span></label>
                            <label><input class="checkboxx" type="checkbox" name="documentations_cat_remove" value="1" @if(in_array("documentations_cat_remove", $permissions)) checked @endif> <span>حذف قسم</span></label>
                            <label><input class="checkboxx" type="checkbox" name="documentations_add" value="1" @if(in_array("documentations_add", $permissions)) checked @endif> <span>إضافة تصنيف</span></label>
                            <label><input class="checkboxx" type="checkbox" name="documentations_edit" value="1" @if(in_array("documentations_edit", $permissions)) checked @endif> <span>تعديل تصنيف</span></label>
                            <label><input class="checkboxx" type="checkbox" name="documentations_remove" value="1" @if(in_array("documentations_remove", $permissions)) checked @endif> <span>حذف تصنيف</span></label>
                        </div>

                        <div class="col-sm-3">
                            <h4 class="text-dark mb-10">قائمة الباقات</h4>
                            <label><input class="checkboxx" type="checkbox" name="plans_index" value="1" @if(in_array("plans_index", $permissions)) checked @endif> <span>صفحة قائمة الباقات</span></label>
                            <label><input class="checkboxx" type="checkbox" name="plans_add" value="1" @if(in_array("plans_add", $permissions)) checked @endif> <span>إضافة باقة</span></label>
                            <label><input class="checkboxx" type="checkbox" name="plans_edit" value="1" @if(in_array("plans_edit", $permissions)) checked @endif> <span>تعديل باقة</span></label>
                            <label><input class="checkboxx" type="checkbox" name="plans_remove" value="1" @if(in_array("plans_remove", $permissions)) checked @endif> <span>حذف باقة</span></label>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-3">
                            <h4 class="text-dark mb-10">الكوبونات</h4>
                            <label><input class="checkboxx" type="checkbox" name="promocodes_index" value="1" @if(in_array("promocodes_index", $permissions)) checked @endif> <span>صفحة الكوبونات</span></label>
                            <label><input class="checkboxx" type="checkbox" name="promocodes_add" value="1" @if(in_array("promocodes_add", $permissions)) checked @endif> <span>إضافة كوبون</span></label>
                            <label><input class="checkboxx" type="checkbox" name="promocodes_edit" value="1" @if(in_array("promocodes_edit", $permissions)) checked @endif> <span>تعديل كوبون</span></label>
                            <label><input class="checkboxx" type="checkbox" name="promocodes_remove" value="1" @if(in_array("promocodes_remove", $permissions)) checked @endif> <span>حذف كوبون</span></label>
                        </div>

                        <div class="col-sm-3">
                            <h4 class="text-dark mb-10">قائمة البنوك</h4>
                            <label><input class="checkboxx" type="checkbox" name="banks_index" value="1" @if(in_array("banks_index", $permissions)) checked @endif> <span>صفحة قائمة البنوك</span></label>
                            <label><input class="checkboxx" type="checkbox" name="banks_add" value="1" @if(in_array("banks_add", $permissions)) checked @endif> <span>إضافة بنك</span></label>
                            <label><input class="checkboxx" type="checkbox" name="banks_edit" value="1" @if(in_array("banks_edit", $permissions)) checked @endif> <span>تعديل بنك</span></label>
                            <label><input class="checkboxx" type="checkbox" name="banks_remove" value="1" @if(in_array("banks_remove", $permissions)) checked @endif> <span>حذف بنك</span></label>
                        </div>

                        <div class="col-sm-3">
                            <h4 class="text-dark mb-10">قائمة الدفعات</h4>
                            <label><input class="checkboxx" type="checkbox" name="payments_index" value="1" @if(in_array("payments_index", $permissions)) checked @endif> <span>صفحة قائمة الدفعات</span></label>
                            <label><input class="checkboxx" type="checkbox" name="payments_accept_reject" value="1" @if(in_array("payments_accept_reject", $permissions)) checked @endif> <span>موافقة/رفض</span></label>
                            <label><input class="checkboxx" type="checkbox" name="payments_details" value="1" @if(in_array("payments_details", $permissions)) checked @endif> <span>تفاصيل دفعة</span></label>
                        </div>

                        <div class="col-sm-3">
                            <h4 class="text-dark mb-10">نظام التذاكر</h4>
                            <label><input class="checkboxx" type="checkbox" name="tickets_index" value="1" @if(in_array("tickets_index", $permissions)) checked @endif> <span>صفحة قائمة التذاكر</span></label>
                            <label><input class="checkboxx" type="checkbox" name="tickets_open_close" value="1" @if(in_array("tickets_open_close", $permissions)) checked @endif> <span>فتح/إغلاق</span></label>
                            <label><input class="checkboxx" type="checkbox" name="tickets_add" value="1" @if(in_array("tickets_add", $permissions)) checked @endif> <span>إنشاء تذكرة</span></label>
                            <label><input class="checkboxx" type="checkbox" name="tickets_show" value="1" @if(in_array("tickets_show", $permissions)) checked @endif> <span>مشاهدة تذكرة</span></label>
                            <label><input class="checkboxx" type="checkbox" name="tickets_edit" value="1" @if(in_array("tickets_edit", $permissions)) checked @endif> <span>تعديل تذكرة</span></label>
                            <label><input class="checkboxx" type="checkbox" name="tickets_remove" value="1" @if(in_array("tickets_remove", $permissions)) checked @endif> <span>حذف تذكرة</span></label>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-3">
                            <h4 class="text-dark mb-10">إعدادات الدفع</h4>
                            <label><input class="checkboxx" type="checkbox" name="payment_settings" value="1" @if(in_array("payment_settings", $permissions)) checked @endif> <span>صفحة إعدادات الدفع</span></label>
                        </div>

                        <div class="col-sm-3">
                            <h4 class="text-dark mb-10">الإعدادات العامة</h4>
                            <label><input class="checkboxx" type="checkbox" name="settings" value="1" @if(in_array("settings", $permissions)) checked @endif> <span>صفحة الإعدادات</span></label>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-12 text-center mt-5">
                            <div class="form-group">
                                <button type="submit" class="btn general-btn-sm-blue rounded"><i class="fa fa-save"></i> <span>{{__("l.save")}}</span></button>
                            </div>
                        </div>

                    </div>

                </form>
            @endif
        </div>
    @endforeach
</div>

