$(window).on( 'scroll', function(){
    if( $(window).scrollTop() > 450 ) {
        $("#gotoTop").fadeIn();
    } else {
        $("#gotoTop").fadeOut();
    }
});

$(document).on("click", "#gotoTop", function () {
    $('body,html').stop(true).animate({
        'scrollTop': 0
    }, 700, 'easeOutQuad' );
    return false;
});