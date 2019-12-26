@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">
        <h4 class="mb-3 float-right" style="color: #512293; line-height: 40px;"><b><i class="fab fa-wpforms"></i> <span>{{$plugin->{"name_".app()->getLocale()} }}</span></b></h4>
        <a href="#" data-target="#addApp" class="btn btn-open general-btn-sm-blue float-left"><i class="fa fa-plus"></i> <span>{{__("l.add_custom_form")}}</span></a>
        <div class="clearfix mb-3"></div>

        <div class="pb-0 mb-20 formi" id="addApp">
            <div class="col-sm-12">
                <h4 class="mt-0 mb-3" style="color: #512293;"><b>{{__("l.add_custom_form")}} :</b></h4>
                <form id="formAddApp" action="{{route("client.plugins.save_app")}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label><span>{{__("l.form_name")}} </span> <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <h5 class="mt-3">
                        <b style="color: #512293;">{{__("l.custom_fields")}} :</b>
                        <a class="btn general-btn-sm-blue p-1 pl-3 pr-3 rounded btn-add-field float-left"><i class="fa fa-plus"></i> <span>إضافة حقل</span></a>
                    </h5>
                    <div class="clearfix mt-3"></div>

                    <div class="row clearfix" id="fields"></div>

                    <div class="input-group row mt-5">
                        <div class="col-sm-12">
                            <center>
                                <button type="submit" class="btn general-btn-sm-blue"><i class="fa fa-save text-white"></i> <span>{{__("l.save")}}</span></button>
                            </center>
                        </div>
                    </div>

                </form>
            </div>

            <div class="hidden" id="field">
                <div class="col-sm-12">
                    <div class="boxx card">
                        <div class="card-header">
                            <h5 style="display: inline-block" class="title mt-0 mb-0"><b style="font-weight: bold;">{{__("l.field")}} 1</b></h5>
                            <a class="remove_me"><i class="far fa-trash-alt p-1"></i></a>
                            <a class="open_me"><i class="fas fa-chevron-down p-1"></i></a>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2"><b>{{__("l.field_name")}}</b> <span class="red">*</span></label>
                                <input type="tex" class="form-control col-sm-10" name="names[]" required>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2"><b>{{__("l.placeholder")}}</b></label>
                                <input type="tex" class="form-control col-sm-10" name="placeholders[]">
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2"><b>{{__("l.required")}}</b></label>
                                <span class="kt-switch kt-switch--icon col-sm-10">
                                        <label>
                                            <input type="checkbox" class="requireds" name="requireds[]" value="1">
                                            <span></span>
                                        </label>
                                    </span>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2"><b>{{__("l.field_type")}}</b> <span class="red">*</span></label>
                                <select class="form-control types col-sm-10" name="types[]" required>
                                    <option value="">{{__("l.choose")}}</option>
                                    <option value="text">{{__("l.text")}}</option>
                                    <option value="textarea">{{__("l.textarea")}}</option>
                                    <option value="date">{{__("l.date")}}</option>
                                    <option value="number">{{__("l.number")}}</option>
                                    <option value="select">{{__("l.select")}}</option>
                                    <option value="selectmultiple">{{__("l.selectmultiple")}}</option>
                                    <option value="attachement">{{__("l.attachement")}}</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2"><b>{{__("l.field_space")}}</b> <span class="red">*</span></label>
                                <select class="form-control col-sm-10" name="space[]" required>
                                    <option value="1">{{__("l.full_space")}}</option>
                                    <option value="2">{{__("l.half_space")}}</option>
                                    <option value="3">{{__("l.one_third_space")}}</option>
                                </select>
                            </div>
                            <div class="form-group options-div row">
                                <label class="col-sm-2"><b>الخيارات</b> <a class="btn btn-primary btn-xs btn-add-option text-white" style="width: 110px;padding-bottom: 27px;"><i class="fa fa-plus text-white"></i> <span>إضافة خيار</span></a></label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control options">
                                        </div>
                                        <div class="col-sm-3 text-center">
                                            <a class="btn btn-danger btn-delete-option text-white text-center"><i class="fa fa-trash text-white p-0"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden" id="options">
                <div class="row mt-5">
                    <div class="col-sm-9">
                        <input type="text" class="form-control options">
                    </div>
                    <div class="col-sm-3 text-center text-center">
                        <a class="btn btn-danger btn-delete-option text-white text-center"><i class="fa fa-trash text-white p-0"></i></a>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>

        <table class="table table-ticket mt-3">
            <thead>
                <tr class="ticketlistheaderrow">
                    <th class="text-center" width="30">#</th>
                    <th>إسم النموذج</th>
                    <th>الحقول</th>
                    <th>تاريخ الإنشاء</th>
                    <th>الأوامر</th>
                </tr>
            </thead>
            <tbody>
            @if(count($forms)>0)
                @foreach($forms as $form)
                    <tr class="ticketlistproperties">
                        <td class="text-center" width="30"><b>{{$loop->iteration}}</b></td>
                        <td>{{$form->name}}</td>
                        <td width="50%" class="fieldstable">
                            @foreach(@$form->fields as $field)
                                <span>{{$field->name}}</span>
                            @endforeach
                        </td>
                        <td>{{$form->created_at->format("H:i")}} {{$form->created_at->format("Y-m-d")}}</td>
                        <td class="text-center">
                            <div class="action">
                                <a class="btn btn-xs btn-success" data-toggle="tooltip" title="{{__("l.export_excel")}}" href="{{route("client.plugins.export_excel", $form->id)}}"><i class="fas fa-file-excel"></i></a>
                                <a class="btn btn-xs btn-dark" data-toggle="tooltip" title="{{__("l.messages")}}" href="{{route("client.plugins.app_data", $form->id)}}"
                                   style="width: auto;padding: 0px 3px;"><i class="fa fa-database"></i> <span style="display: inline-block;padding-left: 3px;font-weight: bold;">{{@$form->data_count}}</span></a>
                                <a class="btn btn-xs btn-warning" data-toggle="tooltip" title="{{__("l.preview")}}" href="{{route("client.plugins.show_app_field", $form->id)}}"><i class="fa fa-eye text-white"></i></a>
                                <a class="btn btn-xs btn-primary" data-toggle="tooltip" title="{{__("l.edit")}}" href="{{route("client.plugins.edit_app", $form->id)}}"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-xs btn-danger" data-toggle="tooltip" title="{{__("l.delete")}}" href="{{route("client.plugins.remove_app", $form->id)}}" onclick="return confirm('{{__("l.are_you_sure")}}')"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="ticketlistproperties">
                    <td colspan="5" class="text-center"><b>{{__("l.no_data")}}</b></td>
                </tr>
            @endif
            </tbody>
        </table>

    </div>

@endsection

@section("scripts")

    <style>
        .boxx.card{
            border-color: #7d58ae !important;
        }
        .boxx.card .card-header{
            position: relative;
            background-color: #E4D8F0 !important;
        }
        .boxx.card .card-body{
            display: none;
        }
        #fields{
            margin-top: 25px !important;
        }
        #fields .form-group{
            margin-bottom: 15px;
        }
        .hidden {
            display: none!important;
        }
        #fields .boxx{
            margin-bottom: 15px;
        }
        .input-group.row, .input-group{
            width: 100%;
            margin-bottom: 15px;
        }
        .remove_me{
            color: red !important;
            position: absolute;
            top: 10px;
            left: 10px;
            cursor: pointer;
            width: 20px;
            height: 20px;
            text-align: center;
        }
        .open_me{
            position: absolute;
            top: 10px;
            left: 35px;
            cursor: pointer;
            width: 20px;
            height: 20px;
            text-align: center;
            font-size: 1.2em;
        }
        .open_me.opened .fas{
            transform: rotate(90deg);
        }
        .options-div{
            display: none;
        }
    </style>

    <script>
        $(function () {

            function fixn_names(){
                $.each($("#fields .boxx"), function (i,e) {
                    $(".title", e).html("{{__("l.field")}} "+(i+1));
                    $(".options", e).attr("name", "option"+i+"[]");
                    $(".requireds", e).attr("name", "requireds["+i+"]");
                })
            }

            $(document).on("click", ".btn-add-field", function (e) {
                e.preventDefault();
                $("#fields").append($("#field").html());
                fixn_names();
            });

            $(document).on("click", ".remove_me", function (e) {
                e.preventDefault();
                $(this).closest(".boxx").remove();
                fixn_names();
            });

            $(document).on("click", ".open_me", function (e) {
                e.preventDefault();
                var x = $(this).closest(".boxx");
                $(".boxx").not($(x)).find(".card-body").hide("fast");
                $(".boxx").not($(x)).find(".card-header").find(".open_me").removeClass("opened");
                x.find(".card-body").slideToggle();
                if($(this).hasClass("opened"))
                    $(this).removeClass("opened");
                else
                    $(this).addClass("opened");
            });

            $(document).on("click", ".btn-add-option", function (e) {
                e.preventDefault();
                var div = $(this).closest(".options-div");
                $(div).append($("#options").html());
                fixn_names();
            });

            $(document).on("click", ".btn-delete-option", function (e) {
                e.preventDefault();
                var div = $(this).closest(".row");
                $(div).remove();
                fixn_names();
            });

            $(document).on("change", ".types", function (e) {
                var val = $(this).val();
                if(val=="select" || val=="selectmultiple"){
                    $(this).closest(".boxx").find(".options-div").slideDown();
                }else{
                    $(this).closest(".boxx").find(".options-div").slideUp();
                }
            });

            $(document).on("submit", "#formAddApp", function (e) {
                var num = $("#fields .boxx").length;
                if(num<=0){
                    alert("{{__("l.add_form_note")}}");
                    return false;
                }
            });

        });
    </script>

@endsection
