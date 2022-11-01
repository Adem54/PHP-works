<?php 

//strlen-bir ifadenin karakter sayisin bize veriyor
$str="Adem Erbas";
echo strlen($str);//10 karakter

//strstr: Bir text icinde parametreye verdgmiz string degeri ve ondan sonraki textin devamini getirir
//Var ise o degeri yok ise false yani 0 donuyor(0 i ekran da gostermior php)
echo strstr("adem erbas","dem");

//strpos:Uzun bir text icinde aradgimiz bir karakterin kacinci karakter de oldgunu verir
echo strpos($str,"e");

//ucwords- her kelimenin bas harfini buyutmek icin kullaniliyor
echo "</br> -----------------ucwords------------- </br>";
echo ucwords("adem erbas skien");

echo "</br> -------------------------- </br>";

//ucfirst icerisine verilen string bir textin ilk kelimesinin bas hafrini buyuk yapar
echo ucfirst("adem erbas skien");//Adem erbas skien

//strtolower-buyuk yazilan karakterleri kucuge cevirir
//strtoupper-kucuk yazilan karakterleri buyuge cevirir
echo "</br> -------------------------- </br>";

echo strtolower("ADEM ERBAS SKIEN");
echo "</br> -------------------------- </br>";

echo strtoupper("adem erbas skien");

//COK KULLANISLIDIR COK ONEMLI COK IHTIYACIMZ OLABILIR
//trim: string bir ifadenin sag ve sol bosluklarini temizler
//ltrim:string bir ifadenin soldaki bosluklarini temizler
//rtrim: string bir ifadenin sagdaki bosluklarini temizler

$str2="     adem      ";
echo "</br> -------------------------- </br>";
echo strlen($str2);
echo "</br> -------------------------- </br>";
echo strlen(trim($str2));


$str3="@      adem    @    " ;

echo "</br> -------------------------- </br>";
trim($str3,"@");
//trim ile en basta ve en sonda kullanilmis olan ozel karakteri de yok edebilyrouz
//trim methodu string ifadenin kendisnde degil, return olarak dondurdugu deger de degiskligi gorebiliriz
//ondan dolayi direk str3 u yazdirirsak trim isleminden sonra, degiskligi goremeyiz cunku trim string ifadenin kednisne
//dokunmuyor yeni bir string ifade donuyor
echo trim($str3,"@");

//substr- string ifadeyi bolmemizi sagliyor
$str4="Adem Erbas Skien ";
echo "</br> -------------------------- </br>";

echo substr($str4,0,4);//0 dan basla index olarak ilk 4 karakteri getir diyoruz
echo "</br> -------------------------- </br>";
echo substr($str4,0,-4);//En son karakterden basa dogru 4.karakterden baslayip en basa kadar olan karakterleri alir

//strreplace(): stringmiz icerisinde herhangi bir bolumu degistirebilmemizi sagliyor

$str5=" adem erbas skien";
echo "</br> -------------------------- </br>";
echo str_replace("adem","zehra",$str5);//zehra erbas skien
//Birden fazla donusturmek istersem parametreye dizi de kullanabiliriz
echo "</br> -------------------------- </br>";

//$str5 icindeki adem i sercan ile, erbas i kavas ile, skien i de stavenger ile degistir diyoruz
echo str_replace(
    ["adem", "erbas","skien"],
    ["sercan","kavas","stavenger"],
    $str5
);

//str_repeat: bir karatkteri istedgimz sayida tekrar yazmamizi sagliyor
echo "</br> -------------------------- </br>";
echo str_repeat("*",10);//* karakterini 10 kez kullan diyoruz


//BESTPRACTISE...ORNEK...
//Bunu nerde kullaniriz en cok sinirsiz kategori yaparken kullanabiliriz
//5 ten sonra da tersten saymaya baslasin diyebilirdik
for ($i=1; $i <=10 ; $i++) { 
    //i sirasi ile artmaya devam ediyor ama biz i nin degerini 5 i gectikten sonra onu 10 dan cikararark
    //5 den geriye dogru saymasini sagalmis oluyoru aslinda...
    ($repeatCount=$i<=5 ? $i : (10-$i));
    echo str_repeat("*",$repeatCount)."</br>";
}
?>