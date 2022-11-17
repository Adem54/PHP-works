<?php 

/*
ICERISINDE SELECT QUERY SI YAZABILDGIMIZ SQL OPERATORLERININ NE DERECE HAYAT KURTARICI ISLER YAPTIGINI HALA
FARKETMEDI ISEK ASAGIDAKI ORNEKLER BIZE FARKTTIRMESI ICIN YETERLIDIR ZANNEDERSEM...
EXITS()--IN() BUNLARIN ICERISINDE AYRICA SORGU YAZABILYORUZ VE BU BIZE HARIKA BIR EFEKTIFLIK KAZANDIRIYOR
MUKEMMEL IS GORUYOR FARKINDA OLALIM

AYRICA LEFT JOIN VE RIGHT JOIN IN DE NE KADAR IS GORDUGUNU FARKETMEK GEREK...MUKEMMEL IS GORUYORLAR

BU BIZE TUTORIALS VE CATEGORIES TABLOLARINI BIRLESTIREREK VERIYOR
SELECT * FROM TUTORIALS INNER JOIN CATEGORIES ON TUTORIALS.category_id=CATEGORIES.ID ORDER BY DESC;

BU DA YUKARDAKI TUTORIALS VE CATEGORIES SAYFALARININI BIRLESTIREREK VERDIGI DATA NIN AYNISINI VERIYOR
SELECT * FROM TUTORIALS where exists(SELECT * FROM CATEGORIES WHERE TUTORIALS.category_id=CATEGORIES.ID);

ISTE BURASI KIRTIK BIR IS  YAPIYOR ONCE TUTORIALS VE CATEGORIES TABLOLARINI FILTRELEYEREK BIRLESTIRIYOR...COK EFFEKTIF BIR SQL SORGUSU-FILTRELEMESI
SELECT * FROM TUTORIALS where exists(SELECT * FROM CATEGORIES WHERE TUTORIALS.category_id=CATEGORIES.ID AND TUTORIALS.ID=44);

INNER JOIN YAPTIGMIZ TABLOYA FILTRELEME YAPIYORUZ...
$tutorial_id=$_GET['id'];
$tutorial_detail=$db->query("SELECT tutorials.*, categories.name FROM tutorials inner join categories on categories.id=tutorials.category_id
 WHERE tutorials.id=$tutorial_id")->fetchAll(PDO::FETCH_ASSOC);


BURDA DA ORNEGIN ID SINI BILDIGMIZ BIR KATEGORIYE AIT TOPLAM KACTANE  TUTORIAL VAR ISE ONLARI DA ALIP GETIRIYOR
SELECT * FROM tutorials WHERE EXISTS(SELECT * FROM CATEGORIES WHERE tutorials.category_id=categories.ID AND categories.ID=5);


select * from items i where not exists 
(select '' from genres gen where gen.item_id = i.id and gen.name in ('foo','pop') )

join islemleri yaparken selectten sonra hangi tablodan kac ar tane kolon alacagimzi belirleken ornegin bir tablounu tum kolonlarini alacak isek o zamn
soyle yazariz..     SELECT TUTORIALS.*, CATEGORIES.NAME AS CATEGORY_NAME FROM CATEGORIES LEFT JOIN TUTORIALS ON TUTORIALS.CATEGORY_ID=CATEGORIES.ID..


SELECT COUNT(TUTORIALS.category_id) as Tutorial_number, categories.name FROM CATEGORIES LEFT JOIN tutorials ON tutorials.category_id=categories.ID GROUP BY tutorials.category_id;
Kategori ve tutorials listesinde her bir kategoriye kac tutorial dustugunu gormek icin calistidigmiz left join

GROUP BY KULLANIMINI BU SEKILDE YAPMAK MANTIKLI BIZ CUNKU HER BIR KATEGORI KAC TANE TUTORIALS A KARSILIK GELIYOR BUNU BILMEK ISTIYORUZ 
$categories=$db->query("SELECT count(tutorials.id) as total_tutorials, categories.*  FROM CATEGORIES LEFT JOIN TUTORIALS ON 
TUTORIALS.CATEGORY_ID=CATEGORIES.ID group by categories.id  ORDER BY NAME ASC")->fetchAll(PDO::FETCH_ASSOC);
group by categories.id dedgimiz zaman kategori id sinden tekrar edenleri getir demis oluyoruz....bu cook onemli bu mantik...yani ne yi gruplarsin
uniq bir sey gruplanmaz ki eger 1 tane var ise nasil grup olsun, ondan dolayi gruplanacak datalar kategori gibi datalardir category id ye gore grup la ve o gruplamaya da karsi gelen tutorial.id sayisini bana total_tutorials altinda getir demis oluyoruz..



SELECT COUNT(TUTORIALS.ID) as total_tutorial, categories.* FROM CATEGORIES LEFT JOIN tutorials ON tutorials.category_id=categories.ID GROUP BY tutorials.category_id;

ASAGIDAKI ISLEMLERI BIR ARASTIRMAM GEREKIYOR

public function search($searchterm)
{

    $query = $this->db->prepare("
        SELECT 
            id,
            lid, 
            firstname,
            surname,
            socialnr
        FROM `everybody` 
        WHERE (`firstname` LIKE :search OR `surname` LIKE :search)");

    $searchterm = '%' . $searchterm . '%';
    $query->bindParam(':search', $searchterm, PDO::PARAM_STR);

    $query->execute();

    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
      echo $row['id']. ' : '. $row['firstname']. ' '. $row['surname']. ' - '. $row['socialnr']. '<br />';
    }

}

*/


?>