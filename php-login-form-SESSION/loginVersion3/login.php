<?php
    session_start();
    include('config.php');
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = $connection->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            echo '<p class="error">Username password combination is wrong!</p>';
            //DIKKAT EDELIM BU BACKENDDEN GELEN BIR GERI DONUSUM MESAJIDIR..AMA DIREK BACKENNDEN EKRANA BASILIYOR
            //AMA BIZ BU MESAJI FRONT-ENTE GONDERELIM DE O BASSIN EKRANA DA DIYEBILIRZ O ZAMAN DA GET-RESPONSE GONDERIRIZ KI FRONT-ENDDE O MESAJA BIZ, HTML TAGLARI ARASINDA ERISIP DIREK ORDA HATA MESAJINI EKRANA BASABILMEMIZ ICIN..
        } else {
            if (password_verify($password, $result['password'])) {
                //BURASI COK ONEMLI, EGER BIZ USERNAME I SQL DE PASSWORDU DE RAM DE BU SEKILDE KULLANICYI GUVENLI BIR SEKILDE CHECK ETTI VE ONAYLADI ISEK O ZAMAN ARTIK BIZ, SESSION IMIZA KULLANICININ ID SINI GENELLIKLE ATARIZ AMA KULLANICYA EGER GIRIS YAPTIGINDA KENDI KULLANICI ADI ILE HOSGELDIN MESAJI VERMEK ISTIYOR VE ONUN BILGILERINI KULLANMAK ISTIYORSAK O ZAMAN DIGER CREDENTIALS LERDEN KULLANMAK ISTEDIKLERIMIZI SESSION A KAYDEDERIZ BUNLAR SESSION DA OLMASI SU ANLAMA GELIYOR..BU KULLANICI LOGIN OLMUS GIRIS YAPMIS DEMEKTIR
                //print_r($result);
               
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['username'] = $result['username'];
                echo '<p class="success">Congratulations, you are logged in!</p>';
                header("Location:home.php");
                exit;
            } else {
                echo '<p class="error">Username password combination is wrong!</p>';
            }
        }
    }
    //In our last step, we wrote the code for logging users in. This time, we simply check the information in the database to see if the username and password combination entered into the form is correct.

    //One important thing to note here is that we don't compare the username and password in a single step. Because the password is actually stored in a hashed form, we first need to fetch the hash with the help of the supplied username. Once we have the hash, we can use the password_verify() function to compare the password and the hash.

    //Once we've successfully confirmed the password, we set the $_SESSION['user_id'] variable to the ID of that user in the database. You can also set the value of other variables here.
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<form method="post" action="" name="signin-form">
  <div class="form-element">
    <label>Username</label>
    <input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
  </div>
  <div class="form-element">
    <label>Password</label>
    <input type="password" name="password" required />
  </div>
  <button type="submit" name="login" value="login">Log In</button>
</form>
</body>
</html>