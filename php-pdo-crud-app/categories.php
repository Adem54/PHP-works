 <?php //require_once "header.php"; index.php ye dahil ettigmiz icin burda zaten gozukecek ondan dolayi burda kullanmaya gerek yok?> 

<a href="index.php?page=add_category">[Add category]</a>

<?php 
//prepare ile bu tarz query leri nasiil yapaariz ona da bakalim bir ara

//COUNT(TUTORIALS.ID) AS total_tutorials,categories.
$categories=$db->query("SELECT count(tutorials.id) as total_tutorial, categories.*  FROM CATEGORIES LEFT JOIN TUTORIALS ON 
FIND_IN_SET(CATEGORIES.ID,TUTORIALS.CATEGORY_ID) group by categories.id  ORDER BY NAME ASC")->fetchAll(PDO::FETCH_ASSOC);

//BESTPRACTISE...
//MUKEMMEL BESTPRACTISE...FIND_IN_SET ILE BIZ MANY TO MANY RELATION DA HARIKA BIR COZUM URETEBILIYORUZ...
//BIZ TUTORIALS MANY TO MANY RELATION YAPTIGIMIZ ICIN DATABASE DE TUTORIALS TABLE DA CATEGORILERIMIZ 7,8,9 DIYE GELIYOR
//ONDAN DOLAYI LEFT JOIN DE CATEGORY.ID DEKI KATEGORI YI ALIYOR ORNEIGIN PHP-ID-5 5 I GELIP TUTORIALS DAKI CATEGORY_ID LER
//ILE ESIT MI DEGIL MI BAKIYOR, O ZAMAN NE OLUYOR ORNEGIN 5 ILE 5,6,7 YI KIYASLIYOR VE 0-FALSE VERIYOR SONUCU OYSA 5,6,7 ICINDE
//5 VAR O ZAMAN BIZIM BU SORUNU COZMEMIZ GEREKIYOR...BUNU FIND_IN_SET ILE COZERIZ...FIND_IN_SET ILE(ONCE MEVCUT ID(TEKLI OLAN ID),BURAYA DA VIRGULLU OLAN ID GRUBU GELECEK) 


//Artik total tutorial ile her kategori yanina kac tane dersi var yazdirabilirz
// $query->execute();
//$categories=$query->fetchAll(PDO::FETCH_ASSOC);
 //print_r($categories);
/*{
total_tutorials: "3",
id: "5",
name: "Php"
}, */
?>
<!--Once kategoriler var mi onu cek ederiz..eger yok ise listelenecek kategori yok diye mesaj veririz
Ardindan ise kategoriler var ise onu asagida foreach icerisinde listeliyoruz
-->
<?php if($categories):   ?>
    <ul>
        <?php foreach ($categories as $category): ?>  
            <li>
                <!-- Neden boyle yapiyoruz cunku kategori detayina gitmek istiyoruz..Buraya tikladggimz zaman biz kategoriye ait id ye erisebilegim
            ve burda o id uzerinden database den select ile kategoriye ait tum detaylara erisebiliriz
            -->
                <a href="index.php?page=category&id=<?php echo $category['id'] ?>"  > 
                <?php echo $category['name']." (". $category['total_tutorial'].")"  ?>
            </a>
             
            </li>
        <?php endforeach;   ?>
    </ul>
<?php else: ?>
    <div>There is no category to list</div>
    <?php endif;?>

    <!--
BESTPRACTISE-FOREIGN KEY-PRIMARY KEY-ONE TO MANY RELATION
Biz tutorials ile categories tablolari arasinda join islemi yapacagiz
tutorials-1 tutorial 1 tane kategorisi var ama 1 kategorinin 1 den fazla tutorial i var  o zaman
bu relation one to many--o zaman one iliskisi olan tutorial icine kategory foreign key olarak eklememiz gerekiyor
VERITABNINA GIDIP TUTORIALS ICINE KATEGORY ALANI EKELRIZ VE ONU FOREIGN KEY YAPARIZ
VERITABANIMIZDA TUTORIALS ICERISINE CATEGORY_ID ALANINI DA EKLEDIKTEN SONRA INSERT.PHP YE GIDIP ORDA KULLLANICINI
KATEGORIES SECEBILEMSINI SAGLAYACAGIZ
     -->