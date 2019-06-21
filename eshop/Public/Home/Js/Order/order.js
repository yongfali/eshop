// 订单处理脚本
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
 			$("#Orders_List_Contetn").html(data);
 		},
 		error : function(){
 			layer.msg('请求出错了，稍后再试...',{icon:16}); 
 		}
 	})
	return false;
});

$(function(){
	//订单查询
	$('#order_select').click(function(){
		var payWay = $('#cat1').val();
		var orderNumber = $.trim($('#orderNum').val());
		if(payWay == 0 && orderNumber.length == 0){
			layer.msg('查询条件不能为空',{icon:7});
			return false;
		}
		//订单编号验证
		var reg = /^[0-9]{1,50}$/;
		if(orderNumber != '' && !reg.test(orderNumber)){
			layer.msg('订单编号非法',{icon:2});
			return false;
		}
		var type = $.trim($(this).attr('types'));
		$.ajax({
			type : 'post',
			url : 'orderSearch',
			data : {
				'payWay' : payWay,
				'orderNumber' : orderNumber,
				'type' : type,
			},
			dataType : 'json',
			success : function (msg) {
				if(msg.status){
					layer.msg('查询成功！',{icon:1});
					$("#Orders_List_Contetn").html(msg.content);
				}
				else{
					layer.msg(msg.content,{icon:2});
				} 
			},
			error : function(){
				layer.msg('请求出错了，稍后再试...',{icon:16}); 
			}
		});
	});

	/**
	* 添加物流单号验证方法（前期只验证为数字长度为12）
	*/
	jQuery.validator.addMethod("expressNum", function(value, element) {   
	 	var num = /^[1-9][0-9]{11}$/;
	 	return this.optional(element) || (num.test(value));
	}, "快递单号由12位数字组成");
	
	//商家订单发货物流信息填写
	$("#express").validate({
		errorElement : 'span',
		success : function(lable){
			lable.addClass('success');
		},
		rules : {
			companySelect : {
				min : 1
			},
			expressNumber : {
				required : true,
				expressNum : true
			}
		},
		messages : {
			companySelect : {
				min : "不能为空"
			},
			expressNumber :{
				required : "不能为空"
			}
		},
		submitHandler : function(form){
			var param = $("#express").serialize();
			$.ajax({
				type : 'post',
				url : 'orderDeliverDo',
				dataType : 'json',
				data : param,
				success : function(msg){
					if(msg.status){
						layer.msg(msg.content,{icon:1});
						setTimeout('parent.document.location.reload()',1000);
					}
					else{
						layer.msg(msg.content,{icon:2});
				    	setTimeout('parent.document.location.reload()',1000);//关闭layer Iframe并刷新页面
					}  
				},
				error : function(){
					layer.msg('请求出错了，稍后再试...',{icon:16}); 
				}
			});
		},
		invalidHandler : function(form, validator){
			return false;
		}
	});

	//用户取消订单操作
	$('#cancleSubmit').click(function(){
		var param = {};
		param.id = $('#orderId').attr('value');
		param.reasonId = $('#reasons').val();
		$.ajax({
			type : 'post',
			url : 'orderCancleDo',
			dataType : 'json',
			data : param,
			success : function(msg){
				if(msg.status){
					layer.msg(msg.content,{icon:1});
					setTimeout('parent.document.location.reload()',1000);
				}
				else{
					layer.msg(msg.content,{icon:2});
				    setTimeout('parent.document.location.reload()',1000);//关闭layer Iframe并刷新页面
				}  
			},
			error : function(){
				layer.msg('请求出错了，稍后再试...',{icon:16}); 
			}
		});
	});

	//用户拒收订单操作
	$('#rejectSubmit').click(function(){
		var param = {};
		param.id = $('#orderId').attr('value');
		param.reasonId = $('#reasons').val();
		$.ajax({
			type : 'post',
			url : 'orderRejectDo',
			dataType : 'json',
			data : param,
			success : function(msg){
				if(msg.status){
					layer.msg(msg.content,{icon:1});
					setTimeout('parent.document.location.reload()',1000);
				}
				else{
					layer.msg(msg.content,{icon:2});
				    setTimeout('parent.document.location.reload()',1000);//关闭layer Iframe并刷新页面
				}  
			},
			error : function(){
				layer.msg('请求出错了，稍后再试...',{icon:16}); 
			}
		});
	});
	
});

/**
 * [orderInfoDetail 商家订单发货处理]
 * @param  {[type]} id [订单ID序列号]
 * @return {[type]}    [description]
 */
function orderDeliver(id){
	//弹出layer层填写快递公司和单号
	layer.open({
		type: 2,//参数为0-4,2表示为Iframe层
		title: '请输入发货快递信息',
		shadeClose: true,
		shade: 0.6,
		area: ['520px', '260px'],
		content: 'http://localhost/eshop/index.php/Home/ShopOrders/express'+'?'+'orderId='+id,
		yes: function(index, layero){
			layer.close(index);
		}
	});
}

/**
 * [orderCancle 用户取消订单操作]
 * @param  {[type]} id [订单ID序列号]
 * @return {[type]}    [description]
 */
function orderCancle(id){
	//弹出layer层填写取消订单原因
	layer.open({
		type: 2,//参数为0-4,2表示为Iframe层
		title: '取消订单',
		shadeClose: true,
		shade: 0.6,
		area: ['460px', '260px'],
		content: 'http://localhost/eshop/index.php/Home/UserOrders/cancle'+'?'+'orderId='+id,
		yes: function(index, layero){
			layer.close(index);
		}
	});
}

/**
 * [orderReject 用户拒收订单操作]
 * @param  {[type]} id [订单ID序列号]
 * @return {[type]}    [description]
 */
function orderReject(id){
	//弹出layer层填写取消订单原因
	layer.open({
		type: 2,//参数为0-4,2表示为Iframe层
		title: '拒收订单',
		shadeClose: true,
		shade: 0.6,
		area: ['460px', '260px'],
		content: 'http://localhost/eshop/index.php/Home/UserOrders/reject'+'?'+'orderId='+id,
		yes: function(index, layero){
			layer.close(index);
		}
	});
}

/**
 * [orderDel 用户删除订单]
 * @param  {[type]} id [订单ID序列号]
 * @return {[type]}    [description]
 */
function orderDel(id){
	layer.confirm('确定删除该订单吗？',{icon:3},function(){
		$.ajax({
			type : 'post',
			url : 'orderDel',
			dataType : 'json',
			data : {'orderId':id},
			success : function(msg){
				if(msg.status){
					layer.msg('订单删除成功！',{icon:1});
					setTimeout('parent.document.location.reload()',1000);
				}
				else{
					layer.msg('订单删除失败！',{icon:2});
				    setTimeout('parent.document.location.reload()',1000);//关闭layer Iframe并刷新页面
				}  
			},
			error : function(){
				layer.msg('请求出错了，稍后再试...',{icon:16}); 
			}
		});
	});
}

/**
 * [toReceive 用户订单确认收货]
 * @param  {[type]} id [订单ID序列号]
 * @return {[type]}    [description]
 */
function toReceive(id){
	layer.confirm('您确定已收货吗？',{icon:3,title:'系统提示'},function(){
		$.ajax({
			type : 'post',
			url : 'orderReceive',
			dataType : 'json',
			data : {'orderId':id},
			success : function(msg){
				if(msg.status){
					layer.msg('收货成功！',{icon:1});
					setTimeout('parent.document.location.href = finished ',1000);
				}
				else{
					layer.msg('收货失败！',{icon:2});
				    setTimeout('parent.document.location.reload()',1000);//关闭layer Iframe并刷新页面
				}  
			},
			error : function(){
				layer.msg('请求出错了，稍后再试...',{icon:16}); 
			}
		});
	});
}	

/**
 * [toPay 用户未支付订单前往支付]
 * @param  {[type]} orderId [订单ID号]
 * @return {[type]}             [description]
 */
function toPay(orderId){
	$.ajax({
		type : 'post',
		url : 'orderToPay',
		dataType : 'json',
		data : {'orderId':orderId},
		success : function(msg){
			window.location.href = paymentIndex;
		},
		error : function(){
			layer.msg('请求出错了，稍后再试...',{icon:16}); 
		}
	});
}

/**
 * [Withdrawal 用户撤诉操作]
 * @param {[type]} orderId [投诉订单序列号]
 */
function Withdrawal(orderId){
	layer.confirm('您确定撤销投诉吗？',{icon:3,title:'系统提示'},function(){
		$.ajax({
			type : 'post',
			url : cancleComplain,
			dataType : 'json',
			data : {'orderId':orderId},
			success : function(msg){
				if(msg){
					layer.msg('撤诉成功！',{icon:1});
					location.reload();
				}
				else{
					layer.msg('撤诉成功！',{icon:2});
				}
			},
			error : function(){
				layer.msg('请求出错了，稍后再试...',{icon:16}); 
			}
		});
	});
}