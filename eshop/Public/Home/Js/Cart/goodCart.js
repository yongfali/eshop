// 购物车列表显示隐藏hover事件
$(function(){
  $('.cart_icon').on('mouseenter',function(){
    $(this).css('background','#eee');
    $('.cart-content').show();
  }).on('mouseleave',function(){
    $('.cart-content').hide();
    if($('.cart-content').data('events','mouseenter')){
      $('.cart-content').on('mouseenter', function(){
        $('.cart-content').show();
      });
    }
    else{
      $('.cart-content').hide();
    }
  });
  $('.cart-content').mouseleave(function() {
    $('.cart-content').hide();
  });
});