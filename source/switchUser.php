<?php
	$login = $_POST["login"];
	$pass = $_POST["password"];

	if (empty($login) || empty($pass)){
		header('Location: index.html');
	} else {
		$db = mysql_connect('localhost', 'root', 'root');
		mysql_select_db('policeequipment', $db);
		$sql = 'select * from user where name="'.$login.'"';
		$req = mysql_query($sql) or die('Erreur SQL: <br/>'.mysql_error());
		$data = mysql_fetch_assoc($req);
		if ($data['password'] == $pass) {
			session_start();
			$_SESSION['userId'] = $data['id'];
			if ($data['type']==1) {
				$_SESSION['userType'] = "1";
				header('Location: ./normalUser/normalUser.html');
			} else if ($data['type']==2) {
				$_SESSION['userType'] = "2";
				header('Location: ./normalAdmin/normalAdmin.html');
			} else if ($data['type']==3) {
				$_SESSION['userType'] = "3";
				header('Location: ./superAdmin/superAdmin.html');
			} else {
				header('Location: deconnect.php');
			}
		} else {
			header('Location: deconnect.php');
		}
		mysql_close();
	}
?>