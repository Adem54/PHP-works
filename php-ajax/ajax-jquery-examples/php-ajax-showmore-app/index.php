<?php 

/*
burda biz datalarimizdan son 5 tanesini gosterecegiz ve showmore a tiklandiginda da bir onceki 5 data
gosterecegiz
Simdi yapmak istedigimz showmore isleminin mantigina bakacak olursak her butona tiklandiginda bir onceki 5 data gelecek
normalde biz tum datayi select ile alip onu da limit ile 5 data olacak sekilde sinirlandirabiliyoruz 
o zaman her tiklndiginda biz arkada yeni bir sorgu yaptiracagiz...ve o sorguda yine select icersinde bize ne lazim olacak 
limit  islemini dinamik yapacagiz yani limit 0,5 ile 0 dan sonra basla 1 ile , 5 tane data al demekti, o zaman burda hep 5 datamiz gelmesni 
istiyoruz o sabit olacak ne degisecek her zaman en son gosterilen data id si kac ise bize o lazm...olacak id leri tabi 1 den baslayip 1 er 1er arttigini varsayiyoruz oyle olmasa idi o zaman da index degerlerni kullanabilirdik.. 
Neden bize hep en son listelenen id lazim cunku bir sonraki query de limit icinde o id yi kullanacagiz..
Peki biz mantik olarak ne yapacagiz ajax ile bu islemi yapacagiz yani kullanici showmore a tikladigi zaman biz oncelikle listelenen id lerden en sonuncu olani dinamik olarak jquery ile alabilmemiz lazim..peki jquery html elemntlerine nasil erisiyordu,ozellikle id ve class lar ile hatirlayalimmm o zaman biz li lere listeledigmiz datanin id lerini de atayacagiz 
<li data-id="<?= $value["id"] ?>"><?=$value["value"] ?></li>

*/

require_once("connect.php");
//En son eklenenden , yani en gunceli en once getirsin diye order by id desc yapariz her zaman
//limit ile de gelen datayi sinirlayabiliyorduk. Limit nasil calisyordu hatirlayalim... limit 5,5 denildigi zaman 5.datadan sonra getirmeye basla yani 6 dan itibaren getir, kac tane 5 tane getir anlamina geliyor
$data=$db->query("SELECT * FROM data order by id desc limit 0,5")->fetchAll(PDO::FETCH_ASSOC);
// print_r($data);
// print_r(end($data));


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <!-- <script src="app.js"></script> -->
    <script>
        $(function(){
          $("#show-more").on("click",function(event){
            event.preventDefault();//Butona tikladigmzda butonun default olan hareketlerini durdur bunu tamamen ben kontrol edecegim diyoruz ki bu cok hayatidir, cunku ornegin bir a link etiketi her tiklandiginda sayfa  yeniler, biz bunu istemeyiz cogu zaman, veya iste submit butonu ise formu gondermeye calisabilir, biz de diyoruz ki hayir sen ben nasil yonlendirirsem onu yap sadece default  yaptigin islemleri bir kenarak birak demis oluyoruz
            //Tiklandigi zaman islem yapmak icin bunun icinde yapariz islemi
       
            //SON ID YI BU SEKILDE DAHA KOLAY BIR SEKIL DE ALABILIRIZ
            //dataset ten dolayi data("id") diye aliyoruz cunku data-id yazinca o data={id:} data objesi icine atiyor
            let last_id=$("#list li:last").data("id");
            let liElements=$("li");
            console.log(liElements);
           let lastElement=liElements[liElements.length-1];
           let lastId=lastElement.dataset.id;
           console.log("lastId: ",lastId);//javasscript dataset harika bir bestpractise biz normalde html elemntlerine attribute custom attribute iste bu yolla verebiliyoruz ve bir obje icinde toplayarak gondermis oluyoruz bu sekilde dinamik bir sekilde cok daha kolay erisebiliyoruz
           //lastId yi de aldigmiza gore o zaman biz bunu ajax.php ye post request ile gonderelim ve ordan da her tiklamada yeni bir sorgu alalim
            //const last = arr.at(-1);
        //  lastId=lastId>=6 ? lastId : 26;//16 yerine total_count un response dan alarak direk veritabanindaki tablonun total_countuna baglariz ve bu sekilde data kac olursa olsun her zaman, veritabnindanki data sayisina gore en basa alir..
        $.post("ajax.php",{"lastId":lastId }, (response)=>{
                console.log(response);
                $("#list").append(response.html);
                // if(response.count===0){//count bize ajax.php den geliyor ve orda en son gosterdgimiz data dan kac tane kaldgini veriyor bize o zaman count 0 oldugunda yani orda lastId ye gore alacak data kalmadiginda o zaman butonu kaldir diyebiliriz
                //     $("#show-more").remove();
                // }
                //Bu bize ajax.php tarafindan geliyor... "hide"=>count($data)< 5 ? true:false  bunu yapma sebebimiz su ornegin yarin oburgun biz limit i 7 de yapabiliriz o zamanda burda 5 yerine 7 yazariz  "hide"=>count($data)< 7 ? true:false seklinde yazariz cunkujquery tarafinda count 0 oludugunda butonu kaldir diyruz oysa limit 7 yapilaidinda su anki total data sayimiz 30 ve 7 ye tam bolunmedigi icin en son 2 data kalacak ve onu gostermesine ragmen butonu kaldiramyacak dolayisi ile biz de eger data count(yani lastId ye gore alinan) limit sayimizdan kucuk ise true buyuk ise false yap
                if(response.hide){
                    $("#show-more").remove();
                }
                //BEN DIREK DATAYI JSON OLARAK AJAX TAN RESPONSE EDIP LI ICERIISNE GELEN DATAYI YAZMA ISLEMINI BURDA YAPMISTIM AMA BU ISLEMI BIZ AJAX.PHP DE DE YAPABILIYORUZ
            // for (let i= 0; i< liElements.length; i++) {
            //     const element=liElements[i];
            //     element.innerText=response[i].value; 
            //     element.dataset.id=response[i].id;
            //     console.log("elementId: ",element.dataset.id);                      
            //     }
              
                //lastId  5 ten buyuk ise istegi tekrarlayacagiz yani recrusive function
               
            }, "json")

          })      

        });

    </script>
    <title>Document</title>
</head>
<body>
    <!--
OUTPUT BUFFERING
Ornegin bu foreach icerisindeki li lerimizi yorum olarak dusunelim biz showmore uygulamasni yaptik ama ne yaptik gittik ajax.php de html yazdik tekrardan, ve ordan html gonderdik front-ende ordan aldigmiz html i ne yaptik her tiklandiginda burdaki li lerin arkasina eklddik
Yeni bir temaya gecip de yine bunu yapacaigmiz zaman o zaman bizim gidip ajax ta yazdimgiz response html i degistirmemiz gerekecek
Bunun olmamasi icin soyle yapabiliirz
index.php icindeki foreach iceriisnde donderdgimz li elementlerimizi ordan keseriz onlari yorum gibi dusunelim ve onlari alip yeni bir php dosyayi olustururuz comment.php diye ve foreach icerisinde yazdigmiz li yi aldik comment.php ye yapistirdik ve comment.php ye require ile forach arasina cagirdik...ve bizim  templatimiz artik standart hale geldi ama hala ajax.php den gelen li lerim standart degil onu nasil standart hale getiririz peki
   $html="";
   foreach ($data as $value) {
    ob_start();//ob_start() ile output buffering i baslatiriz
        require_once("comment.php");/*  $html.="<li data-id='".$value["id"] ."' >". $value["value"] ."</li>"; */
    $html.=ob_get_clean();//ob_get_clean() ile hem temizliyoruz hem de bu bizim bir degiskene aktarmamizi sagliyor   
    //Orneign html e aktaririz bunu 
    //$html.=ob_get_clean(); bunu bu sekilde yaparak hem bunu html den temizlemis oluyoruz hem de burdaki degerimizi, require_once icine yazdigmiz degerimizi almis oluyoruz
    //ob_start() ve ob_get_clean() arasinda kalan foreach ile dondurudgumuz li kismi html e aktrailmayacak 
    //comments.php ye aktarilacak ve ayri tutulacak yani bu yaptgimiz uygulamanin html i icerisine karistirilmayacak ayri tutulacak ki biz boyle bir sistem kurduk diyelim bu sistemi ornegin bircok farkli temalarimizda da kullanmak isteyecegiz dolayisi ile de bizim boyle bir sisteme ihtiyacimz olacak...BU ISTE SURDURULEBILIRLIK VE YENIDEN KULLANILABILIRLIK ICIN HARIKA BIR BESTPRACTISE DIR...VE COK IHTIYACIMIZ OLACAK VE DE AYNI ZAMANDA ADVANCE BIR TEMA
 } 
 BU ISLEMI YAPARAK NE YI SAGLADIK SIMDI ONU IYICE ANLAYALIM......
 ORNEGIN YARIN OBURGUN COMMENT.PHP DE LI ICERISINDE YENI BIR CLASS EKLEDIK VE YENI BIRSEY EKLEDIK DIYELIM KI MESELA CLASS=TEST EKLEDIK
 <li data-id="<?= $value["id"] ?>" class="test" ><?=$value["value"] ?></li>
 BU HEM SAYFAMIZ ILK BASLAYINCA INDEX.PHP DEN GELEN 5 TANE LI ICERISINDE BUNU ALABILDIK AYRICA DA SHOW MORE A TIKLAYINCA BACKEND DATABSE DEN GELEN
 DIGER ELEMENTLER ICERISINDE DE GOZUKMUS VE GELMIS OLDU...BU COK ONEMLI BIR BESTPRACTISE DIR VE NORMALDE ANLAMAKTA VE COZMEKTE COK CIDDI ZORLANABILECEGIMZ BIR KONU OLABILIR ONDNA DOLAYI COK IYI OGRENELIM
 BU SEKILDE BIZ SISTEMIMIZI TEK BIR STANDART HALINE GETIRMIS OLDUK VE SIMDI BU SISTEMI ISTEDGMIZ KADAR FARKLI TEMALAR ICERISINE ENTEGRE EDIP KULLANABILIRIZ...
BUNUN BIR BENZER I DE SUDUR DAHA FAZLASINI GOSTER YUKARDA OLUR 30 DAN 26 E DOGRU DEGIL DE 24 DEN 30 A DOGRU GELIR VE YUKARDA DAHA FAZLASINI GOSTER DEYINCE YUKARI DOGRU GELIR..DATALAR YANI 21 DEN 25 E SEKLINDE YUKARDAN ASGAI DOGRU GOSTEREREK GELIR..MESELA
     -->
    <ul id="list">
        <?php foreach($data as $value):
      /*     <li data-id="<?= $value["id"] ?>"><?=$value["value"] ?></li> 
            <!--yukardaki kullanim <?php //echo $value["value"] ?>  kullanim ayni seydir-->*/
           require("comment.php"); 
            
        endforeach;?>

    </ul>
    <button id="show-more">Show More</button>
</body>
</html>