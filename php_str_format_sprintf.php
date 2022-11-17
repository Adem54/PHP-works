<?php 

//Bunu kullanma amaci elimizde bir string ifademiz var ve biz bunu dinamik yapmak istiyoruz bu
//veritabani bglanti connection i olabilir
//Bu bir select query sorgu ifadesi olabilir
//Bu success veya error mesajini dinamiklestirme de olabilir
//$sFullPath = sprintf("%s/*.%s", $sPath, $sExt);
//Bu sekilde dosya ismi ve uzantisini, dinamik bir sekilde yazarken de kullanilabilir

// $text="Zehra går på kjørbekhøyda skole";

$new_text=sprintf("%s går på %s skole trin %d","Zehra","kjørbekhøyda",4);

echo $new_text;//Zehra går på kjørbekhøyda skole trin 4


?>