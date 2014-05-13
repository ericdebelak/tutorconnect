<?php
    session_start();
    require_once("php/user.php");
	require_once("php/session.php");
	require_once("php/profile.php");
	require_once("php/feedback.php");
	require_once("../../tutorconnect/config.php");
	require_once("php/feedbackproc.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Tutor Connect Feedback</title>
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
				<a href="search.php"><div>Search Postings</div></a>
				<a href="writelog.html"><div>Post a Job</div></a>
				<a href="feedbackpage.php"><div>Profile</div></a>
				<a href="tutorlog.html"><div>Testimonials</div></a>
			</nav>
		</header>
		<a href="php/form_Tutor.php"><div id="login">Login / Register</div></a>
		<div id="mobileMenu">Menu &darr;
			<div id="dropDown">
				<a href="search.php"><div>Search Postings</div></a>
				<a href="writelog.html"><div>Post a Job</div></a>
				<a href="feedbackpage.php"><div>Profiles</div></a>
				<a href="tutorlog.html"><div>Testimonials</div></a>
			</div>
		</div>
		<div id="content">
			<?php
				$subjectId = $_GET["subjectId"];
				echo grabFeedback($subjectId);
			?>
			
		</div>
		<footer>
		
		</footer>
	</body>
</html>