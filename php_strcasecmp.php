<?php 
/*
Bazen yönetim paneline girişleri veritabanı yerine dosyada tutuyorum. Basit bir if-else kontrolü ile giriş yaptırıyorum. Bu gibi durumlarda, kullanıcı adı ve şifre nasıl yazıldıysa aynen o şekilde yazdırmak gerekiyor. Yani büyük küçük harfe vs. duyarlı oluyor. Bu gibi durumlar için PHP’de karşılaştırma fonksiyonları var. Örneğin 2 ifadenin doğruluğunu karşılaştırıyor. Mesela;

*/
// $a = 'Adem';
// $b = 'Adem';
// echo strcmp($a, $b); // Çıktı: 0
//Eğer sonuç 0 ise, ifadeler birbirine eşit demektir. Ancak bu örneği şöyle değiştirseydik;
$a2 = 'Adem';
$b2 = 'adem';
echo "<br>";
echo strcmp($a2, $b2);//-1  gelir ve esit degil ed
/*
Bu durumda ifadeler birbiriyle eşleşmiyor çünkü büyük küçük harf problemi devreye giriyor. Bunu çözmek için ise strcasecmp() fonksiyonunu kullanabiliriz. Aynı örneği birde şöyle yapalım;
*/

$a2 = 'Adem';
$b2 = 'adem';
echo "<br>";
echo strcasecmp($a2, $b2);//0 gelir esit demektir
?>