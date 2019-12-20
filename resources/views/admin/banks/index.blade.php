@extends("admin.parts.app")

@section("content")

    <div class="container pb-5 pt-1">

        <h3 class="mb-2 float-right" style="color: #543c93; line-height: 40px;">قائمة البنوك (حساباتنا البنكية المحول إليها)</h3>
        @if(permissions("banks_add"))
            <a href="{{route("admin.banks.create")}}" class="btn general-btn-sm-blue float-left"><i class="fa fa-plus"></i> <span>إضافة بنك</span></a>
        @endif
        <div class="clearfix mb-3"></div>

        <table class="table table-ticket">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th width="30" class="text-center">#</th>
                    <th>إسم البنك</th>
                    <th>رقم الحساب</th>
                    <th>الآيبان</th>
                    <th width="100">الأوامر</th>
                </tr>
            </thead>
            <tbody>
            @foreach($banks as $bank)
                <tr class="ticketlistproperties">
                    <td width="30" class="text-center"><strong>{{$loop->iteration}}</strong></td>
                    <td>{{$bank->name}}</td>
                    <td>{{$bank->account_number}}</td>
                    <td>{{$bank->iban}}</td>
                    <td width="100" class="text-center">
                        <div class="action">
                            @if(permissions("banks_edit"))
                                <a href="{{route("admin.banks.edit", $bank->id)}}" title="تعديل">
                                    <img src="{{asset("public/dashboard/images/settings.png")}}" alt="">
                                </a>
                            @endif
                            @if(permissions("banks_remove"))
                                <a href="#" class="btn-delete-bank" data-id="{{$bank->id}}" title="حذف">
                                    <img src="{{asset("public/dashboard/images/cpanel/delete.png")}}" alt="">
                                </a>
                                <form id="delete_bank{{$bank->id}}" action="{{route("admin.banks.destroy", $bank->id)}}" method="post">
                                    @csrf
                                    {{method_field("delete")}}
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="clearfix mt-5"></div>

        <h3 class="mb-2 float-right" style="color: #543c93; line-height: 40px;">قائمة البنوك (بنوك العملاء المحول منها)</h3>
        @if(permissions("banks_add"))
            <a href="{{route("admin.banks.banks2.create")}}" class="btn general-btn-sm-blue float-left"><i class="fa fa-plus"></i> <span>إضافة بنك</span></a>
        @endif
        <div class="clearfix mb-3"></div>

        <table class="table table-ticket">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th class="text-center" width="30">#</th>
                    <th> (عربي)إسم البنك</th>
                    <th> (إنجليزي)إسم البنك</th>
                    <th width="100">الأوامر</th>
                </tr>
            </thead>
            <tbody>
            @foreach($banks2 as $bank)
                <tr class="ticketlistproperties">
                    <td width="30" class="text-center"><strong>{{$loop->iteration}}</strong></td>
                    <td>{{$bank->name_ar}}</td>
                    <td>{{$bank->name_en}}</td>
                    <td width="100" class="text-center">
                        <div class="action">
                            @if(permissions("banks_edit"))
                                <a href="{{route("admin.banks.banks2.edit", $bank->id)}}" title="تعديل">
                                    <img src="{{asset("public/dashboard/images/settings.png")}}" alt="">
                                </a>
                            @endif
                            @if(permissions("banks_remove"))
                                <a href="#" class="btn-delete-bank2" data-id="{{$bank->id}}" title="حذف">
                                    <img src="{{asset("public/dashboard/images/cpanel/delete.png")}}" alt="">
                                </a>
                                <form id="delete_bank2{{$bank->id}}" action="{{route("admin.banks.banks2.destroy", $bank->id)}}" method="post">
                                    @csrf
                                    {{method_field("delete")}}
                                </form>
                            @endif
                        </div>
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

            $(document).on("click", ".btn-delete-bank", function (e) {
                e.preventDefault();
                var id = $(this).data("id");
                if(confirm('هل أنت متأكد ؟'))
                    $("#delete_bank"+id).trigger("submit");
            });

            $(document).on("click", ".btn-delete-bank2", function (e) {
                e.preventDefault();
                var id = $(this).data("id");
                if(confirm('هل أنت متأكد ؟'))
                    $("#delete_bank2"+id).trigger("submit");
            });

        });

    </script>

@endsection
