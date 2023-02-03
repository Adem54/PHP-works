<?php 

$host= "localhost";

$unmae= "root";

$password = "";

$db_name = "mytestdb";

$conn = mysqli_connect($host, $unmae, $password, $db_name);

if (!$conn) {

    echo "Connection failed!";

}

?>