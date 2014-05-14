<?php
	session_start();
    require_once("php/user.php");
	require_once("php/profile.php");
	require_once("php/feedback.php");
	require_once("php/skills.php");
	require_once("/home/bradg/tutorconnect/config.php");
	include("php/header.php");
?>
	<div id="content">
		<link href="css/search.css"  type="text/css" rel="stylesheet" />
		<script src="js/search.js" type="text/javascript"></script>
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
<?php
	include("php/footer.php");
?>