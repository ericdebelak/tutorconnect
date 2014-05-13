<?php
    // session start
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link href="css/tutorconnect.css"  type="text/css" rel="stylesheet" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/tutorconnect.js" type="text/javascript"></script>
		<script src="js/canvasLogo.js" type="text/javascript"></script>
		<meta name="viewport" content="width=device-width,initial-scale=1" />
	</head>
	<body onLoad="canvasLogo();">
		<header>
			<div id="top">
				<a href="index.html"><canvas id="canvasLogo" width="240" height="91">
					Your browser doesn't support canvas. DOH!
				</canvas></a>
			</div>
			<nav>
				<a href="search.html"><div>Search Postings</div></a>
				<a href="post.html"><div>Post a Job</div></a>
				<a href="profile.html"><div>Profile</div></a>
				<a href="testimonials.html"><div>Testimonials</div></a>
			</nav>
		</header>
		<div id="login">Login / Register</div>
		<div id="mobileMenu">Menu &darr;
			<div id="dropDown">
				<div>Search Postings</div>
				<div>Post a Job</div>
				<div>Profiles</div>
				<div>Testimonials</div>
			</div>
		</div>
		<div id="content">
			<section>
                            <h1>Please Register:</h1>
                            <div id="registrationText" style="float:left; line-height: 23px; text-align: right">
                               Email: <br />
                               Password: <br />
                               Confirm Password: <br />
                           </div>
                           <form id="register" method="post" action="php/registrationProcess.php" style="text-align: left">
                               <input type="email" id="email" name="email" /><br />
                               <input type="password" id="password" name="password" /><br />
                               <input type="password" id="confirmPassword" name="confirmPassword" /><br />
                               <button type="submit">Register</button><br />
                            </form>
                        </section>
		</div>
		<footer>
		
		</footer>
	</body>
</html>