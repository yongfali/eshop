// 购物车结算事件
$(function(){
	//更多地址显示/影藏切换
	$('#moreAddress').click(function(){
		$('.addrList').toggle(500);
	});

	//当地址被选中是编辑和设为默认按钮显示
	$('input:radio[name="addr"]').each(function(){
		if($(this).is(':checked')){
			$(this).parent().parent().siblings('.item-right').css('display','block');
		}
		else{
			$(this).parent().parent().siblings('.item-right').css('display','none');
		}
		$(this).click(function(){
			if($(this).is(':checked')){
				$(this).parent().parent().siblings('.item-right').css('display','block');
				$(this).parent().parent().parent().siblings('.addrListItem').each(function(){
					$(this).children('.item-right').css('display','none');
				});
			}
			else{
				$(this).parent().parent().siblings('.item-right').css('display','none');
			}
		});
	});
});

/**
 * [orderSubmit 订单提交处理]
 * @param  {[type]} obj [当前对象]
 * @return {[type]}     [description]
 */
function orderSubmit(obj){
	var item = {};
	var reg = /^[\u4e00-\u9fa5\w][\u4e00-\u9fa5\w\uFE30-\uFFA0]{0,50}$/;
	var flag = true;
	// 收货地址ID序列号获取
	var addrId = $('input:radio[name="addr"]:checked').val();
	//支付类型ID获取，1表示支付宝支付，2表示微信支付，3表示银联支付
	var payId = $('input:radio[name="payway"]:checked').val();
	//获取商品清单信息
	$('.order-item').each(function(i,element){
		item[i] = {};
		item[i]['payId'] = payId;
		//获取当前店铺信息
		item[i]['shopId'] = $(this).children('.shopinfo').find('input:hidden[name="shopId"]').val();
		//获取当前清单商品基本信息
		item[i]['goodId'] = $(this).children('.order-info').find('input:hidden[name="goodId"]').val();
		item[i]['goodNumber'] = $.trim($(this).children('.order-info').find('.goodNumber').text());
		item[i]['goodName'] = $.trim($(this).children('.order-info').children('.goodInfo').find('span').text());
		item[i]['goodImg'] = $.trim($(this).children('.order-info').children('.goodInfo').find('img').attr('src'));
		item[i]['goodPrice'] = $.trim($(this).children('.order-info').find('.price').text());
		item[i]['goodMount'] = $.trim($(this).children('.order-info').find('.mount').text());
		item[i]['goodItemPrice'] = $.trim($(this).children('.order-info').find('.itemPrice').text());
		//获取当前商品订单留言
		var messages = $.trim($(this).children('.order-message').find('input:text[name="messages"]').val());
		if(messages !== ''){
			if(!reg.test(messages)){
				var shopname = $(this).children('.shopinfo').find('.shopName').text();
				layer.msg('给'+shopname+'留言内容非法，不符合要求！',{icon:5});
				flag = false;
				return false;
			}
			item[i]['messages'] = messages;
		}
	});
	if(flag){
		$.ajax({
			type : 'post',
			url : 'success',
			data : {'params' : item, 'addrId' : addrId},
			dataType : 'json',
			success : function (msg) {
				if(msg.status){
					layer.msg('订单提交成功！',{icon:1});
					setTimeout('window.location.href = paymentIndex',1000);
				}
				else{
					layer.msg('订单提交失败！',{icon:2});
				}    
			},
			error : function(){
				layer.msg('请求出错了，稍后再试...',{icon:16}); 
			}
		});
	}
}