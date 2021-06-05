<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Complete your Account</title>		
<script src="js/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../font-awesome-5.3.1/css/all.css">
<link rel="icon" href="../img/logo/logo.png" type="image/png">
</head>
<body>
<?php  
if (isset($_GET['id'])) {
	$user_id = $_GET['id'];
}else{
	header("Location: login.php");
}
?>
<div class="login-page container-fluid">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-2 col-md-8">
				<div class="form-wrapper">
					<h3 class="form-title">Complete your account details</h3><br>
					<form action="" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-3">
								<label class="pull-right">First Name *</label>		
							</div>
							<div class="col-md-9">
								<input type="text" class="form-field" name="first_name" placeholder="First name" required><br>		
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-3">
								<label class="pull-right">Last Name *</label>		
							</div>
							<div class="col-md-9">
								<input type="text" class="form-field" name="last_name" placeholder="Last name" required><br>		
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-3">
								<label class="pull-right">Phone number *</label>		
							</div>
							<div class="col-md-9">
								<input type="number" class="form-field" name="phone" placeholder="Phone no" required><br>		
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-3">
								<label class="pull-right">Profile picture</label>		
							</div>
							<div class="col-md-9">
								<input type="file" class="form-field" name="picture" accept="image/*">		
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-3">
								<label class="pull-right">Bio data*</label>		
							</div>
							<div class="col-md-9">
								<textarea class="textarea-field" name="bio" rows="5" placeholder="Write about yourself..."></textarea>
								<br>		
							</div>
						</div>
						<input type="hidden" name="user_fk" value="<?php echo $user_id; ?>">
						<hr>
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<input type="reset" class="primary-btn" value="Reset">
								<input type="submit" name="submitDetails" class="success-btn" value="Submit">
							</div>
						</div>
						<br>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php  

if (isset($_POST['submitDetails'])) {
	require_once('include/connection.php');

	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$phone = $_POST['phone'];
	$picture = $_POST['picture'];
	if (empty($_FILES['picture']['name'])) {
		$imagepath = '';
	}else{
		$picture = $_FILES['picture']['name'];
		$target = "uploads/profile/";
		$imagepath = $target.time()."-".rand(1000, 9999)."-".$picture;	
	}
	$bio = $_POST['bio'];
	$user_id = $_POST['user_fk'];

	$sql = "INSERT INTO `tbl_profile`(`profile_first_name`, `profile_last_name`, `profile_bio`, `profile_phone`, `profile_picture`, `user_FK`) VALUES ('$first_name','$last_name','$bio','$phone','$imagepath','$user_id')";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		if (!empty($_FILES['picture']['name'])) {
			move_uploaded_file($_FILES['picture']['tmp_name'], $imagepath);
		}
		header('Location: login.php?accountCreated');
	}else{
		header('Location: login.php?tryAgain');
	}
}



?>
</body>
</html>