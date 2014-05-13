<?php
    require_once("user.php");
	require_once("profile.php");
	require_once("feedback.php");
	require_once("skills.php");
	require_once("/home/bradg/tutorconnect/config.php");
	
	function grabSearchResults()
	{
		$mysqli = Pointer::getMysqli();
		
		$subject = $_POST["subject"];
		$inputText = $_POST["inputText"];
		$howMany = $_POST["howMany"];
		
// ******** sanitize the input ******** //
		$subject = trim($subject);
		// test to ensure that only my subjects are allowed in 
		if($subject 	=== "" || 
			$subject 	=== "Computers" ||
			$subject 	=== "Mathematics" ||
			$subject 	=== "Music" ||
			$subject 	=== "Reading" ||
			$subject 	=== "Science" ||
			$subject 	=== "Social Studies" ||
			$subject 	=== "Writing")
		{
			// one of those matches. move on!
		}
		else
		{	// none of them matched. exit
			throw(new Exception("Someone is messing with the form elements"));
		}
		
		$inputText = trim($inputText);
		$inputText = htmlspecialchars($inputText);
		
		$howMany = trim($howMany);
		if(is_numeric($howMany)  === false)
		{
			throw(new Exception("Invalid howMany detected! Someone is messing with the form elements"));
		}
		$howMany = intval($howMany);
		if($howMany === 10)
		{
			$searchHowMany = 10;
		}
		elseif($howMany === 20)
		{
			$searchHowMany = 20;
		}
		elseif($howMany === 50)
		{
			$searchHowMany = 50;
		}
		elseif($howMany === 100)
		{
			$searchHowMany = 100;
		}
		else
		{	// none of them matched. exit
			throw(new Exception("Someone is messing with the form elements"));
		}
		
// ******** use the input to set search variables ******** //
		if($subject == "" && $inputText == "") // if they didn't select a subject or enter anything into the box
		{	// the query template with ? for variables to be bound
			$query = "SELECT experience.userId FROM experience 
						JOIN profile ON experience.userId = profile.userId
						WHERE profile.userId > 0 
							AND experience.userId > 0
						LIMIT ?";
			// prepare the query statement
			$statement = $mysqli->prepare($query);
			if($statement === false)
			{
				throw(new Exception("Unable to prepare statement. $query"));
			}
			// bind parameters to the query template
			$wasClean = $statement->bind_param("i", $howMany);
			if($wasClean === false)
			{
				throw(new Exception("Unable to bind parameters"));
			}
			// okay now do it
			if($statement->execute() === false)
			{
				throw(new Exception("Unable to execute statement"));
			}
			// clean up the statement
		}
		elseif($subject == "" && $inputText != "") // if they entered a name into the box and didn't select a subject
		{	// the query template with ? for variables to be bound
			$query = "SELECT experience.userId FROM experience
						JOIN profile ON experience.userId = profile.userId
							WHERE profile.userId > 0
								AND experience.userId > 0
								AND firstName LIKE ? OR lastName LIKE ?
							LIMIT ?";
			// prepare the query statement
			$statement = $mysqli->prepare($query);
			if($statement === false)
			{
				throw(new Exception("Unable to prepare statement. $query"));
			}
			// bind parameters to the query template
			$wasClean = $statement->bind_param("ssi", $inputText, $inputText, $howMany);
			if($wasClean === false)
			{
				throw(new Exception("Unable to bind parameters"));
			}
			// okay now do it
			if($statement->execute() === false)
			{
				throw(new Exception("Unable to execute statement"));
			}
			// clean up the statement
		}
		elseif($subject != "" && $inputText == "") // if they didn't enter a name into the box, but selected a subject
		{	// prepare the input string to look if it CONTAINS the input somewhere
			$inputText = "%" . $inputText . "%";
			// prepare the query statement
			$query = "SELECT experience.userId FROM experience
						JOIN profile ON experience.userId = profile.userId
							WHERE profile.userId > 0
								AND experience = ?
							LIMIT ?";
			// prepare the query statement
			$statement = $mysqli->prepare($query);
			if($statement === false)
			{
				throw(new Exception("Unable to prepare statement. $query"));
			}
			// bind parameters to the query template
			$wasClean = $statement->bind_param("si", $subject, $howMany);
			if($wasClean === false)
			{
				throw(new Exception("Unable to bind parameters"));
			}
			// okay now do it
			if($statement->execute() === false)
			{
				throw(new Exception("Unable to execute statement"));
			}
			// clean up the statement
		}
		elseif($subject != "" && $inputText != "") // if they both selected a subject AND enterred a name into the box
		{	// prepare the input string to look if it CONTAINS the input somewhere
			$inputText = "%" . $inputText . "%";
			// prepare the query statement
			$query = "SELECT experience.userId FROM experience
						JOIN profile ON experience.userId = profile.userId
							WHERE profile.userId > 0
								AND experience = ?
								AND firstName LIKE ? OR lastName LIKE ?				
							LIMIT ?";
			// prepare the query statement
			$statement = $mysqli->prepare($query);
			if($statement === false)
			{
				throw(new Exception("Unable to prepare statement. $query"));
			}
			// bind parameters to the query template
			$wasClean = $statement->bind_param("sssi", $subject, $inputText, $inputText, $howMany);
			if($wasClean === false)
			{
				throw(new Exception("Unable to bind parameters"));
			}
			// okay now do it
			if($statement->execute() === false)
			{
				throw(new Exception("Unable to execute statement"));
			}
			// clean up the statement
		}
		else
		{
			throw(new Exception("Someone is messing with the form elements"));
		}
// ******** get the result of the query from the mysqli database to create html ******** //
		$result = $statement->get_result();
		if($result === false || $result->num_rows < 1)
		{
			echo "<h2>Your search did not return any results</h2>";
			exit;
		}
		// make the result into an associative array
		$resultArray = array();
		while($results = $result->fetch_assoc())
		{
			if(empty($results["id"]))
			{
				$resultArray[] = $results["userId"];
			}
			elseif(empty($results["userId"]))
			{
				$resultArray[] = $results["id"];
			}
			else
			{
				throw(new Exception("WTF"));
			}
		}
		$statement->close();
		$html = "";
		foreach(array_unique($resultArray) as $row)
		{
			$resultUserId = $row;
			$userProfile = Profile::getProfileByUserId($mysqli, $resultUserId);
			$experienceArray = Experience::getExperienceByUserId($mysqli, $resultUserId);
			$pictureAddress = $userProfile->getPicture();
			$firstName = $userProfile->getFirstName();
			$lastName = $userProfile->getLastName();
			$feedbackAverage = Feedback::getAverageRatingBySubjectId($mysqli,$resultUserId);
			$classNumber = classIdentifier();
			$html = $html . "<section id='box' class='$classNumber'>";
			$html = $html . "<a href='profilepage.php?userId=$resultUserId'><img src='$pictureAddress' width='50px' height='50px' /></a>";
			$html = $html . "<a href='feedbackpage.php?subjectId=$resultUserId'><div id='feedbackDiv'>" . number_format($feedbackAverage, 2) . "</div></a>";
			$html = $html . "<a href='profilepage.php?userId=$resultUserId'><h3>$firstName $lastName</h3></a>";
			//loop through their skills and display in a list.
			$html = $html . "<ul>";
			foreach($experienceArray as $exp)
			{	//may want to limit how many we show here (to say 5-6?) maybe user while loop $i++ to do that.
				$html = $html . "<li>" . $exp->getExperience() . "</li>";
			}
			$html = $html . "</ul></section>";
		} // end of foreach($resultArray as $row) loop
		echo $html;
	} // end of grabSearchResults($subject, $textInput, $howMany)

	// this function randomizes a number between 1 and 3 so the program can randomize color of results divs.
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
	grabSearchResults();
?>