// 用户个人资料修改脚本

/**
 * [添加用户昵称验证方法]
 * @param  {[type]} value                 [description]
 * @param  {RegExp} element){var tel [description]
 * @param  {[type]} "长度为4-20的字符串且不能以数字开头" [description]
 * @return {[type]}                       [description]
 */
jQuery.validator.addMethod("unickName", function(value, element){   
  var tel = /^[\u4E00-\u9FA5a-zA-Z][\u4E00-\u9FA5a-zA-Z0-9]{3,20}$/;
  return this.optional(element) || (tel.test(value));
}, "长度为4-20的字符串且不能以数字开头");

/**
 * [添加真实姓名验证方法]
 * @param  {[type]} value      [description]
 * @param  {RegExp} element){               var tel [description]
 * @param  {[type]} "真实姓名不合法"  [description]
 * @return {[type]}            [description]
 */
jQuery.validator.addMethod("utrueName",function(value,element){
  var tel = /^([\u4e00-\u9fa5a-zA-Z\.]{2,25})$/;
  return this.optional(element)||(tel.test(value));
},"真实姓名不合法");

/**
 * [添加身份证号验证方法]
 * @param  {[type]} value      [description]
 * @param  {RegExp} element){               var tel [description]
 * @param  {[type]} "身份证格式不正确" [description]
 * @return {[type]}            [description]
 */
jQuery.validator.addMethod("ucarNum",function(value,element){
  var tel = /^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/;
  return this.optional(element)||(tel.test(value));
},"身份证格式不正确");

/**
 * [添加qq号验证方法]
 * @param  {[type]} value      [description]
 * @param  {RegExp} element){               var tel [description]
 * @param  {[type]} "qq格式不正确"  [description]
 * @return {[type]}            [description]
 */
jQuery.validator.addMethod("uqqNum",function(value,element){
  var tel = /^\d{5,15}$/;
  return this.optional(element)||(tel.test(value));
},"qq格式不正确");

/**
 * [添加联系方式证方法包括固定电话和移动号码]
 * @param  {[type]} value      [description]
 * @param  {RegExp} element){               var tel [description]
 * @param  {[type]} "电话格式不正确！" [description]
 * @return {[type]}            [description]
 */
jQuery.validator.addMethod("uTel",function(value,element){
  var tel = /^((0\d{2,3}-\d{7,8})|(1[3584]\d{9}))$/;
  return this.optional(element)||(tel.test(value));
},"电话格式不正确！");

/**
 * [用户信息修改验证提交]
 * @return {[type]}       [编辑结果提示信息]
 */
$(function(){
  $("#uinfo_form").validate({
    errorElement : 'span',
    success : function (label) {
      label.addClass('success');
    },
    rules : {
      nick : {
        unickName : true,
        remote : {
          url : 'checkuNickname',
          type : 'post',
          dataType : 'json',
          data : {
            unick : function(){
              return $('#unick').val();
            }
          }
        }
      },
      truename : {
        utrueName : true
      },
      carnum : {
        ucarNum : true
      },
      qq : {
        uqqNum : true
      },
      tel : {
        uTel : true
      }
    },
    messages : {
      nick :{
        remote : "该昵称已被使用"
      } 
    },
    submitHandler : function(form){//前端validate验证通过则ajax提交数据
      var param = new FormData($('#uinfo_form')[0]);
      $.ajax({
        type : 'post',
        url : 'userinfoEdit',
        dataType : 'json',
        cache: false, 
        processData:false,
        contentType:false,
        data : param,
        success : function(msg){
          if(msg.status){
            layer.msg(msg.content,{icon:1});
            location.reload(); //重新当前页面
          }
          else{
            layer.msg(msg.content,{icon:2});
          }
        },
        error : function(){
          layer.msg('请求出错了，稍后再试...',{icon:16}); 
        }
      });
    },
    invalidHandler: function(form, validator){//验证不通过则执行回调
      return false;
    }
  });
});

/**
 * [previewImage 头像上传或修改前端预览处理IE是用了滤镜。]
 * @param  {[type]} file [上传的图片文件]
 */
function previewImage(file){
  var MAXWIDTH  = 150; 
  var MAXHEIGHT = 150;
  var div = document.getElementById('preview');
  if (file.files && file.files[0]){
    div.innerHTML ='<img id=user_face />';
    var img = document.getElementById('user_face');
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
        div.innerHTML = '<img id=user_face>';
        var img = document.getElementById('user_face');
        img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
        var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
        status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
        div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;"+sFilter+src+"\"'></div>";
      }
}

/**
 * [clacImgZoomParam 照片裁剪]
 * @param  {[type]} maxWidth  [最大宽度]
 * @param  {[type]} maxHeight [最大高度]
 * @param  {[type]} width     [实际宽度]
 * @param  {[type]} height    [实际高度]
 * @return {[type]} param     [裁剪后的照片参数信息]
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