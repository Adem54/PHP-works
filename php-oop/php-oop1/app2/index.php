<?php

//Biz su anda app2 klasoru altindayiz ve direk yazmak istersek o zaman
//kendimiz klasorlerden giderek inceleyecek olursak
//http://localhost/test/php-oop/php-oop1/app2/ bu sekilde ve bunun altinda index.php miz var onun icinde de biz
//app2 altindaki controller altindaki home.php yi cagiriyoruz
//require_once controller/home.php  bu sekilde yazariz ama DIR ile yazmak istersek de o zaman
//da  require_once __DIR__."/controller/home.php"; bu sekilde yazariz
//require_once __DIR__."/controller/home.php";
//echo __DIR__;//C:\Users\ae_netsense.no\utv\test\php-oop\php-oop1\app2
//Ya da istiyrosak eger en bastan itibaren bu sekilde detayli yazabilriz ama
//require "/Users/ae_netsense.no/utv/test/php-oop/php-oop1/app2/controller/home.php";

//echo __DIR__;//C:\Users\ae_netsense.no\utv\test\php-oop\php-oop1\app2

//Tamam bu islemler illak i bu sekilde yapilacak ama biz bu islemi biraz daha otomatik yapabilmeyi dusunecek olursak

//autoloadController fonksionumuz bizim Controller imzi altindaki dosyalarimizi otomatik bir sekilde yukleme islemini yapacak
//spl_autoload_register("autoloadController");
//Biz otomatik bir sekilde tum app2 altindaki Controller klasoru altindaki class lari cagirabiliyoruz bu sekilde
function autoloadController ($className){
    // echo $className."<br>";//Olmayan bir class i cagirirsak once buraya dusuyor bu className otomatik olarak buraya geldi
      $classFile= __DIR__ ."/controller/".strtolower($className).".php";
   //  echo "test: ". $classFile;//C:\Users\ae_netsense.no\utv\test\php-oop\php-oop1\app2/app/controller/Homee.php bu sekilde geliyor
      //Ama H buyuk geliyor home.php de bizim onu kucultememiz gerekiyor
      //C:\Users\ae_netsense.no\utv\test\php-oop\php-oop1\app2/app/controller/home.php
     if(file_exists($classFile)){
        require_once $classFile;
     }
 }

 //Bu sekilde de app2 klasoru altindkai Helper klasoru altindaki tum class lari cagirabiliyoruz
 function autoloadHelper ($className){
      $classFile= __DIR__ ."/helper/".strtolower($className).".php";
     if(file_exists($classFile)){
        require_once $classFile;
     }
 }


 //Namespace leri kullandiktan sonra classsName artik-App2\Controller\Home bu sekilde geliyor bize
 //O zaman biz namespace ler kullandigmiz zaman otomatik yukletme islemini cok kolay birsekilde yapabilirz
 //App2\Controller\Home burda \ i normal / ile degistirmemiz gerekiyor
function autoloadClass($className){
    $className=strtolower(str_replace('\\','/',$className)).".php";// ters slaslari \\ 2 kez yaziyoruz ki \ 1 tane ters slas olarak algilasin diye yoksa
    // \ in ayrica da anlami oldugu icn direk \ yazarak yazamioruz zaten, ters slasi \ normal slas ile  degistiriyoruz
    echo "<br>".$className;//app2/controller/home.php
    echo "<hr>";
    require $className;
}



//EGER NAMESPACE KULLANMAZ ISEK DE O ZAMAN KLASOR KLASOR AYRI BIRER AUTO LOAD FONKSIYONLARI TANIMLAYARAK ISLEMIMIZI YAPABILIRIZ
// spl_autoload_register("autoloadController");
// spl_autoload_register("autoloadHelper");

//NAMESPACE KULLANMAK SARTI ILE BIZ, REQURE LARI AYRI AYRI KULLANMAK YERINE...BIR FONKSIYON YAZDIK VE ARTIK ISTEDGIMIZ GIBI OTOMATIGE BAGLAYARAK
//ISTEDGIMZ KADAR CLASS I ARTIK BURDAKI INDEX.PHP DOSYAMZ ICERISINDE KULLANABILYORUZ
 spl_autoload_register("autoloadClass");


//Normalde biz bu sekilde namespace leri ile birlikte olusturabiliyorduk
// require_once (__DIR__."/controller/home.php");
// require_once (__DIR__."/helper/contact.php");
use Controller\Home as MyHome;
use Helper\Contact as MyContact;





$home=new MyHome();
echo $home->Test();//HomeTest seklinde calistirabiliriz..
echo "<br>";
$contact=new MyContact();
?>