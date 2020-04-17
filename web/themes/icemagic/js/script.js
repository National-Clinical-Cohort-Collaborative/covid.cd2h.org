/**
 * @file
 * script.js
 *
 * Theme custom scripts goes here.
 */

var Drupal = Drupal || {};

(function ($, Drupal, drupalSettings) {
  "use strict";
  // Add and remove extra class when a page is scrolled.
  $(window).scroll(function() {
    if ($(document).scrollTop() > $('#navbar').height()) {
      $('.navbar-fixed-top#navbar').addClass('scrolled');
      $('.navbar-fixed-top#navbar').removeClass('scroll-top');
    } else {
      $('.navbar-fixed-top#navbar').removeClass('scrolled');
      $('.navbar-fixed-top#navbar').addClass('scroll-top');
    }
  });
  
  // Add padding if the navbar is fixed for inner pages.
  
  $('body.path-innerpage.navbar-is-fixed-top').css('padding-top', $('header#navbar').height()+5, 'important');

$('.carousel').carousel();

//Enable swiping...
/*
$(".carousel").swipe({
    //Generic swipe handler for all directions
    swipeLeft: function(event, direction, distance, duration, fingerCount) {
        $(this).parent().carousel('next');
    },
    swipeRight: function() {
        $(this).parent().carousel('prev');
    },
    //Default is 75px, set to 0 for demo so any distance triggers swipe
    threshold: 0
});
*/


  })(jQuery, Drupal, drupalSettings);
