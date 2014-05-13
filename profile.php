<?php
    // session start
	session_start();
	// grab config file and class files
	require_once("php/profile.php");
        require_once("php/skills.php");
        require_once("php/interest.php");
        require_once("php/feedback.php");
	require_once("/home/bradg/tutorconnect/config.php");
        try
        {
                $error = "";
                // get the pointer and user id
                $userId = $_GET["userId"];
                $mysqli = Pointer::getMysqli();
                
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
                            <h3>Skills:</h3><p>
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
                            <h3>Interests:</h3><p>
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
                        <?php
                        }
                        ?>
                        </section>
		</div>
		<footer>
		
		</footer>
	</body>
</html>