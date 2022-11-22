<?php 


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//use ile namespace kullaniliyor cunku ayni isimde class lar veya directory ler olabilir onlarin birbirine karismamasi icin namespace kullanmak cok onmelidir, php de  ve namespace ler use ile kullanilir

require 'vendor\autoload.php';

//Bu alttaki 3 tane require_once ile ekledigmiz dosyalara gerek olmayabilir bunlara tekrar bakariz mail sistemi ile ugrsamamiz gerektitignde
require_once "./vendor/phpmailer/phpmailer/src/Exception.php";
require_once "./vendor/phpmailer/phpmailer/src/PHPMailer.php";
require_once "./vendor/phpmailer/phpmailer/src/SMTP.php";


// print_r($_POST);
// $file=$_FILES["file"];
// print_r($file);

/*
{
name: "FRONT_NO_V44_KILLE_ALAN_1.jpg",
full_path: "FRONT_NO_V44_KILLE_ALAN_1.jpg",
type: "image/jpeg",
tmp_name: "C:\xampp\tmp\php9D03.tmp",burasi dosya gicegei adrese yuklenen kadar gecici olarak yuklendiig ve bekledigi yerdir ve de bu gecici adres her yuklemede degisecektir
error: "0",
size: "28628"
},
*/
exit();

//Burda oncelikle form dan gonderilen input datalarini kontrol ederiz

//$epost=isset($_POST["epost"]) ? $_POST["epost"] : null;
$epost=$_POST["epost"] ?? null;

//$subject=isset($_POST["subject"]) ? $_POST["subject"] :  "Subject";
$subject=$_POST["subject"] ??  "Subject";

//$content=isset($_POST["content"]) ? $_POST["content"] : null;
$content=$_POST["content"] ?? null;

if($epost):
  echo "Please, enter your epost address";
//Gecerli bir eposta adresi oldugunu kontrol etmek icin 
//PHP DE INBUILD FILTER_VAR fonksiyonu ile email in email formatinda olup olmadigini kontrol edebiliyoruz yoksa bu islem icn regular expression kullanmamiz gerekebilirdi
elseif(filter_var($epost,FILTER_VALIDATE_EMAIL)):echo "Please enter a valid epost address";  
elseif($subject):echo "Please enter your subject";  
elseif($content):echo "Plese enter your content";
else:



$mail = new PHPMailer(TRUE);
//PhpMailer sinifimizi baslatirken constructor a true veriyoruz cunku Exception lari, hatalari firlatmasini istiyoruz

//BESTPRACTISE-TRY-CATCH ICERISINDE YAPALIM -SERVER A BAGLANMA ISLEMINI
//Simdi biz mail isleminde bir server a baglanacagiz, dolayisi ile server a baglanma, database e baglanma, ftp-server a baglanma gibi uzak server a baglanma islemlerinin hepsinde hata durumunda uygulamamiz patlamamasi icin try-cathc ile handle ederiz bu islemleri bu aslinda gelen bir kuraldir..bunu unutmayalimmm

/*

$mail->isSMTP();
$mail->Host = 'localhost';
$mail->SMTPAuth = false;
$mail->SMTPAutoTLS = false; 
$mail->Port = 25; 

*/


try {
 //1-Server ayarlarimiz i yapacagiz once
 //1-Server ayarlari

 $mail->SMTPDebug=1;
 $mail->isSMTP();
 $mail->CharSet="utf-8";
 $mail->Host="smtp.misshosting.no";//Smtp sunucumuzu beliritiyoruz burda
 //gmail ile gonderme islemi yapilirsa adress:smtp.gmail.com
 $mail->SMTPAuth=true;
//  $mail->AuthType = 'LOGIN';
 $mail->Username="ademskien@ademtest.site";
 $mail->Password="Sakarya5466";
 $mail->SMTPSecure="SSL";
 $mail->Port= 465;//587 de olabiliyor

 $mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
    );

 //2-Alicilar-receipents-Alici ayarlari
 //Username-SetFrom bu ikisi de gonderen in mail adresi demektir, yani bizim mail adresimiz..
$mail->setFrom("ademskien@ademtest.site","Adem Erbas");//2.parametredeki gonderen, ve gonderen mail adresi bunlar formdan kullanicya gelecektir
//addAddress-adres ekle, hangi adresse gonderilecek yani hangi email e gonderecegtiz demektir
$mail->addAddress($epost,"Zehra Erbas");//2.parametre optional dir gidecek adress kullanici ismidir
//$mail->addAddress("testadem5434e@gmail.com","Alex User");//Mesaj eger birden fazla adreess e, birden fazla mail adresine gondeirlecekse o zaman bu sekilde gidecek adresleri ekleyebiliriz
    
//addReplyTo NEDIR DOGRU ANLAYALIM!!!!!
//addReplyTo su demek..Mail i gonderdimgiz alici veya alicilar eger cevap yazmak isterler ise hangi mail adresine gelsin cevaplari yani direk mesaj gonderdgimz mail adresine mi gelsin, ya da baska bir mail adresine cevaplarin gelmesini isteyebiliriz yani normalde musterilere mail i gonderirken kullanilan mail adresi ile musterilerin kendilerine gelen mail de cevap yazdiklari zaman cevabin geldigi mail adresi farkli olabilir ki bu cok yaygindir ondan dolayi da burda alici mesaja cevap yazdiginda o cevabin iletilmesin istedgimz mail adreisni yazariz buraya...
// $mail->addReplyTo("ae@netsense.no", "Adem Erbas testmail address");//Bu her zaman eklenmiyor duruma gore galiba detayli arastirilabilir
// $mail->addCC("cc@example.com");//visible from recipients
 //Bunlar biz ornegin bir musteriye mail gonderirken, bu mail 3. bir disardan mail e de iletilsin mi  yani ornegin bizim musterilere gonderdigmiz bazi kampnya maillerini o is yerinde iligli pozsiyonda birine de iletmemiz gerekebilir ve bu kimiz zaman alici nin gorecegi, kimiz zaman da alicinin gormeyecegi sekilde olmasi gereken durumlar vardir iste addCC,addBCC bu iki farkli senaryo icin kullanilyor,cok onemlidir(ama daha cok is sektorunde kullanilir ve bazi spesifik durumlar da kullanilir)
// $mail->addBCC("bcc@example.com");//invisible from receipents

//FILE-ADDATTACHEMENT I BURADA EKLIYORUZ...
if(isset($_FILES["file"]["name"])):
  $mail->addAttachment($_FILES["file"]["tmp_name"],$_FILES["file"]["name"]);
  //2.parametreye de name olarak vermek istedigmiz ismi verebiliyorduk
endif;

// {
//   name: "FRONT_NO_V44_KILLE_ALAN_1.jpg",
//   full_path: "FRONT_NO_V44_KILLE_ALAN_1.jpg",
//   type: "image/jpeg",
//   tmp_name: "C:\xampp\tmp\php9D03.tmp",burasi dosya gicegei adrese yuklenen kadar gecici olarak yuklendiig ve bekledigi yerdir ve de bu gecici adres her yuklemede degisecektir
//   error: "0",
//   size: "28628"
//   },

//Burdaki dosyalari kullaniciya eklettriecegiz, form input undan ama test etmek icin direk ayni dizin den bir dosya yolunu yazip,2.parametreye de hangi isimle gitmesini istiyorsak onu yazabiliriz
//3-Attachements
// $mail->addAttachment("/var/tmp/file.tar.gz");
//$mail->addAttachment("/tmp/image.jpg", "new.jpg");

//4-Localization-Language
//C:\Users\ae_netsense.no\utv\test\PHP-works\php-mailer-course\phpmailer\vendor\phpmailer\phpmailer\language
//phpmailer.lang-nb dosyasi norvecce dilinde eklememiz icin ayarlanmis
  $mail->setLanguage("nb");//2.parametreyi kullanmamamiz gerekiyor test ederiz daha sonra
 //5-Content ayarlar-Icerik ayarlari
 //Hata oldugu zaman hatayi norvecce gorebiliriz bu sayede
   $mail->isHTML(true);//email formata html formati set ediyoruz burda
   $mail->Subject=$subject;//mail basligi dir
   $mail->Body=$content;//Burasi mesajin iceriginin gelecegi yerdir buralar hep bir formdan veya baska bir input girisinden burya dinamik larak gelecek 
  // $mail->AltBody="";// Bazi mail servisleri html i desteklemezler ise burdak i altbody yi okuyabilirler

   //Buraya kadar olan ayarlar tam yapildiktan sonra artik $mail instance mizin send() methodunu invoke edebiliriz
//    echo "this is here";

    $mail->send();

    echo "Your mail is sended successfully";
} catch (Exception $e) {
    echo $e->errorMessage;
}

endif;
?>