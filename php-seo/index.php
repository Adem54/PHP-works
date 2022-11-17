<a href="index.php">Homepage</a> |
<a href="index.php?page=about">About</a> |
<a href="index.php?page=contact">Contact</a> |
<a href="index.php?page=services">Services</a> |


<!-- Bu link yapisi cok da arama motoru link yapisi degil 
Bunu kullanici dostu yapmak icin 1 tane .htaccess dosyasi olusturacagiz

-->


<div style="background:yellow;">
<?php 

if(!isset($_GET['page'])){
    $_GET['page']='index';
}

//http://localhost/test/php-seo/services/5 boyle kullanildigi zaman  $_GET['page'] altina
//nasil geliyor  "Services/5" seklinde geliyor
//Yani burdan aslinda sunu anliyoruz biz adres cugubuna paramtre ekledgmiz zmana sayfalarmizin sonuna paramtre 
//ekledigmz zaman bu $_PAGE['page'] ile erisecegiz, page siz kullansak bile .htaccess sayesinde regular express sayesinde ama 
//aslinda page calisiyor ondan dolayi bi page ile yine erisiyoruz..ve $_GET['page'] i yazdirdigimz da gordgumuz gibi ilk olarak 
//bizim sayfamiz ne ise o geliyor string icinde her zaman bunu iyi anlayalim
//Simdi biz ornegin http://localhost/test/php-seo/services/5 boyle bir kullanim da eger bu id 5 i services icerisinde ihtiyacimz
//olursa services.php de dogrudan $pageVar[1] diyerek 5 id sine erisebilirdim
// $pageVar=explode("/",$_GET['page']);
// $page=$page[0]; //services diye geliyor 

// echo "page:: ".$page."  -";

//switch case ile  sayfamiza gelindigi zaman GEt ile url den gelindigi zaman kullanicya hangi sayfayi gostercegimiz ayarliyoruz
//Bu islemi cok fazla yapacagiz..dikkat edelim...
//BUNU COK FAZLA KULLANIYORUZ..COK FAZLA YAPACAGIZ BU MATNIGI..
switch ($_GET['page']) {
    case 'index':
        require_once "homepage.php";
        break;
    case "about":
        require_once("about.php");
        break;
    case "contact":
        require_once("contact.php");
        break;
     case "services":
        require_once("services.php");

}
?>

</div>
<?php
/*

hypertext access: Apache ile calisilan web sunucularinda calisan bir yapilandirma dosyasidir
htaccess de SEARCH ENGINE FIRENDLY-SEF LINKLER NASIL YAPILIYOR ONA BAKACAGIZ-SEAR
SEARCH ENGINE LINKS NASIL YAPILIYOR ONA BAKALIM


http://localhost/test/php-seo/htaccess.php?page=about
page diye bir get paramtresi gonderdik
echo $_GET['page'];//about
Ama biz sunu istiyoruz, ?page=about degilde direk about olarak gelsin istiyoruz neden bunu istiyoruz cunku BU SEKILDE
SEARCH ENGINE FRIENDLY bir ayardir arama motorlari cok daha kolay bizim sayfalarimizi indexleyebilirler bu sekilde
http://localhost/test/php-seo/htaccess.php?about
ISTE BOYLE DURUMLARDA DEVREYE HTACCESS  YAPILANDIRMA DOSYASI DEVREYE GIRIYOR

BU DA ENTERESAN BIR YONTEM EGER KULLANICI ORNEGIN BEKLEDIGMIZ BIR SAYFA YONLENDIRMESI YAPMAMIS ISE ORNEGIN BU A HREF ILE OLUR VEYA
BASKA BIR SEKILDE... O ZAMAN BIZ UYGULAMA PATLAMAMASI ICIN BU SEKILDE $_GET["page"]="index" e deger atamayi dusunebiliriz yani biz kendimzi
koddan sayfa yonlendirmesine mudahele ederek onun patlamasini ve daha kulllanici dostu olmasini saglayabilriz bu da onemli 
bir cikis notkasi olabilri kimi zaman
BIZ SAYFA YONLENDIRMELER ICIN NELER KULLANIYORUZ COK IYI HAKIM OLMAMIZ GEREKIYOR
1-SWITCH CASE ICINDE - EGER $_GET['page']="about" ise REQUIRE_ONCE("about.php") ye gonder..
-SWITCH CASE ILE GET ILE KULLANICI HANGI SAYFAYA TIKLAMIS ISE ONU GET ILE ALACAGIZ
(KULLANICIYA BIZ A HREF ILE ORNEGIN ABOUT BUTONUNA TIKLAYINCA KULLANICININ ?PAGE=ABOUT YE GITMESINI SAGLAYACAGIZ VE DD
KULLANICI ORAYA GIDINCE DE BURDAN GET['PAGE']) ILE KONTROL EDIP KULLANICIYI O ZAMAN ABOUT.PHP YI GOSTER DIYECEGIZ 
REQUIRE_ONCE() ILE....BUU COOK ONEMLI
2-header("Location:index.php?page="contact") seklinde React taki Navigation mantignda sayfa yonlendirmesi y apiyoruz
3-Birde a etiketleri ile kullanicinin tiklayarak GET methodunu tetiklemesin ve Get methoduna url e data gondermesini
sagliyoruz
<a href='index.php?page=about'>About</a> gibi yani....



.htaccess sayfasi

RewriteEngine On //yeniden yazma motrounu kullanacagiz ve kurallarimiz belirleyecegiz
^ demek birseyle baslasin birseyle bitisin demektir
http://localhost/test/php-seo/index.php
http://localhost/test/php-seo/index.php?page=about
http://localhost/test/php-seo/index.php?page=contact
Bu url lerde dikkat edersek page hepsinde sabit index.php de aslinda page=index dir
o zaman page degerini  biz dinamik hale getirebiliriz
index.php deki page in karsiligi $1 olsun diyoruz bu rastgele ben ne yazarsam o gelsin demektir
Ve burda regex yaziyoruz 0-9 arasi sayilar a-z kucuk a dan z ye buyuk A dan Zye kadar, - tire isaretlerini
_ alt tire ve / isaretlerini kabul ediyoruz demektir bu ve koseli parantezi kapatip + koyarsam o zaman bu koseli
parantez icine yazdiklarimdan en az 1 tane olacak demektir
Bizim regular expression imiz page paramtresinin = degerine esit
index.php deki page paramtresini bu sekilde girerlerse page=$1 , $1 bu degeri al
Ve burda bizim yazdimgiz regex ifade sartlarina uyuyorsa,  yani bunlarla baslayip bunlardan bir tanesi ile bitiyorsa
^()$ bu demektir ki parantez icine yazilan ifadeler le baslayp en az bunlardan bir tanesi ile bitiyorsa demektir
Eger sartlarimizi sagliyors o zaman sayfayi biz artik sayfa ana domain / page e karsilik gelen value ile sayfayi acabiliriz demekttir bu.
RewriteRule ^([0-9a-zA-Z-_/]+)$ index.php?page=$1 

Artik about sayfasi ve diger sayfalari asagidaki gibi de calistirabiliyoruz iste bu 
.htaccess icerisine yazdgimiz regular expressions sayesindedir
Aslinda asgidaki gibi biz sayfa sonucumuzu yine aliyoruz ama normalde biz yine aslinda  http://localhost/test/php-seo/index.php?page=about
bu sayfaya girmis oluyoruz, sadece biz .htaccess sayesinde bunu biz manipule ediyoruz
RewriteRule ^([0-9a-zA-Z-_/]+)$ index.php?page=$1  index.php de page paramteresini gonderdikleri zaman $1 degeri eger regular expression icinde yazmis 
oldugmuz ifade ile eslesiyor ise o zaman sen bunu direk onune ?page= demeden direk goster demis oluyoruz... 
Mesela biz basina a/ i da eklese idik o zaman da artik sayfalarimiza yine ?page= kullanmadan ama basina a/ alacakti
ttp://localhost/test/php-seo/index.php/a/about 
http://localhost/test/php-seo/a/about
RewriteRule ^a/([0-9a-zA-Z-_/]+)$ index.php?page=$1 




http://localhost/test/php-seo/index.php/about
http://localhost/test/php-seo/about

.htaccess sayfamizi olusturduktan sonra artik ornegin about sayfamiz artik asagidakiler gibi de calisacaktir..
http://localhost/test/php-seo/index.php?page=about

bir tane de services.php olusturduk ve buraya hem ?page?services&id=4 gibi bir deger ile gidecegmizi dusunelim ama bu id yi de gonderidimiz icin
Get paramtrelerini kabul etmsi icin regular expression yanina bir de  [QSA] QUERY-STRING-APPEND eklememiz gerekiyor 
Bu sekilde get reqular expression un  get parametrelerini kabul etmesini saglamis oluruz 
http://localhost/test/php-seo/index.php?page=services&id=5
page kullanmadan da id yi kabul ediyor artik
http://localhost/test/php-seo/index.php/services&id=5
http://localhost/test/php-seo/services&id=5


Ayrica 
http://localhost/test/php-seo/services/5
Bu sekilde url de yazinca bu services i temsil etmiyor
ki zaten services sayfasini getirmedi, onun yerine ne getiriyor index.php de $_GET['page'] ile ararsak o zaman
bize services/5 bunu getiriyor bu services i temsil etmiyor peki nasil kullanacagiz bunu dikkat edelim...
Biz bunu mesele ne yapabilirz bu bir string bunu explode ile bolerek dizi icine atabilirz
"services/5" explode("/",$_GET['page']) dersek o zaman 2 elemanli bir dizi alacagiz 0.index services 1.indexi 5 olan


Yeni bir .htaccess rule yazacak olursak
RewriteRule ^([0-9a-zA-Z-_/]+)$ index.php?page=$1 [QSA]

Diyelim ki index.php?page=services ama bu serferde id sinin ne oldugunu bilmiyorsak
regular expression da da sadece id sini alsin,0 dan 9 a kadar olan sayilari alsin en az 1 tane oolsun
RewriteRule ^([0-9]+)$ index.php?page=services&id=$1 [QSA]
Ama bunu bu sekilde yaparsak bir usstteki regular expression ile cakisacak sayfaya karsilik gelen deger mi 
bu sekilde gosterilecek yokksa id ye karsilik gelen deger mi , o zaman bunlarin cakismamasi icn iste biz
services/ seklinde  yapmamiz gerekecek
RewriteRule ^services/([0-9]+)$ index.php?page=services&id=$1 [QSA]
Bu ayarlamalari yaptiktan sonra kontrool edince yine 
http://localhost/test/php-seo/services/5
bu sekilde istedgimiz olmayacak neden cunku ilk once ustteki regular expressioni okuyacak(her zaman page degeri var ilk basta page=$1) ondan dolay altta services/ ile baslayan
regular expression imi  bir uste aliriz once services var sa onu gostersin diye
Yani sondurumuda .htaccess sayfamiz asagidaki gibi olur

RewriteEngine On 
RewriteRule ^services/([0-9]+)$ index.php?page=services&id=$1 [QSA]
RewriteRule ^([0-9a-zA-Z-_/]+)$ index.php?page=$1 [QSA]


Artik bu url e gidince, burasi bize services sayfasini veriyor artik direk services sayfamizi getiriyor burasi artik
http://localhost/test/php-seo/services/5

Ve de services.php de 
echo $_GET['page'];//services
echo $_GET['id'];//5

page ve id $_GET icerisinde key olarak gelmis ve degerleri de bu sekilde geliyor
 
Uzun lafin kisasi biz aslinda normal link hali 
http://localhost/test/php-seo/index.php?page=services&id=5 
bu sekilde olan url li hangi hale getirdik
http://localhost/test/php-seo/services/5
bu hale getirerek daha kullanici dostu bir url haline getirerek seo icin cok daha uygun bir
ayar yapmis olduk aslinda...

Biz regular expression lar da kurallarimizi  yaziyoruz kurallarimza gore apache yorumluyor ve
Ve de bizim yazdigmiz sahte linkerimizi http://localhost/test/php-seo/services/5 ama arama motoru dostu oolan
linklerimizi olusturmus olyoruz.. Esasainda bunlar yine normal http://localhost/test/php-seo/index.php?page=services&id=5 budur ama
biz sahte link haline gteirip apache yardimi ilse seo dostu hale getiriyoruz

*/
?>

