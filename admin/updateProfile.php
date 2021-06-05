<?php  
if (isset($_POST['updateProfile'])) {
	require_once("include/connection.php");
	$id = $_POST['id'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$phone = $_POST['phone'];
	$bio = $_POST['bio'];
	$storedImage = $_POST['storedImage'];
    $image;
    $finalImage;
    $newFile = 0;
	if (empty($_FILES['image']['name'])) {
        $finalImage = $storedImage;
    } else {
        $image = $_FILES['image']['name'];
        $image = str_replace(' ', '-', $image);
        $target = "uploads/profile/";
        $imageNewPath = $target.time()."-".$image;    
        $finalImage = $imageNewPath;
        $newFile = 1;
    }

    $sql = "UPDATE `tbl_profile` SET `profile_first_name`='".$first_name."', `profile_last_name`='".$last_name."', `profile_bio`='".$bio."', `profile_phone`='".$phone."', `profile_picture`='".$finalImage."' WHERE profile_ID='".$id."'";
    $result = mysqli_query($conn, $sql);
	if ($result) {
		if ($newFile) {
            move_uploaded_file($_FILES['image']['tmp_name'], $imageNewPath);
            if (!empty($storedImage)) {
            	unlink($storedImage);
            }
        }
		header("Location: profile.php?updated");
	}else{
		header("Location: profile.php?notUpdated");
	}
	
}

?>