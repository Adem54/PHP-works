<?php 

//CURL ILE POST ISLEMLERI

//1-curl i baslatiriz
$curl=curl_init("http://localhost/test/PHP-works/php-cURL/php-curl-post-operation/form.php");

//ONEMLI!Bu arada url i curl_setopt_array icerisine yazmak yerine direk curl_init("") parametresine de baglanmak istedigmz url adrsini yazabiliyoruz

//2-curl ayarlarini yapariz 

curl_setopt_array($curl,[
     // CURLOPT_URL=>"http://localhost/test/PHP-works/php-cURL/php-curl-post-operation/form.php",
      CURLOPT_RETURNTRANSFER=>true,
      CURLOPT_POST=>true,
      CURLOPT_POSTFIELDS=>[
          "name"=>"Adem",
          "surname"=>"Erbas",
          "profession"=>"System utvikler",
          "submit"=>1
      ]
]);

//3-execute curl
$source=curl_exec($curl);

//4-close curl
curl_close($curl);

echo $source;//Burasi bize form.php nin icerigini basiyor ekranimiza..yani curl_post.php sayfasina
/*
Bu sekilde biz curl ile form.php nin datalarini gondermis oluyoruz
Gercekten ihityaci olan degerlerin gonderilmesi cook onemldir burda yani eger burda biz ornegin submit e gerek yok onu gondermeyelim dersek o zaman datalari alamayacaktik...Bu onemli atlanmamasi gereken bir noktadir
{
name: "Adem",
surname: "Erbas",
profession: "Developer",
submit: "1"
},
*/

//Biz asagidaki form degerlerini curl ile gondermek istersek nasil yaapcagiz ona bakalim
//Bir sitenin form kisminda action ne ise url de odur, form nereye post ediliyorsa o zaman url o dur
//Yani biz burda url olarak form.php yi aladcagiz demektir..form datalarin gidecegi yeri sececegiz curl ile datalari gondermek icin


?>