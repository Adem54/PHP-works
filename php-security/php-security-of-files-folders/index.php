<?php 

//db connection file
//php de soyle bir durum var ornegin db.php yani uzanti olarak php vermesek bile php kodlairini calistirabiliriz
//Ornegin biz db.php yerine db.inc yapip da onu burda cagirir isek yine dosyamizin tarayicida yine ayni ciktiyi verdgini gorecegiz
//Ama bu durumun guvenlik olarak soyle bir problemi var ki biz bu dosya yi index.php miz de calistirdigmizda problem yok ama, 
//http://localhost/test/php-security/php-security-of-files-folders/db.inc  i eger direk calistirirsak o zaman tehlike su ki bu cikti olarak  direk php kodlarimzi veriyoru site bu buyuk problem
/*
<?php 
$db=new PDO("mysql:host=localhost;dbname=testdb;port=3306","root","");
$mydb="myDB connection";

Bu ciktiyi tarayiciya basiyor bu buyuk sknti 
COOOOK ONEMLI BIR NOKTA!!!!!!!!!!!!!
Iste bundan dolayi oncelikle hicbirzaman .php uzantisi disinda baska bir uzantili dosyaya gidip de php kodlarimizi yazmamaliyiz
*/
/*
Proje  yaparken uygulamaizi guzelce dosyalamamiz gerekecek ornegin 
app adinda bir dosyamiz olacak ve onun icerisinde config.php, init.php ve parentdirectory olacak burasi
Biz uygulamamizda ana dosyamiz olan app kklasoru altina girilince tum dizindeki dosyalari kolayca listelenebiliyor
Bu hostinge atildiginda bu sekilde olacak ve bunun bu sekidle gozukmesi de buyuk bir guvenlik acigi demektir ve 
php kodlarini goremezler ama cok fazla hata loglama islemi  yaparak o hatalardan yola cikarak sistemdeki guvenlik aciklari bulunup
sisteme sizmalar olabilir
Dolayisi ile bu guvenlik acigi konusunda da htaccess yardimi ile dizindeki dosyalarin listelenmesini engelleyebiliyoruz
Biz app klasoru altindaki ana dosyalairimzi gostermemek icin .htaccess dosyasi icerisine Options-Indexes bunu yazarsak artk
http://localhost/test/php-security/php-security-of-files-folders/app/ kullanici adres cubugunda app klasoru altindaki dosya laria goremeyecek..Simdi app klasoru altindaki dosya ve klasorlerin gozukmemesi cok onemli bir onlem di bunu almis olduk
Birde kullanici direk app altindaki herhangi bir dosyayi adres cubugunda girmeye calisir ise app/init.php diyerek , biz bunun acilmasini 
da istemeyiz bu da guvenlik icin cok skntili bir durum
O zaman da .htaccess icerisine Options-Indexes yerine deny from all yazarsak artik hem dosya ve klasorleri gizlemis olacagiz hem de dogrudan klasoru adres cubuguna girerek erismeye calisanlar icinde onlem almis olurz
Artik app klasoru altindaki ornegin init.php yi sadece biz index.php icerisine requre veya include ederek cagirirsak erisebiliriz
bizde bunu istiyoruz bu dosyalara erisim sadece bizim tarafrimizdan yapilmasini
Birde bizim public ya da assets klasorumuz olur bunun icerisinde tasarim ile iligli css, images,javascript dosyalarimiz bulunur
Dolayisi ile de public klasorumz icerisinde de bir .htaccess olustururuz ama burda deny from all dersek o zaman da bu sefer html dosyamiz da erismeye calsitigmiz css,images ve javascript dosyalarina erisim sorunu yasariz, ve ayni zamanda php tarafinda da html kisminda da head etiktleri icnde css lere erisemeyiz..Bizim tasarimlar kisimlara adres cubugundan ersimemiz gerekiyor kullaniciya gosterebilmek icin ama server tarafi ile ilgili php kodlarimizin kullaniciya gosterilememesi gerekyor
Ondan dolayi da public kisminda sadece options-indexes yapmamiz yeterli olacaktir
*/
require "db.inc";

echo $mydb;

?>