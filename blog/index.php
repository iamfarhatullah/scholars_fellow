<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blogs</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="../font-awesome-5.3.1/css/all.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<link rel="icon" href="../img/logo/logo.png" type="image/png">
	<script src="../js/jquery-3.2.1.min.js"></script>
	<script src="../bootstrap-4.0.0/js/bootstrap.min.js"></script>
</head>
<body id="body">
<div class="container-fluid blog-main">
	<header>
		<div class="container header-container nopadding">
			<div class="header-bottom">
				<nav class="navbar navbar-expand-lg">
					<a class="navbar-brand" href="../">
						<img src="../img/logo/logo.png" class="img-fluid" width="70">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<i class="fa fa-bars"></i>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav navbar-ul">
							<li>
								<a class="" href="../">Home</a>
							</li>
							<li>
								<a class="" href="../blog/">Blogs</a>
							</li>
							<li>
								<a class="" href="../stories/">Success Stories</a>
							</li>
							<!-- <li>
								<a class="" href="../about/">About</a>
							</li>
							<li>
								<a class="" href="../contact/">Contact</a>
							</li> -->
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</header>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3>Blogs</h3>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid pt-5 pb-5">
	<div class="container pt-4 pb-4">
		<div class="row nopadding">
			<div class="col-md-8 col-sm-12">
				<?php  
				$displayedPostID = 0;
				if (isset($_GET['id'])) {
					$id = $_GET['id'];
					require_once("../admin/include/connection.php");
					$sql = "SELECT * FROM tbl_blogs WHERE blog_ID='$id' AND blog_status='1' LIMIT 1";
					$result = mysqli_query($conn, $sql);
					if (mysqli_num_rows($result)>0) {
						$row = mysqli_fetch_assoc($result);
						$blog_ID = $row['blog_ID'];
						$displayedPostID = $blog_ID;
						$title = $row['blog_title'];
						$details = $row['blog_details'];
						$date = $row['blog_date'];
						$image = $row['blog_image'];
						if (empty($image)) {
							$image = 'images/default.jpg';
						}
						$mydate = date("d-M-Y", strtotime($date));
						echo '<div class="blog-container">					
								<div class="row">
									<div class="col-md-12">
										<h2>'.$title.' <br>
											<span>'.$mydate.'</span>
										</h2>
										<center>
											<img src="../admin/'.$image.'" class="img-fluid" width="100%">
										</center>
										<br>
										<span>'.$details.'</span><br>
									</div>
								</div>
							</div>';
					}
				}elseif(!isset($_GET['id'])) {
					require_once("../admin/include/connection.php");
					$sql = "SELECT * FROM tbl_blogs WHERE blog_status='1' LIMIT 1";
					$result = mysqli_query($conn, $sql);
					if (mysqli_num_rows($result)>0) {
						$row = mysqli_fetch_assoc($result);
						$blog_ID = $row['blog_ID'];
						$displayedPostID = $blog_ID;
						$title = $row['blog_title'];
						$details = $row['blog_details'];
						$date = $row['blog_date'];
						$image = $row['blog_image'];
						if (empty($image)) {
							$image = 'images/default.jpg';
						}
						$mydate = date("d-M-Y", strtotime($date));
						echo '<div class="blog-container">					
								<div class="row">
									<div class="col-md-12">
										<h2>'.$title.' <br>
											<span>'.$mydate.'</span>
										</h2>
										<center>
											<img src="../admin/'.$image.'" class="img-fluid" width="100%">
										</center>
										<br>
										<span>'.$details.'</span><br>
									</div>
								</div>
							</div>';
					}
				}
				?>	
				
				
			</div>
			<div class="col-md-4 col-sm-12">
				<div class="box-wrapper">
					<h4>Recent Blogs</h4>
					<?php  
					require_once("../admin/include/connection.php");
					$sql = "SELECT * FROM tbl_blogs WHERE blog_ID!='$displayedPostID' AND blog_status='1' ORDER by blog_ID desc ";
					$result = mysqli_query($conn, $sql);
					if (mysqli_num_rows($result)>0) {
						while ($row = mysqli_fetch_assoc($result)) {
							$blog_ID = $row['blog_ID'];
							$title = $row['blog_title'];							
							$date = $row['blog_date'];
							$mydate = date("d-M-Y", strtotime($date));
							echo '<div class="recent-post-wrapper">';
							echo '<a href="../blog/?id='.$blog_ID.'">';
							echo '<h3>'.$title.'<br>';
							echo '<i>'.$mydate.'</i>';
							echo '</h3>';
							echo '</a>';
							echo '</div>';
						}
					}else{
						echo "<i>Not available</i>";
					}
				?>
				</div>
			</div>
		</div>
	</div>
</div>

<footer>
	<div class="container-fluid">
		<div class="container">
			<div class="row footer-top">
				<div class="col-md-2 col-sm-6">
					<div class="footer-navigation">
						<h5>NAVIGATION</h5>
						<a href="../" title="Home">Home</a>
						<a href="../blog/" title="Blogs">Blog</a>
						<a href="../stories/" title="Success stories">Success Stories</a>
						<a href="../about/" title="About">About</a>
						<a href="../contact/" title="Contact">Contact</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="footer-contact">
						<h5>CONTACT US</h5>						
						<span class="footer-text">Email: <br> scholarsfellowofficial@gmail.com</span>
					</div> 
				</div>
				<div class="col-md-4 col-sm-6">
					<div class="footer-newsletter">
						<h5>SUBSCRIBE TO OUR NEWSLETTER</h5>
						<p class="">Sign Up to our Newsletter</p>
						<form>
							<div class="row">
								<div class="col-md-7 col-sm-7 col-7 nopadding">
									<input class="footer-form-field" type="email" placeholder="Email Address">		
								</div>
								<div class="col-md-5 col-sm-5 col-5 nopadding">
									<button class="footer-form-btn" type="submit">SUBSCRIBE</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="footer-social">
						<h5>SOCIAL LINKS</h5>
						<p>Follow us on.</p>
						<div>
	                        <a href="https://www.facebook.com/ScholarsFellowOfficial/" target="_blank">
	                            <i class="fab fa-facebook-square"></i>
	                        </a>
	                        <a href="" target="_blank">
	                            <i class="fab fa-linkedin"></i>
	                        </a>
	                        <a href="https://twitter.com/ScholarsFellow?s=08" target="_blank">
	                            <i class="fab fa-twitter-square"></i>
	                        </a>
						</div>		
					</div>
				</div>
			</div>
			<hr>
			<div class="row pt-4 pb-4">			
				<div class="col-md-12">
					<p class="footer-site-info text-center">© Copyright. All Rights Reserved</p>
				</div>
			</div>
		</div>
	</div>
</footer>	
</body>
</html>