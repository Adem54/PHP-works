<?php 
// FORM-GET ISLEMLERI
// Get ile gonderilen datalari $_GET ile alabiliriz
// ayni $_POST TAKI MANTIKLA ALABILIIRZ $_GET ILE

//methodu get yapar ve arama inputuna bazi degerleri yapilip enter a bailirsa ki bu arada form
//islemlerinde butona basma ve enter a basma ile form elementleri icindeki elemanlar
//gonderilir ve get islemi ile gonderilen data lar url adres cubugunda gozukur ondan dolayi cok guvensizdir
//Hassas datalar kesinlikle bu sekilde gonderilmez
//http://localhost/PHP-works/myphpworks/Form-Post-Get/php_get.php?search=adem
//Get mantigi key=value&key=value seklinde calisiyor
//search=adem+erbas  + boslugu simgeliyor
//http://localhost/PHP-works/myphpworks/Form-Post-Get/php_get.php?search=adem+erbas
//Get mantigi key=value&key=value seklinde calisiyor
//search=adem&id=5  yani 2 tane
//Biz dikkat edelim...php sayfalarimizi url de calistirirken sayfa ismi olan .php den sonra ? gelir
//http://localhost/PHP-works/myphpworks/Form-Post-Get/php_get.php?search=adem+erbas&id=5 diyerek bir get islemi yaptirabiliyoruz
//dogrudan url de yazarak ve bu da formdan gelmeden biz id degeri gonderiyoruz aslinda dikkat edelim...direk url den....DIKKAT EDELIM
//YANI BU SEKILDE URL DEN GELEN DATALRI DA ALABILIRZ....
//INDEX.PHP?KEY1=VALUE1&KEY2=VALUE2&KEY3=VALUE3&....DIYE GIDER BU SEKILDE...ONEMLI

//ASAGIDAKI GIBI EGER 3 TANE INPUTUMUZ OLUR VE HERBIRISININ ICERISINDE ATTRIBUTE OLARAK NAME DE SEARCH1,SEARCH2,SEARCH3 BULUNUR ISE O ZAMAN
//asagidaki gibi gelecektir karsimiza 
//http://localhost/PHP-works/myphpworks/Form-Post-Get/php_get.php?search1=adem+erbas&search2=zehra+erbas&search3=zeynep+erbas

//GET ISLEMLERINIZ NASIL ALIRIZ....
//POST TAN FARKLI POST GONDERDIGI DEGERLERI ARKA PLAN DA GONDERIYOR
//VE SAYFAYI YENILEDIGIMZDE POST ISLEMI BITERSE DEGERLERI GOREMEYIZ...
//ARAMA KISMIMINDA ARMA YAPILAN, PAGINATION YAPILAN YERLERDE POST ILE YAPMAK ANLAMSIZDIR GET ILE YAPILIR O TARZ ISLEMLERDE
//AMA BIR UYE KAYDI YAPILACAK ISE O ZAMAN URL DE HASSAS BILGILERI URL DE GOSTERMEYIZ..YA DA UYE DUZENLEME SAYFASI VAR VE NE LAZM BIZE
//UYENIN ID SI LAZIM O ZAMAN UYE-DUZENLE.PHP?ID=5 DIYEREK GET ISLEMI KULLANIRIZ VE ID SI KAC OLARAK GELIYORSA O ID YI ALIP HANGI UYENIN 
//ID SINI DUZENLEYECEGIMIZI ANLAYABILIRIZ...YANI GET ILE YAPARIZ O TARZ ISLEMLERI DE
//KULLANDIKCA ANLAYAAGIZ, URL DE GET URL YAZIMINA UYGUN OLAN HERSEYI BIZ $_GET ILE ALABILIYORUZ
//DEMEKKI GET ISLEMI SADECE FORM DAN GONDERILEN DATA ILE ALAKALI DEGIL AYNI ZAMANDA URL DEN DE GIRILEN DEGERLERI $_GET ILE ALABILIYORUZ..
//POST ICIN YAPTIMIZ HERSEYI GET ICIN DE YAPABILIRIZ...ORNEGIN HTML ETIKETI ILE DATA GONDERILSIN ISTEMIYORUZ

print_r($_GET);


function form_filter($get){
    return is_array($get) ? array_map("form_filter",$get)  : htmlspecialchars(trim($get));
    //Burda su cook onemli kullanici html yazamamasi gerekir...cok onemlidir
   }
   
   $_GET=array_map("form_filter",$_GET);

//PHP de biz isset ile data nin var olup olmadigini kontrol ederiz cunku php de data nn var olup olmadigini 
//ornegin direk dizi icinde var mi diye kontroll etmeye caliisr isek eger data gelmez ise hata aliyoruz
function get($name)
{
    if(isset($_GET[$name]))
    return $_GET[$name];
};


//PEKI BIZ KULLANICININ INPUTLARA GIRDIGI DEGERI DE YINE INPUT LARDA GOSTERMEK ISTIYORUZ NE YAPARIZ
//HATIRLAYALIM REACT TA NE YAPIYORDUK, INPUT VALUE DEGERLERINI DINAMIK YAPIYOR VE KULLANICI NE GIRERSE ONU YAZIYORDUK
//ASLIINDA AYNI MANTIGI YAPIYORUZ BURDA BIZ KULLLANICINI YAZDIGI DEGERI NASIL ALYORSAK ONU ALIP DIREK VALUE KARSISINA YAZABILIRIZ
/* <input type="text"  value="<?php echo get("search1"); ?>" name="search1">
Bizim avantajimiz su biz html elemntleri arasina, attribute yerine, html elemntlerinin her yerinde php yazabiliyoruz....bu harika bir ozgurluk...

SUNU IYI BILELIM...BIZ OZELLIKLE CRUD OPERASYOJLARI DELETE,EDIT ISLEMLERINDE ID UZERINDEN YAPIYORUZ DOLAYISI ILE BUNLAR DA URL UZERINDEN GELECEK
VE BIZIM BU URL DEN GELEN ID YI ALIP KULLANMAMIZ GEREKECEK NASIL YAPACAGIZ BUNU TABI KI,,,,$_GET ILE YANI KENDI YAZACAGIMZI ICERISINDE
ISSET ILE CEK ETME ISLEMI ILE BERABER BU ISLEMI YAPACAGIZ....
MESELA ID NIN INTEGER OLUP OLMADIGINI CEK EDERIZ...VE ID INTEGER DEGIL ISE BIR MESAJ ILE, ERROR MESAJ ILE DONUS YAPABILIRZ
<input type="text" name="search3">
<?php 
if(!is_int(get("id"))) : echo "ID must be just integer";
exit();//CAlismayi burda durdur ve artik bundan sonrakileri gosterme diyoruz
bu islemi cok yapmaya ihtiyacimiz olacak onun icin burayi iyi anlayalim....BESTPRACTISE....
Bu arada url de yazilan id normalde number olarak  yazilsa bile string olarak gelecektir onu id ye cevirmemiz gerekecek
endif; ?>

ya da id yi baska nasil kontrol ederiz

BURDA BESTPRCTISE LERDEN BIRID DE BIZ ID UZERINDEN ISLEM YAPTIGIMIZ ZAMAN ID NIN NUMBER OLMASINA GAYRET ETMELIYIZ
$id=(int)get("id");//integer a cevirerek al diyoruz...
if(is_int($id) || !id){//integer degil is ya da id hic yoksa demek
    echo "ID sadece sayi olmalidir";
}

<br/>

*/
?>

<form action="" method="get">

Search:
<input type="text"  value="<?php echo get("search1"); ?>" name="search1">
<input type="text" name="search2">
<input type="text" name="search3">
<?php 
if(!is_int(get("id"))) : echo "ID must be just integer";
exit();//CAlismayi burda durdur ve artik bundan sonrakileri gosterme diyoruz
endif;
?>
<br/>
<button type="submit">submit</button>
</form>