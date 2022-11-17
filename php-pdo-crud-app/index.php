<?php 
/*
301/302 redirect, ya da cookie set etme gibi işlemler, http isteğinde headerda gönderilir. Script ilk echo, html kodu, herhangi bir ekrana basma işlemi gerçekleştirdiğinde, header gönderimi bitmiş kabul edilir. Bu aşamadan sonra redirect, cookie işlemleri yapamazsın. Header'ları gönderdik kusura bakma hacı der. (Cannot modify header information - headers already sent hatası)

ob_start'da ekrana basmaları sen serbest bırakana kadar göndermez, böylece scriptin altında bir yerde herhangi bir koşul karşılığı redirect/cookie yapmak istersen yapabilesin diye bunu kullanırsın.

ayrıca sürekli tekrar eden bazı işlemlerde de kullanılır. mesela sayfalama yaptığında, genelde hem sayfanın üstünde hem en altında sayfa 1 2 3 diye yazdırılır navigasyon kolaylığı açısından. bazı programcı arkadaşlar hem yukarıda hem aşağıda aynı kodu tekrar çalıştırır. bu tarz arkadaşları sevmiyoruz. tepedeki navigasyonu ob_start(); --- ob_get_contents(); bloğu arasına alıp, aşağıda tekrar aynen kaydettiğimiz outputu basarız. bu tarz işlerde de yararlıdır output fonksiyonları. Bir de ob_gzhandler() vardır ki, sıkıştırılmış output yaratır. bandwidthden tasarruf sağlar.
*/
//ob_start ile içeriğin görüntülenmeye hazır olana kadar sunucu tarafında arabellekte tutmasını sağlıyor
//ayrıca ifade ile çıkacak olan her şeyi hatırlamaya başla ve henüz bir şey yapma diyerek düşünebilirsin
//sayfalarda header işlemleri ob_start(); olmazsa yönlendirmeler çalışmıyor

ob_start();
require_once "connect.php";
//BESTPRACTISE...BUNU NOT AL ALTERNATIF HEADER.PHP KULLANIMI--BIZ NORMALDE HER SAYFADA GIDIP HEADER.PHP
// KULLANIYORUZ ONUN YERINE ZATEN BIZ SAYFALARIMIZ HEPSINI INDEX.PHP ICERISNDE CALISTITIRIYORUZ 
//ADET BIR NAVIGASYON GOREVI GORUYOR INDEX.PHP O ZMAN BIZ HEADER.PHP DIREK INDEX.PHP
// ICINDE KULLANIRSAK ZATEN OTOMATIK OLARAK TUM SAYFALAR A DAHIL ETMIS OLUYORUZ...
require_once "header.php";

//HARIKA BESTPRACTISE...GUVENLIK ICIN COK ONEMLI...
//GET METHODU ILE INPUT ICINE GIRILEN BOSLUK, SPACE TUSU VE HTML KODU YAZILMASINA GLOBAL BIR SEKILDE ONLEM ALMAK
//Burda biz tum sayfalarda GET ile data alan ne kadar form islemi var ise onlarin hepsine diyoruz ki
//eger biri url e gelip de html icinde birseyler yazarsa bunu sen html special karakter olarak tani
//bunu o sekilde algila diyoruz ve de bosluklari da kaldir diyoruz yani kullanici bos bos basip da gonderirse de
//bu sekilde bosluklari kaldirmis olyoruz..global bir sekilde 
//  http://localhost/test/pdo-database/index.php?search=<span>on</span> biri boyle birsey yazarsa
//LIKE '%on%'  bunu boyle algilar sql sorgusu, yani html icinde yazildigni anlamaz, biz html icinde yazildini
//anlamasi icin ise asagidaki islemi yapariz ve artik sorguda su sekilde gozukur LIKE '%<span>on</span>%'
//kullanici bosluklara basa basa arama yapti http://localhost/test/pdo-database/index.php?search=+++++++++++
//search e basinca hicbirsey getirmiyor cunku bosluklari karakter zannedip onu ariyor ama hicbirsey bulamiyor
//Ama asgidaki tedbiri alinca kullanicin bastigi bosluklarin hepsini kaldiriyoruz otomatik olarak ve de 
//ne kadar bosluga basarsa bassin aslinda hicbirsey yazmamis olacak...karakter olarak sayilmamis olacak
$_GET=array_map(function($get){
    return htmlspecialchars(trim($get));
},$_GET);


if(!isset($_GET["page"])){
    $_GET["page"]="index";
}

//BURAYI NOT AL
//SWITCH-CASE LERDE BREAK MUTLAKA KULLANMALIYIZ YOKSA SAYFALAR BIRBIRINE KARISIYOR BIZ UPDATE ISLEMINE
// BASIYORUZ EGER BREAK OLMAZ ISE O GDIP DELETE ISLEMINI YAPIP DA DONEBILIYOR COK DIKKAT EDELIMM COOK ONEMLI
switch ($_GET["page"]) {
    case "index":
        require_once "homepage.php";
break;
    case 'insert':
        require_once "insert.php";
        break;
    case "read":   
        require_once "read.php";
        break;
     case "update":
        require_once "update.php"; 
        break;
     case "delete":
        require_once "delete.php";    
        break; 
        case "categories":
            require_once "categories.php";    
            break; 
            case "add_category":
                require_once "add_category.php";    
                break; 
            case "category":
                require_once "category.php";    
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