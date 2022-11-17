<?php 
/*
Magic metotlar php tarafinan  tanimlanmis, is ve islemleri yapmak icin varsayilan olarak programlanmistir
Kendi olusturdugmz methodlardan __ iki alt cizgi ile ayrilmaktadir
PHP sihirli methodlar her sinif icerisinde gerekli olan islemler icin olusturulmustur
Gereksiz metot yok diyebiliriz
1-__construct() Bir sinif cagirildigiinda default olarak calisan kurucu-constructor methoddur.Bu methoda on yukleyici de diyebilirz cunku bir siniftan  nesne olusturuldugnda ilk olusacak olan method budur
2-__destruct() Sinif cagirildiktan sonra calisan yikici methoddur.Bu method sinifin isi bittikten sonra kendisi otomatik olarak devreye girer
Bir sinif kullanildi ve isi bitti ise muhtemelen en son bu method devreye girecek ve ondan sonra da method sonlanacaktir
Bu methodun das kullanilacagiz ozel durumlar olabilir ornegin seession baslattimgiz zaman o session i durdurmak iicn unset methodu calistiririz ve unset methodu da __destruct methodu devreye sokar
React taki clean-useEffect-icinde return yaptimgiz zaman o componenti kaldiriyordu ya o mantiga benziyor
3-__call() Bir sinif olusturuldugunda ve sinif icerisinde bulunmayan bir mehtodu cagirdigmizda kendiliginden devreye giren methoddur
Yani eger bir sinif icerisinde olmlayan bir method cagirirsak default olarak __call methodu tetikelenecektir
4-__callStatic() Olusturulan sinifta tanimlanmayan static methot cagirildigi zaman defatult olarak tetiklenen methoddur
5-__get() Tanimlanan sinifta ollmayan bir ozellik cagirildigi zaman devreye giren methoddur
6- __set() Tanimlanan sinifta olmayan bir ozellige isset() ve empty() kullanilmaya calisildiginda devreye girer
7-__isset() Tanimlanan sinifta olmayan bir ozellige isset() ve empty() fonksiyonlar kullanilmaya calisildiginda devreye girer
8-__unset() Sinifta tanimlanmayan bir ozellik unset() fonksiyonu uygulandiginda devreye giren methoddur
9- __sleep() Tanimlanan sinifta serialize() fonksiyonu uygulandiginda devreye giren methoddur
Ornegin tipi array olan bir degiskeni veritabaninda veya dosya da saklmak istiyorsununuz, iste bunu  yapmak icin serialize() fonksyonunu kullanmamiz gerekir
10-__wakeup()- Tanimlanan sinifta unserialize() fonksiyonu uyugulandiginda devreye giren methoddur
11-__toString()- Tanimlanan sinif print veya echo ile ekrana basilmaya calisildiginda devreye giren methoddur, buyuk ihtimalle de echo ile array leri ondan dolayi yazdiramiyoruz cuku echo calistigi zmaan __toString devreye girerek onu stringe donusturmeye calisiyor olabilir
12-__invoke() Tanimlanan sinifin nesnesini methot gibi cagirildiginda devreye giren methoddur(Muhtemelen her sinif in yeni bir nesne olusturudugunda, new Person() seklinde method gibi cagirir ki zaten gib isi fazla cagirdigi consturctor methdudur zaten...)
13.__set_state() Tanimlanan sinifa var _export() fonksiyonu uygulandiginda devreye girer
14. __clone() Tanimlanan sinif klonlanmaya calisildiginda devreye giren methoddur
*/




/*
COK FAZLA VE SIK KULLANACAGIMIZ METHODLAR....HATA DAN KACINMAK ICN KULLANACAGIZ BESTPRTACTISE
isset()
empty()
exist()
file_exist()

*/
//PHP’de hiç kompleks bir değişkeni veritabanında ya da dosyalarda saklamak istediniz mi? Örneğin tipi array olan bir değişkeni veritabanında saklamak istiyoruz. İşte bunu serialize() fonksiyonu ile yapmamız mümkün.
//Şimdi kompleks bir dizimizi saklayacak hale getirelim.
$arr = [
	'Tayfun Erbilen',
	'site' => 'http://erbilen.net',
	1993,
	[
		'ad' => 'Tayfun',
		'soyad' => 'Erbilen'
	]
];

$data = serialize($arr);
echo $data;
//a:4:{i:0;s:14:"Tayfun Erbilen";s:4:"site";s:18:"http://erbilen.net";i:1;i:1993;i:2;a:2:{s:2:"ad";s:6:"Tayfun";s:5:"soyad";s:7:"Erbilen";}}

//unserialize
//Serialize ettiğimiz datayı tekrar eski orijinal haline getirmek istersekte şöyle yapacağız;

$array = unserialize($data);
//print_r($array);

/*
(
    [0] => Tayfun Erbilen
    [site] => http://erbilen.net
    [1] => 1993
    [2] => Array
         (
             [ad] => Tayfun
             [soyad] => Erbilen
         )
)
*/

/** 
__CONSTRUCTOR KULLANIM ALANLARI:

Bir sinif cagrilacagindan, cagirlma esnasinda, yani sinif dan nesne olusturulurken nesne olusma durumunda ornegin hazir bir data ile gelmesini istyebiliriz veya gelirken hazir uniq bir id ile gelmesini de isteyebilirz..Yani sinif olustugunda hazir bazi on tanimlaarla gelmesini istreyebilirirz ki bu cok fazla ihtiyacimiz olacak olan bir durumdur iste boyle durumlarda, ki mesela baslarken hazir paremtreler alarak o paramtrelerle baslamasini da isteyebiliriz...

Bazi isler her sinif cagirildiginda yapiliyorsa yapmamiz gerekiyorsa,(id ousturma gibi) _constructor kismina yazariz
Veri tabanin ile ilgili bilgileri sinif cagirirken girilip on yukleyici olarak o bilgiler veriliyor ku sinif olustugunda o bilgileri alsin
 Veritabani baglanti islemlerini de cconstructor da yapabiliriz hani isteriz ki class tan bir sinif olustugnda veri tabanin baglantisi da kurulmus olsun



*/

class t2_ogrenci{
    private $data;
    private $user;
    private $pass;
    function __construct($dbName,$userName,$userPass){
        //Sınıf oluşturulurken parametre gönderilmesini istedik
        $this->data=$dbName;
        $this->user=$userName;
        $this->pass=$userPass;
        //sınıf çağırılırken sınıfı içerisindek değikenlere 
        //göndermiş olduğumuz parametler eklenecek
        echo "Veri tabanı bilgileri girildi.";
    }
}

/**
 Destruct:
 __destruct ise class sonunda ykici yok edici method olarak biliniyor.. ornegin bir veritabani baglantisi kuruldu ve sonra kapatma isini
 __destruct ile yapariz
 Ki muhtemelen bizim objemizin isi bittigi halde kendilinginden kapanmayan veya hala arkada calsmaya devam eden bazi unsurlar vardir(session gibi eger biz kapatmaz isek o arkada calismaya devam ediyor) ve bizim onlari sonlandirmak icin __destruct i kulllanmamiz gerekecek ki belki de bizim hic farketmedigmiz arkada kendilingden calismaya devam eden bizim uygulammizi cok olumsuz etkileyen yapilar varolabilir bunlari kaldirmak icin mecbur __destruct i kullaniriz orneign session sinifi..
 
 */

class db{
    private $data;
    private $user;
    private $pass;
    private $dbBag;
    function __construct($dbName,$userName,$userPass){
        echo "__construct calisiyor";
        //Sınıf oluşturulurken parametre gönderilmesini istedik
        $this->data=$dbName;
        $this->user=$userName;
        $this->pass=$userPass;
        //sınıf çağırılırken sınıfı içerisindek değikenlere 
        //göndermiş olduğumuz parametler eklenecek
       
        try{
            
    $this->dbBag=new PDO("mysql:host=localhost;dbname=$this->data;charset=utf8",$this->user,$this->pass);
    $this->dbBag->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Veri tabanı bağlantısı kuruldu";   
    }catch(PDOException $x){
            echo $x->getMessage();            
        }
    }
    function __destruct(){
        $this->dbBag=null;
        echo "<br />Veri tabanı bağlantısı kapandı";        
    }
}
 
$ogrenciSinif=new db("testdata","root",""); //sınıfı çağırdık

/*
SU KISMI IYI ANLAYALIM BU METHODLAR BELLI ZAMANLARDA BELLI DURUMLAR GERCEKLESINCE CALISYORLAR YANI BIZIM ONU CLASS IN ICERISNDE NORMAL BIR FONKSIYON GIBI  YAZMIS OLMAMIZ ONU GIDIP DE NNORMAL FONKSIYON GIBI KULLANABILECEGIMZ ANLAMINA GELMEZ... 
BUNLAR BIZ ORAYA Y AZMASAK DA BELLI DURUMLAR GERCEKLESINCE ZATEN CALISIYORLAR, TETIKLENIYORLAR AMA BIZ ONLARIN ARKA DA YAPTIKLARI BU ISI COK DAHA VERMIMLI HALE GETIRME ADINA ONLARI ASLINDA BIR NEVI OVERRIDE EDEREK ISLERIMIZI  COK DAHA EFFEKTIF HALE GETIREBILIYORUZ...
*/
//Sınıfa serialize fonksiyonu uygulandığında sınıf içerisindeki değişkenleri __sleep() php sihirli metodu ile geri göndeririz. Yine serialize edilmiş bir sınıfa unserialize uygulandığında devreye __wakeup() metodu girer.
class webMaster{
    public $isim;
    public $soyisim;
    public function __construct($name,$surname){
        $this->isim=$name;
        $this->soyisim=$surname;
        echo "__consturct: Yapıcı Metot";
    }
   public function __sleep(){
        echo "<br />__sleep: Sınıfa serialize işlemi uygulandı.";
        return array("isim","soyisim");
    }
    public function __wakeup(){
        echo "<br />__wakeup: Sınıfa unserialize işlemi uygulandı.";
    }
   public function __destruct(){
        echo "</br>__destruct: Yıkıcı Metot";
    } 
}
 

$sinif=serialize(new webMaster("Çağlar","Bostancı"));
echo $sinif;
$dizi=unserialize($sinif);
print_r($dizi);
echo $dizi->isim;
echo $dizi->soyisim;
?>