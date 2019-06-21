//购物车脚本
//
  $(document).ready(function(){
  	// 数量减少单击事件
    $('.jian').click(function() {
      var num = $(this).next().val();//获取数量
      if(num>1){
        num--;
        $(this).next().val(num);
  	    var price = parseFloat($(this).parent('.cart_td4').prev().text());//获取单价
  	    $(this).parent('.cart_td4').next().text((price*num).toFixed(2));//显示单个商品总
  	    totalprice();
      }
      else{
        totalprice();
        return false;
      }
    });

    // 数量增加单击事件
    $('.jia').click(function() {
      var num = $(this).prev('').val();
      num++;
      $(this).prev().val(num);
  	  var price = parseFloat($(this).parent('.cart_td4').prev().text());//获取单价
  	  $(this).parent('.cart_td4').next().text((price*num).toFixed(2));//显示单个商品总价toFixed()保留小数位数
  	  totalprice();
    });

    // 商品全选事件
    $('#allchecked').click(function() {
      if($(this).prop("checked")){
        $('.goods_check').prop('checked',true);
        totalprice();
       }
      else{
        $('.goods_check').prop('checked',false);
        totalprice();
      }	
    }); 

    // 单个商品被选中，若选中计算该商品数量总价格
    $('.cart_tr').each(function(){
      $(this).find('.goods_check').click(function(){
        //判断当前店铺商品是否选中
        if($(this).find('.goods_check').is(":checked")){
            allChecked()
            totalprice();
          }
        else{
            allChecked()
            totalprice();
        }
      });
    });
  });

  /**
   * [totalprice 统计购物车所有选中商品的总价格]
   * @return [总价格]
   */
  function totalprice(){
    var allPrice = 0.00;//商品总价初始值
    $('.cart_tr').each(function(){//循环店铺里的商品
      if($(this).find('.goods_check').is(":checked")){//如果该商品被选中 
        var pnum = parseInt($(this).find('.goodnum').val());//获得商品数量
        var pprice = parseFloat($(this).find('.cart_td3').text());//获得商品单价
        allPrice += pnum*pprice;
      }
      $('.sumMoney').find('span').text(allPrice.toFixed(2)); 
    });
  }

  /**
   * [allChecked 全选框是否选中]
   * @return {[type]} [description]
   */
  function allChecked(){
    var i = $('.goods_check').size();//CheckBox总个数
    var item = $('table tbody  :checkbox:checked').size();//判断选中的个数
    if(i == item){
      $('#allchecked').prop('checked',true);
    }
    else{
      $('#allchecked').prop('checked',false);
    }
  }

  /**
   * 购物车单个商品数量增加或减少事件
   * gooId 商品序列号
   * type为1表示用户登录，0表示未登录
   * 后期进行完善数据库插入采用redis进行操作减缓服务器压力
   */
  function changeCartNum(obj,goodId,type,clickType){
    var params = {};
    var num = parseInt($(obj).siblings('input').val());
    if(clickType === 'jia'){
      num +=1;
    }
    if(clickType === 'jian'){
      if(num >1){
        num = num-1;
      }
      else{
        num = 1;
      }
    }
    params.goodId = goodId;
    params.num = num;
    params.type = type;
    $.ajax({
      type : 'post',
      url : 'changeNum',
      data : params,
      dataType : 'json' ,
      success : function(msg){
        if(msg.status){
          location.reload();
        }
        else{
          layer.msg(msg.content,{icon:5});
          location.reload();
        }
      },
      error : function(){
        layer.msg('请求出错了，稍后再试...',{icon:16}); 
      }
    })
  }

  /**
   * [toSettlement  购物车结算事件]
   * @param  {[type]} type [用户是否登录0表示未登录，1表示已经登录]
   * @return {[type]}      [description]
   */
  function toSettlement(type){
    //判断是否登录
    if(!type){
     layer.msg('您还没有登录，请先登录用户账号！',{icon:7});
     setTimeout("window.location.href = userLogin",3000);
     return false;
    }
    //判断是否有商品选中
    var item = $('table tbody  :checkbox:checked').size();
    if(!item){
      layer.msg('请选择要结算的商品！',{icon:7});
      return false;
    }
    // 循环判断选中的商品
    var params = {};
    var i = 0;
    $('.cart_tr').each(function(){
      //选中商品ID序列集合
      if($(this).find('.goods_check').is(":checked")){
        //获得商品ID
        params[i++] = $(this).find('.goodId').attr('goodid');
      }
    });
    $.ajax({
      type : 'post',
      url : 'ischecked',
      data : params,
      dataType : 'json' ,
      complete : function(){
        location.href = "settlement";
      }
    });
  }