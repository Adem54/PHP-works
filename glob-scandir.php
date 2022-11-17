<?php 


/*
glob u kullandigmiz dosya nin bulundugu dizinde bulunan icine kod yazdgimz dosya da dahil olmak uzere tum dosya ve dizin(klsor-map) leri getirir

print_r(glob("*"));
{
0: "arrays_in_spesific.php",
1: "getopt.php",
2: "glob.php",
3: "php-oop1"
}
*/
//Ama spesifik olarak aradgimz dosyalar var ise onlari da alabiliriz ornegin direk icinde bulundgumz dizindeki php dosyalar veya herhangi bir spesifik dizin altindaki  php dosyalarini alabilir

/*
print_r(glob("*.php"));
{
0: "arrays_in_spesific.php",
1: "getopt.php",
2: "glob.php"
}
*/


/*
print_r(glob("php-oop1/*.php"));
{
0: "php-oop1/abstraction_class.php",
1: "php-oop1/chain_methods.php",
2: "php-oop1/constrct-destruct.php",
3: "php-oop1/final.php",
4: "php-oop1/inheritance.php",
5: "php-oop1/interfaces.php",
6: "php-oop1/oopstart.php",
7: "php-oop1/static_functions.php",
8: "php-oop1/sustainabel-usage_of-parent.php",
9: "php-oop1/usage_of_consts.php"
}

*/

// print_r(scandir("php-oop1/"));
/*
Burasi bize  bu sekilde tum dosyalari getiriyor biz de tabi ornegin burda icerisindeki . ve .. getirmemeis icin bir method yazip
[.,..] bir dizi yapar ve scandir ile getirdigmz dosya ismilerini foreach ile dondurur sart olarak da [.,..] in_array ile bu tek nokta ve 2 nokta nin dizi icinde olmayanlari getir deriz...COOOK ONEMLI BESTPRACTSE...
{
0: ".",
1: "..",
2: "abstraction_class.php",
3: "adem.txt",
4: "app2",
5: "chain_methods.php",
6: "constrct-destruct.php",
7: "final.php",
8: "inheritance.php",
9: "interfaces.php",
10: "namespace",
11: "oopstart.php",
12: "static_functions.php",
13: "sustainabel-usage_of-parent.php",
14: "usage_of_consts.php"
}

*/
?>