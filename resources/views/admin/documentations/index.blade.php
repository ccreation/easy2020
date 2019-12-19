@extends("admin.parts.app")

@section("content")

    <div class="container mt-3" style="min-height: 1000px; padding-bottom: 100px;">

        <h3 style="color: #543c93; line-height: 40px;" class="float-right">أصناف الشروحات :</h3>

        @if(permissions("documentations_cat_add"))
            <a href="#" data-target="#add_documentation_category" class="btn general-btn-sm-blue btn-open float-left"><i class="fa fa-plus"></i> <span>إضافة قسم جديد</span></a>
            <div class="clearfix mb-2"></div>
            <form class="formi" action="{{route("admin.documentations.save_category")}}" id="add_documentation_category" method="post">
                @csrf

                <div class="form-group">
                    <label><span>الإسم</span> <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" required name="name">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn general-btn-sm-blue"><i class="fa fa-save"></i> <span>حفظ</span></button>
                </div>

            </form>
        @endif

        <div class="clearfix mb-4"></div>

        <table class="table table-ticket mb-5">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th width="50" class="text-center">#</th>
                    <th>الإسم</th>
                    <th width="200">الأوامر</th>
                </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr class="ticketlistproperties">
                    <td class="text-center"><strong>{{$loop->iteration}}</strong></td>
                    <td>{{$category->name}}</td>
                    <td class="text-center">
                        <div class="action">
                            @if(permissions("documentations_cat_edit"))
                                <a href="#" class="btn-open" data-target="#edit_documentation_category{{$category->id}}" title="تعديل">
                                    <img src="{{asset("public/dashboard/images/settings.png")}}" alt="">
                                </a>
                            @endif
                            @if(permissions("documentations_cat_remove"))
                                <a href="{{route("admin.documentations.delete_category", $category->id)}}" onclick="return confirm('هل أنت متأكد ؟')" title="حذف">
                                    <img src="{{asset("public/dashboard/images/cpanel/delete.png")}}" alt="">
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @if(permissions("documentations_cat_edit"))
                    <tr>
                        <td class="p-0" colspan="3" style="border: none;">
                            <form class="formi" action="{{route("admin.documentations.update_category")}}" id="edit_documentation_category{{$category->id}}" method="post">
                                @csrf

                                <input type="hidden" name="id" value="{{$category->id}}">

                                <div class="form-group">
                                    <label><span>الإسم</span> <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required name="name" value="{{$category->name}}">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn general-btn-sm-blue"><i class="fa fa-save"></i> <span>تعديل</span></button>
                                </div>

                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
    </table>

        <h3 style="color: #543c93; line-height: 40px;" class="float-right">قائمة الشروحات :</h3>

        @if(permissions("documentations_add"))
            <a href="{{route("admin.documentations.create")}}" class="btn general-btn-sm-blue float-left"><i class="fa fa-plus"></i> <span>إضافة شرح جديد</span></a>
        @endif

        <div class="clearfix mb-4"></div>

        <div id="doc-actions-wrapper">
            <div id="doc-actions-div">

                @foreach($documentations as $documentation)

                    <div class="card-group mb-3" data-id="{{$documentation->id}}">
                        <div class="card card-default" style="border-radius: 10px;">
                            <div class="card-header table-ticket" style="background-color: #E4D8F0; border: 1px solid #512293; border-radius: 10px;">
                                <strong class="text-dark" style="cursor: pointer; line-height: 35px;" data-toggle="collapse" href="#collapse{{$documentation->id}}">{{$documentation->question}}</strong>
                                <div class="action float-left">
                                    @if(permissions("documentations_edit"))
                                        <a href="{{route("admin.documentations.edit", $documentation->id)}}" class="float-left" title="تعديل">
                                            <img src="{{asset("public/dashboard/images/settings.png")}}" alt="">
                                        </a>
                                    @endif
                                    @if(permissions("documentations_remove"))
                                        <a href="{{route("admin.documentations.destroy", $documentation->id)}}" onclick="return confirm('هل أنت متأكد ؟')" class="float-left" title="حذف">
                                            <img src="{{asset("public/dashboard/images/cpanel/delete.png")}}" alt="">
                                        </a>
                                    @endif
                                    @if(permissions("documentations_edit"))
                                        <a href="javascript:void(0)" class="float-left doc-arrows-alt" title="إعادة ترتيب" style="cursor: move !important;"><i class="fa fa-arrows-alt-v" style="color: #dfdfdf;"></i></a>
                                    @endif
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="collapse{{$documentation->id}}" class="panel-collapse collapse">
                                <div class="card-body">
                                    <div style="display: flex" class="mb-3">
                                        <div style="flex: 1"><span>القسم : </span><span>{{@$documentation->category->name}}</span></div>
                                        @if($documentation->plans)
                                            <div style="flex: 2">
                                                <span>الباقات : </span>
                                                <?php $planss = ($documentation->plans) ? explode(";", $documentation->plans) : []; ?>
                                                @foreach($plans as $plan)
                                                    @if(in_array($plan->id, $planss))
                                                        <span style="color: {{$plan->color}}">{{$plan->name_ar}}</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div style="color: inherit; min-height: 300px; width: 100%; padding: 15px; border: 1px solid #eee;">{!! $documentation->answer !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>

    </div>

@endsection

@section("scripts")

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>

        async function sortingblocks() {
            var arr=[];
            $( "#doc-actions-div" ).sortable({
                axis: "y",
                handle: '.doc-arrows-alt',
                placeholder: "ui-state-highlight",
                stop: function( event, ui ) {
                    $.each($("#doc-actions-wrapper .card-group "), function (i, e) {
                        var id      = $(e).data("id");
                        var order   = i+1;
                        var url = '{{route("admin.documentations.order")}}/'+id+'/'+order;
                        console.log(url);
                        $.get(url, function () {});
                    });
                    setTimeout(function () {
                        $("#doc-actions-wrapper").load(window.location + " #doc-actions-div", function () {
                            sortingblocks();
                        });
                    }, 200);
                }
            });
            $( "#block-actions-div" ).disableSelection();
        }

        sortingblocks();

    </script>

    <style>
        .ui-state-highlight{
            height: 47px;
            margin-bottom: 15px;
        }
        .ui-sortable-helper{
            transition: opacity 0.3s ease-in;
            transform: rotate(-2deg);
            opacity: 0.8;
            border-radius : 8px !important;
        }
    </style>

@endsection
