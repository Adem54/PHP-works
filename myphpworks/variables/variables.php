<?php

/*
Degiskenler $ isareti ile tanimlanirlar
Harf veya _karakteri ile baslarlar
Sayi ile baslayamayiz
Turke karakterler kullanmamaliyiz
Key sensitivi dir yani buyuk, kucuk harf birbirinden farklidir

*/

$city="Skien";

echo $city;

$name="Adem";
$age=34;
$isMarried=true;
echo $name;

?>

<?php  
/* 
Veri Turleri
string
integer
fload(double)
boolean
Array(dizi)
Object(Nesne)
NULL

getType fonksiyonu ile datamizin type ini gorebiliriz
html etiketi icinde php kullanabiliriz ancak php etiketi icerisinde html kullanamayiz...

*/

$name="Adem";
$res= getType($name);//Degiskenini turunu donduruyor

echo $res;
echo getType(45);
echo getType(true);
echo getType(6.7);

?>
<br/>

<?php  
#Array ler bu sekilde tanimlaniyor
$array=array();//array leri bu sekilde tanimlayabiliyoruz
echo getType($array);//array
#Objectler 
$object=new stdClass;
echo getType($object);//object
echo getType(NULL);//NULL
?>