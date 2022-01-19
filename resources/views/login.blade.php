<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin</title>

    <!-- Bootstrap core CSS -->
	<link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <script src="{{ url('assets/js/ie-emulation-modes-warning.js') }}"></script>

  </head>

  <body>

    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <form class="form-signin" action="{{ route('dologin') }}" method="post">
			@csrf
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
			<br/>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
			<br/>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
          </form>
          <a style="float:right; text-decoration:underline" href="{{ url('/registration') }}">register me</a>
        </div>
      </div>
    </div> <!-- /container -->
  </body>
</html>