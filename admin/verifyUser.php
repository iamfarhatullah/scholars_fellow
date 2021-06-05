<?php  
	if (isset($_POST['login'])) {	
		require_once ("include/connection.php");
		session_start();
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);	
		$sql = "SELECT * FROM `tbl_users` WHERE (`user_email`='".$username."' OR `user_username`='".$username."') AND `user_password`='".$password."'";
		$result = mysqli_query($conn,$sql);	
		if(mysqli_num_rows($result) == 0){
			header("location: login.php?unknownUser");
		}else{	
			$_SESSION["user_username"] = $username;
			header("location: index.php");
		}
	}
?>