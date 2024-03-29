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
                    <a title="{{__("l.settings")}}"><i class="fas fa-cog"></i></a>
                </li>
                <li class="settings_block_image_btn">
                    <a title="{{__("l.background_image")}}"><i class="fas fa-image"></i></a>
                </li>
                <li class="up_block_btn">
                    <a title="{{__("l.up")}}"><i class="fas fa-chevron-up"></i></a>
                </li>
                <li class="down_block_btn">
                    <a title="{{__("l.down")}}"><i class="fas fa-chevron-down"></i></a>
                </li>
            </ul>
        </div>

        <div class="main-sticky-toolbar3">
            <button class="toggle-sticky-toolbar3"><i class="fas fa-plus"></i></button>
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

        <div class="main-editor-tools-btn">
            <div class="side-tool-buttons">
                <div class="group-list-btn">
                    <button class="btn-switch-mode add_btn_btn" title="{{__("l.settings")}}">
                        <span class="pbicon-wrapper"><i class="fa fa-cogs"></i></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="main-editor-tools-link">
            <div class="side-tool-buttons">
                <div class="group-list-btn">
                    <button class="btn-switch-mode easy_link_icon" title="{{__("l.icons")}}">
                        <span class="pbicon-wrapper"><i class="fa fa-icons"></i></span>
                    </button>
                    <button class="btn-switch-mode settings_link_btn" title="{{__("l.settings")}}">
                        <span class="pbicon-wrapper"><i class="fa fa-link"></i></span>
                    </button>
                    <button class="btn-switch-mode copy_link_btn" title="{{__("l.duplicate")}}">
                        <span class="pbicon-wrapper"><i class="fa fa-copy"></i></span>
                    </button>
                    <button class="btn-switch-mode delete_link_btn" title="{{__("l.delete")}}">
                        <span class="pbicon-wrapper"><i class="fa fa-trash"></i></span>
                    </button>
                    <button class="btn-switch-mode right_link_btn">
                        <span class="pbicon-wrapper"><i class="fa fa-angle-right"></i></span>
                    </button>
                    <button class="btn-switch-mode left_link_btn">
                        <span class="pbicon-wrapper"><i class="fa fa-angle-left"></i></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="main-editor-tools-form">
            <div class="side-tool-buttons">
                <div class="group-list-btn">
                    <button class="btn-switch-mode add_form_btn" title="{{__("l.form")}}">
                        <span class="pbicon-wrapper"><i class="fab fa-wpforms"></i> <b>{{__("l.form")}}</b></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="main-editor-tools-image">
            <div class="side-tool-buttons">
                <div class="group-list-btn">
                    <button class="btn-switch-mode add_image_btn" title="{{__("l.image_popup")}}">
                        <span class="pbicon-wrapper"><i class="fa fa-image"></i></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="main-editor-tools-video">
            <div class="side-tool-buttons">
                <div class="group-list-btn">
                    <button class="btn-switch-mode add_video_btn" title="{{__("l.video_popup")}}">
                        <span class="pbicon-wrapper"><i class="fa fa-video"></i></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="main-editor-tools-gmap">
            <div class="side-tool-buttons">
                <div class="group-list-btn">
                    <button class="btn-switch-mode add_gmap_btn" title="{{__("l.google_map")}}">
                        <span class="pbicon-wrapper"><i class="fas fa-map-marked-alt"></i></span>
                    </button>
                </div>
            </div>
        </div>

        <div id="col-single-image-wrapper">
            <div class="col-single-image">
                <div class="widght-single-image widght-single-image0">
                    <img src="{{asset("public/no-image2.png")}}" alt="">
                    <div class="image_name"></div>
                </div>
            </div>
        </div>

        <div id="col-single-video-wrapper">
            <div class="col-single-image" style="flex: 0 0 25%;max-width: 25%; height: 160px;">
                <div class="widght-single-image widght-single-video0" style="height: 100%; width: 100%;">
                    <iframe style="width: 100%; height: 100%; background: #000;" src=""></iframe>
                    <div class="image_name"></div>
                    <div style="position: absolute; top:0px; bottom: 0px; left: 0px; right: 0px; background: transparent;"></div>
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
        .tab_dropdown_section {
            overflow-x: scroll;
            flex-wrap: nowrap;
            background-color: #AD93D1;
        }
        .tab_dropdown_section .nav-link {
            width: max-content;
        }
        .tab_dropdown_section::before{
            display: none;
        }
        .dropdown_widget-content select.form-control{
            padding: 2px 12px;
        }
        .text_align, .text_align2{
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }
        .text_align.active, .text_align2.active{
            border: 2px solid #fff !important;
        }
        .input-group .sp-replacer.sp-light{
            margin-top: 0px;
        }
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
        .show_pages, .show_pages:hover, .close_block_settings, .close_block_settings:hover
        , .close_btn_settings, .close_btn_settings:hover, .close_link_settings, .close_link_settings:hover
        , .close_icons_settings, .close_icons_settings:hover, .close_linkicons_settings, .close_linkicons_settings:hover
        , .close_form_settings, .close_form_settings:hover, .close_image_settings, .close_image_settings:hover
        , .close_video_settings, .close_video_settings:hover, .close_gmap_settings, .close_gmap_settings:hover{
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
        .wrapper-gallery-image .tab-pane{
            min-height: 300px;
        }
        .list-gallery-image{
            height: 240px;
            overflow-y: scroll;
            overflow-x: hidden;
            padding-top: 1px;
        }
        .aside-gallery-image{
            padding : 0px !important;
        }
        .ModalLiberia{
            padding-top: 15px !important;
        }
        .ModalLiberia .main-gallery-image .content-gallery-image .header-gallery-image{
            padding: 10px 0px !important;
        }
        .save_button.disabled{
            background-color: #AF96D3;
            color: #512293;
            cursor: not-allowed;
            pointer-events:none;
        }
        .col-single-image{
            margin-bottom: 15px;
        }
        .widght-single-image{
            margin-bottom: 0px !important;
        }
        .widght-single-image.active{
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-shadow: 0px 0px 0px 2px #fff;
        }
        .widght-single-image1 {
            position: relative;
        }
        .widght-single-image1 .remove_image{
            display: none;
            color: red;
            background: #fff;
            border: 1px solid red;
            position: absolute;
            top: 3px;
            left: 3px;
            width: 20px;
            height: 20px;
            text-align: center;
            padding-top: 3.3px;
            border-radius: 1px;
        }
        .widght-single-image1:hover .remove_image{
            display: block;
        }
        .widght-single-image1 .remove_image:hover{
            color: #fff;
            background: red;
            border: 1px solid #fff;
        }
        .widght-single-video1 {
            position: relative;
        }
        .widght-single-video1 .remove_video{
            display: none;
            color: red;
            background: #fff;
            border: 1px solid red;
            position: absolute;
            top: 3px;
            left: 3px;
            width: 20px;
            height: 20px;
            text-align: center;
            padding-top: 3.3px;
            border-radius: 1px;
        }
        .widght-single-video1:hover .remove_video{
            display: block;
        }
        .widght-single-video1 .remove_video:hover{
            color: #fff;
            background: red;
            border: 1px solid #fff;
        }
        .preview_font{
            color: white !important;
            font-size: 1.4em !important;
            text-align: justify !important;
        }
        .preview_font_title{
            font-size: 1.2em;
            font-weight: bold;
        }
        .change_font.active{
            border: 2px solid #543c93 !important;
            box-sizing: border-box;
        }
        .colors_add, .colors_edit{
            display: none;
        }
        .widget__item-color.active{
            border: 2px solid #543c93 !important;
            box-sizing: border-box;
        }
        .widget__item-color-header{
            font-weight: bold;
        }
    </style>

    <script>

        var app_lang            = "{{app()->getLocale()}}";
        var images              = [];
        var images_categories   = [];
        var videos              = [];
        var videos_categories   = [];
        var iframe              = $('#frame_wrap').contents();
        var lang                = "{{$website_lang}}";
        var current_section     = null;
        var current_section_add = null;
        var current_icon        = null;
        var current_btn         = null;
        var current_link        = null;
        var form_wrapper        = null;
        var current_image       = null;
        var current_map         = null;
        var chosen_image1       = null;
        var current_video       = null;
        var chosen_video1       = null;

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
                $('.iconpicker_element2').iconpicker({hideOnSelect:true, container: ".iconpicker_container2", collision: true, animation: false,});
                $(".iconpicker_element2").off("iconpickerSelected");
                $('.iconpicker_element2').on("iconpickerSelected", function(event){
                    var val = $(this).val();
                    $("i", current_link).attr("class", val);
                    $(".settings_linkicon_btn_nav_link").trigger("click");
                });
                $('.selectpaicker').selectpicker();
            }

            function myHandler() {
                $('#frame_wrap').show();
                relaoding();
                iframe              = $('#frame_wrap').contents();
                iframe.contents().find(".main-sticky-toolbar2").remove();
                iframe.contents().find(".main-sticky-toolbar3").remove();
                iframe.contents().find(".main-editor-tools").remove();
                iframe.contents().find(".main-editor-tools-icon").remove();
                iframe.contents().find(".main-editor-tools-btn").remove();
                iframe.contents().find(".main-editor-tools-link").remove();
                iframe.contents().find(".main-editor-tools-form").remove();
                iframe.contents().find(".main-editor-tools-image").remove();
                iframe.contents().find(".main-editor-tools-video").remove();
                iframe.contents().find(".main-editor-tools-gmap").remove();
                var settings_block  = $(".main-sticky-toolbar2").clone();
                var settings_block_add  = $(".main-sticky-toolbar3").clone();
                var settings_col    = $(".main-editor-tools").clone();
                var settings_icon   = $(".main-editor-tools-icon").clone();
                var settings_btn    = $(".main-editor-tools-btn").clone();
                var settings_link   = $(".main-editor-tools-link").clone();
                var settings_form   = $(".main-editor-tools-form").clone();
                var settings_image  = $(".main-editor-tools-image").clone();
                var settings_video  = $(".main-editor-tools-video").clone();
                var settings_gmap  = $(".main-editor-tools-gmap").clone();

                // Section Hover
                iframe.contents().find("section.section").hover(function(e) {
                   $(this).addClass("highlighted");
                    var section = $(this);
                    current_section = section;
                    current_section_add = null;
                    iframe.contents().find(".main-sticky-toolbar2").remove();
                    iframe.contents().find(".main-sticky-toolbar3").remove();
                    $(this).append($(settings_block));
                    $(this).append($(settings_block_add));

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
                        /*var background_image = $(current_section).css("background-image");
                        var easy_image_settings = $(".backgroundImageSetting img");
                        if(background_image && background_image !="none"){
                            var background_image = background_image.match(/url\(["']?([^"']*)["']?\)/)[1];
                            $(easy_image_settings).attr("src", background_image)
                        }else{
                            $(easy_image_settings).attr("src", "{{asset("public/no-image2.png")}}")
                        }*/
                        var padding_top     = $(section).css("padding-top");
                        if(padding_top){
                            padding_top     = parseInt(padding_top.replace("px", ""));
                            var rangepicker = $(".sliderInput_2");
                            $(rangepicker).val(padding_top);
                        }
                    });

                    // Block Settings
                    $(settings_block).find(".settings_block_image_btn a").click(function(e) {
                        e.preventDefault();
                        current_image = section;
                        $(".settings_image_btn_nav_link").trigger("click");
                        $("#image_popup_save, #image_popup_save2").addClass("disabled");
                        $(".widght-single-image").removeClass("active");
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

                    // Add Block
                    $(settings_block_add).find(".toggle-sticky-toolbar3").click(function(e) {
                        e.preventDefault();
                        current_section_add = section;
                        $(".blocks_list").trigger("click");
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
                    var height2 = $(settings_icon).outerHeight(true);
                    if($(section).attr("id") == "header"){
                        $(settings_icon).css({top: position.top+(height), left: position.left + (width/2) - (width2/2) - 8 });
                    }else{
                        //$(settings_icon).css({top: position.top-(height - 30), left: position.left + (width/2) - (width2/2) - 8 });
                        $(settings_icon).css({top: position.top - height2 , left: position.left + (width/2) - (width2/2) - 8 });
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

                // Btn Settings
                iframe.contents().find(".easy_btn").hover(function(e) {
                    e.preventDefault();
                    iframe.contents().find(".main-editor-tools-btn").remove();
                    $(settings_btn).show();
                    var btn = $(".btn", this);
                    current_btn = btn;
                    var url = $(btn).attr("href");
                    if($(btn).prop("tagName") == "BUTTON"){
                        $(settings_btn).find("#nav-btn-2-tab").css("pointer-events", "none");
                    }else{
                        $(settings_btn).find(".nav-btn-2-tab").css("pointer-events", "inherit");
                    }
                    $(settings_btn).insertBefore(iframe.contents().find("#content"));
                    var position = $(this).offset();
                    var width = $(this).outerWidth(true);
                    var height = $(settings_btn).outerHeight(true);
                    var width2 = $(settings_btn).outerWidth(true);
                    $(settings_btn).css({top: position.top-(height), left: position.left + (width/2) - (width2/2) - 8 });
                    $(settings_btn).find(".add_btn_btn").click(function(e) {
                        e.preventDefault();
                        $(".settings_btn_btn_nav_link").trigger("click");
                        $('#external_link').val(url);
                        $("#url_type_0").slideDown("slow");
                        $("#url_type_1").slideUp("fast");
                        $("#url_type_2").slideUp("fast");
                        $("#url_type_3").slideUp("fast");
                        $("#url_type_4").slideUp("fast");
                        $.each($("#url_to_other_pages").find("option"), function (i, e) {
                            var val = $(e).attr("value");
                            if(val != "#"){
                                if(val == url){
                                    $("#url_type_0").slideUp("fast");
                                    $("#url_type_1").slideDown("slow");
                                    $("#url_type_2").slideUp("fast");
                                    $("#url_type_3").slideUp("fast");
                                    $("#url_type_4").slideUp("fast");
                                    $("#url_type").selectpicker('val', 1);
                                    $('#url_to_other_pages option[value="'+val+'"]').prop('selected', true);
                                }
                            }
                        });
                        if(url.indexOf("mailto:") >= 0){
                            $("#url_type_0").slideUp("fast");
                            $("#url_type_1").slideUp("fast");
                            $("#url_type_2").slideDown("slow");
                            $("#url_type_3").slideUp("fast");
                            $("#url_type_4").slideUp("fast");
                            $("#url_type").selectpicker('val', 2);
                            $('#an_email').val(url.replace("mailto:", ""));
                        }
                        if(url.indexOf("tel:") >= 0){
                            $("#url_type_0").slideUp("fast");
                            $("#url_type_1").slideUp("fast");
                            $("#url_type_2").slideUp("fast");
                            $("#url_type_3").slideDown("slow");
                            $("#url_type_4").slideUp("fast");
                            $("#url_type").selectpicker('val', 3);
                            $('#mobile_phone').val(url.replace("tel:", ""));
                        }
                        if($(btn).data("lightbox") == "iframe"){
                            $("#url_type_0").slideUp("fast");
                            $("#url_type_1").slideUp("fast");
                            $("#url_type_2").slideUp("slow");
                            $("#url_type_3").slideUp("fast");
                            $("#url_type_4").slideDown("fast");
                            $("#url_type").selectpicker('val', 4);
                            $('#video_url_youtube_or_vimeo').val(url);
                        }
                        var attr = $(btn).attr('target');
                        if (attr != "_blank")
                            $("#open_in_other_window").prop("checked", false);
                        else
                            $("#open_in_other_window").prop("checked", true);
                    });
                    $("#button_text").val($(btn).text());
                    var font_family = $(btn).css('font-family');
                    $('#font_family').selectpicker('val', (font_family) ? font_family+"" : "");
                    $("#font_size").selectpicker('val', $(btn).css('font-size').replace("px", ""));
                    var font_weight = $(btn).css('font-weight');
                    if($.isNumeric(font_weight) && font_weight < 600)
                        font_weight = "normal";
                    if($.isNumeric(font_weight) && font_weight >= 600)
                        font_weight = "bold";
                    $("#font_weight").selectpicker('val', font_weight);
                    $("#colorpicker2").spectrum("set", $(btn).css('color'));
                    var text_align = $(btn).closest(".easy_btn").css('text-align');
                    $(".text_align").removeClass("active");
                    $(".text_align.text_align_"+text_align).addClass("active");
                    var _class = $(btn).attr("class");
                    _class = _class.split(" ");
                    $.each(_class, function (i, c) {
                        $.each($("#button_type").find("option"), function (i, e) {
                            var val = $(e).attr("value");
                            if(c == val)
                                $('#button_type option[value="'+val+'"]').prop('selected', true);
                        });
                    });
                    if ($(btn).hasClass("btn-block"))
                        $("#dispay_block").prop("checked", true);
                    else
                        $("#dispay_block").prop("checked", false);
                    $("#border_width").val($(btn).css('border-width').replace("px", ""));
                    $("#colorpicker3").spectrum("set", $(btn).css('background-color'));
                    $("#colorpicker4").spectrum("set", $(btn).css('border-color'));
                });

                /* Settings, Duplicate, Delete, Move Right & Move Left Links */
                iframe.contents().find(".easy_link").hover(function(e) {
                    e.preventDefault();
                    iframe.contents().find(".main-editor-tools-link").remove();
                    $(settings_link).show();
                    var link = $(this);
                    current_link = link;
                    var section = $(this).closest("section.section");
                    $(settings_link).insertAfter(iframe.contents().find("#content"));
                    var position = $(this).offset();
                    var width = $(this).outerWidth(true);
                    var width2 = $(settings_link).outerWidth(true);
                    var height = $(this).outerHeight(true);
                    // Link and Icon
                    if($(link).hasClass("easy_link_icon"))
                        $(settings_link).addClass("add_link_icon");
                    else
                        $(settings_link).removeClass("add_link_icon");
                    // Position add_link
                    if($(link).hasClass("easy_link_icon")){
                        if($(section).attr("id") == "header"){
                            $(settings_link).css({top: position.top + height - 10, left: position.left + (width/2) - (width2/2)});
                        }else{
                            $(settings_link).css({top: position.top - (height / 2), left: position.left + (width/2) - (width2/2) - 10 });
                        }
                    } else{
                        if($(section).attr("id") == "header"){
                            $(settings_link).css({top: position.top + height - 10, left: position.left + (width/2) - (width2/2)});
                        }else{
                            $(settings_link).css({top: position.top - (height / 2), left: position.left + (width/2) - (width2/2) - 5 });
                        }
                    }
                    // change Move Right & Move Left icons to up and down icons if links are verical
                    if($(this).hasClass("easy_vertical")){
                        $(".right_link_btn .fa", settings_link).attr("class", "fa fa-angle-up");
                        $(".left_link_btn .fa", settings_link).attr("class", "fa fa-angle-down");
                    }else{
                        $(".right_link_btn .fa", settings_link).attr("class", "fa fa-angle-right");
                        $(".left_link_btn .fa", settings_link).attr("class", "fa fa-angle-left");
                    }
                    // Hide Move Right for the first link
                    if ($(link).index() == 0){
                        $(".right_link_btn", settings_link).addClass("disabled");
                    }else{
                        $(".right_link_btn", settings_link).removeClass("disabled");
                    }
                    // Hide Move Left for the last link
                    var all = $(link).parent().find('.easy_link').length;
                    if ($(link).index() == all - 1){
                        $(".left_link_btn", settings_link).addClass("disabled");
                    }else{
                        $(".left_link_btn", settings_link).removeClass("disabled");
                    }
                    $(link).parent().find('.easy_link').each(function(){
                        var $this = $(this);
                        var all = $(link).parent().find('.easy_link').length;
                        if ($this.index() == all - 1){
                            $($this).addClass("last-of-type");
                        }else{
                            $($this).removeClass("last-of-type");
                        }
                    });
                    // Duplicate link
                    $(settings_link).find(".copy_link_btn").click(function(e) {
                        e.preventDefault();
                        $(section).confirm({
                            conf : function () {
                                var link_clone = $(link).clone();
                                $.each($(link_clone).find(".easy_text, .easy_image, .easy_icon"), function (i, e) {
                                    var id = new Date().valueOf()+"_"+Math.floor(Math.random() * 1000);
                                    $(e).attr("id", id);
                                });
                                $(link_clone).insertAfter($(link));
                                window.frame_wrap.front_destroying();
                                myHandler();
                            }
                        });
                    });
                    // Delete link
                    $(settings_link).find(".delete_link_btn").click(function(e) {
                        e.preventDefault();
                        $(section).confirm({
                            conf : function () {
                                $(link).remove();
                                window.frame_wrap.front_destroying();
                                myHandler();
                            }
                        });
                    });
                    // Move Left link
                    $(settings_link).find(".left_link_btn").click(function(e) {
                        e.preventDefault();
                        $(section).confirm({
                            conf : function () {
                                var link_clone = $(link).clone();
                                $(link_clone).insertAfter($(link).next().next());
                                $(link).remove();
                                window.frame_wrap.front_destroying();
                                myHandler();
                            }
                        });
                    });
                    // Move Right Up
                    $(settings_link).find(".right_link_btn").click(function(e) {
                        e.preventDefault();
                        $(section).confirm({
                            conf : function () {
                                var link_clone = $(link).clone();
                                $(link_clone).insertBefore($(link).prev(".easy_link"));
                                $(link).remove();
                                window.frame_wrap.front_destroying();
                                myHandler();
                            }
                        });
                    });
                    // Settings Link
                    var url = $("a", link).attr("href");
                    $(settings_link).find(".settings_link_btn").click(function(e) {
                        e.preventDefault();
                        $(".settings_link_btn_nav_link").trigger("click");
                        $("#link_text").val($("a", link).text());
                        var font_family2 = $("a", link).css('font-family2');
                        $('#font_family2').selectpicker('val', (font_family2) ? font_family2+"" : "");
                        $("#font_size2").selectpicker('val', $("a", link).css('font-size').replace("px", ""));
                        var font_weight2 = $("a", link).css('font-weight');
                        if($.isNumeric(font_weight2) && font_weight2 < 600)
                            font_weight2 = "normal";
                        if($.isNumeric(font_weight2) && font_weight2 >= 600)
                            font_weight2 = "bold";
                        $("#font_weight2").selectpicker('val', font_weight2);
                        $("#colorpicker5").spectrum("set", $("a", link).css('color'));
                        var text_align2 = $("a", link).closest(".easy_link").css('text-align');
                        $(".text_align2").removeClass("active");
                        $(".text_align2.text_align2_"+text_align2).addClass("active");
                        $('#external_link').val(url);
                        $("#url_type_02").slideDown("slow");
                        $("#url_type_12").slideUp("fast");
                        $("#url_type_22").slideUp("fast");
                        $("#url_type_32").slideUp("fast");
                        $("#url_type_42").slideUp("fast");
                        $.each($("#url_to_other_pages2").find("option"), function (i, e) {
                            var val = $(e).attr("value");
                            if(val != "#"){
                                if(val == url){
                                    $("#url_type_02").slideUp("fast");
                                    $("#url_type_12").slideDown("slow");
                                    $("#url_type_22").slideUp("fast");
                                    $("#url_type_32").slideUp("fast");
                                    $("#url_type_42").slideUp("fast");
                                    $("#url_type2").selectpicker('val', 1);
                                    $('#url_to_other_pages2 option[value="'+val+'"]').prop('selected', true);
                                }
                            }
                        });
                        if(url.indexOf("mailto:") >= 0){
                            $("#url_type_02").slideUp("fast");
                            $("#url_type_12").slideUp("fast");
                            $("#url_type_22").slideDown("slow");
                            $("#url_type_32").slideUp("fast");
                            $("#url_type_42").slideUp("fast");
                            $("#url_type2").selectpicker('val', 2);
                            $('#an_email2').val(url.replace("mailto:", ""));
                        }
                        if(url.indexOf("tel:") >= 0){
                            $("#url_type_02").slideUp("fast");
                            $("#url_type_12").slideUp("fast");
                            $("#url_type_22").slideUp("fast");
                            $("#url_type_32").slideDown("slow");
                            $("#url_type_42").slideUp("fast");
                            $("#url_type2").selectpicker('val', 3);
                            $('#mobile_phone2').val(url.replace("tel:", ""));
                        }
                        if($("a", link).data("lightbox") == "iframe"){
                            $("#url_type_02").slideUp("fast");
                            $("#url_type_12").slideUp("fast");
                            $("#url_type_22").slideUp("slow");
                            $("#url_type_32").slideUp("fast");
                            $("#url_type_42").slideDown("fast");
                            $("#url_type2").selectpicker('val', 4);
                            $('#video_url_youtube_or_vimeo2').val(url);
                        }
                        var attr = $("a", link).attr('target');
                        if (attr != "_blank")
                            $("#open_in_other_window2").prop("checked", false);
                        else
                            $("#open_in_other_window2").prop("checked", true);
                    });
                    // Link icon
                    if($(link).hasClass("easy_link_icon")){
                        $(settings_link).find(".easy_link_icon").click(function(e) {
                            e.preventDefault();
                            $(".settings_linkicon_btn_nav_link").trigger("click");
                            var icon = $("i", current_link).attr("class");
                            setTimeout(function () {
                                $('.iconpicker_element2').val(icon);
                                $('.iconpicker_element2').trigger("focus");
                                $(".popover-title input").attr("placeholder", "{{__("l.search")}}...");
                            }, 200);
                        });
                    }
                });

                // Edit Forms
                iframe.contents().find(".contact_form_wrapper").hover(function(e) {
                    e.preventDefault();
                    iframe.contents().find(".main-editor-tools-link").remove();
                    $(settings_form).show();
                    form_wrapper    = $(this);
                    var section         = $(this).closest("section.section");
                    $(settings_form).insertAfter(iframe.contents().find("#content"));
                    var position = $(this).offset();
                    var width = $(this).outerWidth(true);
                    var height = $(settings_form).outerHeight(true);
                    var width2 = $(settings_form).outerWidth(true);
                    $(settings_form).css({top: position.top - height - 20, left: position.left + (width / 2) - (width2 / 2)- 20});

                    // Settings form
                    $(settings_form).find(".add_form_btn").click(function(e) {
                        e.preventDefault();
                        $(".settings_form_btn_nav_link").trigger("click");
                    });

                }, function(){});

                // Image Settings
                iframe.contents().find(".easy_image").hover(function(e) {
                    e.preventDefault();
                    current_image = $(this);
                    iframe.contents().find(".main-editor-tools-image").remove();
                    $(settings_image).show();
                    $(settings_image).insertBefore(iframe.contents().find("#content"));
                    var position = $(this).offset();
                    $(settings_image).css({top: position.top + 5, left: position.left + 5 });
                    $(settings_image).find(".add_image_btn").click(function(e) {
                        e.preventDefault();
                        $(".settings_image_btn_nav_link").trigger("click");
                        $("#image_popup_save , #image_popup_save2").addClass("disabled");
                        $(".widght-single-image").removeClass("active");
                    });
                });

                // Video Settings
                iframe.contents().find(".easy_video").hover(function(e) {
                    e.preventDefault();
                    current_video = $(this);
                    iframe.contents().find(".main-editor-tools-video").remove();
                    $(settings_video).show();
                    $(settings_video).insertBefore(iframe.contents().find("#content"));
                    var position = $(this).offset();
                    $(settings_video).css({top: position.top + 5, left: position.left + 5 });
                    $(settings_video).find(".add_video_btn").click(function(e) {
                        e.preventDefault();
                        $(".settings_video_btn_nav_link").trigger("click");
                        $("#video_popup_save , #video_popup_save2").addClass("disabled");
                        $(".widght-single-image").removeClass("active");
                    });
                });

                // Image Settings
                iframe.contents().find(".easy_gmap").hover(function(e) {
                    e.preventDefault();
                    current_map = $(this);
                    iframe.contents().find(".main-editor-tools-gmap").remove();
                    $(settings_gmap).show();
                    $(settings_gmap).insertBefore(iframe.contents().find("#content"));
                    var position = $(this).offset();
                    $(settings_gmap).css({top: position.top + 5, left: position.left + 5 });
                    $(settings_gmap).find(".add_gmap_btn").click(function(e) {
                        e.preventDefault();
                        var html = $(current_map).html();
                        $("#google_map_link").val($.trim(html));
                        $(".settings_gmap_btn_nav_link").trigger("click");
                    });
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
                    if(current_section_add){
                        $(html).insertAfter($(current_section_add));
                    }else{
                        iframe.find(".content-wrap").append(html);
                    }
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
                $(".widget__item-option-icon", this).html('<i class="fas fa-spinner fa-spin"></i>');
                savepage($(this)) ;
            });

            $(document).on("change", ".colorpicker1", function () {
                var color = $(this).val();
                $(".background_color_div", current_section).remove();
                var background_color_div = '<div class="background_color_div" style="background: '+color+'; position: absolute; width: 100%; height: 100%; top: 0px; left: 0px; bottom: 0px; right: 0px"></div>';
                $(current_section).prepend(background_color_div);
            });

            $(document).on("change", ".sliderInput_2", function () {
                var padding_top     = $(this).val();
                if($(current_section).hasClass("padding-60")){
                    padding_top         = parseInt(padding_top/2);
                    var padding_bottom  = 60 - parseInt(padding_top);
                } else if($(current_section).hasClass("padding-0")){
                    padding_top         = 0;
                    var padding_bottom  = 0;
                } else{
                    padding_top         = parseInt(padding_top);
                    var padding_bottom  = 120 - parseInt(padding_top);
                }
                $(current_section).css("padding-top", padding_top).css("padding-bottom", padding_bottom);
            });

            $(document).on("click", ".close_block_settings", function (e) {
                e.preventDefault();
                $(".settings_block_btn_nav_link").trigger("click");
            });

            $(document).on("click", ".close_icons_settings", function (e) {
                e.preventDefault();
                $(".settings_icon_btn_nav_link").trigger("click");
            });

            $(document).on("click", ".close_linkicons_settings", function (e) {
                e.preventDefault();
                $(".settings_linkicon_btn_nav_link").trigger("click");
            });

            $(document).on("click", ".close_btn_settings", function (e) {
                e.preventDefault();
                $(".settings_btn_btn_nav_link").trigger("click");
            });

            $(document).on("change keyup", "#button_text", function (e) {
                $(current_btn).text($(this).val());
            });

            $(document).on("change", "#font_family", function(e) {
                var font_family = $(this).val();
                if(!font_family)
                    $(current_btn).css('font-family', '');
                else{
                    $(current_btn).css('font-family', '');
                    $(current_btn).attr('style', function(i,s) { return (s || '') + "font-family : " + font_family + " !important;" });
                }
            });

            $(document).on("change", "#font_size", function(e) {
                var font_size = parseFloat($(this).val());
                $(current_btn).css('font-size', font_size);
            });

            $(document).on("change", "#font_weight", function(e) {
                $(current_btn).css('font-weight', $(this).val());
            });

            $(document).on("change", "#colorpicker2", function () {
                var color = $(this).val();
                $(current_btn).css("color", color);
            });

            $(document).on("click", ".text_align", function () {
                $(".text_align").removeClass("active");
                $(this).addClass("active");
                $(current_btn).closest(".easy_btn").css('text-align', $(this).data("align"));
            });

            $(document).on("change", "#url_type", function(e) {
                var val = $(this).val();
                if(val == "1" || val == 1){
                    $("#url_type_0").slideUp("fast");
                    $("#url_type_1").slideDown("slow");
                    $("#url_type_2").slideUp("fast");
                    $("#url_type_3").slideUp("fast");
                    $("#url_type_4").slideUp("fast");
                }else if(val == "2" || val == 2){
                    $("#url_type_0").slideUp("fast");
                    $("#url_type_1").slideUp("fast");
                    $("#url_type_2").slideDown("slow");
                    $("#url_type_3").slideUp("fast");
                    $("#url_type_4").slideUp("fast");
                }else if(val == "3" || val == 3){
                    $("#url_type_0").slideUp("fast");
                    $("#url_type_1").slideUp("fast");
                    $("#url_type_2").slideUp("fast");
                    $("#url_type_3").slideDown("slow");
                    $("#url_type_4").slideUp("fast");
                }else if(val == "4" || val == 4){
                    $("#url_type_0").slideUp("fast");
                    $("#url_type_1").slideUp("fast");
                    $("#url_type_2").slideUp("fast");
                    $("#url_type_3").slideUp("fast");
                    $("#url_type_4").slideDown("slow");
                }else{
                    $("#url_type_0").slideDown("slow");
                    $("#url_type_1").slideUp("fast");
                    $("#url_type_2").slideUp("fast");
                    $("#url_type_3").slideUp("fast");
                    $("#url_type_4").slideUp("fast");
                }
            });

            $(document).on("click", "#save_button_link", function () {
                $(this).css("background-color", "#AF96D3").css("color", "#512293");
                var val = $("#url_type").val();
                if(val == "1" || val == 1){
                    $(current_btn).removeAttr('data-lightbox');
                    $(current_btn).attr('href', $("#url_to_other_pages").val());
                }else if(val == "2" || val == 2){
                    $(current_btn).removeAttr('data-lightbox');
                    $(current_btn).attr('href', "mailto:" + $("#an_email").val());
                }else if(val == "3" || val == 3){
                    $(current_btn).removeAttr('data-lightbox');
                    $(current_btn).attr('href', "tel:" + $("#mobile_phone").val());
                }else if(val == "4" || val == 4){
                    $(current_btn).attr('data-lightbox', "iframe");
                    $(current_btn).attr('href',  $("#video_url_youtube_or_vimeo").val());
                }else{
                    $(current_btn).removeAttr('data-lightbox');
                    $(current_btn).attr('href', $("#external_link").val());
                }
                if ($("#open_in_other_window").is(":checked")) {
                    $(current_btn).attr('target', '_blank');
                } else {
                    $(current_btn).attr('target', '');
                }
                setTimeout(function () {
                    $("#save_button_link").css("background-color", "#512293").css("color", "#AF96D3");
                }, 1000);
            });

            $(document).on("change keyup", "#an_email", function(e) {
                var val = $(this).val();
                var re = /^\w+([-+.'][^\s]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
                if(!re.test(val)){
                    $(this).css("border", "1px solid red");
                }else{
                    $(this).css("border", "none");
                }
            });

            $(document).on("change keyup", "#mobile_phone", function(e) {
                var val = $(this).val();
                var re = /^[0-9-+]+$/;
                if(!re.test(val)){
                    $(this).css("border", "1px solid red");
                }else{
                    $(this).css("border", "none");
                }
            });

            $(document).on("change", "#button_type", function(e) {
                var val = $(this).val();
                var _class = $(current_btn).attr("class");
                _class = _class.split(" ");
                $.each(_class, function (i, c) {
                    $.each($("#button_type").find("option"), function (i, e) {
                        var vall = $(e).attr("value");
                        if(c == vall){
                            var index = _class.indexOf(vall);
                            if (index > -1) {
                                _class.splice(index, 1);
                            }
                        }
                    });
                });
                _class.push(val);
                _class = _class.join(" ");
                $(current_btn).attr('class', _class);
            });

            $(document).on("change", "#dispay_block", function(e) {
                if (this.checked) {
                    $(current_btn).addClass('btn-block');
                } else {
                    $(current_btn).removeClass('btn-block');
                }
            });

            $(document).on("change", "#border_width", function(e) {
                var border_width = parseFloat($(this).val());
                $(current_btn).css('border-width', border_width);
            });

            $(document).on("change", "#colorpicker3", function () {
                var color = $(this).val();
                if(!color)
                    $(current_btn).css('background-color', '');
                else{
                    $(current_btn).css('background-color', color);
                }
            });

            $(document).on("change", "#colorpicker4", function () {
                var color = $(this).val();
                if(!color)
                    $(current_btn).css('border-color', '');
                else{
                    $(current_btn).css('border-color', color);
                }
            });

            $(document).on("click", ".close_link_settings", function (e) {
                e.preventDefault();
                $(".settings_link_btn_nav_link").trigger("click");
            });

            $(document).on("change keyup", "#link_text", function (e) {
                $("a", current_link).text($(this).val());
            });

            $(document).on("change", "#font_family2", function(e) {
                var font_family2 = $(this).val();
                if(!font_family2)
                    $("a", current_link).css('font-family', '');
                else{
                    $("a", current_link).css('font-family', '');
                    $("a", current_link).attr('style', function(i,s) { return (s || '') + "font-family : " + font_family2 + " !important;" });
                }
            });

            $(document).on("change", "#font_size2", function(e) {
                var font_size = parseFloat($(this).val());
                $("a", current_link).css('font-size', font_size);
            });

            $(document).on("change", "#font_weight2", function(e) {
                $("a", current_link).css('font-weight', $(this).val());
            });

            $(document).on("change", "#colorpicker5", function () {
                var color = $(this).val();
                $("a", current_link).css("color", color);
            });

            $(document).on("click", ".text_align2", function () {
                $(".text_align2").removeClass("active");
                $(this).addClass("active");
                $("a", current_link).closest(".easy_link").css('text-align', $(this).data("align"));
            });

            $(document).on("change", "#url_type2", function(e) {
                var val = $(this).val();
                if(val == "1" || val == 1){
                    $("#url_type_02").slideUp("fast");
                    $("#url_type_12").slideDown("slow");
                    $("#url_type_22").slideUp("fast");
                    $("#url_type_32").slideUp("fast");
                    $("#url_type_42").slideUp("fast");
                }else if(val == "2" || val == 2){
                    $("#url_type_02").slideUp("fast");
                    $("#url_type_12").slideUp("fast");
                    $("#url_type_22").slideDown("slow");
                    $("#url_type_32").slideUp("fast");
                    $("#url_type_42").slideUp("fast");
                }else if(val == "3" || val == 3){
                    $("#url_type_02").slideUp("fast");
                    $("#url_type_12").slideUp("fast");
                    $("#url_type_22").slideUp("fast");
                    $("#url_type_32").slideDown("slow");
                    $("#url_type_42").slideUp("fast");
                }else if(val == "4" || val == 4){
                    $("#url_type_02").slideUp("fast");
                    $("#url_type_12").slideUp("fast");
                    $("#url_type_22").slideUp("fast");
                    $("#url_type_32").slideUp("fast");
                    $("#url_type_42").slideDown("slow");
                }else{
                    $("#url_type_02").slideDown("slow");
                    $("#url_type_12").slideUp("fast");
                    $("#url_type_22").slideUp("fast");
                    $("#url_type_32").slideUp("fast");
                    $("#url_type_42").slideUp("fast");
                }
            });

            $(document).on("click", "#save_button_link2", function () {
                $(this).css("background-color", "#AF96D3").css("color", "#512293");
                var val = $("#url_type2").val();
                if(val == "1" || val == 1){
                    $("a", current_link).removeAttr('data-lightbox');
                    $("a", current_link).attr('href', $("#url_to_other_pages2").val());
                }else if(val == "2" || val == 2){
                    $("a", current_link).removeAttr('data-lightbox');
                    $("a", current_link).attr('href', "mailto:" + $("#an_email2").val());
                }else if(val == "3" || val == 3){
                    $("a", current_link).removeAttr('data-lightbox');
                    $("a", current_link).attr('href', "tel:" + $("#mobile_phone2").val());
                }else if(val == "4" || val == 4){
                    $("a", current_link).attr('data-lightbox', "iframe");
                    $("a", current_link).attr('href',  $("#video_url_youtube_or_vimeo2").val());
                }else{
                    $("a", current_link).removeAttr('data-lightbox');
                    $("a", current_link).attr('href', $("#external_link2").val());
                }
                if ($("#open_in_other_window2").is(":checked")) {
                    $("a", current_link).attr('target', '_blank');
                } else {
                    $("a", current_link).attr('target', '');
                }
                setTimeout(function () {
                    $("#save_button_link2").css("background-color", "#512293").css("color", "#AF96D3");
                    $(".settings_link_btn_nav_link").trigger("click");
                }, 1000);
            });

            $(document).on("change keyup", "#an_email2", function(e) {
                var val = $(this).val();
                var re = /^\w+([-+.'][^\s]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
                if(!re.test(val)){
                    $(this).css("border", "1px solid red");
                }else{
                    $(this).css("border", "none");
                }
            });

            $(document).on("change keyup", "#mobile_phone2", function(e) {
                var val = $(this).val();
                var re = /^[0-9-+]+$/;
                if(!re.test(val)){
                    $(this).css("border", "1px solid red");
                }else{
                    $(this).css("border", "none");
                }
            });

            $(document).on("click", ".close_form_settings", function (e) {
                e.preventDefault();
                $(".settings_form_btn_nav_link").trigger("click");
            });

            $(document).on("click", "#save_button_form", function (e) {
                e.preventDefault();
                var val         = $("#custom_form").val();
                var website_id  = "{{$website->id}}";
                if(val == 0){
                    $(form_wrapper).find(".custom_form").remove();
                    $(form_wrapper).find(".contact_form").fadeIn("fast");
                    $(".settings_form_btn_nav_link").trigger("click");
                    myHandler();
                }else{
                    var url = "{{route("editor.get_custom_form")}}";
                    $.post(url, {"_token": "{{ csrf_token() }}", "id": val, "website_id" : website_id, "lang" : lang}, function (html) {
                        $(form_wrapper).find(".contact_form").fadeOut("fast");
                        $(form_wrapper).find(".custom_form").remove();
                        $(form_wrapper).prepend(html);
                        $(".settings_form_btn_nav_link").trigger("click");
                        myHandler();
                    });
                }
            });

            $(document).on("click", ".close_image_settings", function (e) {
                e.preventDefault();
                $(".settings_image_btn_nav_link").trigger("click");
            });

            $(document).on("click", ".close_video_settings", function (e) {
                e.preventDefault();
                $(".settings_video_btn_nav_link").trigger("click");
            });

            $(document).on("click", ".close_gmap_settings", function (e) {
                e.preventDefault();
                $(".settings_gmap_btn_nav_link").trigger("click");
            });

            $(document).on("click", "#save_button_gmap", function (e) {
                e.preventDefault();
                var val         = $("#google_map_link").val();
                if(current_map && val != ""){
                    $(current_map).html(val);
                    current_map = null;
                }
                $(".settings_gmap_btn_nav_link").trigger("click");
            });

            function get_images(){
                images              = [];
                images_categories   = [];
                $("#list-gallery-image1").html("");
                $("#image_categories").html('<option value="0">{{__("l.all")}}</option>');
                var url = "{{route("image_api")}}";
                $.get(url, function (data) {

                    if(data.images && data.images.length > 0) {

                        $.each(data.images, function (i, img) {
                            images.push({
                                "name": img.name_{{app()->getLocale()}},
                                "url": img.url,
                                "category_id": img.category_id
                            });
                        });

                        $.each(images, function (i, img) {
                            var image_box = $("#col-single-image-wrapper .col-single-image").clone();
                            $(image_box).attr("data-cat0", img.category_id);
                            $(image_box).attr("data-name0", img.name);
                            $(image_box).find(".image_name").html(img.name);
                            $(image_box).find(".widght-single-image img").attr("src", img.url);
                            $("#list-gallery-image1").append(image_box);
                        });
                    }

                    if(data.categories && data.categories.length > 0){

                        $.each(data.categories, function (i, cat) {
                            images_categories.push({"name" : cat.name_{{app()->getLocale()}}, "id" : cat.id });
                        });

                        $.each(images_categories, function (i, cat) {
                            var cat_option = '<option value="'+cat.id+'">'+cat.name+'</option>';
                            $("#image_categories").append(cat_option);
                        });

                    }

                });
            }

            get_images();

            function filter_images(){
                var cat     = $("#image_categories").val()+"";
                var name    = $("#image_search").val()+"";
                $("#list-gallery-image1 .col-single-image").hide();
                $("#list-gallery-image1 .col-single-image").filter(function (i, el) {
                    var catx = true;
                    if(cat != "0"){
                        var cat0 = $(el).attr("data-cat0")+"";
                        if(cat != cat0)
                            catx = false;
                    }
                    var namex = true;
                    if(name != ""){
                        var name0 = $(el).attr("data-name0")+"";
                        if(!name0.includes(name))
                            namex = false;
                    }

                    return ( catx && namex );
                }).show();
            }

            $(document).on("change", "#image_categories", function () {
                filter_images();
            });

            $(document).on("change paste keyup", "#image_search", function () {
                filter_images();
            });

            $(document).on("click", ".widght-single-image0", function () {
                $(".widght-single-image").removeClass("active");
                $(this).addClass("active");
                chosen_image1 = $("img", this).attr("src");
                $("#image_popup_save").removeClass("disabled");
            });

            $(document).on("click", "#image_popup_save", function () {
                if(chosen_image1 && current_image){
                    if($(current_image).hasClass("easy_image")){
                        $("img", current_image).attr("src", chosen_image1);
                    }else if($(current_image).hasClass("section")){
                        $(current_image).css("background-image", 'url('+chosen_image1+')');
                    }
                    $(".settings_image_btn_nav_link").trigger("click");
                    chosen_image1 = null;
                    current_image = null;
                }
            });

            function get_videos(){
                videos              = [];
                videos_categories   = [];
                $("#list-gallery-video1").html("");
                $("#video_categories").html('<option value="0">{{__("l.all")}}</option>');
                var url = "{{route("video_api")}}";
                $.get(url, function (data) {

                    if(data.videos && data.videos.length > 0) {

                        $.each(data.videos, function (i, vid) {
                            videos.push({
                                "name": vid.name_{{app()->getLocale()}},
                                "url": vid.url,
                                "category_id": vid.category_id
                            });
                        });

                        $.each(videos, function (i, vid) {
                            var video_box = $("#col-single-video-wrapper .col-single-image").clone();
                            $(video_box).attr("data-cat0", vid.category_id);
                            $(video_box).attr("data-name0", vid.name);
                            $(video_box).find(".image_name").html(vid.name);
                            $(video_box).find(".widght-single-image iframe").attr("src", vid.url);
                            $("#list-gallery-video1").append(video_box);
                        });
                    }

                    if(data.categories && data.categories.length > 0){

                        $.each(data.categories, function (i, cat) {
                            videos_categories.push({"name" : cat.name_{{app()->getLocale()}}, "id" : cat.id });
                        });

                        $.each(videos_categories, function (i, cat) {
                            var cat_option = '<option value="'+cat.id+'">'+cat.name+'</option>';
                            $("#video_categories").append(cat_option);
                        });

                    }

                });
            }

            get_videos();

            function filter_videos(){
                var cat     = $("#video_categories").val()+"";
                var name    = $("#video_search").val()+"";
                $("#list-gallery-video1 .col-single-image").hide();
                $("#list-gallery-video1 .col-single-image").filter(function (i, el) {
                    var catx = true;
                    if(cat != "0"){
                        var cat0 = $(el).attr("data-cat0")+"";
                        if(cat != cat0)
                            catx = false;
                    }
                    var namex = true;
                    if(name != ""){
                        var name0 = $(el).attr("data-name0")+"";
                        if(!name0.includes(name))
                            namex = false;
                    }

                    return ( catx && namex );
                }).show();
            }

            $(document).on("change", "#video_categories", function () {
                filter_videos();
            });

            $(document).on("change paste keyup", "#video_search", function () {
                filter_videos();
            });

            $(document).on("click", ".widght-single-video0", function () {
                $(".widght-single-image").removeClass("active");
                $(this).addClass("active");
                chosen_video1 = $("iframe", this).attr("src");
                $("#video_popup_save").removeClass("disabled");
            });

            $(document).on("click", "#video_popup_save", function () {
                if(chosen_video1 && current_video){
                    if($(current_video).hasClass("easy_video")){
                        $("iframe", current_video).attr("src", chosen_video1);
                    }
                    $(".settings_video_btn_nav_link").trigger("click");
                    chosen_video1 = null;
                    current_video = null;
                }
            });

            function savepage(s = null, reload = false) {
                var iframe = $('#frame_wrap').contents();
                //var html = window.frames[0].document.body;
                var html = $('#frame_wrap').contents().find("body");
                var status = (s) ? ($(s).hasClass("public")) ? 1 : 0 : 1;
                iframe.contents().find(".main-sticky-toolbar2,.main-sticky-toolbar3, .main-editor-tools, .main-editor-tools-icon, .main-editor-tools-btn, .main-editor-tools-link, .main-editor-tools-image, main-editor-tools-video").remove();
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
                            if(reload)
                                document.getElementById("frame_wrap").contentDocument.location.reload(true);
                            get_images();
                            get_videos();
                        });
                    });
                }, 1000);
            }

            // upload_image
            $(document).on("submit", "#images_upload_form", function (e) {
                e.preventDefault();
                var file_data   = $("#images_upload_form .file").prop('files')[0];
                var form_data   = new FormData();
                form_data.append('_token', "{{csrf_token()}}");
                form_data.append('file', file_data);
                var url         = $(this).attr("action");
                var form        = $(this);
                $("button[type='submit']", form).prop("disabled", true);
                $.ajax({
                    url: url,
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    type: "POST",
                    processData: false,
                    data: form_data,
                    success: function(url) {
                        $("#images_upload_form").trigger("reset");
                        $("button[type='submit']", form).prop("disabled", false);
                        $("#my_images_wrapper").load(window.location + " #my_images_div");
                    }
                });
            });

            $(document).on("click", ".widght-single-image1", function () {
                $(".widght-single-image").removeClass("active");
                $(this).addClass("active");
                chosen_image1 = $("img", this).attr("src");
                $("#image_popup_save2").removeClass("disabled");
            });

            $(document).on("click", "#image_popup_save2", function () {
                if(chosen_image1 && current_image){
                    if($(current_image).hasClass("easy_image")){
                        $("img", current_image).attr("src", chosen_image1);
                    }else if($(current_image).hasClass("section")){
                        $(current_image).css("background-image", 'url('+chosen_image1+')');
                    }
                    $(".settings_image_btn_nav_link").trigger("click");
                    chosen_image1 = null;
                    current_image = null;
                }
            });

            $(document).on("click", ".widght-single-image1 .remove_image", function (e) {
                e.preventDefault();
                e.stopPropagation();
                var image = $(this).data("image");
                var url = '{{route("editor.images_upload_delete")}}';
                var form_data   = new FormData();
                form_data.append('_token', "{{csrf_token()}}");
                form_data.append('image', image);
                $(this).confirm({
                    conf : function () {
                        $.ajax({
                            url: url,
                            dataType: 'text',
                            cache: false,
                            contentType: false,
                            type: "POST",
                            processData: false,
                            data: form_data,
                            success: function(url) {
                                $("#my_images_wrapper").load(window.location + " #my_images_div");
                            }
                        });
                    }
                });
            });

            // upload_video

            function parseVideo (url) {
                // - Supported YouTube URL formats:
                //   - http://www.youtube.com/watch?v=My2FRPA3Gf8
                //   - http://youtu.be/My2FRPA3Gf8
                //   - https://youtube.googleapis.com/v/My2FRPA3Gf8
                // - Supported Vimeo URL formats:
                //   - http://vimeo.com/25451551
                //   - http://player.vimeo.com/video/25451551
                // - Also supports relative URLs:
                //   - //player.vimeo.com/video/25451551

                url.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/);

                if (RegExp.$3.indexOf('youtu') > -1) {
                    var type = 'youtube';
                } else if (RegExp.$3.indexOf('vimeo') > -1) {
                    var type = 'vimeo';
                }else{
                    return {
                        type : "video",
                        id : url
                    }
                }

                return {
                    type: type,
                    id: RegExp.$6
                };
            }

            function createVideo (url, width, height) {
                // Returns an iframe of the video with the specified URL.
                var videoObj = parseVideo(url);
                var $iframe = $('<iframe>', { width: width, height: height });
                $iframe.attr('frameborder', 0);
                if (videoObj.type == 'youtube') {
                    $iframe.attr('src', '//www.youtube.com/embed/' + videoObj.id);
                } else if (videoObj.type == 'vimeo') {
                    $iframe.attr('src', '//player.vimeo.com/video/' + videoObj.id);
                }else{
                    //$iframe.attr('src', videoObj.id);
                    return "";
                }
                return $iframe;
            }

            $(document).on("change paste keyup blur", "#video_url_youtube_or_vimeo", function () {
                var url     =  $(this).val();
                //var html    = '<img src="'+url+'" style="width: 100%; height: 100%;">';
                var html    = createVideo (url, "100%", "300")
                $("#video_preview").html(html);
            });

            $(document).on("click", ".widght-single-video1", function () {
                $(".widght-single-image").removeClass("active");
                $(this).addClass("active");
                chosen_video1 = $("iframe", this).attr("src");
                $("#video_popup_save2").removeClass("disabled");
            });

            $(document).on("click", "#video_popup_save2", function () {
                if(chosen_video1 && current_video){
                    if($(current_video).hasClass("easy_video")){
                        $("iframe", current_video).attr("src", chosen_video1);
                    }
                    $(".settings_video_btn_nav_link").trigger("click");
                    chosen_video1 = null;
                    current_video = null;
                }
            });

            $(document).on("submit", "#videos_upload_form", function (e) {
                e.preventDefault();
                var file_data   = $("#videos_upload_form input").val();
                var form_data   = new FormData();
                form_data.append('_token', "{{csrf_token()}}");
                form_data.append('video_url_youtube_or_vimeo', file_data);
                var url         = $(this).attr("action");
                var form        = $(this);
                $("button[type='submit']", form).prop("disabled", true);
                $("#video_preview").html("");
                $.ajax({
                    url: url,
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    type: "POST",
                    processData: false,
                    data: form_data,
                    success: function(url) {
                        $("#videos_upload_form").trigger("reset");
                        $("button[type='submit']", form).prop("disabled", false);
                        $("#my_videos_wrapper").load(window.location + " #my_videos_div");
                    }
                });
            });

            $(document).on("click", ".widght-single-video1 .remove_video", function (e) {
                e.preventDefault();
                e.stopPropagation();
                var id = $(this).data("id");
                var url = '{{route("editor.videos_upload_delete")}}';
                var form_data   = new FormData();
                form_data.append('_token', "{{csrf_token()}}");
                form_data.append('id', id);
                $(this).confirm({
                    conf : function () {
                        $.ajax({
                            url: url,
                            dataType: 'text',
                            cache: false,
                            contentType: false,
                            type: "POST",
                            processData: false,
                            data: form_data,
                            success: function(url) {
                                $("#my_videos_wrapper").load(window.location + " #my_videos_div");
                            }
                        });
                    }
                });

            });

            // Change Font
            $(document).on("click", ".change_font", function (e) {
                e.preventDefault();
                e.stopPropagation();
                var font = $(this).data("font");
                var url = '{{route("editor.change_font")}}';
                var form_data   = new FormData();
                form_data.append('_token', "{{csrf_token()}}");
                form_data.append('font', font);
                form_data.append('id', "{{$website->id}}");
                $(this).confirm({
                    conf : function () {
                        $.ajax({
                            url: url,
                            dataType: 'text',
                            cache: false,
                            contentType: false,
                            type: "POST",
                            processData: false,
                            data: form_data,
                            success: function(url) {
                                $(".fonts_link .widget__item-option-icon").html('<i class="fas fa-spinner fa-spin"></i>');
                                $(".fonts_link").trigger("click");
                                savepage(null, true);
                            }
                        });
                    }
                });
            });

            // Change Colors
            $(document).on("click", ".add_new_color", function (e) {
                e.preventDefault();
                $(".colors_widget").hide();
                $(".colors_add").show();
            });

            $(document).on("click", ".show_colors_list", function (e) {
                e.preventDefault();
                $(".colors_widget").hide();
                $(".colors_list").show();
            });

            $(document).on("submit", ".save_color", function (e) {
                e.preventDefault();
                var url = $(this).attr("action");
                var form_data   = new FormData();
                form_data.append("_token", "{{csrf_token()}}");
                form_data.append("name", $(".name", this).val());
                form_data.append("color1", $(".color1", this).val());
                form_data.append("color2", $(".color2", this).val());
                $(this).confirm({
                    conf : function () {
                        $.ajax({
                            url: url,
                            dataType: 'text',
                            cache: false,
                            contentType: false,
                            type: "POST",
                            processData: false,
                            data: form_data,
                            success: function(url) {
                                $("#header1").load(window.location + " #header2", function () {
                                    relaoding();
                                    get_images();
                                    get_videos();
                                    $(".colors_link").trigger("click");
                                });
                            }
                        });
                    }
                });
            });

            $(document).on("click", ".change_color_default", function (e) {
                e.preventDefault();
                var url = '{{route("editor.change_color_default")}}';
                var id = $(this).data("id") ? $(this).data("id") : "0";
                var form_data   = new FormData();
                form_data.append("_token", "{{csrf_token()}}");
                form_data.append("website_id", "{{$website->id}}");
                form_data.append("color_id", id);
                $(this).confirm({
                    conf : function () {
                        $.ajax({
                            url: url,
                            dataType: 'text',
                            cache: false,
                            contentType: false,
                            type: "POST",
                            processData: false,
                            data: form_data,
                            success: function(url) {
                                $(".colors_link").trigger("click");
                                $(".colors_link .widget__item-option-icon").html('<i class="fas fa-spinner fa-spin"></i>');
                                savepage(null, true);
                            }
                        });
                    }
                });
            });

            $(document).on("click", ".colors_edit_btn", function (e) {
                e.preventDefault();
                var id = $(this).data("id");
                $(".colors_widget").hide();
                $(".colors_edit"+id).show();
            });

            $(document).on("submit", ".update_color", function (e) {
                e.preventDefault();
                var url = $(this).attr("action");
                var form_data   = new FormData();
                form_data.append("_token", "{{csrf_token()}}");
                form_data.append("color_id", $(".color_id", this).val());
                form_data.append("name", $(".name", this).val());
                form_data.append("color1", $(".color1", this).val());
                form_data.append("color2", $(".color2", this).val());
                $(this).confirm({
                    conf : function () {
                        $.ajax({
                            url: url,
                            dataType: 'text',
                            cache: false,
                            contentType: false,
                            type: "POST",
                            processData: false,
                            data: form_data,
                            success: function(url) {
                                $(".colors_link .widget__item-option-icon").html('<i class="fas fa-spinner fa-spin"></i>');
                                savepage(null, true);
                            }
                        });
                    }
                });
            });

            $(document).on("click", ".remove_color", function (e) {
                e.preventDefault();
                var url = '{{route("editor.remove_color")}}';
                var id = $(this).data("id");
                var form_data   = new FormData();
                form_data.append("_token", "{{csrf_token()}}");
                form_data.append("website_id", "{{$website->id}}");
                form_data.append("color_id", id);
                $(this).confirm({
                    conf : function () {
                        $.ajax({
                            url: url,
                            dataType: 'text',
                            cache: false,
                            contentType: false,
                            type: "POST",
                            processData: false,
                            data: form_data,
                            success: function(url) {
                                $(".colors_link .widget__item-option-icon").html('<i class="fas fa-spinner fa-spin"></i>');
                                savepage(null, true);
                            }
                        });
                    }
                });
            });



        });

    </script>

@endsection
