<?php
session_start();
$uname = base64_decode(urldecode($_GET["uname"]));
$param = urlencode(base64_encode($uname));
if (isset($uname)) {
    echo "Welcome, {$uname}. <br/>";
    if (isset($_GET['msg'])) {
        echo $_GET['msg'], "<br/>";
    }
    echo "You can edit profile here. <br/>";
    echo "<form action='process.php' method='post'><table >";
    echo "<tr>";
    echo "<td>";
    echo "Your favourite vehicles. <br/>";
    echo "</td>";
    echo "<td>";
    if (isset($_COOKIE['op1'])) {
        echo '<input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" checked>';
        echo '<label for="vehicle1"> I like a bike</label><br/>';
    } else {
        echo '<input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">';
        echo '<label for="vehicle1"> I like a bike</label><br/>';
    }
    if (isset($_COOKIE['op2'])) {
        echo '<input type="checkbox" id="vehicle2" name="vehicle2" value="Car" checked>';
        echo '<label for="vehicle2"> I like a car</label><br/>';
    } else {
        echo '<input type="checkbox" id="vehicle2" name="vehicle2" value="Car">';
        echo '<label for="vehicle2"> I like a car</label><br/>';
    }
    if (isset($_COOKIE['op3'])) {
        echo '<input type="checkbox" id="vehicle3" name="vehicle3" value="Boat" checked>';
        echo '<label for="vehicle3"> I like a boat</label><br/>';
    } else {
        echo '<input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">';
        echo '<label for="vehicle3"> I like a boat</label><br/>';
    }
    echo "</td>";
    echo "<input type='hidden' name='uname' value={$uname}>";
    echo "<td><input type='submit' value='Save'/></td>";
    echo "</tr>";
    echo "</table></form>";
    echo "You can <a href='logout.php?uname={$param}'>logout</a> here. <br/>";
} else {
    // echo $uname;
    header("Location:login.php?msg='Your session has expired. Please login again.'");
}