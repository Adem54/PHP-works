<?php 
function seflink($str){ 
    //ilk once stringimizin karakterlerinin kuculturuz
   // $str=strtolower($str);//bu islem inglizce de olmayan norvecce å,ø gibi karakterleri kucultmuyor 
    //ondan dolayi bu islemi biraz farkli yapacagiz
    $str=mb_strtolower($str,"UTF-8");//Bu sekilde artik Å karakterini de kucultmus olduk
    //mb_strtolower fonksiyon her sunucu da calismayabiliyor ondan dolayi bunlari acip replace ile belirtmemiz gerekiyor
    //ki tum yabanci karakterlerden arindirmis olacagiz
    //str_replace ile biz mesela ozel karakterleri de ornegin ? karsiliklarini istedgmiz birseye cevirebiliriz mesela ?  karsina norvecde 
    //spørsmåltegn yazarsak o artik ? gordugu yere spørmåltegn olarak getirecektri bize......Mesela C# yaziminda # karakterini sharp ismi ile de dondurebiliyoruz....bunlar harika mukemmel isler..cok harika isler cikarabiliriz bunlar la
    $str=str_replace(
        ["æ","ø","å"],
        ["e","o","a"],
        $str
    );
    //Biraz da regex yazacagiz burda
    //normal karakterler ve sayilar haric herseyi - tire isaretine dondur diyecegiz
    //^ haric demektir bu
    $str=preg_replace('/[^a-z0-9]/','-',$str);//a dan z ye kadar olan karakterler ve 0 dan 9 a kadar olan sayilar haric - tire isaretine dondur, nerde $str ifadesinde  demktir bu ve bu sonucu aliriz sonunda hvordan-gar-det-2022-for-meg
    //Burda bir problemimiz daha var, regexin verdigi sartlara uymayan karakterleri - tire ye ceviriyor ama her bir uymgyaan icin bir tire yapiyor
    //o zamaan yanyana tireler geliyor bu da seo linki icin iyi birsey degil onu da , yani bir den fazla tire - islemini de tek bir tireye cevirecegiz..
    //Dikkat edelim buralarda biz desenler yaziyoruz ve o artik bizim stringimzi o desene uyduruyor ve muthis efektif isler yapabiliyoruz
    $str=preg_replace('/-+/','-',$str);//Birden fazla tire- m var ise bunu tek bir tireye donustur
//Bizim burda $str="%%%%%%%Hvordan GÅR det 2022 for&&&&&&&&&&&&&&&&&&&& meg????????????????"; bu sekilde yazdgimz yazi ekran da artik asagidaki gibi cikacaktir
    //-hvordan-gar-det-2022-for-meg-
//Problem su ki basta ve sonda da tire var bunlari da kaldirmamzi gerekecek
//trim fonksiyonu ile biz normalde bosluklari kaldiririz ama 2. bir paramtre verir orda da ozel bir karakter verirsek -tire isaret i gibi
//o zaman o verdgimz karakteri kaldirir
//$str yi return ederken de trim ile return edecegiz
//return trim($str,"-"); ve nihayet sagda ve solda da herhangi bir - tire isareti kalmamis oldu
//hvordan-gar-det-2022-for-meg link yapimizi hazir hale getirmis olduk...

    //BU DA BENIM COK BILMEDIGIM ALANLARDAN BIR TANESI VE BUNU DA OGRENEREK CIDDI BIR GELISIM KATEDILEBILIR ADVANCE SEVIYELERE DOGRU
//REGEX LER YOLU ILE HARIKA ILERI SEVIYE ISLEMLER YAPABILIYORUZ....OZELLIKLE VALIDATION LARDA DA COK ISMIZE YARIYOR HARIKA ISSLER CIKARABILRIZ REGEXLER  YOLU ILE.....BESTPRACTISE...

    
    return trim($str,"-");
}

$str="%%%%Hvordan GÅR det 2022 for&&&&&&&&&&&&&&&&&&&& meg????????????????";
echo seflink($str);
?>


<!--
SEF-search engine friendly links
Arama motoru dostu linkler

//Link yapisi ornegin turkce karakterlerden aridindirilmis,vaya ingilizce olmayan karakterlerden arindirilmis, kelimler arasi bosluklar
//a - konulmus
//mesela link te 
https://www.erbilen.net/benim-icin-2017-nasil-gecti/
id vermek yerine bir title i link yapmis isek bunu seo daha cok seviyor ve bize arti katiyor 
Iste bizim amacizmi direk id vermek yerine seo-dostu linkler le linkelrimizin daha hizli indexlenmesi ve daha ust siralrada olmasini
saglayabiliriz ..php yardimi ile
Bunlari elle manuel yapmaycagiz tabi ki

 -->
