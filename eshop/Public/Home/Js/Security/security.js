// 安全设置脚本文件
/**
 * [bindEmail 邮箱绑定/解绑操作]
 * @param  {[type]} email [操作的邮箱地址]
 * @param  {[type]} type  [操作类型]
 * @param  {[type]} utype [操作者身份默认为0表示用户，1表示管理员]
 * @return {[type]}       [description]
 */
function bindEmail(email,type,utype=0){
	var params = {};
	params.email = email;
	params.type = type;
	params.utype = utype;
	if(type == 'bind'){
		layer.confirm('您当前的邮箱为：'+email+'确定绑定吗？',{icon:3},function(){
			$.ajax({
				type : 'post',
				url : 'emailSetting',
				data : params,
				dataType : 'json' ,
				success : function(msg){
					if(msg){
						layer.msg('系统已发送邮件注意查收！',{icon:1});
					}
					else{
						layer.msg('发送失败！',{icon:2})
					}
				},
				error : function(){
					layer.msg('请求出错了，稍后再试...',{icon:16}); 
				}
			})
		});
	}
	else{
		layer.confirm('您确定解绑'+email+'？这样会降低账号安全性！',{icon:3},function(){
			$.ajax({
				type : 'post',
				url : 'emailSetting',
				data : params,
				dataType : 'json' ,
				success : function(msg){
					if(msg){
						layer.msg('系统已发送邮件注意查收！',{icon:1});
					}
					else{
						layer.msg('发送失败！',{icon:2})
					}
				},
				error : function(){
					layer.msg('请求出错了，稍后再试...',{icon:16}); 
				}
			})
		});
	} 	
}