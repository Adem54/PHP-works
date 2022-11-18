<?php 
require_once("connect.php");

if(isset($_POST["lastId"])){
    $last_id=$_POST["lastId"];
    //count ile total data sayisini bul
    //ve total datasayisindan bizim son id mizi cikaralim.. ama burda su dinamikligi nasil hesaplariz biz su an bunu order by id desc e gore yapiyoruz  peki kullanici bunu tekrar asc a gonderirse o zaman da bu yazdigimz sistem calismaya devam eder mi...
    $count_data=$db->query("SELECT COUNT(id) total_count from data")->fetchColumn(); 
   // $count_data=$db->query("SELECT COUNT(id) total_count from data")->fetch(PDO::FETCH_ASSOC)["total_count"]; 
   // echo $count_data;
   //BU BENIM COZUMUMDU
    // $start_limit=$count_data - ($last_id-1);
    // $query_text="LIMIT ".$start_limit.", 5";
    // $query=$db->query("SELECT * FROM data ORDER BY ID  DESC ". $query_text)->fetchAll(PDO::FETCH_ASSOC);

    //ONEMI..LIMIT ISLEMI ORDER BY DAN SONRA GELMELIDIR, ORDER BY DA DIGER FILTRELEMELERDEN SONRA GELMELIDIR BU SIRALARDAKI YAPILAN HATALAR SQL SORGUSUNUN BASARIZISLIKLA SONUCLANAMASINA NEDEN OLACAKTIR
    $query=$db->prepare("SELECT * FROM data where id<:id ORDER BY ID DESC LIMIT 0, 5");
    $query->execute([":id"=>$last_id]);
    $data=$query->fetchAll(PDO::FETCH_ASSOC);


    //HARIKA BESTPRACTISE...BU ISLEMI SORGU ICERISINDE YAPABILIRIZ..
//Burda istek yaparken soyle bir where kosulu uygulayarak filtreleme yapacagiz. where eger id si son id mden kucuk ise filtreleme yap diyecegiz bu sekile her seferinde son id den asagidaki datayi alabilmis olacagiz

//BEN NORMALDE DIREK DATAYI JSON OLARAK GONDERIP, LI NIN ICINE DINAMIK BIR SEKILDE DATAYI YAZMA ISLEMINI JQUERY ICINDE YAPMAYI TERCIH ETMISTIM...AMA BU ISLEMI ISTERSEK DIREK AJAX TA DATAYI HAZIR BIR SEKILDE LI LER ICINE YAZMIS ID VE VALUE SINI DE VERMIS OLARAK HAZIRLAYABILIRIZ
   // echo json_encode($data);

    //BESTPRACTISE...FOREACH ILE $html degiskenimze html kodlarini yazarak gondermis olyuoruz....mvc de yaptimgz isleme cok benziyor
    $html="";
   foreach ($data as $value) {
    ob_start();//ob_start() ile output buffering i baslatiriz
        require("comment.php");/*  $html.="<li data-id='".$value["id"] ."' >". $value["value"] ."</li>"; */
    $html.=ob_get_clean();//ob_get_clean() ile hem temizliyoruz hem de bu bizim bir degiskene aktarmamizi sagliyor   
    //Orneign html e aktaririz bunu 
    //$html.=ob_get_clean(); bunu bu sekilde yaparak hem bunu html den temizlemis oluyoruz hem de burdaki degerimizi, require_once icine yazdigmiz degerimizi almis oluyoruz
    //ob_start() ve ob_get_clean() arasinda kalan foreach ile dondurudgumuz li kismi html e aktrailmayacak 
    //comments.php ye aktarilacak ve ayri tutulacak yani bu yaptgimiz uygulamanin html i icerisine karistirilmayacak ayri tutulacak ki biz boyle bir sistem kurduk diyelim bu sistemi ornegin bircok farkli temalarimizda da kullanmak isteyecegiz dolayisi ile de bizim boyle bir sisteme ihtiyacimz olacak...BU ISTE SURDURULEBILIRLIK VE YENIDEN KULLANILABILIRLIK ICIN HARIKA BIR BESTPRACTISE DIR...VE COK IHTIYACIMIZ OLACAK VE DE AYNI ZAMANDA ADVANCE BIR TEMA
 } 
    echo json_encode([
        "html"=>$html,
        "count"=>count($data),
        "hide"=>count($data)< 5 ? true:false
    ]);
    // "hide"=>count($data)< 5 ? true:false  bunu yapma sebebimiz su ornegin yarin oburgun biz limit i 7 de yapabiliriz o zamanda burda 5 yerine 7 yazariz  "hide"=>count($data)< 7 ? true:false seklinde yazariz cunkujquery tarafinda count 0 oludugunda butonu kaldir diyruz oysa limit 7 yapilaidinda su anki total data sayimiz 30 ve 7 ye tam bolunmedigi icin en son 2 data kalacak ve onu gostermesine ragmen butonu kaldiramyacak dolayisi ile biz de eger data count(yani lastId ye gore alinan) limit sayimizdan kucuk ise true buyuk ise false yap ki biz bunu jquery tarafinda gonderelim ve orda bunu kullanarak datayi butonu data limitin altina dustukten sonra gizeleyebilelim
}
/*
BESTPRACTISE...BU MANTIGA COOK DIKKKAT....
echo ile json olarak gonderdgimz data dan ve yaptigmiz query den sunu anliyoruz ki biz bircok filtreleme ve datayi, hazirlama ve data ile ilgili yapilacak jquery de yapilacak logic leri de kolaylastirmak icin php tarafinda olabildigince daha hazir, daha kolay kullanilabilir data gonderip , jquery de ki front-enddeki isimizi cok daha kolaylastiriyoruz her zaman....
OLAYLARA BAKIS ACISI OLARAK BU SEKILDE YAKLASABILIRIZ CUNKU FRONT-ENT DE BIZ BACKENDDEN GELEN DATA UZERINDE SUREKLI OYUNUYORUZ DOLAYISI ILE BIZE BACKENDDEN NE KADAR COK KULLANABILECEGIMIZ DATA GELIR ISE BIZ FRONT-ENDDE O KADAR AZ UGRASIRIZ

*/


?>