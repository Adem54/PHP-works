<?php 
$number;
$content="<h1>Hello world</h1>";
//file_put_contens ile elimizdeki icerigi, baska bir dosyanin icerisine yazabiliyoruz 
//1.parametreye hedef dosya yolu, ama tam yolu yazmamiz gerekir 
//2.parametrede girilecek icerigi icinde barindiran degiskeni yazmalyiz 
$res=file_put_contents(__DIR__."/test2.php",$content);
var_dump($res);
echo "<br>";
//file_get_contents ile de biz bir dosyamizin icerini string olarak aliyoruz 
$res2=file_get_contents(__DIR__."/test2.php");
echo $res2;

?>