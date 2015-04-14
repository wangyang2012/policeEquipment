<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-CN" xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml">
	<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>警用装备管理系统 - 超级管理员 - 装备申请</title>
		<script>
			<?php
				session_start();
				
			?>
			function acceptEquipment(id) {
				window.location = "acceptEquipment.php?id="+id;
			}
			function rejectEquipment(id) {
				window.location = "rejectEquipment.php?id="+id;
			}
		</script>
	</head>
	<body>
		<h1>警用装备管理系统 - 超级管理员 - 装备申请</h1>
		<h3><a href="../deconnect.php">退出</a></h3>
		<h3><a href="superAdmin.html">返回</a></h3>
		<br/><br/>
		<table border='1'>
			<thead><h3>增加/减少/调动</h3></thead>
			<?php
				echo '<tr><th>装备</th><th>动作</th><th>数量</th><th>申请人</th><th>申请日期</th><th>说明</th><th>同意</th><th>拒绝</th></tr>';
				$db = mysql_connect('localhost', 'root', 'root');
				mysql_select_db('policeequipment', $db);
				$sql = 'select request.id as idRequest, equipmentName, user.name as userName, action, quantity, date, notice from request join equipment on equipment.id = request.equipment join user on request.user = user.id';
				$req = mysql_query($sql) or die('Erreur SQL: <br/>'.mysql_error());
				while ($data = mysql_fetch_assoc($req)) {
					$act = '';
					if ($data['action'] == 1) {
						$act = '增加装备';
					} else if ($data['action'] == 2) {
						$act = '减少装备';
					} else if ($data['action'] == 3) {
						$act = '调动装备';
					}
					echo '<tr><td>'.$data['equipmentName'].'</td><td>'.$act.'</td><td>'.$data['quantity'].'</td><td>'.$data['userName'].'</td><td>'.$data['date'].'</td><td>'.$data['notice'].'</td><td><input type=button onclick="acceptAdmin('.$data['idRequest'].')" value="同意"/></td><td><input type=button onclick="rejectAdmin('.$data['idRequest'].')" value="拒绝"/></td></tr>';
				}
				mysql_close();
			?>
		</table>
		
		<br/><br/>
		
		<table border='1'>
			<thead><h3>新增装备</h3></thead>
			<?php
				echo '<tr><th>名称</th><th>类型</th><th>单价</th><th>数量</th><th>总价</th><th>有效期至</th><th>负责人</th><th>申请人</th><th>申请日期</th><th>说明</th><th>限额</th><th>同意</th><th>拒绝</th></tr>';
				$db = mysql_connect('localhost', 'root', 'root');
				mysql_select_db('policeequipment', $db);
				$sql = 'select request.id as idRequest, newName, typeName, newPrice, newQuantity, newExpirationDate, newResponsible, user.name as userName, date, notice from request join equipmenttype on equipmenttype.id = newType join user on request.user = user.id';
				$req = mysql_query($sql) or die('Erreur SQL: <br/>'.mysql_error());
				while ($data = mysql_fetch_assoc($req)) {
					$total = $data['newPrice'] * $data['newQuantity'];
					echo '<tr><td>'.$data['newName'].'</td><td>'.$data['typeName'].'</td><td>'.$data['newPrice'].'</td><td>'.$data['newQuantity'].'</td><td>'.$total.'</td><td>'.$data['newExpirationDate'].'</td><td>'.$data['newResponsible'].'</td><td>'.$data['userName'].'</td><td>'.$data['date'].'</td><td>'.$data['notice'].'</td><td><input type=text name=limit/></td><td><input type=button onclick="acceptAdmin('.$data['idRequest'].')" value="同意"/></td><td><input type=button onclick="rejectAdmin('.$data['idRequest'].')" value="拒绝"/></td></tr>';
				}
				mysql_close();
			?>
		</table>
	</body>
</html>