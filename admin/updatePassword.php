<?php  
if (isset($_POST['updatePassword'])) {
	require_once("include/connection.php");
	$user_ID = $_POST['user_ID'];
	$newPassword = $_POST['newPassword'];

	$sql = "UPDATE tbl_users SET user_password='".$newPassword."' WHERE user_ID='".$user_ID."'";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		session_start();
		session_destroy();
		header("Location: login.php?passwordChanged");
	}else{
		header("Location: changePassword.php?PasswordNotChanged");
	}
}

?>