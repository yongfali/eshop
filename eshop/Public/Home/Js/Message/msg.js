// 商家/用户消息中心脚本
  $(function(){
  	// 消息全选事件
      $(document).on('click','#allchecked',function(){
         if($(this).prop("checked")){
          $('.msg_check').prop('checked',true);
         }
        else{
          $('.msg_check').prop('checked',false);
        } 
      }); 
      $('.msg_check').each(function(){
   		  $(document).on('click',function(){
   			  allChecked();
   		  });
   	  }); 
  });

  /**
   * [allChecked 全选框是否选中]
   * @return {[type]} [description]
   */
  function allChecked(){
    var i = $('.msg_check').size();//CheckBox总个数
    var item = $('table tbody  :checkbox:checked').size();//判断选中的个数
    if(i == item){
      $('#allchecked').prop('checked',true);
    }
    else{
      $('#allchecked').prop('checked',false);
    }
  }

  /**
   * [checkedItemValue 选中项的ID值获取]
   * @return {[type]} [description]
   */
  function checkedItemValue(){
    var msgIds = new Array();
    var j = 0;
    $('.msg_check').each(function() {
      if($(this).prop("checked")){
        msgIds[j] = $(this).attr('value');
        j++;
      }
    });
     return msgIds;
  }

  /**
   * [allMsgRead 所有未读消息设置为已读状态后期修改完善]
   * @return {[type]} [description]
   */
  function allMsgRead(){
     layer.confirm('确定全部标为已读？',{icon:3},function(){
      $.ajax({
        type : 'post',
        url : 'allMessageRead',
        dataType : 'json',
        success : function (msg) {
          if(msg.status){
            layer.msg('设置成功！',{icon:1});
            setTimeout('location.reload();',2000);
          }
          else{
            layer.msg('设置失败或没有未读消息！',{icon:5});
          }    
        },
        error : function(){
          layer.msg('请求出错了，稍后再试...',{icon:16}); 
        }
      });
    });
  }

  /**
   * [delMsg 消息删除]
   * @param  {[type]} obj [当前对象]
   * @param  {[type]} type [删除类型0：单个删除，1：全部删除]
   * @param  {[type]} id [单个删除消息的ID序列号]
   * @return {[type]}      [description]
   */
  function delMsg(type,id){
    var params = {};
    var msgIds = checkedItemValue();
    // 点击批量删除按钮
    if(type){
      if(!msgIds.length){
        layer.msg('请先选择要删除的消息列表！',{icon:7});
        return ;
      }
      params.msgIds = msgIds;
    }
    else{
      params.msgIds = id;
    }
    layer.confirm('确定删除吗？',{icon:3},function(){
      $.ajax({
        type : 'post',
        url : 'messageDel',
        data : params,
        dataType : 'json',
        success : function (msg) {
          if(msg.status){
            layer.msg('删除成功！',{icon:1});
            setTimeout('location.reload();',1000);
          }
          else{
            layer.msg('删除失败！',{icon:5});
          }    
        },
        error : function(){
          layer.msg('请求出错了，稍后再试...',{icon:16}); 
        }
      });
    });
  }
