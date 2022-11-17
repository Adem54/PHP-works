<?php 

$db=new PDO("mysql:host=localhost;dbname=pagination","root","");

//Burda da next-previos ile sadece yonetecegiz yani her tikladigmizda sadece bir sonraki sayfa gelecek 
//tek tek 1,2,3 diye yazmaktan ziyade next-previoous olacak sadece ve bunda bir onceki kadar fazla veritabani sorgsusu da yapmiyoruz...
//BU ARADA PROBLEMLERI COZERKEN NASIL COZDDUGUMUZDE GERCEKTEN COK ONEMLDIR CUNKU VERITABANI SORGULARINI ASIRI DERECEE DE FAZLA YAPMAK COK
//DA SAGLIK LI BIR ISLEM DEGILDIR EGER IMKANIMZ VAR ISE VERITABANI SORGULARINI DAHA AZ TUTARAK ISLEMLERIMIZI YAPABILIRIZ

//BU pagination yonteminde bize neler lazim-bu ikisi bir kere bizim sql sorgusunu yapabilmemiz adina ihtiyacimz olan birsey
//1-limit-her sayfada kac data listeleyecegiz bunu belirlemeiz gerekiyor
$limit=10;
//2- start-Kactan baslayacak,baslangic
//$start=isset($_GET['start']) ? $_GET['start'] : 0; bu alttaki ile ayni seydir 
$start=isset($_GET['start']) && is_numeric($_GET['start']) && $_GET['start'] > -1 ? $_GET['start'] :0;
//Eger baslangic get te tanimlanmis ise onu alalim, yok ise 0 olsun

echo "SELECT * FROM TEST ORDER BY ID DESC LIMIT  ". $start . " , ".$limit. "<br><br><br>";

$query=$db->query("SELECT * FROM TEST ORDER BY ID DESC LIMIT  ". $start . " , ".$limit)->fetchAll(PDO::FETCH_ASSOC);
$total_data_count=$db->query("SELECT count(id) as total_count from TEST")->fetch(PDO::FETCH_ASSOC)['total_count'];
//echo     "total_Data_count: ".$total_data_count."<br>";

foreach ($query as $data) {
    echo $data['ad']."-".$data['id']."  <br>";
}


//BIR PROBLEMIMIZ DAHA VAR START=10 AR ARTINCA SORUN YOK AMA GERI GERI GIDINCE EGER START 65 YAPARSAK O ZAMAN 
//GERI GERIYE GIDINCE -5 E DUSUYOR NEDEN LIMITIMIZ 10 OLDUGU ICIN -5 E DUSUYOR CUNKU START 5 OLUYOR TAMAM START 0 IN ALTINA DUSMUYOR
//ANCAK, START 5 OLUNCA NE YAPIYOR

//BU DA GUZEL BIR COZUM ANCAK BUNUN YERINE BIR ALTTAKINI DE YAPABILIRZ...DIKKAT EDELIMM...HEADER ILE BIZ RESMEN NEXT-PREV SAYFALARI ARASINDA GEZINEBILIYOURZ......HEADER BIZI OTOMATIK OLARAK ATIYOR
if($start-$limit>0){
echo "<a href='pagination2.php?start=". ($start-$limit) ."'>Previous page</a>";
}
//echo "<a href='pagination2.php?start=". ($start-$limit) ."'>Previous page</a>";

//TAYFUN ERBILEN BOYLE BIR YAKLASIM ORTAYA KOYMUS...
// if($start % $limit !==0){
//     header("Location:pagination2.php");
// }

//Next yaparken de ne yapacagiz bir sonraki sayfanin baslangicini bulacagiz sadece o da zaten bellidir sadece mevcut baslangiciimza 
//limit i eklersek o zaman ne yapmis oluruz...bir sonraki sayfanin baslangicini bularak bir sonraki syfanin
// datlarinin gelmesini saglamis oluruz  SQL sorgumuz ile
//SELECT * FROM TEST ORDER BY ID DESC LIMIT 0 , 10  start=0 limit 10 iken(1,2,3,4,5,6,7,8,9,10)
//SELECT * FROM TEST ORDER BY ID DESC LIMIT 10(bir onceki start=0+limit(10)) , 10  start=10 iken (11,12,13,14,15,16,17,18,19,20)

//Biz en son sayfaya geldigmizde ege sonrasnda veri yok ise onu bir onceki sayfaya gonderebiliriz...

//BURDA DA BIZ EGER DATA VAR ISE NEXT BUTONUNU GOSTER  YOK ISE GOSTERME GIBI BIR LOGIC YAZDIK....
//  if($total_data_count-($start+$limit)>0)://En son sayfa
// echo "<a href='pagination2.php?start=". ($start+$limit) ."'>Next page</a>";
//  endif;

 //Eger biz yukardaki kontrolu yazmazsak o zaman nexte bastikca o surekli bir sonraki 
 //10 tane datayi cekmeye calisiyor ama data miz
 //artik kalmadigi zaman sorgu herhangi bir data getiremeyecek...data kalmadigi icin dolayisi ile bos gelecek
 // o zaman bizde sorgu nun bos gelme durumunu da 
 //kontrol ederek kullaniciyi baska bir sayfaya yonlendirebiliriz
if(!$query){
    header("Location:pagination2.php?start=".($start-$limit). "&lastpage=1");
    //burdaki &lastpage=1 i sadece en son sayfada oldugu zaman url de get icerisinde gozuksun ve biz burasiinin artik son sayfa oldugnu
    //anlayalim kontrol edebilelim diye yapiyoriz boyle birseyi
    //start 110 olup da $query bos gelince o tekrardan bir onceki sayfanin 
    //datasinin gelmesi icin mevcut $starttan $limiti cikariyor ve o sekilde bir sorgu gonderiyor
}
if(!isset($_GET['lastpage'])){
    echo "<a href='pagination2.php?start=". ($start+$limit) ."'>Next page</a>";
}


//BIZ GET[] METHODU ILE DATA YI DINAMIK GONDERME YANI SAYFA YONLENDIRME ISLEMLERINI 
//HEADER("LOCATION:") ILE OTOMATIK BIR SEKILDE AYNI REACT IN NAVIGATE() INI YAPTIGI ISE YANI KULLANICI BIRSEYE TIKLAMMASINA GEREK YOK
//SADECE KENDISI OTOMATIK SAYFA YONLENDIRSIN DIYE KULLANDIGIMZ BIR SEY BU
//AMA MESELA KULLANICININ TIKLAMASINA BAGLI OLARAK GET[""] METHODU ILE URL DE DATA GONDERIP ONA GORE SAYFALAR ARASI HEM GECIS
//HEM DE KULLANICININ TIKLAMASI ILE DINAMIK LIK KAZANDIRMAK ISTEDIGIMZ SISTEMLERI BU SEKILDE YONETEBILIYORUZ....HARIKA BIR BESTPRACTISE..
//KULLANICI BIR BUTONA TIKLIOR BIZI M  <a href de></a> yazdigmiz ve dinamik bir sekilde kullanici tiklior biz de kullanicinn tikladigi degeri alip
//onun istemis oldugu datalari gonderiyouruz ona...

//BESTPRACTISE..----COOOOK ONEMLI....BU ONEMLI BIR YONTEM.......BUNUNLA COK KARSILASMAMISTIM DAHA ONCE
//Biz dikkat edelim...kullnacimiz next dedikten sonra eger datamiz bitmis ve bir sonraki sayfada data  yok ise ne yaptik biz,
//kullaniciyi yine en son sayfaya yonlendirdik header ile, ve biz birde header icinde location ile lastpage=1 ekleyerek
//burda kullanicinin sayfa sonuna geldigni bizim de anlayabilecegimiz bir isaret koyduk ve artik biz kendimize alan actik 
//biz artik GET['lastpage'] ile kontrol de yababiliriz kullanici o sayfya gelmis demekki...
//ISTE BU BIZE BIR TUYO EGER BIZ KULLANCIININ SPESIFIK OLARAK BAZI GIRDIGI SAYFALARI BELIRLI EDIP SONRA DAN TEKRAR KONTROL ETMEK ISTERSSEK
//BU SEKILDE BIR YOOL IZLEYEREK KENDIMIZE ALAN ACABILIRIZ....BESTPRACTISE...COK KRITIK DURUMLARDA COK EFFEKTIF COZUMLER URETEBILIRIZ
/*
COOOK ONEMLI..
if(!$query){
    header("Location:pagination2.php?start=".($start-$limit). "&lastpage=1");
    burdaki &lastpage=1 i sadece en son sayfada oldugu zaman url de get icerisinde gozuksun ve biz burasiinin artik son sayfa oldugnu
    anlayalim kontrol edebilelim diye yapiyoriz boyle birseyi
    start 110 olup da $query bos gelince o tekrardan bir onceki sayfanin 
    datasinin gelmesi icin mevcut $starttan $limiti cikariyor ve o sekilde bir sorgu gonderiyor
}
if(!isset($_GET['lastpage'])){
    echo "<a href='pagination2.php?start=". ($start+$limit) ."'>Next page</a>";
}

*/
?>