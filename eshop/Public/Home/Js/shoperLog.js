/**
*商家操作记录脚本
*/
function delLog(id){
	layer.confirm('确定要删除该记录吗？',{icon:7},function(){
		$.ajax({
			type : "post",
			url : delLogInfo,
			dataType : "json",
			data : {
				"logid" : id
			},
			success : function(msg){
				if(msg.status){
					layer.msg('删除成功！',{icon:1});
					location.reload(); //重新当前页面
				}
				else{
					layer.msg('删除失败！',{icon:2});
				}
			},
			error : function(){
				layer.msg('请求出错了，稍后再试...',{icon:16}); 
			}
		});
	});
}