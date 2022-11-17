<?php 


$host = "localhost";
$username = "root";
$password = "123456";
$dbname = "myPdoDatabase";


//Yukarıda belirtilen veritabanına bağlan. Her iki halde veritabanı olacak. Ya önceden vardı ya da yeni oluşturuldu.

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Transaction başlatıyoruz
$conn->beginTransaction();

$isim='Anar';
$soyisim='Samadov';
$eposta='anar@samadov.net';


 //prepare methodu ile insert sorgumuzu yazıyoruz fakat değerler yerine gerçek değerleri yazmıyoruz
 $stmt=$conn->prepare("INSERT INTO isimler (isim, soyisim, email) VALUES (:isim, :soyisim, :email)");

 //değerleri bind etmenin bir diğer yöntemi

 $resultInsert=$stmt->execute([
     ":isim" => $isim,
     ":soyisim" => $soyisim,
     ":email" => $eposta,
 ]); //eğer başarılı bir insert işlemi olduysa sonuç true döner.

?>