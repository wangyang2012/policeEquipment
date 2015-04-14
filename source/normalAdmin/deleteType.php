<?php
	$id = $_REQUEST['id'];
	
	$db = mysql_connect('localhost', 'root', 'root');
	mysql_select_db('policeequipment', $db);
	$sqlCount = 'select * from equipment where type = '.$id.";";
	$count = mysql_num_rows(mysql_query($sqlCount));
	echo $count;
	if ($count > 0) {
		echo '<script>
			if (alert("不能删除该类型：请首先删除属于此类型的对应装备！") != true) {
				window.location="typeEquipment.php";
			}
			</script>';
	} else {
		$sql = 'delete from equipmenttype where id = '.$id.";";
		$result = mysql_query($sql) or die('Erreur SQL: <br/>'.mysql_error());
		
		echo '<script>
				if (alert("已成功删除装备类型") != true) {
					window.location="typeEquipment.php";
				}
				</script>';
	}
?>