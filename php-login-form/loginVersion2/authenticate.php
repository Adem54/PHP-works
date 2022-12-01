<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'mytestdb';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}


// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, password FROM users WHERE user_name = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
    $result = $stmt->get_result();
	// Store the result so we can check if the account exists in the database.
	// $stmt->store_result();
    if ($result->num_rows > 0) {    
        $row = $result->fetch_assoc();
        $pswFromDb= $row["password"];
       
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        //BESTPRACTISE OLMASI GEREKEN KONTROL BU ASLINDA...BUNU YAPMALIYIZ PROFESYONEL HAYATTA
      //  if (password_verify($_POST['password'], $password)) { //NORMALDE OLMASI GERKEEN BU AMA BIZ TEST ICIN DATAYI VERITABANINA HASHLEMEDEN KAYDETTIK ONDAN DOLAYI BUNU  YAPAMAYACAGIZ
            // Verification success! User has logged-in!
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
           //bIR ALTRNATIF DAHA DUSUNECEK OLURSAK PASSWORDU NASIL CHECK EDERIZ DIYE
           //if ($_POST['password'] === $password) { 
          if( strcmp($pswFromDb,$_POST['password'])==0  ) { 
            echo "WELCOME HACI ABI";
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] =$row["id"] ;
            header('Location: home.php');
           
        } else {
            // Incorrect password
            echo 'Incorrect username and/or password!';
        }
    } else {
        // Incorrect username
        echo 'Incorrect username and/or password!';
    }



	$stmt->close();
}

?>