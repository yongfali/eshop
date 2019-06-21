// 用户收货地址管理脚本

$(function() {
	/**
	 * [添加真实姓名验证方法]
	 * @param  {[type]} value      [description]
	 * @param  {RegExp} element){               var tel [description]
	 * @param  {[type]} "真实姓名不合法"  [description]
	 * @return {[type]}            [description]
	 */
	jQuery.validator.addMethod("utrueName",function(value,element){
	  var tel = /^([\u4e00-\u9fa5a-zA-Z\.]{2,25})$/;
	  return this.optional(element)||(tel.test(value));
	},"真实姓名不合法");

	/**
	 * [添加联系方式证方法包括固定电话和移动号码]
	 * @param  {[type]} value      [description]
	 * @param  {RegExp} element){               var tel [description]
	 * @param  {[type]} "电话格式不正确！" [description]
	 * @return {[type]}            [description]
	 */
	jQuery.validator.addMethod("uTel",function(value,element){
	  var tel = /^((0\d{2,3}-\d{7,8})|(1[3584]\d{9}))$/;
	  return this.optional(element)||(tel.test(value));
	},"电话格式不正确！");
	
	/**
	 * [邮编格式验证]
	 * @param  {[type]} value          [输入的邮箱地址]
	 * @param  {RegExp} element){	var tel           [正则匹配表达式]
	 * @param  {[type]} "邮编不正确"        [提示信息]
	 * @return {[type]}                [匹配结果提示信息]
	 */
	jQuery.validator.addMethod("upostcode",function(value,element){
		var tel = /^[0-9]{6}$/;
		return this.optional(element) || (tel.test(value));
	},"邮编不正确");

    // 弹出添加用户收货地址layer脚本
    $("#addressEdit").click(function show(){
    	layer.open({
			type: 2,//参数为0-4,2表示为Iframe层
			title: '新增收货地址',
			shadeClose: true,
			shade: 0.6,
			area: ['660px', '460px'],
			content: 'http://localhost/eshop/index.php/UserCenter/addressedit.html',
			yes: function(index, layero){
				layer.close(index);
			}
		});
    });
    	 
	/**
	 * [用户新增收货地址验证提交]
	 * @return {[type]}                                    [description]
	 */
	$("#addAddress").validate({
		errorElement : 'span',
		success : function(lable){
			lable.addClass('success');
		},
		rules : {
			username : {
				required : true,
				utrueName : true
			},
			street : {
				required : true
			},
			postcode : {
				required : true,
				upostcode : true
			},
			usertel : {
				required : true,
				uTel : true
			}
		},
		messages : {
			username : {
				required : "不能为空"
			},
			street : {
				required : "不能为空"
			},
			postcode : {
				required : "不能为空"
			},
			usertel :{
				required : "不能为空"
			}
		},
		submitHandler : function(form){
			var param = $('#addAddress').serialize();
			$.ajax({
				type : 'post',
				url : 'addressAdd',
				dataType : 'json',
				data : param,
				beforeSend: function(){
					$(form).find(":submit").attr("disabled",true).attr("value","提交中");
				},
				success : function(msg){
					if(msg.status){
						layer.msg(msg.content,{icon:1});
						setTimeout('parent.document.location.reload()',3000);
					}
					else{
						layer.msg(msg.content,{icon:2});
					   setTimeout('parent.document.location.reload()',3000);//关闭layer Iframe并刷新页面
					}  
				},
				error : function(){
					layer.msg('请求出错了，稍后再试...',{icon:16}); 
				},
				complete :function(){
					$(form).find(":submit").removeAttr("disabled");  
				} 
			});
		},
		invalidHandler : function(form, validator){
			return false;
		}
	});

	//先弹出地址修改layer页面
	$('.modifyAddr').each(function(index, element) {
		$(this).click(function() {
			var id = $(this).attr('value');
			layer.open({
				type: 2,//参数为0-4,2表示为Iframe层
				title: '编辑收货地址',
				shadeClose: true,
				shade: 0.6,
				area: ['660px', '460px'],
				content: 'http://localhost/eshop/index.php/UserCenter/editAddrShow'+'?'+'id='+id //获取页面的时候传入当前地址的ID到台后去才能进行正常的模板渲染
			});
		});	
	});

	/**
	 * [用户收货地址编辑验证提交]
	 * @return {[type]}                                     [description]
	 */
	$("#modifyAddress").validate({
		errorElement : 'span',
		success : function(lable){
			lable.addClass('success');
		},
		rules : {
			username : {
				required : true,
				utrueName : true
			},
			street : {
				required : true
			},
			postcode : {
				required : true,
				upostcode : true
			},
			usertel : {
				required : true,
				uTel : true
			}
		},
		messages : {
			username : {
				required : "不能为空"
			},
			street : {
				required : "不能为空"
			},
			postcode : {
				required : "不能为空"
			},
			usertel :{
				required : "不能为空"
			}
		},
		submitHandler : function(form){
			var param = $("#modifyAddress").serialize();
			var urls = $("#modifyAddress").attr("value");
			$.ajax({
				type : 'post',
				url : urls,
				dataType : 'json',
				data : param,
				success : function(msg){
					if(msg.status){
						layer.msg(msg.content,{icon:1});
						setTimeout('parent.document.location.reload()',3000);
					}
					else{
						layer.msg(msg.content,{icon:2});
				    	setTimeout('parent.document.location.reload()',3000);//关闭layer Iframe并刷新页面
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
});

/**
 * [delAddr 删除用户收货地址]
 * @param  {[type]} id [收货地址ID序列号]
 * @return {[type]}    [删除操作后的提示信息]
 */
function delAddr(id){
	layer.confirm('确认删除该收货地址吗？',{icon:3},function(){
		$.ajax({
			type : "post",
			url : 'addressDel',
			dataType : "json",
			data : {
				"id" : id
			},
			success : function(msg){
				if(msg.status){
					layer.msg('删除成功！',{icon:1});
					location.reload();
				}
				else{
					layer.msg('删除失败！',{icon:2});
					location.reload();
				}
			},
			error : function(){
				layer.msg('请求出错了，稍后再试...',{icon:16}); 
			}
		});
	});
}

/**
 * [setDefaultAddr 设置用户收货地址为默认地址]
 * @param {[type]} id [收货地址ID序列号]
 */
function setDefaultAddr(id){
	layer.confirm('确认设置为默认地址？',{icon:3},function(){
		$.ajax({
			type : "post",
			url : 'addressDefault',
			dataType : "json",
			data : {
				"id" : id
			},
			success : function(msg){
				if(msg.status){
					layer.msg('设置成功！',{icon:1});
					location.reload();
				}
				else{
					layer.msg('设置失败！',{icon:2});
					location.reload();
				}
			},
			error : function(){
				layer.msg('请求出错了，稍后再试...',{icon:16}); 
			}
		});
	});
}