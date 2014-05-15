<?php
    include("php/header.php");
    require_once("php/verification.php");
    require_once("php/user.php");
    require_once("/home/bradg/tutorconnect/config.php");
    $mysqli = Pointer::getMysqli();
    
    $code = $_GET["code"];
    try
    {
        $verify = Verify::getUserByCode($mysqli, $code);
        $userId = $verify->getUserId();
        $user = User::getUserById($mysqli, $userId);
        $user->setVerified(1);
        $user->update($mysqli);
        $verify->delete($mysqli);
        echo "<section>Thank you for registering your email!</section>";
    }
    catch(Exception $exception)
    {
        echo "<section>There was a problem registering your email. Your verification code was not found.</section>";
    }
    include("php/footer.php");
?>