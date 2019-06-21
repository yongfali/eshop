// 店铺首页脚本事件
 $(function(){
    $('.shoper_recommend_title').find('span').each(function() {
        $(this).hover(function(){
			$(this).addClass('active').siblings('span').removeClass('active');
			var id = $(this).attr('rel');
			$('#'+id).css('display','block').siblings().css('display','none');
			});
    });;
  });