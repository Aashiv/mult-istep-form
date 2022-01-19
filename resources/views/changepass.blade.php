<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Change password</title>

	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
	
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
	
    <!-- Bootstrap core CSS -->

	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>

	<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script>
$( function() {
$( "#dob" ).datepicker();
} );
</script>

<style>

.error{ color: red }

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}
</style>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">{{ $user_name }}</a></li>
            <li><a href="{{ url('/logout') }}">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="jumbotron">
					<?php //var_dump(Session::all()); exit;?>
					<form id="regForm">
						@csrf
						<center>
							<h3>Change password:</h3>
						</center>
					  <span class="error" id="error-msg"></span><br/>
					  <!-- One "tab" for each step in the form: -->
						Old Password:
						<p><input placeholder="Old Password..."  id="oldpass" name="oldpass" class="form-control"></p>
						New Password:
						<p><input placeholder="New Password..." oninput="this.className = ''" id="pass" name="pass" type="password" class="form-control"></p>
						Re-enter New Password:
						<p><input placeholder="Re Enter New Password..." oninput="this.className = ''" id="confirm_pass" name="confirm_pass" type="password" class="form-control"></p>

						<button type="button" id="updateProfile" onclick="myFunction()">Change Password</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-3"></div>			
    </div>	
<script>
$(document).ready(function () {
	$('#regForm').validate({
		rules: {
			oldpass: {
				required: true
			},
			pass: {
				required: true				
			},
			confirm_pass: {
				confirm_password: true				
			}
		},
		messages:{
			oldpass: {
				required: "Old password field is required."
			},
			pass: {
				required: "Password field is required."
			},
			confirm_pass: {
				confirm_password: "Enter correct password."
			}
		}
	});			
	jQuery.validator.addMethod('confirm_password', function (value, element) {
		var pass = document.getElementById("pass").value;
		if (pass != '' && value == pass) {
			return true;
		} else {
			return false;
		};
	});	
});

function myFunction(){
	if($("#regForm").valid()){
		
		var FormVal = new Object();
		FormVal._token = "{{ csrf_token() }}";

		// Create variables from the form
		FormVal.oldpass = $('input#oldpass').val(); 
		FormVal.pass = $('input#pass').val(); 
		FormVal.confirm_pass = $('input#confirm_pass').val();  

		$("#error-msg").html('');
		// The AJAX
		$.ajax({  
			type: 'POST',
			url: "{{ url('/updatepass') }}",
			data: FormVal,
			async: false,
			success: function(data) {
				// This is a callback that runs if the submission was a success.
				if(data.status == true) {
					alert('Password field update successful.');
					window.location.href = "{{ url('/') }}";
				} else {
					$("#error-msg").html(data.message);
					$('html, body').animate({
						scrollTop: $("#error-msg").offset().top
					}, 500);					
					// alert(0);
				}
				return false;
			},
			error: function(data){
				console.log(data.errors);
				alert('Whoops! This didn\'t work. Please contact us.');
				return false;
			},
		});
	}
}
</script>

</body>
</html>
