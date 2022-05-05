<?php
    include "header.php";   
    $msg = "";   
?>
<html>
    <head><br></head>
    <body>
        <div class="Login">
            <button type="button"> 
                <h3>Please register account information.</h3>   
                <form method="post">
                    Email: <br><input type="email" name="Email"><br><br>
                    Password: <br><input type="password" name="Password">
                    <br>
                    <br> 
                    <input type="submit">
                </button>       
        </div>
    </body>
</html>
<?php
   if(isset($_POST['Password']) && isset($_POST['Email'])) 
   {
    $submittedEmail = $conn -> real_escape_string($_POST['Email']);
    $submittedPassword = $conn -> real_escape_string($_POST['Password']);
    $hashedPasswordBCRYPT= password_hash ( $_POST['Password'], PASSWORD_BCRYPT);
   }

    if(isset($submittedEmail))
    {
    //echo's information back to user
    //Inserts into database
    $sql = "INSERT INTO users (email,password)
    VALUES ('$submittedEmail','$hashedPasswordBCRYPT')";

        if ($conn->query($sql) === TRUE) 
        {
            echo "New record created successfully";
            header("url=localhost/practice/test4.php");
            $_POST = array();
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
            header("url=localhost/practice/test4.php");
            $_POST = array();
        }
    }
$conn->close();
?>