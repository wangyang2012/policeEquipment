<?php
	session_start();
	$action = $_POST['actionRad'];
	if ($action == 'change') {
		$requestAction = $_POST['requestAction'];
		$requestName = $_POST['requestName'];
		$requestQuantity = $_POST['requestQuantity'];
		$requestNotice = $_POST['requestNotice'];
		$sql = 'insert into request(user, equipment, action, quantity, date, notice) values('.$_SESSION['userId'].','.$requestName.','.$requestAction.','.$requestQuantity.',NOW(),"'.$requestNotice.'");';
	} else {
		$newName = $_POST['newName'];
		$newType = $_POST['newType'];
		$newPrice = $_POST['newPrice'];
		$newQuantity = $_POST['newQuantity'];
		$newExpirationDate = $_POST['newExpirationDate'];
		$newResponsible= $_POST['newResponsible'];
		$newNotice = $_POST['newNotice'];
		$sql = 'insert into request(user, date, newName, newType, newPrice, newQuantity, newExpirationDate, newResponsible, notice) values('.$_SESSION['userId'].',NOW(),"'.$newName.'",'.$newType.','.$newPrice.','.$newQuantity.',"'.$newExpirationDate.'","'.$newResponsible.'","'.$newNotice.'");';
	}
	
	$db = mysql_connect('localhost', 'root', 'root');
	mysql_select_db('policeequipment', $db);
	$req = mysql_query($sql) or die('Erreur SQL: <br/>'.mysql_error());
	echo '<script>
			if (alert("请求已成功添加") != true) {
				window.location="normalUser.html";
			}
			</script>';
?>