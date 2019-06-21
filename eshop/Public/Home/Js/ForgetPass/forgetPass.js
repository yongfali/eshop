// 密码忘记脚本

/**
 * [changeVerify 验证码更换]
 * @return {[type]} [description]
 */
function changeVerify(){
 	var verifyUrl = $('#verifyImg').attr('src');
 	$('#verifyImg').attr('src', verifyUrl + '?' + Math.random());
 }
$(function(){
 	//第一步填写账号名验证身份
 	$('#forgetPwdForm').validate({
	 	errorElement : 'span',
	 	success : function (label) {
	 		label.addClass('success');
	 	},
	 	rules : {
	 		account : {
	 			required : true,
	 			remote :{
	 				url : checkAccount,
	 				type : 'post',
	 				dataType : 'json',
	 				data : {
	 					account : function (){
	 						return $('#account').val();
	 					},
	 					utype : function(){
	 						return $('#utype').val();
	 					}
	 				}
	 			}
	 		},
	 		verifyCode : {
	 			required : true,
	 			remote :{
	 				url : checkVerify,
	 				type : 'post',
	 				dataType : 'json',
	 				data : {
	 					verifyCode : function (){
	 						return $('#verifyCode').val();
	 					},
	 					type : function(){
	 						return $('#verifyType').attr('val');
	 					}
	 				}
	 			}
	 		}
	 	},
	 	messages : {
	 		account : {
	 			required : '请输入账号',
	 			remote : '账号不存在'
	 		}, 		
	 		verifyCode : {
	 			required : '请输入验证码',
	 			remote : '验证码错误'
	 		}
	 	},
	 	submitHandler : function(form){
	 		var param = $('#forgetPwdForm').serialize();
	 		$.ajax({
	 			type : 'post',
	 			url : findPwd,
	 			dataType : 'json',
	 			data : param,
	 			success : function(msg){
	 				if(msg.status){
	 					layer.msg(msg.content,{icon:1});
	 					setTimeout('window.location.href = forgetPass2',1000);
	 				}
	 				else{
	 					layer.msg(msg.content,{icon:2});
	 					location.reload();
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
	
	// 找回方式切换
	$('#find-type').change(function(){
		var type = $(this).val();
		if(type == 'email'){
			$('.phone-verify').hide();
			$('.email-verify').show();
		}
		if(type == 'phone'){
			$('.phone-verify').show();
			$('.email-verify').hide();
		}
	});

	//密码找回第二步
	/**
	* 添加邮箱接收的验证码验证方法
	*/
	jQuery.validator.addMethod("code", function(value, element) {   
	 	var reg = /^[0-9]{6}$/;
	 	return this.optional(element) || (reg.test(value));
	}, "长度为6的数字");
	$('#forgetPwdForm2').validate({
	 	errorElement : 'span',
	 	success : function (label) {
	 		label.addClass('success');
	 	},
	 	rules : {
	 		emailVerifyCode : {
	 			required : true,
	 			code : true,
	 			remote :{
	 				url : 'checkEmailVerifyCode',
	 				type : 'post',
	 				dataType : 'json',
	 				data : {
	 					emailVerifyCode : function (){
	 						return $('#emailVerifyCode').val();
	 					}
	 				}
	 			}
	 		}
	 	},
	 	messages : {		
	 		emailVerifyCode : {
	 			required : '请输入验证码',
	 			remote : '验证码错误'
	 		}
	 	},
	 	submitHandler : function(form){
	 		var param = $('#forgetPwdForm2').serialize();
	 		$.ajax({
	 			type : 'post',
	 			url : findPwd,
	 			dataType : 'json',
	 			data : param,
	 			success : function(msg){
	 				if(msg.status){
	 					layer.msg(msg.content,{icon:1});
	 					setTimeout('window.location.href = forgetPass3',1000);
	 				}
	 				else{
	 					layer.msg(msg.content,{icon:2});
	 					location.reload();
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
	
	// 密码找回第三步-重置密码
	/**
	*添加密码验证方法
	*密码以字母开头包含字母数字和一些特殊字符长度至少为6位最长不超过36位
	*/
	jQuery.validator.addMethod("upwd",function(value,element){
	 	var reg = /^[a-zA-Z][a-zA-Z0-9\w]{5,36}$/;
	 	return this.optional(element) || (reg.test(value));
	 },"以字母开头且长度为6-36的字符串");
	$('#forgetPwdForm3').validate({
	 	errorElement : 'span',
	 	success : function (label) {
	 		label.addClass('success');
	 	},
	 	rules : {
	 		newPwd : {
	 			required : true,
	 			upwd : true
	 		},
	 		repwd : {
	 			required : true,
	 			equalTo : "#newPwd"
	 		}
	 	},
	 	messages : {		
	 		newPwd : {
	 			required : '请输入新密码'
	 		},
	 		repwd : {
	 			required : '请确认密码',
	 			equalTo : '两次密码不一致'
	 		}
	 	},
	 	submitHandler : function(form){
	 		var param = $('#forgetPwdForm3').serialize();
	 		$.ajax({
	 			type : 'post',
	 			url : 'resetPwdDo',
	 			dataType : 'json',
	 			data : param,
	 			success : function(msg){
	 				if(msg.status){
	 					layer.msg(msg.content,{icon:1});
	 					setTimeout('window.location.href = forgetPass4',1000);
	 				}
	 				else{
	 					layer.msg(msg.content,{icon:2});
	 					location.reload();
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
})
	//timer变量，控制时间
	var InterValObj; 
	//间隔函数，1秒执行
	var count = 60; 
	//当前剩余秒数	
	var curCount;

	/**
	 * [getCode 获取验证码按钮点击计时效果]
	 * @return {[type]} [description]
	 */
	function getCode(){
		curCount = count;
	    //设置button效果，开始计时
	    $("#sendCode").attr("disabled", "true");
	    InterValObj = window.setInterval(SetRemainTime, 1000); 
	    $.ajax({
	    	type : 'post',
	    	url : 'sendCodeByEmail',
	    	dataType : 'json',
	    	success : function(msg){
	    		if(msg){
	    			layer.msg('发送成功，请注意查收！',{icon:1});
	    		}
	    		else{
	    			layer.msg('发送失败，请重新发送！',{icon:2});
	    			location.reload();
	    		}  
	    	},
	    	error : function(){
	    		layer.msg('请求出错了，稍后再试...',{icon:16}); 
	    	} 
	    });
	}

	/**
	 * [SetRemainTime timer处理函数]
	 */
	function SetRemainTime(){
		if(curCount == 0) {  
			//停止计时器             
            window.clearInterval(InterValObj);
            //启用按钮
            $("#sendCode").removeAttr("disabled");
            $("#sendCode").val("重新发送验证码");
        }
        else{
            curCount--;
            $("#sendCode").val("发送中" + curCount + "秒");
        }
    }
