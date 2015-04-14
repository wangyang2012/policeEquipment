<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-CN" xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml">
	<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>警用装备管理系统 - 普通管理员 - 警用装备种类的增加与修改</title>
		<script>
			function deleteType(id) {
					window.location = "deleteType.php?id="+id;
			}
		</script>
	</head>
	<body>
		<h1>警用装备管理系统 - 普通管理员 - 警用装备种类的增加与修改</h1>
		<h3><a href="../deconnect.php">退出</a></h3>
		<a href="normalAdmin.html">返回</a> <br/><br/>
		
		<h2>删除新装备类型</h2>
		<table border='1'>
			<?php
				echo '<tr><th>名称</th><th>删除</th></tr>';
				$db = mysql_connect('localhost', 'root', 'root');
				mysql_select_db('policeequipment', $db);
				$sql = 'select * from equipmenttype';
				$req = mysql_query($sql) or die('Erreur SQL: <br/>'.mysql_error());
				while ($data = mysql_fetch_assoc($req)) {
					echo '<tr><td>'.$data['typeName'].'</td><td><input type=button onclick="deleteType('.$data['id'].')" value="删除"/></td></tr>';
				}
				mysql_close();
			?>
		</table>
		
		<br/>
		<hr/>
		<h2>添加新装备类型</h2>
		<form action="addType.php" method="post">
			<table>
				<tr><td>装备名</td><td><input type="text" name="typeName"></tr>
				<tr><td><input type="submit" value="添加"></td></tr>
			</table>
		</form>
	</body>
</html>