<?php
	$id = $_REQUEST['id'];
	
	$db = mysql_connect('localhost', 'root', 'root');
	mysql_select_db('policeequipment', $db);
	$sql = 'select * from newuserrequest where id = '.$id.";";
	$result = mysql_query($sql) or die('Erreur SQL: <br/>'.mysql_error());
	
	$request = mysql_fetch_assoc($result);
	$sqlInsert = 'insert into user (type, name, password) values ('.$request['type'].', "'.$request['login'].'", "'.$request['password'].'");';
	mysql_query($sqlInsert) or die('Erreur SQL: <br/>'.mysql_error());
	
	$sqlDelete = 'delete from newuserrequest where id = '.$id.';';
	mysql_query($sqlDelete) or die('Erreur SQL: <br/>'.mysql_error());
	
	echo '<script>
			if (alert("已成功添加普通用户") != true) {
				window.location="newUserRequest.php";
			}
			</script>';
?>