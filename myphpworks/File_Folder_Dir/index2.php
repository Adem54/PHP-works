<?php 
//Dosyalari 2 farkli yontemle cagirabiliyoruz, include ve require
//Include:Include da dosya cagirdigmizda o dosya bizde yoksa bile sadece warning veriyor ama sistem calismaya devam ediyor
//require:Require ile cagirdigmzda eger dosya yok ise o zaman fattal error-olumcul  hata vererek sistemin calismasini durduryor

//@include("test.php");
//echo "test";
//Sadece warning veriyor ve echo ile yazdgimz mesajimizi yine gorebiliyoru ayrica o warningi de include basina @ koyarak kaldirabiliyoruz veya gizleyebiliyourz


//require "test.php";//Eger dosya yok ise fattal_eror veriyor ve alttan gelen echo mesajini yazdirmiyor burda
//echo "</br>  require-test";

//a.php mizi her iki sekilde de cagirabiliriz parantez icine de alabiliriz veya disarda da cagirabiliriz
// include ("a.php");
// include "a.php";
// require ("a.php");
// require "a.php";

//include_once-require_once:
//include_once
//require_once
//Asagidaki gibi 2 kez require ile a.php yi cagirirsak 2 kez a.php dosyasinin icerigini getiriryor icinde bulundgumz dosyaya
// require "a.php";
// require "a.php";
//Bu sekilde cagirirsak dikkat edelim 2 kez ayni dosyayi yazar
//Ama biz ornegin bir suru dosyamiz var ve unuttuk ve birden fazla kez ayni dosyayi cagirdik diyelim hata yapmamamk icin 
//require_once veya include_once ile kullaniriz ki birden fazla kez cagirsak bile o 1 kez cagirsin diye...onemli...

//Ama bu sekilde 4 kez bile yazsak require_one ile cagirdgimz icin once icindeki dosyaya bakiyor sayfda daha onceden cagirilmis mi var mi 
//diye o zaman bir daha cagirmiyor....
// require_once("a.php");
// require_once("a.php");
// require_once("a.php");
// require_once("a.php");

//include_once ile require_once farki da yine ayni sekkilde include_once dosya yok ise warning verip calismaya devam ederken
//require_once ise fattal_error olumcul hata verir ve sonraki kodlari da calistirmaz

//PEKI BU ISLEMLERI NERDE KULLANIYORUZ
//Biz ozellikle tema parcalama olaylarinda header,footer dosyalarini surekli surekli yazmak yerine 1 dosya haline getirip
//parcalayip yapacagimz tum farkli sayfalarda header ve footer i cagiracagiz...

//DEGISKEN KULLANIMI...COOK ONEMLI
//Ayni zamanda biz ornegin index.php sayfamizda yani icinde bulundugjmz sayfada title diye bir degisken olsturduk ve bu sayfada biz 
//header ve footer php dosyalarini cagirdik...ne yapabiliriz bu title degiskenin bu sayfaya disardan requre veya include ile hangi sayfalari dahil ettik ise o sayfalarin hepsinde bu sayfada olusturdumuz degikenleri kullanabiliriz

$title="Adem Erbas";

function test(){
    echo "<h4>This is test</h4>";
}
require_once("header.php");
// require_once("about.php");


?>
<h2>CONTENT</h2>
<?php

require_once("footer.php");
?>