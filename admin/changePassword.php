<?php include 'include/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Change password</title>		
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
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->
		<?php  
		if (isset($_POST['changePassword'])) {
			require_once("include/connection.php");
			$user_ID = $_POST['user_ID'];
			$currentPassword = $_POST['currentPassword'];
			$sql = "SELECT * FROM tbl_users WHERE user_ID='$user_ID' AND user_password='$currentPassword'";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result)>0) {
		?>
			<div class="row"><br>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="form-wrapper">
						<h3 class="form-title">Change password</h3><br>
						<form action="updatePassword.php" method="post">
							<div class="row">
								<div class="col-md-2 col-sm-3">
									<label class="pull-right">New password *</label>		
								</div>
								<div class="col-md-6 col-sm-9">
									<input type="password" id="password" class="form-field" name="newPassword" placeholder="New password" autofocus="on" required><br>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-2 col-sm-3">
									<label class="pull-right">Confirm password *</label>		
								</div>
								<div class="col-md-6 col-sm-9">
									<input type="password" id="confirm_password" class="form-field" name="confirmPassword" placeholder="Confirm password" required><br><br>
									<input type="checkbox" id="checkbox" onclick="showPassword()"> 
									<label for="checkbox">Show Password</label>						
								</div>
							</div><hr>
							<div class="row">
								<div class="col-md-offset-2 col-md-10 col-sm-offset-3 col-sm-9">
									<input type="hidden" name="user_ID" value="<?php echo $user_ID; ?>">
									<input type="submit" id="sign-up-btn" class="success-btn" name="updatePassword" value="Change">
									<br><br>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>	
		<?php
			}else{
				header("Location: profile.php?incorrectPassword");
			}		
		}
		?>
			

		</div><!-- /Page Contents -->
	</div>
</div>

<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>