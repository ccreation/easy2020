<style>

    @if(@$website->color->color1)
        .btn{
            background-color: {{@$website->color->color1}} !important;
        }
        ::selection {
            background: {{@$website->color->color1}} !important;
        }
        ::-moz-selection {
            background: {{@$website->color->color1}} !important;
        }
        ::-webkit-selection {
            background: {{@$website->color->color1}} !important;
        }
        h1 > span:not(.nocolor):not(.badge),
        h2 > span:not(.nocolor):not(.badge),
        h3 > span:not(.nocolor):not(.badge),
        h4 > span:not(.nocolor):not(.badge),
        h5 > span:not(.nocolor):not(.badge),
        h6 > span:not(.nocolor):not(.badge),
        .header-extras li .he-text span,
        #primary-menu ul li:hover > a,
        #primary-menu ul li.current > a,
        #primary-menu div ul li:hover > a,
        #primary-menu div ul li.current > a,
        #primary-menu ul ul li:hover > a,
        #primary-menu ul li .mega-menu-content.style-2 ul.mega-menu-column > li.mega-menu-title > a:hover,
        #top-cart > a:hover,
        .top-cart-action span.top-checkout-price,
        .breadcrumb a:hover,
        .portfolio-filter li a:hover,
        .portfolio-desc h3 a:hover,
        .portfolio-overlay a:hover,
        #portfolio-navigation a:hover,
        .entry-title h2 a:hover,
        .entry-meta li a:hover,
        .post-timeline .entry:hover .entry-timeline,
        .post-timeline .entry:hover .timeline-divider,
        .ipost .entry-title h3 a:hover,
        .ipost .entry-title h4 a:hover,
        .spost .entry-title h4 a:hover,
        .mpost .entry-title h4 a:hover,
        .comment-content .comment-author a:hover,
        .product-title h3 a:hover,
        .single-product .product-title h2 a:hover,
        .product-price ins,
        .single-product .product-price,
        .feature-box.fbox-border .fbox-icon i,
        .feature-box.fbox-border .fbox-icon img,
        .feature-box.fbox-plain .fbox-icon i,
        .feature-box.fbox-plain .fbox-icon img,
        .process-steps li.active h5,
        .process-steps li.ui-tabs-active h5,
        .team-title span,
        .pricing-box.best-price .pricing-price,
        .btn-link,
        .dark .post-timeline .entry:hover .entry-timeline,
        .dark .post-timeline .entry:hover .timeline-divider,
        .clear-rating-active:hover {
            color: {{@$website->color->color1}} !important;
        }
        .color,
        .top-cart-item-desc a:hover,
        .portfolio-filter.style-3 li.activeFilter a,
        .faqlist li a:hover,
        .tagcloud a:hover,
        .dark .top-cart-item-desc a:hover,
        .iconlist-color li i,
        .dark.overlay-menu #header-wrap:not(.not-dark) #primary-menu > ul > li:hover > a,
        .dark.overlay-menu #header-wrap:not(.not-dark) #primary-menu > ul > li.current > a,
        .overlay-menu #primary-menu.dark > ul > li:hover > a,
        .overlay-menu #primary-menu.dark > ul > li.current > a,
        .nav-tree li:hover > a,
        .nav-tree li.current > a,
        .nav-tree li.active > a {
            color: {{@$website->color->color1}}  !important;
        }
        #primary-menu.style-3 > ul > li.current > a,
        #primary-menu.sub-title > ul > li:hover > a,
        #primary-menu.sub-title > ul > li.current > a,
        #primary-menu.sub-title > div > ul > li:hover > a,
        #primary-menu.sub-title > div > ul > li.current > a,
        #top-cart > a > span,
        #page-menu-wrap,
        #page-menu ul ul,
        #page-menu.dots-menu nav li.current a,
        #page-menu.dots-menu nav li div,
        .portfolio-filter li.activeFilter a,
        .portfolio-filter.style-4 li.activeFilter a:after,
        .portfolio-shuffle:hover,
        .entry-link:hover,
        .sale-flash,
        .button:not(.button-white):not(.button-dark):not(.button-border):not(.button-black):not(.button-red):not(.button-teal):not(.button-yellow):not(.button-green):not(.button-brown):not(.button-aqua):not(.button-purple):not(.button-leaf):not(.button-pink):not(.button-blue):not(.button-dirtygreen):not(.button-amber):not(.button-lime),
        .button.button-dark:hover,
        .promo.promo-flat,
        .feature-box .fbox-icon i,
        .feature-box .fbox-icon img,
        .fbox-effect.fbox-dark .fbox-icon i:hover,
        .fbox-effect.fbox-dark:hover .fbox-icon i,
        .fbox-border.fbox-effect.fbox-dark .fbox-icon i:after,
        .i-rounded:hover,
        .i-circled:hover,
        ul.tab-nav.tab-nav2 li.ui-state-active a,
        .testimonial .flex-control-nav li a,
        .skills li .progress,
        .owl-carousel .owl-dots .owl-dot,
        #gotoTop:hover,
        .dark .button-dark:hover,
        .dark .fbox-effect.fbox-dark .fbox-icon i:hover,
        .dark .fbox-effect.fbox-dark:hover .fbox-icon i,
        .dark .fbox-border.fbox-effect.fbox-dark .fbox-icon i:after,
        .dark .i-rounded:hover,
        .dark .i-circled:hover,
        .dark ul.tab-nav.tab-nav2 li.ui-state-active a,
        .dark .tagcloud a:hover,
        .ei-slider-thumbs li.ei-slider-element,
        .nav-pills .nav-link.active,
        .nav-pills .nav-link.active:hover,
        .nav-pills .nav-link.active:focus,
        .nav-pills .show > .nav-link,
        .checkbox-style:checked + .checkbox-style-1-label:before,
        .checkbox-style:checked + .checkbox-style-2-label:before,
        .checkbox-style:checked + .checkbox-style-3-label:before,
        .radio-style:checked + .radio-style-3-label:before,
        .irs-bar,
        .irs-from,
        .irs-to,
        .irs-single,
        input.switch-toggle-flat:checked + label,
        input.switch-toggle-flat:checked + label:after,
        input.switch-toggle-round:checked + label:before,
        .bootstrap-switch .bootstrap-switch-handle-on.bootstrap-switch-themecolor,
        .bootstrap-switch .bootstrap-switch-handle-off.bootstrap-switch-themecolor,
        .entry:after {
            background-color: {{@$website->color->color1}} !important;
        }
        .bgcolor,
        .button.button-3d:not(.button-white):not(.button-dark):not(.button-border):not(.button-black):not(.button-red):not(.button-teal):not(.button-yellow):not(.button-green):not(.button-brown):not(.button-aqua):not(.button-purple):not(.button-leaf):not(.button-pink):not(.button-blue):not(.button-dirtygreen):not(.button-amber):not(.button-lime):hover,
        .process-steps li.active a,
        .process-steps li.ui-tabs-active a,
        .sidenav > .ui-tabs-active > a,
        .sidenav > .ui-tabs-active > a:hover,
        .owl-carousel .owl-nav [class*=owl-]:hover,
        .page-item.active .page-link,
        .page-link:hover,
        .page-link:focus {
            background-color: {{@$website->color->color1}}  !important;
        }
        #primary-menu.style-4 > ul > li:hover > a,
        #primary-menu.style-4 > ul > li.current > a,
        .top-cart-item-image:hover,
        .portfolio-filter.style-3 li.activeFilter a,
        .post-timeline .entry:hover .entry-timeline,
        .post-timeline .entry:hover .timeline-divider,
        .cart-product-thumbnail img:hover,
        .feature-box.fbox-outline .fbox-icon,
        .feature-box.fbox-border .fbox-icon,
        .dark .top-cart-item-image:hover,
        .dark .post-timeline .entry:hover .entry-timeline,
        .dark .post-timeline .entry:hover .timeline-divider,
        .dark .cart-product-thumbnail img:hover,
        .heading-block.border-color:after {
            border-color: {{@$website->color->color1}} !important;
        }
        .top-links ul ul,
        .top-links ul div.top-link-section,
        #primary-menu ul ul:not(.mega-menu-column),
        #primary-menu ul li .mega-menu-content,
        #primary-menu.style-6 > ul > li > a:after,
        #primary-menu.style-6 > ul > li.current > a:after,
        #top-cart .top-cart-content,
        .fancy-title.title-border-color:before,
        .dark #primary-menu:not(.not-dark) ul ul,
        .dark #primary-menu:not(.not-dark) ul li .mega-menu-content,
        #primary-menu.dark ul ul,
        #primary-menu.dark ul li .mega-menu-content,
        .dark #primary-menu:not(.not-dark) ul li .mega-menu-content.style-2,
        #primary-menu.dark ul li .mega-menu-content.style-2,
        .dark #top-cart .top-cart-content,
        .tabs.tabs-tb ul.tab-nav li.ui-tabs-active a,
        .irs-from:after,
        .irs-single:after,
        .irs-to:after {
            border-top-color: {{@$website->color->color1}} !important;
        }
        #page-menu.dots-menu nav li div:after,
        .title-block {
            border-left-color: {{@$website->color->color1}} !important;
        }
        .title-block-right {
            border-right-color: {{@$website->color->color1}} !important;
        }
        .fancy-title.title-bottom-border h1,
        .fancy-title.title-bottom-border h2,
        .fancy-title.title-bottom-border h3,
        .fancy-title.title-bottom-border h4,
        .fancy-title.title-bottom-border h5,
        .fancy-title.title-bottom-border h6,
        .more-link,
        .tabs.tabs-bb ul.tab-nav li.ui-tabs-active a {
            border-bottom-color: {{@$website->color->color1}} !important;
        }
        .border-color,
        .process-steps li.active a,
        .process-steps li.ui-tabs-active a,
        .tagcloud a:hover,
        .page-item.active .page-link,
        .page-link:hover,
        .page-link:focus {
            border-color: {{@$website->color->color1}}  !important;
        }
        .fbox-effect.fbox-dark .fbox-icon i:after,
        .dark .fbox-effect.fbox-dark .fbox-icon i:after {
            box-shadow: 0 0 0 2px{{@$website->color->color1}} !important;
        }
        .fbox-border.fbox-effect.fbox-dark .fbox-icon i:hover,
        .fbox-border.fbox-effect.fbox-dark:hover .fbox-icon i,
        .dark .fbox-border.fbox-effect.fbox-dark .fbox-icon i:hover,
        .dark .fbox-border.fbox-effect.fbox-dark:hover .fbox-icon i {
            box-shadow: 0 0 0 1px{{@$website->color->color1}} !important;
        }
        @media only screen and (max-width: 991px) {

            body:not(.dark) #header:not(.dark) #header-wrap:not(.dark) #primary-menu > ul > li:hover a,
            body:not(.dark) #header:not(.dark) #header-wrap:not(.dark) #primary-menu > ul > li.current a,
            body:not(.dark) #header:not(.dark) #header-wrap:not(.dark) #primary-menu > div > ul > li:hover a,
            body:not(.dark) #header:not(.dark) #header-wrap:not(.dark) #primary-menu > div > ul > li.current a,
            #primary-menu ul ul li:hover > a,
            #primary-menu ul li .mega-menu-content.style-2 > ul > li.mega-menu-title:hover > a,
            #primary-menu ul li .mega-menu-content.style-2 > ul > li.mega-menu-title > a:hover {
                color: {{@$website->color->color1}}  !important;
            }

            #page-menu nav {
                background-color: {{@$website->color->color1}} !important;
            }

        }
        @media only screen and (max-width: 767px) {

            .portfolio-filter li a:hover {
                color: {{@$website->color->color1}} !important;
            }

        }
        #page-menu.dots-menu nav li div:after,
        .title-block {
            border-right-color: {{@$website->color->color1}} !important;
        }
        .title-block-right {
            border-left-color: {{@$website->color->color1}} !important;
        }
        .fbox-effect.fbox-dark .fbox-icon i:after,
        .dark .fbox-effect.fbox-dark .fbox-icon i:after {
            box-shadow: 0 2px 0 0{{@$website->color->color1}} !important;
        }
        .fbox-border.fbox-effect.fbox-dark .fbox-icon i:hover,
        .fbox-border.fbox-effect.fbox-dark:hover .fbox-icon i,
        .dark .fbox-border.fbox-effect.fbox-dark .fbox-icon i:hover,
        .dark .fbox-border.fbox-effect.fbox-dark:hover .fbox-icon i {
            box-shadow: 0 1px 0 0{{@$website->color->color1}} !important;
        }
        .button-white {
            color: {{@$website->color->color1}} !important;
        }
        .bg-info {
            background-color: {{@$website->color->color1}}  !important;
        }
        .badge-info {
            background-color: {{@$website->color->color1}} !important;
        }
        .btn-info {
            background-color: {{@$website->color->color1}} !important;
            border-color: {{@$website->color->color1}} !important;
        }
        .btn-dark {
            background-color: {{@$website->color->color1}} !important;
            border-color: {{@$website->color->color1}} !important;
        }
        .dark #header.sticky-header:not(.transparent-header) #header-wrap:not(.not-dark),
        .dark #header.sticky-header.transparent-header #header-wrap:not(.not-dark),
        .dark #header.transparent-header.floating-header .container,
        .dark #header.transparent-header.floating-header.sticky-header .container,
        #header.dark.sticky-header:not(.transparent-header) #header-wrap:not(.not-dark),
        #header.dark.sticky-header.transparent-header #header-wrap:not(.not-dark),
        #header.dark.transparent-header.floating-header .container,
        #header.dark.transparent-header.floating-header.sticky-header .container,
        .dark .responsive-sticky-header #header-wrap,
        .responsive-sticky-header.dark #header-wrap {
            background-color: {{@$website->color->color1}} !important; /*2542a1*/
        }
        .dark #primary-menu:not(.not-dark) ul ul li > a, #primary-menu.dark ul ul li > a {
            color: {{@$website->color->color1}}   !important; /*2542a0*/ /*14a3ba*/
        }
        .grdBg {
            background-color: {{@$website->color->color1}} !important; /*2542a1*/
        }
        .button-vlt.btn-sk {
            background: {{@$website->color->color2}}; /*2AB5CA*/
        }
        .button-vlt.button-border {
            border: 2px solid {{@$website->color->color1}} !important;
            color: {{@$website->color->color1}} !important;
        }
        .heading-block.color:after {
            border-top: 2px solid {{@$website->color->color1}} !important;
        }
        .services-outer-c {
            border: 1px solid {{@$website->color->color1}} !important;
        }
        .services-c-noInfo .services-c-sqr {
            border: 0.1rem solid {{@$website->color->color1}} !important;
        }
        .services-outer-c:not(.services-c-noInfo) .services-clc:hover, .services-clc.active {
            background-image: linear-gradient(0deg, {{@$website->color->color1}} 0%, #d3aee6 100%);
        }

        .feature-box.fbox-border.fbox-trans .fbox-icon i, .feature-box.fbox-border.fbox-trans .fbox-icon img {
            color: {{@$website->color->color1}} !important; /*#888*/
        }

        .fbox-border.fbox-effect .fbox-icon i:after {
            background-color: {{@$website->color->color1}} !important;
        }

        .tabs.tabs-alt.tabs-stl01 ul.tab-nav li.ui-tabs-active a,
        .tabs.tabs-alt.tabs-stl02 ul.tab-nav li.ui-tabs-active a {
            background-color: {{@$website->color->color1}} !important;
        }

        .process-steps.process-steps-stl .i-bordered,
        .process-steps.process-steps-stl .i-bordered:hover,
        .process-steps.process-steps-stl01 .i-bordered,
        .process-steps.process-steps-stl01 .i-bordered:hover {
            color: {{@$website->color->color1}} !important;
        }

        .process-steps.process-steps-stl02 li:after {
            background: {{@$website->color->color1}} !important;
        }

        .process-steps.process-steps-stl02 .i-plain i {
            color: {{@$website->color->color1}} !important; /*8D9599*/
        }

        .fbox-border.fbox-effect:hover .fbox-icon h2:after {
            background-color: {{@$website->color->color1}} !important;
        }

        .togglet.toggleta .tfNum, .acctitle.acctitlec .tfNum {
            background: {{@$website->color->color1}} !important;
            border: 1px solid {{@$website->color->color1}} !important;
        }

        .tfContentBg .togglec, .acctitle.acctitlec + .acc_content p {
            padding: 15px;
            background: {{@$website->color->color1}} !important;
        }

        .arwStyle01 .slider-arrow-left, .arwStyle01 .slider-arrow-right, .arwStyle01 .flex-prev, .arwStyle01 .flex-next, .arwStyle01 .slider-arrow-top-sm, .arwStyle01 .slider-arrow-bottom-sm {
            border: 1px solid {{@$website->color->color1}} !important;
        }

        .arwStyle01.arwStyleSolid .slider-arrow-left, .arwStyle01.arwStyleSolid .slider-arrow-right, .arwStyle01.arwStyleSolid .flex-prev, .arwStyle01.arwStyleSolid .flex-next, .arwStyle01.arwStyleSolid .slider-arrow-top-sm, .arwStyle01.arwStyleSolid .slider-arrow-bottom-sm {
            background-color: {{@$website->color->color1}} !important;
        }

        .arwStyle01 .slider-arrow-left i, .arwStyle01 .slider-arrow-right i, .arwStyle01 .flex-prev i, .arwStyle01 .flex-next i, .arwStyle01 .slider-arrow-top-sm i, .arwStyle01 .slider-arrow-bottom-sm i {
            color: {{@$website->color->color1}} !important;
        }

        .arwStyle01 .slider-arrow-left:hover, .arwStyle01 .slider-arrow-right:hover, .arwStyle01 .flex-prev:hover, .arwStyle01 .flex-next:hover, .arwStyle01 .slider-arrow-top-sm:hover, .arwStyle01 .slider-arrow-bottom-sm:hover {
            background-color: {{@$website->color->color1}}  !important;
        }

        .arwStyle01 .flex-container a:active, .arwStyle01 .flexslider a:active, .arwStyle01 .flex-container a:focus, .arwStyle01 .flexslider a:focus {
            border: 1px solid {{@$website->color->color1}} !important;
        }

        .testimonial.trans:not(.testimonial06) .flex-prev:hover i, .testimonial.trans:not(.testimonial06) .flex-next:hover i {
            color: {{@$website->color->color1}}  !important;
        }

        .slider-arrow-left i, .slider-arrow-right i, .flex-prev i, .flex-next i, .slider-arrow-top-sm i, .slider-arrow-bottom-sm i {
            color: {{@$website->color->color1}} !important;
        }

        .tabs.tabs-bb2.tabs-lg ul.tab-nav li.ui-tabs-active a .fbox-effect .fbox-icon i {
            background-color: {{@$website->color->color1}} !important;
        }

        .tabs.tabs-bb2.tabs-lg ul.tab-nav li.ui-tabs-active a .fbox-effect h3 {
            color: {{@$website->color->color1}} !important;
        }

        .sideTabsItems .list-group-item.active {
            color: {{@$website->color->color1}} !important;
            border-color: {{@$website->color->color1}} !important;
        }

        .sideTabsItems .list-group-item.active:before {
            background-color: {{@$website->color->color1}} !important;
        }

        .sideTabsItems .list-group-item.active .feature-box.fbox-border h3 {
            color: {{@$website->color->color1}} !important;
        }

        .sideTabsItems .list-group-item.active .feature-box.fbox-border .fbox-icon {
            border: 1px solid {{@$website->color->color1}} !important;
        }

        .sideTabsItems .list-group-item.active .fbox-border.fbox-effect .fbox-icon i:after {
            background-color: {{@$website->color->color1}} !important;
        }

        blockquote.color {
            border-color: {{@$website->color->color1}} !important;
        }

        .timeline > li > .timeline-badge {
            background-color: {{@$website->color->color1}} !important;
        }

        .arwStyle01 .owl-prev, .arwStyle01 .owl-next {
            border: 1px solid {{@$website->color->color1}} !important;
        }

        .arwStyle01 .owl-prev i, .arwStyle01 .owl-next i {
            color: {{@$website->color->color1}} !important;
        }

        .arwStyle01 .owl-prev:hover, .arwStyle01 .owl-next:hover {
            background-color: {{@$website->color->color1}}  !important;
        }

        .arwStyle01 .owl-nav a:active, .arwStyle01 .owl-nav a:focus {
            border: 1px solid {{@$website->color->color1}} !important;
        }

        .owl-carousel.arwStyle01:not(.arwDfault) .owl-nav [class*=owl-] {
            border: 1px solid {{@$website->color->color1}} !important;
            color: {{@$website->color->color1}} !important;
        }

        .team-overlay:before {
            background-color: {{@$website->color->color1}} !important;
        }

        .portfolioFilterStyle01 li.activeFilter a {
            background-color: {{@$website->color->color1}} !important;
        }

        .portfolioFilterStyle02 li.activeFilter a {
            color: {{@$website->color->color1}}  !important;
            border-bottom: 4px solid {{@$website->color->color1}} !important;
        }

        .log-reg-con ul.tab-nav:not(.tab-nav-lg):not(.process-steps) li.ui-tabs-active a {
            border-bottom: 2px solid {{@$website->color->color1}} !important;
        }

        .tstBox01 .tstBoxText .tstBoxIcon {
            background-color: {{@$website->color->color1}} !important;
        }

        .tstBox01 .tstBoxName::before {
            background-color: {{@$website->color->color1}} !important;
        }

        .rdIcon {
            background: {{@$website->color->color1}} !important;
        }

        .lfSideBox .lfSideBox-title {
            background: {{@$website->color->color1}} !important;
        }

        .tstBsCarousel .tstBox02 .fa {
            color: {{@$website->color->color1}} !important;
        }

        .csSubscribe {
            border: 4px solid {{@$website->color->color1}} !important;
        }

        .countdownStyle02 .countdown-amount, .countdownStyle02 .rounded-skill {
            color: {{@$website->color->color1}} !important;
        }
    @endif

    @if(@$website->color->color2)
        a{
            color: {{@$website->color->color2}} !important;
        }
        .btn{
            border-color: {{@$website->color->color2}} !important;
        }
        .btn-dark:hover {
            background-color: {{@$website->color->color2}}  !important;
            border-color: {{@$website->color->color2}}  !important;
        }

        .btn-info:hover {
            background-color: {{@$website->color->color2}}  !important;
            border-color: {{@$website->color->color2}}  !important;
        }

        .form-control-plaintext.border-bottom {
            border-bottom: 1px solid {{@$website->color->color2}}  !important;
        }

        .button-vlt.btn-sk {
            background: {{@$website->color->color2}}  !important;
        }

        #tst2Carousel .carousel-indicators .active {
            background-color: {{@$website->color->color2}}  !important;
            border: 1px solid {{@$website->color->color2}}  !important;
        }

        .dark .button-dark:not(.button-border),
        .dark .button:hover {
            background-color: {{@$website->color->color2}}  !important;
        }

        .product-overlay a:hover{
            background-color: {{@$website->color->color2}}  !important;
        }
    @endif

</style>
