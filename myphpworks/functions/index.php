<?php
# Fonksiyonlarda buyuk harf ile kucuk harf ile baslayan fonksiyonlar aynidir ama bu degiskenlerde boyle degil
# buna dikkat edelim
function getMyInfo()
{  
   $name="Adem";
   $surname="Erbas";
   return $name .  $surname;       
}
//php ye has onemli ayirici ozelliklerden bir tanesi + ile string icinde islem yapamiyoruz onun yerine
//birlestrime operatoru olan . yi kullaniyoruz...+ sadece matematiksel sayilarda kullanilir
//Bu tamamen php ye ait bir ozelliktir
$a= getMyInfo();

echo $a;

//Parametreye de yine degisken yazabiliriz fonksiyon olustururken ancak, fonksiyon invoke veya call edildigi zaman ise
//direk fonksiyon icine deger yazabiliriz...


//Fonksiyonlarda varsayilan deger atayabiliyoruz php de
function myInfo2($name="Adem",$surname="Erbas"){
    return $name . $surname;
}


//EGer 2 tane parametre verdik ve 2 parametrenin de 1.sine sadece varsayilan deger atadi isek o zaman
//biz fonksionu invoke ederken 1 tane parametre verdigmiz zaman, bu parametre 1. parametreye atanacak otomatik olarak ve 
//2.parametre paramatresiz kalarak bize hata verecrektir
$res=myInfo2("Zehra","Erbas");
$res=myInfo2("Zehra");//2.parametre varsayilan  default degerden gelecek dikkkat edelim.....
echo "res: </br> $res";
echo "</br>";
//BESTPRACTISE....
$res=myInfo2(NULL,"Erbasssssss");//BIZ BU SEKILDE 2 PARAMETRESI OLAN BIR FONKSIYON DA 
// VERDGIMIZ DEGERIN 2. PARAMETREYE ATANMASINI SAGLAYABILIRIZ
echo "res: </br> $res";

echo "</br>";
//PHP DE Fonksiyonlarda disardan degiskenleri nasil kullaniriz?

//Fonksiyonlar daha onceden tanimlanmissa ayni isimde fonksiyon daha sonra dan tanimlanamaz


//BURDA BUNA DIKKAT EDELIMMM...BIZ ASAGIDAKI GIBI DIREK DISARDAN BIR DEGISKEN I 
# FONKSIYON ICREISINDE KULLANAMADIK KULLANABILMEK ICIN GLOBAL, $GLOBALS ILE KULLANACAGIZ
//GLOBAL OLARAK TANIMLAYARAK KULLANACAGIZ...ISTE JAVASCRIPTTEN AYRILAN YERLERINDEN BIR TANESI DE BURASI
//DIKKAT EDELIM...
//Biz global ile demis oluyoruz ki bu degiskenin aynisindan eger icinde bulungumz fonksiyon disinda bulunuyorsa
//O zaman bunu ordasn alabilelim demis oluyoruz..., global, ya da $GLOBALS[]
echo "</br>----------------------";

$name="Zakaroni";
$age=34;
function getMyInfo2($lastName){
    global $name;//Cok onemli burasi dikkat edelim....
    $age=$GLOBALS['age'];
    echo  $name  . $lastName. " ". $age;
}

getMyInfo2("Kesmekes");

echo "</br>
----------------------". "</br>";

# Yazi kisaltma
$myTest="Hello this is my string and I will make this short";

$res=substr($myTest,0,10);//0.karakterden baslasin ve 10 karakter alsin diyoruz

echo $res;
//EGer 10 dan uzun ise bunu yap

function makeTextShort($text){
    $countOfText=strlen($text);
    if($countOfText>10){
        echo substr($text,0,10)."...";
    }else {
        echo $text;
    }
}

//ONEMLIDIR...
//strlen ile biz, bir string in kac karakterden olustugunu buluyoruz
//Ama bir array a ait element sayisini ise count() ve size of() ile buluyoruz

echo "</br>
----------------------". "</br>";

$myNewText="Hello , my friend. I have started new job and this is very excited";
$myText2="I am Adem";

makeTextShort($myNewText);


echo "</br>
----------------------". "</br>";

makeTextShort($myText2);




?>