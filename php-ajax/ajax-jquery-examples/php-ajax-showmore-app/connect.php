<?php 

try {
$db=new PDO("mysql:host=localhost;dbname=loadmore;port=3306","root","");
    
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>