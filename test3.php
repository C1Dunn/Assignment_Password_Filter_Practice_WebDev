<?php
include "header.php";

$msgB="";
$msgS="";
$msgM="";
?>
<html>
<head><br></head>
<body>
<div class = "Login">
<button type="button"> 
  <h3>Check Password Strength </h3>
  <form method="POST">
  Password: <br><input type="password" name="password" required />
    <br><br>
    <input type="submit" value="Check" /><br />
  </form>
  </button>
  </div>
</body>
</html>
<?php
if(isset($_POST['password'])) 
{
          $str = $_POST['password'];
          $hashedPasswordBCRYPT = password_hash ($str, PASSWORD_BCRYPT);
          $hashedPasswordSHA1 = sha1($str);
          $hashedPasswordMD5 = md5($str);

            $number = preg_match('@[0-9]@', $str);
            $uppercase = preg_match('@[A-Z]@', $str);
            $lowercase = preg_match('@[a-z]@', $str);
            $specialChars = preg_match('@[^\w]@', $str);
            $msgInsecure = "";
  if(strlen($str) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) 
  {
    $msgInsecure = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
    ?>
      <html>
      <span><?php echo htmlspecialchars($msgInsecure, ENT_QUOTES, 'UTF-8')?></span><br>
      </html>
    <?php
  } 
  else 
  {
    $msg = "Your password is strong.";
    $msgB = $hashedPasswordBCRYPT." \r\n is the hashed plaintext of '".$str."' in BCRYPT\r\n";
          $msgS =  $hashedPasswordSHA1." \r\n is the hashed plaintext of '".$str."' in SHA1\r\n"; 
          $msgM =  $hashedPasswordMD5." \r\n is the hashed plaintext of '".$str."' in MD5\r\n";
          ?> 
          <html>
            <span><?php echo htmlspecialchars($msgB, ENT_QUOTES, 'UTF-8')?></span><br>
            <span><?php echo htmlspecialchars($msgS, ENT_QUOTES, 'UTF-8')?></span><br>
            <span><?php echo htmlspecialchars($msgM, ENT_QUOTES, 'UTF-8')?></span><br>
          </html>
          <?php
  }
}
?>
