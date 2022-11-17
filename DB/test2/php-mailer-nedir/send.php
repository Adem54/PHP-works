<?php

//use import islemi icin kullaniyoruz.. ancak 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//use PHPMailer\PHPMailer\{PHPMailer,Exception as PHPMail};

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';


$mail = new PHPMailer(true);
//Sirayla yaptigmiz adimlari soyle netlestirecek olursak 
//1-Once PHPMailer siniflarini use ile import ediyoruz
//2-Sonra PHPMailer sinifinin parametresine true gecerek, constructorina true gecerek
//PHPMailer(true) bir instance olusturuyoruz
//3-Ardindan ise Server settings leri yapmak icin olusturdugmz mail sinifina hangi mail adresinden, hangi sunucu kullanilarak
//charSet ne olarak, pasword, username, SMTPSecure durmu ne olacak, Post numarasi ne olacak bunlari belirterek ve SMTPOptions lari belirtiriz
/*
Mantik olarak eger biz bir mail gonderecek isek ve mail sistemi kuracak isek o zaman bizim bir mail gonderme sunumucz olmalidir yani bir serverimiz ve bu server ile ilgili ayarlari PHPMailer sinifinin ilk ayarlarda ona hangi ayarlari kullanacagmiz hangi mail adresi vs gibi bircok bilgiyi girmemiz gerekecek
4-Alicilar ile ilgili de alan adi, aliciadress,mailcontent,mailsubject verileri girmemiz gerekecek
5-Sonra da PHPMailer ile gelen bir send() metodu var onun icinde metod gondermeye calisirken tyr-cathch kullaniriz ve 
cathc de hata mesaji veririz, yoksa
*/
try {
 //Server settings
 $mail->CharSet = 'UTF-8';
 $mail->SMTPDebug = 0; // debug on - off
 $mail->isSMTP(); 
 $mail->Host = 'mail.alanadiniz.com'; // SMTP sunucusu örnek : mail.alanadi.com
 //Burasi mail sunucus yazilacak
 //Plesk Panel kullanıyorsanız; mail.domain.com
 //Maestropanel kullanıyorsanız smtp.domain.com şeklinde düzenlemelisiniz.
 $mail->SMTPAuth = true; // SMTP Doğrulama
 $mail->Username = 'isim@alanadiniz.com'; // Mail kullanıcı adı
 //Oluşturduğunuz email hesabını yazınız.
 $mail->Password = 'Şifreiniz'; // Mail şifresi
 //oluşturduğunuz email hesabının şifresini yazınız.
 $mail->SMTPSecure = 'tls'; // Şifreleme
 //bağlanmak istediğiniz şifrleme yöntemini yazınız, tls veya ssl kullanabilirsiniz.
 $mail->Port = 587; // SMTP Port
 //TLS kullanıyorsanız 587, SSL kullanıyorsanız 465 yazınız.
$mail->SMTPOptions = array(
 'ssl' => array(
 'verify_peer' => false,
 'verify_peer_name' => false,
 'allow_self_signed' => true
 )
);

 //Alıcılar
 $mail->setfrom('isim@alanadiniz.com', 'İletişim Formu');
 //
 $mail->addAddress($_POST['mail']);
 $mail->addReplyTo($_POST['mail'], $_POST['name']);
 //İçerik
 $mail->isHTML(true);
 $mail->Subject = 'İletişim Formu.';
 $mail->Body = $_POST['message'];

 $mail->send();
 echo "Mesajınız İletildi --> ".$_POST['mail']."<br>";
} catch (Exception $e) {
 echo 'Mesajınız İletilemedi. Hata: ', $mail->ErrorInfo;
}


/*
PHPMailer SMTP kimlik dogrulamasi yapabilen bir librarydir
Bu yazilim sayesinde websitemiz uzerinden bir mail adresinden istedginiz bir mail adresine
ya da mail adreslerine ileti gonderimi yapabiliriz
PHPMailer ayni zamanda wordpress,joomla gibi uygulamalarin hepsine uyumludur
SMTP sunucu destegi ile alan adi uzantili kurumsal mailler disinda gmail, hotmail gibi e-posta hesaplari uzerinde de
ileti gonderebiliyoruz
PHPMailer nasil kullanilir?
Oncelikle normal kullanilan, sifresini bildgmiz bir mail adresine ihtiyacimiz var

Host,username,password ve port degerlerini degistirmemiz gerekiyor

$mail->Username          = “mailadi@alanadiniz.site”;// SMTP mail kullanici adi
$mail->Password           = “mailsifreniz”; //SMTP mailinizin sifresi

Natro SMTP Ayarları
$mail->Username          = “mailadi@alanadiniz.site”;// SMTP mail kullanici adi
$mail->Password           = “mailsifreniz”; //SMTP mailinizin sifresi

Yandex Smtp Ayarları:
$mail->SMTPSecure = ‘tls’;
$mail->Host = ‘smtp.yandex.com’;
$mail->Port = 587;


Gmail Smtp Ayarları:
$mail->SMTPSecure = ‘ssl’;
$mail->Host = ‘smtp.gmail.com’;
$mail->Port = 465;


Mail içerik ayarlarınızı, aşağıdaki örnekte olduğu gibi özelleştirebilirsiniz. Buradaki bilgiler form.php deki formdan gelen bilgilerdir. 

Mailinizin gövdesi: (HTML ile)
$body  = “”.”Mail İçeriği Başlığı”.”<br><br>”;
$body .= “Gönderen Adi : “.$_POST[“adsoyad”].”<br>”;
$body .= “E-posta Adresi : “.$_POST[“mailiniz”].”<br>”;
$body .= “Telefonu: “.$_POST[“telefon”].”<br>”;
$body .= “Yasadigi yer: “.$_POST[“yer”].”<br>”;
$body .= “Konu;: “.$_POST[“konu”].”<br>”;
$body .= “Mesaj: “.$_POST[“mesaj”].”<br>”; 


Mailleriniz hangi maile ya da maillere gidecekse, mail adreslerinizi AddAddress ile ekleyebilirsiniz. 
$mail->AddAddress(“mailadi@alanadiniz.site”); // –  Mail gönderilecek adresler 
Mailinizde CC ve BCC eklemek için ise;
$mail->addCC(‘mailadi@alanadiniz.site’);// cc  mail adresi
$mail->addBCC(‘mailadi@alanadiniz.site’);// bcc  mail adresi 
Mail içine herhangi bir dosya ya da resim eklemek için;
$mail->AddAttachment(‘images.png’); // – Mail içinde resim göndermek için
*/
?>