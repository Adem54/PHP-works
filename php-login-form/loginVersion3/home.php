<!-- Restricting Access to Pages
Most websites where users are asked to register have some other pages where users access and store private data. You can use session variables to protect these pages. If the session variable isn't set, simply redirect the users to the login page. Otherwise, show them the contents of the page. -->


<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
        exit;
    } else {
        // Show users the page
        echo "WELCOME TO THE HOMEPAGE";
    }
?>