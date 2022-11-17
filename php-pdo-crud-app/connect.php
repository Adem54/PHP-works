<?php 
//PDO INBUILD CLASS FOR DATABASE CONNECTION AND CRUDS


try {
$db=new PDO("mysql:host=localhost;dbname=testdb","root","");
} catch (PDOException $ex) {
    echo $ex->getMessage();//We will get error if there is any problem about connection to database
}
//Eger yanlis bir database veya herhangi bir baglanti sorunu olursa zaten localhostta ekranda hata alacagiz
?>