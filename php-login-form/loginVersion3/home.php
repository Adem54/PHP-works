<!-- Restricting Access to Pages
Most websites where users are asked to register have some other pages where users access and store private data. You can use session variables to protect these pages. If the session variable isn't set, simply redirect the users to the login page. Otherwise, show them the contents of the page.

KULLANICI ADRESTEN DIREK DUSMEYE CALISIRSA BU SAYFAYA ONU HEMEN SESSION DAN KONTROL EDIP HOOOP DIYECEGIZ YOKSA...DIREK BIZIM COK KRITIK DATALARIMIZA ERSMIS OLACAKK.....


-->




<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
        exit;
    } else {
        // Show users the page
        echo "<h2>WELCOME TO THE HOMEPAGE ".$_SESSION["name"]. "</h2>";
        
    }
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
    <a href="logout.php">LOGOUT</a>
</body>
</html>