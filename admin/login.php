<?php require_once "../controllers/admin/admin_login.php"; ?>
<?php //require_once "../controllers/testing.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyEazychow | Admin Login</title>
</head>
<body>

  <h1>Admin Login</h1>

  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div>
      <label for="emailField" >Email: </label>
      <input type="email" id="emailField" name="email" placeholder="Enter your email" required />
    </div>
    <div>
      <label for="passowrdField">Password: </label>
      <input type="password" id="passwordField" name="password" placeholder="Enter your password" required />
    </div>
    <button type="submit">Log In</button>
  </form> 

  <!-- <form method="POST" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div>
      <label for="firstnameField" >First Name: </label>
      <input type="text" id="firstnameField" name="firstname" placeholder="Enter your firstname" required />
    </div> <?php //if (isset($firstname)) echo $_POST["firstname"]; ?>
    <div>
      <label for="lastnameField">Last Name: </label>
      <input type="text" id="lastnameField" name="lastname" placeholder="Enter your lastname" required />
    </div>
    <button type="submit" name="form2">SUBMIT</button>
  </form> 
 -->

</body>
</html>