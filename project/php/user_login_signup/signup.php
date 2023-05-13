<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo</title>
    <style>
        div{
            margin:10px 10px;
        }
    </style>
</head>
<body>
<form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
    <div>

        <label for="uname">Username</label>
        <input type="text" name="uname" maxlength=50 id="uname" placeholder="Enter Your Name here.." required autofocus />
    </div>

    <div>

        <label for="email">Enter your email:</label>
        <input type="email" id="email" name="email" placeholder="Enter Your E-mail here.." required  />
    </div>

    <div>

        <label for="birth_date">Birth Date: </label>
        <input type="date" name="dob" id="birth_date" required />
        <span>We are taking your birthdate for security reason, Makesure you have enter correct birth date</span>
    
    </div>
    <div>

        <label for="pwd">Password:</label>
        <input type="password" id="pwd" name="pwd" placeholder="Enter Password" required />
    </div>
    <div>

        <label for="cpwd">Confirm Password:</label>
        <input type="password" id="cpwd" name="cpwd" placeholder="Re-enter Password" />
        
    </div>
    <div>
        <input type="reset" value="Clear" />
        <input type="submit" value="Sign-Up" />
    </div>
    <div>
        
        <a href='./index.php'>Back</a>
    </div>
</form>


<?php

require_once "config.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST["email"]) and !empty($_POST["pwd"]) and isset($_POST["email"]) and isset($_POST["pwd"])) {
        $uname = $_POST["uname"];
        $email = $_POST["email"];
        $dob = $_POST["dob"];
        $password = $_POST["pwd"];
        $cpassword = $_POST["cpwd"];
        
        $sql = "SELECT user_name , user_email,  user_password, user_dob FROM web_user_details ORDER BY user_email ASC";
        if ($result = mysqli_query($link, $sql)) {
            $flag = true;
            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {
                    if (($row['user_email'] == $email)) {

                        $flag = false;
                        header("Location:index.php?msg=Your email is already registered please login.");
                        exit();
                    }
                }

                mysqli_free_result($result);
            }
        }

        if($password == $cpassword){

            $hash = password_hash($password , PASSWORD_DEFAULT);
            $sql = "INSERT INTO web_user_details (user_name , user_email, user_password , user_dob) VALUES (?, ? ,? ,?)";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssss", $param_uname, $param_email, $param_password ,$param_dob);

                // Set parameters
                $param_uname = $uname;
                $param_email = $email;
                $param_password = $hash;
                $param_dob = $dob;

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Records created successfully. Redirect to landing page

                    header("Location:index.php?msg=Signed up successfully. you can login now.");
                    exit();
                } else {
                    echo "Something went wrong. Please try again later.";
                }
            }
    
            // Close statement
            mysqli_stmt_close($stmt);

            // Close connection
            mysqli_close($link);
        }
        else{
            echo "<h2>Enter password Is not same</h2>";
        }
}
}
?>
</body>
</html>
