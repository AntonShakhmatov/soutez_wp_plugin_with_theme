/* Scroll function */
$(document).ready(function() {

  var x = 95;
  var sirka = document.documentElement.clientWidth;

    if (sirka <= 2200) { var x = 78;};
    if (sirka <= 1650) { var x = 73;};
    if (sirka <= 1150) { var x = 63;};

    $('a[href^="#"]').on('click', function(e) {
      e.preventDefault();

      var target = this.hash;
      var $target = $(target);

      $('html, body').stop().animate({
        'scrollTop':  $target.offset().top - x
      }, 900)
    });
  }); 


/* Header */
  $(document).ready(function() {
  
    $(window).scroll(function() {
      var scroll = $(window).scrollTop();
      if (scroll >= 5) {
        $( "header" ).addClass('headerScroll');
      } else {
        $( "header" ).removeClass('headerScroll');
      }
  });
});

/* menu active */

/*** Burger and menu ***/
var burger = document.querySelector('.burger');
var menu = document.querySelector('.menu');
var logo = document.querySelector('.logo');

burger.onclick = () => {
burger.classList.toggle('is-active');
menu.classList.toggle('active');
logo.classList.toggle('block');
};

menu.onclick = () => {
  burger.classList.remove('is-active');
  menu.classList.remove('active');
  logo.classList.remove('block');
};