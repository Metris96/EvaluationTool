
   <!DOCTYPE html>
   <html>
   <head>
     <title> PeerevalTool</title>
   </head>
   <body>
     <div>

     </div>
     <?php
       session_start();
       if(!isset($_SESSION['cred'])){
        if($_SERVER['REQUEST_URI'] != '/peerevaltool/login.php'){
          header('Location: login.php');
          die();
        }
       }
       else{

       }
      ?>
