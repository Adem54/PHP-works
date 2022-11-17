<?php //require_once "header.php"; index.php ye dahil ettigmiz icin burda zaten gozukecek ondan dolayi burda kullanmaya gerek yok
?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker(
        {dateFormat: 'yy-mm-dd' }
    );
  } );
  //bu jquery datapicker i n birden fazla inputta kullanaiblmem icin bunun class icin uygulanmasini saglamaliyiz
  //cunku id uniq tir ve tek bir input icin kullanilabilir
  //data-picker tarih formati 11/10/2022 seklinde yani MONTH-DAY-YEAR AMA BIZ VERITABANINA KAYDETTIGMIZ FORMATA CEVIRMEK ISTIYORUZ
  //YEAR-MONTH-DAY SEKLINE CEVIRMEK ISTIYORUZ-jquery icerisine   {dateFormat: 'yy-mm-dd' } bu sekilde yazarak formati da istedgimiz sekle
  //cevirebilirz
  </script>
</head>

<body>
<h3>Tutorial list</h3>

<form action="" method="GET">
        <!--burda biz 2 tarih arasindaki datalari getirmek icin 2 tane input kullaniyoruz ve takvim acilmasini saglayacagiz bunun icinde jquery-datapicker kulllanacagiz -->
        <input type="text" value="<?php echo isset($_GET['start']) ? $_GET['start'] : null ?>"  class="datepicker" name="start" placeholder="Start-date">
        <input type="text" value="<?php echo isset($_GET['end']) ? $_GET['end'] : null ?>"  class="datepicker" name="end" placeholder="End-date"><br><br>
        Search: <br>
        <input type="text" value="<?php echo isset($_GET['search']) ? $_GET['search']:null  ?>" name="search" placeholder="search in tutorials">
     <!-- arama kutusuna kullanici ornegin adem yazarsa url de get parametresine adem su sekilde gelecek 
        http://localhost/test/pdo-database/index.php?search=adem NAME :SEARCH  SEARCH=VALUE
        KULLANICI INPUT ICINE NE GIRERSE BU GET PARAMETREMIZE GELECEK DOLAYISI ILE DE URL DE
        DE BUNU ?SEARCH=ADEM SEKLINDE GORECEGIZ
-->
        <button type="submit">Search</button>
</form>
</body>
</html>
<?php

//Join lerde 2 tablonun da id lerinin ismi id oldugu icin asagida da 
//listelerken direk bu tablodan listeliyoruz ve id yi kullaniyoruz o zaman
//php nin kafasi karisiyor hangi id ye gore alacak ondan dolay select * degil
// sadece tutorials in id sini al categories in primary id sini alma 
//demeliyiz
//BESTPRACTISE...



//eger sql sorgusu icerisine hic data gecilmiyor ise o zaman prepare ile kullanmaya gerek yoktur 
//cunku bizim amacimz sql icinde kullanilan
//verilen direk data var ise onlara sizilmaya injection yapilmaya calisilmasini onlemek

//BESTPRACTISE..BU GERCEKTEN COK FAZLA KULLANACGIMZ VE SURDURULEBILIR BIR
// SISTEM KURMAK ACISINDAN COOK ETKILI COK EFEKTIF BIR YONTEM
//COK HARIKA BESTPRACTISE....
//Simdi hem tarih hemde search input ile ayri ayri 2 farkli filtreleme yapacagiz ve bunu dinamik bir sekilde yapmamiz gerekiyor
//bunu kolay yonetebilmek icin, her bir arama durumunda sql sorgusuna eklememiz gereken ifadeyi dizi icerisnde kontrol ederek
//sorgu sonuna kullanici tarafindan date veya search-text aramalarinin yapilip yapilmamasina gore bunlari sql sorgumuza ekleyecegiz
//dinamik bir sekilde...coook onemli...bestpractise...
$where=[];
$sql="SELECT tutorials.id,tutorials.title,tutorials.contain,tutorials.category_id,
tutorials.confirm,GROUP_CONCAT(categories.name) as category_name, GROUP_CONCAT(categories.id) FROM tutorials inner join categories
 on FIND_IN_SET(categories.id,tutorials.category_id)";

//Biz tam burda search input alanindan get methodu ile submit edilmis mi onu cek ederiz eger 
//herhangi bir sey gonderilmis ise o zaman arama sorgusunu da dinamik bir sekilde  sorgu
//cumlecigimize ekleyecegiz

//&& !empty(trim($_GET['search']) COOK ONEMLI BESTPRACTISE..KULLANICI SPACE TUSUNA BASA BASA
//ARMAA YAPARSA SPACE TUSLARINI ARAMA  YAPARKEN KALDIRMIS OLURUZ BU SEKILDE YOKSA SQL BOSLUK 
//KARAKTERI ARAYACAK GIDIP TITLE ICINDE VE HICBIRSEY BULAMAYACAK AMA BU SEKILDE HER BIR INPUTA
//TEK TEK ONLEM ALMAK YERINE, INDEX.PHP DE GLOBAL OLARAK BU TARZ ISLEMLERI YAPARSAK TEKRAR TEKRAR
//UGRASMAMIS OLURZ..EMPTY ILE KONTROL EDERSEK KULLANICI SEARCH ALANINA BIRSEY YAZMAZ ISE LIKE SORGUSU
//DEVREYE GIRMEZ VE BOS BOSUNA ARAMA YAPMAYA CALISMAZ BU ONEMLIDIR
if(isset($_GET['search']) && !empty(trim($_GET['search']))){
        $where[]="(tutorials.title LIKE '%" . $_GET['search'] . "%'  ||  tutorials.contain LIKE '%" . $_GET['search'] . "%'  )";
}
//Ozellikle || kullanirken cok dikkatli olalim ve mumkun mertebe parantezler icerisine alarak kullanmaliyiz...bu cook onemlidir
//Hem title hem de icerige gore arama yaptiriyoruz

if(isset($_GET['start']) && !empty($_GET['start']) && isset($_GET['end']) && !empty($_GET['end']) ){
        $where[]="tutorials.date BETWEEN   '". $_GET['start'] ." 00:00:00'  AND  '". $_GET['end'] ." 23:59:59' ";
}
//Tarih secerken kullanicinin sectigi ayni gune ait kaydimiz var ise onu da alabilmek icin saati gunun basindan sonuna ayarlayarak
//kullanicinin sectigi ayni gune denk gelen kaydin da gelmesini saglariz..

//simdi de where dizimiz icine sorgu yapilmis mi onu cek edelimm
if(count($where)>0){
        $sql.=" WHERE " .implode(" && ",$where);//eger 2 tane elemnt var ise dizi icinde aralarin e && koyacak yok 1 tane elemnt var ise zaten 
        //onun veya ardina hicbir sey koymaz, & bu sadece dizi icindeki elementleri stringe cevirirken arlaarina ne koyacagimizi gostermek icin
}

$sql.=" GROUP BY TUTORIALS.ID order by tutorials.id DESC";
//bu arada order by diger sorgu kritileri arasinda en son kullanilmalidir

// '" .$_GET['search']. "'  bestpractise bu bir string cift tirnak icindeki text icerisine bir php degiskenini yine tirnak icinde 
//kibi yazmak demektir cunku bizim input tan gelen degeri sql icinde tirnak icinde yazmamiz gerekiyor yani 
//biz cift tirnak icinde bir degiskeni tek tirnak icinde yazmamiz gerekiyor
//Normalde olay aslinda su sekilde "WHERE tutorials.title LIKE 'adem'"; seklinde yazilacak ama biz adem i dinamik
//yazacagiz ondan dolayi da oraya kadar olan stringi kesiyoruz araya dinamik php yaziyoruz ve tekrar stringi kaldigi yerden devam ettiriyoruz
//Yani '".   ."' bu araya yazarak biz " " cift tirnak icinde tek tirnak yazimini defvam ettirmis oluyoruz olay bu aslinda...espiri bu..
//"   '". bu tek tirnakgi baslattik ve sonra cift tirnak ile oraya kadar olan stringi kapattik araya dinamik php kodu yazdik sonra tekrar kaldigmz yerden
//devam ettiriyoruz     ."' " yani cift tirnak ile acip kapatiyoruz yazacagimiz yer icin ve actimgiz tek tirnagi tekrar kapatiyoruz 
//biz " '  ' " cift tirnak icinde tek tirnak kullaniyoruz ama degiskeni de o tek tirnagin icinde kullaniyoruz dolayisi ile "' ".   ." '"
 echo $sql;
$my_tutorials =$db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

/*
HARIKA BESTPRACTISE..HER BIR TUTORIAL A AIT KAC TANE KATEGORI VAR ISE HEPSININ NAME
 INI TUTORIAL YANINDA  YAZDIRMAK
SIMDI ARTIK MANY TO MANY RELATIONA GECTIKTEN SONRA BIZIM BU ANA SAYFA DA TUTORIALS
 LARI LISTELERKEN YANLARINDA CATEGORY SINI DE GETIRMISTIK
ONCEKI ONE TO MANY -RELATION MANTIGINA GORE-ONE(CATGRY) TO MANY(TUTORIALS)..VE INNER 
JOIN ILE BU ISI HALLETMISTIK AMA ARTIK MANY TO MANY RELATION A GECTGIMIZ ICIN BURDA
 BIZ HER BIR TUTARIAL A AIT OLAN BIRDEN FAZLA  KATEGORILERI ALAMAIYORUZ CUNKU JOIN ISLEMIMIZDEKI 
 ID CAKISTIRMASI BOZULDU HEMEN ONU DA FIND_IN_SET ILE ELE ALMAZMI GEREKIYOR TUTORIALS 
 TABLOSUNDANKI TUTORIALS.CATEGORY_ID SI ICERISINDE CATEGORIES TABLOSUNDAKI CATEGORY
  ID SI VAR MI ONA BAKMAMIZ GEREKIYOR...FIND_IN_SET ILE-FROM tutorials inner join 
  categories on FIND_IN_SET(categories.id,tutorials.category_id)
BUNU YAPINCA BU SEFER DE NE OLUYOR AYNI ICERIGIE SAHIP FARKLI KATEGORIDEKI ICERIKLER 
HER BIR KATEGORI ICIN LISTELENDIGI ICIN ORNEIGN 4 FARKLI KATEGORISI OLAN BIR TUTORIAL 4 KEZ LISTELENIYOR,
 3 KATGEGORISI OLAN TUTORIAL 3 KEZ LISTELENIYOR BU DA DEGIL BIZIM ISTEDGIMIZ..BURDA AYNI ICERIK VEYA AYNI 
 TUTORIAL FARKLI CATEGORY DE TEKRARLANIYORSA O ZAMAN BIZ AYNI ICERIKLERI  GROUP BY ILE GROUP LAYABILIRIZ...
 NEYE GORE GRUPLAYACAGIZ TUTORIALS.ID YE GORE CUNKU TEKRARLANAN YAPI TUTORIALS, GROUP BY TUTORIALS.
 ID order by tutorials.id DESC BU SEKIDLE ORDER BY DAN ONCE GROP BY I DA KULLANIRIZ VE BIZIM KATEGORI 
 ISIMLERIMIZDEN DE 1 TANESINI GORUYORUZ YINE, KATGORI ICINDEKI NAME OLARAK AMA BIZ, HER BIR FARKLI
  TUTORIAL A GORE GROUP BY ILE UNIQ TUTORIAL LISTESINE AIT KAC TANE KATEGORI VAR ISE HEPSINI GORMEK
   ISTIYORUZ O ZAMAN BIZ NE YAPARIZ SORGU ICINDE SELECTTEN ONCE CATEGORIES.NAME I GROUP_CONCAT(CATEGORIES.NAME)
    SEKLINDE KULLANARAK ARTIK HER BIR TUTORIAL A AIT TUM KATEGORILERIN GELMESINI SAGLARIZ... 
"SELECT tutorials.id,tutorials.title,tutorials.contain,tutorials.category_id,
tutorials.confirm,GROUP_CONCAT(categories.name) as category_name FROM tutorials inner join categories
 on FIND_IN_SET(categories.id,tutorials.category_id)";
MUKEMMEL BESTPRACTISE BU YONTEMLE GERCEKTEN YAPMASI COK ZOR OLAN BIR ISLEMI YAPABILIYORUZ..
HER BIR TUTORIAL YANINDA HANGI KATEGORI NAME LERININ VAR OLDUGUNU
ALABILIYORUZ...NAME LERINI YANYANAY ARALARINDA VIRGUL OLACAK SEKILDE ALABILIYORUZ...
 SELECT TUTORIALS.*, GROUP_CONCAT(CATEGORIES.NAME) AS CATEGORY_NAME FROM TUTORIALS
  LEFT JOIN CATEGORIES ON FIND_IN_SET(CATEGORIES.ID, TUTORIALS.category_id) GROUP BY TUTORIALS.ID;
 GROUP_BY,GROUP_CONCAT,FIND_IN_SET BUNLARLA GERCEKTEN COK CIDDI ADVANCE SEVIYE ISTATISTIKLER ELDE EDEBILIYORUZ...
 HARIKA COK IYI OGRENIP ILERI SEVIYE ISLEMLERE DOGRU ILERLEYELIM
*/



?>

<!--BIZ ANA SAYFADA DATAYI GOSTERIRKEN KATEGORY ISIMLERI ILE BERABER GOSTERMEK ISTIYORUZ... -->
<?php if ($my_tutorials) :  ?>

        <ul>
                <?php
               
                foreach ($my_tutorials as $key => $value) : //HTML ICINDEKI PHP NIN BU KULLANIMI COK YAPACAGIZ MUTLAKA NOT AL...  
                ?>
                <li>
                        <?php echo $value["title"]."-----" ;   ?>
                        <?php  if($value['category_name']) :?>
                                <!-- 
                EXPLODE-IMPLODE U COK FAZLA KULLANMAYA IHTIYACIMIZ OLACAK
                $_POST VE $_GET TEN COKLU SECIMDE DATA DIZI OLARAK GELIR VE BURDAN DIZI OLARAK ALDIGIMZ DATAYI STRINGE CEVIRIP SQL SORGULARIMIZDA KULLANMAMIZI GEREKTIREN DURUMLAR SIKLIKLA KARSIMIZA CIKARKEN
                TAM TERSI DURUMD A DA DIREK SQL DEN SELECT  SORGUSU ILE ALDIGIMZ COKLU KATEGORI VEYA HERHANGI BIR KOLON SQL ICINDEN YANYANA ARALARINDA VIRGULLE BIRLIKTE GELEBILIR VE BIZIM BU DATALARI DAHA EFEKTIF KULLANABILMEKI ICIN DIZIYE CEVIRMEMIZ GEREKECEKTIR KI RAHATCA BUNLARI LISTELEYIP ISTEDGIMZ GIBI KULLANABILEIM....COOK ONEMLI...            
                        "9,8,5,11" ve "Python,Csharp,Javascript,Php" seklindeki stringleri diziye cevirerek uzerlerinde cok daha kolay
                manupasyon yapabilmeyi ve istedgim seyleri uygulayabilmeyi saglayacagiz..
                BESTPRACTISE...COOK PRATIK BIR KULLANIMDIR...DIKKAT EDELIM...EZBERLERDEN DISARI CIKALIM..BIRAZ DAHA FARKLI DUSUNELIM..
                PEKI ELIMIZDE 2 TANE FARKLI DIZI OLACAK AMA DIKKAT EDERSEK IKI DIZI DE AYNI KATEGORIYININ BIRI ID LERINI DIGERI DE NAME LERINI
                LISTELIYOR YANI, HER IKISI DE AYNI INDISLERI VEYA INDEX LERI KULLANACAK O ZAMAN BIZ INDEX LER UZERINDEN TEK FOREACH ILE
                HER IKI DIZI ICINDEKI VALUE LERE COK KOLAY BIR SEKILDE ERISEBILIRIZ....BESTPRACTISE DIR
                        -->
                              <?php $category_names= explode(",",$value['category_name']); ?>
                              <?php $category_ids= explode(",",$value['category_id']); ?>
                           <?php   foreach ($category_names as $key=> $category_name) :  ?>                         
                          <?php echo   "<a href='index.php?page=category&id=$category_ids[$key]'> $category_name </a>"." -- "; ?>
                               <?php endforeach; ?>
                               <?php endif;?>
                                <?php echo "(".$value['category_id'].")";   ?>
                        <div>
                        <?php if ($value["confirm"]) { ?>
                                <a href="index.php?page=read&id=<?php echo $value['id'] ?>">[READ]</a>
                        <?php } ?>
                        <a href="index.php?page=update&id=<?php echo $value['id'] ?>">["EDIT"]</a>
                        <a href="index.php?page=delete&id=<?php echo $value['id'] ?>">["DELETE"]</a>
                        </div>
                </li>
                <?php endforeach;  ?>
        </ul>
<?php else : ?>
        <!-- Arama var ama icerik yok ise o zaman da mesaj verelim cunku biz icerigin olmadigi kisim olan else de yaziyoruz kodumuz
burda eger arama var ise o zaman aradginiz icerik bulunmamaktadir mesaji verebiliriz
Arama var icerik yok ise bir hata mesaji bir normalde hic icerik yok ise de farkli bir hta mesaji gosterecegiz
Burda 2 farkli data bulunamadi type i var 1 i si data hic yok, 2. si bir arama sonucunda aranan data  yok...
Biz burda hata mesajini da yine once arama yapilmis mi onu cek ediyoruz eger arama yapilmis ve hic bir data y ok  ise o zaman
aradiginiz data bulunamadi yok arama yapilmamis ama  yine data yok ise o zaman da listelenecek herhangi bir ders  yok
-->
        <div>
                <?php  if(isset($_GET['search'])):  ?>
              The tutorial you are looking for is not found.
                <?php else:?>
                        <div>There is no tutorial to list</div>
        <?php endif;  ?>
        </div>       
       
       
<?php endif; ?>




<!-- 
FORMUMUZ ICERISINDEKI INPUT LARDA KULLANICI TARAFINDAN GIRILEN VALUE NIN KORUNMASI..COK ONEMLI BESTPRACTISE...
<form action="" method="GET">
        Search: <br>
        <input type="text" value="<?php // echo isset($_GET['search']) ? $_GET['search']:null  ?>" name="search" placeholder="search in tutorials">
     arama kutusuna kullanici ornegin adem yazarsa url de get parametresine adem su sekilde gelecek 
        http://localhost/test/pdo-database/index.php?search=adem NAME :SEARCH  SEARCH=VALUE
        KULLANICI INPUT ICINE NE GIRERSE BU GET PARAMETREMIZE GELECEK DOLAYISI ILE DE URL DE
        DE BUNU ?SEARCH=ADEM SEKLINDE GORECEGIZ

<button type="submit">Search</button>
</form>



DINAMIK SQL SORGULARI OLSUTURMAK....BESTPRACTISE..STRING ICINDE YENI BIR TIRNAK OLUSTURARAK ORAYA DINAMIK 
SORGU DEGISKENI YAZMA SYNTAXINI DOGRU YAZMALYIZ COOK ONEMLI

// '" .$_GET['search']. "'  bestpractise bu bir string cift tirnak icindeki text icerisine bir php degiskenini yine tirnak icinde 
//kibi yazmak demektir cunku bizim input tan gelen degeri sql icinde tirnak icinde yazmamiz gerekiyor yani 
//biz cift tirnak icinde bir degiskeni tek tirnak icinde yazmamiz gerekiyor
//Normalde olay aslinda su sekilde "WHERE tutorials.title LIKE 'adem'"; seklinde yazilacak ama biz adem i dinamik
//yazacagiz ondan dolayi da oraya kadar olan stringi kesiyoruz araya dinamik php yaziyoruz ve tekrar stringi kaldigi yerden devam ettiriyoruz
//Yani '".   ."' bu araya yazarak biz " " cift tirnak icinde tek tirnak yazimini defvam ettirmis oluyoruz olay bu aslinda...espiri bu..
//"   '". bu tek tirnakgi baslattik ve sonra cift tirnak ile oraya kadar olan stringi kapattik araya dinamik php kodu yazdik sonra tekrar kaldigmz yerden
//devam ettiriyoruz     ."' " yani cift tirnak ile acip kapatiyoruz yazacagimiz yer icin ve actimgiz tek tirnagi tekrar kapatiyoruz 
//biz " '  ' " cift tirnak icinde tek tirnak kullaniyoruz ama degiskeni de o tek tirnagin icinde kullaniyoruz dolayisi ile "' ".   ." '"





//SELECT ILE LISTELEME ISLEMI
//1-QUERY ILE YAPABILIRZ DIREK-DAHA AZ GUVENLI-SQL INJECTION LARA KARSI
//2-PREPARE-EXECUTE ILE DE  YAPABILIRIZ

//Dersler tablosundaki tum verileri listeleyelim
//QUERY ILE BU SEKILDE YAPARIZ
//$tutorials = $db->query('SELECT * FROM tutorials')->fetchAll(PDO::FETCH_ASSOC);

//FETCH- YAPARKEN DE DEDGMIZ GIBI SPESIFIK BIR ID ICIN SORGU YAZACAGIMIZ ZAMAN YAPARIZ OZELLIKLE BIZ DATALARIMIZIN DETAILINI GORMEK ISTERIZ VE JOIN ISLEMLERI DE YAPARIZ ORDA ZATEN SELECT ILE WHERE ILE SPESIFIK BIR ID YI GORMEK ISTIYORUZ

//$tutorial = $db->query('SELECT * FROM tutorials WHERE id=15')->fetch(PDO::FETCH_ASSOC);
//id si 15 olani getir dedik burda

//PREPARE ILE DAHA GUVENLI BIR SEKILDE SELECT-QUERY ISLEMINI YAPACAK OLURSAK
// 1 tane connect.php dosyamiz var


 SIMDI SELECT ILE VERITABANINDAN ALDGIMIZ TUM DATALARI LISTELEYECEGIZ 
 html icindeki php kullanabilmek-html icinde attribute icinde attirubute icindeki ornegin
 value="(burda php etiktetleri ac-kaptarak php kodu yazarz)" 
        BUNUN CIDDI AVANTAJINI KULLANMALIYIZ

BESPRACTISE...BURDA DATA YOKKEN DE LISTELEMEYE CALISIYOR..BUNU KONTROL EDELIM EGER DATA 
YOK ISE LISTELEMEYE CALISMASIN VE MESAJ VERSIN LISTELENECEK DATA BULUNAMADI DIYE
BURAYI NOT ALALIM--ONEMLI
<?php // if ($my_tutorials) :  ?>
my_tutorials var ise listele burda foreach ile dizi halindeki datamizi listelioruz php yi html
icine gomerek
<?php // else : ?>
        <div>There is no class to list</div>
<?php // endif; ?>

 //AMA KARISTIRMAYAIM-PHP ICINDE ANCAK TIRNAK ICINDE HTML YAZABILIRIZ..ONDAN DOLAYI DA GENELLIKLE 
//PHP YI HTML I COK SIK SEKILDE ACIP KAPATARAK KULLANIRIZ KI HTML I DE DIREK YAZALIM, TIRNAK IINCNDE OLMADAN DIYE 
 <ul>
 <?php
               
          //     foreach ($my_tutorials as $key => $value) : //HTML ICINDEKI PHP NIN BU KULLANIMI COK YAPACAGIZ MUTLAKA NOT AL...  
               ?>
               <li>
                       <?php // echo $value["title"]."-----". "(".$value['category_name'].")";   ?>
                       <div>
                       <?php // if ($value["confirm"]) { ?>

                               <a href="index.php?page=read&id=<?php // echo $value['id'] ?>">[READ]</a>

                       <?php // } ?>
                       <a href="index.php?page=update&id=<?php // echo $value['id'] ?>">["EDIT"]</a>

                       <a href="index.php?page=delete&id=<?php // echo $value['id'] ?>">["DELETE"]</a>
                       </div>
               </li>
               <?php // endforeach;  ?>
       </ul>




DIKKAT EDELIM GET ILE GONDERDIGMIZ DATALAR VEYA BIZIM DIREK URL YE GIRDIKLERIMIZ $_GET DIZISI ALTINA GELENLER
ANA URL DEN SONRA ? ILE BASLIYORDU ?KEY=VALUE&KEY2=VALUE2&KEY3=VALUE3&....BU SYNTAX ILE GELIYORDU URL E DOLAYISI ILE DE BIZIMI
BURDA GET ILE DATA GONDERILECEGIINI DUSUNUDGUMUZ ZAMAN BU SYNTAX A UYGUN SEKILDE YAZMAMIZ GEREKIR

ECHO KULLANMAYA DIKKAT EDELIM......COOK ONEMLI...ECHO KULLANMADAN BIZ DATAMIZI TARAYCI ICINDEKI ETIKETLERIN HEM KULLANICIYA GOSTERDGMIZ
KISMINDA HEM DE ATTRIBUTE KISMINA DATAYI ALAMAIYORUZ....
 <a href="index.php?page=read&id=<?php  //  echo $value['id'] 
                                        ?>">[READ]</a>
                 BESTPRATISE KULLANIM...BURASI COOK ONEMLI...
                  BIZ PHP DEGISKENINI DIREK YAZDGIMZ ZAAMN ORNEING URL DE 
                  DIREK YAZDIGMIZ ZAMAN EKRANA GELMIYO EKRNA GELMESI ICIN 
                  ECHO ILE YAZMMAIZ GEREKIYOR....BU HATAYI DA COK YAPABILIYORUZ... 


  ONEMLI...
                  Sadece confirm-1-true onayli olanlarin oku kismini gostermek istiyoruz --->
<!-- Read,Edit,Delete ile biz dogrudan tiklanan data nin id sini orda elde ettigimiz icin bu bize o dataya ait hem 
                tum detaylara select ile database uzerinden erisebilmemizi sagliyor hem de delete, edit islemelrini de spesfik bir
                 dataya gore yapabilmemizi sagliyor 
        

/*
PDO::FETCH_ASSOC tanımında, dönen dizin elemanının sütün adına göre dönmesi sağlanmaktadır. PDO::FETCH_NUM tanımında, dönen dizin elemanı ise sütun numarasına göre dönecek şekilde ayarlanmaktadır.
YANI BIZIM TABLO KOLON ISIMLERINE GORE GELMESI ICIN BOYLE YAPARIZ CUNKU SQL BU DATAYI BIR TABLODAN ALIP GELIYOR VE GELIRKEN O TABLONUN DA INDEX LERI VAR 0,1, DIYE ONLARLA GETIRIYOR BIZE, ISTE ONLARDAN KURTULUP SAF VERITABANI TABLOMUZUN KOLONLARINI KEY OLARAK GETIR VALUE LERI  DE VALUE OLARAK GETIR DEMEK ICN YAPARIZ BUNU

FETCH_ASSOC DA BU SEKILDE GELMESINI SAGLARIZ LISTENIN
{
id: "1",
title: "test-title",
contain: "test-contain",
confirm: "1",
date: "2022-11-07 09:30:29"
}


FETCH_NUM DA ISE ASAGIDAKI GIBI GELMEISNI SAGLARIZ..
{
0: "1",
1: "test-title",
2: "test-contain",
3: "1",
4: "2022-11-07 09:30:29"
},
*/
//SELECT ISLEMI...
//Bunu direk bu sekilde  yazdirinca dogrudan ekrana yazdiramiyoruz ondan dolayi bunu 2 method ile birlikte yazdiracagiz..
//SELECT ISLEMINDE CUNKU BIZIM IHTIYACMIZA GORE DATAYI CEKECEGMIZ ICIN DIREK CEKEMIYORUZ DOGAL OLARAK
//1-FETCH-SADECE 1 TANE VERI CEKEBILIYORUZ-ID YE OZEL DETAY BILGISI GOSTERIRKEN KULLANIRIZ GENELLIKLE
//2-FETCHALL-BU DA BIRDEN FAZLA DATALARI FILTERLEYEREK VEYA TAMAMINI GOSTERIRKEN KULLANIRIZ...
//print_r($tutorials);
//print_r($tutorial);


//WITH UNNAMED PLACEHOLDERS

// $query2=$db->prepare('SELECT * FROM tutorials WHERE ID=?');
// $query2->execute([2]);

//WITH NAMED PLACEHOLDERS
// $query2=$db->prepare('SELECT * FROM tutorials WHERE ID=:ID');
// $query2->execute([":ID"=>15]);
// $my_tutorial=$query2->fetch(PDO::FETCH_ASSOC);
//print_r($my_tutorial);



-->