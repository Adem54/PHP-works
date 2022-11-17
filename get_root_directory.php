<?php 

//Get Root Directory Path of a PHP project?

echo __FILE__."<br>";//C:\Users\ae_netsense.no\utv\test\php-oop\get_root_directory.php
echo __DIR__."<br>";//C:\Users\ae_netsense.no\utv\test\php-oop

// echo  print_r(pathinfo("php-opp/get_root_directory.php"));
/*
{
dirname: "php-opp",
basename: "get_root_directory.php",
extension: "php",
filename: "get_root_directory"
}
*/

$str="This is my string";
$res=strpos($str,"my");

//echo $res;//8.index te bulunuyor

$res=strpos($str,"My");
echo $res;//False-0 donuyor cunku case-sensitie oldugu icin My boyle birsey bulamiyor
//Bulursa index numarasini donduruyor bulamzsa false yani 0 donduruyor

//stripos methodu ile ararsak bulabiliriz, cunku bu methodu case sensitive degildir buyuk kucuk harf farketmez
$res2=stripos($str,"MY");
echo "res2: ".$res2;//8 


//print_r($_SERVER) ;//SERVER ILE ILGILI APACHE ILI ILGILI TUM AYARLARI KEY-VALUE SEKLINDE ALABILIRIZ BURDA
//print_r(getenv());//Tum environment variables lari burdan alabiliriz


//Tum environment bilgilerine getenv() methodu ile erisebiliriz.
echo "<h2>BBservice-inipath: </h2>".getenv("bbservice_inipath");
//C:\Users\ae_netsense.no\ini


?>