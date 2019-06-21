// 后台登录脚本
//点击刷新验证码
function changeVerify(){
	var verifyUrl = $('#verifyCode').attr('src');
	$('#verifyCode').attr('src', verifyUrl + '?' + Math.random());
}
$('#loginForm').validate({
	errorElement : 'span',
	success : function (label) {
		label.addClass('success');
	},
	rules : {
		account:{
			required : true
		},
		pwd : {
			required : true
		},
		verify1 : {
			required : true,
			remote :{
				url : 'checkVerify',
				type : 'post',
				dataType : 'json',
				data : {
					verify : function (){
						return $('#verify-img').val();
					}
				}
			}
		}
	},
	messages : {
		account : {
			required : '账号不能为空'
		},
		pwd : {
			required : '密码不能为空'
		}, 		
		verify1 : {
			required : '验证码不能为空',
			remote : '验证码错误'
		}
	},
	submitHandler : function(form){
		var param = $('#loginForm').serialize();
		$.ajax({
			type : 'post',
			url : 'doLogin',
			dataType : 'json',
			data : param,
			success : function(msg){
				if(msg.status){
					layer.msg(msg.content,{icon:1});
					setTimeout('window.location.href = index',1500);
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