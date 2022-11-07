<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href=""
      rel="stylesheet"
    />
    <title></title>
  </head>
  <body>
    <?php 
session_start();//Burasi indexe baglli olmadigi icin...session tekrar baslatriz
//Bir sesssion i baslatmadan sonlandiramayiz bunu unutmayalim biz index.php de baslattik ama, logout.php nin index.php ile hic bir bagi yok ondan dolayi sessin in index.php de baslatilmasini logout.php bilemez...
    //Burda cikis yapildigi icin sesson kapatilip icindeki tum datalar silinmelidir
    session_unset();//Oturumu sonlandirip sonra da index.php ye yonlendirelim
    ?>
    <h1>You logged out!</h1>
    <?php  header("location:index.php"); ?>
  </body>
</html>