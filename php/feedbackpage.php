<?php
    session_start();
    require_once("user.php");
	require_once("sessions.php");
	require_once("feedback.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Tutor Connect Feedback</title>
		<link href="css/tutorconnect.css"  type="text/css" rel="stylesheet" />
		<link href="css/search.css"  type="text/css" rel="stylesheet" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/tutorconnect.js" type="text/javascript"></script>
		<script src="js/canvasLogo.js" type="text/javascript"></script>
		<script src="js/search.js" type="text/javascript"></script>
		<meta name="viewport" content="width=device-width,initial-scale=1" />
	</head>
	<body onLoad="searchLoad(); canvasLogo();">
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
				<div id="searchBoxDiv">
					<select id="selector">
						<option value="" disabled selected >Please Select:</option>
						<option value="Computers">Computers</option>
						<option value="Mathematics">Mathematics</option>
						<option value="Music">Music</option>
						<option value="Reading">Reading</option>
						<option value="Science">Science</option>
						<option value="Social Studies">Social Studies</option>
						<option value="Writing">Writing</option>
					</select>
					<input id="searchInput" placeholder="Enter your search here:" />
					<input value="Search" id="searchButton" type="submit" />
				</div>
				<div id="howManyResultsDiv">
					<p>View:</p>
					<select id="howManyResultsSelect">
						<option value="10" selected>10</option>
						<option value="20">20</option>
						<option value="50">50</option>
						<option value="lots">All</option>
					</select>
				</div>
			</section>
			<div id="boxes">
			
			</div>
		</div>
		<footer>
		
		</footer>
	</body>
</html>