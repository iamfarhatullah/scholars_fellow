<?php include 'include/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Create User</title>		
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
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<?php if (isset($_GET['userExist'])) {
						echo "<div class='callout callout-danger'>";
						echo "<p>A user already registered with this username/email</p>";
						echo "<p>Try another username or email</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					}elseif (isset($_GET['userCreated'])) {
						echo "<div class='callout callout-success'>";
						echo "<p>User created successfully!</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					} ?>
					<div class="form-wrapper">
						<h3 class="form-title">Create user</h3><br>
						<form action="submitUser.php" method="post">
							<div class="row">
								<div class="col-md-2 col-sm-3">
									<label class="pull-right">Username *</label>		
								</div>
								<div class="col-md-6 col-sm-9">
									<input type="text" class="form-field" name="username" placeholder="Create username" required><br>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-2 col-sm-3">
									<label class="pull-right">Email *</label>		
								</div>
								<div class="col-md-6 col-sm-9">
									<input type="email" class="form-field" name="email" placeholder="Enter email" required><br>
								</div>
							</div>
							<br>
							<!-- <div class="row">
								<div class="col-md-2 col-sm-3">
									<label class="pull-right">User type *</label>		
								</div>
								<div class="col-md-6 col-sm-9">
									<select name="userType" class="form-field" required>
										<option>Select user type</option>
										<?php  
										require_once("include/connection.php");
										$sql = "SELECT * FROM tbl_users_type";
										$result = mysqli_query($conn, $sql);
										if (mysqli_num_rows($result)>0) {
											while ($row = mysqli_fetch_assoc($result)) {
												$type_ID = $row['type_ID'];
												$type_name = $row['type_name'];
												echo "<option value='".$type_ID."'>".$type_name."</option>";
											}
										}
										?>
									</select>
									<br>
								</div>
							</div> -->
							<!-- <br> -->
							<div class="row">
								<div class="col-md-2 col-sm-3">
									<label class="pull-right">Permissions *</label>		
								</div>
								<div class="col-md-6 col-sm-9">
									<input type="radio" id="createOnly" value="1" name="permissions" checked>
									<label for="createOnly">Create Only</label>
									<span style="padding: 10px;"></span>
									<input type="radio" id="createUpdate" value="2" name="permissions">
									<label for="createUpdate">Create/Update</label>
									<span style="padding: 10px;"></span>
									<input type="radio" id="createUpdateDelete" value="3" name="permissions">
									<label for="createUpdateDelete">Create/Update/Delete</label>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-2 col-sm-3">
									<label class="pull-right">Create password *</label>		
								</div>
								<div class="col-md-6 col-sm-9">
									<input type="password" id="password" class="form-field" name="newPassword" placeholder="New password" required><br>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-2 col-sm-3">
									<label class="pull-right">Confirm password *</label>		
								</div>
								<div class="col-md-6 col-sm-9">
									<input type="password" id="confirm_password" class="form-field" name="ConfirmPassword" placeholder="Confirm password" required><br><br>
									<input type="checkbox" id="checkbox" onclick="showPassword()"> 
									<label for="checkbox">Show Password</label>						
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-2 col-sm-3"></div>
								<div class="col-md-6 col-sm-9">
									<input type="submit" id="sign-up-btn" name="submitUser" class="success-btn" value="Submit">
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
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript">
$('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
    $('#sign-up-btn').prop('disabled', false);
    $('#sign-up-btn').css('cursor', 'pointer');
    $('#confirm_password').css('border', '1px solid green');
    $('#password').css('border', '1px solid green');
  } else {
    $('#sign-up-btn').prop('disabled', true);
    $('#sign-up-btn').css('cursor', 'not-allowed');
    $('#confirm_password').css('border', '1px solid red');
    $('#password').css('border', '1px solid red');
  }
});

function showPassword() {
		var newPassword = document.getElementById('password');
		var confirmPassword = document.getElementById('confirm_password');
		if (newPassword.type === "password") {
			newPassword.type = "text";
			confirmPassword.type = "text";
		}else{
			newPassword.type = "password";
			confirmPassword.type = "password";
		}
	}
</script>
</body>
</html>