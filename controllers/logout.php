<?php
    function LogOut() {
      // remove all session variables
      session_unset();

      // destroy the session
      session_destroy(); 

      header("Location: ./login.php");
    }
    
    if(array_key_exists('logout',$_POST)){
      LogOut();
    }
  ?>