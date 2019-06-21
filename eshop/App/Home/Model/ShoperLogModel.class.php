<?php
/**
*商户操作记录模型
*/
namespace Home\Model;
use Think\Model;
class ShoperLogModel extends Model
{

	/**
	 * [getLogNum 商家操作记录数量获取]
	 * @return [type] [description]
	 */
	public function getLogNum(){
		$where = array('shoperId' => session('uid'),'is_show' => 1);
		return $this->where($where)->count();
	}

	/**
	 * [logDel 商家操作记录删除]
	 * @param  [type] $id [传入的ID值]
	 * @return [type]     [description]
	 */
	public function logDel($id){
		$where = array('id' => $id);
		$res = $this->where($where)->delete();
		if($res){
			$msg['status'] = 1;
		}
		else{
			$msg['status'] = 0;
		}
		return $msg;
	}

	/**
	 * [addLog 商家操作记录添加]
	 * @param [type]  $action   [操作内容]
	 * @param integer $type     [是否登录默认为1表示已登录，0表示未登录]
	 * @param integer $shoperId [商家ID若登录则不用传值]
	 */
	public function addLog($action,$type= 1,$shoperId=0){
		$ip = get_client_ip();
		$Ip = new \Org\Net\IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
        $area = $Ip->getlocation($ip); // 获取某个IP地址所在的位置
        if($type){
        	$logData['shoperId'] = session('uid');
        }
        else{
        	$logData['shoperId'] = $shoperId;
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
		$where = array('shopId' =>session('uid'),'action' => "登录",'is_show' => 1);
		return $this->where($where)->order('time desc')->limit(1)->select();
	}
}