<?php 
/* Bu sayfada kategorilerimizi listeleyecegiz ve kategorilerin yanlarinda da kac tane 
tutorial a ait ise o kategori onlari da yaninda getirsin
Bu islemi LEFT JOIN kullanarak CATEGORIES I LEFT E ALARAK YANI TABLOLARDAN ILK ONCE CATEGORIES I YAZARAK yapacagiz
CUNKU TUM KATEGORIES LERI SIRALIYOR EKSIKSIZ SONRA DA ONLARA KARSILK GELEN TUTORIAL LARI SIRALAR EGER BAZI KATEGORILERIN
TUTORIAL KARSILIGI YOK ISE ONLARI DA BOS BIRAKACAKTIR

AMA BIZ EGER KI SUNU ISTERSEK ORNEGIN KATEGORI ISIMLERININ KARSISINDA HER KATEGORIDEN KAC TANE TUTORIAL
 OLDGUNU ALMAK ISTERSEK KUMULATIF HESAPLAMA
O ZAMAN DA AKLMIZIA GROUP BY GELECEKTIR...
*/

if(!isset($_GET['id'])  || empty($_GET['id'])){
    header("Location:index.php?page=categories");
    exit();
}else {

//id gelmis mi , geldi ise dolu mu bos mu onu kontorl ettikten sonra simdi de gelen id veritabaniimzda var mi onu kontrol edelim

$query=$db->prepare("SELECT * FROM CATEGORIES WHERE id=:id");
$query->execute([":id"=>$_GET['id']]);
$my_category=$query->fetch(PDO::FETCH_ASSOC);
if(!$my_category){//buraya girdi ise bu kategori bizim databaseimizde  yoktur o zaman yine bunu categories sayfasina yonlendirelim
header("Location:index.php?page=categories");
exit();
}

}



$category_id=$_GET['id'];
//Burd acategory id
 

//Ne yaptik categories ile tutorials i birlestirdik ve iclerinden category id si bu sayfay gelen kategori hangisi ise ona ait tutorials lar ile birlikte olan tabloyu aldik sadece ve bu sayede tiklanan kategori id si hangisi ise onu ona ait tutorials lari da iceren bir sorgu yazdik burda
//BESTPRACTISE..DIKKAT...EDELIM...
// $category=$db->query("SELECT tutorials.*, categories.name FROM tutorials inner join categories on categories.id=tutorials.category_id WHERE categories.id=$category_id")->fetchAll(PDO::FETCH_ASSOC);

//BIR USSTEKI INNER JON-SORGUSU COK ONEMLI...
//Ama biz katgori id ye gore tutorials lari getirmek istemistik simdi ona bakalim
//AND categories.id=$category_id
// print_r($category);

//HERZAMAN ONCE BASIT DUSUNELIM...PROBLEMIN COZUMLERINI COK KARMASIK VE ZOR ACIDAN COZUNCE COK DA CAZIP OLMUYOR CAZIP OLAN SEY COZUMLERI HEP BASITLESTIRMEYE CALISMAK....BESTPRACTISE...
//SIMDI OLAYLARA YAKLASIM TARZI KAZANALIM VE OLAYLARA HERZAMAN COK BASIT YAKLASIMLARDA BULUNALIM ORNEGIN, BIZ SU AN KATEGORI SAYFASINDAYIZ VE BURAYA
//GET ILE KATEGORI ID GELIYOR BIZ DE O KATEGORI ID UZERINDEN KATEGORI TABLSOUNDAN O KATGORI ID SI HANGI KATEGORI NAME I NE AIT ONU ALDIK VE $my_category 
//isminde bir degiskene de attik...Simdi biz burda hangi katgori id si ve name ine sahibiz bilyourz o zaman bizim neye ihityacimiz var bizim su an ki bu sayfaya gelen kategormizin hangi tutorials lari var ona ihityacimz var...Onu nasil alacagiz..onun icin bizim tutorials ve categories tablolarini join yapmamiza gerek yok...Ne yaparzi..kategori id mizi kullanark tutorials tablomuzdan elimzdeki katgori id ine sahip olan tutorials lari cekersek zaten bu id ninn hangi tutorials lara sahip oldugunu da buluruz ve bu sekilde gereksiz join yapmamiz oluruz...

$category_query=$db->prepare("SELECT * FROM TUTORIALS WHERE FIND_IN_SET(:category_id,tutorials.category_id) ORDER BY ID DESC");
//BURDA DA YINE, BIZ DISARDAN VERDGIMIZ CATEGORY_ID YI, TUTORIALS.CATEGORY_ID LERI(5,7,8)  ICERISINDE ARANMASINI SAGLIYORUZ...BESTPRACTISE..
//FIND_IN_SET SQL DE ARALARINA VIRGUL KOYARAK TUTTUGUMUZ BIRDEN FAZLA ID YI, AYNEN IN_ARRAY ICINDE BIZIM BIR ELEMNTI ARADGIMIZ GIBI ARAMAYI SAGLIYOR
// echo $test;
//SELECT * FROM TUTORIALS WHERE FIND_IN_SET(5,tutorials.category_id);
//ORDER BY ID DESC => BU SEKILDE EN SON EKLENEN EN BASA GELECEK YANI GUNCELLE GORE GETIRECEGIZ DATAYI
$category_query->execute([":category_id"=>$my_category['id']]);
$tutorials_of_category=$category_query->fetchAll(PDO::FETCH_ASSOC);
//print_r($tutorials_of_category);//Buraya gelirken hanig category ye tiklandi ise ona iit tutorials larin listesi geliyor burda..

?>
<?php if($tutorials_of_category) : ?>
   <h3><?php echo $my_category['name']?></h3> 
<ul>
    <h3><?php ?></h3>
    <?php  foreach ($tutorials_of_category as $value): ?>
            <li> <?php  echo $value['title']  ?>

            <div>
                <a href="index.php?page=read&id=<?php echo $value['id'] ?>">[READ]</a>
                <a href="index.php?page=update&id=<?php echo $value['id'] ?>">["EDIT"]</a>
                <a href="index.php?page=delete&id=<?php echo $value['id'] ?>">["DELETE"]</a>
            </div>

        </li>
 <?php   endforeach;      ?>
</ul>
<?php else :  ?>
    <div>There is no tutorial which belong to <strong> <?php  echo $my_category['name']."  "?></strong> category  to show</div>
    <?php endif;?>