// 店铺信息编辑修改脚本
$(function(){
	//jQuery Validate 表单验证
	/**
	 * 添加商户名验证方法
	 */
	 jQuery.validator.addMethod("shop", function(value, element) {   
	 	var tel = /^[\u4E00-\u9FA5a-zA-Z][\u4E00-\u9FA5a-zA-Z0-9]{3,20}$/;
	 	return this.optional(element) || (tel.test(value));
	 }, "长度为4-20的字符串且不能以数字开头");
	 /**
	  * 添加qq号验证方法
	  */
	  jQuery.validator.addMethod("qqNum",function(value,element){
	  	var tel = /^\d{5,15}$/;
	  	return this.optional(element)||(tel.test(value));
	  },"qq格式不正确");
	 /**
	  * 添加联系方式证方法包括固定电话和移动号码
	  */
	  jQuery.validator.addMethod("Tel",function(value,element){
	  	var tel = /^((0\d{2,3}-\d{7,8})|(1[3584]\d{9}))$/;
	  	return this.optional(element)||(tel.test(value));
	  },"电话格式不正确！");
	  $('#shopInfo-edit').validate({
	  	errorElement : 'span',
	  	success : function (label) {
	  		label.addClass('success');
	  	},
	  	rules : {
	  		shopName : {
	  			required : true,
	  			shop : true,
	  			remote : {
	  				url : 'checkShopName',
	  				type : 'post',
	  				dataType : 'json',
	  				data : {
	  					shopName : function(){
	  						return $('#shopName').val();
	  					}
	  				}
	  			}
	  		},
	  		shopqq : {
	  			required : true,
	  			qqNum : true
	  		},
	  		shopTel : {
	  			required : true,
	  			Tel : true
	  		}
	  	},
	  	messages : {
	  		shopName : {
	  			required : '店铺名不能为空',
	  			remote : '该店铺名已被注册'
	  		},
	  		shopqq : {
	  			required : '客服QQ不能为空'
	  		},
	  		shopTel : {
	  			required : '客服电话不能为空'
	  		}
	  	},
	  	submitHandler : function(form){
	  		var param = new FormData($('#shopInfo-edit')[0]);
	  		$.ajax({
	  			type : 'post',
	  			url : 'shopInfoEdit',
	  			dataType : 'json',
	  			data : param,
	  			// 以下三个参数必须要
	  			cache: false, 
	  			processData:false,
	  			contentType:false,
	  			success : function(msg){
	  				if(msg.status){
	  					layer.msg(msg.content,{icon:6});
	  					location.reload();
	  				}
	  				else{
	  					layer.msg(msg.content,{icon:5});
	  				}  
	  			},
	  			error : function(){
	  				layer.msg('请求出错了，稍后再试...',{icon:16}); 
	  			} 
	  		});
	  	},
	  	invalidHandler : function(form, validator){
	  		layer.msg('表单信息填写不完全或还存在错误请确认无误后再提交！',{icon:5})
	  		return false;
	  	}
	  });
});
//店铺二维码上传前预览
function previewImage2(file){
  var MAXWIDTH  = 150; 
  var MAXHEIGHT = 150;
  var div = document.getElementById('preview2');
  if (file.files && file.files[0]){
    div.innerHTML ='<img id=Qrcode />';
    var img = document.getElementById('Qrcode');
    img.onload = function(){
      var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
      img.width  =  rect.width;
      img.height =  rect.height;
      img.style.marginTop = rect.top+'px';
    }
    var reader = new FileReader();
    reader.onload = function(evt){
      img.src = evt.target.result;
    }
    reader.readAsDataURL(file.files[0]);
  }
    else{//兼容IE
      var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
        file.select();
        var src = document.selection.createRange().text;
        div.innerHTML = '<img id=Qrcode>';
        var img = document.getElementById('Qrcode');
        img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
        var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
        status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
        div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;"+sFilter+src+"\"'></div>";
      }
}

//图片裁剪
function clacImgZoomParam( maxWidth, maxHeight, width, height ){
  var param = {
    top:0, left:0, width:width, height:height
  };
  if(width > maxWidth || height > maxHeight ){
    rateWidth = width/maxWidth;
    rateHeight = height/maxHeight;

    if(rateWidth > rateHeight ){
      param.width =  maxWidth;
      param.height = Math.round(height/rateWidth);
    }else{
      param.width = Math.round(width/rateHeight);
      param.height = maxHeight;
    }
  }
  param.left = Math.round((maxWidth - param.width)/2);
  param.top = Math.round((maxHeight - param.height)/2);
  return param;
}