<?php
    define('USER', 'root');
    define('PASSWORD', '');
    define('HOST', 'localhost');
    define('DATABASE', 'test1');
    try {
        $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
    //The first step is to include config.php and start the session. This helps us store any information that we want to preserve across the pages.
    //Next, we check if the user has clicked on the Register button to submit the form by checking if $_POST['register'] has been set. Always remember that it isn't a good idea to store passwords as plain text. For this reason, we use the password_hash() function and then store that hash in our database. This particular function creates a 60-character hash using a randomly generated salt.


?>