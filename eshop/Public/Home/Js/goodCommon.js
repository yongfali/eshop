/**
*商品管理公共脚本
*/
// 导航标签的显示和影藏切换
$(function(){
  $('.good_nav').find('a').click(function(){
    $(this).addClass('active').siblings().removeClass('active');
  });
  $('.good_nav').find('a').click(function() {
    var id = $(this).attr('rel');
    if(id=="nav1"){
      $("#"+id).css("display", "block");
      $("#"+"nav2").css("display", "none");
      $("#"+"nav3").css("display", "none");
    }
    else if(id=="nav2"){
      $("#"+id).css("display", "block");
      $("#"+"nav1").css("display", "none");
      $("#"+"nav3").css("display", "none");
    }
    else{
      $("#"+id).css("display", "block");
      $("#"+"nav2").css("display", "none");
      $("#"+"nav1").css("display", "none");
    }
  });
});
/**
*店铺分类下拉菜单选择
*/
function getShopCart(obj){
  $(obj).next().empty();
   // 当前菜单项的ID
   var cartId = $(obj).val();
   var html = [];
   var url = $(obj).attr('action');
   html.push("<option value='' >-请选择-</option>");
   $.post(url,{"id":cartId},function(msg){
    if(msg['status'] && msg['content'].length>0){
      for (var i = 0; i < msg['content'].length; i++) {
        cart = msg['content'][i];
        html.push("<option value='"+msg['content'][i]['id']+"'>"+msg['content'][i]['sname']+"</option>");
      }
    }
    $(obj).next().append(html);
  });
}
/**
*商城分类下拉菜单选择
*id : 当前select的下一个兄弟节点对应的ID
*type ：0表示一级菜单，1表示二级菜单
*/
function getNextCart(id,obj,type){
    /**
    *如果为一级菜单时间则兄弟节点都初始化
    *防止出现二级菜单为空时，三级菜单没有初始化而显示上一次的菜单值
    */
    if($(obj).attr('id')=='wfirst'){
      $(obj).siblings().empty();
      $(obj).siblings().append("<option value='' >--请选择--</option>");
    }
    //下一级菜单清空初始化
    $('#'+id).empty();
    // 当前菜单项的ID
    var cartId = $(obj).val();
    // 数组html用来存储遍历添加的option选项
    var html = [];
    html.push("<option value='' >--请选择--</option>");
    $.post(getCart,{"id":cartId,"type":type,},function(msg){
      if(msg['status'] && msg['content'].length>0){
        for (var i = 0; i < msg['content'].length; i++) {
          cart = msg['content'][i];
          html.push("<option value='"+msg['content'][i]['id']+"'>"+msg['content'][i]['name']+"</option>");
        }
      }
      $('#'+id).append(html);
    });
}
/**
*商品logo上传或修改前端预览处理IE是用了滤镜。
*/
function previewImage(file){
  var MAXWIDTH  = 150; 
  var MAXHEIGHT = 150;
  var div = document.getElementById('preview');
  if (file.files && file.files[0]){
    div.innerHTML ='<img id=good_logo />';
    var img = document.getElementById('good_logo');
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
        div.innerHTML = '<img id=good_logo>';
        var img = document.getElementById('good_logo');
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
/**
*商品图册上传后，删除上传成功后的照片
*$type为0表示图片只是上传未保存到数据库，1表示已经保存到数据库了
*/
function delImg(obj,type){
  var params = {};
  params.type = type;
  if(!type){
    params.img_url = $(obj).parent('.delImg').next('input').attr('value');
    params.thumb_url = $(obj).parent('.delImg').next().next().attr('value');
  }
  else{
    params.id = $(obj).attr('value');
  }
  layer.confirm('确认删除该图片吗？',{icon:7},function(){
    $.ajax({
      type : "post",
      url : delImgItem,
      dataType : "json",
      data : params,
      success : function(msg){
        if(msg.status){
          layer.msg('删除成功！',{icon:1});
              $(obj).parent().parent().remove();//删除对应的父节点让图片不再显示
            }
            else{
              layer.msg('删除失败！',{icon:5});
            }
          },
          error : function(){
            layer.msg('请求出错了，请稍后重试...',{icon:5})
          }
        });
  });
}

