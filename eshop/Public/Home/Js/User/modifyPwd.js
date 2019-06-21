//用户修改密码操作脚本
$(function(){
	/**
	 * [用户密码验证方法]
	 * @param  {[type]} value               [传入的密码]
	 * @param  {RegExp} element){	var      tel           [description]
	 * @param  {[type]} "以字母开头且长度为6-36的字符串" [description]
	 * @return {[type]}                     [返回匹配结果]
	 */
	jQuery.validator.addMethod("upwd",function(value,element){
		var tel = /^[a-zA-Z][a-zA-Z0-9\w]{5,36}$/;
		return this.optional(element) || (tel.test(value));
	},"以字母开头且长度为6-36的字符串");

	/**
	 * [用户密码修改操作]
	 * @return {[type]}                                                     [description]
	 */
	$('#umodifypwd_form').validate({
		errorElement : 'span',
		success : function(lable){
			lable.addClass('success');
		},
		rules : {
			unewpwd : {
				required : true,
				upwd : true
			},
			unewpwd1 : {
				required : true,
				equalTo : '#unewpwd'
			}
		},
		messages : {
			unewpwd : {
				required : '密码不能为空'
			},
			unewpwd1 : {
				required : '请填写确认密码',
				equalTo : '两次密码不一致'
			}
		},
		submitHandler : function(form){
			var param = $('#umodifypwd_form').serialize();
			$.ajax({
				type : 'post',
				url : 'doModifyPwd',
				dataType : 'json',
				data : param,
				beforeSend: function(){
					$(form).find(":submit").attr("disabled",true).attr("value","提交中");
				},
				success : function(msg){
					if(msg.status){
						layer.msg('修改成功！请重新登录！',{icon:1});
						location.reload();
					}
					else{
						layer.msg('修改失败！',{icon:2});
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
});