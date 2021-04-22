<?php
	session_start();
	$_SESSION['admin_username'] = null;
	$_SESSION['admin_firstname'] = null;
	$_SESSION['admin_name'] = null;
	$_SESSION['admin_image'] = null;

	header("Location: ../index.php")
?>