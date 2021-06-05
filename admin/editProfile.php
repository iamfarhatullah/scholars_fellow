<?php include 'include/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Edit Profile</title>		
<script src="js/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>﻿
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="../font-awesome-5.3.1/css/all.css">
<link rel="icon" href="../img/logo/logo.png" type="image/png">
</head>
<body>
<div class="wrapper">
	<?php include 'include/sidebar.php'; ?>
<!-- Page Content Holder -->
<div id="content">
	<?php include 'include/mainbar.php'; ?>
	<?php  
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		require_once("include/connection.php");
		$sql = "SELECT * FROM tbl_profile WHERE profile_ID='$id'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result)>0) {
			$row = mysqli_fetch_assoc($result);
			$profile_ID = $row['profile_ID'];
			$first_name = $row['profile_first_name'];
			$last_name = $row['profile_last_name'];
			$bio = $row['profile_bio'];
			$phone = $row['profile_phone'];
			$picture = $row['profile_picture'];
		}	
	}else{
		header("Location: profile.php");
	}
	

	?>
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->
			<div class="row">
				<div class="col-md-12">
					<div class="form-wrapper">
						<h3 class="form-title">Edit profile</h3><br>
						<form action="updateProfile.php" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-3">
									<label class="pull-right">First Name *</label>		
								</div>
								<div class="col-md-6">
									<input type="text" class="form-field" name="first_name" value="<?php echo $first_name ?>" placeholder="First name" required><br>		
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<label class="pull-right">Last Name *</label>		
								</div>
								<div class="col-md-6">
									<input type="text" class="form-field" name="last_name" value="<?php echo $last_name; ?>" placeholder="Last name" required><br>		
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<label class="pull-right">Phone number *</label>		
								</div>
								<div class="col-md-6">
									<input type="number" class="form-field" name="phone" value="<?php echo $phone; ?>" placeholder="Phone no" required><br>		
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<label class="pull-right">Profile picture</label>		
								</div>
								<div class="col-md-6">
									<input type="hidden" name="storedImage" value="<?php echo $picture; ?>">
									<input type="file" class="form-field" name="image" accept="image/*">		
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-3">
									<label class="pull-right">Bio data*</label>		
								</div>
								<div class="col-md-6">
									<textarea class="textarea-field" name="bio" rows="5" placeholder="Write about yourself..."><?php echo $bio; ?></textarea>
									<br>		
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-offset-3 col-md-6">
									<input type="hidden" name="id" value="<?php echo $id; ?>">
									<input type="reset" class="primary-btn" value="Reset">
									<input type="submit" name="updateProfile" class="success-btn" value="Update">
								</div>
							</div>
							<br>
						</form>
					</div>
				</div>
			</div>

		</div><!-- /Page Contents -->
	</div>
</div>
</div>

<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>