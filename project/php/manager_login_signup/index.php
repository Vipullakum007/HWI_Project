<h1>Please login or Sign-up.</h1>
<form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
<input type="submit" value="Login" name="login" id="login"/>
<input type="submit" value="Sign-Up" name="signup" id="signup"/>
</form>
<a href='./forgot_password.php' >Forgot Password?</a>


<?php
if (isset($_GET['msg'])) {
    echo "<h1>{$_GET['msg']}</h1>";
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST["login"]) ) {
        header("Location:login.php");

        } else {
            header("Location:signup.php");
        }
    }
    ?>
