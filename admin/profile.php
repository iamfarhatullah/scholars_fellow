<?php include 'include/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Profile</title>		
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
	require_once("include/connection.php");
	// echo $user_ID;
	$sql = "SELECT * FROM tbl_profile 
	INNER JOIN tbl_users ON tbl_users.user_ID = tbl_profile.user_FK
	INNER JOIN tbl_users_type ON tbl_users_type.type_ID = tbl_users.user_type_FK
	WHERE user_FK='$user_ID'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result)>0) {
		$row = mysqli_fetch_assoc($result);
		$profile_ID = $row['profile_ID'];
		$first_name = $row['profile_first_name'];
		$last_name = $row['profile_last_name'];
		$bio = $row['profile_bio'];
		$phone = $row['profile_phone'];
		$picture = $row['profile_picture'];
		$user_ID = $row['user_ID'];
		$username = $row['user_username'];
		$email = $row['user_email'];
		$user_type = $row['type_name'];
		$user_permission = $row['user_permissions'];
		if ($user_permission == 1) {
			$userPermission = "Create Only";
		}elseif ($user_permission == 2) {
			$userPermission = "Create/Update Only";
		}elseif ($user_permission == 3) {
			$userPermission = "Create/Update/Delete";
		}elseif ($user_permission == 4) {
			$userPermission = "Blogs only";
		}
		$picture == null ?
        $profilePic = '<img class="img-circle profile-pic" width="150" height="150" src="images/user.jpg">':
        $profilePic = '<img class="img-circle profile-pic" width="150" height="150" src="'.$picture.'">';
	}

	?>
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->
			<div class="row"><br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<?php if (isset($_GET['updated'])) {
						echo "<div class='callout callout-primary'>";
						echo "<p>Profile updated Successfully</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					}elseif (isset($_GET['notUpdated'])) {
						echo "<div class='callout callout-danger'>";
						echo "<p>Update failed</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					}elseif (isset($_GET['incorrectPassword'])) {
						echo "<div class='callout callout-danger'>";
						echo "<p>Incorrect Password</p>";
						echo "<p>Please try again</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					} ?>
					<div class="form-wrapper">
						<div class="row"><br>
							<div class="col-md-3 col-sm-4">
								<center>
									<br>
									<?php echo $profilePic; ?>
								</center>
							</div>
							<div class="col-md-9 col-sm-8">
								<h3 class="profile-name"><?php echo $first_name." ".$last_name; ?></h3>
								<br>
								<span class="admin-tag">(<?php echo $user_type; ?>)</span><br>
								<span class="profile-data">Permissions: <?php echo $userPermission; ?></span><br><br>
								<span class="profile-data"><i class="fas fa-at"></i> <?php echo $username; ?></span>
								<span class="profile-data"><i class="far fa-envelope-open"></i> <?php echo $email; ?></span>
								<span class="profile-data"><i class="fas fa-phone"></i> <?php echo $phone; ?></span><br><br>
								<a href="editProfile.php?id=<?php echo $profile_ID; ?>" class="primary-btn">Edit profile</a>
								<button type="button" id="myBtn" class="sm-success-btn">Change password</button>
							</div>
						</div><br>
						<div class="row">
							<div class="col-md-offset-3 col-md-9 col-sm-offset-4 col-sm-8">
								<h3 class="form-title">Bio</h3>
								<p><?php echo $bio; ?></p>
							</div>
						</div><br><br>
					</div>
				</div>
			</div>

		</div><!-- /Page Contents -->
	</div>
</div>


<div id="myModal" class="modal container-fluid">		
	<div class="container">
		<div class="row">
			<div class="col-md-offset-3 col-md-6">
				<div class="form-wrapper">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<h4 class="form-title">Enter current password</h4>	
						</div>
					</div>
					<br>
					<form action="changePassword.php" method="post">
						<div class="row">
							<div class="col-md-12">
								<label>Please enter your current password</label><br>
								<input type="password" name="currentPassword" class="form-field" placeholder="Password" required>	
							</div>
						</div><br>
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" name="user_ID" value="<?php echo $user_ID; ?>">
								<input type="submit" class="success-btn" name="changePassword" value="Submit">
								<button class="primary-btn cancel">Cancel</button>
							</div>
						</div><br>
					</form>
				</div>
			</div>
		</div>	
	</div>			
</div>

<script type="text/javascript">
	
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("cancel")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>