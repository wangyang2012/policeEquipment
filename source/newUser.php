<?php
	$login = $_POST['login'];
	$password = $_POST['password'];
	$type = $_POST['userType'];
	
	$db = mysql_connect('localhost', 'root', 'root');
	mysql_select_db('policeequipment', $db);
	$sql = 'insert into newuserrequest(login, password, type) values("'.$login.'","'.$password.'",'.$type.');';
	
	$req = mysql_query($sql) or die('Erreur SQL: <br/>'.mysql_error());
	echo '<script>
			if (alert("请求已成功添加") != true) {
				window.location="index.html";
			}
			</script>';
?>