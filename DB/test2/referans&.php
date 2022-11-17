<?php 

function increase($a){
    $a++;
    return $a;
}

$a=5;
echo increase($a)."</br>";//6
echo increase($a)."</br>";//6
echo increase($a)."</br>";//6
//Biz normalde fonksiyonlarimiza paramtre gecerken, o fonksiyonu invoke ederken
//biz o fonksiyona bir parametre veririz, bir deger atanmis degisken veririz ornegin
//Boyle durumlarda biz parmetreye aslinda o degiskenin kendisini degil, degerini vermis oluyoruz
//Yani degisken degerini birakir paramtreye ve parametre ile artik hic isi kalmaz ve onun icerde
//yapacagiz islemden de etkilenmez
echo "---------------------</br>";

//Ancak eger biz parametreye gectigimz degeri & ile referans olarak gecersek o zaaman isler degisiyor
//Artik biz parametreye invoke ederken verdgimz degiskenin degerini degil degisken olarak veriyoruz ve 
//o degiskeni de referans type yaparak, class imiz new lendiginde bu degisken in her seferinde fonksiyon icinde
//maruz kaldigi islem disardakii degiskene de yansiyor cunku artik referans type yani mutable  olmus oldu
//Asagidaki ornekte de gorebilecegimz gibi bu c# daki out-ref keywordleri ile kullanmanin aynsidir

function increase2(&$a){
    $a++;
    return $a;
}

$a2=5;
$a3=10;
echo increase2($a2)."</br>";//6
echo $a2."</br>";//6
echo increase2($a2)."</br>";//7
echo $a2."</br>";//7
echo increase2($a2)."</br>";//8
echo $a2."</br>";//8
echo increase2($a3)."</br>";//11


 class Person {
   public $value=5;

   public function &getValue(){
        return $this->value;
   }

}

echo "---------------------</br>";

$person1=new Person();
$key=&$person1->getValue();
echo "$key </br>";
$person1->value=10;
//Biz direk value icinde degisiklik yaptik ve istiyoruz ki bu degisklikten
//bundan once fonksiyonu invoke ettimiz degerlerde etkilensin cunku fonksion icinde bu deger
//invoke ediliyor yani aslinda sunu diyoruz sen artik referans bir type sin diyoruz fonksiyona ve
//icindeki kullandigin integer turlu deger eger sonra dan degistirilir ise bu degisikligi
//bundan once bu degiskeni kullandigin heryere yansitmalisin diyoruz ve oyle de oluyor


echo "$key </br>";

?>