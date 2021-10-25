<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["form2"])) {
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);

    echo "<h3>Firstname: " . $firstname . "</h3>";
    echo "<h3>Lastname: " . $lastname . "</h3>";
  }
?>