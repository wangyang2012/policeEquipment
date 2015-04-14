<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-CN" xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml">
	<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>警用装备管理系统 - 普通用户 - 装备搜索</title>
	</head>
	<body>
		<h1>警用装备管理系统 - 普通用户 - 装备搜索</h1>
		<h3><a href="../deconnect.php">退出</a></h3>
		<br/><br/>
		<form name="search" method="post" action="searchEquipment.php">
			<table>
				<tr><td>编号</td><td><input type="text" name="id"></tr>
				<tr><td>名称</td><td><input type="text" name="prod"></tr>
			</table>
			<input type="submit" value="搜索">
			<a href="normalUser.html">返回</a>
		</form>
		<br/>
		<hr/>
		<table border='1'>
			<?php
				echo '<tr><th>编号</th><th>种类</th><th>名称</th><th>价格</th><th>库存</th><th>有效期至</th><th>负责人</th></tr>';
				$db = mysql_connect('localhost', 'root', 'root');
				mysql_select_db('policeequipment', $db);
				$sql = 'select equipment.id as equipmentId, typeName, equipmentName, price, stock, expirationDate, responsible from equipment join equipmenttype on equipmenttype.id = equipment.type';
				if ((isset($_POST['id']) && $_POST['id'] != '') || (isset($_POST['prod']) && $_POST['prod'] != '')) {
					$sql = $sql.' where ';
					$added = false;
					if (isset($_POST['id']) && $_POST['id'] != '') {
						if ($added) {
							$sql = $sql.' or ';
						}
						$sql = $sql.'equipment.id='.$_POST['id'];
						$added = true;
					}
					if (isset($_POST['prod']) && $_POST['prod'] != '') {
						if ($added) {
							$sql = $sql.' or ';
						}
						$sql = $sql.'equipmentName like "%'.$_POST['prod'].'%"';
					}
				}
				$req = mysql_query($sql) or die('Erreur SQL: <br/>'.mysql_error());
				while ($data = mysql_fetch_assoc($req)) {
					echo '<tr>'.'<td>'.$data['equipmentId'].'</td><td>'.$data['typeName'].'</td><td>'.$data['equipmentName'].'</td><td>'.$data['price'].'</td><td>'.$data['stock'].'</td><td>'.$data['expirationDate'].'</td><td>'.$data['responsible'].'</td></tr>';
				}
				mysql_close();
			?>
		</table>
	</body>
</html>