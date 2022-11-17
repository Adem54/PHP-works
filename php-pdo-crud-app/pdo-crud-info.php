<?php 

//PDO INSTANCESI $DB->EXEC() METHODU-INSERT,UPDATE,DELETE METHODLARINDA RETURN ALMAK ICN KULLANILABILIYOR
//INSERT-UPDATE-DELETE METHODLARI $DB ALTINDA EXEC METHODU ILE DE KULLANILABLIYOR EXEC METHODUNUN OZELLIGI EGER ISLEM BASARI ILE GERCEKLESIR ISE TOPLAMDA ISLEMDEN KAC ADET SATIR EKLENDI ISE ONU DONER YOK ISLEM BASARI ILE GERCEKLESMEZ ISE O ZMAN DA FALSE-YANI 0 DONER

try {
    //     $query=$db->prepare('INSERT INTO TUTORIALS SET
    //   title = ?,
    //   contain  = ?,
    //   confirm = ?
    //  ');
     //$add=$query->execute([$title,$contain,$confirm]);
    
    //BURDA EXEC EGER ISLEMI BASARILI GERCEKLESTIRIRSE KAC TANE SATIR ISLEMDEN ETKILENDI ISE ONUN SAYISINI VERIR YOK ISLEM BASARILI GERCEKLESMEZ ISE O ZAMAND A FALSE VERIR YANI, 0 VERIR...AMA BIR USTTE YAPTGIGMZI YOJNTEM DE $ADD ISLEMI YINE BIZE SONUNDA EKLEME ISLEMININ BASARILI OLUP OLMADIGIN CEK EDEBILECEGMIZM 1-TRUE VE 0-FALSE SONUCLARINI DONUYOR...BU COOK ONEMLI...BIZ SIMDI TOTAL DE 3 FARKLI SYNTAX ILE INSERT ISLEMI YAPABILMEYI OGRENMIS OLDUK... 
    $add2=$db->exec("INSERT INTO TUTORIALS (TITLE,CONTAIN,CONFIRM) VALUES ('$title','$contain','$confirm')");
    echo "add2: ".$add2;
    
     if($add2){
        echo "<h3>Your data is added succesfully</h3>";
       header('Location:index.php');
    
     }
     } catch (PDOException $ex) {
        //throw $th;
        // $error=$query->errorInfo();
        // echo "MYSQL ERROR:   ".$error[2];
        echo "MYSQL ERROR: ". $ex->getMessage();
     }



//VERI ALMA YONTEMLERI-FETCH , FETCHALL
//SQL-OBJECTS(SQL DE DATALARIMIZ OBJE HALINDE TUTULUYOR VEYA OBJE OLARAK GELIYOR)=> PDO => ARRAYS
//AMA BIZ BU DATLARI OBJE OLARAK DEGIL ARRAY OLARAK ALMAK ISTIYORUZ ISTE BURDA DEVREYE DATA->FETCH(), DATA->FETCHALL() ISLEMLERI DEVREYE GIRIYOR
//VERILERI ALIRKEN DE HANGI BICIMDE VERILERE IHTIYACMIZ VAR ISE ONU ACIKCA BELIRTMEMIZ GEREKECEKTIR
//PDO::FETCH_ASSOC:ANAHTAR OLARAK SUTUN ADLARIYLE DIZI DONDURUR
//PDO::FETCH_BOTH(DEFAULT) HEM SUTUN ADLARI HEM DE SIRA NUMARALARI BICIMINDE INDISLERI OLAN BIR DIZI DONDURUR
//PDO:FETCH_BOUND: SUTUN DEGERLERINI PDOSTATMENT::BINDCOLUMN() ILE ILISKILENDIRILMIS PHP DEGISKENLERINE ATAR VE TRUE DONDURUR
//PDO::FETCH_CLASS: SUTUN SINIFLARINI BELIRTILEN SINIFIN UYGUN OZELLIKLERINE ATAR.BAZI SUTUN ICIN OZELLIK YOKSA OLUSTURULACAK
//PDO::FETCH_INTO: BELIRTILEN SINIFIN MEVCUT BIR ORNEGINI GUNCELLER
//PDO::FETCH_LAZY:PDO::FETCH_BOTH VE PDO::FETCH_OBJ SABITLERININ BIRLESIMIDIR
//PDO::FETCH_NUM: SUTUN NUMARALARINA GORE INDISLENMIS BIR DIZI DONER. ILK SUTUN INDISI 0 DIR
//PDO::FETCH_OBJ:OZELLIK ISIMLERININI SINIF ISIMLERINE DENK DUSTUGU BIR ANONIM NESNE OZELLIGI DONDURUR
//FETCH_LAZY ifadesi betiği yavaşlatır, bu yüzden onu kullanmayın.
//PRATIKTE BIZ GENELLIKLE FETCH_CLASS,FETCH_ASSOC VE FETCH_OBJ OZELLIKLERI BIZIM ISIMIZI GORUR.
//VERI FORMATINI AYARLAMAK ICIN ASAGIDAK SOZ DIZIMI KULLANILIR
//$oku->fetch(PDO::FETCH_ASSOC); 

//BESTPRACTISE...BU AYNI C# DA CLASS LAR ILE VERITABANINDAKI TABLOYU BIZIMI ICIN MATCH EDEN ENTITTY-FRAMEWORK E COK BENZIYOR MANTIK OLARAK
//FETCH_CLASS GETIRME METHODU COK HARIKA VE MUKEMMEL BIR IS GOREN BIR  YONETMDIR VE COK FAZLA KULLANACAGIZ
//Bu getirme methodu ile verileri dogrudan sectigimiz bir sinifa getirmemizi saglar
//Fetch_Class kullanilirken nesnenizin ozellikleri kurucuyu cagirmadan once ayarlanir...Bu cok onemli.Ilgili sutun adinin ozellikleri yoksa sizin icin boyle bir ozellik global olarak olusturulur
//Bu veritabanindan cikarildiktan sonra verilerin donusturulmesi gerektiginde, nesne olusturulduktan hemen sonra otomatik olarak gerceklestirilebilecegi anlamina geliyor
//Oluşturulan sınıftaki özelliklerin adları, veritabanındaki alanların adları ile aynı olmalıdır.

/*
FETCH_CLASS KULLANIM
<?php
class User
{
  public $ad;
  public $soyad;
  public $email;
  public function showInfo()
  {
  echo "<br>".$this->ad."<br>".$this->soyad."<br>".$this->email."<br>";
  }
}
$oku = $db->query("SELECT * FROM test");  

$result = $oku->FETCHALL(PDO::FETCH_CLASS, "User");

foreach($result as $user)
{
    $user->showInfo();
}


*/
/*
PREPARED IFADELER-PREPARED EXPRESSIONS
PREPARED IFADELER sunucuya sadece  farkli veri kumeleri gondererk surekli olarak calistirilabilen onceden derlenmis bir SQL ifadeleridir
Bu  placeholder da kullanilan verilerin otomatik olarak SQL enjeksiyon saldirilara karsi guvenli hale getirilmesini avntajina sahiptir

ASAGIDA 3 FARKLI PREPARE KULLANIMI ORNEKLERINI GOREBILIRIZ
# Yer tutucu olmadan - SQL enjeksiyon kapısı açık! BU SEKILDE KULLANILMASI TAVSIYE EDILMEZ GUVENLIK ACIGI VARDIR

$oku = $db->prepare("INSERT INTO okul (ad, ders, not) 
values ($ad, $ders, $not)");
 
# adsız yer tutucuları

$oku = $db->prepare("INSERT INTO okul (ad, ders, not) 
values (?, ?, ?);

bu da bir usttekinin ayni islemin set ile yapilmis halidir
    $query=$db->prepare('INSERT INTO TUTORIALS SET
  title = ?,
  contain  = ?,
  confirm = ?
 ');

 bu bu islemin bir sonraki asamasidir-set ile adlandirilmamis yer tutucusu islemini bir adim sonrasi
  $add=$query->execute([$title,$contain,$confirm]);
 
#  adlandırılmış yer tutucuları

$oku = $db->prepare("INSERT INTO okul (ad, ders, not) 
value (:ad, :ders, :not)");

bu da  bir usttekinin aynisinin set ile yapilmis hali
 $query=$db->prepare('INSERT INTO TUTORIALS SET
  title = :title,
  contain  =:contain,
  confirm =:confirm ?
 ');
 bu bu islemin bir sonraki asamasidir-set ile adlandirilmamis yer tutucusu islemini bir adim sonrasi
  $query->execute([":title"=>$title, :contain=>$contain, :confirm=>$confirm  "])



BURDA SIMDI DE ISIMSIZ(?) VE ADLANDIRILMIS(:ad) YER TUTUCULAR ARASINDAKI FARK, HAZIRLANAN IFADELERIN NASIL AKTARILACAGIDIR
<?php
# Her bir yer tutucuya değişkenler atayın, index 1-3

$oku->bindParam(1, $ad);
$oku->bindParam(2, $ders);
$oku->bindParam(3, $not);
 
# Bir satır ekle

$ad = "Ali"
$ders = "matematik";
$not = 80;
$oku->execute();
 
#  farklı değerler içeren başka bir satır ekle

$ad = "Mehmet"
$ders = "Fizik";
$not = 100;
$oku->execute();

ILK ONCE TUM YER TUTUCULARA DEGISKENLER ATARIZ. DAHA SONRA BU DEGISKENLERE DEGER LER ATAR VE SORGUYU YURUTURUZ
YENI BIR VERI SETI GONDERMEK ICIN, SADECE DEGISKENLERIN DEGERLERINI DEGISTIRIRIZ VE TEKRAR SORGUYU YENILERIZ
SQL DE COK FAZLA PARAMETRE VAR ISE HER BIRINI BIR DEGISKENE ATAMAK COK SAKINCALI BIR ISLEMDIR YANI YUKARDA YAPTGIMZ
BU GIBI DURUMLARDA VERILERI BIR DIZIDE SAKLAYABILIR VEYA AKTARABILIRIZ
#  eklemek istediğimiz veriler
$data = ['Ali', 'aaaa@mail.com', 'Ankara'];
 
$oku = $db->prepare("INSERT INTO test (ad, email, sehir) values (?, ?, ?);
$oku->execute($data);

DIZIDEKI VERILER SIRASI ILE YER TUTCULARI ICN GECERLIDIR $ data[0] ilk yer tutucuya,$data[1] ikincisine vb...
Ancak eger dizi indeksli sirali degil ise, bu duzgun calismayabilir ve diziyi yeniden indekslememiz gerekir

ADLANDIRILMIS YER TUTUCULARI
# İlk argüman adlandırılmış yer tutucu ismidir.
# Yer tutucular her zaman bir kolon ile başlar.

$oku->bindParam(':name', $name);

BURDA BIR DIZIYI DE EKLEYEBILIRIZ, ANCAK ILISKILENDIRILMIS BIR DIZI OLMALIDIR.ANAHTARIN ROLU, TAHMIN EDECEGIMIZ GIBI YER TUTUCULARIN ISIMLERI OLMALIDIR
# eklediğimiz veriler

$data = ['ad'=>'Ali','email'=>'aaaa@mail.com','sehir'=>'Ankara'];  

$oku = $db->prepare("INSERT INTO test (ad,email,sehir) 
values (:ad, :email, :sehir)"); 

$oku->execute($data);

Birer isimle (:isim) ifade edilen değiştirgeli prepare örnek
<?php

$oku = $db->prepare("INSERT INTO test (ad, soyad, email) 
VALUES (:ad, :soyad, :email)");

$oku->bindParam(':ad', $ad);

$oku->bindParam(':soyad', $soyad);

$oku->bindParam(':email', $email);

$oku->execute();

soru imi (?) ile ifade edilen değiştirgeli prepare örnek

<?php

$oku = $db->prepare("INSERT INTO test (ad, soyad, email) VALUES (?, ?, ?)");

$oku->bindParam(1, $ad);

$oku->bindParam(2, $soyad);

$oku->bindParam(3, $email);

$oku->execute();

Dizili ekleme
$oku = $db->prepare("INSERT INTO test (ad, soyad, email) VALUES (?, ?, ?)");

$oku->execute([$ad,$soyad,$email]);

Veri Güncelleme

<?php
$data = [
    'id' => $id,
    'ad' => $ad,
    'soyad' => $soyad,
    ];
$sql = "UPDATE test SET ad=:ad, soyad=:soyad WHERE id=:id";

$db->prepare($sql)->execute($data);

TOPLU ISLEM YURUTME
Toplu islem yapmak oldukca kolay, program kodlari icine PDO->beginTransaction() ve PDO->commit) methodlarini dahil ederek toplu islemler tamamlanana kadar baska kimseniin goremeyecegini PHP CEKIRDEGINI YAZAN KADRO TARAFINDAN SIZE GARANTI EDILIYOR. BIRSEYLER TERS GIDERSE YAKALAM BLOGU,CATCH BLOGU ISLEM BASLATILDIGINDAN BERI YAPILAN TUM DEGISIKLIKLERI GERI ALIR VE SONRA BIR HATA MESAJI YAZDIRIR.

<?php

conn = new PDO( "sqlsrv:server=(local); Database = Test", "", "");

  $conn->beginTransaction(); 

try{

$ekle = $conn->exec("insert into Table1(col1, col2) values('a', 'b') ");  
$ekle = $conn->exec("insert into Table1(col1, col2) values('a', 'c') ");  
$ekle = $conn->exec("delete from Table1 where col1 = 'a' and col2 = 'b'"); 
 
 $conn->commit();

 catch(Exception $e){
    
    echo $e->getMessage();

    //İşlemi geri al.

    $pdo->rollBack();

}
İşlem Şartlarının Açıklaması.
Begin transaction: İşlem başlatıldı ve MySQL'in varsayılan otomatik devreye alma özelliği devre dışı bırakıldı. Örnek: INSERT sorgusu çalıştırırsanız, veriler hemen eklenmez.
Commit: Bir işlem yaptığınızda, temel olarak MySQL'e her şeyin yolunda gittiğini ve sorgularınızın sonuçlarının son haline getirildiğini söylüyorsunuz.
Rollback: PDO::beginTransaction() ile başlatılan toplu hareketi geri alır. Bir toplu hareket etkin değilken bu yöntemin çağrılması bir hataya sebep olur.




*/

//INSERT ISLEMI ILE ILGILI PHP-PDO ISLEMLERININ FARKLI VERSIYONLARI

//PREPARE-EXECUTE ILE INSERT ISLEMI
// try {
//     $my_query=$db->prepare('INSERT INTO TUTORIALSs SET
//     title=?,
//     confirm=?,
//     contain=?
//     ');
    
    //execute methodu $my_query degiskeni altina bir methodduur
    //$my_query $db yani PDO dan turemis bir instance olarak icerisinde prepare methodu bulunuyor ve 
//islem sonucunda da bize degisken olarak atadigmz bir $my_query degiskenine atadgimz bir type-class donuyor
// o class icerisinde de execute methodu bulunuyor
//     $add_data=$my_query->execute([
//     'test title2',1,'test contain2'
//     ]);
// } catch(PDOException $ex){
   // echo $ex->getMessage();//Burda string icerisinde verilen hata mesaji
 //   print_r($my_query->errorInfo()); PDOException dan verilen hata mesajinin aynisi dizi icinde geliyor
//     $error=$my_query->errorInfo();
//     echo  "MYSQL ERROR:  ".$error[2];
// }

//PREPARE-EXECUTE ILE INSERT ISLEMI


//Bu sekilde kullanma sebebimiz sql-injection a karsi guvenli bir kullanim ile onlem almis oluyoruz ve bu sekilde sorgulara disardan hicbirsekilde mudahele edilelemis oluyorlar
//$add_data bize boolean yani 1 ya da 0 donecektir...true-1 false-0 hatasiz bir sekilde datamiz eklenir ise 1, data eklenmede sorun  yasarsak o zaman 0 aliriz

//NORMALDE HATA YONETIMINI YUKARDA TRY-CATCH ILE DEGIL DE BU SEKILDE IF ILE YONETTI AMA BEN YINE DE HATA ALDGIIM ICIN, TRY-CATCH ILE YONETTIM
// if($add_data){
//     echo "Data is added successfully";
// }else {
//     print_r($my_query->errorInfo());
     //Bu hata donusumu sayesinde ornegin biz gidip olmayan bir tabloya data eklemeye calisirsak, bize burda hata donecek
// }



//Normalde direk $db icindeki query ile ekleme islemi de yapabilirdik
//NORMAL DATA EKLEME-AZ GUVENLIKLI
//$db->query('INSERT INTO tutorials set title="test-title",confirm=1,contain="test-contain"');
//Bu sekilde datamizi kolay bir sekilde ekleyebiliyoruz ve datamiz eklenmis oldugunu su anda phpmyadmin i kontrol ederek de gorebiliriz
//Ancak bu sorgu guvenli bir sorgu degil disardan yapilabilecek sql injectionlara yani sql sizmalara yani sql kodu yazarak veritabnimiza ve datalarimiza erisme durumlarindan dolayi bunu tercih etmiyoruz bir yukardaki prepare ve execute ile biz data ekleme islemini yapiyoruz


//ARTIK EKLEME ISLEMINI YAPABILIRIZ 
 /*
 bu da bir yontem
  $query=$db->prepare('INSERT INTO TUTORIALS SET
  title = :title,
  contain  =:contain,
  confirm =:confirm ?
 ');
  
 $query->execute([":title"=>$title, :contain=>$contain, :confirm=>$confirm  "])

  */


 /*
 $query=$db->prepare('INSERT INTO TUTORIALS SET
  title = ?,
  contain  = ?,
  confirm = ?,HATALI DURUM VIRGUL KONMAAZ 
 ');
 */
 //NOT BURDA DIKKAT EDELIMMMMMM PHP DE DIZI ICINDEKI EN SON ELEMANIN SONUNA VIRGUL KOYAMAK COK SKNTILI
 // BIR DURUM HEMEN HATA VERIYOR VE HATA OLARAK DA
 //BIR SONRAKI SATIR CALISMADIGI ICIN BIR SONRAKI SATIRI ISARET EDIYOR BIZIIM HEMEN ANLAMAMIZ GEREKIR BIR
 // YERDE HAATA VAR ISE BIR SATIR I ISARET EDIYOR ISE PHP HATA OLARAK BIR ONCEKI SATIRI OZELLIKLE KONTROL ETMELIYIZ

?>