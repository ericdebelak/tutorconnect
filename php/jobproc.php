<?php
	session_start();
	if(!isset($_SESSION["id"]))
	{
		header("location: ../logn.php");
		exit;
	}
	// get required class(es)
	require_once("job.php");
	require_once("/home/bradg/tutorconnect/config.php");
	// connect to the server and get a pointer to use in this function 
	$mysqli = Pointer::getMysqli();
	// grab their userId from their session
	$userId = $_SESSION["id"];
	// sanitizing while reading from POST, it's never early enough to sanitize user input.
	$title = htmlspecialchars($_POST["postTitleInput"]);
	$details = htmlspecialchars($_POST["postDetailsInput"]);
	try
	{
		$newJob = new Job(-1, $userId, $title, $details);
	}
	catch(Exception $exception)
	{	// rethrow exception
		throw(new Exception("Unable to create job. Uh oh!"));
	}
	try
	{
		$newJob->insert($mysqli);
	}
	catch(Exception $exception)
	{	// rethrow exception
		throw(new Exception("Unable to insert job into the database!"));
	}
	header("Location: ../profile.php?userId=$userId");
	exit;
?>