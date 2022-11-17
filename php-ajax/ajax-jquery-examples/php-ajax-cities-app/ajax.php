<?php 

require("db.php");
//Burda veritabani islemlerini yapacagiz 
//Buraya front-end den yani ajax ile buraya kullanicinin secmis oldugu¨
//flyke select option post request ile gonderilecek, sonra da burdan
//tekrar kullaniciya response edilebiilr

// print_r($_POST);
// if(isset($_POST['flykeNo'])){
//     $kommune_query=$db->prepare("SELECT * FROM kommuner where flykesnummer");
// }
// echo $_POST["flykeNo"];
if(isset($_POST['flykeNo'])){
    $flkye_no=$_POST['flykeNo'];
    $kommune_query=$db->prepare("SELECT * FROM kommuner where flykesnummer=?");
$kommune_query->execute([$flkye_no]);
$kommuner=$kommune_query->fetchAll(PDO::FETCH_ASSOC);
// print_r($kommuner);

//Burda biz response olarak veritabanindan aldgimiz datalari option icerisinde gonderiyoruz ki bunlari biz istese idk direk jsojn icinde gonderip bu tarz detaylarin da on tarafta yapilmaisni da saglayabilirdik
$html="<option>--Velg et kommune--</option>";

foreach ($kommuner as $kommune) {
$html.="<option value='". $kommune['kommune_id']  ."'>". $kommune['kommune_navn'] ."</option>";

/*
BESTPRACTISE
Mantik olarak burayi anlayalim cook onemli
$html.="<option value='". $kommune['kommune_id']  ."'>". $kommune['kommune_navn'] ."</option>";
Biz bu arada kimiz zaman php iceriisnde tirnak isaretleri icerisinde html etiketlerini dinamik olarka kullanacagiz
Ve cift tirnak icinde kullandgimiz bir html etiketinin attributu olarak meseala value yi kullanyoruz ve 
o value yi de yine tek tirnak icinde kullanacagiz ve o value icinde bir php degiskeni kullaniyoruz o zaman sunu yapacgiz
"<option value='". biz nerde degiskeni girecek isek orda biz ana cift tirnagimizi kapatip . opeatoru koyup degiskenimizi girip 
ardindan tekrar . operatoru nu girerek tekrar dan ana cift tirnagimizi acariz ve aynen kaldigmiz yerden devam edeeriz degiskeni de girdimgiz icin
artik tek tirnagi da kapatabiliriz

*/
}
echo $html;

}


?>