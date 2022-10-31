<?php

/*
print_r($arr); Icine koydgumuz dizi veya objeyi ekranda gorebilmemizi sagliyor
echo ile biz bir diziyi goruntulemeyoruz
var_dump($arr);  var dumb biraz daha yazilimsal ve type lari ile bizim, array ve objeleri ekranda gorebilmemizi saglar


explode(); string bir degeri belli kritierlere gore bosluk , virgul gibi , kritlerlere gore ayirip dizi haline getiriyor

 */

$text="Adem,Erbas,developer,Skien";
$res=explode(",",$text);//Artik $res bir dizi oldu dolayisi ile dizi yi echo ile deigl print_r ile yazdirabiliriz

//explode ile string bir ifadeyi aralarindaki virgule veya bosluga veya baska bir kriterer gore diziye cevirir
print_r($res) ;//Array ( [0] => Adem [1] => Erbas [2] => developer [3] => Skien )

//implode ise elimizdeki bir diziyi istedigmiz bir karakter ile birlestirip string e cevirmemizi sagliyor
$res2=implode(",",$res);//Adem,Erbas,developer,Skien

echo "</br>".$res2;

//DIZI ELEMANLARIMIZI STRINGE CEVIRMEK VEYA STRING IFADEYI DIZIYE CEVIREREK DIZI LERIN HAZIR METHODLARINDAN FAYDALANARAK
//EFEKTIF COZUMLER URETMEK COK YAYGIN BIR  YONTEMDIR..ONDAN DOLAYI BU IKI METHOD OZELLIKLE COK ISIMIZE YARYABILIR


//count ve size of methodu bir dizinin kac elemani oldugunu bize verir
echo "</br>". count($res)."</br>";//4
echo "</br>". sizeof($res)."</br>";//4

//is_array() fonksiyonu parametre olarak aldigi degiskenini array olup olmadignin kontrol ederek array ise 1 degilse 0 donecektir

$myText="Adem, erbas";

if(is_array($myText)){
echo "Bu bir dizidir";
}else {
echo "Bu bir dizi degildir";

}
echo("</br>");
if(is_array($res)){
    echo "Bu bir dizidir";
    }else {
    echo "Bu bir dizi degildir";
    
    }

//shuffle ile biz dizimizin icerigini random olarak elemanlarini karistirarak farkli rastgele siralayarak getirecek
//Cok etkili kullanabiliriz bu diger bircok dilde bulunmuyor manuel olarak yapiyoruz bunu, onda dolayi bu cok guzel bir methodmus

$numbers=array(1,2,3,4,5,6,7,8,9,10);
shuffle($numbers);
print_r($numbers);// ( [0] => 7 [1] => 5 [2] => 8 [3] => 1 [4] => 3 [5] => 6 [6] => 2 [7] => 10 [8] => 4 [9] => 9 )

//array_combine ile iki farkli dizi yi keys, value mantiginda tek dizi olarak birlestirebiliyoruz..
//Dikkat edelim...bu da cok efektif kullanilabilir
$keys=["name","surname"];
$values=["Adem","Erbas"];

$res3=array_combine($keys,$values);
print_r($res3);//Array ( [name] => Adem [surname] => Erbas )

//array_count_values bir dizide tekrarlanan sayilarin kac kez tekrarlandigini bulmak icin kullanilir
$arr=["adem","erbas","adem","Skien","adem","erbas"];
$arr2=array_count_values($arr);
echo "<br/> ";
print_r($arr2);//Array ( [adem] => 3 [erbas] => 2 [Skien] => 1 ) adem elemnti 3 kez tekrar etmis, Skien 1 kez erbas 2 kez

foreach ($arr2 as $key => $value) {
    # code...
    echo "</br> key: $key "."   value: $value  </br>";
}
/*  key: adem value: 3
key: erbas value: 2
key: Skien value: 1 */

//array_flip() bir dizi icindeki key-value yerini degistiriyor....
$myArr=[
"name"=>"Adem",
"surname"=>"Erbas",
"age"=>34,
];

echo "<br/> ";
print_r($myArr);//Array ( [name] => Adem [surname] => Erbas [age] => 34 )

$res4=array_flip($myArr);

echo "<br/> ";
print_r($res4);//Array ( [Adem] => name [Erbas] => surname [34] => age )

//array_key_exist...COOOK ONEMLI COK IHTIYACMIZ OLACAK
//dizi icinde belirlenen anahtarin var olup olmadigini kontrol ediyor

$myArr2=["name"=>"Adem"];
if(array_key_exists("name",$myArr2))
       : echo "</br> name key is exist";
else : echo "</br> name key is not exist ";
endif;

//Ama bu fonksiyon bize nested dizilerde isimize yaramiyor, kullanamiyoruz
//Boyle durumda da biz kendi fonksiyonumuzu  olustururuz...  


$myNewArr=[
    "name"=>"Adem",
    "a"=>[
       "b"=> [
        "c"=>[
            "d"=>"e"
        ]
       ]     
    ]
];


//ic ice diziler de diziler ne kadar ic ice girmis olursa olsun eger biz dogru logici yazabilirsek ki
//onun da yolu bir fonksiyon yazmak ve fonksiyon icinde foreact ile degerleri dondurup sonra icierisinde 
//bir if -else logicinde once aranan elemte bakmak bulunmadigi takdir de de o donen elemen in dizi olup olmadigini kontrol
//edilerek, tekrar kendi icinde bulundug fonksiyon tekrar invoke edilmesini saglamak-yani recursive fonksiyon mantigni kullanmak
//Sogurladgimz anahtar biziim aradigmiz da yok ve value si dizi ise
function _array_key_exist($current_key,$arr){
        foreach ($arr as $key => $value) {
            # code...
            if($key==$current_key):return true;
            elseif(is_array($value)):return _array_key_exist($current_key,$value);
        endif;

        }
        // return false;
}

if(_array_key_exist("d",$myNewArr)):echo "</br> d anahtari vardir";
else: echo "</br> d anahtari yoktur";
endif;

?>