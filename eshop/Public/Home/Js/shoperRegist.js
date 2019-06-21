/**
*商家注册页面脚本
*/
// 显示商家注册协议脚本 
$(document).ready(function() {
	$("#protocolInfo").click(function show() {
		layer.open({
			type: 2,
			title: '商家注册协议',
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
  //点击验证码图片实现变化
  var verifyUrl = $('#s_verufyImg').attr('src');
  $('#s_verufyImg').click(function() {
  	$(this).attr('src', verifyUrl + '?' + Math.random());
  });
	//jQuery Validate 表单验证
	/**
	 * 添加商户名验证方法
	 */
	 jQuery.validator.addMethod("shop", function(value, element) {   
	 	var tel = /^[\u4E00-\u9FA5a-zA-Z][\u4E00-\u9FA5a-zA-Z0-9]{3,20}$/;
	 	return this.optional(element) || (tel.test(value));
	 }, "长度为4-20的字符串且不能以数字开头");
	 /**
	 *添加密码验证方法
	 *密码以字母开头包含字母数字和一些特殊字符长度至少为6位最长不超过36位
	 */
	 jQuery.validator.addMethod("spwd",function(value,element){
	 	var tel = /^[a-zA-Z][a-zA-Z0-9\w]{5,36}$/;
	 	return this.optional(element) || (tel.test(value));
	 },"以字母开头且长度为6-36的字符串");
	 /**
	  * 添加真实姓名验证方法
	  */
	  jQuery.validator.addMethod("strueName",function(value,element){
	  	var tel = /^([\u4e00-\u9fa5a-zA-Z\.]{2,25})$/;
	  	return this.optional(element)||(tel.test(value));
	  },"真实姓名不合法");
	 /**
	  * 添加身份证号验证方法
	  */
	  jQuery.validator.addMethod("scarNum",function(value,element){
	  	var tel = /^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/;
	  	return this.optional(element)||(tel.test(value));
	  },"身份证格式不正确");
	 /**
	  * 添加qq号验证方法
	  */
	  jQuery.validator.addMethod("qqNum",function(value,element){
	  	var tel = /^\d{5,15}$/;
	  	return this.optional(element)||(tel.test(value));
	  },"qq格式不正确");
	 /**
	  * 添加联系方式证方法包括固定电话和移动号码
	  */
	  jQuery.validator.addMethod("Tel",function(value,element){
	  	var tel = /^((0\d{2,3}-\d{7,8})|(1[3584]\d{9}))$/;
	  	return this.optional(element)||(tel.test(value));
	  },"电话格式不正确！");
	  $('#shop_regist').validate({
	  	errorElement : 'span',
	  	success : function (label) {
	  		label.addClass('success');
	  	},
	  	rules : {
	  		s_account : {
	  			required : true,
	  			shop : true,
	  			remote : {
	  				url : checkShoperName,
	  				type : 'post',
	  				dataType : 'json',
	  				data : {
	  					s_account : function(){
	  						return $('#s_account').val();
	  					}
	  				}
	  			}
	  		},
	  		s_pwd : {
	  			required : true,
	  			spwd : true
	  		},
	  		s_pwded : {
	  			required : true,
	  			equalTo : "#s_pwd"
	  		},
	  		s_email : {
	  			required : true,
	  			email : true,
	  			remote : {
	  				url : checkShoperEmail,
	  				type : 'post',
	  				dataType : 'json',
	  				data :{
	  					s_email : function (){
	  						return $('#s_email').val();
	  					}
	  				}
	  			}
	  		},
	  		truename : {
	  			required : true,
	  			strueName : true
	  		},
	  		carnum : {
	  			required : true,
	  			scarNum : true
	  		},
	  		qq : {
	  			qqNum : true
	  		},
	  		mobile : {
	  			required : true,
	  			Tel : true
	  		},
	  		shopname : {
	  			required : true,
	  			shop : true,
	  			remote : {
	  				type : 'post',
	  				url : checkShopName,
	  				dataType : 'json',
	  				data :{
	  					shopname : function (){
	  						return $('#shopname').val();
	  					}
	  				}
	  			}
	  		},
	  		service_qq : {
	  			qqNum : true
	  		},
	  		service_tel : {
	  			Tel : true
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
	  		s_account : {
	  			required : '商户名不能为空',
	  			remote: '商户名已被注册'
	  		},
	  		s_pwd : {
	  			required : '密码不能为空'
	  		},
	  		s_pwded : {
	  			required : '请确认密码',
	  			equalTo : '两次密码不一致'
	  		},
	  		s_email : {
	  			required : '请您填写邮箱',
	  			email : '您的邮箱格式不正确',
	  			remote : '该邮箱已经注册过了'
	  		},	
	  		truename : {
	  			required : '不能为空'
	  		},
	  		carnum : {
	  			required : '不能为空'
	  		},
	  		mobile : {
	  			required : '不能为空'
	  		},
	  		shopname : {
	  			required : '不能为空'
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
	  		var param = $('#shop_regist').serialize();
	  		$.ajax({
	  			type : 'post',
	  			url : doShoperRegist,
	  			dataType : 'json',
	  			data : param,
	  			success : function(msg){
	  				if(msg.status){
	  					layer.msg(msg.content,{icon:6});
	  					setTimeout('window.location.href = shoperLoginIndex',3000);
	  				}
	  				else{
	  					layer.msg(msg.content,{icon:5});
	  					 location.reload();
	  				}  
	  			},
	  			error : function(){
	  				layer.msg('请求出错了，稍后再试...',{icon:16}); 
	  			} 
	  		});
	  	},
	  	invalidHandler : function(form, validator){
	  		layer.msg('表单信息填写不完全或还存在错误请确认无误后再提交！',{icon:5})
	  		return false;
	  	}
	  });
});
// 分步注册脚本
$(function(){
	$("#wizard").scrollable({
		onSeek: function(event,i){//切换导航栏样式对应选中
			$("#status li").removeClass("active").eq(i).addClass("active");
		}
	});
});