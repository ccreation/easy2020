<div id="gotoTop" class="fa fa-angle-up"></div>

<!-- External JavaScripts
============================================= -->
<script src="{{asset("public/easy/assets/js/plugins.js")}}"></script>

<!-- Footer Scripts
============================================= -->
<script src="{{asset("public/easy/assets/js/functions.js")}}"></script>
<script src="{{asset("public/easy/assets/js/components/moment.js")}}"></script>
<script src="{{asset("public/easy/assets/js/plugins/jquery.countdown-ar.js")}}"></script>
<script src="{{asset("public/easy/assets/classycountdown/js/jquery.classycountdown.js")}}"></script>
<script src="{{asset("public/easy/assets/classycountdown/js/jquery.knob.js")}}"></script>
<script src="{{asset("public/easy/assets/classycountdown/js/jquery.throttle.js")}}"></script>

<script src="{{asset("public/easy/assets/tinymce/tinymce.min.js")}}"></script>
<script src="{{asset("public/easy/assets/tinymce/jquery.tinymce.min.js")}}"></script>
<link rel="stylesheet" href="{{asset("public/easy/assets/tinymce/skins/ui/oxide-dark/skin.min.css")}}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/css/fontawesome-iconpicker.min.css" integrity="sha256-yExEWA6b/bqs3FXxQy03aOWIFtx9QEVnHZ/EwemRLbc=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/js/fontawesome-iconpicker.min.js" integrity="sha256-QvBM3HnWsvcCWqpqHZrtoefjB8t2qPNzdSDNyaSNH5Q=" crossorigin="anonymous"></script>
<!-- spectrum -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css" integrity="sha256-f83N12sqX/GO43Y7vXNt9MjrHkPc4yi9Uq9cLy1wGIU=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js" integrity="sha256-ZdnRjhC/+YiBbXTHIuJdpf7u6Jh5D2wD5y0SNRWDREQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/i18n/jquery.spectrum-ar.min.js" integrity="sha256-G9DxgmWSMo2EI2Ow3A8sqWGgTEDZ0VK0G+GB/u0MRF0=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>

<script src="{{asset("public/notif/notifIt.min.js")}}"></script>
<link rel="stylesheet" href="{{asset("public/notif/notifIt.min.css")}}">

<script>

    $(function () {

        var w = window;
        if (w.frameElement != null
            && w.frameElement.nodeName === "IFRAME"
            && w.parent.jQuery) {
            w.parent.jQuery(w.parent.document).trigger('iframeready');
        }

        $(document).on("click", '.toggle-sticky-toolbar2', function(){ $('.main-sticky-toolbar2').toggleClass('sticky-toolbar-active'); });

        var handler_link = function(event){
            if($(event.target).is(".main-editor-tools, .main-editor-tools *")) return;
            $(".main-editor-tools").css("display", "none");
        }
        $(document).on("click", handler_link);
        var handler_icon = function(event){
            if($(event.target).is(".main-editor-tools-icon, .main-editor-tools-icon *")) return;
            $(".main-editor-tools-icon").css("display", "none");
        }
        $(document).on("click", handler_icon);
        var handler_btn = function(event){
            if($(event.target).is(".main-editor-tools-btn, .main-editor-tools-btn *")) return;
            $(".main-editor-tools-btn").css("display", "none");
        }
        $(document).on("click", handler_btn);
        var handler_link = function(event){
            if($(event.target).is(".main-editor-tools-link, .main-editor-tools-link *")) return;
            $(".main-editor-tools-link").css("display", "none");
        }
        $(document).on("click", handler_link);
        var handler_form = function(event){
            if($(event.target).is(".main-editor-tools-form, .main-editor-tools-form *")) return;
            $(".main-editor-tools-form").css("display", "none");
        }
        $(document).on("click", handler_form);
        var handler_image = function(event){
            if($(event.target).is(".main-editor-tools-image, .main-editor-tools-image *")) return;
            $(".main-editor-tools-image").css("display", "none");
        }
        $(document).on("click", handler_image);
        var handler_video = function(event){
            if($(event.target).is(".main-editor-tools-video, .main-editor-tools-video *")) return;
            $(".main-editor-tools-video").css("display", "none");
        }
        $(document).on("click", handler_video);

    });

    function front_destroying() {
        //$(".easy_text").tinymce("destroy");
        $("body *").removeAttr("contenteditable");
        $("body *").removeAttr("highlighted");
        if(typeof(tinyMCE) !== 'undefined') {
            var length = tinyMCE.editors.length;
            for (var i=length; i>0; i--) {
                tinyMCE.editors[i-1].remove();
            };
        }
    }

    function easy_text(s) {
        setTimeout(function () {
            $(s).addClass("contenteditable");
            if($(s).hasClass("easy_text")){
                $(s).tinymce({
                    language : "{{$lang}}",
                    menubar: false,
                    toolbar: false,
                    inline: true,
                    skin: "oxide-dark",
                    plugins: [
                        'lists',
                        'link',
                        'quickbars'
                    ],
                    quickbars_selection_toolbar: 'undo redo | bold italic underline | forecolor backcolor | quicklink unlink | bullist | alignleft aligncenter alignright alignjustify alignnone fontselect fontsizeselect',
                    font_formats: 'درويد كوفي =Droid Arabic Kufi;' +
                        'أميري=Amiri;' +
                        'كايرو=Cairo;' +
                        'Tajawal;' +
                        'Changa;' +
                        'Lalezar;' +
                        'Changa;' +
                        'المصيري=El Messiri;' +
                        'ريم كوفي=Reem Kufi;' +
                        'لطيف=Lateef;' +
                        'Scheherazade;' +
                        'ليموناضة=Lemonada;' +
                        'مركزي تكست=Markazi Text;' +
                        'Mada;' +
                        'Baloo Bhaijaan;' +
                        'Mirza;' +
                        'رافع الرقعة=Aref Ruqaa;' +
                        'Harmattan;' +
                        'كتيبة=Katibeh;' +
                        'Rakkas;' +
                        'Jomhuria'
                });
            }
        }, 100);
    }

</script>

{{--
<script>

    var images          = [];
    @if(@$images)
        @foreach($images as $image)
            var url = '{{$image->url}}';
            images.push({title: '{{$image->name_ar}}', value: url});
        @endforeach
    @endif
    var default_image   = "{{asset("public/no-image2.png")}}";
    var _token          = "{{csrf_token()}}";

    function front_destroying() {
        $(".countdown-ex1").countdown('destroy');
        $portfolioFilter = $('.portfolio-filter,.custom-filter');
        $("li", $portfolioFilter).removeClass("activeFilter");
        $("li:first-child", $portfolioFilter).addClass("activeFilter");
        $("li:first-child a", $portfolioFilter).trigger("click");
        $(".tab-nav li").removeClass("ui-tabs-active ui-state-active");
        $(".tab-nav li:first-child a").trigger("click");
        SEMICOLON.widget.destroy_carousel();
        SEMICOLON.widget.destroyFlexSlider();
        SEMICOLON.documentOnReady.destroy_isotop();
        //
        $(".iconpicker_element, .iconpicker-popover").remove();
    }

    function front_reloading_init() {
        $.each($(document).find(".countdown-ex1"), function (i, el) {
            var date = $(el).data("date");
            var newDate = new Date(date);
            $(el).countdown({until: newDate});
        });
        $('#linked-to-gallery a').click(function() {
            var imageLink = $(this).attr('data-image');
            var oc_images = $(this).closest('section.section').find("#oc-images");
            jQuery(oc_images).trigger('to.owl.carousel', [Number(imageLink) - 1, 300, true]);
            return false;
        });
        $.each($(document).find(".countdown-ex2"), function (i, el) {
            $(el).html("");
            var date = $(el).closest(".datadate").data("date");
            var newDate = new Date(date);
            var seconds = (newDate.getTime() - new Date().getTime()) / 1000;
            $(el).ClassyCountdown({
                theme: "white-wide",
                end: $.now() + parseInt(seconds),
                labelsOptions: {
                    lang: {
                        days: 'يوم',
                        hours: 'ساعة',
                        minutes: 'دقيقة',
                        seconds: 'ثانية'
                    }
                }
            });
        });
        $.each($(document).find("form.contact_form, form.custom_form"), function (i, el) {
            $(el).find("input[name='_token']").remove();
            var _token_input = '<input type="hidden" name="_token" value="'+_token+'">';
            $(el).append(_token_input);

        });
    }

    $(function() {

        var w = window;
        if (w.frameElement != null
            && w.frameElement.nodeName === "IFRAME"
            && w.parent.jQuery) {
            w.parent.jQuery(w.parent.document).trigger('iframeready');
        }

        front_reloading_init();

        $(document).on("click", ".easy_image", function () {
            var range = document.createRange();
            range.selectNodeContents($(this).get( 0 ));
            var sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);
        });
        $(document).on("click", ".choose_image", function () {
            $(".choose_image img").removeClass("active");
            var src = $(this).data("src");
            $(".tiny_mce_image_list select").val(decodeURIComponent(src));
            $(".tiny_mce_image_list select").trigger("change");
            $(this).find("img").addClass("active");
            $(this).closest(".tox-form__group").prev(".tox-form__group").find("input").val(decodeURIComponent(src));
        })


    });

    function front_reloading() {
        front_destroying();
        SEMICOLON.documentOnReady.init();
        SEMICOLON.documentOnLoad.init();
        SEMICOLON.documentOnResize.init();
        front_reloading_init();
        $(".tab-nav li:first-child a").trigger("click");
        $(".tab-nav li:first-child").addClass("ui-tabs-active ui-state-active");
    }

    function easy_icon(s) {
        var icon = $("i", s).attr("class");
        $('.iconpicker_element').val(icon);
        $('.iconpicker_element').iconpicker({hideOnSelect:true, container: ".iconpicker_container", collision: true, animation: false,
            icons: [
                {
                    title: "fas fa-home",
                    searchTerms: ['منزل', 'home', 'homepage']
                },
                {
                    title: "fab fa-facebook",
                    searchTerms: ['فايسبوك']
                },
                {
                    title: "fab fa-youtube",
                    searchTerms: ['يوتيوب', 'موقع','فيديو']
                },
            ]
        });
        $(".popover-title input").attr("placeholder", "{{__("l.search")}}...");
        $('.iconpicker_element').trigger("focus");
        $(".iconpicker_element").off("iconpickerSelected");
        $('.iconpicker_element').on("iconpickerSelected", function(event){
            var val = $(this).val();
            $("i", s).attr("class", val);
        });
    }

    function easy_icon22(s) {
        var icon = $("i", s).attr("class");
        $('.iconpicker_element22').val(icon);
        $('.iconpicker_element22').iconpicker({hideOnSelect:true, container: ".iconpicker_container22", collision: true, animation: false});
        $(".popover-title input").attr("placeholder", "{{__("l.search")}}...");
        $('.iconpicker_element22').trigger("focus");
        $(".iconpicker_element22").off("iconpickerSelected");
        $('.iconpicker_element22').on("iconpickerSelected", function(event){
            var val = $(this).val();
            $("i", s).attr("class", val);
        });
    }



    function easy_image(s){
        setTimeout(function () {
            if($(s).hasClass("easy_image")){
                $(s).tinymce({
                    language : "{{$frontLang}}",
                    menubar: false,
                    inline: true,
                    themes: "modern",
                    plugins: [
                        'image',
                        'quickbars',
                        'imagetools'
                    ],
                    toolbar: false,
                    quickbars_insert_toolbar: false,
                    quickbars_selection_toolbar: 'undo redo editimage fliph flipv rotateleft rotateright imageoptions',
                    image_list: images,
                    image_advtab: true,
                    image_description: false,
                    image_uploadtab: false,
                    imagetools_proxy: '{{route("website.proxy", [$website->slug, $l])}}',
                    setup: function (editor) {
                        editor.on('change', function (e) {
                            if($(s).hasClass("easy_image_settings")){
                                var src = $("img", s).attr("src");
                                if( src && src != default_image){
                                    var add_block = $(s).closest(".add_block");
                                    var section = $(add_block).prev("section.section");
                                    $(section).css("background-image", 'url('+src+')');
                                }
                            }
                        });
                    }
                });
            }
        }, 1000);
    }

    function easy_image_settings(s) {
        /*var img = $(s).get(0);
        MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
        var ovserver =  new MutationObserver(function onSrcChange(){
            var src = $(img).attr("src");
            if(src != default_image){
                alert(src);
                remove_observer();
            }
        }).observe(img,{attributes:true,attributeFilter:["src"]});
        function remove_observer() {
            observer.disconnect();
        }*/
    }

    function init_color_picker(btn = null) {
        $(".colorpicker, .colorpicker2, .colorpicker3, .colorpicker4").spectrum({
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
        $(document).on("change", "input.colorpicker", function () {
            var color = $(this).val();
            var add_block = $(this).closest(".add_block");
            var section = $(add_block).prev("section.section");
            $(".background_color_div", section).remove();
            var background_color_div = '<div class="background_color_div" style="background: '+color+'; position: absolute; width: 100%; height: 100%; top: 0px; left: 0px; bottom: 0px; right: 0px"></div>';
            $(section).prepend(background_color_div);
        });
        $(document).off('change', 'input.colorpicker2');
        $(document).off('change', 'input.colorpicker3');
        $(document).off('change', 'input.colorpicker4');
        if(btn){
            //$("input.colorpicker2, input.colorpicker3").unbind("change");
            $(document).on("change", "input.colorpicker2", function () {
                var color = $(this).val();
                if(!color)
                    $(btn).css('color', '');
                else{
                    $(btn).css('color', '');
                    setTimeout(function () {
                        $(btn).attr('style', function(i,s) { return (s || '') + "color : " + color + " !important;" });
                    }, 200);
                }
            });
            $(document).on("change", "input.colorpicker3", function () {
                var color = $(this).val();
                if(!color)
                    $(btn).css('background-color', '');
                else{
                    $(btn).css('background-color', color);
                }
            });
            $(document).on("change", "input.colorpicker4", function () {
                $(btn).css('border', '2px solid transparent');
                var color = $(this).val();
                if(!color)
                    $(btn).css('border-color', '');
                else{
                    $(btn).css('border-color', color);
                }
            });
        }
    }

    $(function () {

        $('.selectpicker').selectpicker();

        function goNotif(type, text){
            notif({msg: text, type: type});
        }

        $(document).on("submit", "form.contact_form, form.custom_form", function (e) {
            e.preventDefault();
            var form    = $(this)
            var url     = $(this).attr("action");
            var data    = $(this).serialize();
            $(this).find("button").prop("disabled", true);
            $.post(url, data, function (e) {
                goNotif("success", "{{__("l.success_send")}}");
                $(form).trigger("reset");
            }).fail(function() {
                goNotif("error", "{{__("l.post_error")}}");
            }).always(function () {
                $(form).find("button").prop("disabled", false);
            });
        });

        var handler_link = function(event){
            if($(event.target).is(".add_link, .add_link *")) return;
            $(".add_link, .easy_popup2").css("display", "none");
        }

        $(document).on("click", handler_link);



        var handler_form = function(event){
            if($(event.target).is(".add_form, .add_form *")) return;
            $(".add_form, .easy_popup4").css("display", "none");
        }

        $(document).on("click", handler_form);

    });

</script>

<style>


    /* Add Block */
    .tabbable .nav-tabs {
        overflow-x: auto;
        overflow-y:hidden;
        flex-wrap: nowrap;
    }
    .tabbable .nav{
        border-bottom: none !important;
    }
    .tabbable .nav-tabs::-webkit-scrollbar, .tabbable .nav-tabs::-webkit-scrollbar-track, .tabbable .nav-tabs::-webkit-scrollbar-thumb{
        border-radius: 0px;
        height: 10px;
        cursor: pointer;
    }
    .tabbable .nav-link {
        min-width: 180px !important;
        border-radius: 0px !important;
        border: 1px solid #fff;
        border-bottom: none;
        padding: 8px;
        font-size: 0.95em;
        font-weight: bold;
    }
    .tabbable-settings .nav{
        border-bottom: 1px solid #fff !important;
    }
    .tabbable-settings .nav-link{
        width: 33.33% !important;
        min-width: inherit !important;
        border-bottom: 1px solid #fff !important;
        float: none;
    }
    .tabbable .nav-link:not(.active){
        color: #fff !important;
    }
    .blocks, .settings{
        display: none;
        background: #222f3e;
        color: #fff;
        margin: 0px auto;
        width: 100%;
        height: 390px;
        overflow-y: auto;
        padding: 30px 0px;
        padding-bottom: 0px;
        border: 3px solid #222f3e;
        border-bottom-width: 20px;
    }
    .settings{
        width: 520px;
    }
    .blocks h4, .settings h4{
        text-align: center;
        color: #fff;
    }
    .block{
        width: 100%;
        height: 110px;
        display: block;
        margin-top: 5px;
        margin-bottom: 20px;
        border: 1px solid #eee;
    }
    .block img{
        width: 100%;
        height: 100%;
    }
    .add_block{
        width: 100%;
        height: 3px;
        background: #222f3e;
        text-align: center;
        z-index: 2000;
        position: relative;
    }
    .add_block_btn, .copy_block_btn, .delete_block_btn, .settings_block_btn, .up_block_btn, .down_block_btn{
        position: absolute;
        top: -25px;
        bottom: 0px;
        left: 0px;
        right: 49%;
        background: #222f3e;
        display: block;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        transition: 0.25s transform ease;
        z-index: 1;
        border:1px solid #eee;
    }
    .copy_block_btn, .delete_block_btn, .settings_block_btn, .up_block_btn, .down_block_btn{
        right: 45%;
        width: 40px;
        height: 40px;
        top: -20px;
    }
    .settings_block_btn{
        right: 41%;
    }
    .delete_block_btn{
        right: 53.8%;
    }
    .up_block_btn{
        right: 57.8%;
    }
    .down_block_btn{
        right: 61.8%;
    }

    .add_block_btn:hover, .copy_block_btn:hover, .delete_block_btn:hover, .settings_block_btn:hover, .up_block_btn:hover, .down_block_btn:hover{
        background: #43506c;
    }
    .add_block_btn .fas, .copy_block_btn .fas, .delete_block_btn .fas, .settings_block_btn .fas, .up_block_btn .fas, .down_block_btn .fas{
        color: #fff;
        font-size: 2em;
        line-height: 50px;
        font-style: inherit;
    }
    .copy_block_btn .fas, .delete_block_btn .fas, .settings_block_btn .fas, .up_block_btn .fas, .down_block_btn .fas{
        font-size: 1.4em;
        line-height: 40px;
    }
    /* Edit TEXT, Image & ICON */
    .contenteditable{
        background: rgba(118, 58, 150, 0.24);
    }

    .easy_image{
        visibility: visible !important;
    }
    .tox .tox-tbtn--bespoke .tox-tbtn__select-label{
        width: 60px !important;
    }
    .iconpicker-popover{
        width: 100% !important;
        max-width: inherit !important;
        background: #43506c !important;
        z-index: 9999 !important;
        border: none !important;
        margin-top: -10px !important;
        display: block !important;
    }
    .iconpicker-popover .arrow{
        display: none !important;
    }
    .iconpicker-popover *{
        z-index: 9999 !important;
    }
    .popover-title, .iconpicker-items{
        background: #43506c !important;
    }
    .popover-title{
        display: block !important;
        border: none !important;
        padding-top: 0px !important;
    }
    .iconpicker-item {
        width: 17px !important;
        height: 17px !important;
        background: #fff;
    }
    .iconpicker-item i{
        font-size: 17px !important;
        color: #222f3e !important;
        line-height: 17px !important;
    }
    .iconpicker-popover.popover.bottom>.arrow:after, .iconpicker-popover.popover.bottomRight>.arrow:after, .iconpicker-popover.popover.bottomLeft>.arrow:after{
        border-bottom-color: #222f3e !important;
    }
    .iconpicker .iconpicker-items{
        max-height: 300px;
    }
    .process-steps, .process-steps li{
        overflow: visible;
    }
    .section-features .card{
        overflow: visible;
        z-index: 1;
    }
    .tiny_mce_image_list select{
        display: none;
    }
    .choose_image{
        width: 100% !important;
        height: 170px !important;
        margin-bottom: 10px !important;
    }
    .choose_image img.active{
        border: 3px inset #fff !important;
    }
    .choose_image img{
        width: 96% !important;
        height: 95% !important;
        display: block !important;
        margin: 0px auto !important;
        background: #fff !important;
    }
    .choose_image h6{
        background: #000000a6;
        width: 96%;
        margin: 0px auto;
        font-size: 0.8em;
        padding: 3px;
        height: 15%;
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
    /* Duplicate, Delete, Move Right & Move Left Cols */
    .easy_col{
        position: relative;
    }
    .add_col{
        width: 158px;
        height: 40px;
        background: #222f3e;
        position: absolute;
        top: -36px;
        color: #fff;
        z-index: 111;
        padding: 2px 4px;
    }
    .add_col .triangle{
        position: absolute;
        left: 47.5%;
        margin-left: -5px;
        top: 36px;
        width: 0;
        height: 0;
        border-left: 9px solid transparent;
        border-right: 9px solid transparent;
        border-top: 9px solid #1F2532;
    }
    .copy_col_btn, .delete_col_btn, .right_col_btn, .left_col_btn{
        height: 30px;
        width: 30px;
        background: #fff;
        color: #222f3e;
        display: inline-block;
        margin-top: 3px;
        margin-right: 3px;
        text-align: center;
        line-height: 30px;
        font-size: 1.3em;
        border-radius: 50px;
    }
    .copy_col_btn:hover, .delete_col_btn:hover, .right_col_btn:hover, .left_col_btn:hover{
        color: #43506c;
    }
    .easy_col:first-of-type + .add_col .right_col_btn, .easy_col.last-of-type + .add_col .left_col_btn{
        pointer-events: none;
        cursor: not-allowed;
        background: #bbbbbb !important;
    }

    /* Btn Settings */
    .add_btn{
        width: 130px;
        height: 32px;
        background: #222f3e;
        position: absolute;
        top: -36px;
        color: #fff;
        z-index: 111;
        border-radius: 0px;
    }
    .add_btn .triangle{
        position: absolute;
        left: 47.5%;
        margin-left: -5px;
        top: 32px;
        width: 0;
        height: 0;
        border-left: 9px solid transparent;
        border-right: 9px solid transparent;
        border-top: 9px solid #1F2532;
    }
    .settings_btn_btn{
        height: 30px;
        width: 100%;
        color: #fff;
        display: inline-block;
        text-align: center;
        line-height: 27px;
        font-size: 1.3em;
    }
    .add_btn:hover{
        background: #43506c;
    }
    .add_btn:hover .triangle{
        border-top: 9px solid #43506c;
    }
    .add_btn:hover .settings_btn_btn{
        color: #fff;
    }
    .settings_btn_btn b{
        font-size: 0.9em;
    }
    .easy_popup, .easy_popup2, .easy_popup22, .easy_popup3, .easy_popup4{
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        z-index: 100000;
        display: none;
    }
    .easy_popup_overlay, .easy_popup_overlay2, .easy_popup_overlay22, .easy_popup_overlay3, .easy_popup_overlay4{
        background: #43506c96;
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
    }
    .easy_popup_block, .easy_popup_block2, .easy_popup_block22, .easy_popup_block3, .easy_popup_block4{
        text-align: right !important;
        background: #43506c;
        border: 1px solid #323c51;
        border-radius: 2px;
        color: #fff;
        width: 400px;
        min-height: 300px;
        margin: 20px auto;
        position: absolute;
        left: 0px;
        right: 0px;
        padding-top: 15px;
        padding-bottom: 15px;
    }
    .easy_popup_block .nav-tabs .nav-link, .easy_popup_block2 .nav-tabs .nav-link{
        width: 25% !important;
        font-size: 0.8em;
        text-align: center;
    }
    .easy_popup_block label, .easy_popup_block2 label, .easy_popup_block22 label, .easy_popup_block3 label, .easy_popup_block4 label{
        color: #fff;
        margin: 0px;
    }
    .easy_popup_block .form-control, .easy_popup_block2 .form-control, .easy_popup_block3 .form-control, .easy_popup_block22 .form-control, .easy_popup_block4 .form-control{
        margin-bottom: 5px;
        padding: 1px 12px;
        height: 34px;
        line-height: 34px;
        border-radius: 1px;
    }
    .easy_popup_block22, .easy_popup_block3{
        min-height: 432px;
    }
    .easy_popup_block22 h4, .easy_popup_block3 h4, .easy_popup_block4 h4{
        text-align: center;
        color: #fff;
        margin-bottom: 10px;
    }
    .landing-form-overlay{
        top: 0px;
    }
    /* Footer */
    #footer{
        padding-top: 0px;
        padding-bottom: 0px;
        border: none;
    }
    #footer .copy_right{
        margin: 0px;
        padding: 20px;
        text-align: center;
        width: 100%;
        background: #0000004f;
        max-width: inherit;
    }
    .footer-icons{
        margin-bottom: 10px;
    }
    .footer-icons i{
        color: #fff !important;
    }
    /* Settings, Duplicate, Delete, Move Right & Move Left Links */
    .easy_link{
        position: relative;
    }
    .add_link{
        width: 194px;
        height: 40px;
        background: #222f3e;
        position: absolute;
        top: -36px;
        color: #fff;
        z-index: 2000;
        padding: 2px 4px;
    }
    .add_link.add_link_icon{
        width: 234px;
    }
    .add_link.add_link_icon .add_link_icon_btn{
        display: inline-block !important;
    }
    .add_link .triangle{
        position: absolute;
        left: 47.5%;
        margin-left: -5px;
        top: 40px;
        width: 0;
        height: 0;
        border-left: 9px solid transparent;
        border-right: 9px solid transparent;
        border-top: 9px solid #222f3e;
    }
    .settings_link_btn, .copy_link_btn, .delete_link_btn, .right_link_btn, .left_link_btn{
        height: 30px;
        width: 30px;
        background: #fff !important;
        color: #222f3e !important;
        display: inline-block;
        margin-top: 3px;
        margin-right: 3px;
        text-align: center;
        line-height: 30px;
        font-size: 1.3em;
        border-radius: 50px;
    }
    .settings_link_btn:hover, .copy_link_btn:hover, .delete_link_btn:hover, .right_link_btn:hover, .left_link_btn:hover{
        color: #43506c !important;
    }
    .add_link .right_link_btn.disabled, .add_link .left_link_btn.disabled{
        pointer-events: none;
        cursor: not-allowed;
        background: #bbbbbb !important;
    }
    /* Header */
    #header{
        padding-top: 0px;
        padding-bottom: 0px;
        overflow: inherit;
    }
    #header.sticky-header #header-wrap{
        position: inherit;
    }
    #header .dropdown-menu.show {
        z-index: 20000;
        display: block;
    }
    /* icons */
    .add_icon{
        width: 44px;
        height: 40px;
        background: #222f3e;
        position: absolute;
        top: -36px;
        color: #fff;
        z-index: 2000;
        padding: 2px 4px;
    }
    .add_icon .triangle{
        position: absolute;
        left: 42%;
        margin-left: -5px;
        top: 40px;
        width: 0;
        height: 0;
        border-left: 9px solid transparent;
        border-right: 9px solid transparent;
        border-top: 9px solid #222f3e;
    }
    .add_icon_btn, .add_link_icon_btn{
        height: 30px;
        width: 30px;
        background: #fff !important;
        color: #222f3e !important;
        display: inline-block;
        margin: 3px;
        text-align: center;
        line-height: 30px;
        font-size: 1.3em;
        border-radius: 50px;
    }
    .add_icon_btn:hover, add_link_icon_btn:hover{
        color: #43506c !important;
    }
    /* Forms */
    .add_form{
        width: 114px;
        height: 40px;
        background: #222f3e;
        position: absolute;
        top: -36px;
        color: #fff;
        z-index: 2000;
        padding: 2px 4px;
    }
    .add_form .triangle{
        position: absolute;
        left: 42%;
        margin-left: -5px;
        top: 40px;
        width: 0;
        height: 0;
        border-left: 9px solid transparent;
        border-right: 9px solid transparent;
        border-top: 9px solid #222f3e;
    }
    .add_form_btn{
        height: 30px;
        width: 100px;
        color: #fff !important;
        display: inline-block;
        margin: 3px;
        text-align: center;
        line-height: 30px;
        font-size: 1.3em;
    }
    .add_form_btn i{
        width: 30px;
        height: 30px;
        background: #fff !important;
        color: #222f3e !important;
        border-radius: 50px;
    }
</style>
--}}

<style>

    @if(@$website->font and @$website->font!="")
        body *:not(.fa):not(.fab):not(.fas):not(.far){
        font-family: "{{@$website->font}}" !important;
    }
    @endif

    section.section.highlighted, section.section.highlighted .background_color_div, .easy_col.highlighted {
        transition: box-shadow 0.2s;
        box-shadow: 0 0 0 7px #543c93 inset !important;
    }
    .language-switcher{
        border: 1px solid #d4d4d4;
        background: #fff;
        width: 140px;
        text-align: center;
        position: fixed;
        top: 100px;
        right: -100px;
        z-index: 1999;
        padding: 0px;
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }
    .language-switcher:hover{
        right: 0px;
    }
    .language-switcher a{
        padding: 0px;
        height: 30px;
        line-height: 25px;
        display: inline-block;
        width: 140px;
    }
    .language-switcher2{
        top: 140px;
    }
    .language-switcher3{
        top: 180px;
    }
    #ui_notifIt p{
        font-size: 1.2em;
        font-weight: bold;
    }
    .grid-container{
        overflow: initial;
    }
    section.section{
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }
    #wrapper{
        position: relative;
    }
    body:not(.no-transition) #wrapper, .animsition-overlay{
        opacity: 1 !important;
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
    .process-steps.process-steps-stl li:first-child:after, .process-steps.process-steps-stl li:before{
        content: '●';
    }
    .btn{
        border-width: 2px;
        background-color: #763a96;
        border-color: #763a96;
    }
    .btn-1{
        border-radius: 0px !important;
    }
    .btn-2{
        border-radius: 4px !important;
    }
    .btn-3{
        border-radius: 10px !important;
    }
    .btn-4{
        border-radius: 20px !important;
    }
    .btn-5{
        border-radius: 20px 0px 20px 0px !important;
    }
    .btn-2{
        border-radius: 4px !important;
    }
    .btn-6{
        border-radius: 0px !important;
        background-color: transparent !important;
    }
    .btn-7{
        border-radius: 4px !important;
        background-color: transparent !important;
    }
    .btn-8{
        border-radius: 10px !important;
        background-color: transparent !important;
    }
    .btn-9{
        border-radius: 20px !important;
        background-color: transparent !important;
    }
    .btn-10{
        border-radius: 20px 0px 20px 0px !important;
        background-color: transparent !important;
    }
    .btn-11{
        border-color: transparent !important;
        background-color: transparent !important;
    }
    .col_one_fourth{
        margin: 0px 1.5% 20px;
    }
    .col_one_third{
        margin: 0px 1.35% 20px;
    }
    .main-sticky-toolbar2 {
        position: absolute;
        bottom: 60px;
        left: 30px;
        background-color: #512293;
        color: #FFF;
        z-index: 1000;
    }
    .main-sticky-toolbar2 .toggle-sticky-toolbar2{
        height: 40px;
        width: 40px;
        position: absolute;
        right: -30px;
        top: 0px;
        background-color: #673EA1;
        border: none;
        border-radius: 4px;
        color: #fff;
    }
    .main-sticky-toolbar2 .list-sticky-toolbar2{
        height: 46px;
        position: absolute;
        right: -290px;
        list-style: none;
        transition: .3s ease-in-out;
        -webkit-transition: .3s ease-in-out;
        -moz-transition: .3s ease-in-out;
        -ms-transition: .3s ease-in-out;
        -o-transition: .3s ease-in-out;
        display: none;
    }
    .main-sticky-toolbar2 .list-sticky-toolbar2 li{
        float: right;
        margin-left: 2px;
    }
    .main-sticky-toolbar2 .list-sticky-toolbar2 a{
        cursor: pointer;
        display: inline-block;
        width: 40px;
        height: 40px;
        background-color: #673EA1;
        color: #FFF !important;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        border-radius: 5px;
        margin-bottom: 5px;
        transition: .3s ease-in-out;
    }
    .main-sticky-toolbar2 li a:hover{
        background-color: #58318f;
    }
    .main-sticky-toolbar2.sticky-toolbar-active .toggle-sticky-toolbar2{
        background-color: #7D58AE;
    }
    .main-sticky-toolbar2.sticky-toolbar-active .list-sticky-toolbar2{
        display: block;
    }
    .main-sticky-toolbar3 {
        position: absolute;
        bottom: 24px;
        right: 50%;
        left: 50%;
        background-color: #512293;
        color: #FFF;
        z-index: 1000;
    }
    .main-sticky-toolbar3 .toggle-sticky-toolbar3{
        height: 40px;
        width: 40px;
        position: absolute;
        right: -30px;
        top: 0px;
        background-color: #673EA1;
        border: none;
        border-radius: 4px;
        color: #fff;
    }
    .content-wrap section.section:first-of-type .up_block_btn a, .content-wrap section.section:last-of-type .down_block_btn a{
        pointer-events: none;
        cursor: not-allowed;
        background: gray !important;
    }
    .main-editor-tools{
        background-color: #512293;
        border: 1px solid #AF96D3;
        border-radius: 5px;
        padding: 5px;
        display: inline-block;
        position: absolute;
        width: fit-content;
        margin-bottom: 5px;
        z-index: 1000;
    }
    .switchToggleEditor .btnToggleEditor{
        cursor: pointer;
        display: inline-block;
    }
    .main-editor-tools .side-tool-buttons{
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }
    .main-editor-tools:before {
        position: absolute;
        content: "";
        -moz-transition: all 0.2s ease-in-out;
        -o-transition: all 0.2s ease-in-out;
        -ms-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
        width: 0px;
        height: 0px;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 6px solid #7D58AE;
        bottom: -6px;
        right: 50%;
        transform: translateX(50%);
    }
    .main-editor-tools .side-tool-buttons .group-list-btn{
        display: flex;
        align-items: center;
        margin: 0px 5px;
        flex-wrap: wrap;
    }
    .main-editor-tools .side-tool-buttons .btn-switch-mode{
        background: transparent;
        display: inline-block;
        margin: 3px 3px;
        transition: .2s ease-in-out;
        -webkit-transition: .2s ease-in-out;
        -moz-transition: .2s ease-in-out;
        -ms-transition: .2s ease-in-out;
        -o-transition: .2s ease-in-out;
        border: none;
        padding: 0px;
    }
    .main-editor-tools .side-tool-buttons .btn-switch-mode .pbicon-wrapper:hover{
        background-color: transparent;
    }
    .main-editor-tools .side-tool-buttons .btn-switch-mode .pbicon-wrapper.active-btn{
        background-color: #7D58AE;
    }
    .main-editor-tools .side-tool-buttons .btn-switch-mode .pbicon-wrapper{
        border: 1px solid #AF96D3;
        background-color: #673EA1;
        width: 30px;
        display: inline-block;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 3px;
        overflow: hidden;
        cursor: pointer;
    }
    .main-editor-tools .pbicon-wrapper .fa{
        color: #fff;
        font-size: 1.2em;
    }
    .main-editor-tools .fa-angle-right, .main-editor-tools .fa-angle-left, .main-editor-tools .fa-angle-up, .main-editor-tools .fa-angle-down{
        font-size: 1.5em !important;
    }
    .easy_col:first-of-type + .main-editor-tools .right_col_btn, .easy_col.last-of-type + .main-editor-tools .left_col_btn{
        pointer-events: none;
        cursor: not-allowed;
        background: gray !important;
        border-radius: 3px;
    }
    .easy_col:first-of-type + .main-editor-tools .right_col_btn span, .easy_col.last-of-type + .main-editor-tools .left_col_btn span{
        background: gray !important;
    }
    .main-editor-tools-icon{
        background-color: #512293;
        border: 1px solid #AF96D3;
        border-radius: 5px;
        padding: 5px;
        display: inline-block;
        position: absolute;
        width: fit-content;
        margin-bottom: 5px;
        z-index: 1000
    }
    .main-editor-tools-icon:before {
        position: absolute;
        content: "";
        -moz-transition: all 0.2s ease-in-out;
        -o-transition: all 0.2s ease-in-out;
        -ms-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
        width: 0px;
        height: 0px;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 6px solid #7D58AE;
        bottom: -6px;
        right: 50%;
        transform: translateX(50%);
    }
    .main-editor-tools-icon .side-tool-buttons .group-list-btn{
        display: flex;
        align-items: center;
        margin: 0px 5px;
        flex-wrap: wrap;
    }
    .main-editor-tools-icon .side-tool-buttons .btn-switch-mode{
        background: transparent;
        display: inline-block;
        margin: 3px 3px;
        transition: .2s ease-in-out;
        -webkit-transition: .2s ease-in-out;
        -moz-transition: .2s ease-in-out;
        -ms-transition: .2s ease-in-out;
        -o-transition: .2s ease-in-out;
        border: none;
        padding: 0px;
    }
    .main-editor-tools-icon .side-tool-buttons .btn-switch-mode .pbicon-wrapper:hover{
        background-color: transparent;
    }
    .main-editor-tools-icon .side-tool-buttons .btn-switch-mode .pbicon-wrapper.active-btn{
        background-color: #7D58AE;
    }
    .main-editor-tools-icon .side-tool-buttons .btn-switch-mode .pbicon-wrapper{
        border: 1px solid #AF96D3;
        background-color: #673EA1;
        width: 30px;
        display: inline-block;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 3px;
        overflow: hidden;
        cursor: pointer;
    }
    .main-editor-tools-icon .pbicon-wrapper .fa{
        color: #fff;
        font-size: 1.2em;
    }
    .main-editor-tools-btn{
        background-color: #512293;
        border: 1px solid #AF96D3;
        border-radius: 5px;
        padding: 5px;
        display: inline-block;
        position: absolute;
        width: fit-content;
        margin-bottom: 5px;
        z-index: 1000
    }
    .main-editor-tools-btn:before {
        position: absolute;
        content: "";
        -moz-transition: all 0.2s ease-in-out;
        -o-transition: all 0.2s ease-in-out;
        -ms-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
        width: 0px;
        height: 0px;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 6px solid #7D58AE;
        bottom: -6px;
        right: 50%;
        transform: translateX(50%);
    }
    .main-editor-tools-btn .side-tool-buttons .group-list-btn{
        display: flex;
        align-items: center;
        margin: 0px 5px;
        flex-wrap: wrap;
    }
    .main-editor-tools-btn .side-tool-buttons .btn-switch-mode{
        background: transparent;
        display: inline-block;
        margin: 3px 3px;
        transition: .2s ease-in-out;
        -webkit-transition: .2s ease-in-out;
        -moz-transition: .2s ease-in-out;
        -ms-transition: .2s ease-in-out;
        -o-transition: .2s ease-in-out;
        border: none;
        padding: 0px;
    }
    .main-editor-tools-btn .side-tool-buttons .btn-switch-mode .pbicon-wrapper:hover{
        background-color: transparent;
    }
    .main-editor-tools-btn .side-tool-buttons .btn-switch-mode .pbicon-wrapper.active-btn{
        background-color: #7D58AE;
    }
    .main-editor-tools-btn .side-tool-buttons .btn-switch-mode .pbicon-wrapper{
        border: 1px solid #AF96D3;
        background-color: #673EA1;
        width: 30px;
        display: inline-block;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 3px;
        overflow: hidden;
        cursor: pointer;
    }
    .main-editor-tools-btn .pbicon-wrapper .fa{
        color: #fff;
        font-size: 1.2em;
    }
    .main-editor-tools-link{
        background-color: #512293;
        border: 1px solid #AF96D3;
        border-radius: 5px;
        padding: 5px;
        display: inline-block;
        position: absolute;
        width: max-content;
        margin-bottom: 5px;
        z-index: 1000
    }
    .main-editor-tools-link:before {
        position: absolute;
        content: "";
        -moz-transition: all 0.2s ease-in-out;
        -o-transition: all 0.2s ease-in-out;
        -ms-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
        width: 0px;
        height: 0px;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 6px solid #7D58AE;
        bottom: -6px;
        right: 50%;
        transform: translateX(50%);
    }
    .main-editor-tools-link .side-tool-buttons .group-list-btn{
        display: flex;
        align-items: center;
        margin: 0px 5px;
        flex-wrap: wrap;
    }
    .main-editor-tools-link .side-tool-buttons .btn-switch-mode{
        background: transparent;
        display: inline-block;
        margin: 3px 3px;
        transition: .2s ease-in-out;
        -webkit-transition: .2s ease-in-out;
        -moz-transition: .2s ease-in-out;
        -ms-transition: .2s ease-in-out;
        -o-transition: .2s ease-in-out;
        border: none;
        padding: 0px;
    }
    .main-editor-tools-link .side-tool-buttons .btn-switch-mode .pbicon-wrapper:hover{
        background-color: transparent;
    }
    .main-editor-tools-link .side-tool-buttons .btn-switch-mode .pbicon-wrapper.active-btn{
        background-color: #7D58AE;
    }
    .main-editor-tools-link .side-tool-buttons .btn-switch-mode .pbicon-wrapper{
        border: 1px solid #AF96D3;
        background-color: #673EA1;
        width: 30px;
        display: inline-block;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 3px;
        overflow: hidden;
        cursor: pointer;
    }
    .main-editor-tools-link .pbicon-wrapper .fa{
        color: #fff;
        font-size: 1.2em;
    }
    .main-editor-tools-link .fa-angle-right, .main-editor-tools-link .fa-angle-left, .main-editor-tools-link .fa-angle-up, .main-editor-tools-link .fa-angle-down{
        font-size: 1.5em !important;
    }
    .easy_link:first-of-type + .main-editor-tools-link .right_link_btn, .easy_link.last-of-type + .main-editor-tools-link .left_link_btn{
        pointer-events: none;
        cursor: not-allowed;
        background: gray !important;
        border-radius: 3px;
    }
    .easy_link:first-of-type + .main-editor-tools-link .right_link_btn span, .easy_link.last-of-type + .main-editor-tools-link .left_link_btn span{
        background: gray !important;
    }
    .main-editor-tools-link .easy_link_icon{
        display: none !important;
    }
    .main-editor-tools-link.add_link_icon .easy_link_icon{
        display: inline-block !important;
    }
    .main-editor-tools-form{
        background-color: #512293;
        border: 1px solid #AF96D3;
        border-radius: 5px;
        padding: 5px;
        display: inline-block;
        position: absolute;
        width: fit-content;
        margin-bottom: 5px;
        z-index: 1000
    }
    .main-editor-tools-form:before {
        position: absolute;
        content: "";
        -moz-transition: all 0.2s ease-in-out;
        -o-transition: all 0.2s ease-in-out;
        -ms-transition: all 0.2s ease-in-out;
        transition: all 0.2s ease-in-out;
        width: 0px;
        height: 0px;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 6px solid #7D58AE;
        bottom: -6px;
        right: 50%;
        transform: translateX(50%);
    }
    .main-editor-tools-form .side-tool-buttons .group-list-btn{
        display: flex;
        align-items: center;
        margin: 0px 5px;
        flex-wrap: wrap;
    }
    .main-editor-tools-form .side-tool-buttons .btn-switch-mode{
        background: transparent;
        display: inline-block;
        margin: 3px 3px;
        transition: .2s ease-in-out;
        -webkit-transition: .2s ease-in-out;
        -moz-transition: .2s ease-in-out;
        -ms-transition: .2s ease-in-out;
        -o-transition: .2s ease-in-out;
        border: none;
        padding: 0px;
    }
    .main-editor-tools-form .side-tool-buttons .btn-switch-mode .pbicon-wrapper:hover{
        background-color: transparent;
    }
    .main-editor-tools-form .side-tool-buttons .btn-switch-mode .pbicon-wrapper.active-btn{
        background-color: #7D58AE;
    }
    .main-editor-tools-form .side-tool-buttons .btn-switch-mode .pbicon-wrapper{
        border: 1px solid #AF96D3;
        background-color: #673EA1;
        width: auto;
        padding: 0px 5px;
        display: inline-block;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 3px;
        overflow: hidden;
        cursor: pointer;
    }
    .main-editor-tools-form .pbicon-wrapper .fab{
        margin-left: 5px;
    }
    .main-editor-tools-form .pbicon-wrapper .fab, .main-editor-tools-form .pbicon-wrapper b{
        color: #fff;
        font-size: 1.2em;
    }
    .main-editor-tools-image, .main-editor-tools-video {
        background-color: #512293;
        border: 1px solid #AF96D3;
        border-radius: 5px;
        padding: 5px;
        display: inline-block;
        position: absolute;
        width: fit-content;
        margin-bottom: 5px;
        z-index: 1000
    }
    .main-editor-tools-image .side-tool-buttons .group-list-btn,
    .main-editor-tools-video .side-tool-buttons .group-list-btn{
        display: flex;
        align-items: center;
        margin: 0px 5px;
        flex-wrap: wrap;
    }
    .main-editor-tools-image .side-tool-buttons .btn-switch-mode,
    .main-editor-tools-video .side-tool-buttons .btn-switch-mode{
        background: transparent;
        display: inline-block;
        margin: 3px 3px;
        transition: .2s ease-in-out;
        -webkit-transition: .2s ease-in-out;
        -moz-transition: .2s ease-in-out;
        -ms-transition: .2s ease-in-out;
        -o-transition: .2s ease-in-out;
        border: none;
        padding: 0px;
    }
    .main-editor-tools-image .side-tool-buttons .btn-switch-mode .pbicon-wrapper:hover,
    .main-editor-tools-video .side-tool-buttons .btn-switch-mode .pbicon-wrapper:hover{
        background-color: transparent;
    }
    .main-editor-tools-image .side-tool-buttons .btn-switch-mode .pbicon-wrapper.active-btn,
    .main-editor-tools-video .side-tool-buttons .btn-switch-mode .pbicon-wrapper.active-btn{
        background-color: #7D58AE;
    }
    .main-editor-tools-image .side-tool-buttons .btn-switch-mode .pbicon-wrapper,
    .main-editor-tools-video .side-tool-buttons .btn-switch-mode .pbicon-wrapper{
        border: 1px solid #AF96D3;
        background-color: #673EA1;
        width: auto;
        padding: 0px 5px;
        display: inline-block;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 3px;
        overflow: hidden;
        cursor: pointer;
    }
    .main-editor-tools-image .pbicon-wrapper .fa,
    .main-editor-tools-video .pbicon-wrapper .fa{
        color: #fff;
    }

    .feature-box.fbox-center .fbox-icon{
        width: inherit;
    }
    .easy_text, .easy_icon{
        display: block !important;
        width: 100%;
        visibility: visible !important;
    }
</style>

@if(@$my_plugins["3"])
    @if(@$plugin_datas["3"])
        {!! @$plugin_datas["3"]->code !!}
    @endif
@endif

@if(@$my_plugins["4"])
    @if(@$plugin_datas["4"])
        {!! @$plugin_datas["4"]->code !!}
    @endif
@endif

@if(@$my_plugins["7"])
    @if(@$plugin_datas["7"])
        {!! @$plugin_datas["7"]->code !!}
    @endif
@endif
