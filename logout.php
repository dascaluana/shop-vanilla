<?php
   include ('common.php');

   if(session_destroy()) {
       header("Location: login.php");
   }