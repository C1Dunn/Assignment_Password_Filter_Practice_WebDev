<!-- This file allows users to log into the website -->
<?php
  include "header.php";
?>
<html>
  <head><br></head>
  <body>
    <div class="Login">
      <button type="button"> 
      <h3>Please enter login information</h3>
        <form method="post">
          Email: 
            <br>
              <input type="email" name="Email">
            <br>
            <br>
          Password: 
            <br>
              <input type="password" name="Password">
            <br>
            <br>
          <input type="submit">
        </form>
    </div>
  </body>
</html>
<?php
    if(isset($_POST['Password']) && isset($_POST['Email'])) 
    {
        $submittedEmail = $conn -> real_escape_string($_POST['Email']);
        $submittedPassword = $conn -> real_escape_string($_POST['Password']);
        $hashedPassword= password_hash ( $submittedPassword, PASSWORD_BCRYPT);
        $auth = password_verify($submittedPassword,$hashedPassword);
    }
  if(isset($submittedEmail))
    {
      $sql = "SELECT Email, Password FROM users WHERE Email='$submittedEmail'";
        $result = $conn->query($sql);
          if ($result->num_rows > 0) 
          {
            while($row = $result->fetch_assoc()) 
            {
              if ($auth == $hashedPassword) 
              {
                echo "Password match <br>";
                $_POST = array();
              } 
              else 
              {
                echo "Password invalid <br>";
                $_POST = array();
              }
            }
          } 
          else 
          {
            echo "Account not found! <br>";
            $_POST = array();
          }
    }
  $conn->close();
?>