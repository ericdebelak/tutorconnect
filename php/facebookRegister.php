<?php
    //start session
    session_start();
    //requires user.php & pointer info
    require_once("user.php");
    require_once("/home/bradg/tutorconnect/config.php");
    //registers an instance
    function register()
    {
        $email = $_POST["fbemail"];
        $id = $_POST["fbid"];
        $mysqli = Pointer::getMysqli();
        try
        {
            $user = new User(-1, $email, null, null, 0, $id);
            $user->insert($mysqli);
            header("location: profile_Form.php");
        }
        catch(Exception $exception)
        {
            echo $exception;
        }
        
    }
    register();
?>