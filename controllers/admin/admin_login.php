<?php
  // Initialize the session
  session_start();

  // Check if user is already logged in, if yes then redirect to admin index page
  if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true && isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] === true) {
    header("Location: ../admin/index.php");
    exit;
  }

  // Import db connection file
  require_once "../config/db_connect.php";

  // Initialize form data with empty values
  $submitted_email = "";
  $submitted_password = "";

  // Process form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted_email = trim($_POST["email"]);
    $submitted_password = trim($_POST["password"]);

    $sql = "SELECT firstname, lastname, email, job_title FROM employee 
    WHERE emp_id=1 AND email='" . $submitted_email . "' AND emp_password='" . $submitted_password . "'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      $admin_record = mysqli_fetch_assoc($result);

      // Set session variables
      $_SESSION["logged_in"] = true;
      $_SESSION["is_admin"] = true;
      $_SESSION["firstname"] = $admin_record["firstname"];
      $_SESSION["lastname"] = $admin_record["lastname"];
      $_SESSION["email"] = $admin_record["email"];
      $_SESSION["job_title"] = $admin_record["job_title"];

      // Redirect to admin home page after successful login
      header('Location: ../admin/index.php');
      exit;
    } else {
      echo "<h1>Invalid login credentials</h1>";
    }
  }

?>