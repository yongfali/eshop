// 复选框事件js
// 店铺申请列表脚本
$(function(){
  	//全选事件
	 $('#allchecked').click(function() {
	    if($(this).prop("checked")){
	      $('.item-check').prop('checked',true);
	    }
	    else{
	      $('.item-check').prop('checked',false);
	    } 
	}); 
  	// 单个复选框被选中
    $('.data-item').each(function(){
      $(this).find('.item-check').click(function(){
        //判断当前复选框是否选中
        if($(this).find('.item-check').is(":checked")){
            allChecked();
          }
        else{
            allChecked();
        }
      });
    });
});
/**
 * [allChecked 全选框是否选中]
 * @return {[type]} [description]
 */
function allChecked(){
    var i = $('.item-check').size();//CheckBox总个数
    var item = $('table tbody  :checkbox:checked').size();//判断选中的个数
    if(i == item){
      $('#allchecked').prop('checked',true);
    }
    else{
      $('#allchecked').prop('checked',false);
    }
 }

 /**
  *获取选中checkbox的value值
  *返回商品ID数组
  */
  function checkedValues(){
    var Ids = new Array();
    var j = 0;
    $('.item-check').each(function() {
      if($(this).prop("checked")){
        Ids[j] = $(this).attr('value');
        j++;
      }
      });
     return Ids;
  }