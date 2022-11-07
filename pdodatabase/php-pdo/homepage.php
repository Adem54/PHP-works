

<a href="index.php?page=insert">[Add contain]</a>

<?php 
//SELECT ILE LISTELEME ISLEMI
//1-QUERY ILE YAPABILIRZ DIREK-DAHA AZ GUVENLI-SQL INJECTION LARA KARSI
//2-PREPARE-EXECUTE ILE DE  YAPABILIRIZ

//Dersler tablosundaki tum verileri listeleyelim
//QUERY ILE BU SEKILDE YAPARIZ
$tutorials=$db->query('SELECT * FROM tutorials')->fetchAll(PDO::FETCH_ASSOC);

//FETCH- YAPARKEN DE DEDGMIZ GIBI SPESIFIK BIR ID ICIN SORGU YAZACAGIMIZ ZAMAN YAPARIZ OZELLIKLE BIZ DATALARIMIZIN DETAILINI GORMEK ISTERIZ VE JOIN ISLEMLERI DE YAPARIZ ORDA ZATEN SELECT ILE WHERE ILE SPESIFIK BIR ID YI GORMEK ISTIYORUZ

$tutorial=$db->query('SELECT * FROM tutorials WHERE id=15')->fetch(PDO::FETCH_ASSOC);
//id si 15 olani getir dedik burda
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

//PREPARE ILE DAHA GUVENLI BIR SEKILDE SELECT-QUERY ISLEMINI YAPACAK OLURSAK

$query=$db->prepare("SELECT * FROM tutorials ");
$query->execute();
$my_tutorials=$query->fetchAll(PDO::FETCH_ASSOC);

//print_r($my_tutorials);

//WITH UNNAMED PLACEHOLDERS

// $query2=$db->prepare('SELECT * FROM tutorials WHERE ID=?');
// $query2->execute([2]);

//WITH NAMED PLACEHOLDERS
// $query2=$db->prepare('SELECT * FROM tutorials WHERE ID=:ID');
// $query2->execute([":ID"=>15]);
// $my_tutorial=$query2->fetch(PDO::FETCH_ASSOC);
//print_r($my_tutorial);


?>
<!-- SIMDI SELECT ILE VERITABANINDAN ALDGIMIZ TUM DATALARI LISTELEYECEGIZ -->
<!-- html icindeki php kullanabilmek-html icinde attribute icinde attirubute icindeki ornegin value="(burda php etiktetleri ac-kaptarak php kodu yazarz)" 
        BUNUN CIDDI AVANTAJINI KULLANMALIYIZ
-->
<ul>
    <?php   
    //AMA KARISTIRMAYAIM-PHP ICINDE ANCAK TIRNAK ICINDE HTML YAZABILIRIZ..ONDAN DOLAYI DA GENELLIKLE PHP YI HTML I COK SIK SEKILDE ACIP KAPATARAK KULLANIRIZ KI HTML I DE DIREK YAZALIM, TIRNAK IINCNDE OLMADAN DIYE
    
    foreach ($my_tutorials as $key => $value): //HTML ICINDEKI PHP NIN BU KULLANIMI COK YAPACAGIZ MUTLAKA NOT AL...  ?>

            <li>  
          <?php echo $value["title"];  ?>     
          <a href="index.php?page=read&id=$value['id']">[READ]</a>   
        </li>

   <?php endforeach;  ?>

   

</ul>
