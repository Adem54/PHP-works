<?php declare(strict_types=1);

/*
COK ONEMLI BIR FARK--CLASS LARI PUBLIC-PRIVATE-PROTECTED YAPAMAYZ
AMA CLASS LARI  FINAL YAPABILIRIZ DIGER CLASS LAR TARAFINDAN INHERIT EDILEMESIN BASE CLASS YAPILAMASIN DIYE
AMA SUNUU KARISTIRMAYALIM FINAL CLASS LAR BASKA CLASS LARI EXTENDS EDEBILIR YANI INHERIT EDEBILIR ANCAK KENSISI 
INHERIT EDILEMEZ DIGER CLASS LAR ONU INHERIT EDEMEZLER ONUN UZERINDEN INSTANCE OLUSTURAMAZLAR...BU ONEMLI BUNU IYI ANLAYALIM...
As mentioned in the table above, public, private or protected access modifiers cannot be used with class. 
Let's see what happens if we do,
But for class methods and variables we should specify the access specifiers although by default they are treated as public.

*/
 class Vehicle 
{
    public int $vehicle_id=1;
    public string $title="vehicle";

public function __construct(){
    echo "<h3>Hello this is base class Vehicle</h3>";
}

}                        

 class Car extends Vehicle {
  public function  __construct(){
        // echo parent->$vehicle;
        parent::__construct();
        //Bu sekilde parent icindeki constructor calistigini gormus olduk
    }
}

 $car=new Car();
 echo $car->title;//Dikkat edersek biz subclass uzerinden base class a ait bir ozellige erisebildik




abstract class Person {
    public int $id;
    public string $firstName;
    public string $lastName;

    public function  __construct(int $id, string $firstName, string $lastName ){
        echo "This is constructor";
        $this->id=id;
        $this->firstName=$firstName;
        $this->lastName=$lastName;
    }

    abstract function getNameLastName():void;


}


 class Student extends Person {

   public function  __construct(int $studentId, string $studentName, string $studentLastName){

    //Eger bir class da biz baska bir base class i inherit etmis isek abstract class veya normal class
    //Ve base class in eger constructo rina paramtre gecilmis ise o zmaan ne yapariz biz subclass in da icerisine o parametreleri
    //geceriz sonra da o gectigmiz parametreleri parent class in  da constructorina gecmek zorundayiz subclass icinde
    //ayni invoke etmis gibii hatta gibisi fazla invoke ederiz...cunku eger bir subclass bir base class i inheriet etmis ise
    //o subclass tan obje olsturuldugunda ilk once parent,base class in constructor i calisir paretn class tan ta bir instance olusur ardindan 
    //subclasss in constructor i ve icindekiler calisir...bunu iyi bilelim
    //Peki biz parent class tan gelen constructor daki parametreleri gecmek istemiyorsak ne yapariz o zaman parent class ta gidip  1 tane de
    //paramtresiz bir constructor olstururuz....
    parent::__construct($studentId,$studentName, $studentLastName);

   }


   function getNameLastName():void{
    echo "getNameLastName inside the Student class";
   }
}


/*
Class yapisi
class lari olstururken biz o class icerisinde o class tan olusturulacak bir nesneyi simule etmek iicn  
o class icinde bir fonksiyon olusturacak ve  o fonksiyon da icinde bulundugu classin iki farkli ornegini simule edecek isek o zman 
paremetre de type olarak $this kullanarak belirtebiliriz.....  
Methodlar varsayilan olarak public tir eger belirtmezsek
PHP ile bir class tan new leme yaptigmiz zaman nesne olusturdgumuz zaman isletim sistemi-ram bellege o nesne yazilmis olur bellege cikmis olur
new lenmeden bellege cikmazlar class lar
class lar new lenirken bir referans tutucu veya adres tutucu tarafindan tutulurlar ve o referans tutucu tarafindan o nesen ozellik ve methodlara erisiriz
COOK ONEMLI  BIR BILGI
Nesnelerin tanımlandığı sınıf içinde, nesne oluşturulmadığından bellek adresi bilinmez, PHP nesne oluşturulurken bellek adresini $this anahtar kelimesine atar.
Böylece nesne içindeki özellik ve metotlara $this anahtar kelimesi ile ulaşılır.
Normalde sadece class olusturmakla bellekte hicbirsey olmaz ve yer tutmaz ama biz ne zamanki o class tan bir nesne olustururuz o zaman iste php bellek adresini $this anahtar kelimesine atar...bu cook onemli...Bellek adresini $anahtar kelimesini o class tan instance olusturuldugu zaman atar.... Bizim class olusturuken yaptigimz aslinda bir model olusturmaktir..biz model olstururuz sonra bu model den nesneler olusturarak bunlarla problemlerimize cozumler uretirizi biz asliinda bir model design ederiz classlarda 

Biz bazi ozelliklerimize disardan erisilmesini istemeyiz veya bazi ozelliklerimiz filtrelemek veya sinirlandirmak isteyebilirz
Ve ondan dolayi da direk kullaniciya herseyi ile kontrolsuz bir sekilde acmaktansa onu bizim kontrolumuzde acarak constructor uzerinden 
girilmesini saglariz ve eger istgersek de constructor icerisinde onu if kosulu ile bir conditioina tabi tutabilirz ornegin id 0 dan buyuuk ise atama yap veya iste name isim 5 karakter den buyuk ise disardan set edilebilsin gibi sartlar sunabiliriz iste bunun adi ENCAPSULATION DIR...VE COK ONEMLI BIR KAVRAMDIR
ERISIM PRIVATE ISE SADECE KENDI SINIFI ICINDEN ERISIM SAGLANABILIR
PROTECTED ISE SINIF ICERISINDEN VE O CLASS I INHERIT EDEN EXTENDS EDEN CLASS LAR TARAFINDNA ERISILEBILIR
PRIVATE ISE SADECE KULLANILDIKLARI SINF ICERISINDEN ERISIM SAGLANABILIR

BIR SINIFI INHERIT EDEN BASKA BIR SINIF BASE-CLASS IN INHERIT ETTIGI CLASS AIT PUBLIC VE PROTECTED PROPERTIES(VARIABLES) VE METHODLARINI DIREK KULLANABILIR DIREK ERISEBILIR CONSTRUCTOR ICERISINDE....
*/


/*

Abstract class lar
1-new  lenemez, obje olusturulamazlar
2-Icerisinde method ve properties veya variables olabilir
3-private erisim belirleyicisi kullanilmasi beklenmez, cunku base class mantigi ile yapildigi icin
4-static/const variable veya properties ve static methodlar kullanilabilir
5-Abstract class lar constructor ve destructor kullanabilir
6-Normal class lar tarafindan inherit edilebilir, extends kullanilarak, varlik amaci odur
7-En onemli ozellikleri soyut mehtodlara sahip olmalaridir
8-abstract anahtar kelimesi ile abstract class icinde hazirlanan methodlarin o abstract class i inherit eden class lar tarafindan kullanilmas
zorunludur, ve abstract methodlarin sadece signature lari yani parametre ve donus tipleri verilir ve bu abstract class i inherit eden her 
class in bu abstract methodlarinin icini kendi ihtiyacina gore doldurmalari beklenir bu da bize cok ciddi fleksibel ve daha 
genis bir kullanim saglar
Abstract classs lar private erisim belirleyicisine sahip olamazlar
Abstract class icerisinde protected kullanilabilir protected demek bu ozellik sadece icinde tanimlandigi sinif ve bu sinifi extends eden
inherit eden diger class lar tarfindan kullanilabilir demektir
Hatta abstract class lar icerisinde protected cokca kullanilir...bu mantigi iyi kavrayalim.


*/
?>