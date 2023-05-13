<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        div{
            margin:10px;
        }
    </style>
</head>
<body>
<form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">

    <div>

        <label for="email">Enter your email:</label>
        <input type="email" id="email" name="email" />
    </div>
    <div>

        <label for="pwd">Password:</label>
        <input type="password" id="pwd" name="pwd" />
    </div>
    <div>
        <input type="submit" value="Login" />
        <input type="reset" value="Clear" />
    </div>
    <div><a href='./index.php'>Back</a></div>
</form>

<div><a href='./forgot_password.php'>Forgot Password?</a></div>

<?php
// Include config file
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST["email"]) and !empty($_POST["pwd"]) and isset($_POST["email"]) and isset($_POST["pwd"])) {
        $email = $_POST["email"];
        $password = $_POST["pwd"];


        $sql = "SELECT user_name, user_email, user_password FROM web_user_details ORDER BY user_email ASC";
        if ($result = mysqli_query($link, $sql)) {
            $flag = true;
            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {
                    if (($row['user_email'] == $email) and password_verify( $password , $row['user_password'])) {
                        $flag = false;
                        session_start();
                        $uname = $row['user_name'];
                        $_SESSION['email'] = $email;
                        $_SESSION['uname'] = $uname;
                        $parts = explode("@", $email); //for removing part after the @ sign from email
                        $param = urlencode(base64_encode($parts[0]));
                        header("Location:home.php?uname=$uname");
                    }
                }

                mysqli_free_result($result);
            }
            if ($flag) {

                header("Location:index.php?msg=Your record is not found.<br/>Please check your password and email.");
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    } else {
        echo "<h1>Please enter details.</h1>";
    }
} else {
    echo "<h1>Please enter details.</h1>";
}

mysqli_close($link);
?>
</body>
</html>


