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

        <label for="name">Name</label>
        <input type="text" name="name" maxlength=50 id="name" placeholder="Enter Your Name here.." required autofocus />
    </div>

    <div>

        <label for="email">Enter your email:</label>
        <input type="email" id="email" name="email" placeholder="Enter Your E-mail here.." required  />
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
</body>
</html>
<?php

require_once "config.php";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST["email"]) and !empty($_POST["pwd"]) and isset($_POST["email"]) and isset($_POST["pwd"])) {
        $uname = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["pwd"];
        $cpassword = $_POST["cpwd"];
        
        $sql = "SELECT manager_name , manager_email,  manager_password FROM manager_details ORDER BY manager_email ASC";
        if ($result = mysqli_query($link, $sql)) {
            $flag = true;
            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {
                    if (($row['manager_email'] == $email)) {

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
            $sql = "INSERT INTO manager_details (manager_code ,manager_name , manager_email, manager_password ) VALUES (?, ? ,? ,? )";

            if ($stmt = mysqli_prepare($link, $sql)) {
                //generate manager code
                $code = mt_rand(1001,9999);

                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "isss", $param_code,$param_uname, $param_email, $param_password );

                // Set parameters
                $param_uname = $uname;
                $param_email = $email;
                $param_password = $hash;
                $param_code = $code;

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Records created successfully. Redirect to landing page

                    header("Location:index.php?msg=Your private code is $code. Makesure to remember this code");
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