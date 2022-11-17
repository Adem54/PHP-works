<?php //require_once "header.php"; index.php ye dahil ettigmiz icin burda zaten gozukecek ondan dolayi burda kullanmaya gerek yok?> 


<?php 
//echo "insert-page";

/*
Temel anlamda insert islemleri icin guvenlik problemi yasamamak icin prepare ve execute methodlarini kullaniyoruz
prepare ile once sorgu hazirlaniyor
prepare $db degiskenimiz icerisinde bulunyor yani PDO class imizin altinda yer aliyor

*/



//SIMDI DE DATALARI FORM DAN ALARAK EKLEME ISLEMI YAPALIM
//Eger form da submit e tiklanmis sa demektir bu aslinda, burda onu cek ediyoruz iste type i hidden olan input u koyma sebebimiz ilk olarak biz o input uzerinden kontrol edelim diye


if(isset($_POST["submit"])){
    //Gonderilen element ici bos gonderilince de issset ten gecebiliyor
    //form elementleri gonderildigi zaman biz hicbirsey girmezsek bile onlar ici bos bir sekilde geliyor ve ici bos data lar isset ten olumlu geciyor cunku isset dizi iceriisndeki key var mi ozellikle onu kontrol edip eger  yok sa normal de haata firlatip uygulamamiz kiriliyordu bizde bundan kurtulmak icin isset kullaniyoruz normaalde...
    //emtpy kulllanimi cok onemli biz de diyoruz ki sen zaten bir isset den gecmissin o zaman seni artik geldin ama icin bos mu degil mi onu kkontrol edelim eger icin bos ise null yapalim seni ki bir altta mesaj verelim....
 //  $title=empty($_POST["title"]) ? null : $_POST["title"];
    //Simdi kullanici submit e basmis ama title kismini space tuslarina basip gondermis de olabilir
    //Bunuun aynisini php 7 ile gelen ozellik ile yapalim, bir ustteki islem ile ayni sey asagidaki ozelliik php7 ile geldi
   //Burda title in gledignin biliyoruz ama empty mi yani string olarak bos mu onu bilmiyhoruz
    $title=($_POST["title"]) ?? null;//Eger ilk yani soldaki data tanimsiz gelirse yani, orda bir hata durumunda null ver sonucu diyoruz veya oraya isterske bir default deger de atayabilirdik..bir ustteki ternary ile yapilan islemin aynisidir aslinda
    $contain=$_POST["contain"] ?? null;
   // $contain=empty($_POST["contain"]) ? null : $_POST["contain"];
    $confirm=$_POST["confirm"] ?? "0";//onay in default hali 0 olacak zaten onayin olmamasi gibi bir durum soz konusu degil
    //$confirm=empty($_POST["confirm"]) ? null : $_POST["confirm"];

    //$title degeri null iken biz direk ! ile var mi yok mu diye sorgulayabiliriz null ise 0, null degil  ise 1 gelecektir
    //Ama direk null degeri atanmamis halinde eger hic tanimlanmamis ise hata firlatacagi icin biz hata firlatmasin diye null atayalim dedik ve o hata firlatma durmunda da isset ile kontrol ettik ki hata firlatmasinin onune gecelim..yani biz su anda direk parantez icinde !$title diye if condition i olarak sorgulayabilemizizin sebebi buna biz null atadik eger hicbirsey atanmamis ise null yap bizde hata almadan direk sorgulayabilelim isset kullanmadan yoksa issetsiz kullanirsak hata firlatacaktir
    //$category_id=$_POST['category'] ?? null;
    //Kategorinin biz array olarak gelmesini bekliyoruz, ve gelen array i biz yanyana arlarinda virgul olacak sekilde gostermek istiyoruz...
    //Bizim elmizde dizi var ve biz bunu yanyana string olarak gostermek istyoruz..Veritabanina artik 9,8,5 seklinde kaydolacak category_id miz
    //
$category_id=isset($_POST['category']) && is_array($_POST['category']) ? implode(",",$_POST['category']) : null;

    if(!$title){
        echo "There is no title"."</br>";
    }elseif(!$contain){
        echo "There is no contain"."</br>";
    }elseif(!$category_id){
        echo "There is no category is choosen"."</br>";
    }else {
//default olarak yukarda 0 verelim cunku 0 deger olarak atansa bile if de hep false-0 olacagi icin o zaman sknti yasariz
    //Yukarda sadece varligini sorgulamamiz yeterli olacaktir
  
 try {
//     $query=$db->prepare('INSERT INTO TUTORIALS SET
//   title = ?,
//   contain  = ?,
//   confirm = ?,
//   category_id=?,  
//  ');
 //$add=$query->execute([$title,$contain,$confirm,$category_id]);

//BURDA EXEC EGER ISLEMI BASARILI GERCEKLESTIRIRSE KAC TANE SATIR ISLEMDEN ETKILENDI ISE
// ONUN SAYISINI VERIR YOK ISLEM BASARILI GERCEKLESMEZ ISE O ZAMAND A FALSE VERIR YANI, 0 VERIR...
//AMA BIR USTTE YAPTGIGMZI YOJNTEM DE $ADD ISLEMI YINE BIZE SONUNDA EKLEME ISLEMININ BASARILI OLUP OLMADIGIN
// CEK EDEBILECEGMIZM 1-TRUE VE 0-FALSE SONUCLARINI DONUYOR...BU COOK ONEMLI...
//BIZ SIMDI TOTAL DE 3 FARKLI SYNTAX ILE INSERT ISLEMI YAPABILMEYI OGRENMIS OLDUK...

$add2=$db->exec("INSERT INTO TUTORIALS (TITLE,CONTAIN,CATEGORY_ID,CONFIRM) VALUES ('$title','$contain','$category_id','$confirm')");


//LASTINSERTID..YER PDO CLASS I UZERINDEN ERISEBILMEK VE ONU KULLANICI DOSTU BIR YONLENDIRME ICIN KULLNAMAK
//LASTINSERTID YE ERISIP ONU KULLNMAK-EN SON EKLEDIGMIIZ DATA NIN ID SINE ERISEREK KULLANICININ DATASINI EKLER EKLMEZ EKLEDIGI DATANIN DETAYLARINI GOREBILMESINI SAGLIYORUZ....
//BESTPRACTISE...BIZ DOGRUDAN $db degiskenimiz yani PDO class imizin bir instancesi olan $db degiskenimz uzerinden
//veritbanmiiza en son eklenen id ye erisebiliyoruz...bu cook onemli bir bestpractise....dir buna ihtiyacimz olacak..
//BU SAYEDE BIZ YENI BIR DATA EKLENDIGI ZAMAN KULLANICIYI DIREK EKLEDIGI DATAYI OKUYYABILECEGI VEYA DETAYINI GOREBILECEGI SAYFAYA YONLENDIRIYOR
$last_id=$db->lastInsertId();

 if($add2){
    echo "<h3>Your data is added succesfully</h3>";
   header('Location:index.php?page=read&id='.$last_id);
   //index.php?page=read&id=58
   //http://localhost/test/pdo-database/index.ph?page=read&id=59

 } 
 } catch (PDOException $ex) {
    //throw $th;
    // $error=$query->errorInfo();
    // echo "MYSQL ERROR:   ".$error[2];
    echo "MYSQL ERROR: ". $ex->getMessage();
 }

    }
    
}


/*
ONEMLI- db->exec methodu ile INSERT-UPDATE-DELETE ISLEMI YAPABILMEK
$db->exec() methodu ile INSERT,UPDATE VE DELETE ISLEMLERI YAPILABILIYOR. OZELLIKLE BU 3 ISLEM NORMALDE
 GERIYE DATA DONMEYEN ISLEMLER OLDUKLARI ICIN EXEC ILE BURDA GERIYE BIR SONUC DONMESI SAGLANMIS OLUYOR
  BIR NEVI BUNU DA BILMEKTE FAYDA VAR
*/
?>

<?php 
//BU ARADA EGER SQL SORGUMUZ ICERISINDE HERHANGI BIR DATA GIRMEYECEKSEK WHERE ILE VEYA DIGER
//SQL KEYWORDLER I ILE ID, VEYA KOLONLARDAN HERHANGII BIRILERINE DATA GONDERMEYCEKSEK ILLA DA PREPARE 
//KULLANMAMIZ SART DEGIL MESELA BURDA DIRE QUERY ILE DE ALABILIRDIK DATA YI
$query=$db->prepare("SELECT * FROM CATEGORIES ORDER BY NAME ASC");
$query->execute();
$get_categories=$query->fetchAll(PDO::FETCH_ASSOC);

?>

<!--ACTION ICINI BOS BIRAKINCA KENDI BULUNDUGU SAYFAYA YONLENDIRECEKTIR -->
<form action="" method="POST">
    Title: <br>
    <input type="text" value="<?php  echo isset($_POST["title"]) ? $_POST["title"] : null   ?>" name="title"> <br><br>
    Contain: <br>
    <textarea name="contain"  cols="30" rows="10"><?php  echo isset($_POST["contain"]) ? $_POST["contain"] : null   ?></textarea><br><br>
    <!--
    ONE TO MANY RELATION DAN MANY TO MANY RELATION A DONUSTURMEK.....COOK ONEMLI    
    Biz eger her bir tutorial icin 1 tane catgory secebiliyor isek o zaman tutorials ve categories arasindaki iliski one to many yani 1 tutorials in sadece 1 kategorisi olabilir ama 1 kategorinin bir den fazla tutorials i olabilir demektir..  
Ancak biz eger her bir tutorial da bir den fazla kategori secebilsin istersek ornegin arrays veya object-oriented konusu, veya dersi hem Csharp hem de Php de var olan bir dersdir dolayisi ile biz boyle bir ders eklerken birden fazla kategori secmek isteyebiliriz boyle bir durumda tutorials ile categories arasindaki iliski artik many to many relation halini almistir..bunu bilmek cook onemlidir
Many to many relation da yaklasimimiz tamamen degisecektir coook fazla kullancagiz gunluk hayatta...onemli
1-Oncelikle form icindeki category select-option da kullaniciya birden fazla kategori secebilme imkani vermeliyiz bunu da select attributunde multiple ve size  kullanarak yapabiliriz, ayrica cook onemli bu kullanicin sectigi birden fazla kategorinin dizi olarak gonderilebilmesi icin name="category[]" seklinde
name e yazdgimiz value nin yanina bir de koseli parantezler ile indexer  yerlestiririz.
2-Veritabanina gidip category_id yi integer veri turunden varchar olarak degistirmek cunku artik birden fazla kategori secilebilecegi icin
aralara virgul koymamiz gerekecek ondan dolay varchar(255) olarak category_id data type i degistirmemiz gerekecek
-->
    Categories: <br>
    <select name="category[]" multiple size="5" >
   <!-- <option value="">--Choose category--</option> --><!-- kullanici hic kategori secmez ise burasi gozukecek secimi multiple yapacagimiz icin deffault olarak burayi gostermemizi gerektirecek bir durum yok artik-->
        <?php  foreach ($get_categories as $category) { ?>
            <option  value="<?php echo $category['id'] ?>">
        <?php echo $category['name']  ?>
        </option>
       <?php }  ?>
        
    </select>    
    <br><br>
    
    Confirm: <br>
    <select name="confirm" >
        <option value="1">Confirmed</option>
        <option value="0">Unconfirmed</option>
    </select>    
    <br><br>
    <!-- biz type i hidden olan bu input mutlaka gideecek form gonderildigi  zaman ve biz bu hidden li 
    submit gonderilmis mi ona bakacagiz eger bu var ise yani name deki submit var ise demekki bu form 
    submit edilmis diyerek form icindeki diger degerleri kontrol edecegiz -->
    <input type="hidden" name="submit" value="1"/>
    <button type="submit">Submit</button>

</form>

<!--
Categories i formumuz icerisine eklemek
ve ornegin id si 5 olan php kategorisini sectigimiz zaman $_POST[] dizisi icerisine data bu sekilde geliyor
Dikkat edelim biz select-option larda her zaman option larda attribute icindeki value ye id gondeririz bu bizim
arka plan da o kategorinin diger tum datalarina erisebilmek iicin kullanacagimiz id dir ancak opotion etiketleri
arasina ise kategori name i  yazariz ki bu da user larimiz icindir ve select attribute icerisinde name="category"
yazdik bu bizim $_POST dizimiz icerisine key olarak category nin gittigi anlamina gelir ve option icinde hangi option
kullanici tarafindan secilir ise onun value si $_POST icerisine gelecektir...
{
title: "test title-7",
contain: "test contain-7",
category: "5",
confirm: "1",
submit: "1"
},

Biz data eklerken zaten katgorinin id sini ekleyecegiz tutorials icerisine cunku kategory id si 
tutorials tablosu icerisinde foreign key olarak bulunmaktadir ve biz tutorials detayini 
kullaniciya gosterirken o zaman kategorinin name i ne erisebilmek icin bizim tutorials
tablosu ile cateogories tablosu arasinda join yapmamiz gerekecek




 -->





<!-- 
BESTPRACTISE---BUNU IYI OGRENIP UYGULAYALIM
// $title=isset($_POST["title"]) ? isset($_POST["title"]) : null;
    //Simdi kullanici submit e basmis ama title kismini space tuslarina basip gondermis de olabilir
    //Bunuun aynisini php 7 ile gelen ozellik ile yapalim, bir ustteki islem ile ayni sey asagidaki ozelliik php7 ile geldi
    //Yani $_POST icinde title geliyor ama bos geliyor dolayisi ile isset e gerek kalmiyor hata basmiyor ama bos gelip gelmedigni
    //kontrol edip eger bos 
    $title=$_POST["title"] ?? null;//Eger ilk yani soldaki data bos degilse dolu gelirse yani, orda 
    bir hata durumunda null ver sonucu diyoruz veya oraya isterske bir default deger de atayabilirdik..
    bir ustteki ternary ile yapilan islemin aynisidir aslinda..Yani null yaparak bir alttaki aslinda if conidtionunda kullanirken


   NULL-""-TANIMLANMIS AMA HIC DEGER ATANMAMIS 3 FARKLI DEGISKENE ISSET KONTORLUNDEKI DURUMLARINI INCELEDIK
    // Enter your code here, enjoy!
$test="";

if(isset($test)){
	//test ici bos bile olsa tanimlandigi icin isset den true - 1 olarak geciyor ama 
    direk if icinde sorgularsak ornegin if($test) yapinca ise false olarak geliyor bu 
    ikisni karistirmayalim...isset bir deger null mi degil mi ona bakiyor...ama normalde 
    direk if icinde sorgularsak o zaman false aliyoruz
	echo "test diye bir degisken vardir </br>";
}else {
		echo "test diye bir degisken yoktur"."</br>";
}

echo "<br>";
$test2;

if(isset($test2)){
	//test2 degisken deklere edilmis ama herhangi bir deger atanmamis yani null ondan
     dolayi isset kontorlunde false yani 0 gelir
	echo "test2 diye bir degisken vardir"."</br>";
}else {
		echo "</br>"."test2 diye bir degisken yoktur";
}

$test3=null;//null da yine isset kontrolunde false geliyor
if(isset($test3)){
	//test3 degisken i de null oldugu icin isset degiskeninden false yani 0 olarak donecektir
	echo "test3 diye bir degisken vardir"."</br>";
}else {
		echo "</br>"."test3 diye bir degisken yoktur";
}

//$title degeri null iken biz direk ! ile var mi yok mu diye sorgulayabiliriz null ise 0, null degil 
 ise 1 gelecektir
    //Ama direk null degeri atanmamis halinde eger hic tanimlanmamis ise hata firlatacagi icin biz hata
     firlatmasin diye null atayalim dedik ve o hata firlatma durmunda da isset ile kontrol ettik ki 
     hata firlatmasinin onune gecelim..yani biz su anda direk parantez icinde !$title diye if condition 
     i olarak sorgulayabilemizizin sebebi buna biz null atadik eger hicbirsey atanmamis ise null yap 
     bizde hata almadan direk sorgulayabilelim isset kullanmadan yoksa issetsiz kullanirsak hata firlatacaktir
    if(!$title){
        echo "There is no ".$title;
    }
BESTPRACTISE---EMPTY ILE FORM ICERISINDE GONDERILEN AMA BOS BIR  STRING OLARAK GELEN ISSETTEN TRUE-1 OLARAK 
GECEN FORM INPUT LARININ STRING OLARAK BOS GELIP GELMEDGINI NASIL KONTROL EDIYORUZ EMPTY METHODU ILE...BU COK ONEMLIDIR
//Gonderilen element ici bos gonderilince de issset ten gecebiliyor
    //form elementleri gonderildigi zaman biz hicbirsey girmezsek bile onlar ici bos bir sekilde geliyor
     ve ici bos data lar isset ten olumlu geciyor cunku isset dizi iceriisndeki key var mi ozellikle onu 
     kontrol edip eger  yok sa normal de haata firlatip uygulamamiz kiriliyordu bizde bundan kurtulmak icin isset kullaniyoruz normaalde...
    //emtpy kulllanimi cok onemli biz de diyoruz ki sen zaten bir isset den gecmissin o zaman 
    seni artik geldin ama icin bos mu degil mi onu kkontrol edelim eger icin bos ise null yapalim seni ki bir altta mesaj verelim....
   $title=empty($_POST["title"]) ? null : $_POST["title"];
    //Simdi kullanici submit e basmis ama title kismini space tuslarina basip gondermis de olabilir
    //Bunuun aynisini php 7 ile gelen ozellik ile yapalim, bir ustteki islem ile ayni sey asagidaki 
    ozelliik php7 ile geldi
 //   $title=$_POST["title"] ?? null;//Eger ilk yani soldaki data tanimsiz gelirse yani, orda bir hata
  durumunda null ver sonucu diyoruz veya oraya isterske bir default deger de atayabilirdik..bir ustteki 
  ternary ile yapilan islemin aynisidir aslinda
   // $contain=$_POST["contain"] ?? null;
    $contain=empty($_POST["contain"]) ? null : $_POST["contain"];
   // $confirm=$_POST["confirm"] ?? "0";//onay in default hali 0 olacak zaten onayin olmamasi gibi bir 
   durum soz konusu degil
    $confirm=empty($_POST["confirm"]) ? null : $_POST["confirm"];

    BESTPRACTISE-PHP-7 ILE GELEN KISA KULLANIMI KULLANALIM...
$title=empty($_POST["title"]) ? null : $_POST["title"]; YERINE   $title=$_POST["title"] ?? null; 
BUNU KULLANALIM...ARTIK TERNARY YI DAHA KISA KULLANMAK ICIN YAPILMIS BIR SISTEMDIR ONU MUTLAKA KULLANALIM...

    BESTPRACTISE....BUNU KESIN NOT ALLL...COK LAZM OLACAK BIZE
DIKKAT EDELIM KULLANICI EGER FORM INPUTLARINDAN BIRINI GIRDI AMA DIGERLERINDEN BIRINI GIRMEDI VE BIZ 
KULLANICININ GIRDIGI INPUTLARI KORUMAK ISTIYORUZ KAYBOLMASIN ISTIYORUZ O ZAMAN NE YAPACAGIZ DIYEEGIZ KI 
EGER BURAYA $_POST["title"] post icinden bir data girilmis ise o zaman sen bunu yine value icinde goster
 ama yok girilmemis ise o zaman zaten null goster...
  <input type="text" value="<?php //  echo isset($_POST["title"]) ? $_POST["title"] : null   ?>" name="title">

 -->


  



