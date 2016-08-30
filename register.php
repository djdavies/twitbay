<?php
	require('User.php');

	$register = new User;
	$register->setUserName($_POST['username'], $_POST['email'], $_POST['password']);
?>