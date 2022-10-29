<?php
//Arttirma Operatorleri
/*
== esittir
!= esit degildir
> buyuktur
>=buyuk esittir
< kucuktur
<= kucuk esittir
=== denkse
!=== denk degil ise

*/


$a=5;
$b=18;

$res=$a == $b;
//Esit ise 1 dondurur esit degil ise 0 dondurur ama 0 oldugu icin hicbirsey gostermeyecek
//php nin nasil tepki verdigini bilmek cok onemlidir

echo $res;
echo "Hello";


/*
Denk ise ===
DEnk ile esit arasindaki fark cok fazla kosula bakmiyor yani integer ve string olan 5 degerini esit verecektir yani 1 verecektir....
ancak denk diye karsilastirirsak
hem tip leri hem de degerleri esit mi ona bakar ve false yani 0 verecektir, javascriptt gibi tepki veriyor
Denk degil ise !==

*/

?>