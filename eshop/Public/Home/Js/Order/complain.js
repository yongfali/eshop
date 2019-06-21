// 订单投诉脚本
$(function(){
	//投诉提交
	$('#complainSubmit').click(function(){
		var param = {};
		//投诉类型值获取
		var reason = parseInt($("input[type='radio']:checked").val());
		if(reason <= 0 || reason > 5){
			layer.msg('投诉类型不能为空！',{icon:5});
			return false;
		}
		// 投诉内容获取
		var contents = $.trim($('#contents').val());
		if(contents.length < 6 || contents.length > 150){
			layer.msg('投诉描述不能少于6个字且不能大于150个字！',{icon:5});
			return false;
		}	
		param.complainType = reason;
		param.reason = contents;
		param.orderId = $('#orderId').val();
		param.shopId = $('#shopId').val();
		$.ajax({
			type : 'post',
			url : complainSubmit,
			data : param,
			dataType : 'json',
			success : function (msg) {
				if(msg.status){
					layer.msg('投诉成功，等待处理...',{icon:1});
					setTimeout('window.location.href = orderWaitReceive',1000);
				}
				else{
					layre.msg('投诉失败！',{icon:2});
					location.reload();
				} 
			},
			error : function(){
				layer.msg('请求出错了，稍后再试...',{icon:16}); 
			}
		});
	});
});