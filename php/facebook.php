<?php
session_start();
require_once("user.php");
require_once("/home/bradg/tutorconnect/config.php");
function login()
{
    $mysqli = Pointer::getMysqli();
    $email = $_POST["fbemail"];
    $externalId = $_POST["fbid"];
    try
    {
                $user = User::getUserByEmail($mysqli, $email);
    }
    catch(Exception $exception)
    {
                echo "<p style='color: red'>You have not registered on our site using facebook, please register first.</p>";
                return;
    }
    if($user->getExternalId() == $externalId)
    {
        $id = $user->getId();
        $_SESSION["id"] = $id;
        header("location: ../profile.php?userId=$id");
    }
    else
    {
        echo "<p style='color: red'>There was a problem logging in with Facebook.</p>";
    }
    
}
login();
?>