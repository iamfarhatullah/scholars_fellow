<?php 
	session_start();
	if (!isset($_SESSION["user_username"])) {
		header("location: login.php");
	}
	require_once("include/connection.php");
	$status = 0;
	$sessionUsername = $_SESSION["user_username"];
	$sql = "SELECT * FROM tbl_users WHERE user_username='$sessionUsername'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		$user_ID = $row['user_ID'];

		$userDetailSql = "SELECT * FROM tbl_profile WHERE user_FK='$user_ID'";
		$userDetailResult = mysqli_query($conn, $userDetailSql);
		if (mysqli_num_rows($userDetailResult)>0) {
			$sqlUser = "SELECT * FROM tbl_profile 
			INNER JOIN tbl_users ON tbl_users.user_ID =tbl_profile.user_FK 
			INNER JOIN tbl_users_type ON tbl_users_type.type_ID = tbl_users.user_type_FK
			WHERE user_username='$sessionUsername'";
			$resultUser = mysqli_query($conn, $sqlUser);
			if (mysqli_num_rows($resultUser)>0) {
				while ($rowUser = mysqli_fetch_assoc($resultUser)) {
					$userId = $rowUser['user_ID'];
					$user_username = $rowUser['user_username'];
					$user_permissions = $rowUser['user_permissions'];
					$user_type = $rowUser['type_name'];
					$first_name = $rowUser['profile_first_name'];
					$last_name = $rowUser['profile_last_name'];
					$profile_picture = $rowUser['profile_picture'];
				}
			}
		}else{
			header("Location: accountDetails.php?id=$user_ID");
		}
	}else{
		header("location: login.php");
	}
?>