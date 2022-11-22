<?php 
//$_FILES icerisine gelecek
//

/*
NOT KIMI ZAMAN, INPUT ALANLARI DOLDURULMAMASINA RAGMEN ISSET DEN GECIYOR BOS OLARAK GECIYOR 
YANI NULL GELMIYOR AMA STRING OLARAK BOS GELIYOR ONDAN DOLAYI BIZ INPUT FORMLARINDA KESINLIKLE BU 
EMPTY OLAYINI DA CEK ETMEMIZ GEREKIYOR BUNU UNUTMAYALIM...BESPTRACTISE.... 
*/

if(isset($_FILES["file"] ) && !empty($_FILES["file"]["name"]) ){
    // print_r($_POST);
    // print_r($_FILES);
    //Burda diyelim ki yuklenen dosyanin tipi .txt ise onu upload klasorum altina yukle diyecegiz
    if($_FILES["file"]["type"]=="text/plain"){
       // print_r($_FILES);
        move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$_FILES["file"]["name"]);
        //upload klasorumuz altinda test.txt dosyamizi gorebiliriz

    }
}
//Burdaki espiri su, eger bot request gonderen siteye baglanmyaa calisan kisi bizim kabul etmedigmiz bir tipte file gondermeye calisirsa onu  bu sekilde engelleyebiliriz ancak, yine uzaktan siteye baglanmya calisan kullanici da dosya tipini ornegin .zip gonderirken type ini .txt yani mime type ini "text/plain" olarak girerek gonderip bizim burda aldgimiz onlemi yine delebiliyor
/*
Bir dosyayı kalıcı olarak kaydetmek için move_uploaded_file($p1, $p2); fonksiyonu kullanılır.
 Bu fonksiyon iki parametre alır.

$p1 > Dosyanın geçici adıdır. Buraya $_FILES["dosya"]["tmp_name"] ifadesi yazılır.
$p2 > Dosyanın kalıcı yolu ve adıdır. Buraya ise istediğiniz bir yolu ve adı yazabilirsiniz.

$formdangelendosya=$_FILES["dosya"]["tmp_name"]; 
$eklenecekyol="upload/".$_FILES["dosya"]["name"]; 

if (move_uploaded_file($formdangelendosya,$eklenecekyol)) echo "Dosya başarı ile yüklendi."; } 
 else  { echo "Yükleme başarısız!"; 

*/

?>


<form action="" method="POST" enctype="multipart/form-data">

Name-surname: <br><br>
<input type="text" name="name-surname"> <br><br>
CV:
<input type="file" name="file"> <br><br>

<button type="submit" >Submit</button>
</form>