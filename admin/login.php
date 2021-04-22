<?php
	include "includes/db.php";
	session_start();
	if (isset($_POST['submit'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$query = "SELECT * FROM admin WHERE admin_username = '{$username}' and admin_password = '{$password}'";
		$result = mysqli_query($connection, $query);
		if ($result) {
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					$db_admin_username = $row['admin_username'];
					$db_admin_password = $row['admin_password'];
					$admin_firstname = $row['admin_firstname'];
					$admin_name = $row['admin_name'];
					$admin_image = $row['admin_image'];

					$_SESSION['admin_username'] = $db_admin_username;
					$_SESSION['admin_firstname'] = $admin_firstname;
					$_SESSION['admin_name'] = $admin_name;
					$_SESSION['admin_image'] = $admin_image;
					header("Location: index.php");
				}
			}else{
				header("Location: ../index.php");
			}
		}else{
			header("Location: ../index.php");
		}
	}
?>