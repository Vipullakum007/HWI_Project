<?php
foreach ($_COOKIE as $key => $val) {
    print $key . " = " . $val . "<br/>";
}

if (isset($_COOKIE['prefLang'])) {
    echo "Your preferred language is {$_COOKIE['prefLang']}! <br/>";
} else {
    echo "You have got some stale cookies! Don't bite. <br/>";
}

if (isset($_COOKIE['prefSport'])) {
    echo "Your preferred sport is {$_COOKIE['prefSport']}! <br/>";
} else {
    echo "You have got some stale cookies! Don't bite. <br/>";
}