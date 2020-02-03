<div id="gotoTop" class="fa fa-angle-up"></div>

<script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>
<script src="{{asset("public/easy/assets/js/plugins.js")}}"></script>


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
        /*display: block !important;
        width: 100%;*/
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

@if(@$website->color)
    @include("website.parts.color")
@endif
