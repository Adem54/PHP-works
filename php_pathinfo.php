<?php 

print_r(pathinfo("/php_pathinfo.php"));
/*
paramtreye verdigmz path i dirname,basename(filename.extension), extension(uzanti).php, fileName seklinde detayli ca parcalanmis olarak alabiliyoruz....Ozellikle uzantisin spesifik bir dosya ararken cok kullanislidir
{
dirname: "\",
basename: "php_pathinfo.php",
extension: "php",
filename: "php_pathinfo"
},

*/
print_r(pathinfo("test/php_pathinfo.php"));
/*


{
dirname: "test",
basename: "php_pathinfo.php",
extension: "php",
filename: "php_pathinfo"
},
*/



?>