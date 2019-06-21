/**
*商品待审核脚本
*/
$(function(){
 	// 商品全选事件
 	$(document).on('click','#allchecked',function(){
 		if($(this).prop("checked")){
 			$('.goods_check').prop('checked',true);
 		}
 		else{
 			$('.goods_check').prop('checked',false);
 		}	
 	}); 
 	$('.goods_check').each(function(){
 		$(document).on('click',function(){
 			allChecked();
 		});
 	});
 	//全选框是否选中
 	function allChecked(){
 		var i = $('.goods_check').size();//CheckBox总个数
 		var item = $('table tbody  :checkbox:checked').size();//判断选中的个数
 		if(i == item){
 			$('#allchecked').prop('checked',true);
 		}
 		else{
 			$('#allchecked').prop('checked',false);
 		}
 	}	
 	//ajax分页实现jquery1.9以上版本抛弃了live时间改用on
 	// 待审核商品ajax分页
 	$(document).on('click','.pages a',function(){
 		var pageObj = this;
 		var url = pageObj.href;
 		$.ajax({
 			type:'post',
 			url:url,
 			success : function(data){
 				//html()会替换对应内容而不是追加
 				$("#Good_List_Contetn").html(data);
 			},
 			error : function(){
 				layer.msg('请求出错了，稍后再试...',{icon:16}); 
 			}
 		})
 		return false;
 	});
});
	/*
	*商品批量下架/上架处理方法
	*/
	function offShelf(type){
		var goodIds = checkedValues();
		var params = {};
		params.type = type;
		if(!goodIds.length){
			layer.msg('请先选择商品！',{icon:5});
		}
		else{
			params.goodIds = goodIds;
			$.ajax({  
				url: changeStatus,  
				type: 'post', 
				data: params, 
				dataType : 'json',
			success : function (msg) {
				if(msg.status){
					layer.msg(msg.content,{icon:1});
					setTimeout('location.reload();',2000);
				}
				else{
					layer.msg(msg.content,{icon:5});
				}    
			},
			error : function(){
				layer.msg('请求出错了，稍后再试...',{icon:16}); 
			}
	      });
		}
	}
	/**
	*商品推荐属性改变，批量推荐、新品，热销操作
	*/
	function changePro(type){
		var goodIds = checkedValues();
		var params = {};
		params.type = type;
		params.goodIds = goodIds;
		if(!goodIds.length){
			layer.msg('请先选择商品！',{icon:5});
			return ;
		}
		$.ajax({
			type : 'post',
			url : changePros,
			data : params,
			dataType : 'json',
			success : function (msg) {
				if(msg.status){
					layer.msg(msg.content,{icon:1});
					setTimeout('location.reload();',2000);
				}
				else{
					layer.msg(msg.content,{icon:5});
				}    
			},
			error : function(){
				layer.msg('请求出错了，稍后再试...',{icon:16}); 
			}
		});
	}
	/**
	*商品批量删除和单个删除操作
	*type：0表示点击单个删除按钮，1表示点击批量删除按钮
	*id：单个商品对应的ID
	*/
	function delGoods(type,id){
		var params = {};
		var goodIds ;
		params.type = type;
		// 点击批量删除按钮
		if(type){
			goodIds = checkedValues();
			if(!goodIds.length){
				layer.msg('请先选择商品！',{icon:5});
				return ;
			}
			params.goodIds = goodIds;
		}
		else{
			params.goodIds = id;
		}
		layer.confirm('确定删除商品吗？',{icon:7},function(){
			$.ajax({
				type : 'post',
				url : goodDel,
				data : params,
				dataType : 'json',
				success : function (msg) {
					if(msg.status){
						layer.msg(msg.content,{icon:1});
						setTimeout('location.reload();',2000);
					}
					else{
						layer.msg(msg.content,{icon:5});
					}    
				},
				error : function(){
					layer.msg('请求出错了，稍后再试...',{icon:16}); 
				}
			});
		});
	}

	/**
	*获取选中checkbox的value值
	*返回商品ID数组
	*/
	function checkedValues(){
		var goodIds = new Array();
		var j = 0;
		$('.goods_check').each(function() {
			if($(this).prop("checked")){
				goodIds[j] = $(this).attr('value');
				j++;
			}
	    });
		 return goodIds;
	}
	/**
	*商品搜索分类ID获取或者输入框值传递
	*/
	$(function(){
		$('#goods_select').click(function(){
			var type = $(this).attr('types');
			var fid = $('#cat1').val();
			var sid = $('#cat2').val();
			var url = $('#Good_Search').attr('action');
			var goodsName = $.trim($('#goodsName').val());
			if(fid == 0 && goodsName.length ==0){
				layer.msg('查询条件不能为空',{icon:7});
				return false;
			}
			// 商品名称验证中文字母开头长度至少为1
			var reg = /^[\u4E00-\u9F5A][\u4E00-\u9F5Aa-zA-Z0-9\.]{1,24}$/;
			if(goodsName !=''){
				if(!reg.test(goodsName)){
					layer.msg('商品名称非法',{icon:2});
					return false;
				}
			}	
			$.ajax({
				type : 'post',
				url : url,
				data : {
					'cat1' : fid,
					'cat2' : sid,
					'goodsName' : goodsName,
					'type' : type,
				},
				dataType : 'json',
				success : function (msg) {
					$("#Good_List_Contetn").html(msg); 
				},
				error : function(){
					layer.msg('请求出错了，稍后再试...',{icon:16}); 
				}
			});
		});
	});
    
