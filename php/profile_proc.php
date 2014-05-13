<?php
    session_start();
    require_once("profile.php");
    require_once("/home/bradg/tutorconnect/config.php");
    
    // grab the data
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $dateTime = new DateTime($_POST["birthday"]);
    $birthday = $dateTime->format("Y-m-d");
    $travel = $_POST["travel"];
    $rate = $_POST["rate"];
    if(isset($_POST["interest"]))
    {
        $interestArray = $_POST["interest"];
        $interest = implode(", ", $interestArray);
    }
    $picture = "//students.deepdivecoders.com/~bradg/tutorconnect/images/userImages/avatar.jpg";
    $mysqli = Pointer::getMysqli();
    
    try
    {
        $profile = new Profile(-1, $_SESSION["id"], $firstName, $lastName, $birthday, $picture, $travel, $rate);
        $profile->insert($mysqli);
    }
    catch(Exception $exception)
    {
        echo $exception;
    }
    
    echo "Success!";
?>