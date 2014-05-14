<?php
	function grabFeedback($subjectId)
	{
		$mysqli = Pointer::getMysqli();

		$subject = Profile::getProfileByUserId($mysqli, $subjectId);
		$firstName = $subject->getFirstName();
		$lastName = $subject->getLastName();
		
		$feedbackArray = Feedback::getFeedbackBySubjectId($mysqli, $subjectId);
		if($feedbackArray === 0)
		{
			return "<h3>This user does not have any feedback yet. Give them a shot!</h3>";
		}
		$html = "<p><h2>Ratings for " . $firstName . " " . $lastName . ":</h2>";
		$html = $html . "<table id='feedback'><tr><th>&nbspUser</th><th>Rating</th><th>Session</th><th>Comment</th></tr>";
		foreach($feedbackArray as $feedback)
		{
			$sessionId = $feedback->getSessionId(); // to display in the table
			$session = Session::getSessionBySessionId($mysqli, $sessionId); // get session object
			$sessionDate = $session->getDate(); // to display in the table
			
			$reviewerId = $feedback->getReviewerId(); // get userId of reviewer
			$reviewerProfile = Profile::getProfileByUserId($mysqli, $reviewerId); // get profile object
			$reviewerFirstName = $reviewerProfile->getFirstName(); // to display in table
			
			$html = $html 	. "<tr><td>" . $reviewerFirstName . "</td>"
							. "<td>" . $feedback->getRating() . "</td>"
							. "<td>$sessionId</td>"
							. "<td>" . $feedback->getComments() . "</td></tr>";
		}
		$html = $html . "</table></p>";
		return $html;
	}
?>