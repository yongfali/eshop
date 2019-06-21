/**
*库存预警脚本
*/
//库存编辑修改事件，type：0表示现有库存，1表示预警库存
function editStock(obj,id,type){
	var val = $(obj).attr('value');//当前编辑框初始的value
	var val2 = obj.value;//当前编辑框修改的value
	// 对应兄弟输入框的值
	var val3 = $(obj).parent().parent().siblings('td').find('.inputs').attr('value');
	//判断编辑输入的是否为数字
	if(isNaN(val2)){
		layer.msg('输入非法！',{icon:2});
		return false;
	}
	//预警库存编辑
	if(type){
		if(val2 <= 0 || val2 >= val3){
			layer.msg("预警库存不可小于0或大于现有库存！",{icon:7});
			return false;
		}
	}
	//现有库存编辑
	else{
		if(val2 <=0 || val2 <=val3){
			layer.msg("库存量应大于预警库存数量！",{icon:7});
			return false;
		}
	}
	$.ajax({
		type : 'post',
		url : 'changeGoodStock',
		data : {'val' : val2, 'goodId' : id, 'type' : type},
		dataType : 'json',
		success : function (msg) {
			if(msg){
				layer.msg('编辑成功',{icon:1})
				location.reload();
			} 
			else{
				layer.msg('编辑失败',{icon:2})
				location.reload();
			}
		},
		error : function(){
			layer.msg('请求出错了，稍后再试...',{icon:16}); 
		}
	});
}