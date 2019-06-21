// 公共脚本

/**
 * [SetHome 设为首页 http://www.eshop.lyf94.com]
 * @param {[type]} obj [对象]
 * @param {[type]} url [首页网址]
 */
function SetHome(obj,url){
	try{
		obj.style.behavior='url(#default#homepage)';
		obj.setHomePage(url);
	}
	catch(e){
		if(window.netscape){
			try{
				netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
			}catch(e){
				layer.msg("抱歉，此操作被浏览器拒绝！\n\n请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为'true'",{icon:5});
			}
		}else{
			layer.msg("抱歉，您所使用的浏览器无法完成此操作。\n\n您需要手动将【"+url+"】设置为首页。",{icon:5});
		}
	}
}

/**
 * [AddFavorite 收藏本站 http://www.eshop.lyf94.com]
 * @param {[type]} title [标题]
 * @param {[type]} url   [收藏的网址]
 */
function AddFavorite(title, url) {
	try {
		window.external.addFavorite(url, title);
	}
	catch (e) {
		try {
			window.sidebar.addPanel(title, url, "");
		}
		catch (e) {
			layer.msg("抱歉，您所使用的浏览器无法完成此操作。\n\n加入收藏失败，请使用Ctrl+D进行添加",{icon:5});
		}
	}
}

/**
 * [Collection 商品/店铺收藏处理]
 * @param {[type]} id   [收藏的ID序列号]
 * @param {[type]} type [收藏类型默认为0表示商品收藏，1表示店铺收藏]
 */
function Collection(id,type){
	var params = {};
	params.id = id;
	params.type = type;
	$.ajax({
 		type : 'post',
 		url : collections,
 		data : params,
		dataType : 'json' ,
 		success : function(msg){
 			if(msg.status){
 				layer.msg(msg.content,{icon:1});
 				location.reload();
 			}
 			else{
 				layer.msg(msg.content,{icon:2});
 				setTimeout('window.location.href = indexs',3000);
 			}
 		},
 		error : function(){
 			layer.msg('请求出错了，稍后再试...',{icon:16}); 
 		}
 	})
}

/**
 * [cancle 收藏取消]
 * @param  {[type]} id   [收藏的ID序列号]
 * @param  {[type]} type [收藏类型默认为0表示商品收藏，1表示店铺收藏]
 * @param  {[type]} uid  [收藏者的ID序列号]
 * @return {[type]}      [description]
 */
function cancle(id,type,uid){
	layer.confirm('确定取消关注吗？',{icon:3},function(){
		var params = {};
		params.id = id;
		params.type = type;
		params.uid = uid;
		$.ajax({
	 		type : 'post',
	 		url : cancles,
	 		data : params,
			dataType : 'json' ,
	 		success : function(msg){
	 			if(msg.status){
	 				layer.msg('取消成功！',{icon:1});
	 				location.reload();
	 			}
	 			else{
	 				layer.msg('取消失败！',{icon:2});
	 	 		}
	 		},
	 		error : function(){
	 			layer.msg('请求出错了，稍后再试...',{icon:16}); 
	 		}
	 	})
	});
}

/**
 * [addCarts 商品加入购物车处理]
 * @param {[type]} goodId [商品的ID序列号]
 * @param {Number} num    [num为商品的数量，默认为1]
 * @param {type} num    [type为操作方式，默认为0表示添加购物车，1表示立即购买]
 */
function addCarts(goodId,num=1){
	var params = {};
	params.goodId = goodId;
	params.num = num;
	$.ajax({
	 	type : 'post',
	 	url : addCart,
	 	data : params,
		dataType : 'json' ,
	 	success : function(msg){
	 		if(msg.status){
	 			layer.msg('添加成功！',{icon:1});
	 			location.reload();
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
}

/**
 * [delCarts 购物车商品删除操作]
 * @param  {[type]} goodId [商品的ID序列号]
 * @param  {[type]} type   [删除的类型0表示用户未登录cookie删除，1表示登录数据库删除]
 * @return {[type]}        [description]
 */
function delCarts(goodId,type){
	layer.confirm('确定删除该商品吗？',{icon:3},function(){
		var params = {};
		params.goodId = goodId;
		params.type = type;
		$.ajax({
		 	type : 'post',
		 	url : delCart,
		 	data : params,
			dataType : 'json' ,
		 	success : function(msg){
		 		if(msg.status){
		 			layer.msg('删除成功！',{icon:1});
		 			location.reload();
		 		}
		 		else{
		 			layer.msg('删除失败！',{icon:2});
		 	 	}
		 	},
		 	error : function(){
		 		layer.msg('请求出错了，稍后再试...',{icon:16}); 
		 	}
		})
	});
}

/**
 * [goodsSearch description]
 * @param  {Number} type [搜索类型默认为全站搜索，1店铺搜索]
 * @return {[type]}      [description]
 */
function goodsSearch(type=0){
	var keywords = $.trim($('#keyWords').val());
	var reg = /^[\u4E00-\u9F5A][\u4E00-\u9F5Aa-zA-Z0-9\.\-]{1,}$/;
	if(keywords == '' || keywords ==null){
		layer.msg('请输入搜索内容！',{icon:7});
		return false;
	}
	if(!reg.test(keywords)){
		layer.msg('搜索内容非法！',{icon:7});
		return false;
	}
	if(!type){
		url = "http://localhost/eshop/index.php/Home/Search/index"+"/"+"goodname"+"/"+keywords+"/"+"type"+"/"+type+".html";	
	}
	else{
		var shopId = $('#shopSerch').attr('rel');
		url = "http://localhost/eshop/index.php/Home/Search/index"+"/"+"shopId"+"/"+shopId+"/"+"goodname"+"/"+keywords+"/"+"type"+"/"+type+".html";
	}
	window.open(url);
}
