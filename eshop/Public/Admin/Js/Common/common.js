// 后台公共脚本
  /**
   * [previewImage 单图上传或修改前端预览处理IE是用了滤镜]
   * @param  {[type]} file [description]
   * @return {[type]}      [description]
   */
  function previewImage(file){
    var MAXWIDTH  = 150; 
    var MAXHEIGHT = 150;
    var div = document.getElementById('preview');
    if (file.files && file.files[0]){
      div.innerHTML ='<img id=img-logo />';
      var img = document.getElementById('img-logo');
      img.onload = function(){
        var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
        img.width  =  rect.width;
        img.height =  rect.height;
        // img.style.marginTop = rect.top+'px';
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
          div.innerHTML = '<img id=img-logo>';
          var img = document.getElementById('img-logo');
          img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
          var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
          status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
          // div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;"+sFilter+src+"\"'></div>";
        	div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;"+sFilter+src+"\"'></div>";
        }
  }

  /**
   * [clacImgZoomParam 图片裁剪]
   * @param  {[type]} maxWidth  [最大宽度]
   * @param  {[type]} maxHeight [最大高度]
   * @param  {[type]} width     [图片宽度]
   * @param  {[type]} height    [图片高度]
   * @return {[type]}           [description]
   */
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

  //ajax分页
  $(document).on('click','.pages a',function(){
    var pageObj = this;
    var url = pageObj.href;
    $.ajax({
      type:'post',
      url:url,
      success : function(data){
      //html()会替换对应内容而不是追加
      $(".ajaxWrapper").html(data);
    },
    error : function(){
      layer.msg('请求出错了，稍后再试...',{icon:16}); 
      }
    })
      return false;
  });