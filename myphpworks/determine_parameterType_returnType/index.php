<?php

# COOOK ONEMLI BESTPRACTISE...
# php7 ile gelen ozellik ile beraber fonksiyonlarda
# parametreye verilecek olan argumentin typeini ve return edilecek datanin type ini belirleyebiliyoruz
# Yani biz fonksyonumuzu sadece int,string vs gibi type lari almasini saglayarak sinirlandirarark
# hatali kullanima karsi daha dayanikli, guvenli ve direncli olmasini saglayabiliriz
# Ayrica fonksiyonumuzun sadece array, string, int gibi type lar donmesini de saglayabiliyoruz   

function subTotal($number1, $number2){
        return $number1+ $number2;
};
//Buraya dikkat edelim...
echo subTotal("1",6)."</br>";//7
echo subTotal(8,6)."</br>";//14
echo subTotal("Adem",6)."</br>";
//Kullanici goruldugu gibi, direk string deger girebilyor onu engelleyen hicbir uyari vs yok...normalde
//Warning: A non-numeric value encountered in C:\wamp64\www\PHP-works\myphpworks\determine_parameterType_returnType\index.php on line 11
//Iste biz fonksiyhon icinde toplama islemi yapiyoruz cunku parametrede integer type gelecegini varsayarak
//boyle bir fonksiyon hazirliyoruz ancak, PHP type safe bir dil olmadigi icin bizi korumuyor bu konuda o zaman
//nasil olacak biz her fonksiyon hazirladigmizda icerde if ile logic condition mi yazacagiz...eger integer ise
//bunu yap yoksa vs diye tabi ki eger tipi parametreden kontrol edemese idik o zaman mecbur oyle yapacaktik ama
//artik tipi parametreden kontrol edebiledgimiz icin

//Ama biz bu integerlarin kati kurallara gore uygulanmasi icin yani , net birsekilde hicbir taviz vermeden uygulanmasi icin
//bizim decleare ile onun strict oldugunu da ustunde belirtmemiz gerekiyor yoksa sadece parametredeki degskenin basina
//int yazinca kullanicinn string kullanmasini engellemiyor

declare(strict_types=1);//Sen bu type tanimlamalarimiz sert bir sekilde uygula, taviz vermeden
//Dikkat edersek artik kullanici bu fonksyonu invoke ederken eger, gider de integer yerine string veya baska bir type girerse
//hemen ona uyari vererek, onu sadece integer kullanmaya yonlendiriyor..
# HARIKA BESTPRACTISE..BIZIM ISIMIZIIN EN ONEMLI PARCALARINDAN BIRIDI DE BUDUR KI, BIZ KULLANICIYI HER ZAMAN DOGRU KULLANIMA YONLENDIRMELIYIZ
# ONU SINIRLANDIRMALIYIZ VE BU SEKILDE HATALARI MINIMUMA INDIRGEMELEIYIZ...

function subTotal2(int $number1, int $number2){
    return $number1+ $number2;
};
//echo subTotal2("1",6)."</br>";//7
echo subTotal2(8,6)."</br>";//14
//echo subTotal2("Adem",6)."</br>";
/*
EGer type belirler ve o type a uymayan bir deger girilir ise o zaman asagidaki gibi hata aliriz
fatal error: Uncaught TypeError: Argument 1 passed to subTotal2() must be of the type int, string given, called in C:\wamp64\www\PHP-works\myphpworks\determine_parameterType_returnType\index.php on line 29 and defined in C:\wamp64\www\PHP-works\myphpworks\determine_parameterType_returnType\index.php:24
*/

//PEKI FONKSIYONUMUZ NASIL BELLI BIR TYPE I DONMEYE ZORLUYORUZ...

function subTotal3(int $param1, int $param2): string{
    return $param1 + $param2;
};

?>