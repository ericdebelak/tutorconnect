<?php
session_start();
require_once("user.php");
require_once("/home/bradg/tutorconnect/config.php");
function login()
{
    $mysqli = Pointer::getMysqli();
    $email = $_POST["email"];
    $email = trim($email);
    try
    {
                $user = User::getUserByEmail($mysqli, $email);
    }
    catch(Exception $exception)
    {
                echo "<p style='color: red'>Email or password do not match our records.</p>";
                return;
    }
    $salt = $user->getSalt();
    $password = $_POST["password"] . $salt;
    $password = hash("sha512", $password, false);
    if($user->getPassword() == $password)
    {
        $id = $user->getId();
        $_SESSION["id"] = $id;
        $verified = $user->getVerified();
        if($verified === 1)
        {
            header("location: ../profile.php?userId=$id");
        }
        else
        {
            var_dump($verified);
            echo "Please register your email.";
        }
    }
    else
    {
        echo "<p style='color: red'>Email or password do not match our records.</p>";
    }
    
}
login();
?>