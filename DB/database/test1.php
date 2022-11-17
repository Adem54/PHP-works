<?php 

$server_name="localhost";
$user_name="admin";
$password="admin1499";

//Try-catch icerisinde yapariz database baglanti islemini

try {
  $connection=new PDO("mysql:host$");
} catch (\Throwable $th) {
    //throw $th;
}


?>