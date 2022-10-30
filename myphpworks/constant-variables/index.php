<?php 
#Sabit degiskenler
#Degiskenler ile ayni ozellikleri tasiyorlar
#Sadece veri turu olarak object veri turunu tasiyamiyorlar
#Dolar isaret ile baslamaz($), define fonksiyonu ile tanimlanir
# define() seklinde tanimlanir
# Harf ya da _ isareti ile baslar
#Key sensitive dir , buyuk kucuk harf duyarlidir



#Normal degisken
$name="Adem";

#Sabit degisken
//define() php tarafinda tanimlanmis bir fonksiyon(built-in)
//Amaci bir kez olusturulduktan sonra bir baskasi tarafindan degerinin degistirilememesi
//Degerleri ilk atandiginda ne ise hep o sekilde kalacaktir
//2 parametre alir, key, value mantiignda calisir, key=degiken adi, value=degisken degeridir
# Yazdirirken, basina dolar isareti koymuyoruz, direk key kismina yazdigimiz degeri dogrudan 
# hicbir tirnak isareti vs olmadan yazdirabiliyoruz ve value degerini verecektir
define("name","Adem Erbas");
echo name;//Adem Erbas
//key-value mantiginda yazilir...ve key ini onune arkasina hicbirsey koymadan kullaniriz ve value degerini verir
# Sonradan degistirilemez, amaci da budur zaten
# Bunun  ozellikle kullanidigi yerler vardir, bunlari ilerde kullanirken gorecegiz

# Constant variable i tekrar tanimlarsak, hata aliriz
//define("name","Zeynep Erbas");
echo name;



             


?>