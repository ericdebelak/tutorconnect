<?php
	function grabFeedback($subjectId)
	{
		$mysqli = Pointer::getMysqli();
		
		//$subjectId = $_POST["subjectId"];
		// $subjectId = 7;

	/*	$subject = Profile::getProfileByUserId($mysqli, $subjectId);
		$firstName = $subject->getFirstName();
		$lastName = $subject->getLastName();
	*/	$firstName = "Brad";
		$lastName = "Green";
		
		$feedbackArray = Feedback::getFeedbackBySubjectId($mysqli, $subjectId);
		$html = "<p><h2>Ratings for " . $firstName . " " . $lastName . ":</h2>";
		$html = $html . "<table id='feedback'><tr><th>&nbspUser</th><th>Rating</th><th>Session</th><th>Comment</th></tr>";
		foreach($feedbackArray as $feedback)
		{
			$sessionId = $feedback->getSessionId(); // to display in the table
			$session = Session::getSessionBySessionId($mysqli, $sessionId); // get session object
			$sessionDate = $session->getDate(); // to display in the table
			
			$reviewerId = $feedback->getReviewerId(); // get userId of reviewer
	/*		$reviewerProfile = Profile::getProfileByUserId($mysqli, $reviewerId); // get profile object
			$reviewerFirstName = $reviewerProfile->getFirstName(); // to display in table
	*/		$reviewerFirstName = "Kirsten";
			
			$html = $html 	. "<tr><td>" . $reviewerFirstName . "</td>"
							. "<td>" . $feedback->getRating() . "</td>"
							. "<td><a href='sessionpage.php?sessionId=$sessionId'>" . $sessionId . "</a></td>"
							. "<td>" . $feedback->getComments() . "</td></tr>";
		}
		$html = $html . "</table></p>";
		return $html;
	}
?>