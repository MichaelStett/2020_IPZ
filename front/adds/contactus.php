<?php

 $DB_HOST = 'localhost';
 $DB_USER = 'root';
 $DB_PASS = '';
 $DB_NAME = 'baza_projekt';
 
 try{
  $DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USER,$DB_PASS);
  $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }
 catch(PDOException $e){
  echo $e->getMessage();
 }
 if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['msg']))
 {
     $name=$_POST['name'];
     $email=$_POST['email'];
     $msg=$_POST['msg'];

    $is_insert=$DB_con->query("insert into contact(name,email,msg) values ('$name','$email','msg')");
    if($is_insert ==TRUE)
    {
        echo" email send to us ,we will get in touch with u soon";
        exit();
    }
 }
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Contact us</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    </head>
    <body>
    <div class="w3-card-4">
  <div class="w3-container w3-blue">
    <h2>Contact us </h2>
  </div>
    <form class="w3-container" method="post" action="">
    <label class="w3-text-blue"><b>First Name</b></label>
        <input  class="w3-input w3-border w3-sand" type="text" name="name" placeholder="Name">
        <label class="w3-text-blue"><b>Email address</b></label><br><br>
        <input type="email" name="email" placeholder="Email"><br><br>
        <label class="w3-text-blue"><b>your message</b></label><br><br>
        <input  class="w3-input w3-border w3-sand" type="text" name="msg" placeholder="msg">
        
        <button class="w3-btn w3-blue" type="submit">send email</button></p>
    </form>
    
<div class="container">
  <div class="center">
  <button  onclick="history.go(-1);">Back to previous page</button>
  </div>
</div>

    </body>
</html>