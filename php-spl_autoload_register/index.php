<?php 

require("init.php");
$dir=__DIR__;
// require("classes/class1.php");

//Ayni klasor altinda bulunan tum class lari dinamik bir sekilde, ne zaman kullanilacaklar ise o zaman dinamik bir sekilde include, require etmek icin kullandigmz harika bir methoddur, spl_autoload_register methodu ve uygulamalarimzda harika isimize yarayan bir praksisdir

$class1=new class1();
$class2=new class2();


?>