<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "./vendor/autoload.php";
require_once "./vendor/phpmailer/phpmailer/src/Exception.php";
require_once "./vendor/phpmailer/phpmailer/src/PHPMailer.php";
require_once "./vendor/phpmailer/phpmailer/src/SMTP.php";

$email = isset($_POST["email"]) ? $_POST["email"] : null; //"" da diyebiliriz

$subject = isset($_POST["subject"]) ? $_POST["subject"] : null;

$content = isset($_POST["content"]) ? $_POST["content"] : null;

//Ilk olarak biz herzaman php tarafindan form dan gelen dataya validation yapacagiz
//bosluklari ve kullanicinin yapabilecegi trikleri dusunerek guvenli bir validation yapabiliriz
//Yani biz backend validation i yaptiktan sonra phpmailer islemlerine baslayacagiz..mantigmiz bu olacak

if (!$email && !$subject && !$content) {
    echo "Please fill the blank fields";
} else {
    $mail = new PHPMailer(true); //PHPMailer sinifini baslatiyoruz
    //Burda da artik try-catch blogumuzu baslatacagiz
    try {
        $mail->SMTPDebug = 2;
        $mail->isSMTP(); //SMTP YI BASLATIYORUZ
        $mail->Host = "smtp.gmail.com"; //HOST UMUZUN ADRESINI GIRERIR
        $mail->SMTPAuth = true; //Smtp dogrulamasi yapilsin diyoruz


        $mail->Username = "ademtest3454e@gmail.com";
        $mail->Password = "";
        $mail->SMTPSecure = PHPMAILER::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = "utf-8";
        //$mail->setLanguage("no"); istersek boyle birsey de yapabiliriz

        //Burasinin da olmasi gerekiyor hata allmamak icin
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );


        //Recipients-Alici ile ilgili bilgiler
        $mail->setFrom("ademtest3454e@gmail.com", "Adem Erbas");
        $mail->addAddress($email);
        //Mesaj kime gidiyor, kime cevap veriliyor bunu yazacagiz
        $mail->addReplyTo("ae@netsense.no", "Adem Erbas testmail address");
        // $mail->addCC();
        // $mail->addBCC();

        //Attachment-dosya gonderme, yukleme islemi icin burasi
        //Dosya ekleme icin bir kontrol olusturmamiz gerekiyor
        //file altinda gecici saklanan bir dosya yolu oluyor temp ile yani temporary demek, yani $_FILES icerisinde
        //gecici olarak tutulan bir dosya yolu var 
        if (isset($_FILES["attachment"]["name"])) {
            $mail->addAttachment($_FILES["attachment"]["tmp_name"], $_FILES["attachment"]["name"]);
        }
        //Burdan da gecerse yani dosya yuklenir ise o zaman burdan devam ededcegiz

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $content;

        $mail->send();
        echo "Basari ile gonderildi";
    } catch (Exception $ex) {
        //throw $th;
        echo $ex->getMessage();
    }
}
