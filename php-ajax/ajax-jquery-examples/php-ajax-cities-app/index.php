<?php 
/*
Bir veritabani olusturduk ve orda flyke ve kommune tablosu var flykenavn-flyke no ve kommunenavn, flykeno kolonlarini olustrudk
Amacimiz su, biz bir flyke sectgimgz zaman sayfa yenilenmeden o flykeye ait kommuneleri sayfada gosterebilmek

*/
//database-connection and operations
require_once("db.php");

//flyker cekmemiz gerekiyor
$query=$db->query("SELECT * FROM flyker ORDER BY flykesnummer ASC")->fetchAll(PDO::FETCH_ASSOC);

//kullanici hangi flyke yi secer ise biz o flyke yi yakalamamiz gerekiyor ve o flyke ile ilgili bilgieri, yani flykenummer, ve flykenavn i kullanarak o flykeye ait kommunelerei kommune tablosundan cekecegiz
//$kommune_query=$db->


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--jquery.com dan jquery nin son surumunu tiklayip acilan sayfadan linki kopyalayip buraya alip kullaniriz -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <!--app.js de javascript kodlarini calistirmak icindir -->
    <script src="app.js"></script>

    <title>Document</title>
</head>
<body>

    <ul>
   
        <li>
            <h3>
                Flyke:
            </h3>
       
            <select name="flyke" id="flyke" >
          <option value="">--Velg et flyke--</option>
          <?php 
    foreach ($query as  $flyke): ?>           
      <option value="<?php echo $flyke["flykesnummer"]; ?>"><?php echo $flyke["flyke_navn"] ?></option>
    <?php endforeach;?>
            </select>
        </li>
       <hr>
       <li>
            <h3>
                Kommune:
            </h3>
            <!--ilk etapta kommune disabled olacak ama biz ne zaman flyke secer ve arka planda flyke kodunu gonderirsek o zaman burda o flykeye ait kommuneleri burda disable i kaldirip yazdiracagiz -->
            <select name="kommune" id="kommune" disabled>
      
            </select>
        </li>
     <br>
  
    </ul>

<script>

/*
Bizim front-end de jscript veya react taki mantgimiz her zaman kullancinin girdigi degeri disardan almak ve onu kullaniciya dinamik bir sekilde yansitmak, yani kendi tuttugmuz degiskenler uzerinden arkada kullanicinin her yaptgi hareketi anlik olarak almak ve kullaniciya dinamik bir sekilde yansitacak bir sistemi kurmak..
*/
</script>

</body>
</html>