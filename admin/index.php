<?php 
  session_start(); 

  require_once "../controllers/admin/admin_auth.php";
  require_once "../controllers/logout.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eazychow | Admin Dashboard</title>
</head>
<body>
  <?php require_once "../config/db_connect.php"; ?>
  <h1>Admin Homepage <?php echo $_SESSION["job_title"]; ?></h1>

  <form method="POST">
    <input type="submit" name="logout" id="logout" value="Log Out" />
  </form>

</body>
</html>