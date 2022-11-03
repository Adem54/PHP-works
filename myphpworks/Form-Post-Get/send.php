<?php 
/*Post methodu ile html den php sayfasina gondeirlen datalar
$_POST degiskeni icerisine gonderiliyor $_POST degiskeni bir dizidir 
bu dizi icerisine gelecek gonderilen tum datalar html sayfasindan

{
name: "adem",
about: "asdfasdfasdfasdf",
profession: "",
gender: "man",
interesets: {
0: "php",
1: "php"
},
profession2: {
0: ""
}
}

Dikkat edelim $_POST dizisi icerisine dizi olarak gelmesini istedigmiz html elemntleri nde 
name attributunde name attributunun onune [] indexer yani koseli parantez koyariz
$_POST dizisi icerisine gelen data key olarak, input icindeki name attributune yazdimgz degerdir
value ise kulllanicinin input alanlarina girdigi degerdir...COK ONEMLI..TEKRAR HATIRLATALIM
DIZI OLARAK, EGER $_POST DIZISININ ALTINA BIR DEGERIN GELMESI ICIN NAME ATTRIBUTUNDE [] KOSELI PARANTEZ ILE
BELIRTILMESI GEREKIR

BU SAYFADA YAPILAN ISLEM MANTIGI GENELLIKLE DATALAR GELMIS MI KONTROL ETMEKTIR YANI ONU DA ISSET ILE ISSET($_POST) DIYE
$_POST ICINE DATA GELMIS MI ARDINDAN DA BEKLEGIMIZ HER BIR NAME I $_POST[""] YAZARAK CEK IF ILE SORGULAYABILIRZ ASLINDA
VE ONA GORE BIR TEPKI VERMEK ICN AYRICA DA VALIDATION ISLEMIN I YAPABILMEK ICIN
AYRICA $_POST[""] ILE DE CEK EDEBILIRZ VEYA IF LOGICI YAZABILIRZ 

BURDA KULLANICI GERCEKTEN BIRSEY GIRMIS MI GIRMEMIS MI KONTROL EDEBILME ADINA
KULLANABILECEGIMIZ METHOTLAR VAR ORNEGIN
OLABILECEK TEHLIKELER
1-KULLANICININ SPACE TUSUNA BASIP BOS TEXTLERI SANKI VARMIS GIBI GONDERMESI
KULLANICI GIDIP ABOUT TEXTAREA YA BOS BOS BASIP SUBMIT DESE SPACE TUSUNA BASMA DA BIR KARAKTER OLDUGU ICIN IF ELSE DE TRUE OLARAK GECECEKTIR
ONDAN DOLAYI BIZ DEGERLERI KONTROL EDERKEN BOSLUKLARI SILEREK KONTROL EDELIM KI KULLANICI HICBIRSEY YAZMADAN OLUR DA BOSLUKLA GONDERIRSE ONU
SANKI DEGER MIS GIBI KABUL ETMEYELIM
2-KULLANICININ TEXAREA VEYA INPUT LAR IICNDE HTML ETIKET YAZMASI BU COK TEHLIKELIDIR
BUNU DA ONLEMEMIZ GEREKIR...BUNU NASIL ONLERIZ
strip_tags($_POST["about"]); bu sekilde kullanirsak html etiketleri otomatik olarak silinecektir
ya da 
$about=htmlspecialchars($_POST["about"]);
seklinde yazarak html kodunu zararsiz hale getirebiliriz..
daha sonra yazilan html i tekrar almak istersek asagidaki gibi yazariz ve tekrar onu html halini almis oluruz
htmlspecialchars_decode($about);

3-BU YUKARDA YAPTIKLARIMIZ YINE YETERLI BIZIM HER GELEN FORM ELEMENTI ICIN FILTRELEME ISLEMI YAPMAMIZ GEREKIR
NE YAPARIZ O ZAMAN BU POSTUMUZ SONUCTA BIR DIZI VE BIZ BU DIZI ICERISINDEKI ELEMNTLERI TEK TEK CEK ETMEKK ICIN ARRAY_MAP KULLANABILIRIZ
FILTRELEM ISLEMI DENILINCE, AKLIMIZA YA ARRAY_MAP YA DA ARRAY_FILTER GELIYOR
*/
//strip_tags($_POST["about"]);


//Dikkat edelim gelen datayi bu sekilde filtreleyebiliriz
//Burda bir problemimiz var, trim parametresine gleen bazi $_POST elementleri
//array olarak geliyor ondan dolayi trim de hata aliriz peki burda ne var dikkat edelim...nested
//array var yani array icinde array var ondan dolayi sorun yasiyoruz belki gelen array icinde de baska bir array olacak
//Peki o zaman ne yapcagiz aklimiza ne gelmeli...RECRUSIVE FONKSIYONLAR...ISTE BIZIM SORUNUMUZU COZECEK OLAN RECRUSIVE 
//FONKSIYONDUR...BU SEKILDE BIZ BU PROBLEMI COZEBILIRIZ....HARIKA BESTPRACTISE...ISTE RECRUSIVE FONKSIYONUN GERCEK HAYATTA 
//KARSIMIZA CIKACAGI YERLERDEN BIR TANESI...HARIKA BESTPRACTISE....
//YANI DIZI ELEMNLARINI CEK ET HER BIR ELEMENINI SIRA ILE CEK ET O DA BIR DIZI MI DIYE VE O DA BIR DIZI ISE O ZAMAN BIR USTTEKI
//DIZIYI HANGI FONKSYONLAS ISLEME ALDI ISEK YANI ICIN DE BULUNDUGMUZ FONKSIYONU INVOKE EDECEGIZ AMA TEK FARK ILE NE ILE
//PARAMETREYE SU AN ICINDE BULUNDUGMUZ DIZINI ILK ELEMENTLERINDEN DIZI OLAN HANGIS ISE ONU VERECEGIZ VE TEK TEK ELEMNLARI GEZERKEN
//EGER DIZI OLAN BIR ELEMENT ILE KARSILASIR ISE AYNI SEKILDE ICINDE BULUNDUGU FONKSIYONU INVOKE EDECEK VE PARAMETREYE O KARSILASTIGI DIZIYI VERECEK
function form_filter($post){
 return is_array($post) ? array_map("form_filter",$post)  : htmlspecialchars(trim($post));
 //Burda su cook onemli kullanici html yazamamasi gerekir...cok onemlidir
}

$_POST=array_map("form_filter",$_POST);

//YUKARDAKI INPUT SAYFASINDAN GELEN DATALARI HANDLE ETME OLAYI BESTPRACTISE DIR COK HARIKA BIR ISLEMDIR
//BESTPRACTISE..DIR...

//ISSET KULLANARAK HATA ALMADAN DATALARIN GELIP GELMEDIGNI KONTROL EDEBILIYUORUZ....H
//BIZIM BIR ISLEMIMIZ DAHA VAR HANDLE ETMEMIZ GEREKEN
//ORNEGIN BIZ BIR DATANIN GONDERILIP GONDERILMEDIGINI BILMIYORUZ ONU $_POST() ICINDE ALMAYA CALISIRSAK HATA ALIYORUZ
//BUNU DA HANDLE ETMEMIZ ICIN ISSET($_POST[$NAME]) ILE KONTROL EDERIZ VE BU SEKILDE DATA GELMIS MI GELMEMIS MI ANLAYABILIRIZ


//ISSET ILE KULLANDIGMIZ ICIN ASAGIDAKI FONKSIONUMUZDA HERHANGI BIR HATA ALMIYORUZ...
//BIR DATA NIN GELIP GELMEDIGIIN I KONTROL EDEN BIR FONKSYON YAZARIZ VE O FONKSIYONUMJUZ TUM DATALARI CEK ETMEDE KULLANABILIRIZ
function post($name)
{
    if(isset($_POST[$name]))
    return $_POST[$name];
};

echo post("test");//Eger test diye bir name den data gonderilmemis ise o zaman burasi bos gelir
print_r($_POST);

//PEKI BIZ FORM ELEMNTLERINE KULLANICININ TIKLAYIP TIKLAMADIGI YANI GONDERIP GONDERMEDIGINI NASIL KONTROL EDEBILIRIZ
//KULLANICI BUTONA TIKLAR ISE SUBMIT BUTONUNA BIZE DATA NIN GELMMESI GEREKIR O ZAMAN SUBMIT BUTONUNUN NAME INDE NE VAR ISE 
//ONU KONTROL EDERIZ SUBMIT 

if(post("submit")){
    print_r($_POST);
};

//AYRICA EGER BIZ FORM DA METHODU VERIP AMA ACTIONU BOS BIRAKIRSAK YINE AYNI KENDI BULUNDUGU SAYFAYI YENILEYIP ICINDE BULUNDUGU SAYFAYA
//GELECEK DATALAR....YANI BIZ INDEX.PHP SAYFASINDA YINE AYNI SAYFA DAN AYNI SAYFAYA GONDERILEN DATALARI DA ALABILIRIZ
//TABI KENDI SAYFASI ICINE TEKRAR GONDERILIRSE DATALAR, DATALARI BIZ ZATEN $_POST DIZI ICINDE OLACAGI ICIN BIZ DIREK DATAYLARI ISTEDIGMIZ GIBI 
//ALIP GIDIP INPUT ELEMNTLERI VALUESINE YAZARAK DINAMIK BIR SEKILDE ORDA KALSINLAR DIYEBLILIRIZ


//SELECTED-CHECKED GIBI DEGLERI NASIL KONTROL EDECEGIZ....
//REACT ILE  YAPTIGIMIZ SEYIN AYNISINI PHP ILE YAPARIZ
/*  <option <?php echo post("profession")=="web-developer" ? "selected" : "" ?>  value="web">Backend developer</option>
Eger kullanici, web-developer i secmis ise o zaman o post edilmistir ve biz bunu alabilmisiszdir ve burda da true gelerek 
selected olur ya da eger secilmemis ise o zaaman da false olur ve selected olmaz....

CHECKBOX LAR NASIL KONTROL EDILECEK, ONLAR ARRAY ICERISINDE OLACAK CUNKU [] ILE GONDERILIYOR
BESTPRACTISE....COK HARIKA BESTPRACTISE...BUNLARI COK IYI ANALIZ EDELIM BU SEKILDE KULLANACAGIZ...BU MANTIK ILE KULLANACGAIZ...
    <input type="checkbox" name="interesets[]" value="php">PHP

    DIZI ICINDE OYLE BIR ELEMNT VAR MI DIYE ARAYABILIRZ VE VAR ISE TRUE GELIR YOK ISE FALSE
    O ZAMAN BIZ ARRAY ICINDE BIR ELEMANIN VAR OLUP OLMADINGI KONTROL ETTIMIZ IN_ARRAY METHODUNDAN FAYDALANABILIRIZ
    <input <?php echo post("interests") && in_array["php", post(interests)] ? "checked" : " "   ?> type="checkbox" name="interesets[]" value="php">PHPET ILE

*/
?>