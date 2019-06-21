/**
*eshop底部导航脚本程序
*左侧导航菜单三角形转换效果 
*/
$(document).ready(function(){
	var lis = $('.h_list');
	lis.each(function(index, element) {
		$(this).click(function(){
			$(this).find('ul').toggle("normal");
			if(!$(this).is(':hidden')){
				$(this).siblings().each(function(){
					$(this).children('ul').hide();
					$(this).find('span').children('p').removeClass('h_list_icon_show');
					$(this).find('span').children('p').addClass('h_list_icon_hidden');
				});
			}
			if($(this).find('span').children('p').hasClass('h_list_icon_show')){
				$(this).find('span').children('p').removeClass('h_list_icon_show');
				$(this).find('span').children('p').addClass('h_list_icon_hidden');
			}
			else{
				$(this).find('span').children('p').removeClass('h_list_icon_hidden');
				$(this).find('span').children('p').addClass('h_list_icon_show');
			}
		});
	});
});
//二级菜单对应显示下拉并选中效果
$(function(){
	$('#help_nav').find('a').each(function(index, element) {
		if($($(this))[0].href == String(window.location)){
			$(this).parent().css('display','block');
			$(this).parent().siblings('span').children('p').removeClass('h_list_icon_hidden');
			$(this).parent().siblings('span').children('p').addClass('h_list_icon_show');
			$(this).addClass('active');
			$(this).hover(function() {
				$(this).removeClass('active')},function(){
					$(this).addClass('active');
				});
		}
	});
});