/*
** swipes.js
** calls click event on occurance of swipe event.

*/

jQuery(function($) {

jQuery('#orbitDemo')
.on('swipeleft', function(e) {
  $(".right").click();
})
.on('swiperight', function(e) {
  $(".left").click();
});

});