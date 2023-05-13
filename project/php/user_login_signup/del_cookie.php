<?php
// Set the cookie with its name only
setcookie("prefLang");
// Provide past expire tine
setcookie("prefSport", '', time() - 60 * 2);