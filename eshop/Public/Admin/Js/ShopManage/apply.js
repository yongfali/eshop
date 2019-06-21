// 开店申请脚本
	$(function(){

	});

	/**
	 * [shopAutho 店铺审核通过]
	 * @param  {Number} type [审核类型，0：单个审核，1：批量审核]
	 * @param  {[type]} id   [单个审核的店铺ID]
	 * @return {[type]}      [description]
	 */
	function shopAutho(type=0,id){
		var params = {};
		var Ids;
		params.type = type;
		// 点击批量审核按钮
		if(type){
			Ids = checkedValues();
			console.log(Ids);
			if(!Ids.length){
				layer.msg('请先选择待审核店铺！',{icon:5});
				return ;
			}
			params.Ids = Ids;
		}
		else{
			params.Ids = id;
		}
		layer.confirm('确定所选店铺合格吗？',{icon:3},function(){
			$.ajax({
				type : 'post',
				url : 'shopAuthoDo',
				data : params,
				dataType : 'json',
				success : function (msg) {
					if(msg){
						layer.msg('操作成功！',{icon:1});
						location.reload();
					}
					else{
						layer.msg('操作失败！',{icon:2});
						location.reload();
					}    
				},
				error : function(){
					layer.msg('请求出错了，稍后再试...',{icon:16}); 
				}
			});
		});
	}

	/**
	 * [shopDel 待审核店铺删除]
	 * @param  {[type]} shopId   [店铺ID]
	 * @param  {[type]} shoperId [商家ID]
	 * @return {[type]}          [description]
	 */
	function shopDel(shopId,shoperId){
		var params = {};
		params.shopId = shopId;
		params.shoperId = shoperId;
		layer.confirm('确定删除该店铺申请吗？',{icon:3},function(){
			$.ajax({
				type : 'post',
				url : 'shoperDel',
				data : params,
				dataType : 'json',
				success : function (msg) {
					if(msg){
						layer.msg('删除成功！',{icon:1});
						setTimeout('location.reload();',2000);
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