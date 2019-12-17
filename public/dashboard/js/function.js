
(function ($) {
  'use-strict'


  

  /*=========================================================================
			1.toggle menu mobile
	=========================================================================*/
  $('#toggle').on('click', function () {
    $('.menu-mobile').toggleClass('menu-mobile-active');
    $('body').toggleClass('active-body');
    $('.mobile-menu-overlay').toggleClass('mobile-menu-overlay-active');
    $('.menu-mobile li').toggleClass('active');
  })

  $('.mobile-menu-overlay').on('click', function () {
    $('.menu-mobile').toggleClass('menu-mobile-active');
    $('body').toggleClass('active-body');
    $('.mobile-menu-overlay').toggleClass('mobile-menu-overlay-active');
    $('.menu-mobile li').toggleClass('active');
  })

  $('.menu-mobile .fa-times').on('click', function () {
    $('.menu-mobile').toggleClass('menu-mobile-active');
    $('body').toggleClass('active-body');
    $('.mobile-menu-overlay').toggleClass('mobile-menu-overlay-active');
    $('.menu-mobile li').toggleClass('active');
  })
  // 

  $('.selectpaicker').selectpicker();

  $('.widget__item_3 .option_link_desktop').click(function () {
    var parent = $(this).closest('.widget__item_3')
    parent.find('.widget__item_content .widget__image').hide()
    parent.find('.widget__item_content .image-desktop').fadeIn()
  })

  $('.widget__item_3 .option_link_tablet').click(function () {
    var parent = $(this).closest('.widget__item_3')
    parent.find('.widget__item_content .widget__image').hide()
    parent.find('.widget__item_content .image-tablet').fadeIn()
  })


  $('.widget__item_3 .option_link_mobile').click(function () {
    var parent = $(this).closest('.widget__item_3')
    parent.find('.widget__item_content .widget__image').hide()
    parent.find('.widget__item_content .image-mobile').fadeIn()
  })


  $('.pannel .widget__item_3 .widget__item_option .widget__item_option_link').click(function(){
    $(this).siblings().removeClass('active_link')
    $(this).addClass('active_link')
  })

  $('.play-button').on('click', function (ev) {
    $(".iframeVideo")[0].src += "&autoplay=1";
    ev.preventDefault();
    $('.section_lastSites .bg_tv-overlay').addClass('remove_bg')
    $('.play-button').remove()
  });




  var $sliderLastSites = $('.sliderLastSites');
  $sliderLastSites.owlCarousel({
    margin: 10,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    smartSpeed: 450,
    loop: true,
    autoplay: true,
    autoplayTimeout: 5000,
    slideTransition: 'linear',
    nav: false,
    dots: true,
    rtl: true,
    mouseDrag: true,
    responsive: {
      0: {
        items: 1,

      },
      600: {
        items: 1,

      },
      1000: {
        items: 1,

      }
    }
  });


  $sliderLastSites.find('.item-lastSites').each(function (index) {
    $(this).attr('data-position', index); // NB: .attr() instead of .data()
  });



  var $sliderImageVideo = $('.sliderImageVideo');
  $sliderImageVideo.owlCarousel({
    margin: 10,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    smartSpeed: 450,
    loop: true,
    autoplay: false,
    autoplayTimeout: 5000,
    slideTransition: 'linear',
    nav: false,
    dots: false,
    rtl: true,
    mouseDrag: false,
    responsive: {
      0: {
        items: 1,

      },
      600: {
        items: 1,

      },
      1000: {
        items: 1,

      }
    }
  });


  $sliderImageVideo.find('.image-video').each(function (index) {
    $(this).attr('data-position', index); // NB: .attr() instead of .data()
  });


  $(document).on('click', '.sliderLastSites .owl-dots .owl-dot', function () {
    var id = $(this).closest('.sliderLastSites ').find('.owl-item.active .item-lastSites').attr('data-position');
    $(".sliderImageVideo .image-video").each(function () {
      if ($(this).attr('data-position') == id) {

        $sliderImageVideo.trigger('to.owl.carousel', $(this).data('position'))
      }
    });

  });



  $sliderLastSites.on('changed.owl.carousel', function(e) {
    var id = $(this).closest('.sliderLastSites ').find('.owl-item.active .item-lastSites').attr('data-position');
    $(".sliderImageVideo .image-video").each(function () {
      if ($(this).attr('data-position') == id) {

        $sliderImageVideo.trigger('to.owl.carousel', $(this).data('position'))
      }
    });
  });


  var sliderTestimonial = $('.sliderTestimonial');
  sliderTestimonial.owlCarousel({
    margin: 10,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    smartSpeed: 450,
    loop: true,
    autoplay: true,
    autoplayTimeout: 5000,
    slideTransition: 'linear',
    nav: true,
    dots: true,
    rtl: true,
    mouseDrag: true,
    responsive: {
      0: {
        items: 1,
        nav: false,
      },
      600: {
        items: 1,

      },
      1000: {
        items: 1,

      }
    }
  });



  var sliderClient = $('.sliderClient');
  sliderClient.owlCarousel({
    margin: 20,
    smartSpeed: 450,
    loop: true,
    autoplay: true,
    autoplayTimeout: 5000,
    slideTransition: 'linear',
    nav: true,
    dots: false,
    rtl: true,
    mouseDrag: true,
    responsive: {
      0: {
        items: 1,

      },
      600: {
        items: 2,

      },
      1000: {
        items: 4,

      }
    }
  });

  var sliderPageItem = $('.sliderPageItem');
  sliderPageItem.owlCarousel({
    margin: 0,
    smartSpeed: 450,
    loop: true,
    autoplay: false,
    autoplayTimeout: 5000,
    slideTransition: 'linear',
    nav: true,
    dots: false,
    rtl: true,
    mouseDrag: true,
    responsive: {
      0: {
        items: 2,

      },
      600: {
        items: 2,

      },
      1000: {
        items: 3,

      }
    }
  });

  


  $('.form-register .steps li a').click(function (e) {
    e.stoppropagation()
    e.preventDefault()
  })




  $('.switch_languages .switch_languages-link').click(function () {
    $('.switch_languages .switch_languages-link').removeClass('active')
    if ($(this).hasClass('ar')) {
      $(this).addClass('active')
    }
    if ($(this).hasClass('en')) {
      $(this).addClass('active')
    }
  })



  $('.widget_item.widget__item_7').click(function () {
    $('.widget_item.widget__item_7').removeClass('active')
    $(this).addClass('active')
  })





  $('.btn_close_aside').click(function(){
    $('.main_aside_option').removeClass('main_aside_active')
  })


  $('.button_show_aside').click(function(){
    $('.main_aside_option').addClass('main_aside_active')
  })

  $('.main_aside_option .card-header-action .btn-link').click(function(){
    $(this).toggleClass('arrow').closest('.card').siblings().find('.btn-link').removeClass('arrow')
  })


  $('.widget__item-option-item .nav-link').click(function(){
    $(this).closest('.widget__item-option-item').find('.dropdown_widget__item-option').toggleClass('dropdown_widget__item-active')
  })



  

  // if($(window).innerWidth() <= 992) {
  //   $('.owl-carousel-mobile').addClass('carouselNavTabs owl-carousel owl-theme')
  // }

  var carouselNavTabs = $('.carouselNavTabs');
  carouselNavTabs.owlCarousel({
    margin: 0,
    smartSpeed: 450,
    loop: true,
    autoplay: false,
    autoplayTimeout: 5000,
    slideTransition: 'linear',
    nav: true,
    dots: false,
    rtl: true,
    mouseDrag: true,
    responsive: {
      0: {
        items: 2,

      },
      600: {
        items: 2,

      },
      1000: {
        items: 3,

      }
    }
  });


  $('.main_header_option .widget__item-option.list-nav .widget__item-option-item > .nav-item').click(function(){
    $(this).closest('.widget__item-option-item').siblings().find('.dropdown_widget.dropdown_widget_first').removeClass('active_dropdown_widget')
    $(this).closest('.widget__item-option-item').siblings().find('.nav-item').removeClass('active')
    $('.dropdown_widget.dropdown_widget_second').removeClass('active_dropdown_widget')
    $(this).closest('.widget__item-option-item').find('.dropdown_widget.dropdown_widget_first').toggleClass('active_dropdown_widget')
    $(this).closest('.widget__item-option-item').find('.nav-item').toggleClass('active')
  })


  $('.add_new_page,.add_new_color,.add_new_section').click(function(){
    $('.dropdown_widget.dropdown_widget_first').removeClass('active_dropdown_widget')
    $(this).closest('.widget__item-option-item').find('.dropdown_widget.dropdown_widget_second').toggleClass('active_dropdown_widget')
  })

  

  $('.main_header_option .widget__item-option .widget__item-option-item > .nav-item').click(function(){
    if($('.dropdown_widget').hasClass('active_dropdown_widget')){
      $('.main--container-website').addClass('active-dropdown')
    }else{
      $('.main--container-website').removeClass('active-dropdown')
    }
  })
  
}(jQuery));



function uploadFile(target) {
  document.getElementById("file-name").innerHTML = target.files[0].name;
}

wow = new WOW(
  {
    boxClass: 'wow',      // default
    mobile: true,       // default
    live: true,       // default
  }
)
wow.init();