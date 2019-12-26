@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">
        <h4 class="mb-3 float-right" style="color: #512293; line-height: 40px;"><b><i class="fab fa-wpforms"></i> <span>{{__("l.edit")}} {{$form->name}}</span></b></h4>
        <div class="clearfix mb-3"></div>

        <div class="pb-0 mb-5 formi row" id="addApp" style="display: block;">

            <div class="col-sm-12">
                <form id="formAddApp" action="{{route("client.plugins.update_app")}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$form->id}}">

                    <div class="form-group">
                        <label><span>{{__("l.form_name")}} </span> <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{$form->name}}" class="form-control" required>
                    </div>

                    <div class="mt-3">
                        <div class="col-sm-3 pr-0">
                            <a href="#" data-target="#advanced_settings" class="btn-openx btn general-btn-sm-blue p-1 pl-3 pr-3 rounded"><i class="fa fa-cogs"></i> {{__("l.advanced_settings")}}</a>
                        </div>
                        <div class="col-sm-12 pr-0 pt-4">
                            <div class="formi" id="advanced_settings">

                                <div class="form-group row">
                                    <label class="col-sm-3"><b>{{__("l.field_form")}}</b> <span class="red">*</span></label>
                                    <select class="form-control col-sm-9" name="form" required>
                                        <option value="1" @if($form->form == 1) selected @endif>{{__("l.sharp_edges")}}</option>
                                        <option value="2" @if($form->form == 2) selected @endif>{{__("l.polished_edges")}}</option>
                                        <option value="3" @if($form->form == 3) selected @endif>{{__("l.rounded_edges")}}</option>
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3"><b>{{__("l.enable_placeholder")}}</b> <span class="red">*</span></label>
                                    <select class="form-control col-sm-9" name="placeholder" required>
                                        <option value="1" @if($form->placeholder == 1) selected @endif>{{__("l.yes")}}</option>
                                        <option value="0" @if($form->placeholder == 0) selected @endif>{{__("l.no")}}</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row mt-20">
                        <div class="col-sm-8"></div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn general-btn-sm-blue btn-block"><i class="fa fa-save text-white"></i> <span>{{__("l.save")}}</span></button>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{route("client.plugins.show_app_field", $form->id)}}" class="btn general-btn-sm-blue btn-block" target="_blank"><i class="fa fa-eye text-white"></i> <span>{{__("l.previeww")}}</span></a>
                        </div>
                    </div>

                </form>

                <h5 class="mt-3">
                    <b style="color: #512293;">{{__("l.custom_fields")}} :</b>
                    <a class="btn general-btn-sm-blue p-1 pl-3 pr-3 rounded btn-add-field float-left"><i class="fa fa-plus"></i> <span>إضافة حقل</span></a>
                </h5>
                <div class="clearfix mt-3"></div>

                <div id="fields_wrapper">
                    <div class="row" id="fields">
                        @foreach($form->fields as $f)
                            <?php $i=$loop->iteration; ?>
                            <div data-id="{{$f->id}}" class="block-box col-sm-{{($f->space == "1") ? "12" : (($f->space == "2") ? "6" : "4" ) }}">
                                <div class="boxx card">
                                    <div class="card-header">
                                        <a href="javascript:void(0)" class="dib dibx dib-arrows-alt ml-10" ><i class="fas fa-arrows-alt"></i></a>
                                        <h5 style="display: inline-block" class="title mt-0 mb-0">{{$f->name}}</h5>
                                        <a class="remove_me remove_me_ajax"><i class="far fa-trash-alt p-1"></i></a>
                                        <a class="dupliacte_me dupliacte_me_ajax"><i class="far fa-copy p-1"></i></a>
                                        <a class="open_me"><i class="fas fa-chevron-down p-1"></i></a>
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" class="id" name="id" value="{{$form->id}}">
                                        <input type="hidden" class="field_id" name="field_id" value="{{$f->id}}">
                                        <div class="form-group row">
                                            <label class="col-sm-2"><b>{{__("l.field_name")}}</b> <span class="red">*</span></label>
                                            <input type="text" class="form-control name col-sm-10" value="{{$f->name}}" name="names[]" required>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2"><b>{{__("l.placeholder")}}</b></label>
                                            <input type="tex" class="form-control placeholder col-sm-10" value="{{$f->placeholder}}" name="placeholders[]">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2"><b>{{__("l.required")}}</b></label>
                                            <span class="kt-switch kt-switch--icon col-sm-10">
                                                    <label>
                                                        <input type="checkbox" class="requireds" name="requireds[]" value="1" @if($f->required==1) checked @endif>
                                                        <span></span>
                                                    </label>
                                                </span>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2"><b>{{__("l.field_type")}}</b> <span class="red">*</span></label>
                                            <select class="form-control types col-sm-10" name="types[]" required>
                                                <option value="">{{__("l.choose")}}</option>
                                                <option value="text" @if($f->type=="text") selected @endif>{{__("l.text")}}</option>
                                                <option value="textarea" @if($f->type=="textarea") selected @endif>{{__("l.textarea")}}</option>
                                                <option value="date" @if($f->type=="date") selected @endif>{{__("l.date")}}</option>
                                                <option value="number" @if($f->type=="number") selected @endif>{{__("l.number")}}</option>
                                                <option value="select" @if($f->type=="select") selected @endif>{{__("l.select")}}</option>
                                                <option value="selectmultiple" @if($f->type=="selectmultiple") selected @endif>{{__("l.selectmultiple")}}</option>
                                                <option value="attachement" @if($f->type=="attachement") selected @endif>{{__("l.attachement")}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2"><b>{{__("l.field_space")}}</b> <span class="red">*</span></label>
                                            <select class="form-control col-sm-10 space" name="space[]" required>
                                                <option value="1" @if($f->space=="1") selected @endif>{{__("l.full_space")}}</option>
                                                <option value="2" @if($f->space=="2") selected @endif>{{__("l.half_space")}}</option>
                                                <option value="3" @if($f->space=="3") selected @endif>{{__("l.one_third_space")}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group options-div row" @if($f->type=="select" or $f->type=="selectmultiple") style="display: block" @endif>
                                            <label class="col-sm-2"><b>الخيارات</b> <a class="btn btn-primary btn-xs btn-add-option text-white" style="width: 110px;padding-bottom: 27px;"><i class="fa fa-plus text-white"></i> <span>إضافة خيار</span></a></label>
                                            <div class="col-sm-10">
                                                <?php $options = explode(";", $f->options); ?>
                                                @foreach($options as $o)
                                                    <div class="row">
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control options" name="option{{$i}}[]" value="{{$o}}">
                                                        </div>
                                                        <div class="col-sm-3 text-center">
                                                            <a class="btn btn-danger btn-delete-option text-white text-center"><i class="fa fa-trash text-white p-0"></i></a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <button type="button" class="btn btn-block general-btn-sm-blue btn-save"><i class="fa fa-save"></i> <span>{{__("l.save")}}</span></button>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <a style="cursor: pointer; background-color: red" class="btn btn-block general-btn-sm-blue btn-delete"><i class="fa fa-trash text-white"></i> <span class="text-white">{{__("l.delete")}}</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

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
                            <input type="hidden" class="id" name="id" value="{{$form->id}}">
                            <div class="form-group row">
                                <label class="col-sm-2"><b>{{__("l.field_name")}}</b> <span class="red">*</span></label>
                                <input type="tex" class="form-control name col-sm-10" name="names[]" required>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2"><b>{{__("l.placeholder")}}</b></label>
                                <input type="tex" class="form-control placeholder col-sm-10" name="placeholders[]">
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
                                <select class="form-control col-sm-10 space" name="space[]" required>
                                    <option value="1">{{__("l.full_space")}}</option>
                                    <option value="2">{{__("l.half_space")}}</option>
                                    <option value="3">{{__("l.one_third_space")}}</option>
                                </select>
                            </div>
                            <div class="form-group options-div row">
                                <label class="col-sm-2"><b>الخيارات</b> <a class="btn btn-primary btn-xs btn-add-option text-white" style="width: 110px;padding-bottom: 27px;"><i class="fa fa-plus text-white"></i> <span>إضافة خيار</span></a></label>
                                <div class="row col-sm-10">
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control options">
                                    </div>
                                    <div class="col-sm-3 text-center">
                                        <a class="btn btn-danger btn-delete-option text-white text-center"><i class="fa fa-trash text-white p-0"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn general-btn-sm-blue btn-save"><i class="fa fa-save"></i> <span>{{__("l.save")}}</span></button>
                                        </div>
                                        <div class="col-sm-6">

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
        .dupliacte_me{
            color: green !important;
            position: absolute;
            top: 10px;
            left: 32px;
            cursor: pointer;
            width: 20px;
            height: 20px;
            text-align: center;
            font-size: 1.1em;
        }
        .open_me{
            position: absolute;
            top: 10px;
            left: 55px;
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
        .dib-arrows-alt {
            cursor: move !important;
        }
        .sortableListsCurrent{
            border: 1px solid #acacac;
            background-color: #eee;
            width: 100%;
            padding: 10px 5px;
        }
        .block-box.ui-sortable-helper{
            transition: opacity 0.3s ease-in;
            transform: rotate(-5deg);
            opacity: 0.5;
            border-radius : 8px !important;
        }
        .reordable.ui-sortable-placeholder{
            height: 150px;
            background: yellow;
        }
        .ui-state-highlight{
            height: 40px;
            width: 33.33%;
        }
        .formi{
            border: none;
            padding: 0px;
        }
    </style>

    <!-- jquery-sortable -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>

        $(function () {

            $(document).on("click", ".btn-openx", function (e) {
                e.preventDefault();
                var id = $(this).data("target");
                $(id).slideToggle();
            });

            async function sortingblocks() {
                var arr=[];
                $( "#fields" ).sortable({

                    handle: '.dib-arrows-alt',
                    placeholder: "ui-state-highlight",
                    stop: function( event, ui ) {
                        $.each($("#fields .block-box"), function (i, e) {
                            var id      = $(e).data("id");
                            var order   = i+1;
                            var url = '{{route("client.plugins.reorder_form_fields")}}/'+id+'/'+order;
                            $.get(url, function () {});
                            if(i >= $("#fields .block-box").length -1){
                                setTimeout(function () {
                                    $("#fields_wrapper").html($("#loading-wrapper").html());
                                    $("#fields_wrapper").load(window.location + " #fields", function () {
                                        goNotif("success", "تم حفظ البيانات !");
                                        sortingblocks();
                                    });
                                    sortingblocks();
                                }, 200);
                            }
                        });
                    }
                });
                $( "#fields" ).disableSelection();

                $('input:not(.no_ichek)').iCheck({
                    checkboxClass: 'icheckbox_square-purple',
                    radioClass: 'iradio_square-purple',
                    increaseArea: '20%'
                });

            }

            sortingblocks();

            function fixn_names(){
                /*$.each($("#fields .boxx"), function (i,e) {
                    $(".title", e).html("حقل "+(i+1));
                    $(".options", e).attr("name", "option"+i+"[]");
                })*/
            }

            $(document).on("click", ".btn-open", function (e) {
                e.preventDefault();
                var target = $(this).data("target");
                $(target).slideToggle();
            });

            $(document).on("click", ".btn-add-field", function (e) {
                e.preventDefault();
                $("#fields").prepend($("#field").html());
                fixn_names();
                sortingblocks();
            });

            $(document).on("click", ".remove_me:not(.remove_me_ajax)", function (e) {
                e.preventDefault();
                $(this).closest(".boxx").remove();
                fixn_names();
                sortingblocks();
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
                $(div).prepend($("#options").html());
                //fixn_names();
            });

            $(document).on("click", ".btn-delete-option", function (e) {
                e.preventDefault();
                var div = $(this).closest(".row");
                $(div).remove();
                //fixn_names();
                sortingblocks();
            });

            $(document).on("change", ".types", function (e) {
                var val = $(this).val();
                if(val=="select" || val=="selectmultiple"){
                    $(this).closest(".boxx").find(".options-div").slideDown();
                }else{
                    $(this).closest(".boxx").find(".options-div").slideUp();
                }
            });

            $(document).on("click", ".btn-save", function (e) {
                var id = $(this).closest(".boxx").find(".id").val();
                var field_id = $(this).closest(".boxx").find(".field_id").val();
                field_id = (field_id)?field_id:0;
                var name = $(this).closest(".boxx").find(".name").val();
                if(!name || name==""){
                    alert("يجب كتابة إسم الحقل !")
                    return;
                }
                var required    = ($(this).closest(".boxx").find(".requireds").prop("checked") == true)? "1": null;
                var placeholder = $(this).closest(".boxx").find(".placeholder").val();
                var type        = $(this).closest(".boxx").find(".types").val();
                var form        = $(this).closest(".boxx").find(".form").val();
                var space       = $(this).closest(".boxx").find(".space").val();
                if(!type || type==""){
                    alert("يجب إختيار نوع الحقل !")
                    return;
                }
                var options = [];
                $.each($(this).closest(".boxx").find(".options"), function (i, e) {
                    if($(e).val() && $(e).val()!="")
                        options.push($(e).val())
                });
                options = (options.length>0)?options.join(";"):null;

                $("#fields_wrapper").html($("#loading-wrapper").html());
                $.post("{{route("client.plugins.save_app_field")}}",
                    {
                        "_token": "{{ csrf_token() }}",
                        "id" : id,
                        "field_id" : field_id,
                        "name" : name,
                        "required" : required,
                        "placeholder" : placeholder,
                        "type" : type,
                        "space" : space,
                        "options" : options
                    },
                    function (data) {
                        $("#fields_wrapper").load(window.location + " #fields", function () {
                            goNotif("success", "تم حفظ البيانات !");
                            sortingblocks();
                        });
                        sortingblocks();
                    }
                );

            });

            $(document).on("click", ".btn-delete, .remove_me_ajax", function (e) {
                if(confirm('هل أنت متأكد ؟')){
                    var field_id = $(this).closest(".boxx").find(".field_id").val();

                    $("#fields_wrapper").html($("#loading-wrapper").html());
                    $.post("{{route("client.plugins.remove_app_field")}}",
                        {
                            "_token": "{{ csrf_token() }}",
                            "field_id" : field_id,
                        },
                        function (data) {
                            $("#fields_wrapper").load(window.location + " #fields", function () {
                                goNotif("success", "تم حذف البيانات !");
                                sortingblocks();
                            });
                            sortingblocks();
                        }
                    );
                }
            });

            $(document).on("click", ".dupliacte_me", function (e) {
                if(confirm('هل أنت متأكد ؟')){
                    var field_id = $(this).closest(".boxx").find(".field_id").val();

                    $("#fields_wrapper").html($("#loading-wrapper").html());
                    $.post("{{route("client.plugins.duplicate_app_field")}}",
                        {
                            "_token": "{{ csrf_token() }}",
                            "field_id" : field_id,
                        },
                        function (data) {
                            $("#fields_wrapper").load(window.location + " #fields", function () {
                                goNotif("success", "تم نسخ البيانات !");
                                sortingblocks();
                            });
                            sortingblocks();
                        }
                    );
                }
            });

        });

    </script>



@endsection
