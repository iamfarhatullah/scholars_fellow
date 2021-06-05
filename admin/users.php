<?php include 'include/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Users</title>		
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
					<div class="form-wrapper">
						<div class="row">
							<div class="col-md-6 col-sm-8 col-xs-6">
								<h3 class="box-title">Users</h3>	
							</div>
							<div class="col-md-6 col-sm-4 col-xs-6">
								<div class="main-action-box">
									<a href="createUser.php" class="sm-primary-btn">Create New</a>
								</div>
							</div>
						</div>
						<table class="table table-striped table-hover">
						<?php  
						require_once("include/connection.php");
						$sql = "SELECT * FROM tbl_profile 
						INNER JOIN tbl_users ON tbl_users.user_ID = tbl_profile.user_FK
						INNER JOIN tbl_users_type ON tbl_users_type.type_ID = tbl_users.user_type_FK";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result)>0) {
							$serialNo = 1;
							echo "<thead>";
							echo "<tr>";
							echo '<th scope="col">#</th>
									<th scope="col">Picture</th>
									<th scope="col">Name</th>
									<th scope="col">Username</th>
									<th scope="col">Email</th>
									<th scope="col">Phone</th>
									<th scope="col">Type</th>
									<th scope="col">Action</th>';
							echo "</tr>";
							echo "</thead>";
							echo "<tbody>";
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<tr>";
								echo "<td>".$serialNo."</td>";
								$row['profile_picture'] == null ?
						        $profilePic = '<td><img class="img-circle" width="30" height="30" src="images/user.jpg"></td>':
						        $profilePic = '<td><img class="img-circle" width="30" height="30" src="'.$row['profile_picture'].'"></td>';
        						echo $profilePic;
								echo '<td>'.$row['profile_first_name'].' '.$row['profile_last_name'].'</td>';
								echo '<td>'.$row['user_username'].'</td>';
								echo '<td>'.$row['user_email'].'</td>';
								echo '<td>'.$row['profile_phone'].'</td>';
								echo '<td>'.$row['type_name'].'</td>';
								echo "<td><a href='viewUser.php?id=".$row['profile_ID']."' class='sm-primary-btn'>View</a></td>";
								echo "</tr>";
								$serialNo++;
							}
							echo "</tbody>";
							echo "</table>";
						}
						?>
						
					</div><br>
				</div>
			</div>

		</div><!-- /Page Contents -->
	</div>
</div>
<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>