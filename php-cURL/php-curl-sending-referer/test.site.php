<?php 
//Hedef site bot girsimini engellemek icin bir onlem alabilir

if(!isset($_SERVER["HTTP_REFERER"])){
    die("Bot girisimi engellendi!");
}
//Normalde boyle degil de biz olayi gormek icin boyle ypaiyourz
//Yani bizim herhangi bir siteye gondereceimiz curl istegi o siteye aslinda bir request olarak gidiyor dogal olarak ve o request detaylarina gidersek header icerisinde referer ile bot atan web sitesi kimligi gozukuyor, yani bot attigmiz websitesi bu adrese erisebiliyor
//Bot girisimi engellendi!
//echo $_SERVER["HTTP_REFERER"];//DIYEREK
print_r($_SERVER);
?>