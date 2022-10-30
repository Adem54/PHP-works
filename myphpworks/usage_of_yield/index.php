<?php
//BIZ BYTE OLARAK GELEN MEMORY KULLANIM SONUCUNU MB A CEVIREBILIRIZ
//KUSURATLARDA SORUN YASAMAMAK ICIN DE NUMBERFORMAT FONIKSYONU KULLANIRIZ
//Ya da round fonksiyonu ile de kac tane kusurati gozukmmesnin istgersek onu da gosterebiliriz
function byteToMb($byte){
    //return number_format($byte/1048576);
    return round($byte/1048576,4);
}
//range hazir fonksiyonu ile istedgimiz sayilar arasinda ardisik sayilar yazdiririz
//range(0,1000);//0-1000 arasi sayilari yazdiriyoruz...

function generateNumbers($start, $limit){
    $arr=[];//Dizi olusturuyoruz
    for ($i=$start; $i <$limit ; $i++) { 
        # code...
       $arr[]=$i;//Burda dizi icine biz i elemntini ekliyoruz...
    }

    return $arr;
}

//range fonksiyonunun aynisini yazmis olduk burda, kendi fonksiyonumuzu yazdik
$res=generateNumbers(0,10000);
//print_r($res);
echo "</br></br>". byteToMb(memory_get_usage()). " BYTE MEMORY USED  </br></br>";//367712 BYTE MEMORY USED

//BESTPRACTISE...BOS BIR DIZI OLUSTURUP FOREACH ILE DONGU DONERKEN DONEN HER ELEMENTI BOS DIZIMIZ ICINE ATMA ISLEMINI
//NASIL YAPTIGMIZI IYI ANLAYALIM COK KULLLANACAGIMZ BIR YAPI BU....
//$arr=[];   $arr[]=$i; diyerek biz o dizi icine son elemanina eklemis oluyoruz
echo "</br>"."................................................."."</br>";

//ISTE ARRAY ICINE ELEMENTLERI BU SEKILDE EKLERIZ...SIRASI ILE, YANI HER EKLEDIGMIZ EN SONUNCU ELEMENT OLARAK EKLENIYOR
$myArr=[];
$myArr[]=12;
$myArr[]="Adem";
$myArr[]=true;
echo "<span>count of array: </span>".count($myArr). "</br>";
print_r($myArr);
echo "</br>"."................................................."."</br>";

//Yield kullanarak bunu nasil yapariz ona bakalim
//Yield kullaninca return kullanmiyoruz, direk yield kullaniyourz return yerine
//yield returne cok benziyor, farki degeri dondururken islemi sonlandirmiyor, islemi devam ettiriyor
//Buyuk olcekli islemlerde ciddi performans artisi gosteriyor ornegin bizim 1 den 10.000 e kadar olan sayilarin
//her birisini bir prosessden bir callback, anonim veya normal fonskiyon icinde islemden gecirdigmizi farzedlim 
//iste bunu yield ile kullanmak ile return ile kullanmak arasinda ciddi bir performans farki vardir...Bunu iyi bilelim...
//Coook onemlidiir
//Yield kullandigmiz da deger uretmis oluyyoruz icinde yield kullandigmiz fonksiyonlara, generater deniyor
//Yield kullandigmiz icin dizi de kullanmiyoruz asagida dikkat edelim
//yield deyip neyi geriye dondureceksem veya neyi genere yani ureteceksem onu yield ediyorum...

function generateNumber($start,$limit){
   // $arr=[];
    for ($i=$start; $i<=$limit  ; $i++) { 
        # code...
     //   $arr[]=$i;
     yield $i;
    }
//return $arr;
}

//yield ile dondurudugmuz datayi yield data urettigi icin, array gibi print_r ile donduregbiliriz
//ancak yield da biz return yapmaigmiz icin fonksiyonu baska bir degiskene aktarirken, editor altini cizerek vs bizi uyaracak 
//biz return etmedigmiz biz fonskyonu baska bir degera aktaramyiz diye, yield kullandigmiz zaman ama bu problem degil normalde...
//Yield degeri dondururken islemi sonlandirmiyoruz, deger uretmis olyoruz ve cok ciddi bir performans artisi sagliyourz
//Yield icindeki degerleri yazdirmak icin de yine for dongusu kullaniriz
//$myRes=generateNumber(0,1000);
// generateNumber(0,1000);
//print_r($myRes);
//print_r(generateNumber(0,1000));

foreach (generateNumber(0,10000) as  $value) {
    # code...
       // echo "<span>$value</span>";

}

//Peki bizim range ile veya kendimz in for dongusu kullanarak 0 dan 1 milyon a kadar sayilari dizi icine atacak fonksiyonu yazdik veya olusturduk
//Ayni islemi de gittik yield kullanarak 0 dan 1 milyona kadar sayi urettik
//Peki farklari ne?
//Bunlarin performansa nasil bir etkisi oldugnu gormek istersek ne kadar bellek kullandigini byte cinsinden gorebilecegimiz bir 
//buildin fonksiyon mevuttur..memory_get_usage() isminde

echo "</br></br>". byteToMb(memory_get_usage()). " BYTE MEMORY USED";//DIREK BU SEKILDE BIR ISLEM YAPIP HEMEN ARDINDAN BU SATIRI YAZDIRARAK O YAPILAN ISLEMIN NE KADAR
//BELLEK KULLANDIGNI GOREBILIRZI
//367712 BYTE MEMORY USED

//BIR ONCEKI NORMAL FOR ILE VEYA RANGE ILE BU ISLEMI YAPTIGMZ ZAMAN KI BELLEK KULLANIMI 367672
//DAHA SONRA YIELD KULANINCA BELLEK KULLANIMINA GELEN EKSTRA  YUK ISE 368160 BU KADAR YANI ARADAKI FARK ACAYIP BIR UCURUM

//BIZ BYTE OLARAK GELEN MEMORY KULLANIM SONUCUNU MB A CEVIREBILIRIZ
// function byteToMb($byte){
//     return ($byte/1048576);
// }

//BU KULLANIMLARA COK DIKKAT EDELIM...BIZ PERROFMANS TAKIBINI BU SEKILDE YAPABILIRIZ BU BIZE 
//COK EFFEKTIF BIR SEKILDE PERFORMANSI TAKIP EDEBILME OZELLIGI KAZANDIRIR....

//10 milyon satirlik dosyamiz var mesela ve bu satirlari php de okuyacagiz ve her satiri bir diziye aktarip geriye
//dondurerek islem yaparsak, eger cok iyi bir sunucumuz yok ise bellek yetersiz hatasi alarak ciddi bir performans kaybi
//yasayabiliriz...Ancak bu islemi yield ile yaptigmiz zaman cok performans kaybi yasamadan islemimizi yukardaki gib  yapabirliz
//Ne zaman, biz cok buyuk data larla uzun islemler yaparsak o zaaman aklimiza yield gelmelidir

?>