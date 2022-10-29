<?php
# Assign opertors

$name="Adem Erbas";

//. operatoru birlestirme operatorudur
# Her turlu string, int vs leri birlestirmek icin kullanilir...
$name .=" Zehra";

echo $name;

$city1="Skien";
$city2="Porsgrunn";

echo $city1.$city2;

//Dikkat edelim, normal yazilimi dilllerine gore + ile string i toplayamiyoruz bu islmei . operatoru ile yapiyoruz

$x=4;
$x="Adem";
//Boyle atamalarda sorun yasamiyoruz...type safe degil php 
echo $x;


$y=12;
$y+=8;
echo $y;


//ARTTIRMA-AZALTMA OPERATORLERI
$y++;
echo $y;
echo ++$y;
echo $y++;

#$yy++ bu bir sonraki satira gectiginden itibaren artisi yansitacaktir... bu satirda artisi goremeyiz
# Ancak ++$yy burda ise direk bu satirda degerini artirmis oluyor bir ust satirdaki arttirma operatorulerinin farki budur






?>


