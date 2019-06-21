// 订单评价页面脚本
$(function(){
	var data = [ 
        [ 
            ['很差', '，从来没见过这么差的！'], 
            ['较差', '，差到没话说了！'], 
            ['一般', '，还过得去！'], 
            ['满意', '，还不错！'], 
            ['非常好', '，没见过这么好的了！'] 
        ], 
        [ 
            ['很慢', '，简直不能忍受了！'], 
            ['慢', '，慢的跟蜗牛一样！'], 
            ['一般', '，正常速度吧！'], 
            ['较快', '，要是再快点就好了！'], 
            ['非常快', '，火箭一般的速度！'] 
        ], 
        [ 
            ['很差', '，这服务没法忍受了！'], 
            ['较差', '，服务差到没边了！'], 
            ['一般', '，还过得去！'], 
            ['满意', '，客服比较热情还不错！'], 
            ['非常满意', '，服务太周到了！'] 
        ] 
	];

	var stars = [ 
        ['star_hover.png', 'star_gray.png', 'star_gray.png', 'star_gray.png', 'star_gray.png'], 
        ['star_hover.png', 'star_hover.png', 'star_gray.png', 'star_gray.png', 'star_gray.png'], 
        ['star_gold.png', 'star_gold.png', 'star_gold.png', 'star_gray.png', 'star_gray.png'], 
        ['star_gold.png', 'star_gold.png', 'star_gold.png', 'star_gold.png', 'star_gray.png'], 
        ['star_gold.png', 'star_gold.png', 'star_gold.png', 'star_gold.png', 'star_gold.png'], 
	];

	//星星悬浮触发 
	$(".stars").find("img").hover(function(){ 
		//当前对象 
    	var obj = $(this);
    	//当前父级.stars  
    	var star_area = obj.parent(".stars");
    	//当前父级.stars索引 
    	var star_area_index = star_area.index(); 
    	//当前星星索引
   		var index = obj.parent(".stars").find("img").index($(this));  
	    var left = obj.position().left; 
	    var top = obj.position().top + 25;
	    //标题  
	    var comment_title = data[star_area_index][index][0]; 
	    //描述 
    	var comment_description = data[star_area_index][index][1];
    	//显示定位提示信息  
	    $("#tip").css({ 
	        "left": left, 
	        "top": top 
	    }).show().html(comment_title); 
	    for (var i = 0; i < 5; i++) { 
	    	//切换每个星星 
	        star_area.find("img").eq(i).attr("src", "/eshop/Public/Home/Icon/" + stars[index][i]); 
	    } 
	    //星星右侧切换描述 
    	star_area.find(".comment_description").remove();
    	star_area.append("<span class='comment_description'>" + comment_title + "<span class='intro'>" + comment_description + "</span></span>"); 
	},

	//鼠标离开星星 
	function() { 
		//隐藏提示 
	    $("#tip").hide();
	    //当前对象  
	    var obj = $(this); 
	    //当前父级.stars 
	    var star_area = obj.parent(".stars");
	    //当前父级.stars索引  
	    var star_area_index = star_area.index();
	    //点击后的索引 
	    var index = star_area.attr("data-default-index"); 
	    //若该行点击后的索引大于等于0，说明该行星星已被点击  
	    if (index >= 0) {
	    	//标题 
	        var comment_title = data[star_area_index][index][0];
	        //描述  
	        var comment_description = data[star_area_index][index][1];
	        //显示切换描述  
	        star_area.find(".comment_description").remove(); 
	        star_area.append("<span class='comment_description'>" + comment_title + "<span class='intro'>" + comment_description + "</span></span>"); 
	        //更新该行星星 
	        for (var i = 0; i < 5; i++) { 
	            star_area.find("img").eq(i).attr("src", "/eshop/Public/Home/Icon/" + stars[index][i]); 
	        } 
	    } 
	    else { 
	        var obj = $(this); 
	        var star_area = obj.parent(".stars"); 
	        star_area.find(".comment_description").remove(); 
	        //更新该行星星都变初始状态
	        for (var i = 0; i < 5; i++) { 
	            star_area.find("img").eq(i).attr("src", "/eshop/Public/Home/Icon/star_gray.png");  
	        } 
	    } 
	})

	//当点击每颗星星 
	$(".stars").find("img").click(function() { 
	    var obj = $(this);
	    var star_area = obj.parent(".stars"); 
	    var star_area_index = star_area.index(); 
	    var index = obj.parent(".stars").find("img").index($(this)); 
	    var comment_title = data[star_area_index][index][0]; 
	    var comment_description = data[star_area_index][index][1]; 
	    star_area.attr("data-default-index", index); 
	    star_area.attr("value", index*2+2);
	    star_area.find(".comment_description").remove(); 
	    star_area.append("<span class='comment_description'>" + comment_title + "<span class='intro'>" + comment_description + "</span></span>"); 
	});

	//评论发表
	$('#appraiseSubmit').click(function(){
		var param = {};
		// 商品评分获取
		var goodScore = parseInt($('#goodScore').attr('value'));
		var logisticsScore = parseInt($('#logisticsScore').attr('value'));
		var serviceScore = parseInt($('#serviceScore').attr('value'));
		var contents = $.trim($('#contents').val());
		if(goodScore === 0 || logisticsScore === 0 || serviceScore === 0 || contents == ''){
			layer.msg('评论填写不完整！',{icon:5});
			return false;
		}
		if(contents.length < 6 || contents.length > 150){
			layer.msg('评论内容不能少于6个字且不能大于150个字！',{icon:5});
			return false;
		}
		param.goodScore = goodScore;
		param.logisticsScore = logisticsScore;
		param.serviceScore = serviceScore;
		param.contents = contents;
		param.goodId = $('#goodId').val();
		param.orderId = $('#orderId').val();
		param.shopId = $('#shopId').val();
		$.ajax({
			type : 'post',
			url : appraiseDo,
			data : param,
			dataType : 'json',
			success : function (msg) {
				if(msg.status){
					layer.msg('评论成功！',{icon:1});
					setTimeout('window.location.href = orderAppraised',1000);
				}
				else{
					layre.msg('评论失败！',{icon:2});
					location.reload();
				} 
			},
			error : function(){
				layer.msg('请求出错了，稍后再试...',{icon:16}); 
			}
		});
	});
});