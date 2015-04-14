<?php
	$id = $_REQUEST['id'];
	
	$db = mysql_connect('localhost', 'root', 'root');
	mysql_select_db('policeequipment', $db);
	$sql = 'delete from newuserrequest where id = '.$id.";";
	$result = mysql_query($sql) or die('Erreur SQL: <br/>'.mysql_error());
	
	echo '<script>
			if (alert("已拒绝请求") != true) {
				window.location="newUserRequest.php";
			}
			</script>';
?>