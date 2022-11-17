<?php 

/*
Static methodlar-C# da
Static methodlari i biz C# da helper ve tools islemleri yaparken kullaniyorduk
ve de new lemeden dogrudan class ismi uzerinden kullanabiliyorduk
Ve de instance yasam donguler i boyunca 1 tane instance olusturabilyorlardi
Ve referance type heap ta ozel bir yer de tutuluyorlari ve bir class icerisinde
ilk olusturulan constructor dan da once olusturulan static constructorlar oluyordu
Ayni sekilde bir de static propertiesler de o class tan olusturlan instancler
arasinda degerlerini muhafaza ederek yeni olusturulan bir class ta kullanildiklari zaman
en son ki classs instancesi nde kac ta kaldi ise ordan devam ediyordu

PHP DE ISE
Static mehtodlar ilk cagirildiginda ram e aktariliyor 
daha sonra ram dan cagrilarak performansi arttirmak icin kullanilyor
Bir sinif ta sadece belli bir is yapan bir method kullanacak isek
boyle helper, tools mantiginda o zaman static kullanabiliriz
Peki normal class larda nasil oluyordu normal class larda fonksiyhon ve properties
ler o class tan instance olusturulmadan bellege cikmazlar bunda ise 
class new lenmeden direk o class ismi ile cagrilabiliyorlar ve de direk bellege
cok hizli bir sekilde cikabilyorlar...performans artisi saglayabilyoruz

static methodlar icerisinde $this kavrami ortadan kalkiyor dolayisi ile
static methodlar icerisinde $this yapamyoruz  
Bir sinif icerisinde hem static method ve properties hem de normal static olmayan
method ve properties ler olusturabiliriz ancak static olan methodlar icerisinde
sadece static olan properties ve methodlari kullanabilirz ve de self ya da direk
class in kendi ismi ile olsturabiliriz
Eger icerisnde static kullandigmiz class dan inherit alinmis ise yani
o class tan yeni bir class turetilmis ise ya da icinde static method ve properties
kullanilan class base class yapilmis ise parent haline getirlimis ise o zamn 
da subclass icinde base class in static methodlarina erismek icin parent::
syntaxi kullanilir

*/

class Test {
    public $age=34;
    const NAME="ADEM";
    public static $lastName="ERBAS";
    public static function hello(){
        //STATIC METHODLAR ICINDE $THIS KULLANILAMAZ
     //  return "hello world". " ".$this->lastName;BU SEKILDE KULLANAMAYIZ
      //  return "hello world". " ".self::$lastName;
      
      return "hello world". " ".Test::$lastName;
        //static methodlar icerisinde ya self ile ya da direk class in 
        //kendi ismi ile self:: syntax i gibi Test:: ile properties leri
        //kullanabiliriz..
        //Bu sinif icerisinde self ile bu sinf extends edildi ise de o zaman parent
        //i kullanarak erisilebilir sadece static fonksiyonlara ve static
        //propertieslere
        //Normal static olmayan propertieslere static fonksiyonlar icerisinden erisemeyiz..
        

    } 

public function sayHello(){
//hem $this ile hem de self:: ile cagirabilriz
//return $this->hello()." - ".self::NAME;
return $this->hello()." - ".self::NAME;
//const sabitlerini class icerisinde $this ile cagiramayiz sadece self ile
//cagirabiliriz
   // return self::hello()." - ".self::NAME;

}

public function showMessage(){
  echo self::sayHello();// bu sekilde de gosterebilyoruz
  // echo $this->sayHello();
 // echo  Test::sayHello();//Bir class icersinde o class ismi ile de
 //gosterebiliyoruz

}
//Ancak ozellikle static func ve const-sabitleri bizim 
//ya self:: ile ya da direk class ismi ile Test:: syntaxi ile 
//gostermemiz gerekiyor

}



class Test2 extends Test{

    function useBaseFunc(){
      //  $this->hello();
      // return $this->hello()." Test2 class ";
       return parent::hello()." Test2 class ";
    }

}

$test2=new Test2;
echo $test2->useBaseFunc();
echo "<br>";



echo Test::hello();
echo "<br>";
echo Test::NAME;
echo "<br>";
//Ozellikle disarda biz static funct ve const sabitlerini
//dogrudan class uzerinden cagirabiiyoruz
$test=new Test;
echo $test->sayHello();
echo "<br>";

$test->showMessage();


echo "<hr>";

class File {
public static $fileName;

public static function Create($fileName,$text){
    self::$fileName=$fileName;
    $file=fopen($fileName, "w+");//yoksa bile olustursun ve yazma izni veriyoruz
    fwrite($file,$text);
    fclose($file);
}

public static function Read($fileName=null){
    $fileName=$fileName ?? self::$fileName;
    //Eger parametrede fileName verilir ise onu al,
    //ama verilmemis ise o zaman bu sinif icerisindeki 
    //filename i al kullan
    return file_get_contents($fileName);
}

}
//burda adem.txt olusturup icerisine de adem erbas yazidigi icin
//artik bu ifadeyi biz Read degimz zaman alabiliyoruz
File::Create("adem.txt","adem erbas");
//echo File::Read("adem.txt");
echo File::Read();


//Ozellikle tools ve helper larda bir veya birkac tane yardimci fonksiyon kullaniyrsak
//direk ram den cagirildigi icin cok daha performasli oluyor ve sirf birk kac tane
//basit, yadrimci arac islemleri yapacaksak da onun icin class yapip sonra o class
//leme islemleri ve sinif ile birlikte defualt olarak gelen bircok islem
//constr,destruct...gibi tum bu masraf ve maliyterlerden kurtulrak cok hizli bir sekilde
//islemlerimizi yapabilirz...static methodlar ile...

?>