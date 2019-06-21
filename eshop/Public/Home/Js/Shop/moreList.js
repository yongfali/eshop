// 店铺商品更多现实脚本
// 左侧导航栏点击展现或隐藏事件
$(document).ready(function(){
	$('.nav_item').click(function() {
	    //判断当前ul列表是否显示
	    if($(this).next('.items_content').is(":visible")){
	    	$(this).next('.items_content').hide(500);
	    	$(this).find('p').removeClass('items_show').addClass('items_hidden');
	    }
	    else{
	    	$(this).next('.items_content').show(500);
	    	$(this).find('p').removeClass('items_hidden').addClass('items_show');
	    }
	});
});
/**
*商品列表按单价或销量排序显示
*type 的取值有1 2 3 分别表示综合排序，按单价和销量排序
*/
function goodOrder(obj,type){
	//获取当前标签的rel属性状态默认为desc
	var status = $(obj).attr('rel');
	//判断转态当点击后改变status属性
	if(status == 'desc'){
		$(obj).attr('rel','asc');
		//当点击单价按钮并且还未下降排序时
		if(type === 2 || type === 3){
			$(obj).children('span').removeClass('select_icon').addClass('select_icon_low');
			$(obj).children('span').removeClass('select_icon_up').addClass('select_icon_low');
		}
	}
	else{
		$(obj).attr('rel','desc');
		if(type === 2 || type === 3){
			$(obj).children('span').removeClass('select_icon_low').addClass('select_icon_up');
		}
	}
	// 当点击某个排序时其它兄弟节点都恢复默认状态
	if(type){
		$(obj).siblings('a').each(function(){
			$(this).attr('rel' , 'desc');
			$(this).children('span').removeClass().addClass('select_icon');
		});
	}
	var params = {};
	params.type = type;
	params.status = status;
	//获得影藏的分类值
	var pageType = $('#cats').attr('vals');
	params.shopId = $('#cats').attr('shopId');
	params.ptype = pageType;
	if(pageType == 'search'){
		params.name = $('#cats').attr('goodName');
	}
	else{
		params.cat1 = $('#cats').attr('val');
		params.cat2 = $('#cats').attr('rel');
	}
	$.ajax({
 		type : 'post',
 		url : goodsOrder,
 		data : params,
		dataType : 'json' ,
 		success : function(data){
 			$(".right_category_ajax").html(data);
 		},
 		error : function(){
 			layer.msg('请求出错了，稍后再试...',{icon:16}); 
 		}
 	})
}
//ajax分页
$(document).on('click','.pages a',function(){
 	var pageObj = this;
 	var url = pageObj.href;
 	$.ajax({
 		type:'post',
 		url:url,
 		success : function(data){
 			//html()会替换对应内容而不是追加
 			$(".right_category_ajax").html(data);
 		},
 		error : function(){
 			layer.msg('请求出错了，稍后再试...',{icon:16}); 
 		}
 	})
 	return false;
});
