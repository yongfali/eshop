// 操作记录脚本程序
/**
 * [delLog 用户操作记录删除]
 * @param  {[type]} id [操作记录ID序列号]
 * @return {[type]}    [返回删除状态]
 */
function delLog(id){
	layer.confirm('确定要删除该记录吗？',{icon:3},function(){
		$.ajax({
			type : "post",
			url : 'delLog',
			dataType : "json",
			data : {
				"logid" : id
			},
			success : function(msg){
				if(msg.status){
					layer.msg(msg.content,{icon:1});
					location.reload(); //重新当前页面
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
	});
}