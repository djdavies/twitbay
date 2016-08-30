<?php
	require('Purchase.php');
	session_start();
	$buying = new Purchase;
	$buying->setPurchase($_SESSION['username'], $_POST['buyingId']);
?>