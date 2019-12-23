@extends("client.parts.app")

@section("content")

    <div class="container pt-2 pb-5" style="min-height: 500px;">

        <h4 class="mb-4 text-center" style="color: #512293"><b>{{__("l.edit_website")}}</b></h4>

        <form id="websites_save" action="{{route("client.websites.update")}}" method="post" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{$website->id}}">

            <div class="row">

                @if($plan->root_domain==1)
                    <div class="col-md-11 mx-auto">
                        <div class="form-group row">
                            <label class="col-md-2"><span>{{__("l.website_slug")}}</span> <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" name="slug" id="slug" value="{{$website->slug}}" class="form-control" required>
                                <div class="valid-feedback"></div>
                                <div class="invalid-feedback"></div>
                                <small>{{__("l.website_slug_note")}}</small>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-md-5 mx-auto">

                    <div class="form-group">
                        <label><span>{{__("l.website_category")}}</span> <span class="text-danger">*</span></label>
                        <select name="category_id" value="{{old('category_id')}}" class="form-control" required>
                            <option value="">إختر</option>
                            @foreach($catgeories as $category)
                                <option value="{{$category->id}}" @if($website->category_id==$category->id) selected @endif>{{$category->name_ar}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="col-md-5 mx-auto">
                    <div class="form-group">
                        <label><span>{{__("l.logo")}}</span></label>
                        <input type="file" accept="image/*" name="logo" class="form-control" />
                        <br>
                        @if($website->logo)
                            <img src="{{$website->logo}}" style="width: 80px; display: block;  height: 80px; border: 1px solid #eee; border-radius: 2px;">
                        @else
                            <img src="{{asset("public/no-image2.png")}}" style="width: 80px; display: block;  height: 80px; border: 1px solid #eee; border-radius: 2px;">
                        @endif
                    </div>
                </div>

                <div class="col-md-12 mt-2 mb-2"></div>

                <div class="col-md-5 mx-auto">

                    <div class="form-group">
                        <label><span>{{__("l.website_multi_lang")}}</span> <span class="text-danger">*</span></label>
                        <select name="multi_lang" id="multi_lang" class="form-control" required>
                            <option value="1" @if($website->multi_lang==1) selected @endif>{{__("l.yes")}}</option>
                            <option value="0" @if($website->multi_lang==0) selected @endif>{{__("l.no")}}</option>
                        </select>
                    </div>

                </div>

                <div class="col-md-5 mx-auto">

                    <div class="form-group">
                        <label><span>{{__("l.website_default_lang")}}</span> <span class="text-danger">*</span></label>
                        <div class="kt-radio-list">
                            <label class="kt-radio mt-10">
                                <input type="radio" name="default_lang" class="default_lang" value="ar" @if($website->default_lang=="ar") checked @endif> <strong>{{__("l.arabic")}}</strong>
                                <span style="background: #fff"></span>
                            </label>
                            <label class="kt-radio">
                                <input type="radio" name="default_lang" class="default_lang" value="en" @if($website->default_lang=="en") checked @endif> <strong>{{__("l.english")}}</strong>
                                <span style="background: #fff"></span>
                            </label>
                        </div>
                    </div>

                </div>

                <div class="col-md-12 mt-2 mb-2"></div>

                <div class="col-md-5 mx-auto" id="lang_ar">

                    <div class="form-group">
                        <label><span>{{__("l.website_name")}}</span> <small>({{__("l.arabic")}})</small></label>
                        <input type="text" name="name_ar" value="{{$website->name_ar}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label><span>{{__("l.website_brief")}}</span> <small>({{__("l.arabic")}})</small></label>
                        <textarea name="description_ar" rows="5" class="form-control">{{$website->description_ar}}</textarea>
                    </div>

                </div>

                <div class="col-md-5 mx-auto" id="lang_en">

                    <div class="form-group">
                        <label><span>{{__("l.website_name")}}</span> <small>({{__("l.english")}})</small></label>
                        <input type="text" name="name_en" value="{{$website->name_en}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label><span>{{__("l.website_brief")}}</span> <small>({{__("l.english")}})</small></label>
                        <textarea name="description_en" rows="5" class="form-control">{{$website->description_en}}</textarea>
                    </div>

                </div>

                <div class="col-md-12 mt-2 mb-2"></div>

                <div class="col-md-5 mx-auto">
                    <div class="form-group">
                        <label>{{__("l.color1")}}</label>
                        <input type="text" name="color1" value="{{$website->color1}}" class="form-control colorpicker">
                    </div>
                </div>

                <div class="col-md-5 mx-auto">
                    <div class="form-group">
                        <label>{{__("l.color2")}}</label>
                        <input type="text" name="color2" value="{{$website->color2}}" class="form-control colorpicker">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="form-group text-center mt-4 mb-5">
                        <button type="submit" class="btn general-btn-sm-blue rounded"><i class="fa fa_save"></i> <span>{{__("l.save")}}</span></button>
                    </div>
                </div>
            </div>

        </form>

    </div>

@endsection

@section("scripts")

    <!-- spectrum -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css" integrity="sha256-f83N12sqX/GO43Y7vXNt9MjrHkPc4yi9Uq9cLy1wGIU=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js" integrity="sha256-ZdnRjhC/+YiBbXTHIuJdpf7u6Jh5D2wD5y0SNRWDREQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/i18n/jquery.spectrum-ar.min.js" integrity="sha256-G9DxgmWSMo2EI2Ow3A8sqWGgTEDZ0VK0G+GB/u0MRF0=" crossorigin="anonymous"></script>

    <!-- jquery-confirm -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css" integrity="sha256-VxlXnpkS8UAw3dJnlJj8IjIflIWmDUVQbXD9grYXr98=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha256-Ka8obxsHNCz6H9hRpl8X4QV3XmhxWyqBpk/EpHYyj9k=" crossorigin="anonymous"></script>

    <!-- fontawesome iconpicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/css/fontawesome-iconpicker.min.css" integrity="sha256-yExEWA6b/bqs3FXxQy03aOWIFtx9QEVnHZ/EwemRLbc=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/js/fontawesome-iconpicker.min.js" integrity="sha256-QvBM3HnWsvcCWqpqHZrtoefjB8t2qPNzdSDNyaSNH5Q=" crossorigin="anonymous"></script>

    <style>
        .iconpicker-popover{
            transition: none !important;
        }
        .iconpicker-popover.in{
        }
        .iconpicker-popover, .popover-title, .popover-content{
            width: 585px !important;
        }
        .iconpicker_original .iconpicker-popover, .iconpicker_original .popover-title, .iconpicker_original .popover-content{
            width: 275px !important;
        }
        @media only screen and (max-width: 585px){
            .iconpicker-popover, .popover-title, .popover-content{
                width: inherit !important;
            }
        }
        .iconpicker-popover>.arrow{
            left: inherit !important;
            right: 10px !important;
        }
        .popover-content{
            border: 1px solid #eee;
        }
        .iconpicker-input{
            display:none;
        }
        .iconpicker-container .input-group-prepend{
            cursor:pointer;
            height: 38.39px;
        }
        .jconfirm-title-c{
            display: none !important;
        }
        .jconfirm-content-pane{
            font-size: 1.2em;
        }
        .hidden{
            display: none;
        }
        .sp-replacer {
            width: 100%;
        }
        .sp-preview{
            width: 90% !important;
        }
        .sp-input {
            text-align: left;
            direction: initial;
        }
        .sp-button-container {
            width: 100%;
        }
    </style>

    <script>

        $(function(){

            <?php $socials = ["facebook", "whatsapp", "tumblr", "instagram", "twitter", "google-plus", "skype", "viber", "vimeo",
                "snapchat", "pinterest", "linkedin", "reddit", "youtube", "vine", "github", "stackexchange", "mobile", "phone", "fax"]; ?>
            var names = {
                    @foreach($socials as $social)
                    "{{$social}}" : "{{__("l.".$social)}}",
                    @endforeach
                };

            function define_lang_config(){
                var multi_lang      = $("#multi_lang").val();
                var default_lang    = $(".default_lang:checked").val();
                if(multi_lang==1){
                    $("#lang_en").show("slow");
                    $("#lang_ar").show("slow");
                }else{
                    if(default_lang=="ar"){
                        $("#lang_en").hide("fast");
                        $("#lang_ar").show("slow");
                    }else{
                        $("#lang_en").show("slow");
                        $("#lang_ar").hide("fast");
                    }

                }

            }

            $(document).on("change", "#multi_lang", function () {
                define_lang_config();
            });

            $(document).on("change", ".default_lang", function () {
                define_lang_config();
            });

            $(".colorpicker").spectrum({
                showInput: true,
                showAlpha: true,
                showPalette: true,
                preferredFormat: "hexa",
                palette: [
                    ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
                    ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
                    ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
                    ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
                    ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
                    ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
                    ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
                    ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
                ],
                change: function(color) {
                    $(this).attr("value", color.toRgbString());
                    $(this).val(color.toRgbString());
                }
            });

            function reloading(){

                $('.iconpicker_ar').iconpicker({hideOnSelect:true, animation: false});

                $('.iconpicker_en').iconpicker({hideOnSelect:true, animation: false});

            }

            reloading();

            $(document).on("click", ".btn-delete-social", function(e){
                e.preventDefault();
                var btn = $(this);
                $.confirm({
                    title: "{{__("l.confirmation")}}",
                    content: "{{__("l.are_you_sure")}}",
                    icon: 'fa fa-question-circle',
                    animation: 'scale',
                    closeAnimation: 'scale',
                    backgroundDismiss: true,
                    opacity: 0.5,
                    buttons: {
                        'cancel': {
                            text: '{{__("l.no")}}',
                            btnClass: 'btn-red pull-left',
                        },
                        'confirm': {
                            text: '{{__("l.yes")}}',
                            btnClass: 'btn-blue',
                            action: function () {
                                $(btn).closest(".add-social-div").remove();
                            }
                        }
                    }
                });
            });

            $(document).on("change", "#socials_add", function () {
                var option  = $(this).children("option:selected");
                var val     = $(option).attr("value").replace("_ar", "");
                if(val && val!=""){
                    $(option).remove();
                    var html = '<div class="add-social-div mt-15">\n' +
                        '        <div class="row">\n' +
                        '            <div class="col-md-3">\n' +
                        '                <div class="form-group mb-10 iconpicker_original">\n' +
                        '                    <label>{{__("l.icon")}}</label>\n' +
                        '                    <div class="input-group iconpicker-container">\n' +
                        '                        <input type="text" name="icon[]" value="fas fa-'+val+'" class="form-control iconpicker_{{$lang}}" autocomplete="off">\n' +
                        '                        <div class="input-group-prepend">\n' +
                        '                            <span class="input-group-text input-group-addon"><i class="fas fa-'+val+'"></i></span>\n' +
                        '                        </div>\n' +
                        '                    </div>\n' +
                        '                </div>\n' +
                        '            </div>\n' +
                        '            <div class="col-md-9">\n' +
                        '                <div class="form-group mb-10">\n' +
                        '                    <label>{{__("l.title")}}</label>\n' +
                        '                    <input type="text" name="title[]" value="'+names[val]+'" class="form-control" autocomplete="off" style="border-radius: 0px; height: 38px;">\n' +
                        '                </div>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '        <div class="row">\n' +
                        '            <div class="col-md-9">\n' +
                        '                <div class="form-group mb-5">\n' +
                        '                    <label>{{__("l.link/value")}}</label>\n' +
                        '                    <input type="text" name="link[]" class="form-control" autocomplete="off" style="border-radius: 0px; height: 38px;">\n' +
                        '                </div>\n' +
                        '            </div>\n' +
                        '            <div class="col-md-3">\n' +
                        '                <div class="form-group mb-5">\n' +
                        '                    <label style="opacity: 0">{{__("l.link")}}</label>\n' +
                        '                    <button type="button" class="btn btn-danger btn-delete-social db" data-toggle="tooltip" title="{{__("l.delete")}}"\n' +
                        '                    style="width: 42px; height: 38px; border-radius: 0px;"><i class="fa fa-trash p-0"></i></button>\n' +
                        '                </div>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '    </div>';
                    $("#socials").prepend(html);
                    reloading();
                }
            });

            var sluggable = @if($plan->root_domain==1) false @else true @endif;

            $(document).on("keyup change paste", "#slug", function () {
                var slug  = $(this).val();
                var input = $(this);
                var url = "{{route("client.websites.sluggable")}}";
                $(".valid-feedback, .invalid-feedback").html("");
                if(slug != ""){
                    $.post(url,
                        { "_token": "{{ csrf_token() }}", slug : slug, id : "{{$website->id}}"},
                        function (data) {
                            if(data=="OK"){
                                sluggable =true;
                                $(input).removeClass("is-invalid");
                                $(input).addClass("is-valid");
                                $(".valid-feedback").html("{{__("l.slug_note_ok")}}");
                            }else{
                                sluggable =false;
                                $(input).removeClass("is-valid");
                                $(input).addClass("is-invalid");
                                $(".invalid-feedback").html("{{__("l.slug_note_bad")}}");
                            }
                        });
                }else{
                    sluggable =false;
                    $(input).removeClass("is-valid");
                    $(input).removeClass("is-invalid");
                }
            });

            $(document).on("submit", "#websites_save", function () {
                if(!sluggable){
                    goNotif("error", "{{__("l.slug_note_bad")}}");
                    return false;
                }
                else{
                    $(this).find('button[type="submit"]').prop("disabled", true);
                }
            });

        });

    </script>

@endsection
