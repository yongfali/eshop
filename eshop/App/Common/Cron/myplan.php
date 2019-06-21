<?php
	//读取配置文件中的数据库用户名、密码、数据库名
	$dbName = C('DB_NAME');   
	$dbUser = C('DB_USER');
	$dbPwd  = C('DB_PWD');
	//数据库备份文件名
	$fileName = date("Y-m-d H:m:s",time())."_".$dbName.".sql";
	//文件保存路径
	$dumpFileName = DATA_PATH.$fileName;
	$fp = fopen("test.txt", "a+");  
	fwrite($fp, $dumpFileName);  
	fclose($fp);
	//mysqldump命令数据库备份
	// exec("D:/wampserver/wamp/bin/mysql/mysql5.6.12/bin/mysqldump -u$dbUser -p$dbPwd $dbName > $dumpFileName"); 
?>