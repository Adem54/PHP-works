<?php 

require_once "connect.php";

if(!isset($_GET["page"])){
    $_GET["page"]="index";
}


switch ($_GET["page"]) {
    case "index":
        require_once "homepage.php";
break;
    case 'insert':
        require_once "insert.php";
        break;
    
   
}

/*
BESTPRACTISE-COOK FAZLA KULLANACAGIZ...
Bu kullanimi cok sk gorecegiz biz ozellikle switch case ile birlikte kullaniliyor
Bunu not alallim cook onemli switch case ile kullanim
Mesela sign in durumarinda da cok fazla kullaniliyor eger kullanicinin email-passwordunu 
biz database de bulmus isek onun bilgilerini 
session da tutup onu admine gonderirken eger kullanicinin datalarini database imizde bulamaz
 isek o zaman da onu login sayfasina yonlendirip session daki datalarini siliyorduk
*/
?>