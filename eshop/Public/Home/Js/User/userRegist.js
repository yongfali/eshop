/**
 * 用户注册前端验证脚本
 */
$( function () {
	//点击刷新验证码
	var verifyUrl = $('#verify-img').attr('src');
	$('#verify-img').click(function () {
		$(this).attr('src', verifyUrl + '?' + Math.random());
	});
	//jQuery Validate 表单验证
	/**
	* 添加用户名验证方法
	*/
	jQuery.validator.addMethod("user", function(value, element) {   
	 	var tel = /^[\u4E00-\u9FA5a-zA-Z][\u4E00-\u9FA5a-zA-Z0-9]{3,20}$/;
	 	return this.optional(element) || (tel.test(value));
	}, "长度为4-20的字符串且不能以数字开头");
	/**
	*添加密码验证方法
	*密码以字母开头包含字母数字和一些特殊字符长度至少为6位最长不超过36位
	*/
	jQuery.validator.addMethod("upwd",function(value,element){
	 	var tel = /^[a-zA-Z][a-zA-Z0-9\w]{5,36}$/;
	 	return this.optional(element) || (tel.test(value));
	 },"以字母开头且长度为6-36的字符串");
	$('form[name=register]').validate({
	 	errorElement : 'span',
	 	success : function (label) {
	 		label.addClass('success');
	 	},
	 	rules : {
	 		account : {
	 			required : true,
	 			user : true,
	 			remote : {
	 				url : checkUserName,
	 				type : 'post',
	 				dataType : 'json',
	 				data : {
	 					account : function(){
	 						return $('#account').val();
	 					}
	 				}
	 			}
	 		},
	 		pwd : {
	 			required : true,
	 			upwd : true
	 		},
	 		pwded : {
	 			required : true,
	 			equalTo : "#pwd"
	 		},
	 		uemail : {
	 			required : true,
	 			email : true,
	 			remote : {
	 				url : checkUserEmail,
	 				type : 'post',
	 				dataType : 'json',
	 				data :{
	 					uemail : function (){
	 						return $('#uemail').val();
	 					}
	 				}
	 			}
	 		},
	 		verify : {
	 			required : true,
	 			remote :{
	 				url : checkVerify,
	 				type : 'post',
	 				dataType : 'json',
	 				data : {
	 					verify : function (){
	 						return $('#verify').val();
	 					}
	 				}
	 			}
	 		},
	 		protocol : {
	 			required : true
	 		}
	 	},
	 	messages : {
	 		account : {
	 			required : '用户名不能为空',
	 			remote: '用户名已被注册'
	 		},
	 		pwd : {
	 			required : '密码不能为空'
	 		},
	 		pwded : {
	 			required : '请确认密码',
	 			equalTo : '两次密码不一致'
	 		},
	 		uemail : {
	 			required : '请您填写邮箱',
	 			email : '您的邮箱格式不正确',
	 			remote : '该邮箱已经注册过了'
	 		},	 		
	 		verify : {
	 			required : ' ',
	 			remote : ' '
	 		},
	 		protocol : {
	 			required : '必须同意'
	 		}
	 	},
	 	submitHandler : function(form){
	 		var param = $('#register').serialize();
	 		$.ajax({
	 			type : 'post',
	 			url : doRegist,
	 			dataType : 'json',
	 			data : param,
	 			beforeSend: function(){
	 				$(form).find(":submit").attr("disabled",true).attr("value","注册中");
	 			},
	 			success : function(msg){
	 				if(msg.status){
	 					layer.msg(msg.content,{icon:1});
	 					setTimeout('window.location.href = userLoginIndex',3000);
	 				}
	 				else{
	 					layer.msg(msg.content,{icon:2});
	 					location.reload();
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
	//显示用户注册协议执行程序
	$("#protocolInfo1").click(function show1() {
	 	layer.open({
	 		type: 2,
	 		title: '用户注册协议',
	 		shadeClose: true,
	 		shade: 0.6,
	 		area: ['800px', ($(window).height() - 100) +'px'],
	 		content: 'registProtocol.html',
	 		btn: ['同意并注册'],
	 		yes: function(index, layero){
	 			layer.close(index);
	 		}
	 	});
	});
});