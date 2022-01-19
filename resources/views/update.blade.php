<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Update Profile</title>

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
							<h3>Update Profile:</h3>
						</center>
					  <span class="error" id="error-msg"></span><br/>
					  <!-- One "tab" for each step in the form: -->
						First Name:
						<p><input placeholder="First name..."  id="fname" name="fname" class="form-control" value="{{ $first_name }}"></p>
						Last Name:
						<p><input placeholder="Last name..."  id="lname" name="lname" class="form-control" value="{{ $last_name }}"></p>
						Email:
						<p><input placeholder="E-mail..."  id="email" name="email" class="form-control" value="{{ $email }}"></p>
						Date Of Birth:
						<p><input  name="dob" id="dob" class="form-control" value="{{ $dob }}"></p>
						State:
						<p><input placeholder="State..."  id="state" name="state" class="form-control" value="{{ $state }}"></p>
						City:
						<p><input placeholder="City..."  id="city" name="city" class="form-control" value="{{ $city }}"></p>	
						User Name:
						<p><input placeholder="Username..."  id="uname" name="uname" class="form-control" value="{{ $user_name }}"></p>

						<button type="button" id="updateProfile" onclick="myFunction()">Update Profile</button>
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
			fname: {
				required: true,
				firstname: true
			},
			lname: {
				required: true,
				firstname: true
			},
			email: {
				required: true,
				email_rule: true
			},
			dob: {
				required: true				
			},
			state: {
				required: true				
			},
			city: {
				required: true				
			},
			uname: {
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
			fname: {
				required: "First name field is required.",
				firstname: "Enter valid first name"
			},
			lname: {
				required: "Last name field is required.",
				lastname: "Enter valid last name"				
			},
			email: {				
				required: "Email field is required.",
				email_rule: "Enter valid Email address"
			},
			dob: {
				required: "Date of birth field is required."
			},
			state: {
				required: "State field is required."
			},
			city: {
				required: "City field is required."
			},
			uname: {
				required: "User name field is required."
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
	jQuery.validator.addMethod('firstname', function (value, element) {
		if (/^[a-zA-Z0-9_-]+$/.test(value)) {
			return true;
		} else {
			return false;
		};
	});
	jQuery.validator.addMethod('email_rule', function (value, element) {
		if (/^([a-zA-Z0-9_\-\.]+)\+?([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value)) {
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
		FormVal.first_name = $('input#fname').val(); 
		FormVal.last_name = $('input#lname').val(); 
		FormVal.email = $('input#email').val();  
		FormVal.dob = $('input#dob').val();
		FormVal.state = $('input#state').val();
		FormVal.city = $('input#city').val();

		FormVal.user_name = $('input#uname').val(); 

		$("#error-msg").html('');
		// The AJAX
		$.ajax({  
			type: 'POST',
			url: "{{ url('/updatedetail') }}",
			data: FormVal,
			async: false,
			success: function(data) {
				// This is a callback that runs if the submission was a success.
				if(data.status == true) {
					alert('Profile details update successful.');
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
