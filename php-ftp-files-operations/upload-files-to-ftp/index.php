<?php 

//ftp_put()
//ftp_nb_put() fonksiyonu
//Ikisi arasindaki fark nb-nonblocking yani, ftp_nb_put ile yapilan islemler asenkron olarak calisiyor yani yukleme islemi esnasinda baska islemlerde yapabiliyorum demek, php nin yapisi geregi, senkron olarak calisyor yani es-zamanli yani ayni anda iki islem yapmiyor islemleri sirasi ile yapar...Ama ftp nin non-blocking ozelligi ile dosya yuklenirken baska islemlerde yapabilyoruz ftp_nb_put() ile


$domain_name="http://ademtest.site/";
$ip_address="185.215.199.212";
$host_name="cpweb07.misshosting.no";
$username="ademtest";
$psw="j8mVY9d)1!r0GD";


function showErr(){
    $error=error_get_last();
    if(isset($error["message"])):
        return $error["message"];
    endif;
}

$ft_conn=ftp_connect($ip_address);
if($ft_conn){
    echo "FTP connection successfull";
    $login=ftp_login($ft_conn,$username,$psw);
    if($login){
        echo "Your ftp-loggin is successfull"."<br>";
        //Dizinimizi public_html olarak belirleyelim
        ftp_chdir($ft_conn,"./public_html");
        echo ftp_pwd($ft_conn);   
        //LOKALDEKI DOSYAMIZI FTP-FILE TRANSFER PROTOKOL ARACILIGI ILE, SERVERIMIZA UPLOAD ETMEK
        //ft_put($ft_conn,remote_file_name(upload edecegmiz dosya adi server da ne olsun),lokaldeki dosya yolumuz,FTP_BINARY)
        // $upload=ftp_put($ft_conn,"adem_er.txt",__DIR__."/my-test.txt",FTP_BINARY);//FTP_BINARY yazmmaiz yeterlidir
        // if($upload){
        //     echo "File uploaded succesfully";
        // }else{
        //     echo "File uploading is failed";
        // }
        //COOK ONEMLI BESTPRACTISE...FTP_NB_PUT KULLANIMI
        //ftp_nb_put-Ornegin cok buyuk boyutlu video dosyasi veya baska turludosyalari ftp yuklerken cok uzun zaman aliyor ve biz ornegin islemi iptal etsek bile o arkada calismaya devam ediyor ve sistemi cok agirlastiriyor ve bize baska hicbir islem de yaptirmiyor iste boyle durumlarda, biz ftp nin asenkron dosya yapisindan faydalanarak ftp_nb_put u kullanarak islem yapariz

          $upload=ftp_nb_put($ft_conn,"adem_image.jpg",__DIR__."/helena.jpg",FTP_BINARY,FTP_AUTORESUME);//FTP_AUTORESUME SAYESINDE EGER  YUKLEME ESNASINDA YUKLEMEYI DURDURURSAK OTOMATIK OLARAK KALDIGI YERDEN DEVAM ETMESINI SAGLAYABILIRIZ  
          while($upload==FTP_MOREDATA){//true ise yukleme islemi hala devam ediyor demektir
            
            //Burda yukleme esnasinda yapmak istedimgiz basksa islem yapabilirz
            echo "Asenkron uploading example". rand(1,999). "<br>";
            
            //Yuklemeye devam edecegiz..Satir satir byte byte yukleme yapiyor gibi dusunelim..
            $upload=ftp_nb_continue($ft_conn);//bu fonksiyon ile yuklemeye devam etmis olacak ve while her calistiginda while icinde yazdgmiz kodumuz ekranda gozukecek
            //Ayrica ft_nb_put ile islem yapmamiz sayesinde biz istedgimz zaman da yuklemeyi durdurabiliyoruz sorunsuz bir sekilde...
            //Bu da cok harika birsey cunku ozellikle buyuk boyutlu dosyalarda eger asenkron ft_nb_put yapmaz isek o zaman islem cok agir islemenini yaninda istedgmiz zaman da durduramihyoruz kapatsak bile arkada calisip ciddi mana da kasarak bize baska bir islemde yaptirmayabilir belli bir sure
          }



    }else{
        echo showErr();
    }
}else {
    die("FTP connection failed with your ip: ".$ip_address);
}



?>