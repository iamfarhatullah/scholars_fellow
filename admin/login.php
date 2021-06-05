<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Login to your account - Scholars Fellow</title>		
<script src="js/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<link rel="icon" href="../img/logo/logo.png" type="image/png">
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../font-awesome-5.3.1/css/all.css">

</head>
<body>
<div class="login-page container-fluid">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-4 col-md-4">
				<div class="">
					<?php if (isset($_GET['accountCreated'])) {
						echo "<div class='callout callout-success'>";
						echo "<p>Account created successfully!</p>";
						echo "<p>Log in now</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					}elseif (isset($_GET['unknownUser'])) {
						echo "<div class='callout callout-danger'>";
						echo "<p>Please try again</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					}elseif (isset($_GET['passwordChanged'])) {
						echo "<div class='callout callout-success'>";
						echo "<p>Password changed successfully!</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					}elseif (isset($_GET['tryAgain'])) {
						echo "<div class='callout callout-success'>";
						echo "<p>An error occured! Please try again later</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					}elseif (isset($_GET['emailSent'])) {
						echo "<div class='callout callout-success'>";
						echo "<p>Please check your Email</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					}elseif (isset($_GET['notExist'])) {
						echo "<div class='callout callout-primary'>";
						echo "<p>Incorrect Email Please try again</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					} ?>					
					<h3 class="form-title">Login Here</h3><br>
					<form action="verifyUser.php" method="post">
						<label>Username</label>
						<input type="text" class="form-field" name="username" placeholder="Username" required><br><br>
						<label>Password</label>
						<input type="password" class="form-field" name="password" placeholder="Enter password" required><br>
						<hr>
						<input type="submit" name="login" class="success-btn" value="Login">
						<a id="myBtn" class="forgot-link">Forgot password</a><hr>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="myModal" class="modal container-fluid">		
	<div class="container">
		<div class="row">
			<div class="col-md-offset-3 col-md-6">
				<div class="form-wrapper">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<h4 class="form-title">Forgot Password</h4>	
						</div>
					</div>
					<br>
					<form action="" method="post">
						<div class="row">
							<div class="col-md-12">
								<label>Please enter email</label><br>
								<input type="email" name="email" class="form-field" placeholder="Email" required>	
							</div>
						</div><br>
						<div class="row">
							<div class="col-md-12">
								<input type="submit" class="success-btn" name="submitEmail" value="Submit">
								<button class="primary-btn cancel">Cancel</button>
							</div>
						</div><br>
					</form>
				</div>
			</div>
		</div>	
	</div>			
</div>

<?php  
if (isset($_POST['submitEmail'])) {
	require_once("include/connection.php");
	$email = $_POST['email'];
	$headers = "From: farhatullah6683@gmail.com";
	$checkSql = "SELECT * FROM tbl_users WHERE user_email='$email'";
	$checkResult = mysqli_query($conn, $checkSql);
	if (mysqli_num_rows($checkResult)>0) {
		$fetchPassword = "SELECT * FROM tbl_users WHERE user_email='$email'";
		$passwordResult = mysqli_query($conn, $fetchPassword);
		if (mysqli_num_rows($passwordResult)>0) {
			$row = mysqli_fetch_assoc($passwordResult);
			$password = $row['user_password'];
			if (mail($email, "Forgot password", "Your password is ".$password, $headers)) {
		 		header("Location: login.php?emailSent");
		 	}
		}
	 }else{
	 	header("Location: login.php?notExist");
	 }
}

?>	
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