<?php
 
// print_r($member);

//Yapacagimiz sey sey kullanicidan alacagmiz kullanici adi ve sifreyi bizde var olan kullanici adi ve sifre ile yani normalde database den gelecek olan kullanici adi ve sifre ile kiyaslayacagiz ve ardindan da eger kullanici adi ve sifre bizde var olan ile ayni ise, o zaman login olmasina izin verip sessin oturumunu baslatip kullanci bilgilerini sesssion da da tutaacagiz..ve dikkat edelim biz 1 tane type i hidden yaparak 1 tane gizli input tutuyoruz o inputa hazir bir value degeri veriyoruz ki , ondan gelecek olan datayi da gorebilmeki icin, value 1 eger, $_POST icine duserse o zaman demekki form submit edilmis demektir, submite tiklanmis yani butona basmis vatandas demektir, name i de submit yapiyoruz ve bu inputu kontrol ediyoruz...eger name i submit olan bir input gonderilmis ise o zaman form submit edilmis demektir

//BESTPRACTISE...HATALARI YONETIRKEN...BIR HATA DETGISKENIMIZE HATANIN TURUNE GORE ATIYORUZ VE O DEGISKEN NERDE TAKILIRSA O HATA MESAJINI ALACAK VE BU SEKILDE DINAMIK BIR SEKILDE HANGI HATAYA TAKIILMIS ISE O HATA MESAJI GELECEK HER ZAMAN...
if (isset($_POST["submit"])) {
    //print_r($_POST);//Forma datyi girer submit yaparsak burda datayi gorururz {username:"adem54",password:"12345",submit:"1"}
    $user_name = $_POST["username"];
    $psw = $_POST["password"];
    //Once bu alanlar doldurulmus mu..onu cek ederiz...
   // if (empty($user_name) || empty($psw)) //!username || !password yani username veya passwordden birisi bos ise demektir
    if (!$user_name || !$psw) //!username || !password yani username veya passwordden birisi bos ise demektir
   
    {
        $error = "Please, fill in username or password";
    } else if ($user_name != $member["user_name"]) //Eger kullanici, bu alanlari doldurdu ise o zaman da neyi kontrol ederiz.. o zaman da
    {
        $error = "Your user_name is wrong";
    } else if ($psw != $member["password"]) {
        $error = "Your password is wrong";
    } else {
          //EGer kullanici user_name ve passwordu dogru girdi ise o zaman burda artik kullanici demekki buraya gelecek  
          //Yani kullanici giris yapmis oldu o zaman session da girilen username ve passwordu tutabiliriz artik ve session oturum degiskenini baslatabiliriz...
          //Demekki kullanici username ve passwordu dogru girer ise o zaman, biz session baslatacagiz
          $_SESSION["user_name"]=$user_name;
          $_SESSION["password"]=$psw;
          //BESTPRACTISE NORMAL SARTLARDA BURDA BIZ KULLANICI ID SINI SESSION A ATARIZ, BAZEN KULLANICI ADI DA ATANABILIR AMA NE KADAR COK SESSION A DATA ATANIRSA O KADAR COK RAM DEN YIYECEKTIR...BU ONEMLI..
          //SIMDI SESSION A DA DATALARI ATTIKTAN SONRA NE YAPACAGIZ YONLENDIRME FONKSIYONUMUZ VAR BIZIMI HEADER ADINDA ONU KULLANACAGIZ
          //Biz session i olusturup index.php ye yonlendirecegiz ki orda da zaten kullanici adini bulursa ardindan admin.php ye yonlendirecek
          header("location:index.php");
    }
}
?>

<?php
/* SIMDI BIZ NEDEN BOYLE BIRSEY YAPIYORUZ CUNKU...SUNU DIYORUZ EGER ERROR MESAJI GELIRSE O ZAMAN SEN BUNU YAZ YOKSA YAZMA DIYECEGIZ... */
//isset ile null degil ise yani var ise bir deger almis ise demektir
if (isset($error)): ?>
        <h5 style="color:red;"><?php echo $error;  ?></h5>
<?php endif;?>

</hr>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href=""
      rel="stylesheet"
    />
    <title></title>
  </head>
  <body>
<h3>    LOGIN PAGE</h3>
    <form action="" method="POST">
        <label for="username">Username</label> </br>
        <input  id="username" name="username" type="text"/></br></br>
        <label for="password">Password</label> </br>
        <input  id="password" name="password" type="password"/></br></br>
        <!--BURAYA BIR TANE GIZLI INPUT KOYARIZ BU COK ONEMLI DIKKAT EDELIM NEDEN ONEMLI, BIZ BU SAYEDE FORMUN POST EDILDIGINI ANLIYORUZ, YANI FORM POST EDILDI ISE MUTLAKA, BURDAKI INPUT DEGERI BIZE GELECEK BU INPUT BIZE GELIYORSA DEMEKKI FORM POST EDILMIS DEMEKTIR-->
        <input  type="hidden" name="submit" value="1"/>
    <button type="submit">Submit</button>
    </form>
  </body>
</html>