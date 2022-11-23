<?php 
//Biz kullanicilarimizdan username ve password girdgmiz zaman bu passwordu veritabanina dogrudan kaydetmeyiz
//Password bir algoritmik sifrelemeden gecirilir mutlaka buna da hashlemek veya hashing denir
//En cok kullanilan php sifrelme algoritma yontemi MD5 sifrelemesidir
$password="adem12345";
$md5password=md5($password);
echo md5($password);//1bce20d834be27ad65984ff50bd93be6  bu herzaman adem12345 buna esittir hicbirzaman degismez
//Biz veritabanina kaydederken bu sekilde md5 sifrelemesinden gecirerek kaydederiz
//Daha sonra kullanici login olurken tekrar vertabanindan bu sekilde sifrelenmis halini aliriz sonra kullanicinin login olurken gonderdigi sifresini alirz ve onu da md5() metodundan calistirarak md5 sifrelemesine maruz birakip sonra veritbaniindaki kaydimiz ile karsilastiririz ve dogru ise o zaman kullaniciya giris izni verip giris islemini yaptiracagiz

if($md5password==md5($password)){
    echo "<br>"."Password is true";
}

//Ancak md5() methodunu tek basina kullanmak yeterli olmayacaktir guvenlik onlemi acisindan
//md5() sifresi de kirilabiliyor, crack-station diye bir site var orda md5() e cevrilmis halini girince , bize sifrenin gercek halini donuyor dolayisi ile md5 ile sifrelenmis bir passwordu bulmak cok da zor degil ondan dolayi
//Bundan dolayi php nin md5 sifrelemesinin haricinde bir de password_hash diye bir methodu var inbuild method

//password_hash
//Bu method tamamen sifrelem icin hazirlanmis php tarafindan ve tamamen guvenlidir
echo "<br>";
echo password_hash($password, PASSWORD_DEFAULT);
//$2y$10$3KaxsEroMmkV/eLSne/NOe6oFZm/NK3fQ3Z3HUz05GgzVK/u2CTXW
//$2y$10$Yz2.GjWeP8/hGDxxPIBDnOUJryt2xBrNsJyF699ORC6bwwonXCSNe
//$2y$10$tKZFZhVN3TuJUFE.QqD.4ekmtPhjVf/L4zsJfHpzfANTQfVzKpgvy

//Dikkat edelim password_hash methodu ile, olusturulan sifre de her yenilemede sifreyi degisitiyor..ama md5() sifrelememiz bu sekilde degildi
//Aslinda password_hash ile uretilen her bir sifre ayni seyi ifade ediyor yani bunlar muhtemlen credentials , yani username ve password u tanimlayan ifadeler
//Peki biz password_hash ile password ve username i aldik ve veritabanina password ile hashlenmis yani sifrelenmis bir sekilde kaydettik, peki kullanici giris yapmak istedigmiz zaman bunu nasil kontrol edecegiz.. Iste bunu yapabilmek icinde php de bir fonksion yazmislar, password_verify isminde
echo "<br>";

$hashed_password="$2y$10\$tKZFZhVN3TuJUFE.QqD.4ekmtPhjVf/L4zsJfHpzfANTQfVzKpgvy";
// BESTPRACTISE.. TIRNAK ISARETI ICINE YAZILAN $ ISARETINI PHP SANKI DEGISKEN TANIMLANIOR GIBI ALGILAMAMSI ICIN 
//ONUN \ TERS SLASH KOYARAK SEN BUNU STRING OLARAK TANI DEMIS OLUYORUZ
if(password_verify($password,$hashed_password)){
    echo "Password is true";
}else {
    echo "Password is wrong";
}
//BIZ HER SEFERINDE URETTIGI SIFREDEN HANGSINI VERIRSEK VERELIM, HEPSINI DOGRU OLARAK DONDURECEK CUNKU BU SIFREYI URETIRKEN KULLANICINN PASSWORDUNU KULLANARAK BELLI BIR ALGORITMADA SIFRELIYOR BUNU VE BIZ HAZIR PASSWORD_VERIFY ILE SIFREYI DOGRULARKEN MUHTEMELEN PHP ARKADA O ALGORITMA ILE TEKRARDAN SIFREYI BULUYYOR



?>