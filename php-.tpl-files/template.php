<?php
 
$baslik    = "Site Başlığı";
 
$mesaj     = "Sitemize Hoşgeldiniz";
 
$slogan    = "Hebele Hubele";
 
$kopirayt  = "© Bu Site Haksızdır";
 
ob_start();
 
include("template.tpl");
 
$html = ob_get_contents();
 
ob_end_clean();
 
echo $html;
 
?>