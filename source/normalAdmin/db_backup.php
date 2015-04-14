<?php
	
	header("Content-type:text/html;charset=utf-8");
	
	//配置信息
	$cfg_dbhost = 'localhost';
	$cfg_dbname = 'policeequipment';
	$cfg_dbuser = 'root';
	$cfg_dbpwd = 'root';
	$cfg_db_language = 'utf8';
	$to_file_name = "sqlBackup.sql";
	// END 配置

	//链接数据库
	$link = mysql_connect($cfg_dbhost,$cfg_dbuser,$cfg_dbpwd);
	mysql_select_db($cfg_dbname);
	//选择编码
	mysql_query("set names ".$cfg_db_language);
	//数据库中有哪些表
	$tables = mysql_list_tables($cfg_dbname);
	//将这些表记录到一个数组
	$tabList = array();
	while($row = mysql_fetch_row($tables)){
		$tabList[] = $row[0];
	}
	
	$info = "CREATE DATABASE IF NOT EXISTS ".$cfg_dbname.";\r\n";
	$info .= "use ".$cfg_dbname.";\r\n";
	$info .= "
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\n
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\n
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\n
/*!40101 SET NAMES utf8 */;\n
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;\n
/*!40103 SET TIME_ZONE='+00:00' */;\n
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;\n
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;\n
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;\n
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;\n";
	
	
	
	$result = $info;

	//将每个表的表结构导出到文件
	foreach($tabList as $val){
		$sql = "show create table ".$val;
		$res = mysql_query($sql,$link);
		$row = mysql_fetch_array($res);
		$info = "-- ----------------------------\r\n";
		$info .= "-- Table structure for `".$val."`\r\n";
		$info .= "-- ----------------------------\r\n";
		$info .= "DROP TABLE IF EXISTS `".$val."`;\r\n";
		$sqlStr = $info.$row[1].";\r\n\r\n";
		//追加到文件
		$result .= $sqlStr;
		//释放资源
		mysql_free_result($res);
	}

	//将每个表的数据导出到文件
	foreach($tabList as $val){
		$sql = "select * from ".$val;
		$res = mysql_query($sql,$link);
		//如果表中没有数据，则继续下一张表
		if(mysql_num_rows($res)<1) continue;
		//
		$info = "-- ----------------------------\r\n";
		$info .= "-- Records for `".$val."`\r\n";
		$info .= "-- ----------------------------\r\n";
		$result .= $info;
		//读取数据
		while($row = mysql_fetch_row($res)){
			$sqlStr = "INSERT INTO `".$val."` VALUES (";
			foreach($row as $zd){
				$sqlStr .= "'".$zd."', ";
			}
			//去掉最后一个逗号和空格
			$sqlStr = substr($sqlStr,0,strlen($sqlStr)-2);
			$sqlStr .= ");\r\n";
			$result .= $sqlStr;
		}
		//释放资源
		mysql_free_result($res);
	}
// 	file_put_contents($to_file_name,$result."\r\n");
	
	header("Content-disposition:filename=".$to_file_name);
	header("Content-type:application/octetstream");
	header("Pragma:no-cache");
	header("Expires:0");
	
	echo $result;
?>