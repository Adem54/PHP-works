<?php declare(strict_types=1);

//Object-oriented programming
//Bu bir yaklasimdir
//Daha duzenli, daha kontrollu, daha surdurulebilir, reusability ve maintanibility,sustainability 
//Spagetti kod yazmak yerine daha sistemli daha surdurulebilir bakimi kolay, anlasilabilir ve bir standarti olan 
//iyi dokumanlanmis bir sekilde hazirlarsak bizden sonra gleen insanlar cok daha kolay anlayabilir

//1-Encapsulation
/*  
Genellikle information hiding diye de bilinir..Bir sinftaki bir method veya properties ler disariya 
herkese acmayabiliriz, sinirlandiraiblirz, belli sartlar da koyabilirz kimi zaman
*/
//2-Inheritance:
/*
Kenimizi tekrar etmemmiiz onleriz...ve cok ciddi effektiflilik kazandirabiliriz
*/
//3-Polymorphism
/*
Bir ana siniftan turemis siniflar ayni islemi yapariz ama cok farkli sekillerde yapabiloiriz bunu
ornek burdan Osloya giderken tren ile gidebiliriz otobuse ile de gidebiliriz, ya da ozel araba ile de gidebiliriz
esasinda 3 umuz de ayni ise yapiyuoruz ama farkli sekilllerde yapiyoruz... gibi
Ya esasinda database lerden MYSQL,Postgre,MSSQL,Oracle hepsi insert,update,delete,select islemi yapar ancak 
hepsinin kendine gore islem detayinda farkliliklari vardir iste polimorfizm sayesinde biz bir ana base class 
abstract class olusturup onun altina 1 tane insert,select,update ve delete islemi yapan fonksiyonlar olustururz sonra
tum database cesitleri icin birer class olusutrup hepsi abstrac class i inherit veya implement ederek bu methdlari alir ve
icerlini kendi ihtiyaclarina gore doldurur...bu dur iste polimorfizm herkesin ayni isi farkli sekillerde yapmasidir aslinda 
*/
//4-Abstraction
/*
Abstractin da bizim somut gercek hayattaki problemlerimiz class lar la tanimlyarak, soyutluyoruz ve soyutlayarak 
gercek hayat problemlerini ele aliyoruz...

*/

//class isimleri pascal case olursa daha iyi olur..her kelime basharfi buyuk olsa cok daha iyi olur
class Member {
    //Properties
    //Degisken-
    //Sabitler

    //Methodlar
    //Sinif icinde tanimladigmiz hersey bizim aslinda nesnemiz
public ?string $name;
public string $lastName="Erbas";
const NUMBER="12";//const sabit degiskendir

function showName(?string $name="Zehra"){
    //$this->name=$name ?? "Kamil";//Burda $name null olur ise o zaman Kamil atamasi yap diyoruz
    $this->name=$name;//Burda $name null olur ise o zaman Kamil atamasi yap diyoruz
    return $this->name. " ".$this->lastName;
}



function showNumber(){
    return self::NUMBER;//constant lara sinif icerisinde bu sekilde erisebiliyruz
}

function showFullInfo(){
    return $this->showName("Sercan")." - ".$this->showNumber();
}


}


$member=new Member();
$member->name="Kamuran";

echo Member::NUMBER;//12
//Constantlara sinif disinda direk sinif uzerinden bu sekilde erisebiliyruz
echo "<br>";
echo $member->lastName;//Erbas
echo "<br>";

echo $member->showName("Adem"); //Adem Erbas
echo "<br>";

echo $member->showName(); //Zehra Erbas
echo "<br>";

echo $member->showName(null); //Erbas
echo "<br>";

echo $member->showNumber();//12


echo "<br>";
echo $member->showFullInfo();//Sercan Erbas - 12 diye geliyor

 class Test {
    public string $name="Robot";
    private string $surname="Jonas";

    protected function getFullName(){
        return $this->name. " - ".$this->surname;
    }

    final function getMessage(){
        return "Hello man";
    }
}

$test=new Test();
// echo $test->surname; bu sekilde erisemeyiz cunku private dir...disardan erisilemez
//$test->getFullName();//bu na da disardan direk erisemeyiz protected oldugu icin.. 
//Disardan biz ancak, public olan method ve propertieslere erisebilirz


class SubTest extends Test{

    public function __construct()
    {
        echo $this->name;
        echo "<br>";
       // echo $this->surname;//Buna erisemeycek private oldugu icin
        echo "<br>";
        echo $this->getFullName();//Robot-Jonas-protected oldugu icin ve bu class subclass oldugu icin 
        //protected lar kendisi ve onu extends eden(inherit eden) classlar tarafndan erisilebilir
        echo "<br>";
        echo $this->getMessage();//Hello man
    }

}

echo "<hr>";

class Test2 {

        public function __construct()
        {
            $test=new Test();
           echo $test->name;//name public oldugu icin baska bir class icinde sorunsuz kullanilabilir
           echo "<br>";
          // echo $test->surname;//Buna erismiyor surname private oldugu icn
           // echo $test->getFullName(); protected oldugu icn bu class tan o classs a erisemiyoruz
        }

}

$res=new SubTest();


echo "<hr>";

$res2=new Test2();


echo "<hr>";

class Person {
    private ?string $first_name;
    
   
    //BABA GIBI ENCAPSULATION ISTE BU...
    //PRIVATE OLAN BIR PROPERTIES E PUBLIC BIR METHOD UZERINDEN ERISMEK...
    public function getfirstName(?string $first_name ): ?string {

        //Burda biz kendimiz esasinda bir encapsulatin ile private olarak belirledigmiz bir 
        //propertymizi disaryi belirli sinirlandirmalarla ornegin mesela diyebiliriz ki en az 3 karakter olsun
        //veya bir id icin 0 dan buyuk olsun
        //gibi sinirlandirmalar ile disardan direk ulasarak istenildigi gibi manipule edilmek yerine bizim izin verdgimiz
        //kadariyla biz disardaki kullanicya bizim firstName data mizi acabiliriz aslinda...
        //    $this->first_name=$first_name ?? "";
        if(strlen($first_name)>=3){
            $this->first_name=$first_name;
            return $this->first_name;
        }else {
            return "Please, enter min 3 characters";
        }
        
    }
}

$person=new Person();
echo $person->getfirstName("Ah");
//Dikkat edelim kullaniciyi sinirlandirmis oluyoruz ve encapsulation in kralini yapmis oluyoruz burda esasinda...

/*
Burda ince bir nokta var bunu iyi anlayalim
private olarak belirledigmiz bir properties e biz direk erisemiyoruz disardan ancak
eger biz bu private belirldgmiz property yi yine o sinif icerisinde olustudgumzu public bir
fonksiyon icerisinde kullanirsam, ve disardan da o public fonksiyonu cagirirsam aslinda dolayli olarak
ben private propertiye disardan erismis olacagim ama tabi yine bizim kontrolumuzde olan bir durumdur


*/
?>