<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'inc/config.php';


//1-HER ZAMAN KULLANICI DATA LARI GIRIP DE BURAYA GONDERDIGI ZAMAN DATALAR GELMIS MI ILK OLARAK ONU YAPARIZ ONU KONTROL EDERIZ EGER DATALAR BIZIM IISTEDIGMZ GIBI GELMIS ISE DOLDURULMUS  ISE ALANLAR O ZAAMAN DEVAM ET YOLUNA DIYORUZ
if ( $_POST ) 
{
	//Veriler geldi ise buraya girecek ve biz burda da gelen datalari veritabanina girmek istiyoruz
	$adi_soyadi = $_POST['adi_soyadi'];    
	$telefon    = $_POST['telefon'];    
	$email      = $_POST['email'];    
	$mesaj      = $_POST['mesaj'];    

	// DB::insert("INSERT INTO iletisim(adi_soyadi,telefon,email,mesaj) VALUES(?,?,?,?)",array(
	// 	$adi_soyadi,
	// 	$telefon,
	// 	$email,
	// 	$mesaj
	// ));


	$mail_icerik = "Merhaba yönetici, sitenizden yeni bir iletişim formu gönderildi. Bilgileri aşağıdadır.";
	$mail_icerik .= "Adı Soyadı: $adi_soyadi<br>";
	$mail_icerik .= "Telefon: $telefon<br>";
	$mail_icerik .= "Email: $email<br>";
	$mail_icerik .= "Mesaj: $mesaj<br>";


	require 'phpmailler/src/Exception.php';
	require 'phpmailler/src/PHPMailer.php';
	require 'phpmailler/src/SMTP.php';



	$mail = new PHPMailer(true);

	try {

		$mail->SMTPDebug = 0;                      // Enable verbose debug output
		$mail->isSMTP();                                            // Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		$mail->Username   = 'ademtest5434e@gmail.com';                     // SMTP username
		$mail->Password   = 'Sakarya5466!';                               // SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		//Burasinin da olmasi gerekiyor hata allmamak icin
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);

		//Recipients
		$mail->setFrom('ademtest5434e@gmail.com', 'iletisim - formu');//Mail de kimin ismi gozuksun
		$mail->addAddress('ae@netsense.com', 'Adem Erbas netsense');   //Alici adi soyadi  



		$mail->isHTML(true);  
		$mail->CharSet = 'UTF-8';                 
		$mail->Subject = 'Sitenizden iletisim formu gönderildi.';
		$mail->Body    = $mail_icerik;
		$mail->AltBody = $mail_icerik;

		$mail->send();
		
	} 
	catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		die();
	}

	header("Location:iletisim.php?success=1");
}

?>