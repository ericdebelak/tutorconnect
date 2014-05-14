<?php
	session_start();
	if(!isset($_SESSION["id"]))
	{
		header("location: logon.php");
	}
    require_once("php/user.php");
	require_once("php/profile.php");
	require_once("php/feedback.php");
	require_once("php/skills.php");
	require_once("/home/bradg/tutorconnect/config.php");
	include("php/header.php");
?>
	<div id="content">
		<div id="boxes">
			<section id="box" class="one">
				<form id="inputForm" method="post" action="php/jobproc.php">
					<br /><input name="postTitleInput" id="postTitleInput" placeholder="Job Posting Title..."></input><br /><br />
					<textarea name="postDetailsInput" id="postDetailsInput" rows="10" cols="50" 
						onfocus="if(this.value == 'Enter description here:') { this.value = ''; }" 
						onblur="if (this.value == '') { this.value='Enter description here:'; }">Enter description here:</textarea><br /><br />
					<button type="button" id="Preview" onClick="previewJob();">Preview</button>
					<button id="Submit">Submit</button><br />
				</form>
			</section>
			<section id="box" class="two">
				<?php
					$mysqli = Pointer::getMysqli();
					$userId = $_SESSION["id"];
					try
					{
						$userProfile = Profile::getProfileByUserId($mysqli, $userId);
					}
					catch(Exception $message)
					{
						echo "Your profile is not set up yet";
						header("location: php/profile_Form.php");
					}
					$pictureAddress = $userProfile->getPicture();
					try
					{
						$experienceArray = Experience::getExperienceByUserId($mysqli, $userId);
					}
					catch(Exception $message)
					{
						echo "Your experience is not set up yet";
						header("location: php/profile_Form.php");
					}
					$firstName = $userProfile->getFirstName();
					$lastName = $userProfile->getLastName();
					$feedbackAverage = Feedback::getAverageRatingBySubjectId($mysqli,$userId);
					$cost = $userProfile->getRate();
					echo "<a href='profile.php?userId=$userId'><img id='postPic' src='$pictureAddress' height='150px' width='150px' /></a>";
					echo "<a href='feedbackpage.php?subjectId=$userId'><div id='feedbackDivPost'>" . number_format($feedbackAverage, 2) . "</div></a>";
					echo "<a href='profile.php?userId=$userId'><h1>$firstName $lastName</h1></a>";
					$html = "<ul>";
					foreach($experienceArray as $exp)
					{	
						$html = $html . "<li>" . $exp->getExperience() . "</li>";
					}
					$html = $html . "</ul>";
					echo "$html";
					echo "<div id='rate'><h3>\$$cost</h3></div>";
					echo "<h3><div id='postTitle'>~~ Post Title Goes Here ~~</div></h3>";
					echo "<div id='postDetails'>The details of your job will go in this section of your job posting. 
						Please make sure to include relevant information such as availability and perhaps your level of expertise.
						This is your opportunity to sale yourself and persuade perspective students to pick you over your competitors.</div>";
				?>
			</section>
		</div>
	</div>
<?php
	include("php/footer.php");
?>