<?php
/**
 * 系统管理控制器
 */
namespace Admin\Controller;
use Think\Controller;
class SystemManageController extends BaseController{
	/**
	 * [backup 数据库备份]
	 * @return [type] [description]
	 */
	public function backup(){
		//读取配置文件中的数据库用户名、密码、数据库名
		$dbName = C('DB_NAME');   
		$dbUser = C('DB_USER');
		$dbPwd  = C('DB_PWD');
		//数据库备份文件名
		$fileName = date("Y-m-d",time()).$dbName.".sql";
		//文件保存路径
		$dumpFileName = DATA_PATH.$fileName;
		$logFile = LOG_PATH."backupLog.txt";
		$fp = fopen($logFile, "a+");  
		fwrite($fp, date("Y-m-d H:m:s",time()).'进行数据库备份！');  
		fclose($fp);
		exec("D:/wampserver/wamp/bin/mysql/mysql5.6.12/bin/mysqldump -u$dbUser -p$dbPwd $dbName > $dumpFileName"); 
		redirect(U('Admin/Index/index'));
	}
}