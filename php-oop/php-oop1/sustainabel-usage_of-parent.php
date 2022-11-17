<?php 


class Employee {
    public $salary;
    public $fullName;
    
    public function getFullName($fullName){
        return $this->fullName=$fullName;
    }
    
    public function getSalary($salary){
        return $this->salary=$salary;
    }
    
    public function getYearlySalary(){
        return ($this->salary*12);
    }
}


class Accountant extends Employee {



}

class It extends Employee {
   //Ornegin yillik maas It de bir de bounus sabit 10.000 daha aliyor
   //yani baseclass tan gelen 12*maas i al bir yanina it- ye ozel 10.000 ekle

public function getYearlySalary(){
    return parent::getYearlySalary()+10000;
}


public function giveMessage(){

}


}


$accountant=new Accountant;
echo $accountant->getFullName("Adem Canga");

echo "<br>";
$accountant->salary=3000;
echo $accountant->getYearlySalary();
echo "<br>";
$it=new It;
echo $it->getFullName("Adem Erbas");
$it->salary=7000;
echo "<br>";
echo $it->getYearlySalary();

/*
Simdi soyle mantikli bir dusunelim...biz neden parent i kullaniriz
1-oncelikle baseclass taki methodu calistirmak isteriz ama onun yanina ekstra birseylerde subclass tan ekemekk itsersek  o zaman once parent::getYearlSalary() diyerek ten onu yazdiririz ve ardindan da kendimize gore ozellestirebilirz tabi ki
2-Birde ornegin biz getYearlySalary fonksiyonunun hem base class ta hem de
subclass ta kullaniyoruz yani subclass ta bir nevi base class ta yazilan methodu
direk kullanmayarak override ederek kullanmak istiyoruz boyle durumda iken birde 
biz yine ayni fonksiyon icinde o fonksiyonu invoke etmemiz gerekti , sonunucu alabilmek icin 
boyle bir durumda ne olur, sonsuz bir donguyere girerek, yetersiz bellek hatasi aliriz
o zaman ne yapariz iste boyle bir durumda biz de gider parent::getYearlySalar() syntaxini kullanarak parenttaki fonksiyonu kullaniriz

BUNLARI NE KADAR UYGULAYABILDIGMIZI DUSUNLEIM...
KENDI KENDIMIZE SUNU SORALIM
GEREKSIZ KODLARDAN KURTULDUK MU
REUSABILITY YI SAGLAYABILDIK MI
SUSTAINABILITY YE UYABILDIK MI
DO NOT REPEAT YOURSELF E UYABILDIK MI
YENI GELEN TALEPLERE KARSILIK VEREBILIYOR MUYUZ?


*/

echo "<hr>";
class A {
    public function test(){
        echo "A test"."<br>";
    }
}

class B extends A {
    public function test(){
        echo "B test"."<br>";
    }
}

class C extends B {

   

    public function test(){
        echo "C test"."<br>";
       
    }

    public function getTest(){
        //Bu arada dikkat edelim...kendi icindeki fonksiyonu $this ile cagirabilirken
        //self:: ile de cagirabiliyoruz
        echo $this->test();
        echo self::test();
        echo parent::test();
        echo A::test();
    }
}
/*
Goruldugu uzere biz ic ice nested mantiginda
inheritance durumunda c den b ye parent:: syntaxi ile erisyoruz ok peki
b nin extends ettigi a ya c den nasil erisiz dersek de direk a nin ismini 
kullanarak A::test() diyerek erisebiliyourz

*/


$c=new C;
$c->getTest();



?>