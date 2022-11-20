<?php 


//ftp_mkdir-ftp de klasor olustur
//ftp_rmdir-ftp de klasor sil
//ftp_chdir-ftp de dizin,klasor degistirmek icin
//ftp_pwd-ftp de mevcut-current dizini donusturur

error_reporting(E_ALL ^ E_WARNING);
//BU SEKKILDE BIZ WARNING MESAJININ EKRANA BASILMASINI ENGELLEYEREK KENDIMIZ HATA MESAJINI DONDUREN BASKA BIR METHOD CALISTIRIP DAHA ISABETLI KULLANICI DOSTU BIR HATA MESAJI EKRANA BASARAK, UYGYLAMAMIZI DAHA KULLANISLI HALE GETIRMIS OLUYORUZ....BESTPRACTISE.....
//185.215.199.212 - cpweb07.misshosting.no - ademtest - j8mVY9d)1!r0GD
//ftp_connect("185.215.199.212");//Burda ip adresi yani host adresini yaziyoruz
//biz ftp_connect("")parametreye server imizin ip adresini yazariz ancak, host adres te zaten ip adres ile ayni seydir aslinda
//$conn_id=ftp_connect("cpweb07.misshosting.no"); bu sekilde de baglanabiliriz
//ftp_connect() parametrsine hostingimizin ip adresini giriyoruz, host adresinmizi
//Eger basarili bir bir sekilde sunucuya baglanabilirsek bize bir connection id si donduruyor
$domain_name="http://ademtest.site/";
$ip_address="185.215.199.212";
$host_name="cpweb07.misshosting.no";
$username="ademtest";
$psw="j8mVY9d)1!r0GD";

$ftp_conn=ftp_connect($ip_address);

if($ftp_conn){
echo  "Your ftp-connection is successfully";
    $login=ftp_login($ftp_conn,$username,$psw);
    if($login){
        echo "Your ftp-login is successfully"."<br>";
        //Tum kontrollerimz dogru bir sekilde yapildiktan sonra artik burda php-ftp dosya islemlerine baslayabiliriz
        //Su an baglandik ftp araciligi ile, serverimiz da hangi klasor icerisindeyiz ona bakariz oncelikle
        //echo ftp_pwd($ftp_conn);// Ana dizindd oldugmuzu gosteriyor / sadece slash donerek yani aslinda public_hmtl in oldugu dizindeyiz
      //public_html dizinine gelmek icin
      ftp_chdir($ftp_conn,"./public_html");//. demek icinde bulundugmz dizin demektir
      //BU COK ONEMLI, BIZE COK YARDIMCI OLACAK, DIZINI DEGISTIRMEMIZI SAGLIYOR...

    //  echo ftp_pwd($ftp_conn);///public_html
      //public_html icerisinde bir klasor olusturmalyiz
      //FTp de Folder olusturmak
    //  $create=ftp_mkdir($ftp_conn,"test");//test isminde bir folder olusturduk
//Eger basarili ise ousturudmugz klasor ismini dondurur basariszi ise false dondurur yani 0
  $create=ftp_mkdir($ftp_conn,"adem-test");//test isminde bir folder olusturduk
  if($create){
echo $create." folder is created successfully";
  }else{
    $error=error_get_last();
    echo $error["message"];

  }


//FTP DE DOSYA LISTESINI GORMEK ICIN
$path=".";
$files = ftp_nlist($ftp_conn, $path);
print_r($files);

//FTP DE DOSYA SILMEK
// $delete=ftp_rmdir($ftp_conn,"test");

// if($delete){
//     echo "deleted successfully";
// }else{
//     $error=error_get_last();
//     echo $error["message"];
// }

    }else{
        $error=error_get_last();
        echo $error["message"];
    }

}else{
    $error=error_get_last();
    echo $error["message"];
    die("FTP connection error invalid ".$ip_address);
}

?>