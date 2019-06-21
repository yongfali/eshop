// 店铺认证脚本
$(function(){
	// 弹出添加店铺认证layer脚本
    $("#add-autho").click(function show(){
    	layer.open({
			type: 2,//参数为0-4,2表示为Iframe层
			title: '新增店铺认证',
			shadeClose: true,
			shade: 0.6,
			area: ['460px', '320px'],
			content: 'http://localhost/eshop/index.php/Admin/ShopManage/addAutho.html',
			yes: function(index, layero){
				layer.close(index);
			}
		});
    });
    //店铺认证添加表单验证
    $('#addAuthoForm').validate({
    	ignore: [], //验证表单隐藏域的值
    	errorElement : 'span',
    	success : function (label) {
    		label.addClass('success');
    	},
    	rules : {
    		authoname : {
    			required : true
    		},
    		photo : {
    			required : true
    		}
    	},
    	messages : {
    		authoname : {
    			required : '不能为空'
    		},
    		photo : {
    			required : '请上传图标'
    		}	
    	},
    	submitHandler : function(form){
    		var param = new FormData($('#addAuthoForm')[0]);//[0]必须要否则没法上传文件
    		$.ajax({
    			type : 'post',
    			url : 'addAuthoDo',
    			dataType : 'json',
    			data : param,
    			// 以下三个参数必须要
    			cache: false, 
    			processData:false,
    			contentType:false, 
    			success : function(msg){
    				if(msg.status){
    					layer.msg(msg.content,{icon:1});
    					// setTimeout('window.location.href = index',1500);
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
});