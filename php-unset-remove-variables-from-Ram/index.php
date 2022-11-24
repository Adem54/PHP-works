<?php 

//PHP UNSET FONKSİYONU DEĞİŞKENLERİ YOK ETME(SİLME)
//Php de degiskenler Ram da belirli bir yer tutarlar
//Php, de java,C# gibi garbage collector ozelligi olmadigi icin, buyuk veri tutan websitelerin yuklenme, calisma 
//gibi ozellikleri aksayacagindan degiskenleri yok etmemiz gerekir 

$isim="webcebir";

echo $isim;

// Değişkeni yok edelim

unset($isim);

//Bu sekilde $isim degiskeninin Ram de kapladigi alani silmis olduk 
//Bu sekilde performansi iyilestirebiliriz
//Ancak bu sadece cok buyuk projele gelistirdigmzde ve performans sorunu yasama durumunda yapmamiz gerekir
$mevsim ="yaz";

$ay     ="Temmuz";

$meyve  ="Kiraz";

//Birden fazla değişkeni yok etme

unset($mevsim,$ay,$meyve);

echo $mevsim; //Tanımlanmamış değişken mesajı çıkar

?>