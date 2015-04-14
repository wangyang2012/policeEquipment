<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="zh-CN" xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml">
	<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>警用装备管理系统 - 普通管理员 - 提出申请</title>
		
		<style>
			#requestForm {
				float:left;
				margin-right: 10%;
			}
		</style>
		
		<script>
			function handleClick(radio) {
				if (radio.value == "newEquipment") {
					document.request.newName.disabled = false;
					document.request.newType.disabled = false;
					document.request.newPrice.disabled = false;
					document.request.newQuantity.disabled = false;
					document.request.newExpirationDate.disabled = false;
					document.request.newResponsible.disabled = false;
					document.request.newNotice.disabled = false;
					
					document.request.requestAction.disabled = true;
					document.request.requestName.disabled = true;
					document.request.requestQuantity.disabled = true;
					document.request.requestNotice.disabled = true;
				} else if (radio.value == "change") {
					document.request.newName.disabled = true;
					document.request.newType.disabled = true;
					document.request.newPrice.disabled = true;
					document.request.newQuantity.disabled = true;
					document.request.newExpirationDate.disabled = true;
					document.request.newResponsible.disabled = true;
					document.request.newNotice.disabled = true;

					document.request.requestAction.disabled = false;
					document.request.requestName.disabled = false;
					document.request.requestQuantity.disabled = false;
					document.request.requestNotice.disabled = false;
				}
			}
		</script>
	</head>
	<body>
		<h1>警用装备管理系统 - 普通管理员 - 装备搜索</h1>
		<h3><a href="../deconnect.php">退出</a></h3>
		<?php
				$db = mysql_connect('localhost', 'root', 'root');
				mysql_select_db('policeequipment', $db);
				$sql = 'select * from equipment';
				$req = mysql_query($sql) or die('Erreur SQL: <br/>'.mysql_error());
		?>
		<form name="request" method="post" action="requestAction.php">
			<br/>
			<h2>
				<input type="radio" name="actionRad" value="change" onclick="handleClick(this);" checked>增加/减少/调动装备
				
				<input type="radio" name="actionRad" value="newEquipment" onclick="handleClick(this);">新增装备
			</h2>
			
			<br/>
			
			<div id="requestForm">
			<table>
				<tr><td>请求</td><td>
					<select name="requestAction">
						<option value="1">增加装备</option>
						<option value="2">减少装备</option>
						<option value="3">调用装备</option>
					</select>
				</td></tr>
				<tr><td>装备</td><td>
					<select name="requestName">
						<?php
							while ($data = mysql_fetch_assoc($req)) {
								echo '<option value="'.$data['id'].'">'.$data['equipmentName'].' - 单价：'.$data['price'].' - 库存：'.$data['stock'].'</option>';
							}
						?>
					</select>
				</td></tr>
				<tr><td>数量</td><td><input type="text" name="requestQuantity"/></td></tr>
				<tr><td>说明</td><td><input type="textarea" name="requestNotice" rows="4" cols="50"/></td></tr>
			</table>
			</div>
			<div id="newRequest">
			<?php 
				mysql_select_db('policeequipment', $db);
				$sqlType = 'select * from equipmenttype';
				$reqType = mysql_query($sqlType) or die('Erreur SQL: <br/>'.mysql_error());
			?>
			<table>
				<tr><td>名称</td><td><input type="text" name="newName" disabled/></td></tr>
				<tr><td>类型</td><td>
					<select name="newType" disabled>
						<?php
							while ($dataType = mysql_fetch_assoc($reqType)) {
								echo '<option value="'.$dataType['id'].'">'.$dataType['typeName'].'</option>';
							}
						?>
					</select>
				
				</td></tr>
				<tr><td>单价</td><td><input type="text" name="newPrice" disabled/></td></tr>
				<tr><td>数量</td><td><input type="text" name="newQuantity" disabled/></td></tr>
				<tr><td>有限期至</td><td><input type="text" name="newExpirationDate" disabled/></td></tr>
				<tr><td>负责人</td><td><input type="text" name="newResponsible" disabled/></td></tr>
				<tr><td>说明</td><td><input type="textarea" name="newNotice" rows="4" cols="50" disabled/></td></tr>
			</table>
			</div>
			
			<br/>
			<tr><td><input type="submit" value="确定" rows=4 cols=40></td></tr>
			<a href="normalUser.html">返回</a>
		</form>
		<?php 
			mysql_close();
		?>
	</body>
</html>