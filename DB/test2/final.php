<?php 

/*
Programlama dilleri üzerinde genelde ihtiyaçtan doğan OOP mimarisi ile birlikte hayatımıza girimiş olan final komutumuzun amacı bizim oluşturduğumuz class veya methodumuzun sadece tek seferlik kullanım olarak sunulmasına olanak sağlar. Normalde biz extends ediyorduk class ları veya hem ana class içerisinde hem de child class içerisinde methodlarımızı rahat rahat kullanırken final komutunu baş kısmına yazdığımız zaman programımız bize "Hooop kardeşim bu final tanımlı. Bunu birden fazla kez kullanamazsın bir kere kullan :)" şeklinde bir uyarı verdirtiyor. Bütün olay aslında bu dostlar.

*/


class Anaclass{
    final public function finalMethod(){
       echo "Burası Final Methodumuz";
   }

   public function getMyInfo(){
    echo "</br> My information is coming". "</br>";
   }
}

class CocukClass extends Anaclass {
 // public function finalMethod(){  }
//Cannot override final method Anaclass::finalMethod() in C:\Users\ae_netsense.no\utv\test\DB\test2\final.php on line 20

//Bir subclass icinde dogrudan parent class a ait, methodlara ve deigskenlere erisilebilir, propertieslere eger tabi ki
//base class icinde fonksiyonlar final ile ve private olarak tanimlanmadi lar ise
public function callMyInfo(){
    echo parent::getMyInfo();
    $this->getMyInfo();
}

}

$child=new CocukClass();
$child->callMyInfo();//2 kez My informatino is coming yazar

  /*
  şeklinde kodumuzu yazdık dostlarım. Sonrasında da local sunucumuzu çalıştırdığımızda karşımıza
  Cannot override final method Anaclass::finalMethod()
  şeklinde karşımıza bir hata çıkacaktır. Burada hata mesajı bize diyor ki: "Dostum sen AnaClass içerisinde final method oluşturmuşsun. Bu final olmasa hadi neyse çağırırdın da final olduğu için CocukClass içerisinde bunu çağıramazsın" diyor. Pekii biz bunu nasıl kullanacağız diye soracak olursanız
  */

/*
Class lar instance olusturulmadan once, bellege cikmazlar, ancak instance olusturulduklari zaman
bellege cikarlar yani newlenmeleri gerekir

*/


?>