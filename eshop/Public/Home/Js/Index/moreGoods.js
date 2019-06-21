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
			$(obj).children('span').removeClass('select-icon').addClass('select-icon-low');
			$(obj).children('span').removeClass('select-icon-up').addClass('select-icon-low');
		}
	}
	else{
		$(obj).attr('rel','desc');
		if(type === 2 || type === 3){
			$(obj).children('span').removeClass('select-icon-low').addClass('select-icon-up');
		}
	}
	// 当点击某个排序时其它兄弟节点都恢复默认状态
	if(type){
		$(obj).siblings('a').each(function(){
			$(this).attr('rel' , 'desc');
			$(this).children('span').removeClass().addClass('select-icon');
		});
	}
	var params = {};
	params.type = type;
	params.status = status;
	var pageType = $('#cats2').attr('vals');
	params.ptype = pageType;
	//获得影藏的分类值
	if(pageType == 'search'){
		params.name = $('#cats2').attr('goodName');
	}
	else{
		params.fmenu = $('#cats').attr('val');
		params.smenu = $('#cats').attr('rel');
		params.tmenu = $('#cats').attr('rels');
	}
	
	$.ajax({
 		type : 'post',
 		url : goodsOrder,
 		data : params,
		dataType : 'json' ,
 		success : function(data){
 			$(".lists_content").html(data);
 		},
 		error : function(){
 			layer.msg('请求出错了，稍后再试...',{icon:16}); 
 		}
 	})
}