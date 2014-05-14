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
			<?php
				if($error === "No user found with that id.")
				{
					echo $error;    
				}
				else
				{
			?>
					<h1><?php echo "$firstName $lastName"; ?></h1>
					<img alt="User Avatar" src="<?php echo $picture ?>" />
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
					<h3>Rating:</h3><p><?php echo $rating ?> stars.</p>
					<h3>Rate:</h3><p>$<?php echo $rate ?> per hour.</p>
					<h3>Willingness to Travel:</h3><p><?php echo $travel ?> miles.</p>
					<h2>Jobs:</h2>
					<?php
						if($jobs[0] === "No job postings on record for this user.")
						{
							echo $jobs[0];
						}
						else
						{
							foreach($jobs as $job)
							{
								echo "<h3>" . $job->getTitle() . "</h3>";
								echo $job->getDetails();
								if(isset($_SESSION["id"]))
								{
									echo "<form method='post' id='hire' action='php/hire.php'>
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
								echo "<br /><br />";
							}
						}	
				}
					?>
		</section>
	</div>
<?php
	include("php/footer.php");
?>