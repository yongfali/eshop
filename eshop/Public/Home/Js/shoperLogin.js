/**
*商家登录执行脚本
*/
//点击验证码图片实现变化
function changeVerify(){
	var verifyUrl = $('#s_loginImg').attr('src');
	$('#s_loginImg').attr('src', verifyUrl + '?' + Math.random());
}
$(function(){
	//jQuery Validate 表单验证
	/**
	 * 添加商户名验证方法
	 */
	 jQuery.validator.addMethod("shoper", function(value, element) {   
	 	var tel = /^[\u4E00-\u9FA5a-zA-Z][\u4E00-\u9FA5a-zA-Z0-9]{3,20}$/;
	 	return this.optional(element) || (tel.test(value));
	 }, " ");
	 /**
	 *添加密码验证方法
	 *密码以字母开头包含字母数字和一些特殊字符长度至少为6位最长不超过36位
	 */
	 jQuery.validator.addMethod("spwd",function(value,element){
	 	var tel = /^[a-zA-Z][a-zA-Z0-9\w]{5,36}$/;
	 	return this.optional(element) || (tel.test(value));
	 }," ");
	 $('#shoperLogin').validate({
	 	errorElement : 'span',
	 	success : function (label) {
	 		label.addClass('success');
	 	},
	 	rules : {
	 		shopername:{
	 			required : true,
	 			shoper : true
	 		},
	 		shoper_pwd : {
	 			required : true,
	 			spwd : true
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
	 		shopername : {
	 			required : ' '
	 		},
	 		shoper_pwd : {
	 			required : ' '
	 		}, 		
	 		verify1 : {
	 			required : ' ',
	 			remote : ' '
	 		}
	 	},
	 	submitHandler : function(form){
	 		var param = $('#shoperLogin').serialize();
	 		$.ajax({
	 			type : 'post',
	 			url : doShoperLogin,
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
	 					setTimeout('location.reload()',3000);
	 				}  
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
	