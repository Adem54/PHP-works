<?php 

/*
FTP- SERVER-CLIENT MANTIGINDA CALISIYOR
WINDOWS DA CLIENT-BROWSERS
LINUX DA CLIENT COMMAND LINE(TERMINAL)
FTP YE BAGLANILACAK VEYA DOSYA TRANSFERI SAGLANACAK BILGISAYAR
I

*/



//FTP-FILE TRANSFER PROTOKOL
//Lokal serverdan yani bilgisyarimizdan remote server a dosya aktarayabiliyoruz
//Ornegin bir projeyi bitridik ve artik bunu yayinlamak istiyoruz, internet ortaminda herkese ulasmasi icin bir alan adi satin aliyoruz birde bu dosyalarimizin barindirilmasi icin server a yani hostinge ihtyaciiz var niye 7-24 hic kapanmadan surekli olarak uygulamamiz gozuksun diye biz hosting saglayicilardan sitelerden hosting satin aldgimz zaman onlar bize bir kullanici adi ve sifre veriyorlar ve ip adresi ve password veriyoarlar bize ve diyorlar ki bu ip adresini , kullanici adi ve sifreyi kullanarak dosyalarini senin icin actigimiz alana atabilirsin diyorlar iste bunu  yapmak icinde ftp protokolunu kullaniyoruz, bundan dolayi bu protokol de isletim sisteminden ve baglantinin turunden bagimisiz olarak calisiyor bu da su demek, biz hosting olarak linux hosting almis isek biz sadece linux tan linuxa dosya atmak zorunda degiliz, yani remote-serverimiz yani hostinimiz linux ise biz de isletim sistemi olarak linux kullanmak zorunda degiliz dosyalarimizi ftp prtokolu ile satin algimiz hosting alanian transfer ederken yani ftp isletimm sistemi ve baglanti turunden bagimsiz olarak calisiyor.
//Ayrica ftp ile klasor ve dosyalari yeniden adlandirabiliyoruz
//Ya da kullanici izinleri ayarlarini yapabiliyoruz
//Ftp yi kullanarak dosya transferi yapmak icin bizim remote server a ait kullanici adi ve sifreye ihtiyacimiz var
//Bu da zaten hosting satin alinca bizim mail adreismize geliyor username ve password
//Ftp nin filezilla isminde ftp programi var buraya serverimizin ip adresimizin username ve passwordunu yazarak server a bu arac ile baglaniyoruz ardindanda sol tarafta lokal dosyarlarimiz sag tarafta da server daki dosyalarmiz bulunuyor ve biz, burda lokalden server a veya serverdan lokale cok kolay bir sekilde dosya transferi  yapabiliyoruz, remote server a surukle birak yontemi ile yukleyebiliyoruz her turlu yeni klasoru oollusturma dosya ve klasor isimlerinde deigsikliklik yapma gibi her turlu degisikligii yapabiliyruz
//Bu tarz islemlerini hepsini ftp programi olan filezilla gibi programlar ile yapabildgimiz gibi direk php ile de yapabiliyoruz

//CONNECTION FTP BY USING PHP
//ftp_connect-sunucuya giris yapmamizi sagliyor
//ftp_login-server a giris  yapmamiiz sagaliyor
//error_get_last fonksiyonu bize olusan son hatayi gosterir
//Biz ornegin ftp ile ilgili baglanti problemi aldgimiz zaman ftp fonksiyonlari bize php hatasini gostermiyor ve hata nin
//turunu cesidni vs bilemiyoruz bunun icin burda hatayi yonetebilmek icin error_get_last fonksiyonunu kullanabiliriz

//BUUU COOOK ONEMLI BIR BESTPRACTISE DIR...
error_reporting(E_ALL ^ E_WARNING);
//BU SEKKILDE BIZ WARNING MESAJININ EKRANA BASILMASINI ENGELLEYEREK KENDIMIZ HATA MESAJINI DONDUREN BASKA BIR METHOD CALISTIRIP DAHA ISABETLI KULLANICI DOSTU BIR HATA MESAJI EKRANA BASARAK, UYGYLAMAMIZI DAHA KULLANISLI HALE GETIRMIS OLUYORUZ....BESTPRACTISE.....
//185.215.199.212 - cpweb07.misshosting.no - ademtest - j8mVY9d)1!r0GD
//ftp_connect("185.215.199.212");//Burda ip adresi yani host adresini yaziyoruz
//biz ftp_connect("")parametreye server imizin ip adresini yazariz ancak, host adres te zaten ip adres ile ayni seydir aslinda
//$conn_id=ftp_connect("cpweb07.misshosting.no"); bu sekilde de baglanabiliriz
//ftp_connect() parametrsine hostingimizin ip adresini giriyoruz, host adresinmizi
//Eger basarili bir bir sekilde sunucuya baglanabilirsek bize bir connection id si donduruyor
$domain_name="http://ademtest.site/";
$username="ademtest";
$psw="j8mVY9d)1!r0GD";


//COOK ONEMLI...BU TARZ BAGLANTI ISLEMLERI KESINLIKLE TRY-CATCH ILE ELE ALINMALDIR, HANLDE EDILMELIDIR KI HATA DURUMLARI KONTROLUMUZ ALTINDA OLSUN

//error_get_last() i bu sekilde fonksyon icinde hazirlayip direk fonksiyhonu kullanmamai zdaha pratik bir kullanisdir
//BESTPRACTISE KULLANIMDIR..COK MANTIKLI BIR KULLANIMDIR
function showError(){
    $error=error_get_last();
    if(isset($error["message"])){
        return $error["message"];
    }
}
$ftp_server="185.215.199.212";
    $conn_id=ftp_connect($ftp_server);
if($conn_id):
    echo "FTP baglantisi basarili"."<br>";//Baglanti basari ile gerceklesti
    //Baglanti basarili bir sekilde gerceklestikten sonra da ftp ye login-giris yapmamiz gerekiyor
    //ftp_login("connection_id","username","password");//server a giris icin bize verilen username ile passwordu girecegiz burda

    $login=ftp_login($conn_id,$username,$psw);
    if($login){
        echo "FTP ye giris yapildi";
    }else {
     //  $error=error_get_last();//Bu olusan en son hatayi yakaliyor ve bize simdi bir hata dizisi dondurecek..
    //Bu yontem cok enteresan bir sekilde, ftp login islemi yapmaya calisirken calisiyor ama ftp-coonect hata durumunda devreye girmiyor
   // print_r($error);
 //echo $error["message"];
 echo showError();
// echo "FTP ye giris yapilamadi";
/*
{
type: "2",
message: "ftp_login(): Login authentication failed",
file: "C:\Users\ae_netsense.no\utv\test\PHP-works\php-ftp-files-operations\ftp\index.php",
line: "37"
},
*/
    //  echo "FTP ye giris yapilamadi";
    }
else:
    $error=error_get_last();//Bu olusan en son hatayi yakaliyor ve bize simdi bir hata dizisi dondurecek..
    //Hata ile bas etme yontemlerinden birisi de budur
    print_r($error);
     die("Couldn't connect to ".$ftp_server); 
    //BESTPRACTISE...die() methodu ile biz hata durumundan bu sekilde bir hata meaji da donebiliyoruz....HARIKA BESTPRACTISE...
    //NOT:error_get_last() exception artik calismiyor....unutma!!!BUNU BILMEK COOK ONEMLIDIR
    //var_dump($error);
 //   echo  "FTP baglantisi basarisiz"; 
 // Throw exception ILE KENDIMIZ HATA VEREBILIRIZ
throw new Exception("Uncaught exception occurred!");
endif;

?>