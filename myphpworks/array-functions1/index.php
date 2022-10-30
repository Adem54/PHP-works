<?php

/*
print_r($arr); Icine koydgumuz dizi veya objeyi ekranda gorebilmemizi sagliyor
echo ile biz bir diziyi goruntulemeyoruz
var_dump($arr);  var dumb biraz daha yazilimsal ve type lari ile bizim, array ve objeleri ekranda gorebilmemizi saglar


explode(); string bir degeri belli kritierlere gore bosluk , virgul gibi , kritlerlere gore ayirip dizi haline getiriyor

 */

$text="Adem,Erbas,developer,Skien";
$res=explode(",",$text);//Artik $res bir dizi oldu dolayisi ile dizi yi echo ile deigl print_r ile yazdirabiliriz

print_r($res) ;


?>