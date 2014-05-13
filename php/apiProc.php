/*{"web":{"auth_uri":"https://accounts.google.com/o/oauth2/auth",
"client_secret":"uRANRpyqvO8eFeeaz8stsKTe","token_uri":
"https://accounts.google.com/o/oauth2/token",
"client_email":"599980833060-1lgsbv7cpvaldfrp8roq2k0jf4m2ku0u@developer.gserviceaccount.com",
"redirect_uris":["http://students.deepdivecoders.com/~kirstene/tutorconnect/apiProc.php"],
"client_x509_cert_url":"https://www.googleapis.com/robot/v1/metadata/x509/599980833060-1lgsbv7cpvaldfrp8roq2k0jf4m2ku0u@developer.gserviceaccount.com",
"client_id":"599980833060-1lgsbv7cpvaldfrp8roq2k0jf4m2ku0u.apps.googleusercontent.com",
"auth_provider_x509_cert_url":"https://www.googleapis.com/oauth2/v1/certs",
"javascript_origins":["http://students.deepdivecoders.com"]}}*/

<?php
session_start();
require_once("user.php");
require_once("login.php");
function login()
{
    Pointer::getMysqli();
    $email = $_POST["email"];
    $email = trim($email);
    try
    {
                $user = User::getUserByEmail($mysqli, $email);
    }
    catch(Exception $tion)
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