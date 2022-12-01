


<?php 

require("db.php");
session_start(); 


if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $uname = validate($_POST['uname']);

    $pass = validate($_POST['password']);


    if (empty($uname)) {

        header("Location: index.php?error=User Name is required");

        exit();

    }else if(empty($pass)){

        header("Location: index.php?error=Password is required");

        exit();

    }else{
        $sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);
      
           
            //cook ONEMLI...NORMALDE PASWORD HASLENIP VERITABANINA KAYDEDILDI ISE ZATEN O HASH DEN NORMALE CEVRILIIP NORMAL KULLANICIDAN GELEN PASSWORD ILE KARSILASTIRILINCA CASE-SENSITIVE OLACAGI ICIN HERHANGI BIR SORUN ZATEN YASAMAYACAGIZ ANCAK VERITABANINDA DA HASHLENMEDEN KAYDEDILDI ISE O ZAMAN DA STRCMP ILE CASE-SENSITIVE STRING KARSILASTIRMASI YAPARAK, USERNAME UZERINDEN BULDUGMUZ KULLANICININ PASSSWORDUNU DE SORGULAYACAGIZ
            if(strcmp($row["password"],$_POST['password'])==0){
                echo "PASSWORD MATCHER";
            }else{
                echo "PASSOWRD DOES NOT MATCH";
            }

            /*
            print_r($row);
            {
            id: "1",
            user_name: "Adem54",
            password: "Adem123",
            name: "Adem"
            },
            */
            //USERNAME VE PASSWORD U IYICE KONTROL ETTIKTEN SONRA ARTIK GIRISINE IZIN VERIYORUZ... VE SESSION A KULLANICININ DATALARINI KAYDEDEBILIRIZ DEMEKTIR BU.....COK ONEMLI... 
            if ($row['user_name'] === $uname && $row['password'] === $pass) {

                echo "Logged in!";

                //ANLAMAMIZ GERKEN KRITIK NOKTA SU...CREDENTIALS LARI BIZ, KULLANICIYI  IYICE CHECK EDIP VERITABANIMIZDAKI VARLIGINI ISPAT ETTIKTEN SONRA, YONLENDIRECEGIMZ SAYFAYA YONLENDIRMEDEN HEMEN ONCE... SESSION ICERISINE KULLANICININ ID,USERNAME,NAME DATALARINI KAYDEDERIZ...VE ORDAN DA ANLARIZ KI BU ARTIK LOGGED IN OLMUS..... 

                $_SESSION['user_name'] = $row['user_name'];

                $_SESSION['name'] = $row['name'];

                $_SESSION['id'] = $row['id'];

                header("Location: home.php");

                exit();

            }else{
                
                header("Location: index.php?error=Incorect Userpassword");
    
                exit();
            }
            

        }else{
            
            header("Location: index.php?error=Incorect User username or password");

            exit();

        }

    }

}else{

    header("Location: index.php");

    exit();

}

?>
