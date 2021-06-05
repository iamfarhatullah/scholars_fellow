<?php  

require_once("include/connection.php");
if (isset($_GET['blog_ID'])) {
	$id = $_GET['blog_ID'];
	$sql = "UPDATE tbl_blogs SET blog_status='1' WHERE blog_ID='$id'";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		header("Location: index.php?blogApproved");
	}else{
		header("Location: index.php?Error");
	}
}else{
	header("Location: index.php");
}



?>