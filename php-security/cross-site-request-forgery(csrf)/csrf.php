<?php 

//CROSS SITE REQUEST FORGERY-CSRF SITELER ARASI TALEP SAHTECILIGI DEMEKTIR
/*
a.com diye bir web sitesi olsun ornegin
bir edit.php sayfasi var ve icinde de bir form var  ve submit butonu var 
a.com da edit sayfasinda sumbit yapilinca a.com/form.php ye gidiyor ornegin
kullanicii bilgileirini gonderiyor, verileri form.php ye gidiyor ve orda da kaydedilior ornegin 

sonra birde b.com isminde bir site ilgimizi cekti ve girdik bu siteye
Biz bu siteye girdigmiz anda arka planda, bu sitenin arka planinda bir ajax istegi ile
form.php ye senin bilgilerini post ederek, arka planda degistirmis olacak, cunku form.php de hicbir kontrol yapilmadigii icn
ve bu sekilde istenirse passwore bile mudaheele edilip degistirilebiliyor eger  yeterli kontroll ve guvenlik onlemi alinmadi ise

*/

require_once("db.php");

$id=1;

$query=$db->prepare("SELECT * FROM USERS WHERE ID=:id");
$query->execute([":id"=>$id]);
$user=$query->fetch(PDO::FETCH_ASSOC);
// print_r($user);

//db.php de olusturudugmuz ve sesssion a kaydettgimiz uniq token i burda da alabiliyoruz skntisiz bir sekilde
//echo $_SESSION["token"];
//Burda yapacagimz islem su, bu token  degerinide form da gondermek olacak, form icine bir input daha ekleriz ve 
/*<input type="hidden" name="token" value="<?=$_SESSION["token"] ?>">
Ve bu sekilde her serferinde farkli bir token olusturulacak, ve bu token i da session icerisine genel bir yerde yani token i nerde olusturdu isem orda kontrol edecegiz, ki token i tum dosyalari kapsayacak dosya da olusturacagiz
db.php de kontrol edecegiz token i
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form action="form.php" method="POST">
    About: <br><br>
  <textarea name="about" id="" cols="30" rows="10"><?php  echo $user["about"] ?> </textarea> <br><br>
<input type="hidden" name="token" value="<?=$_SESSION["token"] ?>">
  <button type="submit" name="submit" value="1">Submit</button>


</form>
</body>
</html>