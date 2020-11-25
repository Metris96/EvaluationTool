<?php
  session_start();
  if(!isset($_SESSION['cred'])){
   if($_SERVER['REQUEST_URI'] != '/peerevaltool/login.php'){
     header('Location: login.php');
     die();
   }
 }
 ?>
   <!DOCTYPE html>
   <html>
   <head>
     <link rel="stylesheet" href="style.css">
     <title> PeerevalTool</title>
   </head>
   <body>
    <div class="nav">
   <?php
    if($_SESSION['cred'] == "admin"){
    ?>

      <a href="index.php">Home</a>
      <a href="/peerevaltool/add.php">Add new teacher</a>
      <a href="/peerevaltool/manageteacher.php">Manage teachers</a>
      <a href="/peerevaltool/logout.php">Logout</a>
     </div>
     <?php
        }
        elseif($_SESSION['cred'] == "teacher"){
        ?>
        <a href="index.php">Home</a>
        <a href="excelhandler.php">Add Excel</a>
        <a href="/peerevaltool/logout.php">Logout</a>
        <?php


        }
        ?>
        </div>
