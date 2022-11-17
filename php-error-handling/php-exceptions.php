<?php 
//Bir exception class i vardir php de ve onu kullanabiliriz
//Biz api yazarken ornegin uygulamamizda olusabilecek hatalari uygulamamiza ozel
//hale getirerek kullanciya isabetli ve dogru hatalari vererek onlari dogru yonlendirebilmeliyiz
//Bu bir uygulama icin cook kritik oneme sahiptir
//Ve php bizim hatalarimzi kendimize gore de ozellestirebileyim diye extends edilebilir bir 
//Exception sinifi olusturmustur...
//Biz php nin Exception class ini extends ederek, hatalarimizi ozellestirebiliriz

//Get methodu ile id gonderilmesini beklioruz ve asagidaki sarltari saglamasni bekliyoruz mesela bir api uygulamamizda
//1-id-once parametre olarak var olmalidir
//2-Parametre var ama parametre icerigi dolu olmalidr
//3-Parametre dolu ama icerigi integer, sayi olmalidir
//4-Parametre icerigi integer ama 10 olmalidir

//YUKARDAKI SARTLAR I ASAGIDAKI GIBI KONTROL EDEBILIRIZ
// if(!isset($_GET["id"])){
//     echo "There is no id";
// }else if(empty($_GET["id"])){
//     echo "id has empty value";
// }else if(!is_numeric($_GET["id"])){//Harika bir bestpractise dir bu sekilde number mi degil mi anlayabiliyoruz
//     echo "id is not numeric";
// }else if($_GET["id"]!=10){
//     echo "id is not equal to 10";
// }else{
//     echo $_GET["id"];
// }

//Tamam biz bu sekilde handle ettik ama biz hata mesajlarimzi tamamen ozellestirmek isteyebilirdk ve kullanici ne yazdi ise onu 
//gostermek de isteyebilirdik 

//Oncelikle hata yonetimini yapabilmeki cin try-catch kullanacagiz
//try-catch kullanirken mutlaaka catch kullanmaliyiz
// try {
//     if(!isset($_GET["id"])){
//        // echo "There is no id";
//      throw  new Exception("There is not any id value");
//     }else if(empty($_GET["id"])){
//         // echo "id has empty value";
//      throw  new Exception("id has empty value");

//     }else if(!is_numeric($_GET["id"])){//Harika bir bestpractise dir bu sekilde number mi degil mi anlayabiliyoruz
// //        echo "id is not numeric";
//      throw  new Exception("id is not numeric");

//     }else if($_GET["id"]!=10){
//        // echo "id is not equal to 10";
//      throw  new Exception("id is not equal to 10");

//     }else{
//         echo $_GET["id"];
//     }
// } catch (Exception $ex) {
//     //throw $th;
//     // var_dump($ex);
//     // print_r($ex);
//   //  echo $ex->getMessage();
// }

/*
Exception class inini referans tutucusunu ekrana yazdirirsak bu instance nin icerisinde nele var onu gorebiliyoruz

{
message:protected: "id is not equal to 10",
string:Exception:private: "",
code:protected: "0",
file:protected: "C:\Users\ae_netsense.no\utv\test\php-error-handling\php-exceptions.php",
line:protected: "48",
trace:Exception:private: { },
previous:Exception:private: ""
},

PHP INBUILD EXCEPTION CLASS INI DOGRU OKUYARAK EXTENDS ETMEK
Icerisinde bunlarin var oldugunu gorebiliyoruz
message isminde bir protected degiskeni var biz onu su an bu sekilde alamayiz ve dikkat edersek
bizimn yazdigmiz, exception class inin constructor ina parametre olarak gectimz mesajimiz da direk
Exception class i icerisindeki protected property message e ye atanmis o zamaan burdan neyi anliyoruz demekki
biz bir custom Exception class imizi olusturur ve Exception class ini inherit edersek o zaman bu message sinifini 
biz o custom Exception icerisinde kullanabiliriz ve de kendi mize ozel mesajimizi da yine kendi sinifimzin 
constructor ina gecerek ordan da Exception classs inin constructor ina aktarabiliriz

*/

class IdNotFound extends Exception{

  // public $error_message;

   public function __construct($error_message)
   {
  //  $this->error_message=$error_message;
    parent::__construct($error_message);
   }


   public function get_error_message(){
    // return $this->error_message;
    return $this->message;
}
}

class IdIsEmpty extends Exception {

    public function __construct($error_message)
    {
        parent::__construct($error_message);
    }

    public function get_error_message(){
        print_r($this);
        return $this->message;
    }
}

//Burda da yine kendi custom error classimizi olusturarak Exception sinifi iceriisndeki hata ile iligli tum 
//detaylari bir dizi icerisinde yazdirip ardindna json a encode ederek return ederek hata detaylarini daha daha ayrintili donebiliriz
class MyError extends Exception {

    public function print_json(){
        $res=[
            "line"=>$this->line,
            "file"=>$this->file,
            "message"=>$this->message
        ];

       return json_encode($res);
   
    }


    public function print_xml(){
        header("Content-type:text/xml");
        $xml=new SimpleXMLElement("<error/>");
        $xml->addChild("line",$this->line);
        $xml->addChild("file",$this->file);
        $xml->addChild("message",$this->message);
        return $xml->asXML();
    }
}


//Bu sekilde hata turune gore hata mesaji vermeyi saglamis oluyoruz
//Okunabilirligi arttirmis oluyoruz
//Hata lari ozellestirmis oluyoruz
//Exception class i tum hatalari yakalayacaktir ama biz hata miz tam olarak nerden kaynaklaniyor ise 
//ona gore bir exception firlatmak isteriz biz ve ornegin ayni if-else gibi alt alta birkac tane catch kullandiktan sonra
//eger bizim custom exceptionlarimz hata yi yakalayamaz ise o zaman Exception sinifimiz o hatayi yakalasin demek icinde 
//Exception class ini en alta yerlestiririz ki bu cook onemlidir
try {
    if(!isset($_GET["id"])){
     //   throw new IdNotFound("There is no id in your get parameter");
     throw  new MyError("There is not any id value");

        
    }else if(empty($_GET["id"])){
        throw new IdIsEmpty("Your id is empty");
        throw  new MyError("id has empty value");
        
    }else if(!is_numeric($_GET["id"])){//Harika bir bestpractise dir bu sekilde number mi degil mi anlayabiliyoruz
        //        echo "id is not numeric";
             throw  new MyError("id is not numeric");
        
            }else if($_GET["id"]!=10){
               // echo "id is not equal to 10";
             throw  new MyError("id is not equal to 10");
        
            }
}
catch (MyError $ex) {
   // echo $ex->print_json();//Burda hatayi alabilemk icin Exception class inda hata firlatilmasig gerekir
   // echo "<br>";
   //HATA MESAJINI DA KULLANICININ GET PARAMETRESINE VEREECEGI TYPE A BAGLI OLARAK JSON VE XML FORMATINDA
   //KULLANICI ISTEGINE GORE SUNABILIRIZ
   //http://localhost/test/php-error-handling/php-exceptions.php?id==&type=json
   //http://localhost/test/php-error-handling/php-exceptions.php?id==&type=xml
   if(isset($_GET['type'])){
    if($_GET['type']=="xml"):echo $ex->print_xml();
elseif($_GET['type']=="json"): 
    echo $ex->print_json();
endif;
   }else{
    echo $ex->print_json();//Burda da hatayi xml olarak alabiliyoruz

   }
} catch (IdNotFound $ex) {
    echo $ex->get_error_message();
}catch (IdIsEmpty $ex){
    echo $ex->get_error_message();

}catch (Exception $ex){
    echo $ex->getMessage();
}

?>