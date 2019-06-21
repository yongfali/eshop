<?php
/**
*用户操作记录模型
*/
namespace Home\Model;
use Think\Model;
class UserLogModel extends Model
{

	/**
	 * [addLog 用户操作记录添加]
	 * @param [type]  $action   [操作内容]
	 * @param integer $type     [是否登录默认为1表示已登录，0表示未登录]
	 * @param integer $shoperId [用户ID若登录则不用传值]
	 */
	public function addLog($action,$type= 1,$userId=0){
		$ip = get_client_ip();
		$Ip = new \Org\Net\IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
        $area = $Ip->getlocation($ip); // 获取某个IP地址所在的位置
        if($type){
        	$logData['userId'] = session('uid');
        }
        else{
        	$logData['userId'] = $userId;
        }
        $logData['action'] =  $action;
        $logData['ip'] =  $ip;
        $logData['location'] = $area;
        $logData['time'] =  time();
        $this->data($logData)->add();
	}

	/**
	 * [getRecentLog 获取商家最近一次登录的IP和时间]
	 * @return [type] [description]
	 */
	public function getRecentLog(){
		$where = array('userId' =>session('uid'),'action' => "登录",'is_show' => 1);
		return $this->where($where)->order('time desc')->limit(1)->select();
	}
}