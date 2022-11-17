<?php 

echo "DateTime class";
//Tum tarih ve zaman islerimizi DateTime class i ile cok daha kolay bir sekilde yapabiliyoruz
//DateTime sinifi altinda tanimli gelen bazi methodlar var ve biz bu mehtodlari kullanarak bircok islem yapabiliyoruz

$date=new DateTime();//Burda biz DateTime class indan bir instance olusturduk ve artik methodlari kullanabilirz

# format methodu-date("Y-m-d H:i:s") seklinde yaziyorduk iste formatta da bunu yapacagiz
echo $date->format("Y-m-d H:m:s")."<br>";
//su an ki zamani alabilirz
//2022-11-10 22:11:59  
//4 gun sonrasinin zamaninin almak istersek ne yapariz
$date2=new DateTime("+4 day");
echo $date2->format("Y-m-d H:i:s")."<br>";
//2022-11-14 22:11:50

//4 gun sonrasinin unix formatini almak istersk
$date3=new DateTime("+4 day");
echo $date3->getTimestamp()."<br>";
//1668461937

//unix formatinda verdigmz tarihi de yine normal tarih formatinda dondurebliriz
$date4=new DateTime();
$date4->setTimestamp(time());//2022-11-10 22:41:59
echo $date4->format("Y-m-d H:i:s")."<br>";
//i :Minutes with leading zeros
//dikkat edelim...minute yerine i kullanmamiz gerekiyor

//2 gun sonrasinin formatini yine DateTime class ina ait modify methodu ile bulabiliriz

$date5=new DateTime();
$date5->modify("+2 days");
echo $date5->format("Y-m-d H:i:s")."<br>";//2022-11-12 22:46:36

//Ayrica unix format-timestamp olarak elimizde olan bir tarihin de 2 gun sonrasni yazdirabiliriz
//Timestamp olarak ornegin 5 gun sonrasinin timestampini setTimestamp methjoduna parametre olarak verdik ve 
//bu verdigmiz tarihinde 2 gun sonrasini almak istedik ve asagdaki sekilde aldik
$date5->setTimestamp(time()+ 5*(60*60*24));
$date5->modify("+2 day");
echo $date5->format("Y-m-d H:i:s")."<br>";//2022-11-17 22:49:36

//timezone da belirtebiliyoruz
//setTimeZone ile yazabiliyoruz

$date6=new DateTime();
$timeZone="Europe/Oslo";
$date6->setTimezone(new DateTimezone("Europe/Oslo"));

echo $date6->format("Y-m-d H:i:s")."<br>";//2022-11-10 23:02:24

//Ayni zamanda DateTime dan instance olustururken, constructor a parametre olarak da timezone verebiliyoruz
$date7=new DateTime("now",new DateTimeZone("Europe/Oslo"));//diye de baslatabiliriz


//Iki tarih arasindaki farklari nasil bulaibliriz

$date11=new DateTime("2020-05-14");
$date12=new DateTime("2021-10-18");

$find_differenece=$date11->diff($date12);//bize bir obje dondurecek

echo "<br>";
//print_r($find_differenece);
//Bu arada bu bize bir obje donduruyor dolayisi ile icindeki elemntleri propertileri biz -> bu sekilde alacgiz
echo "<br>".$find_differenece->y;//year fark-1
echo "<br>";
echo "<br>".$find_differenece->m;//month farki -5
echo "<br>";
echo "<br>".$find_differenece->d;//day farkli-4
echo "<br>";
//seklinde almanin yaninda bir de farklari bir kere de format methodu ile de alabiliriz
echo $find_differenece->format("%y år %m måned %d dag %h time %i minut %s sekund");
//1 år 5 måned 4 dag 0 time 0 minut 0 sekund bu sekilde de alabiliriz
echo    "<br>";
//Bu sekilde yine icinde bulundugmuz timezonunu gorerek bu timezonunu Norvec osloya gore ayarlayabilyoruz
echo date_default_timezone_get();
echo date_default_timezone_set("Europe/Oslo");
echo    "<br>";

echo date_default_timezone_get();

//Ama biz zaten DateTime ile eger spesifik bir tarihe ait bilgileir kendi icinde bulundgumz timezona a gore almak istersek ne yapiyuoruz
$date13=new DateTime("1988-07-04 14:23:43", new DateTimeZone("Europe/Oslo"));
$date14=new DateTime();//HIcbirsey yazmassak icinde bulundugmuz tarihi verir

$differ=$date13->diff($date14);
echo "<br>";
echo $differ->format("%y %m %d %H %i %s");
//Bu sekilde dogum tarihinden kac yasinda oldugunu bulabiliriz

//ayni yil icinde tarih farklarini alirken de yil 0 falan gelebiliyor onnu nasil hallederiz

$date15=new DateTime("2022-09-13 15:23:43", new DateTimeZone("Europe/Oslo"));
$date16=new DateTime();

$my_diff=$date15->diff($date16);
echo "<br>";
echo $my_diff->format("%y %m %d %H %i %s");//0 1 28 08 3 45
//Burda gelen sonucun 0 in gelmemesi icin nasil yapariz str replace fonksiyonu ile bunu halledebilirz
$my_date= $my_diff->format("%y year %m month %d day %H hour %i minute %s second");//0 1 28 08 3 45
$my_date=str_replace(
    ["0 year"],
    "",//hicbirsey yazmasin yerine silsin diye boyle birakiriz
    $my_date
);
echo "<br>";
echo "published ".$my_date. " before";//1 28 08 6 52




/*
Iki tarih arasindaki farklari bu sekilde alabiliyoruz
{
y: "1",
m: "5",
d: "4",
h: "0",
i: "0",
s: "0",
f: "0",
weekday: "0",
weekday_behavior: "0",
first_last_day_of: "0",
invert: "0",
days: "522",
special_type: "0",
special_amount: "0",
have_weekday_relative: "0",
have_special_relative: "0"
}
*/

?>