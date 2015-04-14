<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-CN" xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml">
	<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>警用装备管理系统 - 普通管理员 - 普通用户申请</title>
		<script>
			<?php
				session_start();
				
			?>
			function acceptUser(id) {
				window.location = "acceptUser.php?id="+id;
			}
			function rejectUser(id) {
				window.location = "rejectUser.php?id="+id;
			}
		</script>
	</head>
	<body>
		<h1>警用装备管理系统 - 普通管理员 - 普通用户申请</h1>
		<h3><a href="../deconnect.php">退出</a></h3>
		<h3><a href="normalAdmin.html">返回</a></h3>
		<br/><br/>
		<table border='1'>
			<?php
				echo '<tr><th>姓名</th><th>同意</th><th>拒绝</th></tr>';
				$db = mysql_connect('localhost', 'root', 'root');
				mysql_select_db('policeequipment', $db);
				$sql = 'select * from newuserrequest where type = 1';
				$req = mysql_query($sql) or die('Erreur SQL: <br/>'.mysql_error());
				while ($data = mysql_fetch_assoc($req)) {
					echo '<tr><td>'.$data['login'].'</td><td><input type=button onclick="acceptUser('.$data['id'].')" value="同意"/></td><td><input type=button onclick="rejectUser('.$data['id'].')" value="拒绝"/></td></tr>';
				}
				mysql_close();
			?>
		</table>
	</body>
</html>