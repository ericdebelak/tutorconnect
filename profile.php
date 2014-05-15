<?php
    // session start
	session_start();
	// grab config file and class files
	require_once("php/profile.php");
	require_once("php/skills.php");
	require_once("php/interest.php");
	require_once("php/feedback.php");
	require_once("php/job.php");
	require_once("/home/bradg/tutorconnect/config.php");
	include("php/header.php");
	try
	{
		$error = "";
		// get the pointer and user id
		if(isset($_GET["userId"]))
		{
			$userId = $_GET["userId"];
		}
		elseif(isset($_SESSION["id"]))
		{
			$userId = $_SESSION["id"];
		}
		$mysqli = Pointer::getMysqli();
		if(isset($_SESSION["id"]))
		{
			$visitorId = $_SESSION["id"];
		}
		// get profile information
		$profile = Profile::getProfileByUserId($mysqli, $userId);
		$firstName = $profile->getFirstName();
		$lastName = $profile->getLastName();
		$dateTime = new DateTime($profile->getBirthday());
		$birthday = $dateTime->format("F d, Y");
		$picture = $profile->getPicture();
		$travel = $profile->getTravel();
		$rate = $profile->getRate();
		
		// get skill information in an array of objects
		try
		{
			$skills = Experience::getExperienceByUserId($mysqli, $userId);
		}
		catch(Exception $exception)
		{
			$skills[0] = "No skills on record for this user.";
		}
		// get job information in an array of objects
		try
		{
			$jobs = Job::getJobsByUserId($mysqli, $userId);
		}
		catch(Exception $exception)
		{
			$jobs[0] = "No job postings on record for this user.";
		}

		// get the interest information in an array of objects
		try
		{
			$interests = Interest::getInterestByUserId($mysqli, $userId);
		}
		catch(Exception $exception)
		{
			$interests[0] = "No interests on record for this user.";
		}
		
		// get average rating
		try
		{
			$ratingUnFormatted = Feedback::getAverageRatingBySubjectId($mysqli, $userId);
			$rating = number_format($ratingUnFormatted, 2);
		}
		catch(Exception $exception)
		{
			$rating = "No reviews yet this user.";
		}
        
	}
	catch(Exception $exception)
	{
		$error = "No user found with that id.";
	}
?>
	<div id="content">
		<section>
			<link href="css/profile.css"  type="text/css" rel="stylesheet" />
			<?php
				if($error === "No user found with that id.")
				{
					echo $error;    
				}
				else
				{
			?>
					<h1 style="margin-bottom: 15px"><?php echo "$firstName $lastName"; ?></h1>
					<span style="float: right">
						<h3>Rating:</h3><p><?php echo $rating ?> stars.</p>
						<h3>Rate:</h3><p>$<?php echo $rate ?> per hour.</p>
						<h3>Willingness to Travel:</h3><p><?php echo $travel ?> miles.</p>
					</span>
					<img alt="User Avatar" src="<?php echo $picture ?>" style="float:left; margin-right: 25px; margin-bottom: 25px" />
					<h3>Information:</h3>
					<p><?php echo "Birthday: $birthday"; ?></p>
					<h3>Skills:</h3>
					<p>
						<?php
							if($skills[0] === "No skills on record for this user.")
							{
								echo $skills[0];
							}
							else
							{
								foreach($skills as $skill)
								{
									echo $skill->getExperience();
									echo "<br />";
								}
							}
						?>
					</p>
					<h3>Interests:</h3>
					<p>
						<?php
							if($interests[0] === "No interests on record for this user.")
							{
								echo $interests[0];
							}
							else
							{
								foreach($interests as $interest)
								{
									echo $interest->getInterest();
									echo "<br />";
								}
							}
						?>
					</p>
		</section>		
			<div id="boxes" class="profile" style="display: block">
				<?php
					function classIdentifier()
					{
						$random = rand(1,3);
						if($random === 1) 
						{
							return("one");
						}
						elseif($random === 2) 
						{
							return("two");
						}
						elseif($random === 3) 
						{
							return("three");
						}
						else
						{
							throw(new Exception("The rand() function doesn't do what I think it does, or someone is messing with something."));
						}
					}
					if($jobs[0] === "No job postings on record for this user.")
					{
						echo "<section id='box' class='two' style='min-width: 300px'>";
						echo "<p>$jobs[0]</p>";
						echo "<br /></section>";
						
					}
					else
					{
						foreach($jobs as $job)
						{	
							$classNumber = classIdentifier();
							echo "<section id='jobbox' class='$classNumber'>";
							echo "<h2>Job:</h2>";
							echo "<a href='feedbackpage.php?subjectId=$userId'><div id='feedbackDivPost'>" . number_format($rating, 2) . "</div></a>";
							echo "<a href='profile.php?userId=$userId'><img id='postPic' src='$picture' height='150px' width='150px' /></a>";
							echo "<a href='profile.php?userId=$userId'><h1>$firstName $lastName</h1></a>";
							$html = "<ul>";
							foreach($skills as $skill)
							{	
								$html = $html . "<li>" . $skill->getExperience() . "</li>";
							}
							$html = $html . "</ul>";
							echo "$html";
							echo "<div id='rate'><h3>\$$rate</h3></div>";
							echo "<h3>" . $job->getTitle() . "</h3>";
							echo "<div id='postDetails'>" . $job->getDetails() . "</div>";
							if(isset($_SESSION["id"]))
							{
								echo "<form method='post' id='hire' action='php/hire.php'><br />
									<button type='submit'>Hire $firstName</button>
									<input type='hidden' name='tutorId' value='$userId' />
									<input type='hidden' name='studentId' value='$visitorId' />
								</form>";
							}
							elseif($userId == $visitorId)
							{
								echo "<p>You cannot hire yourself.</p>";
							}
							else
							{
								echo "<p>You must be logged in to hire $firstName.</p>";
							}
							echo "<br /></section>";
						}
					}	
				}
				?>
			</div>
	</div>
<?php
	include("php/footer.php");
?>