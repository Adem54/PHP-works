<?php
//Php de onden tanimli diziler bulunmaktadir onlarla cok isimiz olacak


$name="Adem";
$lastname="Erbas";
$age=34;

/*
Dizi tanimlama
1-Php den gelen array fonksiyonu kullanarak
2-[] kullanarak

array icindeki eleman sayisini count() methodu veya sizeof() methodu icerisine
diziyi yazarak dizi uzunlugunu alabiliriz


array leri string ifade gibi ekrana direk basamiyoruz, dongu leri kullanmamiz gerekiyor
*/


$myInfo=array($name,$lastname,$age);

//Dizileri oldugu gibi yazdirabilmek icin print_r fonksiyonunu kullaniriz...
print_r($myInfo);//( [0] => Adem [1] => Erbas [2] => 34 ) 
//Dizilerde index ler mevcuttur, ancak bunlara key de diyebiliriz....bu degerleri kendisi otomatik verir eger biz vermezsek
//Ancak biz istersek kendimiz de verebilriiz bu degerleri


//BURASI COOK ONEMLIDIR...
$myInfo2=array(

2 => "Zehra",
    3=>"Erbas",
    5=>  9,
    "designer"//Bir onceki index numarasi var mi ona bakar eger bir numara gorurse onu 1 arttirip index veya key numarasi verir
    //Eger bir oncekinde key olan data sayi degil ise o zaman, index veya key i kendimzi atamadi isek kendisi 0 index numarasi atayarak baslayacaktir
);


print_r($myInfo2);//Array ( [2] => Zehra [3] => Erbas [5] => 9 ) 
//Dizilerde biz index yerine ayni C# daki dictionary sinifi gibi kullanabiliriz..


$name="";
$surname=""; 
$age=0;
$myInfo3=array(

    'name'=> "Zehra",
     'surname' =>"Erbas",
        'age' =>  9
    );

print_r($myInfo3);//Array ( [name] => Zehra [surname] => Erbas [age] => 9 )

//Yani kisacasi biz php de array lerde index yerine key mantiginda kendi istedgim degerleri vererek
//ayni javascriptteki obje gibi kullaniyoruz yani her bir value degerinin bir de key i var oluyor 
//Bu tam olarak ayni C# daki Dictionary sinifinin aynisidir...

//Bu arada array tanimnini hem array() ile hem de [] ile yapabilyoruz

$arr=["Kazim","Sercan","Serdar"];
$arr2=["name1"=>"Kazimn","name2"=>"Sercan","name3"=>"Serdar"];
// Array ( [name1] => Kazimn [name2] => Sercan [name3] => Serdar )

print_r($arr2);


// for ($i=0; $i <sizeof($myInfo); $i++) { 
//     # code...
//     echo $myInfo[$i];
// }



// for ($i=0; $i <count($myInfo); $i++) { 
//     # code...
//     echo $myInfo[$i];
// }



//IC ICE DIZILERI KULLANMA-
//BIZIM GENEL BIR KATEGORIMIZ VAR E-TICARET SITELERIM VAR ONUN ALTINDA DA EGITIM SITELERIMI KATEGORILERM VAR
//E-TICARET ALTINDA BIRCOK FARKLI KATEGORI VAR YANI SUB KATEGORI DEN BAHSEDIYORUZ..
//BU TARZ DURUMLARDA , ORNEGIN NAVBAR YAPIMINDA, ANA MENULER OLACAK HER BIR ANA MENU ALTINDA BELKI DE SUBMENU VE O SUBMENU ALTIND DA
//SUBMENU  NUN SUBMENUSU BULUNACAK BU TARZ DURUMLARDA KULLANMAMIZ GEREKECEK MUTLAKA...ARRAY ICIN DE ARRAY

$categories=[
        'websites'=>[
            'e-commercielle'=>[
                "finn",
                "N11",
                
            ],
            'education'=>[
                    "udemy",
                    "academy"
            ]
        ],
        
];

echo "------------------";
echo $categories['websites']['education'][1]  ;//academy
echo "------------------";

print_r($categories);
//Array ( [websites] => Array ( [e-commercielle] => Array ( [0] => finn [1] => N11 ) 
//[education] => Array ( [0] => udemy [1] => academy ) ) )



//SABIT DEGISKENLERDE DIZI KULLANIMI
define("name","Adem");//Sabit degiskenler i bu sekilde tanimlariz ve tirnak olmadan kullanriiz
$test=name;
echo $test;

define('member', [
    'name'=> "Adem",
    "surname"=>" Erbas",
    'age'=> 34,
    "developer"//index veya key olarak 0 dan baslar bir onceki ndeki key veya index yerinde bulunan deger
    //age string oldugundan dolayi
]);

echo "..........................";

print_r(member);

?>