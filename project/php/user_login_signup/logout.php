<?php
session_start();
$uname = base64_decode(urldecode($_GET["uname"]));
if (isset($uname)) {
    logout($uname);
    header("Location:index.php?msg=You have successfully logged out.");
} else {
    header("Location:index.php?msg='Your session has expired. Please login again.'"); 
}

function logout($uname)
{
    unset($uname);
    session_unset();    
}