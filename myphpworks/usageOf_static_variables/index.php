<?php 

function myCount(){
  $number=1;
   echo $number . "<br>";
   $number++;
};

myCount();
myCount();
myCount();
myCount();
myCount();
myCount();
myCount();



//STATIC DEGISKEN...COK EFEKTIF KULLANABILIYORUZ...
//Eger biz burda bu sekilde kullanirsak o zaman her fonksiyon calistiginda, iceisinde yeni bir number degiskeni olusturacaktir ve 
//numer degiskeni her fonksiyon invoke edildiginde number degerini 1 atayarak baslayacaktir..
//AMA BIZ EGER KI SUNU ISTERSEK, EGER BIZIM INVOKE EDECEGIMIZ FONKSIYON DAHA ONCE EN SON INVOKE EDILDIGINDE ICERISINDE NUMBER DEGERI
//VAR MI ONA BAKSIN VE EN SON NUMBER HANGI DEGERDE KALDI ISE O DEGERDEN DDEVAM ETSIN ISTERSEK O ZAMAN ISTE STATIC KEYWORDU DEVREYE GIRECEKTIR
//BU MANTIGI BIZ C# DAKI CLASS LAR ICINDE TANIMLADIGIMZ STATIC DEGISKENLER O CLASS LARDAN OLUSTURULAN TUM INSTANCELERDE DEGERINI KORUYARAK
//BIR ONCEKI INSTANCE DE KAC DEGERINDE ISE ONU ALACAKTIR BU YOLLA BIZ BIR CLASS TAN URETILEN INSTANCELER ARASINDA EGER DINAMIK BIR YAPI VS OLUSTURMAK ISTERSEK OLUSTURABILIYORDUK
//BIZE BAZI DURUMLARDA COK HARIKA VE EFFEKTIF COZUMLER URETEBILMEMIZI SAGLAYACAK BIR YAPIDIR BU....
//YANI BU ASLINDA SU DEMEK, BIZ BU SAYEDE, PRIMITIVE TYPE IMIZI AYNI REFERANST TYPE GIBI KULLANABILIYOURZ, YANI IMMUTABLE OLAN DEGER TIPI
//MUTABLE OLARAK KULLANIYORUZ...ASLINDA DURUM BU....

echo "</br> "."-------------------------------"."</br>";

function myCount2(){
   static $number=1;
     echo $number . "<br>";
     $number++;
  };

myCount2();
myCount2();
myCount2();
myCount2();
myCount2();
myCount2();
myCount2();


function load($value){
    static $loaded=[];
    $loaded[]=$value;
    return $loaded;
};

//AYNI MANTIKTA EGER BIR DIZIYI BIZ STATIC YAPARSAK DA HER FONKSIYONMUZ INVOKE EDILDIGINDE, PARAMETREDEN GIRILEN YENI DEGERI
//DIZI ICINE EKLEYE EKLEYE GIDIYOR VE EN SON HANGI FONKSIYON INVOKE EDILDI VE ORDA FONKSIYON ICINDE STATIC OLARAK TANIMLANAN
//$loaded dizi si icinde hangi degerler var ise o degerler i alarak devam ediyor bir sonraki invoke isleminde...evet bu cok enteresan ve
//bize cok ciddi inanilmaz cozumlerde  yardimci olacaktir...
$res=load(5);//[5]
$res=load(6);//[5,6]
$res=load(7);//[5,6,7]
$res=load(8);//[5,6,7,8]
$res=load(9);//[5,6,7,8,9]
$res=load(10);//[5,6,7,8,9,10]
print_r($res);//Array ( [0] => 5 [1] => 6 [2] => 7 [3] => 8 [4] => 9 [5] => 10 )

?>