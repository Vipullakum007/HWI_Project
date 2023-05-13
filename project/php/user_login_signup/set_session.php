<?php
session_start();
// This tells PHP that a session is requested.
// A session ID is then allocated at the server end.

if (!isset($_SESSION["intVar"])) {
    $_SESSION["intVar"] = 1;
} else {
    $_SESSION["intVar"]++;
}
echo "<p>In this session you have accessed this
    page  {$_SESSION["intVar"]} times.</p>";

echo "<b>Open this URL from different browser and check the count!</b>";
