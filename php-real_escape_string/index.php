<?php 

$mysqli = new mysqli("localhost","root","","test1");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

// Escape special characters, if any
$firstname = $mysqli -> real_escape_string($_POST['firstname']);
$lastname = $mysqli -> real_escape_string($_POST['lastname']);
 $age = $mysqli -> real_escape_string($_POST['age']);

$lastname = mysqli_real_escape_string(
    $mysqli, $lastname);
     
$firstname = mysqli_real_escape_string(
    $mysqli, $firstname);

$sql="INSERT INTO test1 (FirstName, LastName, Age) VALUES ('$firstname', '$lastname', '$age')";

if (mysqli_query($mysqli, $sql)) {
     
    // Print the number of rows inserted in
    // the table, if insertion is successful
    printf("%d row inserted.\n",
            $mysqli->affected_rows);
}
else {
     
    // Query fails because the apostrophe in
    // the string interferes with the query
    printf("An error occurred!");
}

$mysqli -> close();

/*
SQL SORGUSU ICINDE KULLANILABILECEK OZEL KARATKTERLER BIR STRING ICINDE TIRNAK ICINDE GONDERILMEYE CALISILIRSA ONU STRING OLARAK ALGILANMASINI SAGLAR YOKSA SQL ONLARI SQL KODU GIBI ALGILAYABILIYOR...CUNKU ONU SISTEME VEYA SQL SORGUSUNA BIR SIZMA GIRSIMI-SQL INJECTION TEHLIKESI OLARAK ALGILAR..... GUVENLIK ICIN KULLANILAN BIR METHODDUR
The mysqli_real_escape_string() function is an inbuilt function in PHP which is used to escape all special characters for use in an SQL query. It is used before inserting a string in a database, as it removes any special characters that may interfere with the query operations. 
When simple strings are used, there are chances that special characters like backslashes and apostrophes are included in them (especially when they are getting data directly from a form where such data is entered). These are considered to be part of the query string and interfere with its normal functioning

*/
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">

    FirstName: <br>
    <input type="text" name="firstname"> <br><br>
    LastName: <br>
    <input type="text" name="lastname"> <br><br>
    Age: <br>
    <input type="text" name="age"> <br><br>
    <button type="submit">Submit</button>
    </form>
</body>
</html>