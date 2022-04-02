<?php

require 'AppController.php';

session_start();


if($_SESSION['id'] == '')
{
   return header("Location: ../index.php" );          
}

header("Location: ../View/home.php" );      


?>