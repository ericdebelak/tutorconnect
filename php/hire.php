<?php
    // session start
	session_start();
	// grab config file and class files
	require_once("session.php");
	require_once("/home/bradg/tutorconnect/config.php");
        
        $tutorId = $_POST["tutorId"];
        $studentId = $_POST["studentId"];
        $mysqli = Pointer::getMysqli();
        try
        {
            $session = new Session(-1, $tutorId, $studentId, null, null, null, null, "2014-05-23");
            $session->insert($mysqli);
           
        }
        catch(Exception $exception)
        {
            echo $exception;
            return false;
        }
        
        echo "Success";
?>