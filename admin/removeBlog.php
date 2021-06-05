<?php  
	require_once("include/connection.php");
	$id = $_GET['id'];
	$sqlImage = "SELECT blog_image FROM tbl_blogs WHERE blog_ID=$id";
	$resultImage = mysqli_query($conn, $sqlImage);
	if (mysqli_num_rows($resultImage)>0) {
		$isImageExist = true;
		$row = mysqli_fetch_assoc($resultImage);
		$fileName = $row['blog_image'];
	}
	$sql = "DELETE FROM tbl_blogs WHERE blog_ID=$id";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		if ($isImageExist) {
			unlink($fileName);
		}
		header("location: blogs.php?deleted");
	}else{
		header("location: blogs.php?notDeleted");
	}
?>