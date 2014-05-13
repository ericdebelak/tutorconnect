<?php
//start session
session_start();
//requires user.php & profile.php
require_once("user.php");
//registers an instance 
function register()
{
    //requires the location of info and gets the mysql pointer
    require_once("/home/bradg/tutorconnect/config.php");
    $mysqli = Pointer::getMysqli();
    
    //gets info from post and stores it 
    $email = $_POST["email"];
    //trimes the white space 
    $email = trim($email);
    $password = $_POST["password"];

    //verify passwords match
    if($_POST["password"] !== $_POST["confirmPassword"])
    {
        echo "<p style='color: red'>Password does not match confirmed password'.</p>";
        return;
    }
    //creates a salt that is in binary
    $bytes = openssl_random_pseudo_bytes(32, $cstrong);
    //converts the salt into hexidecimal
    $salt = bin2hex($bytes);
    //cancatonates password and salt 
    $passSalt = $password . $salt;
    //hashes the salt
    $hash = hash("sha512", $passSalt, false);
    //puts the new hashed & salted email to new user then user 
    $user = new User(-1, $email, $hash, $salt);
    //throws an exception if not a unique email 
    try
    {
        $user->insert($mysqli);
    }
    catch(Exception $exception)
    {
        echo "<p style='color: red'>Email already in use.</p>";
        return;
    }
    //this fills in the user's profile with some of the info supplied in registration form 
    $id = $user->getId();
    $_SESSION["id"] = $id;
    header("location: profile_Form.php");
}
    //this registers the user 
    register();
?>