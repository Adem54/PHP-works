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
formatlanm???? string ????kt??s?? verir.
??al????t??r??ld??????nda string ????kt??s??n??n uzunlu??unu d??nd??r??r.
$number = 5;
$str = "London";
$x = printf("There are %u million people in %s. <br>",$number,$str);
echo $x;
????kt??: There are 5 million people in London.
C??kt??: 42

sprintf:
formatlanm???? string de??erini d??nd??r??r.
$number = 5;
$str = "London";
$x = sprintf("There are %u million people in %s. <br>",$number,$str);
echo $x;
????kt??: There are 5 million people in London.

E??er argumanlar(parametreler) birden fazla yerde kullan??lacaksa \$ ifadesi kullan??l??r.

$number = 5;
$str = "London";
$x = sprintf("There are %1\$u million people in %s. <br> Second usage place: %1\$u",$number,$str);
echo $x;
????kt??: There are 5 million people in 5.
	     Second usage place: 5

         vprintf:
formatl?? string de??erini ekrana bast??r??r.
printf gibi davran??r yaln??z parametre olarak de??i??kenler yerine dizi al??r.
Formatlanm???? stringin uzunlu??unu geri d??nd??r??r.

$number = 5;
$str = "London";
$x = vprintf("There are %u million people in %s. <br>", [$number,$str]);
echo $x;
????kt??: There are 5 million people in London.
????kt??: 42

vsprintf:
formatlanm???? string de??erini d??nd??r??r.
sprintf gibi davran??r yaln??z parametre olarak de??i??kenler yerine dizi al??r.
$number = 5;
$str = "London";
$x = vsprintf("There are %u million people in %s. <br>", [$number,$str]);
echo $x;
????kt??: There are 5 million people in London.

vfprintf:
formatlanm???? bir stringi bir dosyaya yazar.

$number = 5;
$str = "London";
$file = fopen("test.txt","w");
vfprintf("There are %u million people in %s. <br>", [$number,$str]);

test.txt dosyas??na There are 5 million people in London. ifadesini yazar

FORMAT DE??ERLER?? ??????N KULLANAB??LECE????N??Z DE??ERLER
%% ??? Y??zde i??areti d??nd??r??r
%b ??? ??kili say??
%c ??? ASCII de??erine g??re karakter
%d ??? ????aretli ondal??k say?? (negatif, pozitif veya s??f??r)
%e ??? K??????k harf olarak bilimsel g??sterim (e.g. 1.2e+2
%E ??? B??y??k harf olarak bilimsel g??sterim (e.g. 1.2E+2)
%u ??? ????aretsiz ondal??k say?? (s??f??ra e??it veya daha b??y??k)
%f ??? Ondal??kl?? say?? (yerel ayarlara duyarl??)
%F ??? Ondal??kl?? say?? (yerel ayarlara duyarl?? de??il)
%g ??? %e ve %f ???nin daha k??sas??
%G ??? of %E ve %f ??? nin daha k??sas??
%o ??? Octal say??%s ??? String
%x ??? Hexadecimal say?? (K??????k Harfler ile)
%X ??? Hexadecimal say?? (B??y??k Harfler ile)
*/

?>