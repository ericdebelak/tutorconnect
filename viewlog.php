<?php
	// session start
	session_start();
	// grab config file and class files
	require_once("php/session.php");
	require_once("php/profile.php");
	require_once("/home/bradg/tutorconnect/config.php");
	
	// temp id
	$_SESSION["id"] = 7;
	
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
				<h1>Tutoring Log</h1>
				<h3>Your Recent Tutoring Sessions:</h3>
				<?php
					$mysqli = Pointer::getMysqli();
					try
					{
						$studentSessions = Session::getSessionByStudentId($mysqli, $_SESSION["id"]);
					}
					catch(Exception $exception)
					{
						$studentSessions = false;
					}
					try
					{
						$tutorSessions = Session::getSessionByTutorId($mysqli, $_SESSION["id"]);
					}
					catch(Exception $exception)
					{
						$tutorSessions = false;
					}
					
					if(empty($studentSessions) === false)
					{
						foreach($studentSessions as $object)
						{
							$log = $object->getStudentLog();
							if($log !== "")
							{
								continue;
							}
							$nextSteps = $object->getStudentNextSteps();
							if($nextSteps !== "")
							{
								continue;
							}
							$id = $object->getId();
							$dateTime = new DateTime($object->getDate());
							$date = $dateTime->format("l F d, Y");
							$tutorId = $object->getTutorId();
							$tutorProfile = Profile::getProfileByUserId($mysqli, $tutorId);
							$firstName = $tutorProfile->getFirstName();
							$lastName = $tutorProfile->getLastName();
							echo "<p>$date with $firstName $lastName</p>";
						}
					}
					
					if(empty($tutorSessions) === false)
					{
						foreach($tutorSessions as $object)
						{
							$log = $object->getTutorLog();
							if($log !== "")
							{
								continue;
							}
							$nextSteps = $object->getTutorNextSteps();
							if($nextSteps !== "")
							{
								continue;
							}
							$id = $object->getId();
							$dateTime = new DateTime($object->getDate());
							$date = $dateTime->format("l F d, Y");
							$studentId = $object->getStudentId();
							$studentProfile = Profile::getProfileByUserId($mysqli, $studentId);
							$firstName = $studentProfile->getFirstName();
							$lastName = $studentProfile->getLastName();
							echo "<p>$date with $firstName $lastName</p>";
						}
					}
					
					
				?>
				<button>Write logs for these sessions</button>
				<h2>Tutor Log</h2>
				<?php
					if(empty($studentSessions) === false)
					{
						foreach($studentSessions as $object)
						{
							$log = $object->getStudentLog();
							if($log === "")
							{
								continue;
							}
							$nextSteps = $object->getStudentNextSteps();
							if($nextSteps === "")
							{
								continue;
							}
							$id = $object->getId();
							$dateTime = new DateTime($object->getDate());
							$date = $dateTime->format("l F d, Y");
							$tutorId = $object->getTutorId();
							$tutorProfile = Profile::getProfileByUserId($mysqli, $tutorId);
							$firstName = $tutorProfile->getFirstName();
							$lastName = $tutorProfile->getLastName();
							$tutorLog = $object->getTutorLog();
							$tutorNextSteps = $object->getTutorNextSteps();
							$studentLog = $object->getStudentLog();
							$studentNextSteps = $object->getStudentNextSteps();
							echo "<h2>$date with $firstName $lastName</h2>";
							echo "<div style='background-color: #DA9C3A; padding: 15px'><h3>Tutor's Notes:</h3><p>$tutorLog</p><h4>Next Steps:</h4><p>$tutorNextSteps</p></div>";
							echo "<div style='background-color: #DAC23A; padding: 15px'><h3>Student's Notes:</h3><p>$studentLog</p><h4>Next Steps:</h4><p>$studentNextSteps</p></div>";
				
						}
					}
					
					if(empty($tutorSessions) === false)
					{
						foreach($tutorSessions as $object)
						{
							$log = $object->getTutorLog();
							if($log === "")
							{
								continue;
							}
							$nextSteps = $object->getTutorNextSteps();
							if($nextSteps === "")
							{
								continue;
							}
							$id = $object->getId();
							$dateTime = new DateTime($object->getDate());
							$date = $dateTime->format("l F d, Y");
							$studentId = $object->getStudentId();
							$studentProfile = Profile::getProfileByUserId($mysqli, $studentId);
							$firstName = $studentProfile->getFirstName();
							$lastName = $studentProfile->getLastName();
							$tutorLog = $object->getTutorLog();
							$tutorNextSteps = $object->getTutorNextSteps();
							$studentLog = $object->getStudentLog();
							$studentNextSteps = $object->getStudentNextSteps();
							echo "<h2>$date with $firstName $lastName</h2>";
							echo "<div style='background-color: #DA9C3A; padding: 15px'><h3>Tutor's Notes:</h3><p>$tutorLog</p><h4>Next Steps:</h4><p>$tutorNextSteps</p></div>";
							echo "<div style='background-color: #DAC23A; padding: 15px'><h3>Student's Notes:</h3><p>$studentLog</p><h4>Next Steps:</h4><p>$studentNextSteps</p></div>";
						}
					}
					
					
				?>
			</section>
		</div>
		<footer>
		
		</footer>
	</body>
</html>