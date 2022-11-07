<?php 
//KUllnaicimiz admin panel de eger 1 dakika islem yapmazsa ornegin o zaman biz kullanicimizi otomatik olarak
//session dan cikaralim ve logout yapalim...ayni refresh token mantigi bir de bankalarda da bu sistem var, 1 dakika islem yapmayinca direk logout yapiyor

session_start();


//Kullanici girisi cek edildikten sonra, eger kullanicin girdigi username ve password veritabaninda mevcut ise o zamn
//artik kullaniciya ait bilgileri biz session imiza alabiliriz demektir iste bu islemi yaparken biz session da time da tutacagiz

//COOOK ONEMLI....
//BURASIIII COOOK IONEMLI..BUNUN MANTIGINI IYI ANLAYALI...SESSION A TARIH VERME ILK USERNAME VE PASSWORD VERITABNIMIZDA VAR VE KULLANICI GIRIS I BASARLI ISE ONU ADMIN PAGE E YONLENDIRMEDEN HEMEN ONCE, ONUN YA ID SINI YA DA USERNAME IN ISESSION ALIP ORDA TUTARIZ ISTE ORDA SESSION ICIN BIR TIME, VERISI VE SU ANKI ZAMANDAN KAC SANIYE OLACAKSA ONU DA GIRERIZ VE GIRIS YAPILDIGI ICN SONRASINDA DA KULLANICI TABI KI INDEX.PHP YE YONLENDIRILIR VE BU SEKILDE SESSION TIME IN SET EDILDIGI SAYFA DA SUREKLI KALMAYIZ(EGER KALIRSAK SUREKLI OLARAK SU ANKI TARIH TEN 30 SANIYE SONRASINA BASLAYACAGIZ ICIN HICBIR ZAMAN DOLMAZ..) VE ZAMANDA BASLAMIS OLUR VE BIZ DIGER SAYFAYA GITTGIMIZDE....EGER HENUZ SAYFA DEGISTIRMEMIS ISEK VE 30 SANIYE DOOLMUS ISE BIZIM SAYFAMIZ OTOMATK OLARAK LOGOUT OLACAK VE BIZ SAYFADA HICBIR ISLEM YAPMAYIZ SAYFAYI YENILEYECEGIZ VE GORECEGIZ KI OTURUM SURESI DOLDUGU ICIN LOGOU YAPILMIS KULLANICI
//$_SESSION["time"]=time()+10;//Kullanici 30 saniye eger hicbirsey yapmaz ise o zaman, kullanicinin otrumunu sonlandiralim kullaniciyi logout yapalim


//Eger time datasi sessin icinde var ise ve time session inin value si eger su anki zamanimizdan buyuk ise
//o zaman oturmu kapat..temizle ve kullaniciyi da oturum sonlanma sayfasina gonder....
//o zaman
echo $_SESSION["time"]."</br>";

//echo $_SESSION["time"];
if(isset($_SESSION["time"]) &&  time() > $_SESSION["time"]){
    echo "buray giriyor";
    session_destroy();
    header("Location: session_ended.php");
}else {
    //Eger zaman henuz gecmedi ise o zaman burda demekki kullanici session zamani dolmadan baska sayfaya gecmis demekir ki 
    //demekki kullanici islem yapmis o zaman session i tekrar zamanini baslatiriz
    $_SESSION["time"]=time()+10;
    //Yani bu session a tarih verme durumu ozellikle kullanici username ve password bilgilierini girince time baslatacagiz ki sonra dan eger kullanici hicbir islem yapmaz ise kontrol edebilelim...
}

?>

<h1>ADMIN PAGE</h1>
