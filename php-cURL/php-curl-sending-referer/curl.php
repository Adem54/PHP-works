<?php 


//1-once curli baslatiyoruz
$curl=curl_init();

//2-curl ayarlarini belirleyelim 

curl_setopt_array($curl, [
    //hangi siteye baglanip data cekmek istiyorsak orayi yaziyoruz
    CURLOPT_URL=>"http://localhost/test/PHP-works/php-cURL/php-curl-sending-referer/test.site.php",
    CURLOPT_RETURNTRANSFER=>true,
    CURLOPT_REFERER=>"https://wikipedia.no"

]);

/*
if(!isset($_SERVER["HTTP_REFERER"])){
    die("Bot girisimi engellendi!");
}
Normalde boyle degil de biz olayi gormek icin boyle ypaiyourz
Yani bizim herhangi bir siteye gondereceimiz curl istegi o siteye aslinda bir request olarak gidiyor dogal olarak ve o request detaylarina gidersek header icerisinde referer ile bot atan web sitesi kimligi gozukuyor, yani bot attigmiz websitesi bu adrese erisebiliyor
Bot girisimi engellendi!

Bizim o siteye bot attigmizda bize bu sekiilde bir mesaj ile o siteden geri donulebiliyor biz de bunu engellemk icin ne yapiyoruz ayarlaimizda fake bir referer adresi gondererek bot attgijimz site nin bizm adresimizi gormesini engelleyerek baska adres gormesini sagliyoruz... ve artik bot attgimz site bizi engelleyememis oluyor bu sekilde, ayarla kisminda 
    CURLOPT_REFERER=>"https://wikipedia.no" burayi ekleyerek
    simdi yazdirdgimiz $source adresini ekranda gorebiliriz artik ve de orda suraya dikkat edelim 
    HTTP_REFERER: "https://wikipedia.no",
    artik bu adresten atilmis gibi gosterecek bot attgimiz web sitesine
Genelde referer lar google com da arama ile gelmis gibi gosteriliyorlar
normal site tarafinda da referer bilgisini $_SERVER["HTTP_REFERER"] BU SEKILDE ALINIYOR

*/




//3-curl u execute ederiz
//curl i execute edince de bir degiskene aktarabiilioruz cunku ustte CURLOPT_RETURTRANSFER TRUE YAPTIK
$source=curl_exec($curl);

//4-curl i kapatiriz
curl_close($curl);

echo $source;
//Buraya ne geldi, siteye alakali hersey gelmis oldu, bizim baglanmak istedimgi site ile ilgili bilgiler gelmis oldu ama normalde biz test.site.php de de direk print_r($_SERVER); i yazdirdik ve o rda da ayni data geldi, hatta ordaki daha fazla 

?>