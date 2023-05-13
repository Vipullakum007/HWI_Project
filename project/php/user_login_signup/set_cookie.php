<?php
$lang = "Gujarati";
$sport = "Table tennis";
setcookie("prefLang", $lang, time() + 60);
setcookie("prefSport", $sport, time() + 60 * 2);

// Cookies only become visible on the next page load
// foreach ($_COOKIE as $key => $val) {
//     print $key . " => " . $val . "<br/>";
// }