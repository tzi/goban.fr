$(function(){
  $('.action').click(function(el){
    el = $(el.target);
    if ( ! el.hasClass('stone') ) {
      el.addClass('stone black');
    } else {
      if ( el.hasClass('black') ) {
        el.removeClass('black').addClass('white');
      } else {
        el.removeClass('stone white');
      }
    }
  });
});
