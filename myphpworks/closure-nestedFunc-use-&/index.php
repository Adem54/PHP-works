<?php

//Closure mantigini anlayalim....
//PHP  burda da javascriptten ayriliyor cunku php de ic fonksiyondan dis fonksiyona erisim yoktur
//Aynen degisken de oldugu gibi, dis ebevyndeki degiskene bizimi icerdeki fonksiyyondan erisebilmemmiz icin
//global, veya $GLOBALS[]  keywordlerini kullanmamiz gerekiyordu ayni sekilde yine icerdeki bir fonksyondan 
# disardaki fonksiyona ait parametre vs gibi seylere erisebilmek icin ise yine use keywordu kullanmak gerekiyor


/*
Javascriptte kullanim mantigi bu sekilde idi 

var addOne = function(num) {
    return function() { 
        console.log(num++); 
    };
};

var f = addOne(1);

f(); // 1
f(); // 2
f(); // 3

COOOK ONEMLI PHP DILININ JAVASCRIPTTEN FARKLILIKLARI.......

Ama php burda javascriptten ayrildigi icin ayni sekilde php de kullanamiyoruz
Yani esasinda javascriptteki closure olayinda dikkat edilecek husus sudur ki parametre mutable, yani referans tip gibi davraniyor
primitive type olmaasina ragmen ve surekli olarak ayni deger uzerine eklenerek degistiriliyor...
Iste bunu da direk php de uygulayamiyoruz bunu php de uygulayabilmek icin ise yine, & reference sembolunu kullanmamiz gerekir...
*/
echo "</br>". "................" . "</br>" ;

$number2=5;
$myNewArr=range(1,10);
//Dikkat edelim array_map bir fonksiyon ve onun icerisinde kullandgimiz fonksiyon icinde disardan deger almak istedgimz de 
//use keywordunu kullaniyoruz....cook onemlidir bu....BIZ array_map ile cok effektif islemler yapabilecegiz...
$myRes=array_map(function($number)use($number2) {
    return $number+10+ $number2;
}, $myNewArr);

echo "</br>". "  MYNEWARR  " . "</br>" ;
print_r($myRes);//Array ( [0] => 16 [1] => 17 [2] => 18 [3] => 19 [4] => 20 [5] => 21 [6] => 22 [7] => 23 [8] => 24 [9] => 25 )

echo "</br>". "  USE KULLANIM- BIR ANONIM FONKSIYONU BIR DIGERININI ICERISINDE KULLANABILMEK.....   " . "</br>" ;

$test1=function($par){
    return "test" . $par;
};

$test2=function() use($test1){
    return "test2" . $test1("test1-parameter");
};

echo $test2();//Goruldugu gibi....bir fonksiyon icinde bir diger fonksiyona ait bir parametre, variable ve direk fonksiyonun kendisini kullanmak
//use keywordu ile mumkun olyor


//Fonksiyonlarda bilmemiz gereken cok onemli bir nokta fonksiyonlar cagrildiklari zaman icinnde bulunan parametre ve degiskenler olusturulur
//Fonksiyon bittigi zaman da icerisinde kullanilan tum degiskenler hafizadan silinir....(class lar daha farkli calisiyordu bunu unutmayalim..C# da ozellikle)


echo "</br>". "................" . "</br>" ;

//Arraymap ile dizi icindeki her bir elemente filtre uygulamak istedigmiz de kullaniyorduk
//array_map ile dizilerimiz icindeki elementleri filtreleyebiliyoruz
$myArr=["Adem", "Zeynep", "Zehra"];
 function filterMyArr($item){
    return $item . "  Erbas";
 }


//$myArr2=array_map($filterMyArr,$myArr);
$myArr2=array_map('filterMyArr',$myArr);//Array ( [0] => Adem Erbas [1] => Zeynep Erbas [2] => Zehra Erbas )

print_r($myArr2);
echo "</br>". "................" . "</br>" ;

//Anonim fonksiyonlari biz daha cok callback islemleri icin kullaniyoruz php de...
//Ornegin bir dizi elemanlarinin her birisine biz anonim fonksiyonmuz araciligi ile 2 ile carpmak istiyoruz...

$multipleBy2=function($a){
    return $a*2;
};

//Sayi araligi belirliyoruz

$numbers=range(1,5);//[1,2,3,4,5] disizi olusturur

print_r($numbers);

//Tam olarak esasinda sunu yaptiriyoruz...  ilk paramtre her bir dizi elemanina ne uygulayacag, hangi isleme tabi tutacagiz
//2. si de hangi dizi elemnlarina bu islemleri uyugulayacak isek onu kullanacagiz..
$new_numbers=array_map($multipleBy2,$numbers);//[2,4,6,8,10]



echo "</br>". '-------' ."</br>";
print_r($new_numbers);
echo "</br>". '-------' ."</br>";
print_r($numbers);
//DIKKAT EDECEK OLURSAK, CALLBACK FONKSIYONU, CLOUSER ANONIM FONKSIYONU ILE ISLEME GIREN DIZI NIN KENDISI DEGISMIYOR, 
//YANI REFERANSI DEGISEREK BASKA BIR REFERANS TA SONUC DONDURUYOR...BUNU BILELIM....


//PHP NIN FARKLILIKLARINDAN BIRIDE DEGISKENLER DIREK OLARAK DEGISKEN HALI ILE STRING ICINDE KULLANILABILIYORLAR
//BIRDE TIRNAK ICINDE KULLANIM COK FAZLA VE BUNLAR, DINAMIK ELEMENTLER OLABILIYORLAR ORNEGIN BIR DIZI TANIMLARKEN
# KEY-VALUE MANTIGINDA TANIMLAYABILIYORUZ VA KEY LERI DE ISTEDIGMZ GIBI ATAMA YAPABILIYUORUZ VE KEY LER TIRNAK ICINDE YAZILIYR

//ANONIM FONKSIYONLAR COOK ISIMIZE YARAYACAK COK EFFEKTIF BIR SEKILDE KULLANABILIYORUZ...
//BIZ ARRAY LER ILE COK FAZLA CALISACAGIZ VE ARRAY ICERISINDE BULUNAN ELEMENTLERIMIZ COK FAZLA MANIPULE ETME ISLEMI YAPCAGZ
//DOLAYISI ILE BU TARZ DURUMLARDA HEP ANONIM FONKSIYONLAR DEVREYE GIRECEK ISTE...


//JAVASCRIPT MANTIGINDA CLOSURE KULLANIMI....BESTPRACTISE...COOOOK ONEMLI...

echo "</br>". '--use ve references(&) kullanimi----' ."</br>";
$addOne=function($num) {
    return function() use(&$num){
        echo $num++;
    };
};

//BESTPRACTISE....
//Javascriptteki Closure mantigini uygulamak istersek yani bir onceki calisan fonskiyona ait degeri alsin ve onun uzerinden
//fonksiyonu calistirsin dersek o zaman iste parametreye & ifadeyi kullaniriz...

$f=$addOne(1);//Gelen parametre ile donen degeri fonksiyon gizli bir sekilde tutuyor ve bir sonraki fonksiyonda o degeri 
//kullaniyor parametrede dolayiisi ile de bu normal birsey degil zaten...ama advance bir durum bunu anlamak coook onemlidir.
//Ortada bir tane fonksiyon var ama birden fazla ayni fonksiyonu cagirma durumu var, enteresan bir sekilde parametresiz bir fonksyon
//olmasina ragmen her cagirildiginda, beklenenin aksine farkli sonuclar veriyor iste bu javascript  closure mantiginin aynisidir 
$f();//1
echo "</br>";
$f();//2
echo "</br>";

$f();//3
