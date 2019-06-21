<?php
/**
 * 后台基类控制器
 */
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {
	/**
    * [_initialize 后台公共部分赋值]
    * @return [type] [description]
    */
	public function _initialize(){
		if(!isset($_SESSION['adminId']) || !isset($_SESSION['adminName'])){
			redirect(U('Admin/Login/index'));
		}
		
	}
}