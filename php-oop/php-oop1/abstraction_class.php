

<?php 
//cms-contain manangement system
//Ornegin biz icerik yonetim sistemi kurguladik ve wordpress te de eklenti yazarken
//uygulamamiza , veya wordpress e eklenti yazareken 4 tane metod var eger o 4 methodu yazmassak uygulama dogru bir sekilde calismiyor belliki o 4 method  bir abstract class icerisinde duzenlenmis ve kullanilmasi zorunlu tutulmus...BELLI BIR STANDART OLUTURULMUS YANI...YANI KONTROLU DAHA KOLAY SAGLAMIS OLUYORLAR

//Abstraction class 
//

abstract class Plugin {
//ornegin Plugin class imzi extends eden class lar in icerisinde 2 tane fonksyon
//kesin olmak zorunda olsun mesela, bu tarz bir alt class ta subclass ta olmasini
//zorunlu hale getirecegizmi fonksiyonlar oncelikle, abstract olmalidir 
//1-abstract function olmalidir
//2-ayrica da sadece signature i yazilmalidr yani suslu paranteze kadar olan kismi yazilmalidr
abstract public function setTitle($title);

abstract public function setContent($content);

//Ayni zamanda icerigi ortak kullanilmasi zorunlu olmayan ortak ve override edilebilir siniflarda yazabilirz

public function showPlugin(){
   
    echo "<h2>". $this->title  ."</h2>";
}

//BESTPRACTISE...
//Burda setTitle da Plugin class ini extends eden tum class lar kendi title ini atama yapiyor ardindan da, dikkkat edelim...base class icindeki showPlugin methodu icerisindeki this, kimi neyi temsil ediyor, bu baseclass i extends eden class lari temsil ediyor...Dolayisi ile, Plugin base class ini inherit eden tum subclasss lar kendi title larini atama ypatiktan sonra showPlugin methodunda da hepsi kendine ait title i okyacaklar.... coook onemli bir mantik bu...
//Biz yine standarta baglamis oluyoruz bu yontemlerle aslinda
//Ornegin eklenti yi kullancak tum parcalar da title ile content olmak zorundadir
//Ve hepsi de kendi iceriklerini gostersin istiyoruz biz degil mi o zaman ne diyecgiz
//Bun showPlugin de this diyerek bu class i extends edenlere ait aslinda title i getirecegni belirtmis olyoruz
//COOK ONEMLI...THIS
//BURDAN SUNU ANLAMALIYIZ $THIS HER ZAMAN BIZIM DUSUNDGUMUZDEN DAHA FAZLASI ANLAMINA GELIYOR ONDAN DOLAYI THIS ILE COK CIDDI EFEKTIF DINAMIKLESTIRMELER YAPABILRIZ...


//BASE CLASS ILE BIZ SUBCLASS LARI BELLI BIR STANDARTA SOKABILIYORUZ VE ONLARA KURALLAR GETIREREK COK GUZEL BIR STANDART OLUSTURABILIYOURZ
//Bu fonksiyonun direk icergi ile beraber oldugu gibi kullanilmasini istiyoruz ornegin
//ama zorunlu degil kullanilacaksa bu sekilde direk kullanilamsini istiyoruz override
//edilmesine izin vermiyoruz burda bunu da soyle dusunelim
//1.senaryo:  bir abstract class olustururken, yani base class bazi fonksiyonlar mutlaka kullanilmak zorundadir ve ici bostur subclass larin herbirisi onlari kendi spesik durumlarina gore doldurmalarini isteyebiliriz
//2.Bazi fonksiyonlari biz olstururuz iceriisine de default bir icreik koyarz bunlarda normal fonksiyonlardir ve bunlar subclass lar tarfindan ister oldugu gibi kullanilir ister tamamen overirde edilir ister de hem base-class icindeki defaul icerik kullanilir hem de kendi icerigi eklenebilir
//3-Birde base class icerisinde biz onu extends edecek tum class larda ayni sekiilde calisacagini dusungumuz fonksiyonlar icin yani ic kismi da ayni sekilde calisacak fonksiyonlar icin ise final keywordu ile kullanark fonksiyon yazariz ki subclass lar bu fonksiyonu override edemezler ve kullanacak lar ise hic degistirmeden kullanmak zornda kalirlar....

//Ayni sekilde icerigi olacaksa burda yazildigi gibi olacak olan ve override edilememesi icin de final yapiyoruz
public  final function commonFunc(){
    return "common function for all subclasses";
}

}
//Peki bu isin espirisi nedir?
//Bu sekilde biz yaptgimz islemelre bir standart getiriyoruz
//Daha kontrollu bir sekilde ve de kullaniciyi birseylere zorlyoruz dikkat edelim
//Kullanciyi sinirlandiriyoruz bunlari kullanmak zorundasin diyoruz belirli kurallar 
//getrmis oluyoruz kullaniciya....Bu bir starndartlasmadir ve bu daha profesyonel calisilabilmesi icin gerekli  birsey ve cok da onelidir
//Birde ornegin ayni islemi yapacak ama ayni islmeleri cok farkli bir sekilde yapacak
//islemelrimz olabilir...Mesela biz bugun Mysql , Postgre gibi farkli veritabanlari ile calisabiliriz ve her veritabaninda biz insert,update,delete, select islemleri yapabiliriz ancak her veritabani bu islemlerin detayinda farkli prosesslerle bu islemleri yapacaklardir o zaman boyle durumlarda iste abstract class lar mukemmmel is gorecektir ve biz abstract bir class olusturdgmuz zaman sadece vertabanlari ile ilgili kullandirmak isteriz ve bu sekilde de sinirilaniri da cizmis oluyoruz aslinda kullanm alanmizin.....COOK ONEMLI BESTRPACTSE


//Simdi Plugin sinifinda biz LastComments ve SocialMedia siniflarini
//turetecegiz ancak, ve amacimz bir uygulama olsuturmak ve Plugin i extends edecek
//olan tum subclass larda kesinlikle olmasi gereken bazi ozellikler var mutlaka
//o methodlari kullanmalari gerekiyr ornegin iste boyle durumlarda abstract methodlar
//cikiyor karsimiza...
//Iste abstract 


//Bu sekilde subclass da extends edilmis abstract class icerisindeki abstract methodlar
//kullanilmak zorundadir
class LastComments extends Plugin {
        public function setTitle($title){
            $this->title=$title;    
           // return $this->title; 
        }

        public function setContent($content){
            return $content;
        }


    

      
}


class SocialMedia extends Plugin {

    public function setTitle($title){
        $this->title=$title;
        // return $this->title;
    }
    public function setContent($myContent){
        return $myContent;
    }

  
    
}


$last_comment=new LastComments();
$social_media=new SocialMedia;

$last_comment->setTitle("comment_title");
$social_media->setTitle("social_media");

echo $last_comment->title;
echo "<br>";
echo $last_comment->showPlugin();
echo "<br>";
echo $last_comment->commonFunc();
echo "<br>";

echo $social_media->showPlugin();
echo "<br>";
echo $social_media->commonFunc();
echo "<br>";

echo "<hr>";


//COK SASIRTIICI DAHA ONCEDEN GORMEMISTIM BUNU.....
//BURDA PHP DE COK ENTERESAN BIRSEYI FARKETTIM...
//JAVASCRIPTTE NE KADAR DA BENZIYOR....
//CLASS ICERISINDE PROPERTY ONCEDEN TANIMLAMAMIZA RAGMEN
//GELIP O CLASS ICERISINDEKI BIR FONKSIYON DA $this ile
//DOGRUDAN TANIMLAYARAK, PARAMETREDEN GELEN DEGERI ONA ATAMA YAPABILYORUZ
//JAVASCRIPTTEKI PROTOTYPING E NE KADAR DA BENZIYOR...
class Test{
public function getInfo($name,$surname,$age){
$this->name=$name;
$this->surname=$surname;
$this->age=$age;
return $this->name." - ".$this->surname." - ".$this->age;
    
}

}


$test=new Test;
echo $test->getInfo("Adem","Erbas",34);
echo "<br>";
echo $test->name;
echo "<br>";
echo $test->surname;
echo "<br>";
echo $test->age;
echo "<br>";

?>