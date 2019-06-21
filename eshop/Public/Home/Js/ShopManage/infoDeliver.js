// 店铺信息发布脚本程序
$(function(){
	//jQuery Validate 表单验证
	$('#info-show').validate({
		errorElement : 'span',
	  	success : function (label) {
	  		label.addClass('success');
	  	},
	  	rules : {
	  		title : {
	  			required : true
	  		},
	  		type : {
	  			 min : 1
	  		}
	  	},
	  	messages : {
	  		title : {
	  			required : '标题不能为空'
	  		},
	  		type : {
	  			min : '类型不能为空！'
	  		}
	  	},
	  	submitHandler : function(form){
	  		var param = $('#info-show').serialize();
	  		$.ajax({
	  			type : 'post',
	  			url : 'infoSave',
	  			dataType : 'json',
	  			data : param,
	  			success : function(msg){
	  				if(msg.status){
	  					layer.msg('发布成功！',{icon:6});
	  					location.reload();
	  				}
	  				else{
	  					layer.msg('发布失败！',{icon:5});
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
	//信息列表ajax分页
	$(document).on('click','.pages a',function(){
		var pageObj = this;
		var url = pageObj.href;
		$.ajax({
			type:'post',
			url:url,
			success : function(data){
 			//html()会替换对应内容而不是追加
 			$("#infoList").html(data);
 		},
 		error : function(){
 			layer.msg('请求出错了，稍后再试...',{icon:16}); 
 			}
 		})
			return false;
	});
	// 信息全选事件
 	$(document).on('click','#allchecked',function(){
 		if($(this).prop("checked")){
 			$('.infoList_check').prop('checked',true);
 		}
 		else{
 			$('.infoList_check').prop('checked',false);
 		}	
 	}); 
 	$('.infoList_check').each(function(){
 		$(document).on('click',function(){
 			allChecked();
 		});
 	});
 	//全选框是否选中
 	function allChecked(){
 		var i = $('.infoList_check').size();//CheckBox总个数
 		var item = $('table tbody  :checkbox:checked').size();//判断选中的个数
 		if(i == item){
 			$('#allchecked').prop('checked',true);
 		}
 		else{
 			$('#allchecked').prop('checked',false);
 		}
 	}
 	//消息列表搜索
 	$('#info_select').click(function(){
 		//获取消息分类
 		var type = $('#type').val();
 		var infoTitle = $.trim($('#title').val());
 		if(type ==0 && infoTitle.length == 0){
 			layer.msg('查询条件不能为空',{icon:7});
 			return false;
 		}
 		$.ajax({
				type : 'post',
				url : 'searchInfos',
				data : {
					'title' : infoTitle,
					'type' : type,
				},
				dataType : 'json',
				success : function (msg) {
					$("#infoList").html(msg); 
				},
				error : function(){
					layer.msg('请求出错了，稍后再试...',{icon:16}); 
				}
			});
 	});
 	//店铺信息编辑处理
 	$('#info-edit').validate({
		errorElement : 'span',
	  	success : function (label) {
	  		label.addClass('success');
	  	},
	  	rules : {
	  		title : {
	  			required : true
	  		},
	  		type : {
	  			 min : 1
	  		}
	  	},
	  	messages : {
	  		title : {
	  			required : '标题不能为空'
	  		},
	  		type : {
	  			min : '类型不能为空！'
	  		}
	  	},
	  	submitHandler : function(form){
	  		var param = $('#info-edit').serialize();
	  		var url = $('#info-edit').attr('rel');
	  		$.ajax({
	  			type : 'post',
	  			url : url,
	  			dataType : 'json',
	  			data : param,
	  			success : function(msg){
	  				if(msg.status){
	  					layer.msg('编辑成功！',{icon:6});
	  					setTimeout('window.location.href = toURL',2000);
	  				}
	  				else{
	  					layer.msg('编辑失败！',{icon:5});
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
	/**
	*获取选中checkbox的value值
	*返回消息ID数组
	*/
	function checkedValues(){
		var InfoIds = new Array();
		var j = 0;
		$('.infoList_check').each(function() {
			if($(this).prop("checked")){
				InfoIds[j] = $(this).attr('value');
				j++;
			}
	    });
		 return InfoIds;
	}
	
	/**
	*消息列表批量删除和单个删除操作
	*type：0表示点击单个删除按钮，1表示点击批量删除按钮
	*id：单条信息对应的ID
	*/
	function delInfo(type,id){
		var params = {};
		var InfoIds ;
		params.type = type;
		// 点击批量删除按钮
		if(type){
			InfoIds = checkedValues();
			if(!InfoIds.length){
				layer.msg('请先选择消息！',{icon:5});
				return ;
			}
			params.InfoIds = InfoIds;
		}
		else{
			params.InfoIds = id;
		}
		layer.confirm('确定删除信息吗？',{icon:7},function(){
			$.ajax({
				type : 'post',
				url : 'delInfos',
				data : params,
				dataType : 'json',
				success : function (msg) {
					if(msg.status){
						layer.msg('删除成功！',{icon:1});
						setTimeout('location.reload();',2000);
					}
					else{
						layer.msg('删除失败！',{icon:5});
					}    
				},
				error : function(){
					layer.msg('请求出错了，稍后再试...',{icon:16}); 
				}
			});
		});
	}