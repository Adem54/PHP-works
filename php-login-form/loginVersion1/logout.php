<?php 


//BURASI BIR GECIS SAYFASIDIR VE BURDA BIZ SESSION I BASLATIP SONLANDIRIRIZ VE ARDINDAN, KULLLANICI ARTIK LOGOUT OLMUSTUR SESSION I UNSET VE DESTROY YAPINCA VE DE HEMEN ARDINDAN KULLANICIYI TEKRAR LOGIN FORMUNUN BULUNDUGU INDEX.PHP YE YONLENDIRIRIZ
session_start();

session_unset();

session_destroy();

header("Location: index.php");


?>