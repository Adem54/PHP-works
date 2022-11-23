<?php 

require_once("db.php");
$id=1;
$about=$_POST["about"];

$update=$db->prepare("UPDATE USERS SET ABOUT=? WHERE ID=?");
$update->execute([$about,$id]);
if($update){
    echo "Updated";
    header("Location:csrf.php");
}

//TOKENLARLA SALDIRILARA KARSI ONLEM ALMAK!
//VERITABANI BAGLANTISINI OLUSTURDUMUZ DB.PHP SAYFASINDA YAPACAGIZ
 //Biz burda kendi datamizi edit yaparken, bu siteden baska bir sisteyiz ziyaret ettgimzde bu sitede otrumumuz acikken direk o siteyi ziyaret ettgigmizi varsayarsak ziyaret ettimgz sitedkei kullanici bize arka taraftan post ajax istegi gondererek bizim datamiza mudahele etmeye calisiyor iste bu saldiriya karsi onlem almak icin biz token lara basvuruyoruz

?>