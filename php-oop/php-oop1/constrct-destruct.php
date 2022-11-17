<?php 
error_reporting(E_ALL);
ini_set('display_errors',1);
//Construct-Destruct
/*
Construct-Kurucu method
__construct ile tanimlanir
Destruct-Yikici method
__destruct ile tnimlanir
Iki alt cizgi shirli methodlardir.
Magic keywords iki alt cizgi

*/

class myDb {
        private $db;
    //Bir sinif dan instance olusturuldgunda, yeni bir obje olusturuldugunda calisan ilk methoddur
    public function __construct($host,$username,$psw)//Bu sekilde sinif host,username ve psw ile baslsin diyoruz mesela
    {
        //Ornegin iste bu sekilse biz veritabanimizi baslatabiliriz ornegin constructorimizda veri tabanina baglanarak baslayabiliriz
      $this->db=new PDO("mysql:host=".$host,$username,$psw);
    }
//Ornegin bazi konfigurasyon ayarlari, en basta default olarak baslamasi gerekiyorsa bu __construct da yapilir
//Ornegin class imiz bazi .ini dosyalariin okuyarak ayaga kalkmasi gerekiyordur iste bu __construct ta olur
//Bazen classlarimiz baslangicta sabit bir data ile baslasin isteriz o zaman yine bu islem constructor da olur
//Bazi model veya entity classlairmiz id si ile otomatik uniq id ile birlikte olusmasini istersek boyle durumlarda da
//ornegin biz yine construct icerisinde yapariz bunu
//Ayrica disardan data alarak baslatmak istedigmizde de bunu kullaniriz


    public function __destruct()
    //Bir siinifin calismasi bittiginde calisacak son methoddur
    //Bazi session gibi islemlerimiz biz kapatmadan kendisi kapanmiyor bizim
    {
        $this->db=null;//DIYEREK BURDA VERITABANI BAGLANTISINI KAPATABILIRIZ
        echo "desctruct calisti".PHP_EOL;
    }

    function test(){
        return "Hello man";
    }

    //BU HARIKA BIR MANTIKTIR...BU HARIKA BIR SURDURULEBILIR BIR SISTEM KURMA MANTIGIDIR COOK ONEMLIDIR..BUNU UNUTMAYALIM
//Db ye baslar baslamaz baglanarak geldigi icin artik burda class imiz icerisinde select islemleri,
//crud islemlerini yapabiliriz hatta burda cok harika dinamik isler yapabiliriz DB den gelecek data  yi inceleyebiliriz
//Yani biz 1 tane veritabani ile iligli tum sorgularimizi, tum crud operasyonlarimizi yapacagimz bir tane base class hazirlayabilirz
//Ve bunu cok genellestirerek bircok, bundan sonraki bircok class imizda kullanabiliriz

    function getProducts(){
        $this->db->query("SELECT * FROM CATEGORIES...");
        //Seklinde kullanabiliriz...
    }

}

$test=new myDb("localhost","root","");
$test->test();
?>