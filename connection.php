<?php 

session_start();

  $servername = "localhost";
  $username   = "root"; // username database
  $password   = ""; 	// password database
  $dbname  = "ecommerce";
  // create connection
  $conn= mysqli_connect($servername, $username, $password, $dbname);

  ?>