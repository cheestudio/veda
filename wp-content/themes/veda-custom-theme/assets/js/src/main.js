jQuery(document).ready(function($) {


/* Get Cookie function
========================================================= */
function getCookie(name) {
  var v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
  return v ? v[2] : null;
}


/* Set Cookie function
========================================================= */
function setCookie(name, value, days) {
  var d = new Date;
  d.setTime(d.getTime() + 24*60*60*1000*days);
  document.cookie = name + "=" + value + ";path=/;expires=" + d.toGMTString();
}


/* Mobile Nav Toggle
========================================================= */
$('.navbar-toggle').click(function() {
  $('.mobile-nav').fadeToggle();
  $(this).parent().toggleClass('open');
  $('.sub-menu').removeClass('sub-open');
  return false;
});


/* Mobile Nav with Flyout Menus
========================================================= */
$('.mobile-nav ul li').has('ul').prepend('<a href="#" class="expand" aria-label="Expand Menu"></a>');
$('.mobile-nav .sub-menu').prepend('<a href="#" class="close-sub"></a>');
$('.mobile-nav ul .menu-item-has-children > a.expand').click(function(e) {
  var current = $(this);
  e.preventDefault();
  $("~ ul", current).toggleClass('sub-open');
  $(current).toggleClass('expand-open');
});
$('.close-sub').click(function(e){
  e.preventDefault();
  $(this).parent().removeClass('sub-open');
});


/* Sub Navigation Titles on Mobile Nav
========================================================= */
$('.mobile-nav ul li.menu-item-has-children').each(function(){
  var navSectionTitle = $(this).find('.expand').next().html();
  $(this).find('.sub-menu').prepend('<div class="sub-menu-title">' + navSectionTitle + '</div>');
});


/* Smooth Internal Links
========================================================= */
$('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {
  if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname ) {
    var target = $(this.hash); target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
    if (target.length) {
      event.preventDefault(); $('html, body').animate({
        scrollTop: target.offset().top }, 800, function() {
          var $target = $(target); $target.focus();
          if ($target.is(":focus")) {
            return false;
          } else {
            $target.attr('tabindex','-1');
            $target.focus();
          }
        });
    }
  }
});


/* SlickJS Testimonials
========================================================= */
var slides = $('.slideshow-wrap');
if ( slides.length > 0 ) {
  slides.slick({
    autoplay: true,
    autoplaySpeed: 5000,
    appendArrows: $('.quote__content .nav-arrows'),
    prevArrow: '.quote__content .nav-arrows .prev-arrow',
    nextArrow: '.quote__content .nav-arrows .next-arrow'
  });
}


/* Article Index & Single - Accordion Toggles
========================================================= */
function accordion( trigger, content ) {
  trigger.click( function(e) {
    e.preventDefault();
    content.slideToggle('medium');
    trigger.find('.close').toggle();
    trigger.find('.open').toggle();
  });
}

// Page Navs
var indexTrigger = $('.article-hero--section-nav .toggle a');
var indexContent = $('.article-hero--section-nav .toggle-content');
if ( indexTrigger.length > 0 ) {
  accordion( indexTrigger, indexContent );
}

// References
var singleTrigger = $('.article-references--toggle a');
var singleContent = $('.article-references--content');
if ( singleTrigger.length > 0 ) {
  accordion( singleTrigger, singleContent );
}


/* View References - Create Links
========================================================= */
tags = $('.article-main-single--content .fl-rich-text, .post-single--content').find('sup');
refs = $('#view-references');
if ( (tags.length && refs.length) ) {
  tags.each( function(index, value) {
    $(this).wrap("<a href='#view-references' title='Click to View References'></a>");
  });

  tags.click(function() {
    singleContent.slideDown('slow');
    singleTrigger.find('.close').toggle();
    singleTrigger.find('.open').toggle();
  });
}


/* Search Bar
========================================================= */
searchIcon  = $('.top-nav-wrap #top-menu-1 li.nav-search a');
searchForm  = $('#nav-search-form');
searchInput = searchForm.find('input');
if ( (searchIcon.length && searchForm.length) ) {
  searchIcon.click( function() {
    searchForm.slideToggle(400);
    setTimeout( function() {
      searchInput.focus();
    }, 150)
  });
}


/* Articles - Read More Button ( TESTING )
========================================================= */
var toggle        = $('#article-readmore-toggle');
var content       = $('.article-main-single--content .fl-rich-text blockquote');
if ( (toggle.length && content.length) ) {
  content.nextAll().slideUp();
  content.parents('.fl-row').nextAll().slideUp();
  content.parents('.article-main-single--links').addClass('hide-content');

  toggle.click(function() {
    content.parents('.fl-row').nextAll().slideToggle();
    content.parents('.article-main-single--links').toggleClass('hide-content');
  });
}


}); // End Document Ready
