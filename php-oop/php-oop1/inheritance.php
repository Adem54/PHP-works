<?php 

//inherit islemi extends ile yapilir

class Person {
    public $db;
    public $id;
    public $firstname;
    public $lastname;
    
    public function __construct($host,$username,$pwd)
    {
        $this->db=new PDO("mysql:host=".$host,$username,$pwd);
    }



public function getAll() {
    return "Get All DAta";
}



    public function __destruct()
    {
        $this->db=null;//Veritabanin baglantisini da kapat diyoruz class in calismasi bitince
    }
}



class Student extends Person {

    //extends edilen, yani inherit edilen Person class ina ait protected ve public 
    //property ve methodlara, subclass icinde constructor da erisebiliyoruz...unutmayalim...
    //Sadece constructor da degil diger baska fonksiyonmlarimiz var ise onlarin icerisinde de $this ile extends edilen class elemntlerine erisilebilir
    public function __construct()
    {
        $this->id=1;
        $this->firstname="Kamil";
        $this->lastName="Mermi";
    }

    //base class i ile ayni isimde fonksiyonu kullanarak, onu aslinda override etmis olduk
    //Peki biz ayni isimde fonksiyon kullanmak istiyhoruz ama sonuc olarak base class ta yazilan sonucu almak istersek ne yapariz
    public function getAll(){
        //Biz baseclass taki  herhangi bir seye parent::getAll() syntax i ile erisebiliyoruz
       return parent::getAll();
        // return "Get my All Data from Student class";
    }
//BUUU COOK ONEMLIDIR....BUNU IYI KAVRAYALIM...COOK ONEMLII....
    //parent::getAll();


    public function getData(){
        
    }

}

class Employee extends Person {

}

//extends edilen Person metoduna ait public ve protected olan tum methjod ve propertiesleri
//onu extend eden yani subclass pozisyonunda olan tum class larda kullanabilirken
//ancak sub class icindeki methodlari base-class kullanamiyor

$student=new Student();
echo $student->getAll();//GetAllDAta



//Bu sekilde type lar donebiliyoruz 
//bunlari jan, ivar dan gorebilirz
class result_type{

    public bool $res;
    public string $message;
    public array $data;


}


?>