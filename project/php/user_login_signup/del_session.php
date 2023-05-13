<?php
session_start();

// Display the session id
echo session_id();

// Check the session name exists or not
if (isset($_SESSION['name'])) {
    echo '<br/>' . 'session is set.';
} else {
    echo '<br/>' . 'session is destroyed';
}

// $_SESSION['name'] = 'aam';
// $_SESSION['email'] = 'aam@ddu.ac.in';

// echo "<br/> {$_SESSION['name']}";
// echo "<br/> {$_SESSION['email']}";

session_unset(); //uncomment this and comment 14, 15

unset($_SESSION['name']); //uncomment this and comment 14, 15