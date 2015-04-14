<?php
	$name = $_POST['typeName'];
	
	$db = mysql_connect('localhost', 'root', 'root');
	mysql_select_db('policeequipment', $db);
	$sql = "insert into equipmenttype(typeName) values ('".$name."');";
	$result = mysql_query($sql) or die('Erreur SQL: <br/>'.mysql_error());
	echo '<script>
			if (alert("已成功添加装备类型") != true) {
				window.location="typeEquipment.php";
			}
			</script>';
?>