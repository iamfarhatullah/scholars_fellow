<?php  
if (isset($_POST['submitBlog'])) {
	require_once("include/connection.php");
	$title = $_POST['title'];
	$details = $_POST['details'];
	$date = $_POST['date'];
	
	$status = $_POST['status'];
	$userId = $_POST['userId'];
	if (empty($_FILES['image']['name'])) {
		$imagepath;
	}else{
		$image = $_FILES['image']['name'];
		$target = "uploads/blogs/";
		$imagepath = $target.time()."-".rand(1000, 9999)."-".$image;	
	}
	

	$sql = "INSERT INTO `tbl_blogs`(`blog_title`, `blog_details`, `blog_date`, `blog_image`, `blog_status`, `user_FK`) VALUES ('$title','$details','$date','$imagepath','$status','$userId')";

	$result = mysqli_query($conn, $sql);
	if ($result) {
		if (!empty($_FILES['image']['name'])) {
			move_uploaded_file($_FILES['image']['tmp_name'], $imagepath);
		}
		header("Location: blogs.php?created");
	}else{
		header("Location: blogs.php?error");
	}
}elseif (isset($_POST['updateBlog'])) {
	require_once("include/connection.php");
	$id = $_POST['blogId'];
	$title = $_POST['title'];
	$details = $_POST['details'];
	$date = $_POST['date'];
	$image = $_FILES['image']['name'];
	$target = "uploads/blogs/";
	$imagepath = $target.time()."-".rand(1000, 9999)."-".$image;
	$status = $_POST['status'];
	$userId = $_POST['userId'];

	$storedImage = $_POST['storedImage'];
    $image;
    $finalImage;
    $newFile = 0;

    if (empty($_FILES['image']['name'])) {
        $finalImage = $storedImage;
    } else {
        $image = $_FILES['image']['name'];
        $image = str_replace(' ', '-', $image);
        $target = "uploads/blogs/";
        $imageNewPath = $target.time()."-".$image;    
        $finalImage = $imageNewPath;
        $newFile = 1;
    }

	$sql = "UPDATE `tbl_blogs` SET `blog_title`='".$title."',`blog_details`='".$details."',`blog_date`='".$date."',`blog_image`='".$finalImage."' WHERE blog_ID='$id'";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		if ($newFile) {
            move_uploaded_file($_FILES['image']['tmp_name'], $imageNewPath);
            if (!empty($storedImage)) {
            	unlink($storedImage);
            }
        }
		header("Location: blogs.php?updated");
	}else{
		header("Location: blogs.php?notUpdated");
	}
}
?>