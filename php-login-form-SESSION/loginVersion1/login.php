
<?php 

//DIKKAT EDELIM...VERITABANI ISLEMIN YAPAN DB.PHP YI EN USTTE REQUIRE ETTIMIGIZ ICIN ONCE BURAYA BAKIYOR...BURAYI CHECK EDIYOR.. 

require("db.php");
session_start(); 

//fORM GONDERILMIS MI DATALAR GELMIS MI O CHECK EDILIR
if (isset($_POST['uname']) && isset($_POST['password'])) {

    //Datalar gelmis ise o zaman back-end validation yapilir
    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data,ENT_QUOTES);

       return $data;

    }

    $uname = validate($_POST['uname']);

    $pass = validate($_POST['password']);

//back-end validation yapildiktan sonra kullanici eger bos bos space e basip data gondermis ise biz onu da trim ile kaldirdimgiz icin simdi artik bos olarak gonderilen alan var mi onu da check ederiz ve artik kullaniciya error mesajini burda get methodu ile gonderiyoruz..

    if (empty($uname)) {

        header("Location: index.php?error=User Name is required");

        exit();

    }else if(empty($pass)){

        header("Location: index.php?error=Password is required");

        exit();

    }else{//Alanalar dolu olarak gelmis ise artik o zaman veritabanindaki data ile karsilastirarak, username ve passwordu check edebiliriz

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
                //Kullanici giris islemini basari ile gerceklestirirse de kullanicinn datalari session a kaydedilir ve kullanici artik admin veya home page e yonlendirilebilir...girisine izin verilir

                exit();

            }else{
                //echo "Incorect Userpassword";
                //FRONT-ENDE GONDERIYOR DATAYI AL SEN BUNU KULLAN DIYE EGER DIREK ECHO ILE  YAZDIRSA IDI O ZAMAN DIREK EKRANA BACKENDDEN PHP MARIFETI ILE BASACAKTI VE ONU BIZ KULLANAMAYIZ...FRONT-ENDDEKI HTML LERIMIZ ICERISINDE BU FARKI ANLAMAK COK ONEMLI BIZIM FRONT-ENDDE KULLANABILMEMIZ ICIN ONU GET VEYA POST YONTEMI ILE GONDERMEMIZ GEREKIR KI EGER GONDERILEN DATA PASSWORD BIBI HASSAS BILGILER DEGIL ISE DE GET METHODU  KULLANIRIZ
                header("Location: index.php?error=Incorect Userpassword");
                //HATA DATA SINI DATALARI GONDERDIGMZ FORM DA HATA MESAJINI BASARKEN EGER HEM FORM HEM DE DATA NIN ALINDIGI SAYFA AYNI SAYFA ISE KI BURDA FARKLI SAYFALAR O ZAMAN ECHO ILE DE BIZ HATA MESAJINI BIR DEGISKENE ATAYIP O DEGISKENI YINE FORM ICINDE KULLANABILIRDIK ANCAK...FARKLI SAYFALARDA YI Z VE BIZ HATA MESAJINI GET ILE GONDERMEYI TERCIH ETTIK CUNKU SAYFA YONLENDIRMESI DE YAPIYORUZ AYNI ZAMANDA...
    
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
