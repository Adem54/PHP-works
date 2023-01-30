<?php 
//Burda veritabani baglantisnini gerceklestirecegiz
//PDO bir inbuild php sinifidir ondan dolayi dogrudan kullanabilyoruz
//1.parameter=mysql:host=localhost;dbname=testdb   sadece testdb bizim veritabani adimz burda
//2.parameter  kullanici adi- bu veritabanina hangi kullanici ile girilebliyor ise
//3.parameter sifre

//Veritabani baglantisinda hata alma riskmiz  oldugu icin ve uzak bir baglanti oldugu icin try-catch ile yapmak mantiklidir hata olursa da yakalayabilmek icn

//PDO VERITABANI BAGLANTISI GERCEKLESTIRME
try {
$db=new PDO("mysql:host=localhost;dbname=testdb","root",""); 
} catch (PDOException $e) {//PDO nun Exception sinifida var, eger baglnti da hata olusursa kullnalim, hatayi yakalayip bize mantikli bir mesaj donmesi icin
 echo  $e->getMessage();
 //Eger olmayan bir database e baglanmaya calisirsak 
 //SQLSTATE[HY000] [1049] Unknown database 'testdb2' boyle bir hata aliiriz
}


$iMapShapeId = $db->query_execute(



);


/*

INSERT INTO 'map_layers' (provider_id,name,note,shape_names,shape_types,shape,active) VALUES (:provider_id,:name,:note,:shape_names,:shape_types,ST_GeomFromText(:shape),:active)


':provider_id' => int 1
  ':name' => string 'Rode-netsense-1' (length=15)
  ':note' => string 'Test rode notat' (length=15)
  ':shape_names' => string 'point-1,line-1,polygon-1' (length=24)
  ':shape_types' => string 'POINT,LINESTRING,POLYGON' (length=24)
  ':shape' => string 'GEOMETRYCOLLECTION(POINT(9.614426032015992 59.16862627290814),LINESTRING(9.618417159030152 59.16518393263604,9.617172614047242 59.16469999760005,9.613224402377318 59.16495296449574,9.61097134680481 59.165876827698696),POLYGON((9.627227056141509 59.16995592467478,9.629285907796628 59.16771956882306,9.622771332410279 59.167341578738245,9.618684358229215 59.1702708926226,9.627227056141509 59.16995592467478)))' (length=409)
  ':active' => string 'T' (length=1)

*/

?>