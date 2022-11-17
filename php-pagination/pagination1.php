<?php 

//VERITABANIMIZA BAGLANALIIMMM

$db=new PDO("mysql:host=localhost;dbname=pagination","root","");


// $total_data;
echo "<hr>";


//http://localhost/test/php-pagination/pagination1.php?page=5  biz url de sadece uzerinde olunan aktif page
//uzerinden dinamiklik sagladik....burda mantaliiteyi tam olarak anlayalim...
//BU ARADA SORGULARIMZDA HER ZAMAN ORDER BY DESC  YAPMAMIZ GEREKIYOR EN SON EKLENEN EN BASTA GOZUKMESI GEREKIR HER ZAMAN
//CUNKU KULLANICIYA HER ZAMAN EN GUNCEL DATA SUNULUR....BU COOOK ONEMLIDIR UNUTMAYALIM

//Pagination
//Pagination icin ihtiyacimiz olan parametreler
//PAGINATION YAPARKEN KULLANACAGIMIZ BELLI PARAMETRELER VARDIR
//DAHA DOGRUSU BILMEMIZ GEREKEN BELLI PARAMETRELER VAR DATALAR VARDIR
//1-LIMIT(SAYFA ICERISINDE KAC DATA GOZUKECE-5 ER MI, 10 AR MI)
$limit=5;

//2-sayfa sayisini  almamiz gerekiyor,kacinci sayfada oldugumuzu bilebilmemiz gerekiyor
//Bunu bir get parametresi olarak alacagiz ornegin index?page=2 yani 2 sayfada oldugnu anlamis olacagiz
//Dinamik olacak ve kacinci sayfaya kullanici tiklamis ise o sayfa Get parametresi olarak gelecek 

//Eger get parametresinde page diye bir degerim var ve bu deger bir sayi ise bu benim get parametreme esit olsun
//degil ise o zaman da default olarak 1 olsun diyoruz..Yani oraya gelip birisi string birsey girerse sayfa 1 de kalsin veya 1 e gelsin
//yok oraya numara yazilmis ise string bir numarada olabilir...o zaman o sayfayi getirecek bize
//is_numeric- 1,0,"32" hepsti true gelir string number veya integer number farketmez onemli olan bir sekilde number olmasidir
//32.5 da da true gelir
//Default olarak sayfaya ilk girdigmizde page=1 olacak
//DINAMIK OLARAK SU AN UZERINDE OLDUGMUZ AKTIF SAYFAYI TEMSIL EDEN $PAGE DEGISKENIMIZI
//BU SEKILDE SINIRLANDIRARAK KONTROL ALTINDA TUTACAGIZ...
$page=isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1 ;
$page=$page<=0 ? 1 : $page;//Sayfa 0 ve 0 dan kucuk verilirse de sayfayi yine 1 yapalim
//Belki burda bir kontrol daha yapilip sayfa ornegin en son total sayfa sayisinden buyuk oldugu anda da
//otomatik olarak en son sayfada kalsin diyerek de sayfamizi bizim total sayfa sinirlarimizda tutabilmis oluruz
// $page=$page>$total_page_count ? $total_data_count :$page;
// echo $page;
//Kullanici url de page=dafasdfdsa girerse 1 gelecek page ama page=4 girerse 4 gelecek page

//3.Sayfalandirma isleminde 3.ihityacimz olan data ise toplam veri..yani total veri sayisi kac adet
//Bunu veri tabanindan kac tane ise alacagiz..Veritabanindan total data sayisini, max,min vs gibi methodlar ile bu degerleri ve 
//daha fazlasini sql kullanarak yapabiliyoruz
$total_data_count=$db->query("SELECT count(id) as total_record FROM TEST")->fetch(PDO::FETCH_ASSOC)['total_record'];
//$total_data_count= $total_data['total_record'];// veritabanindan direk total kac data var alabilirz..bu sekilde
//echo "total_data_count: ".$total_data_count. "</br>";
/*
Pagination da ihtiyacimz olan 3 data
1-sayfa basi kac data olacak...data limi for per page
2-page - kacinci sayfada oldugmz...
3.Toplam kac tane verimiz var...
4.Toplam sayfa sayisi(Toplam veir adedi / limit)
Toplam verimiz 50
limit:5 ise sayfa basi 5 adet data koyacaksak o zaman kac sayfa miz olacak 
demekki 10 sayfadan olusan bir
sayfalandirma yapacagz

*/
//ceil() methodu ile kusuratli sonuclari bir uste aktariyor
$total_page_count=ceil($total_data_count / $limit);

//Ancak burda $total_data_count umuz eger tam 50 olmaz da 51,52 olur ise kusuratli bir sonuc cikacagi icin biz
//COOK ONEMLI BU..KUSURATLI SAYILARI HERZAMAN USTE YUVARLAMALIYIZ PAGINATION DA
//ceil fonksiyonu ile bunu uste yuvarlayacagiz ki , ornegin 52 data var ise 10.4 ten 11 e yuvarlasin ki
//5 er sayfadan 10 sayfamiz olsun, 1 tane daha icinde 2 tane data olan sayfamiz olmus olur..bu cok onemlidir
//echo $total_page_count;//10

//BIR SQL SORGUSU YAPARKEN, ISLEMLER SU SEKILDE ILERLIYOR
//SELECT * FROM `test` ORDER BY ID LIMIT 0, 10; //0 DAN SONRA BASLA 1 ILE BASLA 10 TANE DATA GETIR DEMEKTIR
//HANGI ARADA YAZDIRACAKSAK BU SEKILDE ISLEM YAPARIZ

//PAGINATION DA DA BIZIM HAZIRLAYACAGIMZ SQL SORGUSUNDA BIR DINAMIKLIK OLACAK VE ORNEGIN BIR SAYI OLACAK BASLANGIC
//DIGERI NE OLACAK $limit degiskenimiz olacak...+$limit degiskenimiz olacak her zaman
//SQL ICINDEKI LIMIT SAYILARI DA START-END OLACAK SEKILDE GELECEKTIR AMA SUNA DIKKAT EDELIM
//SELECT * FROM TEST LIMIT 5 , 5;// BU SU DEMKTIR SEN 5 TEN SONRA BASLA YANI 6 DAN ITIBAREN BASLA, 5 TANE DATA AL DEMEKTIR
//YANI  LIMIT 5,5 DEMEK 6,7,8,9,10 UNCU DATALARI GETIR DEMEKTIR...
//LIMIT 10,5  11,12,13,14,15 DEMEKTIR
//BASLANGICINI BULURUZ YANI BIZIM ICIN BASLANGIC DINAMIK OLARAK PAGE*LIMIT-LIMIT DEMEKTIR...
//DOLAYISI ILE BASLANGIC RAKAMI HER ZAMAN NE OLUYOR LIMIT ORNGIN BIZ 3.SAYFADA ISEK O ZAMAN LIMIT 10,5 DIR 
//VE 11,12,13,14,15 DIR.... BASLANGIC:10 DUR O DA 3.SAYFA*LIMIT(15)=15-LIMIT(5)=10=>BASLANGIC SAYIMIZDIR
$start=($page*$limit)-$limit;//ornegin page:1 de 0-5 olacak - SELECT * FROM `test`  LIMIT 0 ,5;//1,2,3,4,5. DATALARI GETIRIYOR
//SUNA DIKKAT EDELIM START-BASLANGIC NEYE GORE TABI KI SQL DEKI LIMIT OPERASYONUNDAKI MANTIGA GORE BU BASLGNICI ALIYORUZ
//KENDI KAFAMIZA GORE YAPAMAYIZ ZATEN
//BURDA LIMITIMIZ ZATEN BELLI-5, BASLANGICIMZ SAYFA MIZIN KACINCI SAYFA OLDUGNA GORE GET METHODU ILE URL DEN GONDERILEN SAYIYA GORE
//DEGISECEK OLAN DINAMIK BIR SAYI OLACAK
//echo "</br>".$start;//BASLANGICI DINAMIK OLARAK ALIYORUZ

$query=$db->query("SELECT * FROM TEST ORDER BY ID ASC LIMIT " .$start. " ," . $limit)->fetchAll(PDO::FETCH_ASSOC);
//SELECT * FROM TEST ORDER BY ID DESC LIMIT 30 ,5  burda page=7 idi

foreach ($query as $data) {
    echo $data['ad']." - ".$data['id']. "</br>";
}
//sayfalamamizi tersten yani id ye gore buyukten kucuge dogru yaparsak ve de page e get methodu ile url de page=1 verilirse
//ekranda nasil bir durum olusuyor- 134,133,132,131,130 OLUR NEDEN CUNKU EN BUYUK ID 134 OLDUGU ICIN 134 TEN BASLAYACAK DOGAL OLARAK VE 
//ORDAN GERI DOGRU GELECEKTIR

//BIZIM SAYFALARI LISTELEMIZ GEREKIR...ELIMZLE BU SEKILDE TEK TEK LISTELYEMEYIZ BIZIM DINAMIK BIR YAPI KURMAMIZ GEREKIYOR...
//Simdi burda plan yaparken sayfa sayimiz cok fazla oldugu zamani da dusunerek daha
// for ($i=1; $i <$total_page_count ; $i++) { 
//     echo "<a href='index.php?page=".$i."'> $i</a>";
// }

//BURDA BIZ SAYFAYA YENI DATA EKLENDIKCE KENDILIGINDEN ONA UYUM SAGLAYACAK YANI BIZ HICBIRSEY YAPMAYACAGIMZ BIR SISTEM KURACAGIZ
//DOLAYISI ILE BIZ BIR KERE HER ZAMAN ICIN...i=0 ve altinda dustugu deger ve i nin total data sayisin a eristigi degeri kontrol edecegiz
//Ama onun disinda aradaki degerlerde dikkat edersek burda bize her zaman icin otomatik olarak 7 tane degeri getiriyor ve de dikkat edelim
//i degeri degistikce yani page imize biz i dinamik degerini verdik ve 
//page=1 oldugu zaman $i=-2 olacak -2,-1,0,1,2,3,4 degerlerini alacak....
//Biz hangi sayiya basarsak o sayi page e esit oluyor yani bizim basstigmiz sayi kac ise o sayinin 3 eksigi ve 3 fazlasi arasindan sayilar gelecek
//biz burda donguyu direk i kriterlerini , yani dongu icinde hazirladgimz i degerini dinamik yaptik..dikkat edelimmmm
//bizim, dongumuzun kriteri olan i ler dinamik oldu tiklamaya gore i lerin rakam i degisiyor ne ye tiklarsak onun 3 eksigi 3 fazlasi oluyor
//Yani kullanici olark bizim tikladgimz rakam her zaman ortaya geliyor ve kendinden 3 tane sagda, ve 3 tane de solda rakam oluyor
//KALICI SURDURULEBILIR BIR SISTEM KURMUS OLACAGIZ CUNKU BIZ DATA SAYISINIIN KAC OLACAGINI BILEMEYIZ SUREKLI YENI DATA EKLENEBILR
//VE BIZ BIR SISTEM KURMALYIZ..O SISTEM DATA DEGISKLIGINE GORE,  DATA SAYISINA BAKMAKSIZIN HER TURLU SARTTA CALISMALI

//COZMEMIZ GEREKEN KISIMLAR
//AMA SAYFAMIZDA HIC PAGE YAZMAYINCA -2 DEN BASLIYOR VE PAGE 1 E KADAR BUTONLARA BASINCA SKTNI OLUYOR BUNU COZMEMMIZ LAZIM
//YANI EKRANDA GOSTERECEGIMZ LISTE HER ZAMAN ALT SINIR 1 OLMALI SON SAYI SON SAYI DA TOPLAM SAYFA SAYISI OLMALI ONU GECMEMLI 
//YANI SINIRLANDIRMALIYIZ

//BIRDE BIZ SAYFALARI TOTAL 7 BUTON OLARAK GOSTERIYORUZ AMA PAGE 1 DE IKEN BASLANGIC I 1 LE SINIRLANDIRIDIGMZ ICIN
//PAGE 1 OLDUGUNDA 4 TANE BUTON GELIYOR 1-2-3-4 DIYE VE BURASI ILK BASLANGIC BURDAN DAHA GERISI YOK, DAHA GERIYE GITMIYOR
//DOLAYISI ILE BIZ HER ZAMAN 7 TANE BUTON GOSTERMEK ISTIYORUZ O ZAMAN BUNU DA KONTROL EDELIM page 3 ten sonra normalde donuyor 
//ama page 3 ve altina dusunce total 7 tane buton gosteremiyoruz
$left=$page-3;
$right=$page+3;

if($page <= 3){//cunku $page=3 oldugu zaman biz buton minimum 1 olsun dedgimz icin 3 ve 3 un altinda total 7 buton gelmiyor
    // onu saglamak istiyoruz bizde|
    $right=7;
    echo "page: ".$page."<br>";
    echo "left: ".$left."<br>";
}

echo "total-page-count: $total_page_count </br>";
//AYNI MANTIK TA DA EN SON SAYFAYA GELMEYE 3 BUTON KALA YANI SON SAYMIZ 19 17 DEN ITIBAREN DE 
//EKRANDAKI BUTON SAYISI YINE 7 OLMIYOR 6-5-4 OLUYOR PAGE IMIZ TOPLAM PAGE IN 3 EKSIGINDEN ITIBAREN 
//TOTAL_PAGE_COUNT-3,-2,-1 DURUMLARINDA HEP EKRANDAKI BUTON SAYMIZ EKSILMIS OLUYOR AMA BIZ BUNU ISTEMIYORZ
//BURDA DA TOTAL 7 BUTON GOZUKSUN DIYORUZ 

// if($page>=$total_page_count-3){
//     $left=$total_page_count-6;
// }

//YA DA MESELA RIGTH > TOPLAM SAYFA SAYISINDAN..RIGHT  HER ZAMAN NE YE ESIT OLUYOR DIKKAT EDLIM
//RIGHT=$PAGE+3 E ESIT OLUYOR

//BURDA DA DIKKAT EDELIM NORMALDE 7 SER 7 SER GIDECEK AMA EN SON SAYFANIN DA OLDUGU BUTONLARA GELINCE
//ORASI HERZAMAN 7 OLMAYABILIR YANI ISTERSEK 7 DE YAPABILIRZ AMA NORMAL OLARAK SU SEKIDLE DE OLABILIR

if($right>$total_page_count){
    echo "running";
    $left=$total_page_count-6;
}


//Burda biz en sona geldgiinde ornegin son sayfa 20.sayfa kullanici nexte basinca 1 e gecsin yaptik ve de
//en basa geldiginde de prevuiousa basinca daha geriye gelecek sayfa olmadigi icin en son sayfaya gecsin dedik ama
//burda yaklasim su sekilde de olabilir..en sonuncu sayfay geldiginde nexte tiklandiginda artik baska sayfa olmadigi
//icin surekli en sonuncu sayfada kalabilirdi ve ayni mantikla en basa geldigidne yani 1. sayfaya geldiginde previous a
//tiklayinca geriye gidecek sayfa olmadigi icin biz en sonuncu sayfaya gitsin dedik..orda da 1. sayfada iken previous a 
//tiklanirsa yine 1. sayfada kalsin da diyebilirdik aslinda

echo "<div class='pagination'>";

    echo "<a href='pagination1.php?page=".($page>1 ? ($page-1) : $total_page_count)."'> Previous</a>";


for ($i=$left; $i<=$right; $i++) {
    if($i>0 && $i<= $total_page_count):
    
    echo "<a ". ($i==$page ? "class='active'" :null)  ."href='pagination1.php?page=".$i."'>". $i. "</a>";
    //Biz sayfa da a etiketine tiklayinca aslinda her bir tiklamada biz $page degiskenini degistirmis olyoruz dinamiklestiriyoruz
    //BU SYTANX I COOK IYI ANLAYALIM....

endif;
}

    echo "<a href='pagination1.php?page=".($page<$total_page_count ? ($page+1):1)."'> Next</a>";

echo "</div>";

//Sayfamiza aktif class i verelim yani bizim sayfamiz hangi sayfda ise o sayfanin butonunu aktif yapalim
?>

<style>
    .pagination a{
        display: inline-block;
        padding: 10px;
        background-color: lightgray;
        margin-right: 4px;
        color: #333;
        text-decoration: none;
    }

    a.active{
        background-color: #333;
        color: #fff;
    }
</style>

<!--
KISACA PAGINATION MANTIGNI OZETLEYELIM-BU 6 MADDEYI COOK IYI OZUMSEMELIYIZ COOOOK ONEMLI...
NELERE IHTIYACIMZ VAR
1-LIMIT KAC OLACAK-SAYFA BASI KAC DATA GOSTERECEGIZ BUNU BELIRLEYELIM
$LIMIT=5;
2-AKTIF SAYFA ICIN BIR $PAGE DEGISKENI TUTACAGIZ.. VE BU $PAGE DEGISKENI
GET METHOD U ILE GELECEK INDEX.PHP?PAGE=  SEKLINDE ONDAN DOLAYI DA 
ONCELIKLE PAGE I SINRLANDIRACAGIZ
*-$_GET['PAGE'] ICINDE TANIMLI OLMALI VE  PAGE NUMERIC OLMALI-STRING VEYA INT FARKETMEZ AMA NUMERIC OLMALI
*-PAGE 1 DEN KUCUK VE EN SON SAYFA SAYISINDAN BUYUK OLMAMALI
3-TOTAL DATA SAYISINI VE ONUN UZERINDEN DE TOTAL PAGE SAYISINI BILMELIYIZ, DATABASE DEN CEKEREK VE TOTAL DATA SAYISINI ALIP 
LIMITE BOLEREK VE ONU DA CEIL E BIR YUKARI YUVARLAYARAK TOTAL_PAGE_COUNT. YANI TOPLAM SAYFA SAYISINI BULURUZ..CEIL ILE BIR USTE  YUVARLMAK
COK ONEMLI CUNKU EN SON SAYFA YI HER ZAMAN KORUMUS OLURUZ VE DATALARIMIZ HIC BIR ZAMAN EKSIK KALMZ CEIL BIZIM SON SAYFAMIZI  SUREKLI OLARAK¨
KORUMUS OLUR...
4-COK KRITIK BILMEMIZ GEREKEN NOKTALARDAN BIR TANESI DE DATA YI BIZ DINAMIK BIR SEKILDE TIKLANAN SAYFADAKI DATA NIN CEKILMESI ICIN
DINAMIK BIR SORGU OLUSTURMALYIZ 
SELECT * FROM TEST ORDER BY ID DESC LIMIT 0 ,5  burda page=1 (1,2,3,4,5)
SELECT * FROM TEST ORDER BY ID DESC LIMIT 5 ,5  burda page=2 (6,7,8,9,10)
SELECT * FROM TEST ORDER BY ID DESC LIMIT 10 ,5  burda page=3 (11,12,13,14,15)
SELECT * FROM TEST ORDER BY ID DESC LIMIT 15,5  burda page=4 (16,17,18,19,20)
SEKLINDE MANTIK ILE DATA CEKILIYR DIKKAT EDERSEK BURDA DEGISKEN NE
LIMIT IN ILK NUMARASI Y ANI KACINCI DATA DAN SONRA GETIRSIN RAKAMI DINAMIK OLARAK DEGISIYOR O ZAMAN BIZIM BURAYI
KONTROLUMUZ ALTINA ALMAMIZ ICIN, LIMIT IN ILK NUMARASINA DINAMIK BIR DEGISKEN YAZIP ORDAKI SORGUYU BIZIM AKTIF PAGE DEGISKENIMIZIN 
DEGISMESINE GORE DEGISECEK BIR SISTEM KURACAGIZ KI PAGE I DEGISTIRECEK OLAN KULLANICIDIR....KULLANICI <a> linkine her tikladiginda
get methodu ile url e data gonderecek ve biz de oraya gelen datayi sorgulayarak sayfalama da manipulasyonlar yapacagiz... 
Dolayisi ile sorgu da start baslangic kac tan baslasin ve 2. rakam da kac tane getirecegiz yani her sayfa da kac tane data olacak
iste bu mantik ta 1. sayi $start 2. sayi $limittir ve $start nedir peki start bizim icin her zaman dinamik page sayisi kac ise 
$page ornegin 1 iken 0-5, page 2 iken 5-5, page 3 iken 10-5 yani start her zaman neye esit oluyor page*limit-limit e esit oluyor burdan da 
i sayi yi bu sekilde bulurz...ve dinamik bir sekilde sql sorgumza yazarak kullanicinin her bir butona bastiginda page in degismesi ve page e gore de
sorgunun degismesini saglamis olacagiz...cunku sorguyu page ve limit e baglamis olduk   
$start=($page*$limit)-$limit;
$query=$db->query("SELECT * FROM TEST ORDER BY ID ASC LIMIT " .$start. " ," . $limit)->fetchAll(PDO::FETCH_ASSOC);
5-SIMDI DE BUTONLARI DINAMIK BIR SEKILDE YANYANA GETIRME ISLEMI KALDI TOTAL DE KAC SAYFAMIZ OLURSA OLSUN SURDURULEBILIR BIR SISTEM KURABILMEMIZ ICIN
NASIL KURARIZ SISTEMI
FORECH ILE BIZ TOTAL SAYFA SAYIMIZI 1 DEN BASLAYARAK SON SAYFAYA KADAR SIRALARIZ AMA BURDA KI PROBLEM SU 
BIZIM 50 TANE SAYFAMIZ OLURSA ORNEGIN BIZIM 252 TANE DATAMIZ VAR VE HER SAYFA DA 5 URUN OLACAK 50 TANE SAYFALAMA BUTONU MU GOSTERECEGIZ 
KULLANICIYA BU OLACAK BIRSEY DEGIL O ZAMAN BIZ SUREKLI AYNI SAYIDA BUTON  GOSTERMELIYZ VE KULLANICININ TIKLAMASINA GORE 
SAYFALAMA DAKI BUTONLARIMIZ DA DINAMIK OLARAK DEGISECEK BIR SISTEM KURMALIYIZ...O ZAMAN BIZ NE YI DINAMIK YAPMALIYIZ BIZ FOR DONGUSU ILE
FOR DONGUSUNUN BASLANGIC VE BITIS DEGERI YANI $i nin kucuk oldugu ve buyuk oldugu degerleri dinamik yapalim ki ekran da surekli ayni sayi da 
butonumuz olsun ama bu butonlar bizim tiklagimz butona gore de surekli dinamik olarak degissin
ISTE BURASI HARIKA BIR BESTPRACTISE BURAYI DA ANLARSAK VE UYGULARSAK ZATEN CIDDI ADVANCE BIR ISLEMI GERCEKLSTIRMIS OLACAGIZ...
PAGE AKTIF SAYFA SAYIMIZ HEP ORTADA KALSIN YANI TIKLANA SAYFA VE ONUN SAGINDA VE SOLUNDA 3 ER TANE DAHA SAYFALAMA BUTONU OLSUN DIYORUZ YANI
TOTAL DE HEP 7 BUTON GOSTERELIM DIYORUZ O ZAMANN BIZ YINE AKTIF PAGE IMIZE GORE FOR DONGUSUNUN LIMITLERINI DE BELIRLERSEK BIZ 
FOR DONGUSU DE TIKLANAN BUTON ILE PAGE I DEGISTIREREK EKRAN DA LISTELENEN PAGE BUTONLARINI DA DINAMIK BIR SEKILDE DEGISMESINI SAGLARIZ

DIKKAT EDELIM VE BURAYI IYI ANLAYALIM BIZ LISTELEDGIMZ DATA NIN TIKLADGIMZ SAYFAYA GORE DEGISMEISNI ISTYORUZ
HER TIKLANDIGINDA KULLANICI PAGE O AN UZERINDE OLDUG PAGE DEGISKENINI DEGISTIRIYOR VE BU SEKILDE FOR DONGUSU DE BIZIM ICIN 
KULLANICI HANGI PAGE I SECER ISE O PAGE IN AKTIF PAGE IN SAGINDA 3 TANE DATA SOLUNDA DA 3 TANE DATA GETIRIYOR HER ZAMAN
BIZ KULLANICI HANGI PAGE I TIKLARSA ONUN 3 TANE SAGINDA 3 TANE SOLUNDA BUTON GELSIN SAYFALAMA BUTONU ISTIYORUZ...

FOR($I=$PAGE-3; I<=$PAGE+3; I++){
     if($i>0 && $i<= $total_page_count):BU KONTROLLE BIZ ZATEN EKRANIMIZDA PAGE IN 1 DEN BASLAYARAK EN SON SAYFA SAYISINI DA ASMAYANLARIN GOSTERILMESINI GARANTI ALTINA ALDIK ZATEN TEK ISTEDIGMIIZ PAGE 3 VE 3 TEN KUCUK OLDUGUNDA RIGHT HER ZAMAN 7 KALSIN KI BIZ 7 BUTON GORMEYE DEVAM EDELIM KURDUGMUZ SISTEMIMIZ DEVAM ETSIN AYNI MANTIK DA EN SON SAYFAYA GELMEYE EN 3 KALA DA SOL  U BIZ EN SON SAYFA -6 YAPALIM KI EN SON SAYFA YA 3 KALA DA
     YINE EKRANIMIZDA 7 BUTONU GORMEYI KORUMUS OLALIM SISTEMIMZI KORUMUS OLALIM...
            echo "<a href='index.php?page". $page ."'></a>
}

BU SEKILDE YAPTIGMIZ ZAMAN BU SEFER SAYFA SAYISI 3 OLDUGU ZAMAN 3-3 0 OLUYOR PAGE 3 TEN ITIBAREN ASAGI GITTIKCE BIZ EKRANDA 7 BUTON GOSTEREMIYORUZ
AYNI SEKILDE EN SAYFAYA 3 KALA DA 7 SAYFA YI EKRAN DA GOSTEREMIYORUZ BUNU DA COZMEMIZ GEREK
SAYFA 3 VE ALTINA DUSTUGU ZAMAN  
BIZ HER HARUKARDA PAGE IMIZ 3 VE 3 TEN KUCUK OLDUGU ANDA KURDGUMUZ SISTEMIN SURDURULEBILMESI ADINA PAGE 3 ve 3 un altina dustugu anda
en son buton olarak en solda ekran da pagebutonu olarak i 1 gorebilmek icin 1 in altina dusmemesi icin  page 3 ve 3 ten kucuk ise o zaman right 7 olsun diyoruz ve bu sekilde
$left=$page-3;
$right=$page+3;

if($page <= 3){//cunku $page=3 oldugu zaman biz buton minimum 1 olsun dedgimz icin 3 ve 3 un altinda total 7 buton gelmiyor
    // onu saglamak istiyoruz bizde
    $right=7;
}
if($right>$total_page_count){
    echo "running";
    $left=$total_page_count-6;
}
6-SON OLARAK DA PREVIOUS VE NEXT BUTONLARINI DA EN SOL VE EN SAGA ILAVE EDEREK BU ISLEMI DE COZERIZ...
echo "<div class='pagination'>";

    echo "<a href='index.php?page=".($page>1 ? ($page-1) : $total_page_count)."'> Previous</a>";


for ($i=$left; $i<=$right; $i++) {
    if($i>0 && $i<= $total_page_count):
    
    echo "<a ". ($i==$page ? "class='active'" :null)  ."href='index.php?page=".$i."'>". $i. "</a>";
    //Biz sayfa da a etiketine tiklayinca aslinda her bir tiklamada biz $page degiskenini degistirmis olyoruz dinamiklestiriyoruz
    //BU SYTANX I COOK IYI ANLAYALIM....

endif;
}

    echo "<a href='index.php?page=".($page<$total_page_count ? ($page+1):1)."'> Next</a>";

echo "</div>";
7.AYRICA SUNU DA IYI ANLAYALIM FOR DONGUSU ICINDEKI I BIZIM AKTIF SAYFA BUTONLARIMIZ FOR DONGUSU ICNDEKI I YI KULLANARAK GOSTERIYORUZ...

 -->