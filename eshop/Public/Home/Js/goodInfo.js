/**
*商品详细信息脚本
*/
$(document).ready(function() {
	/* 放大镜图片载入 */
	$('.sp-wrap').smoothproducts();
	/*商品详情，商品评论，专享服务切换显示效果*/
	$('.details_nav').find('a').click(function() {
		$(this).addClass('nav_active').siblings().removeClass('nav_active');
	});
	$('.details_nav').find('a').click(function() {
		var numid = $(this).attr('rel');
		$("#"+numid).css("display", "block").siblings().css("display", "none");
	});
	/* 商品数量增加或减少事件*/
	$('.jian').click(function(){
		var num = $(".goodnum").val();     
		if(num>1){
			num--; 
			$(".goodnum").val(num);
		}
		else{
			layer.msg('数量最少为1',{icon:2});
		}
	});
	var stock = $('#goodStock').attr('value');
	var num1 = $('.goodnum').val();
	if((num1-stock)>0){
		$('.goodnum').val(1);
	}
	$('.jia').click(function(){
		var num = $('.goodnum').val();
		if((num-stock)>=0){
			layer.msg('数量不能超过库存！',{icon:2});
			return ;
		}
		else{
			num++;
			$('.goodnum').val(num);
		}
	});
	//商品收藏图标变化事件
	$('.goods_collection').hover(function(){
		$(this).children('img').attr('src','/eshop/Public/Home/Icon/good-collection-do.png');
	},function(){
		$(this).children('img').attr('src','/eshop/Public/Home/Icon/good-collection.png');
	});
});
	/**
	 * [purchase 立即购买]
	 * @param  {[type]} goodId [商品ID]
	 * @return {[type]}        [description]
	 */
	 function purchase(goodId){
	 	var params = {};
	 	params.goodId = goodId;
	 	$.ajax({
	 		type : 'post',
	 		url : goodPurchase,
	 		data : params,
	 		dataType : 'json' ,
	 		success : function(msg){
	 			if(msg.status){
	 				layer.msg('添加成功！',{icon:1});
	 				 setTimeout('window.location.href = toSettlement',1500);
	 			}
	 			else{
	 				layer.msg(msg.content,{icon:2});
	 				if(!msg.type){
	 					 setTimeout('window.location.href = userLogin',1500);
	 				}
	 				else{
	 					location.reload();
	 				}
	 			}
	 		},
	 		error : function(){
	 			layer.msg('请求出错了，稍后再试...',{icon:16}); 
	 		}
	 	});
	 }