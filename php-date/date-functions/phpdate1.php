<?php 

//Php de tarih fonksiyonlari
# date()
//2 parametre alir date("","")
// echo date("Y");//2022 4 haneli yili veriyor
// echo date("Y m");// 2022 11
 echo date("Y m d");//2022 11 10
 //d koyarsak 2 haneli getiriyor gunleri tek haneli olsa bile basina 0 koyarak
 
 echo  "<br>".date("Y m j");//2022 11 10
 
 //Biz tarihleri veritabanina da bu formatta kaydetmemiz gerekiyor ki 
 //tarihleri zaten otomatik olarak kendsine tarihi kaydettirdigmz zaman
 //veritabani bu sekilde kaydediyor
  //Normal bir tarih formati su sekilde olmalidir
 //YY-mm-dd hour:minute:second 
 //Cunku biz tarihleri filtreledigmzde bu tarih formatinda calistgimz zaman dogru sonuclar aliyoruz
 echo  "<br>".date("Y-m-d");//Araya -tire koyarsak tire ile birlikte gelecektir ve tarih formatimiza uygyn bir sekilde almis olacagiz
//Hour-saat gosterimi-H ile 24 saat lik birimie gore h ile a.m, pm ile gosterecek saati
//i-minute u 0 dolgulu gosteriyor
//s-second- 0 dolguulu saniyeyi gosteriyor
echo  "<br>".date("Y-m-d H:i:s");
//2022-11-10 16:00:23 
//Su anki guncel tarih ve saati almis oluyoruz bu sekiilde
// bu sekilde gosterebiliriz
//date() fonksiyonunun 2. paramtresi timestamp
 # getdate()
// echo "<hr>";
getdate();
//Bize dizi olarak donecektir
$date=getdate();
//print_r($date);
# time()
/*
{
0: "1668107036",//Timestamp formatinda bize donuyor 0 key ile
seconds: "56",
minutes: "3",
hours: "20",
mday: "10",
wday: "4",//haftanin 4.gunu demek yani Thursday-Persembe
mon: "11",
year: "2022",
yday: "313",
weekday: "Thursday",
month: "November"
}
*/

//1 Ocak 1970 tarihinden beridir gecen saniye sayisina denilen

echo "<br>";
echo time();
//TIMESTAMP
//Boyle bir time formati olarak geliyor yani timestamp formatinda bu sekilde veriliyor
//Her saniye gectiginde time formati degisiyor...
//1668107249
//UNIX TIME-TIMESTAMP FORMATI
//1 OCAK 1971 DEN BERI GECEN SANIYE SAYISINA DENILEN SAYISAL VERI TIPIDIR
//1970 DEN SU ANA KADAR GECEN SANIYELERIN TOPLAMIDIR ONDAN DOLAYI DA ZATEN
//SAYFAYI YENILEYINCE ALDIGIMZI SONUC BIRAZ DEGISIYOR SANIYELER GECMEYE DEVAM ETTIGI ICIN

//2.PARAMETRE OLARAK TIMESTAMPI DATE () METHODUNDA KULLANMAK
echo "<hr>";
//Demis oluyoruz ki bu timestamp i bize Y-M-D olarak yorumla demis oluyoruz...

echo date("Y m d",1558107249);
//2019 05 17

//O zaman time() bize su anki guncel zamanin timestamp() ini veriyor
//onu alip da 

echo "<hr>";
echo date("y m d H:m:s", time());
//22 11 10 20:11:06-su anki guncel zamani verecektir bize

//Peki time() i kullanmanin bize nasil bir pratik faydasi olacak
//Ornegin biz tam 1 gun oncesindeki timestamp i almak istersek eger
echo "<hr>";

//TIME() BU ISE ICINDE BULUNDUGMUZ GUNUN TARIHIN TIMESTAMP KARSILIGIN VERMEKLE BERABER
//ILERIKI GUNLERE VEYA GECMISTEKI GUNLERE TIMESTAMP YOLU ILE 1 GUNE KARSILIK GELEN
//SANIYE SAYISI ILE 60*60*24 ILE ILERIKI GUNLERDE KAC GUN SONRA VEYA KAC GUN ONCEYI HESAPLAMAK
//ISTIYORSAK HESAPLAYABILIRZ VE DE AYRICA...TIMESTAMP I BU SEKILDE HESAPLAYIP BU TIMESTAMP I  YINE
//HEM DATE DE HEM DE GETDATE() DE PARAMETRE OLARAK KULLANABILIRIZ

$time=time()-60*60*24;
//Bir gundeki toplam saniye sayisi 
echo $time;

echo "<br>  <hr> ";
echo "date:::    ".date("y m d H:m:s",$time);
//22 11 09 20:11:24 
//Bu sekilde date() fonksiyonunun 2.parametresine yine time() methodu ile 
//ornegin hesapladimgz bugunun timestampinden gecmisten 1 gunun saniye syaisini cikarip
//1 gun oncesinin timestampini hesaplayip , bu timestapm hangi tarihe denk geliyor
//onu direk 22 11 09 20:11:24  bu formatta hesaplayabilirz


$time2=time()-(60*60*24)*2;//2 gun oncesi
$time3=time()-(60*60*24)*7;//7 gun oncesi
$time4=time()-(60*60*24)*30;//20 gun oncesi

echo "<br>  <hr> ";
echo "2 gun oncesi: ".date("y m d H:m:s",$time2);//22 11 08 20:11:37
echo "<br>  <hr> ";
echo "7 gun oncesi: ".date("y m d H:m:s",$time3);//22 11 03 20:11:30
echo "<br>  <hr> ";
echo "30 gun oncesi: ".date("y m d H:m:s",$time4);// 22 10 11 21:10:30


//1 gundeki toplam saniye sayisi 60*60*24=86.400
//time() bize  su ana kadarki olan timestampi veriyor
//Biz 1 gun oncesindeki timestampi i de time()-86.400 u cikararak bulabiliriz
//1668021390 bu 1 gun oncesinin tarihini veriyor ama bu aslinda dinamik oldu yani 
//Bu her zaman icinde bulundgumuz zamana gore 1 gun oncesini verecegi icin surekli degisecektir zaten

//GETDATE();
//getdate() direk kullanirsak su andaki icinde bulundugmuz ani dizi icinde tum detayiini verirken
//parantez icerisine timestamp verirsek de o zaman o time stamp hangi tarihe denk geliyor sa o tarhin 
//tum detayini veriyor bize

$my_date=getdate($time);
echo "<br>"."mydate:  ";
//print_r($my_date);//Tam 1 gun oncesinin tum detayini dizi iceisinde veriyor
//Cunku getdate() parametre olarak timestamp verebiliyoruz..

//KISACA TIME() HER ZAMAN DEGISIYOR CUNKU ICIN DE BULUNDUGMUZ ANA GORE 1970 DEN BU YANA KI 
//TOTAL SANIYE SAYISINI VERIYOR
//VE BIZIM OZELLIKLE ILERIKI VEYA GERI DEKI GUNLERI HESAPLAMAK ICIN TIME() I KULLANACAGIZ

//DATE,GETDATE HER IKISI DE BIZE ICIN DE BLUNDGUMUZ ZAMANIN TARIHLERNI VERIYOR DATE NORMAL 
//BIZIM VERDGIMIZ TARIH FORMATINDA VERIYOR...GETDATE() ISE DIZI ICINDE VERIYOR

echo "<br>"."date::::  ";
echo date("2020-8-14");//Ayrica icerisine verilen normal date formatindaki tarihi de bize veriyor



?>