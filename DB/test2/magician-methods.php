<?php 

/*
Public class lara her yerden erisim saglanabilir
Private class lara sadece kendi class i icinden erisims saglanabilir ki private bir class a onu inherit eden class lar
dahi erisemezler
Protected kendi icin de bulundugu class ve bu class i inherit eden class tarafindan erisilebilir
*/

/*
SIHIRBAZ METHODLAR
__ iki alt tire ile on tanimli methodlar vardir PHP de bunlara sihirbaze methodlar denior, kendi tanimladigjmiz methodlarin da basina 2 alt cizgi kullanilir
Sihirbaz methodlar otomatik olarak calisirlar yani bu methotlar kendiliginden tetiklenirler
Mesela nesne olusturuldugu zaman, nesne yok edildigi zaman, sinif icinde bulunmayan bir parametre deger girilmeye calisildigi zaman
sinif icin de tanimlanmamis bir fonksiyon  kullanilmaya calisildigi zaman
1-__construct method- genellikle sinifin calismasi icin gerekli olan bilgiler burdan girilir ve ilk gerekli ayarlar yapilarak class lari
baslatmis oluruz
2-Destruct metodu, construct metodunun zıttıdır diyebiliriz. __destruct() sihirbaz metodu, oluşturulan nesne ile ilgili işlemler bittiği an çalışan sihirli metottur. Oluşturduğumuz bir nesne ile ilgili işlemler bittikten sonra bu nesne bellekten silnecektir. İşte bu silme işlemi öncesinde __destruct() sihirbaz metoduyla istediğiniz işlemleri yapabilirsiniz. 

Destruct sihirbaz metodu birçok programlama dilinde destructor yani yıkıcı metot olarak bilinir. Temel amacı oluşturulan nesnenin kullandığı kaynakları temizlemektir. Oluşturduğumuz nesne bir dosya açmış olabilir, socket bağlantısı kurmuş olabilir. Destruct metodu içerisinde açık olan dosya ve socket bağlantılarını kapatabilirsiniz. Yine aynı şekilde bu nesne veritabanı bağlantısı kurmuş olabilir. Bu veritabanı bağlantısını da yine destructor yani yıkıcı metot içinde kapatabilirsiniz. Bir nesne ile ilgili işlemler bittiği an bu nesne bellekten silinecektir, dedik. Öyleyse bu nesnenin açtığı dosya ve socket bağlantısı ya da kurduğu veritabanı bağlantısının hiçbir işlevi kalmamıştır. Ancak bu bağlantılar bellekte yer kaplamaya devam edecektir. İşte __destruct() sihirbaz metoduyla açık olan tüm dosya ve bağlantıları kapatarak bellek temizleme yani kaynak temizleme işlemi yapaibilirsiniz.
3-__get Class içerisinde tanımlanmamış bir özelliğe yani değişkene ulaşmak istediğimizde çalışır. Yine private veya protected olarak tanımlanmış ve class dışından erişim izni olmayan bir değişkene erişim sağladığımızda bu fonksiyon çalışır. 
*/


//Daha cok bu sekilde kullanacagiz
class Kitap
{
    public $kitapAdi;
    public $yazar;
    public $fiyat;

    public function __construct($gKitapAdi, $gYazar, $gFiyat)
    {
        $this->kitapAdi = $gKitapAdi;
        $this->yazar = $gYazar;
        $this->fiyat = $gFiyat;
    }

    public function zamYap($miktar)
    {
        $this->fiyat += $miktar;
    }

    public function __destruct()
    {
        echo "Destruct metodu çalıştı";
    }
    /*
    Yukarıdaki örnekte nesne oluşturulduktan sonra bir de zamYap fonksiyonu çağırılmış ve bu nesne ile ilgili işlemler bitmiştir. İşte tam da bu noktada, yani nesne ile ilgili işlemler bittiği an __destruct fonksiyonu devreye girecek ve burada belirlenen işlemler çalışacaktır. Yani ekrana "Destruct metodu çalıştı" şeklinde bir uyarı yazısı verildikten sonra nesneye ait özellikler silinecektir. 
    Dilerseniz kendiniz de unset komutuyla nesneyi ortadan kaldırarak da __destruct metodunun çalışmasını sağlayabilirsiniz. 
    unset($kitap);


    Destructor

Bir sınıf için oluşturulan nesne ile ilgili tüm referanslar kaldırıldığı veya nesne yok edildiği zaman destructor yöntemi (fonksiyonu) çağrılır.
void __destruct (void)
Eğer alt sınıf içinde bir destructor tanımlanmışsa, üst sınıf içindeki constructor çağrılmaz. Üst sınıf destructor yöntemini çağırmak için parent::__destruct() ifadesi kullanılmalıdır.
Örnek
    */
}

$kitap = new Kitap("Kalplerin Keşfi", "İmam Gazzali", 18.50);
unset($kitap);


//Destructor kullanimi
class personel
{
    public $adi;          
    public $soyadi;       
    public $yasi;         

    function __construct ($arg01, $arg02, $arg03)
    {
        $this->adi = $arg01;       
        $this->soyadi = $arg02;  
        $this->yasi = $arg03; 
    }

    function __destruct()
    {
        echo 'Destructor fonksiyonu içi' . '<br/>';
    }

    public function yaz_bilgi()
    {
        echo $this->adi . " " . $this->soyadi . " " . $this->yasi . '<br/>';
    }
}

$obj_per = new personel("Ahmet", "Saygılı", "27");

$obj_per->yaz_bilgi();

unset($obj_per);


//final class keywordu
//final keywordu nesne yonelimli programlamanin ozelliklerinden biridir
//Proje gelistirirken bazi sinif veya metodlarimizin diger class lar tarfindan 
//inherit edilmesini istemedgimiz durumlar olabilir ayni C# daki sealed keywordu gibi
//Bu sekilde bir sinifimizin base class olmasinin onune gecebiliriz
//Bir class degiskeninde final kullanamayiz



//__get

class Musteri
{
    public $adSoyad;
    private $bakiye = 5000;

    public function __get($degisken)
    {
        echo "$degisken adında bir özellik yok veya erişim izniniz bulunmamaktadır.";
    }
}

$musteri = new Musteri();
$musteri->adSoyad = "Yücel Alkan";

echo $musteri->bakiye;      // private olduğu için hata verecektir
echo $musteri->meslek;    

// bakiye adında bir özellik yok veya erişim izniniz bulunmamaktadır.
// meslek adında bir özellik yok veya erişim izniniz bulunmamaktadır.




// __setClass içerisinde tanımlanmamış bir özelliğe yani değişkene değer atamak istediğimizde çalışır. Yine private veya protected olarak tanımlanmış ve class dışından erişim izni olmayan bir değişkene değer atamak istediğimizde bu fonksiyon çalışır. __set metodu iki farklı parametre alır. İlk parametre değer atanmak istenen özellik adını yani değişken adını verirken, ikinci parametre de bu değişkene atanmak istenen değeri verecektir. 


class Futbolcu
{
    public $adSoyad;
    private $takim;

    public function __set($degisken, $deger)
    {
        echo "$degisken adında bir özellik yok veya erişim izniniz bulunmamaktadır.";
    }
}

$salah = new Futbolcu();
$salah->adSoyad = "Mohamed Salah";

$salah->takim = "Liverpool";        // private olduğu için hata verecektir. 
$salah->boy = 178;                  // böyle bir özellik olmadığı için hata verecektir.

// takim adında bir özellik yok veya erişim izniniz bulunmamaktadır.
// boy adında bir özellik yok veya erişim izniniz bulunmamaktadır.


// __callClass içerisinde tanımlanmayan bir metodu yani fonksiyonu çalıştırmak istediğimiz tetiklenen metottur. İki tane parametre ile birlikte çalışır. İlk parametre metot adını, ikinci parametre ise parametreleri içerir. 

class Uye
{
    public $adSoyad;
    public $meslek;

    public function __call($isim, $parametreler)
    {
        echo "$isim adında bir fonksiyon bulunmuyor";
    }
}

$uye  = new Uye();  
$uye->sifreDegistir();

/*
Dikkat ettiyseniz Uye isimli class içerisinde sifreDegistir() adında bir metot bulunmuyor. İşte bu şekilde class içerisinde bulunmayan bir metoda erişim sağlamaya çalıştığımız zaman __call sihirli metodu otomatik olarak tetiklenir yani çalışır. Bu metot gördüğünüz gibi 2 farklı parametre ile birlikte çalışır. İlk parametre tanımlanmadan kullanılmaya çalışılan fonksiyonun adını verirken, ikinci parametre bu metodun çağrıldığı an gönderdiği parametrelere erişim için kullanılır. Bu sayede yukarıdaki gibi özel hata mesajları oluşturabilirsiniz. Yukarıdaki kodların çıktısı şu şekilde olacaktır:


    sifreDegistir adında bir fonksiyon bulunmuyor. 
    Çok büyük bir projede çalışıyorsanız ya da yıllar önce oluşturduğunuz bir projeye müdahale etmek istediğinizde bazı metotları tanımladığınızı zannedebilirsiniz. İşte __call metoduyla bu tarz hatalı kullanımları yakalayabilir ve sorunları çözebilirsiniz. 
*/
?>