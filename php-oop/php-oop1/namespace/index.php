<?php 

//Namespaces in php
//Neden namespace leri kullaniyoruz
//Iki tane ayni isimlerde class tanimlayabilriz iste bu tarz ayni isimdeki class alri farkli namespace ler altinda olusturup kullanablriz

require __DIR__ ."/app/controller/video.php";
require __DIR__ ."/app/helper/video.php";

//Burda namespace ile birlikte gelen use u kullanarak namespace leri cagirabilriz 

// use App\Controller\Video;
// use App\Helper\Video;
use A\B\Video as MyControllerVideo;
use A\C\Video as MyHelperVideo;
//Ayni isimdeki class lara biz alias sahte class isimleri vererek onlari kullanabilyoruz...


//Yukardaki gibi bir durum soz konusu  oldugu zaman, her iki klasor de de ayni isimde class lar mevcut o zaman hangisin cagiracagini sasiracaktir
//Iste biz bu kafa karisikligini netlestirmek icin namesspace leri devreye sokuyoruz

//Baslarinda namespace oldugu icin hata almadan ayni isimde iki farkli class kullanabiliyoruz...
//BUU COOK ONEMLIDIR...PROJELEIRMIZ BUYUDUKCU NAMESPACE OLAYI BIZE COK YARDIMCI OLACAK

// $controllerVideo=new A\B\Video();
  $controllerVideo=new MyControllerVideo();
 echo "<br>";
 $helperVideo=new MyHelperVideo();
 //namespace yazarken isimlendirme olarak illaki klasor ile eslesmesi sart degil, sadece ney neyin altinda onuu netlestirme adina daha anlasilir olmasi onemli



?>