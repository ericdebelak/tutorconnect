<?php
    // require the needed files
    require_once("session.php");
    require_once("/home/bradg/tutorconnect/config.php");
    
    try
    {
        
        // grab the info from the form
        $notes = $_POST["notes"];
        $nextSteps = $_POST["nextSteps"];
        $sessionId = $_POST["sessionId"];
        $userId = $_POST["userId"];
        $mysqli = Pointer::getMysqli();
        
        // build the session
        $session = Session::getSessionBySessionId($mysqli, $sessionId);
        
        if($userId == $session->getTutorId())
        {
            $session->setTutorLog($notes);
            $session->setTutorNextSteps($nextSteps);
        }
        
        if($userId == $session->getStudentId())
        {
            $session->setStudentLog($notes);
            $session->setStudentNextSteps($nextSteps);
        }
        
        try
        {
            $session->update($mysqli);
        }
        catch(Exception $exception)
        {
            echo $exception;
        }
        header("location: ../viewlog.php");
    }
    catch(Exception $exception)
    {
        echo $exception;
    }
    
?>