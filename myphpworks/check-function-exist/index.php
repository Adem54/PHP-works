<?php

/*
COOOK ONEMLI BESTPRACTSISE
Fonksyonlar var mi yok mu onu kontrol edebiliyoruz php de
Bunu ne icin ve nasil kullaniyourz
Internette arastirdgimiz bazi fonksiyon paketleri sonradan extension olarak yukleyerek kullanabilyoruz
cunku php ye sonradan eklenene fonksiyonlardir dolayisi ile de biz fonksyonlari kullanirken onlarin var olup olmadiklarini
sorgulayarak kullaniyoruz yani o fonksiyonu biz kullanabilir miyiz onu sorguluyoruz ve ondan sonra kullaniyoruz
*/


function test(){
    return "test";
}

echo function_exists("test")."</br>";//1
echo function_exists("test2");//0

if(function_exists("test2")):echo "Test fonksiyonu vardir";
else: echo "test fonksiyon yoktur";
endif;

//substr fonksiyonu turkce karakterlerde sorun cikariyor bunun yerine,
/*
The function_exists() is an inbuilt function in PHP. The function_exists() function is useful in case if we want to check whether a function() exists or not in the PHP script. It is used to check for both built-in functions as well as user-defined functions.14-Mar-2018

Amacimiz kullanacagimiz fonksiyon sunucu da exist mi onu netlestirip ona gore kullanmak ya da baska alternatif uretmek

Yani php icerisinde bulunuyor mu bulunmuyor mu o func onu kontrol ediyoruz...ok anlasildi
*/
?>