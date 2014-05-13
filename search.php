<?php
	session_start();
    require_once("php/user.php");
	require_once("php/profile.php");
	require_once("php/feedback.php");
	require_once("php/skills.php");
	require_once("/home/bradg/tutorconnect/config.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link href="css/tutorconnect.css"  type="text/css" rel="stylesheet" />
		<link href="css/search.css"  type="text/css" rel="stylesheet" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	    <script src="//malsup.github.com/min/jquery.form.min.js"></script>
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
			<section>
				<form id="searchInputForm" method="post" action="php/searchproc.php">
					<div id="searchBoxDiv">
						<select id="selector" name="subject">
							<option value="" disabled selected >Please Select:</option>
							<option value="">-any-</option>
							<option value="Computers">Computers</option>
							<option value="Mathematics">Mathematics</option>
							<option value="Music">Music</option>
							<option value="Reading">Reading</option>
							<option value="Science">Science</option>
							<option value="Social Studies">Social Studies</option>
							<option value="Writing">Writing</option>
						</select>
						<input id="searchInput" placeholder="Enter name (e.g.: 'John')" name="inputText" value="" />
						<input value="Search" id="searchButton" type="submit" />
					</div>
					<div id="howManyResultsDiv">
						<p>View:</p>
						<select id="howManyResultsSelect" name="howMany">
							<option value="10" selected>10</option>
							<option value="20">20</option>
							<option value="50">50</option>
							<option value="100">100</option>
						</select>
					</div>
				</form>
			</section>
			<div id="boxes">
			</div>
		</div>
		<footer>
		
		</footer>
	</body>
</html>