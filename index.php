<?php
session_start();
if(isset($_SESSION['username'])){
    if ($_SESSION['type'] == "admin") {
        header('Location:admin/index.php');
    } elseif ($_SESSION['type'] == "Teacher") {
        echo $_SESSION['userID'];
<<<<<<< HEAD
        header('Location: //192.168.5.40:3000/classes');
=======
        header('Location: //localhost:3000/classes');
>>>>>>> 3278babb10ffff50a411fb089528096584c43085
    } elseif ($_SESSION['type'] == "Student") {
        header('Location: //localhost:8080/classes.jsp?ayd=' . $_SESSION['userID']);
    }else {
        $m = "Who are you!";
        echo "
            <script type = 'text/javascript'>
                alert('$m');
                window.location.replace('../index.php');
            </script>
         ";
    }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

<link href="css/font-awesome.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/pages/signin.css" rel="stylesheet" type="text/css">

</head>

<body>





<div class="account-container">

	<div class="content clearfix">

		<form action="admin/login.php" method="post">

            <div class="text-center">
			    <h1>Member Login</h1>
            </div>

			<div class="login-fields">


				<div class="field">
					<label for="username">Username</label>
					<input required type="number" id="username" name="idnumber" value="" placeholder="ID #" class="login username-field" />
				</div> <!-- /field -->

				<div class="field">
					<label for="password">Password:</label>
					<input required type="password" id="password" name="password" value="" placeholder="Password" class="login password-field"/>
				</div> <!-- /password -->

			</div> <!-- /login-fields -->

			<div class="pull-left">
                <a href="signup.php" class="button btn btn-success btn-large">Sign Up</a>

			</div> <!-- .actions -->
            <div class="pull-right">
                <input type="submit" class="button btn btn-success btn-large" VALUE="Sign In">

            </div> <!-- .actions -->


		</form>

	</div> <!-- /content -->

</div> <!-- /account-container -->





<script src="admin/js/jquery-1.7.2.min.js"></script>
<script src="admin/js/bootstrap.js"></script>

<script src="admin/js/signin.js"></script>

</body>

</html>
