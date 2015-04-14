<?php
	$db = mysql_connect('localhost', 'root', 'root');
	mysql_select_db('policeequipment', $db);
	$sql = 'delete from equipment where expirationDate < now();';
	mysql_query($sql) or die('Erreur SQL: <br/>'.mysql_error());
	echo '<script>
			if (alert("已成功删除过期装备") != true) {
				window.location="destroyExpiredEquipment.php";
			}
			</script>';
?>