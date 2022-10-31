 <?php   
 # declare(strict_types=1);
//1-array_map dizi methodu=>Cok fazla kullanacagiz...bunu unutmayalim...coook onemli..
//array_map dizi icindeki her bir elementi alip uzerinde bir update,edit islemi yaparak bize geri dondriyor
$arr=[1,2,3,4,5];
function filter_my_arr($value){
    return $value*2;
}
$arr2=array_map("filter_my_arr",$arr);
//print_r($arr2);//Array ( [0] => 2 [1] => 4 [2] => 6 [3] => 8 [4] => 10 )


//array_filter
//icerisinde bosluklar olan dizinini bosluklarini kaldirdi


//Dikkat edelim, filtreleme
$myArr=["","adem","","erbas"];
//print_r($myArr);
//array_filter aradaki bosluklari kaldirdi ve bize 2 elemenli, 1.si adem, 2.si erbas olan bir dizi verdi
//Ancak neye dikkat edecegiz, filtrelemeden once, dizi icindeki elementlerin key leri ne ise 
//filtrelendikten sonraki dizi icinde o key ler ile gelecek value ler, yani filtrelenince yeni bir dizi mantiginda 
//key ler degismez
/*{
1: "adem",
3: "erbas"
}, */
$myArr=array_filter($myArr);
//print_r($myArr);

$arr3=[1,2,3,4,5];
$arr4=array_filter($arr3, function($item){
    return $item>2 && $item<5;
});
//print_r($arr4);//["2"=>3, "3"=>4];

//array_filter
//print_r($arr4);//2,3,4

$arr5=[1,2,3,4,5];

//DIKKAT EDELIM..ARRAY_MAP ILE ARRAY_FILTER IN FARKINA DIKKAT EDELIM
//Burda array_filter methodu ile if condition i ile 2 den buyuk 5 ten kucuk 
//dedigimzde dizinin 3 ve 4 numarali elemanlairni kendi key leri il e berarber getiriyor
//Ancak array_map dersek o zaman sartimiza uymayanlarin key leri geliyor ama sarta value uymadigii icin bos geliyor 
//sarta uymayanlar bos string olarak geliyor ama dizi eleman sayisi aynen geliyor ancak iste sarta uymayanlarin key leri de var ama
//value olarak "" BOS geliyor 
//ARRAY_MAP-DIZI SAYISI DEGISMIYOR SADECE SARTA UYMAYANLARI BOS GETIRIYOR
//ARRAY_FILTER-SARTA UYMAYANLARI DIREK DIZIDEN CIKARIYOR AMA GETIRDIKLERINI DE FILTRELEMEDEN ONCEKI KEY LERI ILE BIRLIKTE GETIRIYOR
$res4=array_map(function($value){
    return $value>2 && $value<5;
},$arr5);

echo "</br> ...............................................      "."</br>";

// print_r($res4);
 echo "</br> ...............................................      "."</br>";

echo "ARRAY_MERGE";
$my_arr1=[1,2,3];
$my_arr2=[4,5,6];
$res5=array_merge($my_arr1,$my_arr2);//Iki diziyi birlestirir
//print_r($res5);
echo count($res5);

//Dizi icinden rastgele eleman secmemizi sagliyor
$my_arr3=[
    "id"=>1,
    "name"=>"adem",
    "surname"=>"erbas",
    "age"=>34,
    "city"=>"Skien",
];

//ARRAY_RAND ILE RASTGELE SECILEN SAYI KADAR DIZININ ANAHTARLARINI DONER
$random=array_rand($my_arr3,2);//Rastgele 2 tame elemani onun 
//Bize burda anahtari donuyor dikkat edelim...
//{0: "name",1: "surname"}
//Array_map ile bir isleme tabi tutalim..

//Bu arda array_filter da value ler i alyor, parametre icindeki callback function
// $res6=array_filter($my_arr3, function($key){
//         echo $key. "</br>";
// });

//RANDOM OLARAK SECILEN KEY LERIN VALUE LERINE ARRAY_MAP ILE ERISMEK
//array_rand ile rastgele olarak bizim verdgimz sayi kadar dizi icinden anahtar secip getiriyor 
//tabi anahtarlara da kendisi 0,1 index leri anahtar olarak atiyor yani dizinin ilk halinde anahtar olan 
//rastgele olarak bizim vedgimz sayi kadar anahtarlari secip bize value olarak getiriyor
//Bizde bu random anahtarlari hangi dizi uzerinden secti isek array_map ile, o dizi yi kullanarak
//value lerine de erisebiliyoruz asagidaski gibi

//BESTRPACTISE...GLOBAL VEYA BIR UST SEVIYEDEKI DEGISKENE IKI SEKILDE ERISIRIZ...1-GLOBAL 2-USE KULLANARAK
$res7=array_map(function($key)  use ($my_arr3){
    //globaL $my_arr3;
    //BUNA DIKKAT EDELIM...YA GLOBAL DERIZ YA DA USE ILE BIZ BIR FONKSIYON ICINDE GLOBAL VEYA DISARDAKI BIR
    //DEGISKENE ERISEBILIRIZ.....BESTPRACTISE...
    return $my_arr3[$key];
},$random);
//print_r($res7);

//ARRAY_REVERSE-BIR DIZIYI TERSTEN YAZMAK ICIN KULLANILIR
$my_arr4=[1,2,3,4,5];
//print_r($my_arr4);//[1,2,3,4,5]
$res8=array_reverse($my_arr4);
//print_r($res8);//[5,4,3,2,1]

//ARRAY_SEARCH FONKSYONU
//Dizi icinden bir deger arar ve deger var ise o degere ait key i doner
$my_arr5=[
    "id"=>1,
    "name"=>"Adem",
    "surname"=> "Erbas",
    "city"=> "Skien",
];

//Eger aradigimz value var ise ona ait key  i getirir bulamaz ise de boolean donuyor 0 donuyor ama boolean da 0 donunce ekranda bir sey goremeyiz
//onu da bilelim...
//ARRAY_SEARCH I BIZ ARRAY ICINDE ARADGIMZ DEGER VAR MI YOK MU ONU BULMAK ICIN KULLANIRIZ
//IC ICE DIZILERDE DIKKAT EDELIM...ARRAY_SEARCH ISE YARAMAYACAKTIR...DOLAYISI ILE BOYLE DURUMLARDA KENDI FONKSIYONUMUZ YAZARIZ
//RECURSIVE FONKSIYONU YAZARIZ...
//KENDI FONKSIYONUMUZ ICERISINDE BIR FOREACH ILE ARRAYIMIZ DONDURURUZ VE ONCE ARANAN ELEMAN DIZININ ILK ELEMANLARINDA VAR MI ONA BAKARIZ
//EGER YOK ISE HER BIR ELEMAN  YOK DIYE DONDUGUNDE BU SEFER YOK ISE O ZAMAN BU ELEMAN DIZI MI ONU SORGULARIZ VE EGER DIZI ISE DE 
//ICINDE BULUNDUGMUZ METHODU TEKRAR INVOKE EDERIZ AMA PARAMETRE OLARAK O DIZI ICINDEKI DIZI OLAN ELEMANI KOYARIZ ARANAN ELEMAN OALRAK DA AYNI ELEMANI KOYARIZ....
//FOREACH ILE DONEN ELEMANLAR ARASINDA ARANAN ELEMAN VAR ISE O ZAMAN ZATEN IS BITIYOR OK DIR DIREK RETURN TRUE YAPAR GECERSIN...
//ANCAK, EGER ARADIGMIZ ELEMAN ARASINDAN DEGIL ISE FOREACH ILE DONDURUDUGMUZ DIZIIN ELEMANLARI SIRASI ILE O ZAMAN BIR DE ASAGIDA IF ILE 
//BU ELEMAN DIZI MI ASAGI DOGRU GIDIYOR MU ONU KONTROL ET EGER DIZI ISE ASAGI DOGRU GIDIYOR ISE O ZAMAN ICINDE BULUNDUGMZU FONKSIYONU BU DIZI ICINDE
//INVOKE ETKI O DIZI DE OTOMATIK OLARAK ICINDEKI ELEMANLARDA ARADGIMZI ELEMAN VAR MI CEK EDILMIS OLSUN
$res9=array_search("adem",$my_arr5);
echo "..................".getType($res9);

//IN_ARRAY ILE DIZI ICINDE BIR ELEMNTIN VAR OLUP OLMADIGNI SORGULARIZ-ASLINDA ARRAY_SEARCH IN YAPTIGI ISLEMIN AYNISINI YAPIYOR
//COK KULLANACGIMZ METHODLARDAN BIRIDIR
// $my_arr6=[1,4,6,7];
// if(in_array(4,$my_arr6)):echo "4 is inside our my_arr6 array";
// else : echo "4 is not inside our my_arr6 array";
// endif;

//ARRAY_SHIFT-DIZININ ILK ELEMANINI DIZIDEN SILER
//ARRAY_POP-DIZINN SON ELEMANIN DIZI DEN SILER
//DIKKAT EDELIM, HERHANGI BIR SEY DONDURMUYOR BU METHODLAR, DIZININ KENDSININ ICINDEN ELEMANI SILIYR
//DOLAYISI ILE SONUCU GOREBILMEK ICIN YINE DIZININ KENDISNI YAZDIRMAMIZ GEREKIYOR
// $my_arr7=[1,2,3,4,5,6];
// array_shift($my_arr7);
// print_r($my_arr7);//[2,3,4,5,6] bastan 1 eleman sildi
// array_pop($my_arr7);
// print_r($my_arr7);//[2,3,4,5] sondan 1 eleman sildi

//ARRAY_SLICE : DIZININ BELLI BIR ARALIGINI SECMEK ICIN KULLANILIR
//RETURN OLARK BASKA BIR DIZI GONDERIOR
 $my_arr8=[1,2,3,4,5,6];
 $res10=array_slice($my_arr8,2,3);//$my_arr8 de 2.index ten basla, 3 eleman al diyoruz
 //eger dizinin yaninda 1 tane rakam girse idik o zaman da dizinin en basindan basla 
 //index olarak verdigmiz rakam dan sonrasini getir demis oluyorduk
 print_r($res10);//[3,4,5]


 //SON IKI ELEMANI SECMEK ICIN DE NEGATIF SAYI KULLANABILIRIZ
 $res11=array_slice($my_arr8,-2);
 print_r($res11);//5,6 

 //ARRAY_SUM : DIZININ ICINDEKI ELEMENTLERIN TOPLAMINI VERIR
 $res12=array_sum($my_arr8);
 echo $res12;//21
 //ARRAY_PRODUCT: DIZI ICINDEKI ELEMENTLERIN CARPIMINI BIZE VERIR
 $res13=array_product($my_arr8);
 echo $res13;//720

 //ARRAY_UNIQE: DIZI DE TEKRARLANAN ELEMENTLERI SILIYOR VE DIZI ELEMANLARINI UNIQ HALE GETIRIYOR

 $myarr9=["adem","erbas",34,"adem","erbas","skien",34];
 print_r($myarr9);
 $res14=array_unique($myarr9);
 print_r($res14);//Dizimin icinde tekrarlanan elemntleri silerek bize 
 //dizi icindeki elementleri unique olarak doner
?>