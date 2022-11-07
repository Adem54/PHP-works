<?php 

//echo "insert-page";

/*
Temel anlamda insert islemleri icin guvenlik problemi yasamamak icin prepare ve execute methodlarini kullaniyoruz
prepare ile once sorgu hazirlaniyor
prepare $db degiskenimiz icerisinde bulunyor yani PDO class imizin altinda yer aliyor

*/


//PREPARE-EXECUTE ILE INSERT ISLEMI
// try {
//     $my_query=$db->prepare('INSERT INTO TUTORIALSs SET
//     title=?,
//     confirm=?,
//     contain=?
//     ');
    
//     //execute methodu $my_query degiskeni altina bir methodduur
//     //$my_query $db yani PDO dan turemis bir instance olarak icerisinde prepare methodu bulunuyor ve islem sonucunda da bize degisken olarak atadigmz bir $my_query degiskenine atadgimz bir type-class donuyor o class icerisinde de execute methodu bulunuyor
//     $add_data=$my_query->execute([
//     'test title2',1,'test contain2'
//     ]);
// } catch(PDOException $ex){
//    // echo $ex->getMessage();//Burda string icerisinde verilen hata mesaji
//  //   print_r($my_query->errorInfo()); PDOException dan verilen hata mesajinin aynisi dizi icinde geliyor
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
    $confirm=empty($_POST["confirm"]) ? null : $_POST["confirm"];

    
    //$title degeri null iken biz direk ! ile var mi yok mu diye sorgulayabiliriz null ise 0, null degil  ise 1 gelecektir
    //Ama direk null degeri atanmamis halinde eger hic tanimlanmamis ise hata firlatacagi icin biz hata firlatmasin diye null atayalim dedik ve o hata firlatma durmunda da isset ile kontrol ettik ki hata firlatmasinin onune gecelim..yani biz su anda direk parantez icinde !$title diye if condition i olarak sorgulayabilemizizin sebebi buna biz null atadik eger hicbirsey atanmamis ise null yap bizde hata almadan direk sorgulayabilelim isset kullanmadan yoksa issetsiz kullanirsak hata firlatacaktir
   
    if(!$title){
        echo "There is no title"."</br>";
    }elseif(!$contain){
        echo "There is no contain"."</br>";
    }else {
//default olarak yukarda 0 verelim cunku 0 deger olarak atansa bile if de hep false-0 olacagi icin o zaman sknti yasariz
    //Yukarda sadece varligini sorgulamamiz yeterli olacaktir
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
 try {
//     $query=$db->prepare('INSERT INTO TUTORIALS SET
//   title = ?,
//   contain  = ?,
//   confirm = ?
//  ');
 //$add=$query->execute([$title,$contain,$confirm]);

//BURDA EXEC EGER ISLEMI BASARILI GERCEKLESTIRIRSE KAC TANE SATIR ISLEMDEN ETKILENDI ISE
// ONUN SAYISINI VERIR YOK ISLEM BASARILI GERCEKLESMEZ ISE O ZAMAND A FALSE VERIR YANI, 0 VERIR...
//AMA BIR USTTE YAPTGIGMZI YOJNTEM DE $ADD ISLEMI YINE BIZE SONUNDA EKLEME ISLEMININ BASARILI OLUP OLMADIGIN
// CEK EDEBILECEGMIZM 1-TRUE VE 0-FALSE SONUCLARINI DONUYOR...BU COOK ONEMLI...
//BIZ SIMDI TOTAL DE 3 FARKLI SYNTAX ILE INSERT ISLEMI YAPABILMEYI OGRENMIS OLDUK... 
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

    }
    
}

/*
ONEMLI- db->exec methodu ile INSERT-UPDATE-DELETE ISLEMI YAPABILMEK
$db->exec() methodu ile INSERT,UPDATE VE DELETE ISLEMLERI YAPILABILIYOR. OZELLIKLE BU 3 ISLEM NORMALDE
 GERIYE DATA DONMEYEN ISLEMLER OLDUKLARI ICIN EXEC ILE BURDA GERIYE BIR SONUC DONMESI SAGLANMIS OLUYOR
  BIR NEVI BUNU DA BILMEKTE FAYDA VAR
*/
?>
<!--ACTION ICINI BOS BIRAKINCA KENDI BULUNDUGU SAYFAYA YONLENDIRECEKTIR -->
<form action="" method="POST">
    Title: <br>
    <input type="text" value="<?php  echo isset($_POST["title"]) ? $_POST["title"] : null   ?>" name="title"> <br><br>
    Contain: <br>
    <textarea name="contain"  cols="30" rows="10"><?php  echo isset($_POST["contain"]) ? $_POST["contain"] : null   ?></textarea><br><br>
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
  <input type="text" value="<?php  echo isset($_POST["title"]) ? $_POST["title"] : null   ?>" name="title">




-->