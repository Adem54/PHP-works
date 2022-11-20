<?php 

//ftp_get
//ftp_nb_get


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
echo "Your FTP connection is successfully"."<br>";
$login=ftp_login($ft_conn,$username,$psw);
if($login){
    echo "You logged in FTP successfully";
    ftp_chdir($ft_conn,"./public_html");

//DOWNLOAD FILE FROM FTP TO LOCAL
    //     $download=ftp_get($ft_conn, __DIR__."/adem_helena.jpg","adem_image.jpg",FTP_BINARY);
// if($download){
//     echo "Your download is successfully";
// }else{
//     echo showErr();
// }
//DOWNLOAD BIG SIZE FILE FROM FTP SERVER TO LOCAL ASENCRON
//2.sirada bizim local de dosyamiz nerde ve hangi isimle download olmasini istersek onu yazariz, 3.parametre ise server daki dosyamizin ismi, ki direk yazioruz cunku biz yukarda ftp_ch ile zaten public_html klasoru, directory sine gelmistik
$download_asenkron=ftp_nb_get($ft_conn,__DIR__."/ademHelenaaa.jpg","adem_image.jpg",FTP_BINARY,FTP_AUTORESUME);//dosya indirilirken durdurulurs sonra kaldigi yerden devam edebilmesi icin FTP_AUTORESUME ayarini da ekleriz

//ftp_nb_get() ile buyuk dosyalarin download islemleri daha kontrollu, istedgimz zaman durdurabiliriz ve sonra da istdgimz zaman kaldigmiz yerden devam edebiliyoruz normalde ftp_get ile buyuk dosya indirmeye calirsak cok yavas agir calismasinin yaninda o esnada baska islemlerde yapamayiz hem de, durdurmak istedgimzde tam durduramayadabiliriz arka planda yine indirmeye devam edebiliyor
while($download_asenkron==FTP_MOREDATA){//Esitlik saglandigi surece,indirme devam ediyor demektir

    echo ".....";
    $download_asenkron=ftp_nb_continue($ft_conn);//dongu her calistiginda indirmenin devam etmesini sagliyor
    //ki indirme yaparken baska islemlerde yaparken indirme islemimizde sorun yasanmamasi adina
}

}else{
    echo showErr();
}
}else{
    echo "FTP connection is failed";
}



?>