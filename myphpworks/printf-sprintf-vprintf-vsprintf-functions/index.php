<?php 

/*
printf();

*/
$place="Africa";
$number="5";
$type="monkey";

//echo "There are ".$number. " ". $type . "s  in".$place . ".";
echo "</br>";  


$place2="Afrika";
$number2="5";
$type2="maymun";
//echo $place. " da ". $number2 ." adet  ". $type2." var.";
echo "</br>";  

//Yukardakilerin aynisini printf ile yazalim
//%s %string type i gosteriyor- %d integer, sayi ifade ediyor
printf("There are 5 monkeys in Africa");
echo "</br>";  

//Dikkat edelim dinamik bir sekilde yazdik asagida
printf("%s %d tane %s var","Afrikada", 5, "maymun");
//%s-Afrikada, %d-5, %s-maymun
//Orneginin dil sistemi yaziyoruz ingilizce veya farkli dillerde yazmamiz gerekyor
echo "</br>";  

printf("There are %d %ss in %s", 5,"monkey", "Africa");
//Ekrana echo ile yazdirmaya calismiyoruz cunku kendisi direk ekrana yazdiriyor
echo "</br>";  

printf("There are %d %ss in %s", 5,"monkey", "Africa");

//Demekki biz bunu farkli dillerde yazmamiz gerektiginde kullanabilyoruz

//printf de degerlrimiz i parametre olarak gonderiyoruz, vprintf de de 1 tane parametre gonderip onu dizi olarak gonderiyoruz
//Tarih islemlerimizde de kullanabiliriz
$date="2022-7-6";

//Formatlama islemi de yapabiliyoruz
//Niye %d diyoruz cunku tam sayi oldugu icin %d diyoruz
//Biz ay ve gun u 2 haneli yazmak istiyoruz mesela
//%02d yani 0 dan 2 tane olsun diyoruz
vprintf("%d-%02d-%02d", explode("-",$date));//2022-07-06

echo "</br>";  

$date2="2022-7-16";
vprintf("%d-%02d-%02d", explode("-",$date2));//2022-07-16

echo "</br>";  

$date3="2022-7-26";
//4 haneye kadar kac hane bos ise 0 ile dolduracak ama eger direk 4 haneli bir
//sayi var ise gun kisminda %04d o zaman birsey eklemeyecek zaten 4 haneli oldugu icin
//2022-7-26 olursa 0026 yazar
//2022-7-206 olursa 0206 yazar
//2022-7-2006 olursa 2006 yazar
vprintf("%d-%02d-%04d", explode("-",$date3));
//HARIKA KULLANIM
//BU SEKILDE DIKKKAT EDELIM BIZ DINAMIK BIR SEKILDE FORMATLAMIS OLUYORUZ VE 
//ARTIK ORNEGIN GUN TEK HANELI GELIRSE SOL TARAFINA 0 KOYARKEN CIFT HANELI GELIRSE
//ZATEN HICBIR SEY KOYMAMIS OLACAK VE BIZE TAM ISTEDGIMIZ GIBI BIR DINAMIKLIK SAGALMIS OLACAK...

echo "</br>";
printf("Pi %f tur",3.14);//Pi 3.140000 tur
//f, yani ondalik sayi oldugu icin sonunda kusurat icin sonunda 5 tane 0 getiriyor
//Biz sonundaki 0 larin gelmesini istemiyoruz orngin

echo "</br>";
printf("Pi %.2f tur",3.14);//Pi 3.14 tur
//%.2f diyerek virgulden sonra 2 haneli yaz demis oluyoruz ve yine harika bir formatlama yapmis oluyoruz

echo "</br>";
//Saklamak icin sprintf ya da vsprintf kullaniriz..echo ile yazdirmak yerine return ediyor bunlarda
//sprintf-vsprintf bunlar ekrana direk yazdirmaz return eder
// dolaysi ile vsprintf ve sprintf ile  baska bir degskene aktarip  onda tutabilriz degeri, 
$date4="2022-7-6";
echo vsprintf("%d-%02d-%02d", explode("-",$date4));
//echo($res);
echo "</br>";
$date5="2022-7-6";

echo vsprintf("%d-%02d-%02d", explode("-",$date5));

/*
 printf:
formatlanmış string çıktısı verir.
Çalıştırıldığında string çıktısının uzunluğunu döndürür.
$number = 5;
$str = "London";
$x = printf("There are %u million people in %s. <br>",$number,$str);
echo $x;
Çıktı: There are 5 million people in London.
Cıktı: 42

sprintf:
formatlanmış string değerini döndürür.
$number = 5;
$str = "London";
$x = sprintf("There are %u million people in %s. <br>",$number,$str);
echo $x;
Çıktı: There are 5 million people in London.

Eğer argumanlar(parametreler) birden fazla yerde kullanılacaksa \$ ifadesi kullanılır.

$number = 5;
$str = "London";
$x = sprintf("There are %1\$u million people in %s. <br> Second usage place: %1\$u",$number,$str);
echo $x;
Çıktı: There are 5 million people in 5.
	     Second usage place: 5

         vprintf:
formatlı string değerini ekrana bastırır.
printf gibi davranır yalnız parametre olarak değişkenler yerine dizi alır.
Formatlanmış stringin uzunluğunu geri döndürür.

$number = 5;
$str = "London";
$x = vprintf("There are %u million people in %s. <br>", [$number,$str]);
echo $x;
Çıktı: There are 5 million people in London.
Çıktı: 42

vsprintf:
formatlanmış string değerini döndürür.
sprintf gibi davranır yalnız parametre olarak değişkenler yerine dizi alır.
$number = 5;
$str = "London";
$x = vsprintf("There are %u million people in %s. <br>", [$number,$str]);
echo $x;
Çıktı: There are 5 million people in London.

vfprintf:
formatlanmış bir stringi bir dosyaya yazar.

$number = 5;
$str = "London";
$file = fopen("test.txt","w");
vfprintf("There are %u million people in %s. <br>", [$number,$str]);

test.txt dosyasına There are 5 million people in London. ifadesini yazar

FORMAT DEĞERLERİ İÇİN KULLANABİLECEĞİNİZ DEĞERLER
%% – Yüzde işareti döndürür
%b – İkili sayı
%c – ASCII değerine göre karakter
%d – İşaretli ondalık sayı (negatif, pozitif veya sıfır)
%e – Küçük harf olarak bilimsel gösterim (e.g. 1.2e+2
%E – Büyük harf olarak bilimsel gösterim (e.g. 1.2E+2)
%u – İşaretsiz ondalık sayı (sıfıra eşit veya daha büyük)
%f – Ondalıklı sayı (yerel ayarlara duyarlı)
%F – Ondalıklı sayı (yerel ayarlara duyarlı değil)
%g – %e ve %f ‘nin daha kısası
%G – of %E ve %f ‘ nin daha kısası
%o – Octal sayı%s – String
%x – Hexadecimal sayı (Küçük Harfler ile)
%X – Hexadecimal sayı (Büyük Harfler ile)
*/

?>