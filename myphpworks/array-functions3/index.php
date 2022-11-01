<?php 
//ARRAY_VALUES: dizimizin value lerini kendisi 0-1 index atayarak bize dondurecektir
$arr1=["name"=>"Adem", "surname"=>"Erbas"];
$res1=array_values($arr1);
//print_r($res1);//Array ( [0] => Adem [1] => Erbas )
//Aslinda biz array_values i key-anahtarlari siralamakk icin kullaniriz php de
//Ornegin bizim icerisinde tekrarlanan lemenalirimizin oldugu dizilerde sadece uniq olan 
//elementleri alabiliyorduk, ancak problem ne idi bize o degerleri, dizinin uniq yapilmadan onceki
//key leri ile getiriyor yani uniq olarak getirdigi diziyi key olarak yani index olarak 0,1,2, diye getirmiyordu
//Ki ayni durum bizim array_map ve array_filter islemlerinde de gecerli ki bu bize sorun cikaracaktir
//bazi yapacagimiz islemerde ve bizim key leri normal 0,1,2, diye alma ihtiyacimiz olacak mutlaka 
//iste bu sorunu biz array_values ile cozecegiz 

//ISTE ARRAY_VALUES COK ONEMLI BIR PROBLEME COZUM BULUYOR.....
//COOOK ONEMLI BESTPRACTIS...BUNU COK FAZLA KULLANACAGIZ...

$myarr9=["adem","erbas",34,"adem","erbas","skien",34];
//print_r($myarr9);
$res14=array_unique($myarr9);
//print_r($res14);//Dizimin icinde tekrarlanan elemntleri silerek bize 
//dizi icindeki elementleri unique olarak doner

//DIKKAT EDELIM...UNIQ OLARAK DONEN $RES14 DIZISINI ARRAY_VALUES ICINDE KULLANIRSAK
//ARTIK KEYLERI SIRASI ILE 0,1,2, DIYEREK GELECEKTIR VE BIZIM PROBLEMIMIZ COZULECEKTIR
//print_r(array_values($res14)); 

//ARRAY_PUSH DIZI SONUNE YENI ELEMAN EKLER-EKLENEN ELEMANLARI GORMEK ICIN DIZINN KENDISINI CEK EDERIZ
$arr2=[1,2,3];
$res2=array_push($arr2,"ADem","erbas");//dizi eleman sayisini donuyor bu sekilde, eklenen elemanlari gormek icin dizinini kendisini kontrol ederiz
//print_r($arr2);

//DIZIMIZE ELEMAN EKLEMEK ICIN BASKA BIR YONTEM...
$arr2[]="Skien";
$arr2[]=34;
//print_r($arr2);//Bu sekilde de element ekleyebilyoruz

//PUSH ILE EKLEMEK ILE DIGER METHOD ILE EKLEMEK ARSINDAKI FARK SUDURKI PUSH ILE BIZ ANAHTAR BELIRLEYEREK VALUE EKLEYEMEYIZ
//AMA DIGER METHOD ILE, ANAHTAR DA BELIRLEYEBILIYORUZ
$arr2["profession"]="developer";
//print_r($arr2);//BU ONEMLI BIR AYRIM DIKKAT EDELIM..

//ARRAY_UNSHIFT-DIZININ BASINA ELEMAN EKLEMIMIZI SAGLAR
array_unshift($arr2,"Norway");
//print_r($arr2);
//ANCAK BURDA DA ANAHTAR ILE EKLEYEMIYORUZ...
//PEKI DIZIMIZIN BASINA ANAHTAR ILE YENI ELEMAN EKLEMEK ICIN DE ARRAY_MERGE KULLANIYORUZ
//ANCAK SUNA DIKKAT EDELIM,,,EGER ORNEGIN BIRLESTIRECEGMIZ ARRAY LERDEN BIRI ONCESINDE BASKA 
//METHODLARA MARUZ KALMIS ISE UNSHIFT GIBI O ZAMAN MERGE ILE DE EN BASA EKLEMYEBILIR...DIKKAT EDELIM
$arr3=["company"=>"Netsense"];
// $res4=array_merge($arr3,$arr2);
// print_r($res4);
$arr4=["name"=>"Adem","surname"=>"Erbas"];
$arr4=array_merge($arr3,$arr4);
//print_r($arr4);

//Array_keys ile dizini anahtarini aliriz dizi icinde
$arr5=[
        "name"=>"Adem",
        "surname"=>"Erbas",
        "age"=>34,
        "city"=>"Skien",

];

$res5=array_keys($arr5);//array in anahtarlarina kendisi 0 dan baslayarak key atar ve bir onceki array in keylerini de 
//value olarak doner
//print_r($res5);
//Ic ice dizi de bize tum anahtarlari vermiyor..Bu eksikligi ondan dolayi ida yine her zman yaptigmiz gibi kendi
//recrusive fonksiyonumuzu yazarak, fonksiyonumuz parametre olarak dizi alsin ve fonksiyomuz icin de bir dizi olusturalim
//foreaceh yapmadan once ve sira ile gelen her keys i o dizi icine atalim bir de her bir keys in dizi olup olmadigini cek edelim ve
//eger key lerimiz arasinda dizi olan ve onun icinde de keys i olan lar var ise o zaman icinde bulundugumuz fonksiyonu tekrar invoke
//edelim... ve ayni islem cok daha kolay bir sekilde gercekklesmis olsun



//RECRUSIVE KENDI FONKSIYONUMUZU YAZMAK...
//IC-ICE DIZILERDE COK KULLANACAGIZ
    $keys=[];
function _array_keys($arr){
    global $keys;
   //static $keys=[];
   //BURDA HARIKA BIR BESTPRACTISE... KULLANDIK...BIZ HER DIZIYI INVOKE ETTGIMZDE 
   //DIZIYI YENIDEN OLUSTURDUGUNDA EGER DIZI ICINDE OLUSTURDUGMZ DEGISKENIN ALDIGI DEGERI
   //KORUMAK ISTERSEK O DEGISKENI STATIC OLARAK TANIMLARIZ YA DA BIZ $KEYS DIZI DEGISKENINI 
   //DISARDA TANIMLARIZ VE ICERDE GLOBAL KEYWORDU ILE KULLANIRZ
    foreach ($arr as $key => $value) {
        // $keys[]=$key;
        array_push($keys,$key);
        print_r($value);
        if(is_array($value)): return  _array_keys($value);
    endif;
    };
    return $keys;
};

$test_arr=[
    "a"=>"AA",
    "b"=>[
        "c"=>[
            "d"=>"DD",
        ]
    ],
];
//print_r(_array_keys($test_arr));

//CURRENT(): DIZIMIZIN ILK ELEMANINI VERIR
//END(): DIZININ SON ELEMANINI VERIR-END() I DIREK ECHO ILE EKRANA YAZDIRMAK HATA VEREBILYOR ONDAN DOLAYI DEGISKENE AKTARIP
//YAZDIRMAK DAHA MANTIKLIDIR
//NEXT- DIZININ BIR SONRAKI ELEMANINI BULUR
//PREV-DIZININ BIR ONCEKI ELEMANINI VERECEKTIR

$arr6=["adem","erbas","Skien","netsense","zehra"];
 echo current($arr6)."</br>";//adem
// echo end($arr6)."</br>";

echo next($arr6)."</br>";//erbas-ilk next kullaniminda current ne ise ki current da default olarak ilk value dir
echo next($arr6)."</br>";//Skien-2.next kullaniminda bir sonraki elementi kullaniyor
echo next($arr6)."</br>";//netsense
//Simdi next degistikce previous da ona gore degisiyor next ne ise previous onun bir oncsindeki element oluyor dikkat edelim
echo prev($arr6)."</br>";//Skien
echo prev($arr6)."</br>";//erbas
echo prev($arr6)."</br>";//adem
echo getType(prev($arr6))."</br>";//Dizinin en basina geldi ve yine prev dedi isek en bastaki elemantin previous u olmadigi icin
//bize boolean olarak false donecek
//Peki biz next ile ornegin 3. veya 4. index e kadar geldik ve sonrasinda tekrar next in default olarak basladigi gibi
//baslamasini istersek o zaman da reset methodunu kullaniriz
reset($arr6);
echo "###############################################</br>";
//Bir onceki next, previous lari hic gormez..cunku resetledik basa aldi
echo next($arr6)."</br>";//erbas

//CURRENT VE END METHODLARI COK ISIMIZE YARAYACAK

//EXTRACT METHODU BIR DIZIDEKI ANAHTARLARI DEGISKEN GIBI KULLANMAMIZI SAGLIYOR
$arr6=[
    "name"=>"adem",
    "surname"=>"erbas",
];

//HARIKA BIR KULLANIM BUNU COK FAZLA KULLANAAGIZ...DIZIMIZIN ANAHTARLARINI DISARDA DEGISKEN OLARAK KULLANABILYORUZ
extract($arr6);

echo $name."</br>";//adem
echo $surname. "</br>";//erbas

//SIRALAMA FONKSIYONLARI
//SORT- DIZI DEGERLERINI KUCUKTEN BUYUGE A- DAN Z YE SIRALAR
//R-SORT ISE DIZI NIN DEGERLERINI BUYUKTEN KUCUGE- Z DEN A YA DOGRU SIRALAMA YAPAR
//ASORT-asort() - anahtarlı dizilerde, anahtarın değerine göre artan bir şekilde sıralar
//ARSORT-anahtarlı dizilerde, anahtarın değerine göre azalan bir şekilde sıralar
//$arr8=[1,6,3,2,7,5];


$arr=[3,1,6,4];
print_r($arr);
//asort($arr);
rsort($arr);
print_r($arr);


$age=["Peter"=>38,"Ben"=>37,"Joe"=>39];
asort($age);
print_r($age);



$sayilar = array(5,11,9,19,2);

sort($sayilar);

print_r($sayilar);
//KSORT-DIZIDEKI ANAHTARLARA GORE KUCUKTEN BUYUGE DOGRU SIRALIYOR

// sort() - dizi elemanlarını alfabetik ya da sayısal açıdan artan bir şekilde sıralar
// rsort() - dizi elemanlarını alfabetik ya da sayısal açıdan azalan bir şekilde sıralar
// sort(); ve rsort();
// Diziyi elemanların değerlerine göre alfabetik olarak sıralar, Dizinin anahtarlarını yeni sıralamaya göre düzenlerler. 
//sort ile düz alfabetik sıralama, rsort ile ters alfabetik sıralama yapılır.


// asort() - anahtarlı dizilerde, anahtarın değerine göre artan bir şekilde sıralar
// arsort() - anahtarlı dizilerde, anahtarın değerine göre azalan bir şekilde sıralar
# asort(); ve arsort();

// Diziyi eleman değerlerinin alfabetik sıralamasına göre düzenler ama anahtarları değiştirmezler.
// Düz sıralama için asort, ters sıralama için arsort kullanılır.




// ksort() - anahtarlı dizilerde, anahtara göre artan bir şekilde sıralar
// krsort() - anahtarlı dizilerde, anahtara göre azalan bir şekilde sıralar
# ksort(); ve krsort();

//Diziyi elemanların anahtar değerlerine göre sıralar ve anahtarları değiştirmezler. 
//ksort artan sıralama, krsort azalan sıralama yapar.
?>