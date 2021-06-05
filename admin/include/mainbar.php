`	<nav class="navbar" id="main-nav">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" id="sidebarCollapse" class="navbar-btn">
					<i class="glyphicon glyphicon-tasks"></i>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right main-ul">
					<a href="">
						<?php  
        					$profile_picture == null ?
        					$profileElement = '<img class="img-circle img-responsive" width="36px" height="36px" src="images/user.jpg">':
        					$profileElement = '<img class="img-circle img-responsive" 
        					width="36px" height="36px" src="'.$profile_picture.'">';
        					// echo $profileElement;
        				?>
						<!-- <img src="images/user.jpg" class="img-responsive img-circle" width="36px"> -->
					</a>
				</ul>
			</div>
		</div>
	</nav>