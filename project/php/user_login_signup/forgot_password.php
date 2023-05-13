<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot_password</title>
    <style>
        div{
            margin: 10px;
        }
    </style>
</head>
<body>
<form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
    <div>

        <label for="email">Enter your email:</label>
        <input type="email" id="email" name="email" required/>
    </div>    
    <div>

        <label for="birth_date">Enter your DOB:</label>
        <input type="date" id="birth_date" name="dob" required/>
        <span>We are taking your birthdate for security reason, Makesure you have enter correct birth date</span>
    </div>    
    <div>

        <label for="pwd">New Password:</label>
        <input type="password" id="pwd" name="pwd" required/>
    </div>
    <div>

        <label for="cpwd">Confirm Password:</label>
        <input type="password" id="cpwd" name="cpwd" placeholder="Re-enter Password" />
        
    </div>
    <div>

        <input type="submit" value="Confirm" />
        <input type="reset" value="Clear" />
    </div>
    
    <div>
        <a href='./index.php'>Back</a>
    </div>
</form>


<?php

require_once "config.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST["email"]) and !empty($_POST["pwd"]) and !empty($_POST["dob"]) and !empty($_POST["cpwd"]) ) {
        $email = $_POST["email"];
        $password = $_POST["pwd"];
        $dob = $_POST["dob"];
        $cpassword = $_POST["cpwd"];

        $sql = "SELECT user_email , user_dob from  web_user_details  ORDER BY user_email ASC";

        if ($result = mysqli_query($link, $sql)) {
            $flag = true;
            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {
                    if (($row['user_email'] == $email) and ($row['user_dob'] == $dob) ) {

                        $flag = false;
                        if($password == $cpassword){
                            $hash = password_hash($password , PASSWORD_DEFAULT);
                            $sql = "UPDATE web_user_details SET user_password=? WHERE user_email=?";

                            if ($stmt = mysqli_prepare($link, $sql)) {
                                // Bind variables to the prepared statement as parameters
                                mysqli_stmt_bind_param($stmt, "ss", $hash, $email);

                                // Attempt to execute the prepared statement
                                if (mysqli_stmt_execute($stmt)) {
                                    // Records updated successfully. Redirect to landing page
                                    header("location: index.php?msg=Your password updated successfully.");
                                    exit();
                                } else {
                                    echo "Something went wrong. Please try again later.";
                                }
                            }
                        }
                        else{
                            echo "<h2>Entered Password Is not same </h2>";
                        }
                        // header("Location:index.php?msg=Your email is already registered please login.");
                        exit();
                    }
                    else{
                        echo "<h2> Your Record Is Not Found </h2>";
                    }
                }

                mysqli_free_result($result);
            }
        }
        // Close statement
        // mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($link);
    } else {
        echo "Pleae fillout required fields.";
    }
}
?>
</body>
</html>
