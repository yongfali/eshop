// 消息列表脚本 
	$(function(){
		//信息发表脚本
		$('#articalAddForm').validate({
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
				var param = $('#articalAddForm').serialize();
				$.ajax({
					type : 'post',
					url : 'infoAdd',
					dataType : 'json',
					data : param,
					success : function(msg){
						if(msg.status){
							layer.msg('发布成功！',{icon:1});
							location.reload();
						}
						else{
							layer.msg('发布失败！',{icon:2});
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

   	 	//信息编辑处理脚本
	   	$('#articalEditForm').validate({
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
		  		var param = $('#articalEditForm').serialize();
		  		var url = $('#articalEditForm').attr('rel');
		  		$.ajax({
		  			type : 'post',
		  			url : url,
		  			dataType : 'json',
		  			data : param,
		  			success : function(msg){
		  				if(msg.status){
		  					layer.msg('编辑成功！',{icon:1});
		  					setTimeout('window.location.href = toURL',2000);
		  				}
		  				else{
		  					layer.msg('编辑失败！',{icon:2});
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

		//底部帮助中心列表内容编辑脚本
		$('#helpEditForm').validate({
			errorElement : 'span',
			success : function (label) {
				label.addClass('success');
			},
			rules : {
				title : {
					required : true
				},
				pid : {
					min : 1
				}
			},
			messages : {
				title : {
					required : '标题不能为空'
				},
				pid : {
					min : '分类不能为空！'
				}
			},
			submitHandler : function(form){
				var param = $('#helpEditForm').serialize();
				var url = $('#helpEditForm').attr('rel');
				$.ajax({
					type : 'post',
					url : url,
					dataType : 'json',
					data : param,
					success : function(msg){
						if(msg){
							layer.msg('编辑成功！',{icon:1});
							setTimeout('window.location.href = toURL',2000);
						}
						else{
							layer.msg('编辑失败！',{icon:2});
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

		//消息列表搜索
		$('#artical_select').click(function(){
	 		//获取消息分类
	 		var type = $('#cat1').val();
	 		var utype = $('#cat2').val();
	 		var infoTitle = $.trim($('#artical-title').val());
	 		if(type ==0 && utype == 0 && infoTitle.length == 0){
	 			layer.msg('查询条件不能为空',{icon:7});
	 			return false;
	 		}
	 		$.ajax({
	 			type : 'post',
	 			url : 'infoSearch',
	 			data : {
	 				'title' : infoTitle,
	 				'type' : type,
	 				'utype' : utype,
	 			},
	 			dataType : 'json',
	 			success : function (msg) {
	 				$(".ajaxWrapper").html(msg); 
	 			},
	 			error : function(){
	 				layer.msg('请求出错了，稍后再试...',{icon:16}); 
	 			}
	 		});
 		});
   	});
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
		layer.confirm('确定删除信息吗？',{icon:3},function(){
			$.ajax({
				type : 'post',
				url : 'infoDel',
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