$(document).ready(function () {

  stickyNav();  

  $('.owl-carousel, .owl-carousel-post').owlCarousel({
    items: 1,
    loop: true,
    // margin: 10,
    nav: false,
    autoplay: true,
    autoplayTimeout: 2500,
    autoplayHoverPause: true
  });
  
  $('.scrollInfo').click(function(e) {
    $('html, body').animate({
      scrollTop: $('#info-bb3d').offset().top 
    }, 1000); 
    e.preventDefault();
  });
  
  /* Navigation scroll */
  $(function() {
    $('a[href*=#]:not([href=#])').click(function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});


// Mobile Navigation
if ($('nav').length) {
  var $mobile_nav = $('nav').clone().find('#logo-link, .sticky').remove().end();
  $mobile_nav.prop({
    id: 'mobile-nav'
  });
  $mobile_nav.find('ul').attr({
    'class': '',
    'id': ''
  });


  $('body').append($mobile_nav);
  $('body').prepend('<button type="button" id="mobile-nav-toggle"><i class="fa fa-bars"></i></button>');
  $('body').append('<div id="mobile-body-overly"></div>');
  $('#mobile-nav').find('.menu-has-children').prepend('<i class="fa fa-chevron-down"></i>');
  
  $(document).on('click', '.menu-has-children i', function (e) {
    $(this).next().toggleClass('menu-item-active');
    $(this).nextAll('ul').eq(0).slideToggle();

    $(this).toggleClass("fa-chevron-up fa-chevron-down");
  });
  
  $(document).on('click', '#mobile-nav-toggle', function (e) {
    $('body').toggleClass('mobile-nav-active');
    $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
    $('#mobile-body-overly').toggle();
  });
  
  $(document).click(function (e) {
    var container = $("#mobile-nav, #mobile-nav-toggle");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      if ($('body').hasClass('mobile-nav-active')) {
        $('body').removeClass('mobile-nav-active');
        $('#mobile-nav-toggle i').toggleClass('fa-times fa-bars');
        $('#mobile-body-overly').fadeOut();
      }
    }
  });
} else if ($("#mobile-nav, #mobile-nav-toggle").length) {
  $("#mobile-nav, #mobile-nav-toggle").hide();
}

// Initiate superfish on nav menu
$('#nav').superfish({
  animation: {
    opacity: 'show'
  },
  speed: 400
});


});

jQuery(window).on('resize', stickyNav);

function stickyNav() {
  // && jQuery(window).outerWidth() > 767
  $('#info-bb3d').waypoint(function(direction) {
    if (direction == "down") {
      $('#nav').addClass('sticky');
    } else {
      $('#nav').removeClass('sticky');
    }
  }, {
    offset: '10px;'
  });

}