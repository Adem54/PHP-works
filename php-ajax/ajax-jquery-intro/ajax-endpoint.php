<?php 

//app.js icerisinde bir ajax asenkron datasi gonderiliyor, yani request server a php ye ve php tarafinda biz
//buna gelen datayi tekrar gondererek karsilik response etmis olduk
//bunu network tarafinda index.php de iken inspect yapip networku kontrol ederek inceleyebiliriz
//Burda ajax post istegi yaptigi icin biz datayi post ile aldik, yok bize get istegi yapsa idi biz get ile alirdik o istegi
//post istegi yapildigi zaman biz index.php acikken network de ajax.php olarak goruruz sadece dosya ismini istek yapilan dosya ismini goruruz sadece
//Istegimiz get olsa idi o zaman da NETWORK DE istek ajax.php?name=Adem&surname=Erbas bu sekilde gozukecek idi..dikkat edelimm...
//index.php inspect yapip nettvork de yapilan get istegini yeni bir tab da acar isek zaten biz ajax.php de yazdigmiz cevabmizi gorebiliriz
//http://localhost/test/php-ajax/ajax-jquery/ajax.php?name=Adem&surname=Erbas
//Ve o zaman POST ILE DEGIL $_GET ile alirdik kullaniciidan gelen istekleri server tararfinda yani php tarafinda
//Daha guvenli oldugu icin genellikle ajax sistemlerimizde post islemi kullaniyoruz

// echo "Our response is:"."\n";
// echo $_POST["name"];
// echo "\n";
// echo $_POST["surname"];

//Burda biz json formatinda cevap donemk ister isek
// $res=[
//     "id"=>1,
//     "name"=>$_POST["name"],
//     "surname"=>$_POST["surname"]
// ];

// echo json_encode($res);

//Gonderilen get requestine response vermis oluyruz burda
// echo json_encode([
//     "name"=>$_GET["name"],
//     "surname"=>$_GET["surname"]
// ]);

print_r($_POST);
?>