// Home 模块公共脚本

/**
 * [ajax分页实现jquery1.9以上版本抛弃了live时间改用on]
 * @return {[type]}
 */
$(document).on('click','.pages a',function(){
	var pageObj = this;
	var url = pageObj.href;
	$.ajax({
		type:'post',
		url:url,
		success : function(data){
 			//html()会替换对应内容而不是追加
 			$(".ucenter_right_content").html(data);
 		},
 		error : function(){
 			layer.msg('请求出错了，稍后再试...',{icon:16}); 
 		}
 	})
	return false;
});

/**
 * [用户中心左侧导航栏选中样式切换]
 * @return {[type]}
 */
$(function(){
	$('.ucenter_left a').each(function() {
		if($($(this))[0].href == String(window.location)){
			$(this).addClass('item_hover').siblings().removeClass('item_hover');
			$(this).hover(function() {
				$(this).removeClass('item_hover')},function(){
					$(this).addClass('item_hover');
				});
		}
	});
});
