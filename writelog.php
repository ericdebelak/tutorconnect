<?php
	// session start
	session_start();
	// grab config file and class files
	require_once("php/session.php");
	require_once("php/profile.php");
	require_once("/home/bradg/tutorconnect/config.php");
	
	// temp id
	$_SESSION["id"] = 8;
	
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
				<h1>Write a Tutoring Log</h1>
				<p>Select a recent session:
				<form id="log" method="post" action="php/log_proc.php">
				<select name="sessionId">
					<option value="na">Select Session</option> 
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
							echo "<option value='$id'>$date with $firstName $lastName</option>";
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
							echo "<option value='$id'>$date with $firstName $lastName</option>";
						}
					}
					
					
				?>
				</select></p>
				<h3>Notes:</h3>
				<textarea name="notes" id="notes" cols="40" rows="4" placeholder="Write what you covered here."></textarea>
				<h3>Next Steps:</h3>
				<textarea name="nextSteps" id="nextSteps" cols="40" rows="4" placeholder="Write what needs to be reviewed or covered before the next tutoring session."></textarea><br /><br />
				<input type="hidden" name="userId" value="<?php echo $_SESSION["id"]; ?>" />
				<button id="submit" type="submit">Submit</button><br />
				</form>
			</section>
		</div>
		<footer>
		
		</footer>
	</body>
</html>