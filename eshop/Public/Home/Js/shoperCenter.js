/**
*商户中心脚本
*/
//商品分类脚本
$(function(){
    //实现已有二级菜单的显示和影藏
    $('.icon').each(function(index, element) {
      $(this).click(function(e) {
          $(this).parent().parent().nextAll().toggle();// toggle()方法来切换 hide() 和 show()方法。
          $(this).toggleClass('addicon');//图标切换显示     
        });
    });
    //实现二级菜单的增加
    $('.addSecondMenu').each(function(index, element) {
      $(this).click(function(e) {
       var content = "<tr class='add_second'><td class='items'><input  class='inputs secondMenu' type='text'></td><td class='action'><a href='javascript:;'  title='删除' class='removesecond'>删除</a></td></tr>";
       $(this).parent().parent().parent('tbody').append(content);
           //保存按钮的显示
           $('#formSubmit').css('display','inline-block');
           //实现已有一级菜单下新增的二级菜单的移除
           $('.removesecond').click(function(){
            $(this).parent().parent('.add_second').remove();
          });
         });
    });
	//实现一级菜单的增加
	$('#addFirstMenu').click(function(e) {
    var content = "<tbody class='new_tbody'><tr class='first'><td class='items'><img src='/eshop/Public/Home/Icon/remove.png' class='addicon_new'/><input class='inputs' type='text' dataid='' /></td><td class='action'><a href='javascript:;' class='addMenu'>新增</a><a href='javascript:;' class='removeFirst'>删除</a></td></tr></tbody>";
    $(this).parent().prev('.scart_table').append(content);
        //二级菜单的新增
        $('.addMenu').click(function(e) {
          var content = "<tr class='new_second'><td class='items'><input  class='inputs secondMenu' type='text'></td><td class='action'><a href='javascript:;'  title='删除' class='removesecond'>删除</a></td></tr>";
          $(this).parent().parent().parent('tbody').append(content);
          //新增二级菜的删除
          $('.removesecond').click(function(){
            $(this).parent().parent('.new_second').remove();
          });
        });
        //新增一级菜单的移除
        $('.removeFirst').click(function(){
          $(this).parent().parent().parent().remove();
        });
        //保存按钮的显示
        $('#formSubmit').css('display','inline-block');
      });
});
/**
*菜单的删除，ID为对应菜单的id序列号
*type为对应菜单的类别，0表示一级菜单，1表示二级菜单
*/
function delCart(id,type){
  layer.confirm('确定删除该菜单内容吗？',function(index){
       $.ajax({
        type : "post",
        url : delCartItem,
        dataType : "json",
        data : {
          "type" : type,
          "id" : id,
        },
        success : function(msg){
          if(msg.status){
            layer.msg('删除成功！',{icon:1});
            location.reload(); //重新当前页面
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
/**
*菜单添加包含已有二级菜单的添加和新增菜单的添加
*/
function saveCart(){
  var param = {};//新增二级菜单
  var param1 = {};//新增一级菜单
  var fmenuId = {};//保存在已有菜单下添加二级菜单的ID序列号
  var i = 0;
  var j = 0;
  var k = 0;
  //遍历已有菜单下新增的二级菜单
  $('.add_second').each(function(i,element){
    var pid = $(this).prevAll('.first').children('.items').find('input').attr('dataid');
    if($(this).find('input').val()==''){
      // layer.msg('添加二级菜单不能为空',{icon:2});
      return false;
    }
    else{
      fmenuId[i] = pid; 
      param[pid+'_'+i] = $(this).find('input').val();
    } 
  });
  //遍历新增的一级菜单
  $('.new_tbody').each(function(j,element){
    //保存新增一级菜单的值
      if($(this).children('.first').find('input').val()==''){
        layer.msg('新增一级菜单值不能为空',{icon:2});
        return false;
      }
      else{
       param1[j+'_'] = $(this).children('.first').find('input').val();
       param1['totalNum'] = j+1;
       param1[j+'_num'] = k;
      //遍历保存新增一级菜单下二级菜单的值
      $(this).children('.new_second').each(function(k, element) {
        if($(this).children('.items').find('input').val()==''){
          return ;
        }
        else{
          param1[j+'_'+k] = $(this).children('.items').find('input').val();
          param1[j+'_num'] = k+1;
        } 
      });
    }
  });
  var url = $('#goodCart').attr('action');
    $.post(url,{'pid':fmenuId,'param':param,'param1':param1},function(msg){
     if(msg.status){
       layer.msg('添加成功',{icon:1});
       location.reload();
     }
     else{
       layer.msg('添加失败',{icon:5});
     }
   });
}
/**
*编辑分类进行修改保存
*/
function editCartName(obj,type){
  var id = $(obj).attr('dataid');
  var cartName = obj.value;//获取更改后的值,$(obj).value获取的为初始值
  if(cartName==''){
    return false;
  }
  else{
    $.ajax({
      type : "post",
      url : editCart,
      dataType : "json",
      data : {
        "type" : type,
        "id" : id,
        "name" : cartName,
      },
      success : function(msg){
        if(msg.status){
          layer.msg('修改成功！',{icon:1});
             location.reload(); //重新当前页面
           }
           else{
            layer.msg('修改失败！',{icon:5});
          }
        },
        error : function(){
          layer.msg('请求出错了，请稍后重试...',{icon:5})
        }
      });
  }
}
/**
*商户中心左侧导航栏选中样式切换
*/
$(function(){
  $('.scenter_left a').each(function() {
    if($($(this))[0].href == String(window.location)){
      $(this).addClass('item_hover').siblings().removeClass('item_hover');
      $(this).hover(function() {
        $(this).removeClass('item_hover')},function(){
         $(this).addClass('item_hover');
       });
    }
  });
});
