<?php
/*
func_num_args()
func_get_args()
func_get_arg()

Fonksiyonlarda biz parametreli birer ikiser tana atayabiliyoruz,
ama bizim simdi oyle bir sistem kurmamiz gerekir dinamik bir sistem olsun ve o fonksyon parametresi de
kac tane olacagi duruma gore degisebilsin reusability icin yani kimi zaman cok uzun parametreler de girilebilsin diyoruz
sinir koymadan bu nedir bu mantigin C# da karsiligi params dir, javascriptteki karsiligi da rest operatorudur (...arr) bu aray
icine kullanici disardan artik parametrye istedigi kadar element ekleyebiliyorz bu sayede...
Simdi bunlarin karsiligina bakalim
root yapilarini kurarken sinirsiz parametre gonderme durumumuz olabiliyor yani 
query ler yazarken veya belki birkac tane filtreleme vs durumu da olabilir
iste boyle durumlarda yukardaki 3 fonksiyonu kullanacagiz php de
*/




//Bu fonksiyonlar ile biz nelerid elde edebilyoruz
//1-fonskiyonumuza kac tane parametre gelmis onu bulabiliyoruz
//2-GElen parametrelerin listesini dizi olarak alabiliyorum
//3-Birde bu fonksiyona bir index numarasi vererek o fonkisiyonun o parametresinin de degerine de erisebilyoruz...


# BESTPRACTISE...DINAMIK BIR SEKILDE....PARAMETRE OLUSTURUYORUZ...HARIKA.....BESTPRACTISE...
//FONKSIYONA GELEN PARAMETRELERI BU SEKILDE YONETEBILIYORUZ...
function test(){
    //Dikkat edelim....biz bir fonksiyon olusturuduk ve icine istenildigi kadar yani ihtiyac ne kadar ise o kadar
    //parametre grilebilsin istiyoruz..Peki kullanicinin kac tane paremtre girdigini de asagidaki gibi ogrenebiliriz
        echo func_num_args(). "</br>";//
        print_r(func_get_args()) . "</br>";
        echo func_get_arg(2);//2.indexe ait parametre hangsi ise onu getir diyourz- netsense i getiriyor..
}

test("Adem", "Erbas","netsense",34);



?>