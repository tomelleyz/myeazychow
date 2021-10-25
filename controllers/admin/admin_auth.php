<?php
  // Check if user is an authorised admin, if not then redirect to admin login page
  if (!isset($_SESSION["logged_in"]) && !isset($_SESSION["is_admin"])) {
    header("Location: ../admin/login.php");
    exit;
  }
?>