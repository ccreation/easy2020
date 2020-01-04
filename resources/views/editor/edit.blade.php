@extends("editor.parts.app")

@section("content")

    <div class="main--container-website">
        <div class="website-image">
            <div class="col-sm-12 p-0 smart_editor">
                <div id="preview_wrapper">
                    <div id="preview_div">
                        <iframe scrolling="yes" name="frame_wrap" id="frame_wrap" src="{{$real_page_url}}" border="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="display: none;">

        <div class="main-sticky-toolbar2">
            <button class="toggle-sticky-toolbar2"><i class="fas fa-cog"></i></button>
            <ul class="list-sticky-toolbar2">
                <li class="delete_block_btn">
                    <a title="{{__("l.delete")}}"><i class="far fa-trash-alt"></i></a>
                </li>
                <li class="copy_block_btn">
                    <a title="{{__("l.duplicate")}}"><i class="fas fa-copy"></i></a>
                </li>
                <li class="settings_block_btn">
                    <a><i class="fas fa-cog"></i></a>
                </li>
                <li class="up_block_btn">
                    <a><i class="fas fa-chevron-up"></i></a>
                </li>
                <li class="down_block_btn">
                    <a><i class="fas fa-chevron-down"></i></a>
                </li>
            </ul>
        </div>

        <div class="main-editor-tools">
            <div class="side-tool-buttons">
                <div class="group-list-btn">
                    <button class="btn-switch-mode copy_col_btn" title="{{__("l.duplicate")}}">
                        <span class="pbicon-wrapper"><i class="fa fa-copy"></i></span>
                    </button>
                    <button class="btn-switch-mode delete_col_btn" title="{{__("l.delete")}}">
                        <span class="pbicon-wrapper"><i class="fa fa-trash"></i></span>
                    </button>
                    <button class="btn-switch-mode right_col_btn">
                        <span class="pbicon-wrapper"><i class="fa fa-angle-right"></i></span>
                    </button>
                    <button class="btn-switch-mode left_col_btn">
                        <span class="pbicon-wrapper"><i class="fa fa-angle-left"></i></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="main-editor-tools-icon">
            <div class="side-tool-buttons">
                <div class="group-list-btn">
                    <button class="btn-switch-mode add_icon_btn" title="{{__("l.icons")}}">
                        <span class="pbicon-wrapper"><i class="fa fa-icons"></i></span>
                    </button>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal 3-->
    <div class="modal fade ModalPannel" id="ModalPannel_3" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{__("l.confirmation_message")}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-4">
                    <h5 class="modal-subTitle mb-4">{{__("l.confirmation_message_note")}}</h5>
                    <div class="d-flex align-items-center justify-content-center">
                        <button type="button" class="btn btn-closeModal conf">{{__("l.yes")}}</button>
                        <button type="button" class="btn btn-closeModal" data-dismiss="modal">{{__("l.no")}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section("scripts")

    <!-- spectrum -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css" integrity="sha256-f83N12sqX/GO43Y7vXNt9MjrHkPc4yi9Uq9cLy1wGIU=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js" integrity="sha256-ZdnRjhC/+YiBbXTHIuJdpf7u6Jh5D2wD5y0SNRWDREQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/i18n/jquery.spectrum-ar.min.js" integrity="sha256-G9DxgmWSMo2EI2Ow3A8sqWGgTEDZ0VK0G+GB/u0MRF0=" crossorigin="anonymous"></script>

    <!-- fontawesome-iconpicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/css/fontawesome-iconpicker.min.css" integrity="sha256-yExEWA6b/bqs3FXxQy03aOWIFtx9QEVnHZ/EwemRLbc=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/js/fontawesome-iconpicker.min.js" integrity="sha256-QvBM3HnWsvcCWqpqHZrtoefjB8t2qPNzdSDNyaSNH5Q=" crossorigin="anonymous"></script>

    <style>
        .iconpicker-popover{
            width: 100% !important;
            position: inherit !important;
            background: none !important;
            border: none !important;
        }
        .popover-title{
            padding: 0px !important;
            margin-bottom: 15px;
            background: none !important;
            border: none !important;
        }
        .popover-title input{
            color: #333 !important;
        }
        .popover-title input::-webkit-input-placeholder {
            color: #b7b3be;
        }
        .popover-title input:-ms-input-placeholder {
            color: #b7b3be;
        }
        .popover-title input::placeholder {
            color: #b7b3be;
        }
        .iconpicker-popover.popover.bottom>.arrow:after, .iconpicker-popover.popover.bottom>.arrow{
            display: none;
        }
        .iconpicker-items{
            background: no-repeat !important;
            border: 1px solid rgba(238, 238, 238, 0.11);
        }
        .iconpicker-item{
            background: #AF96D3;
        }
        .iconpicker-item i{
            color: #512293;
        }
        .sp-replacer.sp-light{
            width: 100%;
            margin-top: 5px;
        }
        .sp-preview {
            width: 94%;
            height: 30px;
        }
        .sp-dd{
            font-size: 14px;
            padding-top: 8px;
        }
        .hidden{
            display: none !important;
        }
        body::-webkit-scrollbar, body *::-webkit-scrollbar {
            width: 7px;
            border-radius: 50px
        }
        body::-webkit-scrollbar-track, body *::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 50px
        }
        body::-webkit-scrollbar-thumb, body *::-webkit-scrollbar-thumb {
            background: #999;
            border-radius: 50px
        }
        body::-webkit-scrollbar-thumb:hover, body *::-webkit-scrollbar-thumb:hover {
            background: #777;
            cursor: pointer !important;
        }
        #preview_wrapper, #preview_div {
            overflow-y: auto;
            background: #ECEDF2;
        }
        #preview_div{
            width: 100%;
            margin: 0px auto;
        }
        #frame_wrap {
            width: 100%;
            height: 565px;
            position: static;
            margin: 0px auto;
            display: block;
            border: 1px solid #44444433;
            background: #fff;
            border-top: none;
        }
        .preview-btn.nav-item.active:before{
            display: none;
        }
        .widget__item-page-link{
            display: inline-block;
            margin: 0px 10px;
            padding-top: 10px;
        }
        .add_page, .edit_page {
            display: none;
        }
        .show_pages, .show_pages:hover, .close_block_settings, .close_block_settings:hover{
            background-color: #673EA1;
            padding: 10px 21px;
            border-radius: 5px;
            border: 1px solid #7D58AE;
            display: inline-block;
            color: #fff;
        }
        .main--container-website.active-dropdown{
            padding: 0px !important;
        }
    </style>

    <script>

        $(function () {

            $(document).on("click", '.main_header_option .widget__item-option.list-nav .widget__item-option-item > .nav-item', function(){
                $(this).closest('.widget__item-option-item').siblings().find('.dropdown_widget').removeClass('active_dropdown_widget')
                $(this).closest('.widget__item-option-item').siblings().find('.nav-item').removeClass('active')
                $('.dropdown_widget.dropdown_widget_second').removeClass('active_dropdown_widget')
                $(this).closest('.widget__item-option-item').find('.dropdown_widget').toggleClass('active_dropdown_widget')
                $(this).closest('.widget__item-option-item').find('.nav-item').toggleClass('active')
            });

            $(document).on("click", '.main_header_option .widget__item-option .widget__item-option-item > .nav-item', function(){
                if($('.dropdown_widget').hasClass('active_dropdown_widget')){
                    $('.main--container-website').addClass('active-dropdown')
                }else{
                    $('.main--container-website').removeClass('active-dropdown')
                }
                $('.scroll').each(function(){ const ps = new PerfectScrollbar($(this)[0]); });
            });



            var iframe      = $('#frame_wrap').contents();
            var lang = "{{$website_lang}}";
            var current_section = null;
            var current_icon = null;

            function relaoding(){
                var window_height   = $(window.top).outerHeight();
                var headr_height    = $(".main-header").outerHeight();
                var height          = parseInt(window_height - headr_height);
                $("#frame_wrap").css("height", height);
                $(".colorpicker").spectrum({
                    allowEmpty:true,
                    showInitial: true,
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
                        $(this).attr("value", (color) ? color.toRgbString() : "");
                        $(this).val((color) ? color.toRgbString() : "");
                    }
                });
                $('.iconpicker_element').iconpicker({hideOnSelect:true, container: ".iconpicker_container", collision: true, animation: false,});
                $(".iconpicker_element").off("iconpickerSelected");
                $('.iconpicker_element').on("iconpickerSelected", function(event){
                    var val = $(this).val();
                    $("i", current_icon).attr("class", val);
                    $(".settings_icon_btn_nav_link").trigger("click");
                });
            }

            function myHandler() {
                $('#frame_wrap').show();
                relaoding();
                iframe              = $('#frame_wrap').contents();
                var settings_block  = $(".main-sticky-toolbar2").clone();
                var settings_col    = $(".main-editor-tools").clone();
                var settings_icon   = $(".main-editor-tools-icon").clone();

                // Section Hover
                iframe.contents().find("section.section").hover(function(e) {
                   $(this).addClass("highlighted");
                    var section = $(this);
                    current_section = section;
                    iframe.contents().find(".main-sticky-toolbar2").remove();
                    $(this).append($(settings_block));

                    // Delete Block
                    $(settings_block).find(".delete_block_btn a").click(function(e) {
                        e.preventDefault();
                        $(section).confirm({
                            conf : function () {
                                $(section).remove();
                                window.frame_wrap.front_destroying();
                                myHandler();
                            }
                        });
                    });

                    // Duplicate Block
                    $(settings_block).find(".copy_block_btn a").click(function(e) {
                        e.preventDefault();
                        $(section).confirm({
                            conf : function () {
                                var section_clone = $(section).clone();
                                $.each($(section_clone).find(".easy_text, .easy_image, .easy_icon"), function (i, e) {
                                    var id = new Date().valueOf()+"_"+Math.floor(Math.random() * 1000);
                                    $(e).attr("id", id);
                                });
                                $(section_clone).insertAfter(section);
                                window.frame_wrap.front_destroying();
                                myHandler();
                            }
                        });
                    });

                    // Block Settings
                    $(settings_block).find(".settings_block_btn a").click(function(e) {
                        e.preventDefault();
                        $(".settings_block_btn_nav_link").trigger("click");
                        var color           = $(".background_color_div", current_section).css("background-color");
                        if(color)
                            $(".colorpicker1").spectrum("set", color);
                        var background_image = $(current_section).css("background-image");
                        var easy_image_settings = $(".backgroundImageSetting img");
                        if(background_image && background_image !="none"){
                            var background_image = background_image.match(/url\(["']?([^"']*)["']?\)/)[1];
                            $(easy_image_settings).attr("src", background_image)
                        }else{
                            $(easy_image_settings).attr("src", "{{asset("public/no-image2.png")}}")
                        }
                        var padding_top     = $(section).css("padding-top");
                        if(padding_top){
                            padding_top     = parseInt(padding_top.replace("px", ""));
                            var rangepicker = $(".sliderInput_2");
                            $(rangepicker).val(padding_top);
                        }
                    });

                    // Move Block Up
                    $(settings_block).find(".up_block_btn a").click(function(e) {
                        e.preventDefault();
                        $(section).confirm({
                            conf : function () {
                                var section_clone = $(section).clone();
                                $(section_clone).insertBefore($(section).prev("section.section"));
                                $(section).remove();
                                window.frame_wrap.front_destroying();
                                myHandler();
                            }
                        });
                    });

                    // Move Block Down
                    $(settings_block).find(".down_block_btn a").click(function(e) {
                        e.preventDefault();
                        $(section).confirm({
                            conf : function () {
                                var section_clone = $(section).clone();
                                $(section_clone).insertAfter($(section).next("section.section"));
                                $(section).remove();
                                window.frame_wrap.front_destroying();
                                myHandler();
                            }
                        });
                    });

                }, function () {
                    $(this).removeClass("highlighted");
                    $(settings_block).removeClass("sticky-toolbar-active");
                    $(settings_col).hide();
                });

                // Edit TEXT
                iframe.contents().find(".easy_text").hover(function() {
                    var id = new Date().valueOf()+"_"+Math.floor(Math.random() * 1000);
                    if(!$(this).attr("id"))
                        $(this).attr("id", id);
                    $(this).on("click", function (e) {
                        e.preventDefault();
                        window.frame_wrap.easy_text($(this));
                    });
                }, function(){
                    $(this).removeClass("contenteditable");
                });

                // Duplicate, Delete, Move Right & Move Left Cols
                iframe.contents().find(".easy_col").hover(function(e) {
                    e.preventDefault();
                    $(this).addClass("highlighted");
                    iframe.contents().find(".main-editor-tools").remove();
                    var col = $(this);
                    $(settings_col).insertAfter($(this));
                    $(settings_col).show();
                    var position = $(this).position();
                    var width = $(this).outerWidth(true);
                    var height = $(settings_col).outerHeight(true);
                    var width2 = $(settings_col).outerWidth(true);
                    $(settings_col).css({top: position.top-(height -10), left: position.left + (width/2) - (width2/2) });

                    // Hide Move Left for the last col
                    $(col).parent().find('.easy_col').each(function(){
                        var $this = $(this);
                        var all = $(col).parent().find('.easy_col').length;
                        if ($this.index() == all - 1){
                            $($this).addClass("last-of-type");
                        }else{
                            $($this).removeClass("last-of-type");
                        }
                    });

                    // Duplicate Col
                    $(settings_col).find(".copy_col_btn").click(function(e) {
                        e.preventDefault();
                        $(col).confirm({
                            conf : function () {
                                var col_clone = $(col).clone();
                                $.each($(col_clone).find(".easy_text, .easy_image, .easy_icon"), function (i, e) {
                                    var id = new Date().valueOf()+"_"+Math.floor(Math.random() * 1000);
                                    $(e).attr("id", id);
                                });
                                $(col_clone).insertAfter($(col));
                                window.frame_wrap.front_destroying();
                                myHandler();
                            }
                        });
                    });

                    // Delete Col
                    $(settings_col).find(".delete_col_btn").click(function(e) {
                        e.preventDefault();
                        $(col).confirm({
                            conf : function () {
                                $(col).remove();
                                window.frame_wrap.front_destroying();
                                myHandler();
                            }
                        });
                    });

                    // Move Left Col
                    $(settings_col).find(".left_col_btn").click(function(e) {
                        e.preventDefault();
                        $(col).confirm({
                            conf : function () {
                                var col_clone = $(col).clone();
                                $(col_clone).insertAfter($(col).next(".main-editor-tools").next(".easy_col"));
                                $(col).remove();
                                window.frame_wrap.front_destroying();
                                myHandler();
                            }
                        });
                    });

                    // Move Right Up
                    $(settings_col).find(".right_col_btn").click(function(e) {
                        e.preventDefault();
                        $(col).confirm({
                            conf : function () {
                                var col_clone = $(col).clone();
                                $(col_clone).insertBefore($(col).prev(".easy_col"));
                                $(col).remove();
                                window.frame_wrap.front_destroying();
                                myHandler();
                            }
                        });
                    });

                    // change Move Right & Move Left icons to up and down icons if cols are verical
                    if($(this).hasClass("easy_vertical")){
                        $(".right_col_btn .fa", settings_col).attr("class", "fa fa-angle-up");
                        $(".left_col_btn .fa", settings_col).attr("class", "fa fa-angle-down");
                    }else{
                        $(".right_col_btn .fa", settings_col).attr("class", "fa fa-angle-right");
                        $(".left_col_btn .fa", settings_col).attr("class", "fa fa-angle-left");
                    }

                }, function () {
                    $(this).removeClass("highlighted");
                });

                // Edit Icon
                iframe.contents().find(".easy_icon").hover(function(e) {
                    e.preventDefault();
                    var id = new Date().valueOf()+"_"+Math.floor(Math.random() * 1000);
                    if(!$(this).attr("id"))
                        $(this).attr("id", id);
                    iframe.contents().find(".main-editor-tools-icon").remove();
                    var icon = $(this);
                    current_icon = icon;
                    var section = $(this).closest("section.section");
                    $(settings_icon).insertBefore(iframe.contents().find("#content"));
                    $(settings_icon).show();
                    var position = $(this).offset();
                    var width = $(this).outerWidth(true);
                    var height = $(this).outerHeight(true);
                    var width2 = $(settings_icon).outerWidth(true);
                    if($(section).attr("id") == "header"){
                        $(settings_icon).css({top: position.top+(height), left: position.left + (width/2) - (width2/2) - 8 });
                    }else{
                        $(settings_icon).css({top: position.top-(height - 10), left: position.left + (width/2) - (width2/2) - 8 });
                    }

                    // Settings Link
                    $(settings_icon).find(".add_icon_btn").click(function(e) {
                        e.preventDefault();
                        $(".settings_icon_btn_nav_link").trigger("click");
                        var icon = $("i", current_icon).attr("class");
                        setTimeout(function () {
                            $('.iconpicker_element').val(icon);
                            $('.iconpicker_element').trigger("focus");
                            $(".popover-title input").attr("placeholder", "{{__("l.search")}}...");
                        }, 200);
                    });

                }, function(){
                });

            }

            $(document).on('iframeready', myHandler);

            // Toggle between desktop, ipad and mobile
            $(document).on("click", ".preview-btn", function (e) {
                e.preventDefault();
                $('.preview-btn').not(this).each(function(){
                    $(this).removeClass("active");
                });
                $(this).addClass("active");
                if($(this).hasClass("preview-laptop")){
                    $("#preview_div").css("width", "100%");
                }else if($(this).hasClass("preview-ipad")){
                    $("#preview_div").css("width", "768px");
                }else if($(this).hasClass("preview-mobile")) {
                    $("#preview_div").css("width", "375px");
                }
            });

            $(document).on("click", ".add_new_page", function (e) {
                e.preventDefault();
                $(".dropdown_widget .pages").hide();
                $(".dropdown_widget .add_page").show();
                $(".dropdown_widget .edit_page").hide();
            });

            $(document).on("click", ".show_pages", function (e) {
                e.preventDefault();
                $(".dropdown_widget .pages").show();
                $(".dropdown_widget .add_page").hide();
                $(".dropdown_widget .edit_page").hide();
            });

            $(document).on("click", ".edit_page_link", function (e) {
                e.preventDefault();
                $(".dropdown_widget .pages").hide();
                $(".dropdown_widget .add_page").hide();
                $(".dropdown_widget .edit_page").hide();
                var id = $(this).data("id");
                if(id){
                    $(".dropdown_widget .edit_page_"+id).show();
                }
            });

            $(document).on("click", ".widget__item.block", function(e) {
                e.preventDefault();
                var url     = $(this).data("url");
                $(this).closest(".dropdown_widget").removeClass("active_dropdown_widget");
                $(this).closest(".dropdown_widget").prev(".nav-link").removeClass("active");
                $.get(url, function (html) {
                    iframe.find(".content-wrap").append(html);
                    iframe.find("#default_section").remove();
                    setTimeout(function () {
                        myHandler();
                    }, 500);
                });
            });

            $(document).on("click", ".nav_lang", function (e) {
                e.preventDefault();
                var url = $('#frame_wrap').attr("src");
                $(this).removeClass("active");
                if($(this).hasClass("lang_ar")){
                    $(this).removeClass("lang_ar");
                    $(this).addClass("lang_en");
                    $(".widget__item-option-icon", this).html("en");
                    lang = "en";
                    url = '{{route("website.page", [$website->slug, "en", $page->slug])}}';
                    $("#frame_wrap").attr("src", url);
                    $(".btn-preview").attr("href", url);
                }else{
                    $(this).removeClass("lang_en");
                    $(this).addClass("lang_ar");
                    $(".widget__item-option-icon", this).html("ar");
                    lang = "ar";
                    url = '{{route("website.page", [$website->slug, "ar", $page->slug])}}';
                    $("#frame_wrap").attr("src", url);
                    $(".btn-preview").attr("href", url);
                }
            });

            $(document).on("click", ".btn-preview", function (e) {
                $(this).removeClass("active");
            });

            // Save Page
            $(document).on("click", ".save_page", function (e) {
                e.preventDefault();
                $(this).removeClass("active");
                savepage($(this)) ;
            });

            function savepage(s) {
                var iframe = $('#frame_wrap').contents();
                var html = window.frames[0].document.body;
                var status = ($(s).hasClass("public")) ? 1 : 0;
                iframe.contents().find(".main-sticky-toolbar2, .main-editor-tools, .main-editor-tools-icon").remove();
                html = $(html).find("#wrapper #content .content-wrap");
                $('#frame_wrap').hide();
                // destroy
                //window.frame_wrap.front_destroying();
                setTimeout(function () {
                    // save now
                    html = $(html).html();
                    var url = "{{route("editor.save_page_html_content")}}";
                    $.post(url, { "_token" : "{{csrf_token()}}", "id" : "{{$page->id}}", "lang": lang, "html" : html, "status" : status}, function(){
                        goNotif("success", "{{__("l.Page Saved")}}");
                        $("#header1").load(window.location + " #header2", function () {
                            myHandler();
                        });
                    });
                }, 1000);
            }

            $(document).on("change", ".colorpicker1", function () {
                var color = $(this).val();
                $(".background_color_div", current_section).css("background-color", color);
            });

            $(document).on("change", ".sliderInput_2", function () {
                var padding_top     = $(this).val();
                padding_top         = parseInt(padding_top);
                var padding_bottom  = 120 - parseInt(padding_top);
                $(current_section).css("padding-top", padding_top).css("padding-bottom", padding_bottom);
            });

            $(document).on("click", ".close_block_settings", function (e) {
                e.preventDefault();
                $(".settings_block_btn_nav_link").trigger("click");
            });

        });

    </script>

@endsection
