<?php
require_once('connect.php');

if(isset($_POST['pwdrst'])) {
  $email = $_POST['email']; // Change this to $username
  $password = $_POST['password'];
  $cpwd = $_POST['cpwd'];

  if($password == $cpwd) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Change the query to use username instead of email
    $reset_password = mysqli_query($conn, "UPDATE `users` SET password='$hashedPassword' WHERE username='$email'"); // Change email to username

    if($reset_password) {
      $msg = 'Your password has been updated successfully. <a href="login.php">Click here</a> to login.';
    } else {
      $msg = "Error while updating password.";
    }
  } else {
    $msg = "Password and Confirm Password do not match";
  }
}

if(isset($_GET['secret'])) {
  $username = base64_decode($_GET['secret']); // Change email to username
  $check_details = mysqli_query($conn, "SELECT username FROM `users` WHERE username='$username'"); // Change email to username
  $res = mysqli_num_rows($check_details);
  
  if($res > 0) { 
?>
<body>
<div class="container">  
    <div class="table-responsive">  
    <h3 align="center">Reset Password</h3><br/>
    <div class="box">
     <form id="validate_form" method="post" >  
      <!-- Change this input type to hidden -->
      <input type="hidden" name="email" value="<?php echo $username; ?>"/>
      <div class="form-group">
       <label for="password">Password</label>
       <input type="password" name="password" id="password" placeholder="Enter Password" required 
       data-parsley-type="password" data-parsley-trigger="keyup" class="form-control"/>
      </div>
      <div class="form-group">
       <label for="cpwd">Confirm Password</label>
       <input type="password" name="cpwd" id="cpwd" placeholder="Enter Confirm Password" required data-parsley-type="cpwd" data-parsley-trigger="keyup" class="form-control"/>
      </div>
      <div class="form-group">
       <input type="submit" id="login" name="pwdrst" value="Reset Password" class="btn btn-success" />
       </div>
       
       <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
     </form>
     </div>
   </div>  
  </div>
<?php } } ?>
</body>
</html>
