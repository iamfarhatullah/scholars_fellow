<?php  
	require_once("include/connection.php");
	$id = $_GET['id'];
	$sqlImage = "SELECT post_image FROM tbl_posts WHERE post_ID=$id";
	$resultImage = mysqli_query($conn, $sqlImage);
	if (mysqli_num_rows($resultImage)>0) {
		$isImageExist = true;
		$row = mysqli_fetch_assoc($resultImage);
		$fileName = $row['post_image'];
	}
	$sql = "DELETE FROM tbl_posts WHERE post_ID=$id";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		if ($isImageExist) {
			unlink($fileName);
		}
		header("location: posts.php?deleted");
	}else{
		header("location: posts.php?notDeleted");
	}
?>