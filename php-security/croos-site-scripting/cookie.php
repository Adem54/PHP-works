<?php 


setcookie("test","ademerbas", strtotime("+1 day"));
//1 gunluk 1 cookie olusturduk
//tarayici da inspect yapinca applications kisminda cookies den cookie mizi goreiblirz
//tarayiciida console da cookie ye direk erisilebiliyor document.cookie yazinca console dan da gorebiliriz bunu
//Xss aciklari da zaten javascript kodlarinin calistirilmasi ile meydana geliyordu, disardan bir kullanici javascript kodlari calistirarak cookielerimizi calabilir
//Ornegin biz kullanici dan bilgileri alirken hic filtrelemedik diyelim ki htmlspecialchar() ile ve bir kullanici bizim veritabnimiza kaydolurken textarea kisminda geldi script kodu yazdi <script>alert("hak yiyen hack yer")</script> diye
//Biz veritabanina boyle bir kayit ekledik test etmek icin
?>