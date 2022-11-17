<?php 

//Regular expressions
//Belli basli kurallara gore desenler hazirlayip bir ifade icerisinde eslesenleri bulmamiza olanak saglayan kaliplardir
//Yazdigiz desenlere gore bilinmeyenleri eslestirebiliyoruz
//regex101.com test etmek icin burayi kullanabiliriz
//phpliveregex.com dan da test edebiliriz
/*
Desenler
[abc] demek a,b,c den birer tane olacak demektir veridigmz ifade icerisinde tek tek sececektir
[abc]+  bu demektir ki a,b,c harflerinden en az 1 tane olsun demektir, birden fazla var ise de olabilir,
Burda ise 2 serli olarak da sececektir
+ demek, + sembolunden once belirtilen karakter en az 1 tane olmali,birden fazla var ise de yine eslesir
[^abc]+ a,b,c karakterleri haric diger karakterlerle eslesecektir
[a-z]+ a dan z ye kadar olan harflerle eslesir(kucuk harfli olanlarla)...en az 1 tanesi
[a-zæøå]+ a dan z ye deyince sadece ingilizce karakterleri seciyor eger secmesini istedgimz ozel karakterler var ise onlari da bu sekilde belirtebiliirz
[a-zøæåØÆÅ]+ demek a'dan z' ye tum ingilizce harfler ve øæå ve ØÆÅ harflerinden en az 1 tane ile eslessin,secssin demek
[a-z]+ Basinda + olup olmamasi cok seyi farkettiriyor onu iyi anlayalim..Basinda + olursa yanyna uyan harfleri kalip olarak seciyor
[a-z]+ a bb ccc dd ee ff burda 6 mathces(12 steps) cunku a yi seciyor, bb yi kalip olark seciyor, ccc yi kalip olarak seciyor, dd yi kalip olarak seciyor, ee yi kalip olarak ve ff yi de kalip formatinda  seciyor
[a-z]+ abc bbcde ccc dd ee ff burda da yine 6 mathces(12 steps)
[a-z] a bb ccc dd ee ff burda ise 12 mathces burda ise a, yi seciyor bb yi 2 tane ayri ayri b yi seciyor,ccc icin 3 tane ayri ayri match oluyor, dd 2 tane match oluyor ee v ff den de 2 ser tane match oluyor
[^a-z]+ a dan z ye kadar olan harfler haric(kucuk harfli olanlar haric) diger karakterler ile eslestir, bosluk karakteri de dahil olmak
 uzere a-z arasinda olmayan karakterleri secer
[a-zA-Z]+  Kucuk ve buyuk harf ayirt etmeksizin a'dan z'ye kadar harfler ile eslesir
. dersek bu ayri ayri her turlu karakteri ifade ediyor harf,bosluk,! isareti her turlu karakteri temsil ettitgi icin
.  abc bbcde ccc dd ee ff burd 22 mathces(44 steps) herseyi ayri ayri sayiyor bosluklar da dahil olmak uzere
.+  abc bbcde ccc dd ee ff burda 1 matches(2steps oluyor) boyle yaparsak . her turlu karakteri temsil ettigi icin yanina + koyunca her turlu karakterden en az 1 er tane olsun dendigi icin direk komple ne yazarsak onu 1 tane olarak seciyor
.+ Satir basi karakteri haric herhangi bir karakterle eslesir
Satir basininda eslesmesini istersek. /s flag ini kullanabiliriz
SADECE BOSLUKLARI SECMEK ICIN...
\s Bosluk ya da tab karakterleri ile eslesir, M abc  bbcde ccc dd ee ff  burda 8 matches oluyor ifademiz bitince en sagda da 1 tane bosluk birakiyor veya sayiyor ondan dolayi 8 matches oluyor,her bosluk ayri ayri eslesiyor
\s+ M abc  bbcde ccc dd ee ff  boyle olunca ise 7 matches oluyor cunku bosluklari grup olarak sececek
S I BUYUK YAPINCA BU SEFER DE BOSLUK HARIC DEMIS OLUYORUZ
\S+  M abc  bbcde ccc dd ee ff 7 mathces M-1, abc-1, bbcde-1, ccc-1, dd-1, ee-1, ff-1 seklinde 7mathces olur. Bosluk ya da tab karakterleri haric diger karakterlerle eslesir
\S M abc  bbcde ccc dd ee ff  (18 mathces) yaparsak da bu sefer de bosluk haric her bir karakteri ayri ayri birer birer secer
SADECE SAYILARI SECMEK ICIN
\d Herhangi bir sayi ile eslesir 12 34 545 3434 904 ayri ayri secer 14 matches
\d+ 12 34 545 3434 904 (5 mathces) sayilari grup veya kalip olarak secer, yanyna olanlari bir olark secer
MESELA HARFLI  BIR IFADE ICERSINDE GECEN TELEFON NUMARASINI KOLAYCA ALABILIRIZ BU SAYEDE
SAYI HARIC SECMEK ICIN
\D sayi haric tum karakterleri ayri ayri secer
\D  12AaB  3a!4 5b45 3!434 9%04  buyuk ve kucuk harfler, bosluklar ve ozel karakterlerin her birisini ayri ayri secer ve 13 matches olur
\D+ 12AaB  3a!4 5b45 3!434 9%04 (8 mathces) sayi haric tum karakterlerden yanyana duranlari 1 olarak secer ayri ayri duranlari da 1 er olarak secer
\w+ Harf,sayi ve alt cizgi karakterleri ile eslesir(norvecce ozel karakter desteklemez)
\w key sensitive degildir yani buyuk kucuk harf duyarliligi yoktur dikkat edelim bu normalde digerlerinde var
Birde eger flag veya modifier olarak u(unicode) secilirse norvecce ozel karakterler kullandigmz zaman ayrica belirtmeden de norvecce karakterleri kullanabiliyoruz ama bu \w de gecerlidir digerlerinde degil
\W+ Harf,sayi ve alt cizgi karakterleri haric diger karakterler ile eslesir
\W+  aa b ba bb aba Ø AA!_  7 matches 6 tane bosluk karatkeri ve ! karakterini secer
(BURDA SU FARKLILIKLA KARSILASABILIRIZ HARF,SAYI VE ALTCIZGI HARIC DIYOR EGER UNICODE FLAG I AYARINI YAPMIS ISEK O ZAMAN OZEL NORVECCE KARAKTERLERI DE HARFLER ICINE KATACAGI ICIN ONLAR I YAZDIGMIZ ZAMAN ONLAR HARIC SECECEK AMA YOK UNICODE YAPMAZ ISEK ØÆÅ GIBI HARFLERI KENDI HARF LISTESINDE GORMEYECEGI ICIN BUNLARI HARF, SAYI VE ALTCIZGI HARIC OLANLAR ICINDE KABUL EDER VE UNICODE AYARININ OLUP OLMAMASINA GORE BOYLE FARKLI SONUCLAR ELDE EDEBILIRIZ)

(ha) Parantez icerisine yazilan kelimeler ile eslesir
(ha) hahaha ha haha 6 matches
(ha|he) haheha ha heha 6 matches
Bunu ozellikle bot yaparken de kullanilir ornegin cekecegimz kaynaklar kodlarinda birinde style etiketi var bir tensinde yok
(style| ) boyle yapiliyor bir style yazip | veya bosluk birakiyoruz o zaman da style olani da olmayani da secebiliyoruz
(a|b) a ya da b ile eslesir  
(a|b)+ aa b ba bb aba 5 matches olur yanyana durup da eslesenleri 1 olarak sayar
(a|b)  aa b ba bb aba 10 matches her bir a veya b yi ayri 1 er eslesme olarak sayar
a?   ? sembolunden once belirtilen karakter olsa da olur olmasa da olur. Buna gore bir eslesme yapiyor
ha?  dersek h mutlaka olacak ama a olsa da olur olmasa da diyoruuz, h tekbasina bile olsa seciliyor ama a h nin y aninda var ise aliyor ama tek basina ise a yi almiyor
ha ha h a ha burda 4 matches oluyor a yi tek basina secmiyor ama h ile birlikte iken seciyor
a* * sembolunden once belirtilen karakter varsa kac tane oldugu farketmeden eslesir
ha*  ha ha h a ha aaaaa haaaaaaaa 5 matches oluyor, ha-1, ha-1, h-1, ha-1,haaaaaa-1 toplam 5 oluyor yani h yi tekbasina aliyor ama a yi tek basina almiyor, 
a+ + sembolunden once belirtilen karakter en az 1 tane olmali, birden fazla var ise  yine eslesir
ha+   ha ha h a ha aaaaa haaaaaaaa 4 mathces oldu cunku h olacak ama a dan da en az 1 tane olacak demis oluyoruz ondan dolayi da ha lari ariyor ve 4 tane buluyor
a{3} {} icerisine kac yazilmis ise, onceki karakterden o kadarli esleseni bulur. Bu ornekte 3 tane a olanla eslesecektir  a{3} a aa aaa zaaaaa dersek 2 matches oluyor 3 tane yanyana a 2 tane buluyor
a{2,} 2 ya da daha fazlasi 
a{2,} a aa aaa zaaaaa  3 tane matches oluyor
a{2,3}  2 tane veya 3 tane a yanyana olani sec  a aa aaa zaaaaa  hem 2 hem de 3 seciyor 4 matches oluyor aa-1,aaa-1,aaaaa 5 a nin 3 unu bir aliyor kalaan 2 sini de ayrica 2 ile eslestiriyor
a{2,4} a 2 tane yanyana, 3 tane a yanyana ve 4 tane a yanyana olanlari sec demektir bu

^ ISARETINI DIREK BIR HARFTEN ONCE KULLANMAK(KOSELI PARANTEZ ICINDE OLMADAN KULLANMAK)
^A O satirdaki tum kelime eger A ile basliyor ise eslesiyor,  yani paragrafin tamaminda 1 tane ya bakiyor
a$ ifade a ile basliyorsa eslesir
^A.+s$  A ile baslaycak . ne olursa olsun devam etsin dedik ve s ile bitecek demis olduk
Ademerbas burayi komple secmis oluyr
n\b n ile biten her kelime ile eslesir
n\b sonu n ile biten kelimelerle cakis, mathc ol dioruz 
n\b Ademerbas skien zehra kaya porsgrunn Skien ve Porsgrunn u seciyor
n\B n ile bitmeyen icinde n gecen her kelimelerle eslesir
n\B Sånne Min venn n ile bitmeyen ama icinde n gecen diyor ondan dolayi sånne ve  venn kelimeleri ile eslesecektir

Modifiers-Regex options
/g  Ilk eslesmeden sonra eslesmeye devam etmek icin kullanilir
/i  Buyuk kucuk harf duyarlilgini kaldirmak icin kullanilir
/s  Coklu satirlarda filtreleme islemi yaparken kullanilir

e.*r e olsun de e den sonra gelen herhangi birse ne olursa olsun ve r ile sonlandir deseni var ise ise eslestir diyor
one 
two
three

alt alta olunca normalde secmiyordu biz options regex flags da single line secince e ile baslayip three nin r sine kadar olan kismi seciyor ve 1 mathc oluyor

n.*o n ile baslasin ne gelirse gelsin araya ve o ile bitsin

Birden fazla satirda filtreleme uygualayabilmek icn /s i kullanmamiz gerekiyor
*/

/*
 Regex fonksiyonlari 
preg_match()
preg_match_all()
 */

 //preg_match() duzenli bir ifadeyi eslestirmeye yarar
 //Sablonun ardina konan i ile case-sensitive kaldirlir,buyuk kucuk harf farketmeksizin secmesini saglar

 //1-ARADGIMZ BIR IFADEYI BULMAK REGEX ILE
 if(preg_match("/php/i", "PHP bir betik dilir")){
    //php ifadesini 2.parametreye yazdigmz string icerisinde ara diyoruz ama case sensitive olmayacak sekilde ara diyoruz
    echo "Matched"; 
 }else {
    echo "Not matched";
 }
 //Biz bir string icerisinde bizim aradgimz ifadenin gecip gecmedgini kontrol etmis olduk
//Yazacagimiz ifadenin basina ve sonuna sinirlayci koyariz, preg_match de ve bu sinirlayici
/*
Asagidaki sekiillerde sinirlayiici koyabiliriz
/desen/
#desen#
@desen@
_desen_

preg_match() icerisine eger 2 parametre gondermis isek true ya da false donduruyor
true-1 aradigmiz motif,sablon desen string ifade icinde var demektir 
false-0 ise ardgimz desenin string icerisinde bulunmadigini soyluyor


2-TAM OLARAK ARDGIMZ KELIMEYI AYRI OLARAK ALMAK

\b \b bu sekilde \b \b 2 b arasina ne yazarsak direk onu arar, yani tam olarak o aradigmz kelime ayri bir sekilde, kendi basina  var ise onu arayacaktir
\b \b isleci sablonun tam bir sozcukle eslesecegini belirtir, yani cebir eslesirken cebirci eslesmez
*/

if(preg_match("/\bcebir\b/i","Cebir en sevdigim derstir,cebirci")){
    echo "<br>"."Matchedd";
}else{
    echo "<br>"."Not Matchedd";

}
//BIR ADRESTEN ALAN ISMINI(HOST) CEKIP ALMAK
//@  @i bu seferde @ delimater-sinirlayicilairmz isaretleri arsinda yazmayi tercih ettirk ve yien case sesitive disabled yaptik en sonunda i kullanarak

//@^(?:http://)?([^/]+)@i
//Neden @ isareti ile delimater secildi cunku ayristirma yapmayi dusundugumuz string icerisinde / slash lar cok fazla var iyice kafa karistirmamak icin delimater-sinirlayci olark burda @ at kullaniyoruz
//Ama delimater i @ yerine  yien /   /i yapacak olsa idik o zaman da icerde yazacagimz slash larin onune ters slash \ koymamiz gerekiyordu ki islemimiz calismasi icin
///^(?:http:\/\/)?([^\/]+)/i  bu sekilde \\\ ters slahsleri normal slashl arin onune koyarak islemimizin calismasini saglariz eger regex ifademiz de sinirlayici olarak /   /i kullancak isek
//Ama bu bizim okunabilirligi azalttigi icin biz yine @ @i seklinde kullanacagiz
//(?:...) bu kullanim bu parantez icinde yazilan 
//[^abc] a,b, ya da c harfleri haric diger karakterle eslesir
preg_match('@^(?:http://)?([^/]+)@i',
"http://www.php.net/index.html", $matches
);

$host=$matches[1];

?>