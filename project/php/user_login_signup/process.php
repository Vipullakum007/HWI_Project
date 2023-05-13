<?php
if (isset($_POST['vehicle1'])) {
    $op1 = $_POST['vehicle1'];
    setcookie('op1', $op1, time() + 600);
} else {
    setcookie('op1');
}
if (isset($_POST['vehicle2'])) {
    $op2 = $_POST['vehicle2'];
    setcookie('op2', $op2, time() + 600);
} else {
    setcookie('op2');
}
if (isset($_POST['vehicle3'])) {
    $op3 = $_POST['vehicle3'];
    setcookie('op3', $op3, time() + 600);
} else {
    setcookie('op3');
}
$uname = $_POST['uname'];
$param = urlencode(base64_encode($uname));
header('Location:profile.php?msg=Your request has executed successfully.&uname=' . $param . "'");