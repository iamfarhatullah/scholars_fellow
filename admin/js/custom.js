function removeCallout(url) {
  url = url.split( '?' )[0];
  window.location.replace(url)
}

$(document).ready(function () {
	$('#sidebarCollapse').on('click', function () {
		$('#sidebar').toggleClass('active');
		$('.to-hide').toggle();
		$('[data-toggle="tooltip"]').tooltip();
	});
});

// $("#menu-toggle").click( function(e) {
// 	e.preventDefault();
// 	$("#wrapper").toggleClass("menuDisplayed");
// });

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

