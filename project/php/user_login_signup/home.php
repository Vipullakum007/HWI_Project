<?php
session_start();
$uname = base64_decode(urldecode($_GET["uname"]));
if (isset($uname)) {
    echo "Welcome,";
    echo $_SESSION['uname'];
    echo "<br/><br/>";
    $param = urlencode(base64_encode($uname));
    echo "You can edit <a href='profile.php?uname=$param'>profile</a> here. <br/><br/>";
    echo "You can <a href='logout.php?uname=$param'>logout</a> here. <br/><br/>";
} else {
    header("Location:login.php?msg='Your session has expired. Please login again.'");
}
