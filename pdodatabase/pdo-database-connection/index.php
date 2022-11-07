<?php 
//veritabni baglantisini burda sayfaya dahil edecegiz

require_once("connect.php");

//PDO INSERT ISLEMI
//SIMDI BIZ   ?page=insert seklinde localhostta bir get ile data gonderip boyle bir uzantiya erismek istiyoruz

//Once buraya get ile data gonderilmis mi onu bir kontrol ederiz normal get veya postta yaptimgiz gibi

if(!isset($_GET["page"])){//page ne oluyor form icindeki input a ait name degeri page oluyor eger page in value si ne oluyor iste input icine  yazilan deger de value olarak gelecek....eger form ile get verisi gonderilir ise
    $_GET["page"]="index";//Burda kendimz olustrduk ve value olarak da index ismini verdik
}

//Sonra switch case yapisi ile eger case insert ise 1 tane insert dosyasi ekletecegiz ve veritabani dosya ekleme islemlerini yapacagimzi dosya olacak bu
//Yani veritabani dosya ekleme-insert islemlerini bu insert.php de yapmak istiyoruz birbirinden ayirmak istiyoruz

switch ($_GET["page"]) {
    case 'insert':
        # code...
        require_once("insert.php");
        break;
    
    default:
        # code...
        break;
}
?>