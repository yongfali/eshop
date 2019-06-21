/**
 * 用户登录前端验证脚本
 */
//点击刷新验证码
function changeVerify(){
 	var verifyUrl = $('#verify-img').attr('src');
 	$('#verify-img').attr('src', verifyUrl + '?' + Math.random());
}
$(function(){
	//jQuery Validate 表单验证
	/**
	 * 添加用户名验证方法
	 */
	jQuery.validator.addMethod("user", function(value, element) {   
	 	var tel = /^[\u4E00-\u9FA5a-zA-Z][\u4E00-\u9FA5a-zA-Z0-9]{3,20}$/;
	 	return this.optional(element) || (tel.test(value));
	}, " ");
	/**
	 *添加密码验证方法
	 *密码以字母开头包含字母数字和一些特殊字符长度至少为6位最长不超过36位
	 */
	jQuery.validator.addMethod("upwd",function(value,element){
	 	var tel = /^[a-zA-Z][a-zA-Z0-9\w]{5,36}$/;
	 	return this.optional(element) || (tel.test(value));
	}," ");
	$('#userlogin').validate({
	 	// errorElement : 'span',
	 	// success : function (label) {
	 	// 	label.addClass('success');
	 	// },
	 	rules : {
	 		account:{
	 			required : true,
	 			user : true
	 		},
	 		pwd : {
	 			required : true,
	 			upwd : true
	 		},
	 		verify1 : {
	 			required : true,
	 			remote :{
	 				url : checkVerify,
	 				type : 'post',
	 				dataType : 'json',
	 				data : {
	 					verify : function (){
	 						return $('#verify1').val();
	 					}
	 				}
	 			}
	 		}
	 	},
	 	messages : {
	 		account : {
	 			required : ' '
	 		},
	 		pwd : {
	 			required : ' '
	 		}, 		
	 		verify1 : {
	 			required : ' ',
	 			remote : ' '
	 		}
	 	},
	 	submitHandler : function(form){
	 		var param = $('#userlogin').serialize();
	 		$.ajax({
	 			type : 'post',
	 			url : doUserLogin,
	 			dataType : 'json',
	 			data : param,
	 			beforeSend: function(){
	 				$(form).find(":submit").attr("disabled",true).attr("value","登录中");
	 			},
	 			success : function(msg){
	 				if(msg.status){
	 					layer.msg(msg.content,{icon:6});
	 					setTimeout('window.location.href = index',3000);
	 				}
	 				else{
	 					layer.msg(msg.content,{icon:5});
	 					location.reload();
	 				}  
	 			},
	 			complete :function(){
	 				$(form).find(":submit").removeAttr("disabled");  
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