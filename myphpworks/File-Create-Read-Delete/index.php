<?php 
//Create file 
//touch() ile dosya olusturaiblirz php de
touch("test.txt",time()- 84000);//bu tarih 
//Bize test.txt isminde bir dosya olusturuyor
//2.parametre olarak time verebiliriz, time demek olusturulma tarihini ayarlayabiliyoruz ve
//dosya ustune gittigmiz zaamn getinfo dersek bize olusturma tarihini burdaki tarihe gore vereek

//fopen();Dosya acmak icin kullaniriz
//fclose();Dosya kapatmak icin kullaniriz
//fwrite(); dosya iciine yazmak icin kullaniriz
//fread(); dosya okumak icin kullaniriz
//fgets(); satir satir dosyayi okur
//feof(); Dosyanin sonuna gelinip gelinmedigini dondurur
//filesize($dosya) dosyanin karakter sayisini bulabilirz
//unlink() ile biz bir dosyayi silebiliriz 


/*fopen in 2.paramtresi kipler
r-okumak icin ac
r+-okumak ve yazmak icin ac(dosya yok ise olusturmaz)
w-yazmak icin ac(dosya yok ise olusturulur varsa ustune yazar)
w+-okumak ve yazmak icin ac
a-yazmak icin acip dosyanin sonuna ekliyor-append
a+-okuak ve yazmak icin ac


*/
//dosyamiz bos olduug icin okumak icin acamaiyoruz
//$my_file=fopen("test.txt","w");//Bundan once icerik yazilmis ise onu siler yerine bu yazdimigzi yazar
//bu arda direk a ile baslarsak sorun alabiliriz ondan dolayi okumak ve y azmak icin ac deeriz dosyayi eger dosyayi yazdiktan sonra okuyacaksak
//Ama gider dosyyi sadece yazmak icin acip sonra okumaya calisirsak hata aliriz dogal olarak
$content="\nThis is my new content".rand(0,1000). "\n";
$my_file=fopen("test.txt","a+");//Bundan once yazilmis icerik var ise simdi yazacagimizi onun sonuna ekle demis oluruz
//simdi write yapalim
//Dikkat edelim dosya acma kipi ile hangi doysyay ne islemi yapacagimzi belirtiriz ardinda da doys methodlarini kullnarak yapacagimz islemi yapariz ve en son islem bitince de dosyayi kapatiriz.

//Biz eger fwrite ile yazma islemmi yapiyorsak once onu bitiririz ardinda tekrar okumak icin okuma methodlarini kullaniriz islemleri gerceklestirebilmeki icin yani dosyaya hem yazma hem okuma komutu verirsek dosya da sasiriyor ne yapacagini
//fwrite($my_file,$content);
$my_file=fopen("test.txt","a+");//Bundan once yazilmis icerik var ise simdi yazacagimizi onun sonuna ekle demis oluruz

//echo fread($my_file,filesize("test.txt"));
//Dosya karakter saysini filesize ile bulabiliriz

//Simdi de fgets ile okuyalim
//fgets satir satir okuyor
//  echo fgets($my_file)."</br>";
//  echo fgets($my_file)."</br>";
//  echo fgets($my_file)."</br>";
//  echo fgets($my_file)."</br>";
//  echo fgets($my_file)."</br>";
//  echo fgets($my_file)."</br>";
//  echo fgets($my_file)."</br>";
//  echo fgets($my_file)."</br>";
//  echo fgets($my_file)."</br>";
//  echo fgets($my_file)."</br>";
//  echo fgets($my_file)."</br>";
//  echo fgets($my_file)."</br>";
//  echo fgets($my_file)."</br>";
//  echo fgets($my_file)."</br>";

//while dongusu kullanmaya cok harika bir ornek bestpractise...
//Biz sonunun ne zaman gelecegini bilmedgimiz donguler icin while dongusu kullaniriz
//Ozellikle de sonsuz bir while dongusu baslatariz ve ne zamanki dosya sonuna gelinmis o zaman while dongusunden cikariz
//BESTPRATISE...BU COK ISIMIZE YARAYACAK.....
// while(true){
//     if(!feof($my_file)){
//      echo fgets($my_file)."</br>";

//     }else{
//         break;
//     }
// }

 //Biz satir satir okundugunda dosya sonun gelip gelmedgimizi kontrol etmek icn feof kullaniriz
// $res=feof($my_file);
// if($res){
// echo "Dosya sonuna gelindi";
// }else{
// echo "Dosya sonuna gelinmedi";
// }


fclose($my_file);//dosya islemimiz bitince kapatmamiz gerekir
//test.txt icerisine yaziyi yaziyor simdi biz gidip ornegin content icerigini degistiri ve w ile yazarsak
//gidip bir onceki icerik yerine yeni yazdimgz icerigi yazar ancak biz eger bir onceki yazdigmz kalsin
//ve devamina yazalim dersek o zaman a ile  yazariz ve sonrasina ekle demis olur a-append demektir ekle dmektir
//Bir dosyayi tamamen okumak istiyoruz

//Dosyayi silmek icin de unlink() kullaniriz
//unlink("test2.txt");//test2.txt dosyasini siler
//Silinmis dosya bir daha silinmeye calisilirsa hata verecektir


//BU COOK ONEMLI COK KULLANABILIRIZ-DOSYA ICERIGININ TAMAMINI DIZI ICERIGINE ATARAK VERMEK
$values=file("test.txt");//Bir dosya iceriginin her satirini bir eleman olarak kabul edecek sekilde
//dizi iceriisne yazar ve bize dondurur
//file_get_content
//print_r($values);
//ICERIGIN TAMAMINI STRING OLARAK ALMAK
$my_content=file_get_contents("test.txt");
echo ($my_content);//Bu sekilde icerigini tamamina strin olarak da erisebiliriz


//file_get_contents bir sitenin kaynak kodunu almamizi da saglayabiliyor
//$_content=file_get_contents("https://www.erbilen.net/");
//Dikkat edelim baskasinin sitesinin kaynak kodlarini aliyor, bot yapiminda cok kullanilyor bu mantikta

//echo($_content);

//file_put_contents ile de icerige yeni birseyler ekleniyor ama burda override edecek uzerine yazacak
//ama 3.parametre de file_append dersek ardina ekler,, ustune yazmak yerine
file_put_contents("test.txt","this is new value",FILE_APPEND);

//Bir dosya veya dizinin var olup olmadigini nasil kontrol ederiz?
//Cunku bir dosyanin var olup olmadgini bilemden silmeye calisirask hata aliriz ondan dolayi dosyanin var olup olmadgini cek etmemiz gerekir oncelikle
//PHP kullanirken ozellikle, nereye dikkat edecegiz...ozellikle biz hata almamak icin hata alinabilecek durumlar iyi bilip onlara onlem olarak
//surekli isset ile yani bir degiskenin var olup olmadig exist ile bir fonksihyonun var olup olmadigi 
//file_exist() ile de dosya var mi onu cek ederiz
echo "</br>";
$check_is_file_exist= file_exists("test2.txt");
if($check_is_file_exist):echo "Dosya var oldugu icin silinecek"; unlink("test2.txt");
else : echo "Dosya var olmadigi icin silemeyiz";
endif;
//BU KULLANIM PHP DE BIZIM ICIN COK ONEMLI BIR MANTIK VE ANLAYIS OLMALIDIR...CUNKU BIZ HATALARI YONETMEMIZ GEREKIYOR
//BUNUN ICINDE ISSET,EXIST,FILE_EXIST GIBI VARIABLE,FUNCTION,FILE VARLIGINI SORGULAYAN METHODLARI COK SIK KULLANACAGIZ...

//CHMOD AYARLARINNIN YAPILMASI-DOSYA IZINLERININ AYARLANMASI
/* 
 chmod()
1-Numara 0 ile baslar
2-2.numara dosya sahibi izinlerini temsil eder
3-3-numara kullanici gruplari izinleri
4-4.numara geri kalan herkesin
Ve burda numaralarin 7 ye kadar olmasinin da bir sebebi var
1=execute(islem) izni sagliyor
2-yazma izni
4-okuma izni
*Bu ucunun toplami 7
Eger 2.numara da 7 var ise 2.numara dosya sahibi izinleri idi, dosya sahibine 
tum izinler verilmis demekir eger 2.numara 7 ise
3.numara da 7 var ise kullanici gruplarina tum izinler verilmis demektir(7 olunca uzerinde islem yapabiliyor, yazabiliyor ve okyabiliyor demek)
7 ise demekki 1(execute-islem izni)+2(yazma izni)+4(okuma izni) =7(tum izinler ok demek)
5 olsa idi o zaman 1 ve 4 izni alinmis demektir o da 1-execute(islem izni) ve 4-okuma izni var demektir

Ornegin biz dosya sahibine tum izinleri vermek istiyoruz ama onun disindakilere sadece dosyayi okuma izni vermek istiyoruz
*/
//chmod("test.txt",0764);
//Dosya sahibine tum izinleri(1+2+4) verdik onun disindaki kullanici gruplarina  okuma ve yazma izni(2+4) verdik ve onun disindaki herkes e de
//sadece okuma izni vermis olduk(4)
//Sayfamizi calistirdiktan sonra dosyamiza gidip saga tiklayip egenskaper-properties den izinleri inceleyebilirz
chmod("test.txt",0740);
//Guvenlik aciklari olusmamasi icin dosya islemlerinde chmod ile izinleri ayarlammiz gerekir
//Bu sadece php de fonksiyon ile yapilacak diye bir kural yok direk dosya uzerinden veya ftp dosya ayarlarindan da bu islemleri yapabiliyoruz



?>