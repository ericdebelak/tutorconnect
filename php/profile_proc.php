<?php
    session_start();
    require_once("profile.php");
    require_once("interest.php");
    require_once("skills.php");
    require_once("/home/bradg/tutorconnect/config.php");
    
    // grab the data
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $dateTime = new DateTime($_POST["birthday"]);
    $birthday = $dateTime->format("Y-m-d");
    $travel = $_POST["travel"];
    $rate = $_POST["rate"];
    $userId = $_SESSION["id"];
    if(isset($_POST["interest"]))
    {
        $interestArray = $_POST["interest"];
    }
    if(isset($_POST["skill"]))
    {
        $skillArray = $_POST["skill"];
    }
    $picture = "//students.deepdivecoders.com/~bradg/tutorconnect/images/userImages/avatar.jpg";
    $mysqli = Pointer::getMysqli();
    
    try
    {
        $profile = new Profile(-1, $userId, $firstName, $lastName, $birthday, $picture, $travel, $rate);
        $profile->insert($mysqli);
        foreach($interestArray as $interest)
        {
            $interest = new Interest(-1, $userId, $interest, "");
            $interest->insert($mysqli);
        }
        foreach($skillArray as $skill)
        {
            $skill = new Experience(-1, $userId, $skill, "");
            $skill->insert($mysqli);
        }
    }
    catch(Exception $exception)
    {
        echo $exception;
    }
    
    echo "Success!";
?>