<?php 


//1-curl i baslat
$curl=curl_init("http://localhost/test/PHP-works/php-cURL/php-curl-file-upload/form.php");


//2-curl ayarlari yap 
curl_setopt_array($curl,[
CURLOPT_RETURNTRANSFER=>true,
CURLOPT_POST=>true,
CURLOPT_POSTFIELDS=>[
    "name-surname"=>"Zehra Erbas",
    "file"=>new CURLFile("WebOblig2.zip","text/plain")
]

]);

//Baglanip da dosya upload etmeye calistigimz site bot baglnatilara karsi onlem olarak sadece txt dosyasi gonderilsin diye bir onlem aldi ama ben o onleme ragmen, bir zip dosyaini gonderdim ama mimetype ini  "text/plain" yani .txt olarak girdigm icin baglandigm site bu dosyayi .zip olarak degil .txt olarak algiladi ve dosyamizi kabul etmis oldu uzak server a kendi sunucumdan curl yardimi ile istedgimiz tipte bir dosya gondermis olduk..
//php burda bize CURLFile class ini veriyor inbuild olarak
//Bu onemli bir acik..
/*
mimetype larin ne oldugunu bilmemiz gerekir dosyalar upload edildikleri zaman arkada taninmak icin tutulduklari type lar vardir bunlara mimetype deriz ve  bunlari internetten ne oldugnu anlayabiliriz
BIZ mimetype i 2.parametrede vermezsek eger, kendisi mimetype i farkli birsey atayacak ondan dolayi mimetype i da biz atayalim,.txt dosyasinin mimetype i "text/plain" dir
public string $name = "";
public string $mime = "";
public string $postname = "";

*/

//3-curl i execute edelim 
$source=curl_exec($curl);

//4-curl i kapatalim 
curl_close($curl);

echo $source;

?>