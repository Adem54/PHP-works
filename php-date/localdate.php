<?php 

# setlocale 2 parametre alior lC_time
setlocale(LC_TIME,'no_NB');//Saatimizi ve zamanimiz artik norvecceye gore ayarlamis olduk

//Tarihi norvecceye gore kullanirken de yine kullanacagimz bir fonksiyon var

# 10 november 2022, torsdag  yazdirmak istersek nasil yazdiracagiz
//%d gun getiriyorduk, 2 haneli olarak
echo strftime("%d %B %Y,%A");//10 November 2022,Thursday
//iste norvec formatinda bu sekilde alabiliyoruz tarihi
//Bunlar cok fazla isimize yarayacak

//Peki 2 gun oncesini nasil norvecceye gore ayaralariz
echo "<hr>";
echo strftime("%d %B %Y,%A", strtotime('-2 day'));//08 November 2022,Tuesday
//1 hafta sonrasi
echo "<hr>";
echo strftime("%d %B %Y,%A", strtotime('+1 week'));//17 November 2022,Thursday
//2.parametreye dikkat edelim unix zaman damgasi formati yani timestamp formatinda vermemmiz gerekiyor
//Yani saniye cinsinden veriyoruz timestamp yani saniye cinsinden veriyoruz....
//1 ocak 1970 unix formatinin baslangicidir, yani timestamp in formatidir

//Peki biz saati de almak istersek nasil aliriz
echo "<hr>"." Saat ile birlikte alacak olursak  <br>";
echo strftime("%d %B %Y,%A - %T");//10 November 2022,Thursday - 22:21:53
//Bunun saat olarak bizim saatimize uygun bir sekilde geldi, on tanimli zaman dilimiz bu zaman dilimi ile ayni imis ki biz sorunyasamadik
//default time zone a gore
//default time zone umuz ne imis onu kontrol edelim

echo "<br>";
echo date_default_timezone_get();//Europe/Berlin i kullaniyor musuz biz


//Timezonumuzu Norve ce gore ayarlamak, asagidaki gibi timezonumuzu norvece gore ayarlayabiliriz
//Europe/Oslo' => 'Norway',
echo "<br>";

$timeZone="Europe/Oslo";
date_default_timezone_set($timeZone);//Time zonumuzu bulundugumuz ulkeye gore bu sekilde ayarlayabiliyoruz
//Su an biz hangi timezonu kullandimgizi da asagidaki fonksiyon ile gorebiliiyoruz
echo date_default_timezone_get();//Europe/Oslo artik Oslo ya gore kullaniyoruz zaman dilimimizi
echo "<br>";
//Artik time zonumuz Oslo ya gore ayarlandi ve tam olarak Norvec e uygun olan bir date formatini kullaniyoruz
echo strftime("%d %B %Y,%A - %T");//10 November 2022,Thursday - 22:27:54
?>