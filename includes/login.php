<?php include "db.php"  ?>
<?php session_start(); ?>
<?php 
	if(isset($_POST['login'])) {
	$username = $_POST['username'];
	$user_password = $_POST['user_password'];

	$username = mysqli_real_escape_string($connection, $username);
	$user_password = mysqli_real_escape_string($connection, $user_password);

	$query = "SELECT * FROM users WHERE username = '$username' ";
	$user = mysqli_query($connection, $query);

	if(!$user) {
		die("FAILED QUERY ". mysql_error($connection));
	}

	while($row = mysqli_fetch_assoc($user)) {
		$db_user_id = $row['user_id'];
		$db_username = $row['username'];
		$db_user_password = $row['user_password'];
		$db_user_firstname = $row['user_firstname'];
		$db_user_lastname = $row['user_lastname'];
		$db_user_role = $row['user_role'];

	}
	$user_password = crypt($user_password, $db_user_password);
	if($username === $db_username && $user_password === $db_user_password ) {
		$_SESSION['username'] = $db_username;
		$_SESSION['user_firstname'] = $db_user_firstname;
		$_SESSION['user_lastname'] = $db_user_lastname;
		$_SESSION['user_role'] = $db_user_role;

		header("Location: ../admin");
	} else {
		header("Location: ../index.php");
	}
	}
	


 ?>