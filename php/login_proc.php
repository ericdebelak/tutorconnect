<?php
session_start();
require_once("user.php");
function login()
{
    Pointer::getMysqli();
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
        header("location: profilepage.php");
    }
    else
    {
        echo "<p style='color: red'>Email or password do not match our records.</p>";
    }
    
}
?>