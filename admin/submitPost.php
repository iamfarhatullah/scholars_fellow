<?php  
if (isset($_POST['submitPost'])) {
	require_once("include/connection.php");
	$title = $_POST['title'];
	$details = $_POST['details'];
	$date = $_POST['date'];
	$country = $_POST['country'];
	$university = $_POST['university'];
	$type = $_POST['type'];

	if (empty($_FILES['image']['name'])) {
		$imagepath;
	}else{
		$image = $_FILES['image']['name'];
		$target = "uploads/posts/";
		$imagepath = $target.time()."-".rand(1000, 9999)."-".$image;	
	}

	$sql = "INSERT INTO `tbl_posts`(`post_title`, `post_details`, `post_image`, `post_date`, `post_country`, `post_university`, `post_scholarship_type`) VALUES ('$title','$details','$imagepath','$date','$country','$university','$type')";

	$result = mysqli_query($conn, $sql);
	if ($result) {
		if (!empty($_FILES['image']['name'])) {
			move_uploaded_file($_FILES['image']['tmp_name'], $imagepath);
		}
		header("Location: posts.php?created");
	}else{
		header("Location: posts.php?error");
	}
}elseif (isset($_POST['updatePost'])) {
	require_once("include/connection.php");
	$id = $_POST['postId'];
	$title = $_POST['title'];
	$details = $_POST['details'];
	$date = $_POST['date'];
	$country = $_POST['country'];
	$university = $_POST['university'];
	$type = $_POST['type'];
	$image = $_FILES['image']['name'];
	$target = "uploads/posts/";
	$imagepath = $target.time()."-".rand(1000, 9999)."-".$image;

	$storedImage = $_POST['storedImage'];
    $image;
    $finalImage;
    $newFile = 0;

    if (empty($_FILES['image']['name'])) {
        $finalImage = $storedImage;
    } else {
        $image = $_FILES['image']['name'];
        $image = str_replace(' ', '-', $image);
        $target = "uploads/posts/";
        $imageNewPath = $target.time()."-".$image;    
        $finalImage = $imageNewPath;
        $newFile = 1;
    }

	$sql = "UPDATE `tbl_posts` SET `post_title`='".$title."', `post_details`='".$details."', `post_image`='".$finalImage."', `post_date`='".$date."', `post_country`='".$country."', `post_university`='".$university."', `post_scholarship_type`='".$type."' WHERE  post_ID='".$id."'";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		if ($newFile) {
            move_uploaded_file($_FILES['image']['tmp_name'], $imageNewPath);
            if (!empty($storedImage)) {
            	unlink($storedImage);
            }
        }
		header("Location: posts.php?updated");
	}else{
		header("Location: posts.php?notUpdated");
	}
}
?>