<?php 

$product="Norwegia øst";
$product_iso=mb_convert_encoding($product,"utf-8","ISO-8859-9");

echo $product_iso;//Norwegia Ã¸st

//Burda biz $product_iso yu ISO-8859-9 a cevirmistik, tekrar ISO-8859-9 dan utf-8 e ceviriyoruz simdi de 
 $product_utf8=mb_convert_encoding($product_iso,"ISO-8859-9","auto");

echo "<br>";
echo $product_utf8;//Norwegia øst

?>