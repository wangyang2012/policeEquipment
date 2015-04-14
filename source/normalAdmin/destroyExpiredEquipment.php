<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-CN" xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml">
	<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>警用装备管理系统 - 普通管理员 - 警用装备到期自动报废</title>
		<script>
			function deleteExpired() {
				window.location = "deleteExpired.php";
			}
		</script>
	</head>
	<body>
		<h1>警用装备管理系统 - 普通管理员 - 警用装备到期自动报废</h1>
		<h3><a href="../deconnect.php">退出</a></h3>
		<a href="normalAdmin.html">返回</a> <br/><br/>
		<table border='1'>
			<?php
				echo '<tr><th>编号</th><th>种类</th><th>名称</th><th>价格</th><th>库存</th><th>有效期至</th><th>负责人</th></tr>';
				$db = mysql_connect('localhost', 'root', 'root');
				mysql_select_db('policeequipment', $db);
				$sql = 'select equipment.id as equipmentId, typeName, equipmentName, price, stock, expirationDate, responsible from equipment join equipmenttype on equipmenttype.id = equipment.type';
				$req = mysql_query($sql) or die('Erreur SQL: <br/>'.mysql_error());
				while ($data = mysql_fetch_assoc($req)) {
					if (strtotime($data['expirationDate']) < time()) {
						echo '<tr>'.'<td>'.$data['equipmentId'].'</td><td>'.$data['typeName'].'</td><td>'.$data['equipmentName'].'</td><td>'.$data['price'].'</td><td>'.$data['stock'].'</td><td><font color="red">'.$data['expirationDate'].'</font></td><td>'.$data['responsible'].'</td></tr>';
					} else {
						echo '<tr>'.'<td>'.$data['equipmentId'].'</td><td>'.$data['typeName'].'</td><td>'.$data['equipmentName'].'</td><td>'.$data['price'].'</td><td>'.$data['stock'].'</td><td>'.$data['expirationDate'].'</td><td>'.$data['responsible'].'</td></tr>';
					}
				}
				mysql_close();
			?>
		</table>
		
		<button onclick="deleteExpired()">自动报废</button>
	</body>
</html>