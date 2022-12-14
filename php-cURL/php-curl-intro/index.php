<?php 

/*
cURL-client url
veri iletimini ve veri alimini saglayan bir kutuphanedir
Sadece php de degil bir cok farkli dilde de kullanilir
Her dilde kullanimi farkli olsa da temel presip aynidir

Bir web sitesini tipki bir kullanici gibi acabiliiriz
Formlara veri gonderip donen degerleri alabiliriz
Header(ustbilgi) gonderip alabiliriz
Cookie ve Proxy islemlerini yapabiliriz 
Karsi sunucuya dosya yukleme ve dosya indirme islemlerini yapabiliriz 

Bunlarin hepsi ile hedef sitelere bot yazarak kendi sitemize icerik cekebiliriz

cURL Nasil calisir,calisma prensibi

1-cURL oturumu baslatilir
2-cURL ayarlari belirlenir
3-cURL istegi calistirilir
4-cURL sonlandirilir

*/

//1-curl baslatildi
$curl=curl_init();

//2-curl ayarlarinin belirlenmesi
//3 parametre 1-mevcut baslatma oturumu degiskeni,CURL_OPTION_URL,hangi websitesi kaynagi alinacak ise onun adresi)
//Burda bircok setopt kullanabiliyoruz, yapacagimz isleme gore


// curl_setopt($curl,CURLOPT_URL,"https://www.php.net/");
// curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
//curl_setopt_array dizi icerisinde kullandigmiz icin ustteki gibi ayri ayri kullanmamiza gerek yok ya yukardaki gibi kullanir curl_setopt_array i kullanmayiz , ya da asagidaki gibi array seklindeki curl_setopt kullaniriz yukarda ayri ayri kullanmayiz
curl_setopt_array($curl, [//Burayi kullanarak, data cekecegimz sitenin datasini degiskenimize aktaracagiz ekrana basmak yerine
    CURLOPT_URL=>"https://www.php.net/",
    CURLOPT_RETURNTRANSFER=>true
]);

//3.adim execute etmek- curl i calistirmak
$source=curl_exec($curl);//curl istegi calistirildi
//4.adim curlu  sonlandirmak
curl_close($curl);

//Biz bu islemleri yapinca bu temelde ne yapacak php.net adresinin kaynagini bize cekecek
//Biz php.net sitesinde bulunan datalari cekebiliyoruz curl ile 

//O zaman ornegin php.net kaynagindaki html deki en ustteki title etiketleri arasindaki baslik tekstini almak istiyoruz
//php.net in title ini cekmeye calisacagiz
//Yukardaki islemimizde direk ekranimza basti, php.net in sitesini ama biz bu sekilde direk ekrnaa basmak yerine bir  degiskene aktarip ihtiyacimiz olursa kullanmak istiyoruz.Boyle bir durumda ne yapariz? cur_setopt_array() methodunu kulanip icerisinde bazi inbuild elementler kullanacagiz.  CURLOPT_RETURNTRANSFER=>true

//BESTPRACTTISE-REGULAR EXPRESSIONS ILE COK UZUN BIR HTML IFADEDEN COK HIZLI BIR SEKILDE ARADIGMIZI ALABILIYORUZ..
//Burda biz ne aliyoruz html bir cikti aliyoruz dikkat edelim
//O zaman biz regular expressions da ogrendigmiz pregm_match ile title acilip kapanma etiketleri arasindakileri getir diyebiliriz
//Biz "/  /" bu sekilde slash lar ile baslatirsak ve ayrica icerde / kullanmamiz gerekirse o zaman o slash in, slash olarak taninmasi icin ters slash \ ile birlikte kullanmamiz gerekiyordu(escape karakteri terslash \, boylelikle cakismayi onlemis oluyoruz) bunu unutmayalim regular expressions da

//BESTPRACTISE
//cURL tek basina bir ise yaramaz cURL i biz ancak regex ile kullaninca ortaya harika isler cikiyor ondan dolayi da regex i iyi kullanmamiz gerekiyor

preg_match("/<title>(.*?)<\/title>/",$source,$title);   
// git title etiketleri arsinda buldugun texti getir diyor
//preg_match("/<title>.*?<\/title>/",$source,$title);  boyle yazsa idik
// bize "</text><title>PHP: Hypertext Preprocessor</title>" sadece bu halini donecekti
// ama biz parse edilmis hali ile birlikte almak istedigmiz icin parantez icerisine almis olduk, yani gruplama islemi yapmis olduk
//
print_r($title);//ASLINDA BURDA KUCUK BIR BOT YAZDIK DIYEBILIIRZ
/*
{
0: "</text><title>PHP: Hypertext Preprocessor</title>",
1: "PHP: Hypertext Preprocessor"
}
*/

/*
/<title>(.*?)<\/title>/ bu sekilde her bir title i ayri ayri secerken yani 4 farkli title icin 4 farkli secim  yapar ama

/<title>(.*)<\/title>/ bu sekilde ise 4 tane ayri ayri title da bulsa o zaaman yine 1 secim  yapar 4 u icin
yani 1 basta title bulsa bir de sonda title bulsa ve arada das bambaske elementler bulsa onlari da arada seciyor aralarda buldugu farkli elementler vs hepsini de icine alarak 1 secim yapar
Ama biz bir html elemnti icerisinde zaten 1 tane title elemnti olacagini biliyoruz

(.*) dog 
I think your dog bit my dog" 
Burda en bastan en son dog a kadar secerek 1 secim yapti 
(.*?) dog burda ise 1. doga kadar 1 secim ordan da 2.doga kadar bir secim yani toplam 2 secim yapti cunku olsada olur olmasada 
I think your dog bit my dog



*/



/*
D??zenli ??fadelerin Kullan??m Amac??
Yo??un veri y??????n?? i??erisinden ihtiya?? duyulan bilginin ??ekilmesi,
Kullan??c?? taraf??ndan girilen girdinin denetimi,
Verilerin kullan??m amac??na uygun bi??ime sokulmas??.

duzenli ifade bu sekiilde yazilir
/......./flags
Basta ve sonda mutlaka /..../ veya @.....@ bu sekilde herhangi bir karakter kullanmak gerekir

Not: PHP preg_match() fonksiyonu, ilk e??le??meyi bulduktan sonra aramay?? durdurur, oysa preg_match_all() fonksiyonu dizenin sonuna kadar aramaya devam eder ve ilk e??le??mede durmak yerine t??m olas?? e??le??meleri bulur.

Escape karakterler \ terslahs dir ve bir karakterin ozel bir karakter olarak kullanildigini belirtmek icin kullanilir
ornegin tirnaklar icerisinde / normal slash i sanki normal dize ayrimi icin kullaniyorz gibi algilarken php biz php ye diyoruz ki sen bunu regular expression in ozel karakteri olarak algila burda diyoruz escape karakteri kullanarak \/ bu sekilde yapariz
[abc]	A, b veya c karakterlerinden herhangi biriyle e??le??ir.
[^abc]	A, b veya c d??????nda herhangi bir karakterle e??le??ir.
[a-z]	K??????k harfli a'dan k??????k z'ye kadar herhangi bir karakterle e??le??ir.
[A-Z]	B??y??k harften b??y??k z harfine kadar herhangi bir karakterle e??le??ir.
[a-Z]	K??????k a'dan b??y??k Z'ye kadar herhangi bir karakterle e??le??ir.
[0-9]	0 ile 9 aras??nda tek bir rakamla e??le??ir.
[a-z0-9]	A ve z aras??nda veya 0 ile 9 aras??nda tek bir karakterle e??le??ir.
.	Yeni sat??r d??????nda herhangi bir tek karakterle e??le??ir \n.
\d	herhangi bir rakam karakteriyle e??le??ir. [0-9] ayn??.
\D	Rakam olmayan herhangi bir karakterle e??le??ir. [^0-9] ayn??.
\s	Herhangi bir bo??luk karakteriyle (bo??luk, sekme, yeni sat??r veya sat??r ba???? karakteri) e??le??ir. [\t\n\r] ayn??
\S	Bo??luk olmayan herhangi bir karakterle e??le??ir. [^\t\n\r] ayn??.
\w	Herhangi bir kelime karakteriyle e??le??ir (a'dan z'ye, A'dan Z'ye, 0'dan 9'a ve alt ??izgi olarak tan??mlan??r). [a-zA-Z_0-9] ayn??
\W	S??zc??k olmayan herhangi bir karakterle e??le??ir. ??le ayn??[^a-zA-Z_0-9]
p+	P harfinin bir veya daha fazla olu??umuyla e??le??ir.
p*	P harfinin s??f??r veya daha fazla olu??umuyla e??le??ir.
p?	P harfinin s??f??r veya bir olu??umuyla e??le??ir.
p{2}	P harfinin tam olarak iki olu??umuyla e??le??ir.
p{2,3}	P harfinin en az iki olu??umuyla e??le??ir, ancak p harfinin ????ten fazla tekrarlanmamas??yla e??le??ir.
p{2,}	P harfinin iki veya daha fazla olu??umuyla e??le??ir.
p{2,}	P harfinin iki veya daha fazla olu??umuyla e??le??ir.

Tek bir karakteri secme
Tek bir karakter secmek istersek o zaman g- flagini kullanmamaliyiz

/a/ gider ilk buldugu a yi secer ve durur baska birsey secmez
/a/g dersek ne kadar a varsa text icinde hepsini secer 

+ ifadesi
+ Kendinden once gelen ifadenin bir veya daha fazla kullunmina eslesir
+ kendinden onceki ifadeden en az 1 tane veya daha cok demek
Ornegin
a+ ifades a,aa,aaa,aaaa,aaaaaa....  ile hepsi ile eslesir
a yi tek basina ararsak tek tek a olarak secerken mesela a,aa,aaa da 6 tane eslesme olurken 
a+ dersek a aa aaa da 3 tane eslesme olacaktir cunku grup olarak sececektir + oldugu icin 

"?" ifadesi
"?" kendinden gelen ifadenin 0 veya 1 tekrari ile eslesir. Yani olabilirde, olmayabilirde demek kosullarda kullandigmiz veya gibi hem olani al hem de olmayani al
Ornek "merhaba" ve "meraba" yazilisi farkli, ama ayni anlamli iki kelime gelebilir 
Ama ikisinide secmek istiyoruz "h" harfi onune ? isareti getirerek "h" harfi gelebilirde, gelmeyebilirde demis oluruz 
/merh?aba/g bu sen  git hem merhaba yi al hem de merabayi al demis oluyor 
merababugun hava guzel. merhaba bugun hava guzel- 
Bu ifadede hem meraba yi hem de merhabayi sececektir 


* ifadesi 
* ifadesi onunde bulundugu karakterin 0 ya da tekrarlari ile eslesir.
a*t a nin olmayani ve olanlari ile eslesir yani t yi tek basina ve yanyana nerde gorurse hepsi ile eslesir ama t yi oncesinde a olarak da eslesir, ama a tek basina eslesmez  ama a nin yaninda t olursa o zaman a dan 1 tande olsa daha fazla da olsa eslesecektir 
aat at aaaaat attttt bunlar la eslesir gibi
.* ifadesi butun karakterlere eslenirken, 
a*t ifadesi "t, tt, at" ile eslesir,
bir kere bulgugu tum t ler ile eslesiyor, ayrica at ler le de eslesiyor yani onunde bulundugu karakter t, t yi her gordugu yerde eslesiyor ama oncesinde a olan "at ifadeleri ile de eslesiyor at"
"t , tt tat at " dikkat edelim at ile eslesiyor ama ata ile eslesmiyor 
Kisacasi kendinden sonra gelen harfi nerde bulsa tek basina onunla bir kere eslesiyor ama kendinden once hari tek basina bulunca eslesmiyor onu, kendiinden sonraki harf ile bulunca eslesiyor yani "a" yi tek basina bulunca eslesmiyor ama "a" yi t ile nerde bulursa eslesiyor.. 
"attttttttttttt  aaatttt aatttt  at aat  att aaattt" bu ifadelerin de hepsi ile eslesiyor
"+" ve "?" isaretinin birlesimidir. Opsiyonel olarak tekrar eden kelime var ise grup olarak secer 
Ornek 
"/a*\/g" (\)escape ifadesi ekledik, regular expresssion ifadesi olarak algilasin diye \ isaretini yoksa yorumu kapatiyordu 
bu a yi her buldugu yer de eslesecektir 
merhabaaabugun, ifadesinde a ve aaa ile eslesecktir
 

. ifadesi
. ifadesi sayfa yada paragraf sonu disindaki herhangi bir karakteri temsil eder. Ornek olarka "k.re" ifadesi "kure", "kare","kore","kere" ile eslesecektir
/.d/g burda bulgudu tum d harfleri ile eslesir, her bir d harfi ile ayri ayri eslesecektir

/.+/g tum harfleri grup olarak secer tek tek yerine 

/Deniz./g  Deniz,Denize,Denizde gibi kendinden once buludugu her turlu Deniz le baslayan kelimleri sececektir

/w/ turkce,veya norvecde harfler haric, alfanumerik herhangi bir harf rakam veya alt cizgi 
/w/ [a-zA-Z0-9_] bu nun la ayni seydir
/\w/
/W/ [^a-zA-Z0-9_] alfa numerik olmayan
/\W/
"\s" [\t\n\r\f] herhangi bir bosluk karakterini secer
/\s/
"\S" [^\t\n\r\f] bosluk karakteri olmayanlari secer
/\S/
"\d" [0-9] herhangi bir rakam secer
/\d/
  "\D" [0-9] rakam olmayan herhangi bir karakteri secer
/\D/

\b bir kelimenin basinda veya sonunda bir eslesme bulmak icin kullanilir
\B bir kelimenin basinda veya sonunda degil ortasinda bir eslesme bulmak icin kullanilir

^ dizenin baslangicini gosterir
 /^Merhaba/g 
$ dizenin sonunu gosterir 
/guzel.$/g     Merhaba bugun hava guzel de guzeli gosterir

{} bir karakter grubunun veya bir karakterin normal bir ifadede kac kez tekrarlanabilecegini belirtmek icn kullanilir
/\.{4}/ 4kez yanyana tekrar eden . karakterini bulur
{1.}  bir ve daha fazla tekrarlarini bulur

Regex??? te * (y??ld??z) ve + (art??) sembolleri varsay??lan olarak a?? g??zl??d??r(greedy). Yani yakalayabildikleri kadar karakter yakalamaya ??al??????rlar. Fakat bu durum bazen i??imize yaramayabilir. Bazen m??mk??n oldu??unca en az e??le??meyi elde etmek isteriz. ????te bunun i??in bu sembollerden sonra soru i??areti "?" kullanmam??z gerekmedir.


/php(?!'de)/g  sonunda de olmayan php leri sec diyoruz
php php'de php php'de burda 2 tane secer sonunda de olmayanlar i sec denildigi icin

/php(?='de)/g  sonunda de olan php leri sec diyoruz

/(?<!'de)php/g  de ile baslamayan php leri sec

/(?<='de)php/g  de ile baslayan php leri sec

^p	Sat??r??n ba????ndaki p harfiyle e??le??ir.
p$	Sat??r??n sonundaki p harfiyle e??le??ir.
\B	Kelime s??n??r?? haricinde e??le??ir. / \Ba\B /-> aaa
\b	kelime s??n??r??, ba??tan ve sondan / a\b / -> aaa / \ba /->aaa

Flag-Desen degistiriciler
/pattern/i  key-insensitive hale getiriyor
i	E??le??meyi b??y??k/k??????k harf duyarl?? olmayan bir ??ekilde yapar.
m	^ ve $ davran??????n??, dize s??n??r?? yerine yeni sat??r s??n??r??yla (??rne??in, ??ok sat??rl?? bir dize i??indeki her sat??r??n ba??lang??c?? veya sonu) e??le??ecek ??ekilde de??i??tirir.
g	Global bir e??le??me ger??ekle??tirin, yani t??m olu??umlar?? bulur, g yi belirtierek tum metni aramasini saglariz, yoksa metinde hep sadece ilk esleseni bulur.
o	??fadeyi yaln??zca bir kez de??erlendirir.
s	Sat??r ba???? hari?? her ??eyi ifade eden nokta karakterinin sat??r ba????n?? da ifade etmesini sa??lar
x	Netlik sa??lamak i??in D??zenli ifadede (desendeki) bo??luklar?? ve yorumlar?? kullanman??za izin verir.
u	UTF-8 kodlamas?? kullan??l??r. (T??rk??e karekterler i??in gerekli)
*/


?>