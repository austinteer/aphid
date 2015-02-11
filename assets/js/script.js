jQuery(document).ready(function($) {

    /* getting viewport width */
    var responsiveViewport = $(window).width();

    /* if is below 480px */
    if (responsiveViewport < 480) {}; /* end smallest screen */

    /* if is larger than 481px */
    if (responsiveViewport > 481) {}; /* end larger than 481px */

    /* if is above or equal to 780px */
    if (responsiveViewport >= 780) {
        $('.sub-menu').parent().addClass('down-arrow');
    };

    /* off the bat large screen actions */
    if (responsiveViewport > 1030) {};


    // Added call to menu for down-arrow
    $('.js--toggle-nav').click(function() {
        $('.main-nav--toggle').toggle();
    });

    //Calling FlexSlider
    // $('.flexslider').flexslider({
    //   animation: "slide",
    //   animationLoop: false,
    //   itemWidth: 1000,
    //   itemMargin: 5,
    //   pausePlay: false,
    //   start: function(slider){
    //     $('body').removeClass('loading');
    //   }
    // });

});