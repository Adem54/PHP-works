<?php 
//Dizinlerdeki dosyalari listeleme
//Recrusive fonksiyon ile tum dizinleri okuyacagiz

//1.Yontem-scandir() dizi listelemk icin
//2.glob()

//scandir()
$my_files=scandir(".");//icerisine mevcut dosyamin calistigi dizini vermek istersek sadece "." veririz 
//print_r($my_files);
/*

Bize mevcut dizinde var olan klasor ve dosyalari, bir dizi icine atarak getirir
{
0: ".",
1: "..",
2: "index.php",
3: "test1",
4: "test1.txt",
5: "test2",
6: "test3"
}

*/
//is_dir-icine girilen fonksiyonun dizin olup olmadigini verir
//is_file da dosya olup olmadigini anliyor
//print_r(array_filter($my_files, function($value){
  //  return is_dir($value);
//}));
//Burda bize .,..,test1,test2,test3 klasorlerini getiriyor sadece yani eger icinde bulundgumz dizin de dosya var ise onlari getirmiyor is_dir de
//cunku dir tum dosya ve klasorleri listeliyor normalde ama is_dir ile bunu sadece klasorleri getir demis gibi oluyoruz
//. ve .. is_dir ile filtreleyince de geliyor
/*
{
0: ".",
1: "..",
3: "test1",
5: "test2",
6: "test3"
}
*/

$my_files=glob("*");
//print_r($my_files);
//glob(*) ile icinde bulundgumz directory altindaki tum dosya ve klasorleri getirir ama . ve .. yi getirmiyor
/*
{
0: "index.php",
1: "test1",
2: "test1.txt",
3: "test2",
4: "test3"
}
*/


//Sunu iyi bilelim...NOT...BESTPRACTISE...BIZ ./ YAPARSAK O ZAMAN SADECE KLASOR LERI GETIR DEMIS OLURZ..YANI BIR ALT DIZINI OLABILECEKLER GETIR DEMIS OLYORUZ..../ DEMEK KLASOR OLAN HERSEY GELSIN DEMEK
//*/ SADECE KLASORLERI GETIR DEMKTIR BU DIKKAT EDLEIM..

//glob da ornegin sadece dizinleri listemek istersek 2. parametrede GLOBAL_ONLYDIR diyebilirdik veya
//glob(*/) Yani sadece klasorleri listelemek icin
//$my_files=glob("*",GLOB_ONLYDIR);
$my_files=glob("*/");
//print_r($my_files);
/*
{
0: "test1/",
1: "test2/",
2: "test3/"
}
*/
//Sadece php dosyalarini listelemek istersek
$my_php_files=glob("*.php");
//print_r($my_php_files);
/*
{
0: "index.php"
}
*/

$my_txt_php_files=glob("*.{php,txt}",GLOB_BRACE);//Hem php hem de txt dosyalarini listelemek istersek bu sekilde listeleriz
//Bir suru dosya icerisinden uzantisi php ve txt olanlari bulup bize getirecek bu sekilde
//print_r($my_txt_php_files);
/*
{
0: "index.php",
1: "test1.txt"
}
*/

$my_txt_php_files=glob("*{/php,txt}",GLOB_BRACE);//
//print_r($my_txt_php_files);

$my_txt_php_html_files=glob("*.{php,txt,html}",GLOB_BRACE);
//print_r($my_txt_php_html_files);
/*
{
0: "index.php",
1: "test1.txt",
2: "test.html"
}
*/
/* 
BESTPRACTISE...BU YONTEM COOK ISMIZE YARAYACAK...COOOK ONEMLIDIR
Simdi burda bir suru dosya alt alta olma durumu olacak ayni ic ice dizilerin olmasi gibi
Ve biz nerde bu sekilde bir yukardan asagi veya asagidan yukari hiyerarsi gorursek yani birbirne benzer islerin ic ice gittigi ama nerde ne zaman sonlanacagnii bilemdgimiz durumlar ile karsilastigimizda, yapacagimiz islem recrusive fonksiyonlardir...Bunu hicbir zaman unutmayalim....

*/

function list_files($name_dir){//$name_dir-dizin adi demektir
        $files= scandir($name_dir);//$files bir dizi olarak gelecektir
        //Scan dir ile gelen dosyalar arasinda   ., .. da geliyor onlari almak istemiyrouz ama
        //Bestpractise bir dizi icerisinde istemedigimz elementler yok ise demk istersek biraz bakis acimizi degistirerek olaya yaklasacagiz..Yani olaya sadecee elimizdeki datalar uzerinden yaklasmaktan vaz gecelim o zaten klasik ve kolay olani biraz daha kreativ dusunelim..yani orngin biz . ve .. istemiyoruz degil mi o zaman ne yapacagiz bbu . ve .. yi biz bir dizi icine atalim sonra da foreachc icerisinde $files dizimiizi dondururken her bir elementi [.,..] bu arrayiinn icnide var mi diye sorgulayalim....eger var ise diyelim....bak bu bakis acisinin ssevdim yani bir dizi icindeki elementler icinde 2 tanesini istisna tutacaksak ki bu say i daha cok da olabilrdi...bu harika bir cozum  mantigidir...bu cozumu uygulayabirliriz her zaman...coook iyi harika bir cozumdur
        echo  "<ul>"; 
                foreach ($files as $key => $value) {
                    if(!in_array($value,['.','..'])){//Eger $file dizimiz icindeki elemntlerimiz tek tek, bizim [".",".."] bu dizimzin icerisinde yok ise diyoruz...yani kimsie gelip  de bize hazir dizileri verip de is cozmemizi beklemez her zaman, biz gerektiginde uretken olarak cozumler bulacagiz.....ve biraz normalin disina cikmamiz gerekiyor....HARIKA BESTPRACTISE......
                        //EGer $file icindeki elemanlar '.' ve '..' degil ise diyoruz...
                        echo "<li>".$value;
                        //Eger bu bir dizin ise yani klasor ise, (ayni dizi gibi yani, eger bu bir dizin ise klasor ise o zaman onun icine bakmak gerekiyor....)O ZAMAN DOSYA LISTELE YI TEKRAR DA CAGIR VE PARAMETRELERINI DE DIZIN VEYA KLASOR OLAN IN DIZIN ISMINI VERELIM
                           if(is_dir($name_dir. "/" . $value) ){//Burda  $name_dir . yani icinde bulundugumuz dizin veriliyor
                            // ./bir alt taki dosya ya da klasor ismi veriliyor onun klasor olup olmadini da iste dizini mi degil mi is_dir ile anlyoruz eger klasor icine girmis isek diyoruz....is_dir sayesinde yani altinda dosya veya klasor ler olabilecek bir klasor mu degil mi onu cek ediyor is_dir bunu unutmayalim
                                list_files($name_dir. "/" . $value);
                           } 
                        echo "</li>";
                        //
                    }
                   

        } 
        echo " </ul>";
}
//Tamam biz simdi list_files ile icinde bulundugmuz dizinin veya hangii dizin verilirse onun altindaki dosya ve dizin(klasorleri) listeliyoruz ama biz sunu istiyoruz parametreye verdimgiz  dizin durumuna gore tek tek dosyalar ve klsorler listleensin ancak eger klasorler arasinda icerisinde klasor ve dosyalar var ise onlar da onlarin altinda boyle hiyerarsik bir sekilde listelensin isteyebilririz...ISTE BU TARZ TALEPLERIN KI BU TALEPLER KARSIMIZA GERCEKTEN COK FAZLA CIKACAK VE BU TALEPLERE COZUM OLARAK RECRUSIVE FONKSIYONDAN DAHA IYI BIRCOZUM YOK CUNKU BIZ BILEMEYIZ KI BU IC ICE DOSYA VE DIZINLERIN GITMESI NEREYE KADAR GITTGINI BIZ BILEMEYIZ VE KESTIREMYIZ...

list_files(".");//Dosya yolu olarak su an icin de bulundgumuz dosyanin dizinin verirsek, bu bizim ana doasya olan File_List_of_directory klasoru altindaki tum dosyalari listeleyecektir
/*
scandir(./) verirsek bize dizi icinde icinde bulundugjmzu dizin icindeki tum dosya ve klasorleri verir ancak ., .. da verecek ondna dolayi biz yukardaki fonksiyonumuzda ..,. olmasin istedik ve ona gore bir cozum urettik...

index.php
test.css
test.html
test1
test1.txt
test2
test3

*/

/*
ASAGIDAKI KONTROLLERI COKCA KULLANACAGIZ..
isset-deisken var mi
file_exist-dosya var mi
exist-fonksiyon var mi
is_array-array icinde var mi
is_dir-bu bir dizin mi


*/

//print_r(glob("*"));//yani dosyalardan / bu sekilde olabilenleri getir diyoruz burda yani klasor oalnlari

echo "*******************************************************";
function list_of_my_files($my_dir_name){
    echo "<ul>";
       $my_files_and_folders=glob($my_dir_name);
       foreach ($my_files_and_folders as  $value) {
        
            echo "<li>".$value;
            //Oncelikle dizinde ne var sa tek tek yaziyoruz ve her birisin yazdiktan sonra bir de cek ediyoruz senin altinda da dosya veya klasor var mi yani sende dizin misin yani sende klasor musun yani is_dir() diyerek cek ederiz..
            if(is_dir($value)){//Eger bizim ana dizinimzdedki dosyalardan klasor olan var ise yani dizin olan yani bir altta dosya veya yine klasor olma ihtimali olan bir klsor var ise orda dur ve onun da icine gir diyecegiz        
           list_of_my_files($my_dir_name. "/*");
        }
        echo "</li>";
       } 


    echo "</ul>";
}

list_of_my_files("*");

//glob da * ile tum dosyalari ve klasorleri aliyoruz
//glob ile bir alt klasor icindeki herseyi listelemek icinde print_r(glob('test1/*')) test1 klasoru altindaki hersyi getir diyoruz simdi
//Ama scandaki calisma mantigi biraz daha farklidir scandir(test1/)
//scandir de . ile tum dosya ve klasorleri aliyoruz(ama . ve .. da geliyor)
?>