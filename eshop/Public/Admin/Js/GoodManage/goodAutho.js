// 待审核商品脚本
	/**
	 * [goodAutho description]
	 * @param  {Number} type [description]
	 * @param  {[type]} id   [description]
	 * @return {[type]}      [description]
	 */
	function goodAutho(type=0,id){
		var params = {};
		var Ids;
		params.type = type;
		// 点击批量审核按钮
		if(type){
			Ids = checkedValues();
			if(!Ids.length){
				layer.msg('请先选择待审核商品！',{icon:5});
				return ;
			}
			params.Ids = Ids;
		}
		else{
			params.Ids = id;
		}
		layer.confirm('确定所选商品合格吗？',{icon:3},function(){
				$.ajax({
					type : 'post',
					url : 'goodAuthoDo',
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
