<?php 

//date->UNIX VE UNIX->date tarih formati degisimleri
# str to time
//string olarak bir time formati , string olark tarih formati aliyor parametre olarak

echo strtotime("now");//Bu bize time() fonksiyonu ile ayni seyi veriyor su anki timestamp i veriyor
//1668110252

//Gecmisteki bir tarihin direk timestamp olarak almak istersek o zaman 
//strtotime i kullanabilirz

//normalde time() icin de bulundugmuz su zamanini timestamp ini veriyor ve biz ornegin
//belli bir zaman oncesini bullmak istersek veya sonrasini ornegin kac gun sonrasi veya
//kac gun oncesi ise onu 1 gnluk saniye ile carpip buluyoruz 

//Ancak direk gecmisten bir tarih formatini kullanarak timestamp i almak istersek o zaman
//strtotime bize cok yardim ediyor

echo "<br>";
echo strtotime("2020-10-15 15:10:10");//1602767410 
//Gecmisteki bu tarihi bu timestamp e denk geliyor


//simdi bize date fonksiyonu ve getdate fonksiyonuna parametre olarak timestamp aliyorlardi
//ve onlarda bize timestampi verilen dato yu veriyordu....

//strtotime da gecmisten tarih formatinda verilen formatin timestampini veriyor
echo "<hr>"."date1: ";
$date1=strtotime("2020-10-15 15:10:10");
echo date("y-m-d H:m:s",$date1);// 20-10-15 15:10:10
//date methodunda icerisine verilen timestamp in hangi tarihe denk geldigni buluyor...


//strtotime ise icine verilen string tarihin hangi timestampe denk geldigini buluyor

//Su anki zamanda 4 gun sonraki tarihi almak istersek nasil aliriz hemen ona bakalim...

$four_days_after=time() + 4*(60*60*24);
echo "<hr>"."four_days_after: ";

echo date("y-m-d",$four_days_after);// 22-11-14

//Ayni ise strtotime() ile yapacak olursak
//timestamp formatinda 3 gun sonrayi getirecek
//1668456860
echo "<br>  fourdaysAfterwith strtotime: ".strtotime("+4 day",time());


echo   "<br>  date method: ".date("y-m-d h:m:s",1668456860);//22-11-14 09:11:20

//strtotime-adi ustunde string olarak verilen tarih formatin i ozellikkle gecmis veya gelecek
//bize timestamp olarak veriyor ve biz de onu date ile hangi tarihe denk geldgin bulabiliyoruz

//Ayrica ileriki ve gerideki tarihleri yine timestamp olarak alirken time() isleminde yaptigmz gibi
//gun sayisi ile saniye sayisini carpma gibi bir isleme gerek duymadan daha kolay bir sekilde 
//ilerdeki veya gerideki gun sayini bulabiliyoruz..Yukarda yaptgimz gibi
//Hatta day,week ifadelerini kullanark istedgimiz kadar gun sonrasi veya oncesi
//2,3 hafta oncesi veya sonrasini da bulabiliyoruz..ve time() fonksiyonu kullanmadan da alabildik timestamp formatinda
echo "<hr>";
$res1= strtotime("+1 week 2 days 4 hours 2 seconds");
echo "result_: ",date("y-m-d h:m:s",$res1);//22-11-20 01:11:37
//ayrica last monday, next Thursday gibi ifadeler de kullanarak gelecekteki veya gecmisteki tarihleri
//daha kolay birsekilde alabiliyoruz


//Gecmisten bir gunu baz alarak next Saturdayini almak istersek yani ornegin 2 gun oncesine gore
//next Saturday i almak istersek eger nasil yapariz ona bakalim

$unix2=time()- 2*(60*60*24);
$unix=strtotime("next Saturday", $unix2);//$unix2 ye gore next Saturday demektir bu ama 2.parametre olmadan yani $unix2 parametresi olmadan
// direk nex Saturday yazarsak o zaman direk su an icinde bulundugmuz ana gore next SAturday i hesaplar
//Sonucu bize tabi ki timestamp olarak veriyor biz hangi tarihe denk geldgin gormek iicn date() fonksiyonunu kullaniriz
echo "<br>".date("Y-m-d H:m:s",$unix);//Bu 2 gun oncesine gore nexSaturday bugun persembe oldugu icin bugunden yazidgimiz zaman ile ayni cumartesi
//tarihini veriyor

//Ana matnik olarak ister icinde bulundugumz tarihten ister de gecmisten veya gelecekten bir tarihten belli bir zaman sonrasai veya oncesini
//bulmak istersek strtotime ile timestamp olarak bunu alarak sonra da date fonksiyonunu ile bunun tarih formatinda karsiligini alabiliriz
echo "<br>".strtotime("+1 week");
echo "<br>".strtotime("+1 week");
echo "<br>".strtotime("+1 month");
echo "<br>".strtotime("+1 year");

//Ayrica gecmisteki veya gelecekteki belirli gun ve tarihlerin de timestamp formatini alabiliriz strtotime i kullanarak

$date5=strtotime("2020-10-15 15:10:10");

$unix3=strtotime("+1 year 1 month -2year");//1 yil 1 ay ileri git 2  yil geri git ve onun karsiligi olan timestamp i bana ver diyoruz burda
//VE istersek de bunun hangi tarihe denk geldigni yine date() fonksiyonu ile alabiliriz
$unix4=strtotime("+10 minute");//icinde bulunduzmu zamanini 10 dakika sonrasni alabilirz bu sekilde
//Cok fonksiyonlu islevler yapabiliyoruz


?>