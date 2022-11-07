<?php 
//Kulllanicidan gelecek olan username ve password ile benim databaseimde olan username ve password eger ayni ise uyusuyor ise o zaman session oturumunuj baslatiriz....

//COOOOK ONEMLI BILEMMIZ GEREKEN BIR DURUM....COK ONEMLI
//SIMDI BURDA SU MANTIGI BIR KERE ANLAYALIMMMM. ONCE BIZIM SAYFAMIZ ANA SAYFA OLAN INDEX.PHP YE GELMESI LAZIM VE INDEX.PHP YE GELINCE NE OLYOR BURDA REQUIRE ILE SETTINGS.PHP SAYFAMIZ OKUNUYOR...VE NE YAPIYOR MEMBER DIZISINI OKUYOR ARDINDAN DA BU SAYFA ICINDE CAGIRILAN TUM SAYFALARDA BIZ BU MEMBER DATALARINI ALABILECEGIZ...DIKKKAT EDELIMMMM..AMA SUNU ANLAYALIM...BIZ SAYFA YI GELIP DE INDEX.PHP YE DEGIL DE DIREK LOGIN.PHP YE GIDERSEK MEMBER DATA SINI ALAMAYIZ AMA INDEX.PHP YE GIDINCE INDEX.PHP ONCE SETTINGS.PHP YI REQUIRE EDIYOR ARRINDAN ALT TARAFTA SESSION ACILMIS MI LOGIN OLUNMUS MU ONU KONTROL EDIP EGER LOGIN OLUNMUS ISE O ZAMAN ADMIN.PHP YE YOK LOGIN OLUNMAMIS ISE O ZAMAN DA LOGIN.PHP YE GIT DIYOR ISTE BU DURUMDAS BIZ LOGIN.PHP VE ADMIN.PHP DE MEMBER DATASINI TABI KI ALABILECEGIZ AMA INDEX.PHP UZERINDEN GIDINCE ALABILIRIZ DIREK HIC INDEX.PHP YE UGRAMADAN LOGIN VE ADMINE GIDILIRSE O ZAMAN MEMBER DATASINA ERISILEMEYECEKTGIR
session_start();
require  "settings.php";
// print_r($_POST);
//Biz ayarlari bu sayfa ya cagirdigimz zaman,bu sayfa da biz admin ve logini da require veya include ettgimz icin, ayarlarin icinden gelecek olan datayi biz hem admin de hem  de login.php de kullanabiliriz..

//session lari bu sayfada kullanabilmek icin, baslatmamiz gerekiyor
//echo count($_SESSION);//Su an hic sesssion imiz yokmus onu cek etmis olduk
// $_SESSION["user_name"]="Adem";
// session_unset();
// unset($_SESSION["user_name"]);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href=""
      rel="stylesheet"
    />
    <title>Session example</title>
  </head>
  <body>

<?php 
//username var mi $_SESSION DA onu cek edelim,,eger $_SESSION da username var ise bu demektir ki
//kullanici oturum acmis ve su an login durumunda demektir.....bunu anlayalim
if(isset($_SESSION["user_name"])){
# oturum acilmis-status-login
# oturum acilmis ise o zaman artik include(admin.php) yi gosterebilirsin
include("admin.php");
}else{
# oturum acilmamis-status logout durumda o zaman oturum ac demek
# oturum acilmamis ise o zaman da login.php ile include(login.php) giris yapmaya yonlendirilsin..
include("login.php");
}

?>
    <h1></h1>
  </body>
</html>