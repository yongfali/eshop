/**
*商家修改登录密码脚本
*/
$(function(){
	var url = $('#smodifypwd_form').attr('rel');
	jQuery.validator.addMethod("spwd",function(value,element){
	 	var tel = /^[a-zA-Z][a-zA-Z0-9\w]{5,36}$/;
	 	return this.optional(element) || (tel.test(value));
	 },"以字母开头且长度为6-36的字符串");
	 $('#smodifypwd_form').validate({
	 	errorElement : 'span',
	  	success : function (label) {
	  		label.addClass('success');
	  	},
	  	rules : {
	  		soldpwd : {
	  			required : true,
	  			spwd : true,
	  			remote : {
	  				url : 'checkPwd',
	  				type : 'post',
	  				dataType : 'json',
	  				data : {
	  					soldpwd : function(){
	  						return $('#soldpwd').val();
	  					}
	  				}
	  			}
	  		},
	  		snewpwd : {
	  			required : true,
	  			spwd : true
	  		},
	  		snewpwd1 : {
	  			required : true,
	  			spwd : true,
	  			equalTo : "#snewpwd"
	  		},
	  	},
	  	messages : {
	  		soldpwd : {
	  			required : '不能为空！',
	  			remote : '原密码不正确！'
	  		},
	  		snewpwd : {
	  			required : '不能为空！'
	  		},
	  		snewpwd1 : {
	  			required : '不能为空！',
	  			equalTo : '两次密码不一致'
	  		}
	  	},
	  	submitHandler : function(){
	  		var param = $('#smodifypwd_form').serialize();
	  		$.ajax({
	  			type : 'post',
	  			url : url,
	  			dataType : 'json',
	  			data : param,
	  			success : function(msg){
	  				if(msg.status){
	  					layer.msg(msg.content,{icon:6});
	  					location.reload();
	  				}
	  				else{
	  					layer.msg(msg.content,{icon:5});
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