// 添加文章二级分类脚本
$(function(){
	// 弹出添加新增子分类layer脚本
    $(".add-child-cart").click(function show(){
    	layer.open({
			type: 2,//参数为0-4,2表示为Iframe层
			title: '新增子分类',
			shadeClose: true,
			shade: 0.6,
			area: ['360px', '180px'],
			content: 'http://localhost/eshop/index.php/Admin/ArticalManage/addCart.html',
			yes: function(index, layero){
				layer.close(index);
			}
		});
    });
});