<!DOCTYPE html>
<html>
	<head>
		<title>Tutor Connect</title>
		<link href="css/tutorconnect.css"  type="text/css" rel="stylesheet" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="//malsup.github.com/jquery.form.js"></script>
		<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script>
		<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/additional-methods.min.js"></script>
		<script src="js/jquery_formvalidation.js" type="text/javascript"></script>
		<script src="js/tutorconnect.js" type="text/javascript"></script>
		<script src="js/canvasLogo.js" type="text/javascript"></script>
		<meta name="viewport" content="width=device-width,initial-scale=1" />
	</head>
	<body onLoad="canvasLogo();">
		<header>
			<div id="top">
				<a href="index.php"><canvas id="canvasLogo" width="240" height="91">
					Your browser doesn't support canvas. DOH!
				</canvas></a>
			</div>
			<nav>
				<a href="search.php"><div>Search Postings</div></a>
				<a href="postjob.php"><div>Post a Job</div></a>
				<a href="profile.php"><div>Profile</div></a>
				<a href="viewlog.php""><div>Logs</div></a>
				<a href="logoutproc.php"><div>Log Out</div></a>
			</nav>
		</header>
		<a href="php/login.php"><div id="login">Login</div></a>
		<a href="register.php"><div id="registerButton">Register</div></a>
		<div id="mobileMenu">Menu &darr;
			<div id="dropDown">
				<a href="search.php"><div>Search Postings</div></a>
				<a href="postjob.php"><div>Post a Job</div></a>
				<a href="profile.php"><div>Profile</div></a>
				<a href="viewlog.php""><div>Logs</div></a>
				<a href="logoutproc.php"><div>Log Out</div></a>
			</div>
		</div>