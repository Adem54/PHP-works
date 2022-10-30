<?php 

//5 in faktoriyelini alan fonksiyonu yazalim
echo "Recrussieve functions";
function showNumbers($number){
   if($number===1)return 1;//number 1 gelirse bir kere 1 return etsin ama 1 den buyuk gelirse de o zaman 
   //faktoriyel i bulsun istiyoruz...
   if($number>0){
      echo "number: ".$number . "</br>";
   return $number*showNumbers($number-1);
   }

}

echo showNumbers(5);

//Yani esasinda biz fonksiyonmlar araciligi ile de dongusel islemler yapabiliriz....
//Fonksiyon u kendi icerisinde claisitirarak dongusel islemleri fonksiyonlar la da yapabiliriz...
// 1 den 0 dan buyuk verilen sayiya a kadar olan sayilari yazdiran fonksiyonu donguleri kullanmadan range methodunu kullanmadan yazalim

$count=0;
function getNumbers($number){
if($number===0)return 0;
global $count;
$count++;
echo "count: ".$count;
if($number>=1){
   echo "<h3>$count</h3>" . "</br>";
   return getNumbers($number-1);
}else {
   return;
}
}

getNumbers(2);
//BESTPRACTSIE...
//Sinirsiz kategori mantiginda da kullanabilirz..
//Ornegin bu alt kategoriler in hangi projede ne kadar olacagini bilemeyiz dolayisi ile de 
//yine reusability mantiginda bir islem yapaarken yani bizim gelebilecek her turlu farkli alternatiflere
//karsilik verebilmek icin de yine bu recrusieve fonksiyonlardan faydalaniyoruz...coook onemli ve etkilidir


//parent demek her zaman ust nesne demektir 
//Hangi kategorinin alt kategorisi olacak ise onun id si verilecektir burasi cook onemli...
//Kategori 0 demek ana kategori demektir...ama kategori ornegin 1,2,3 ise o zaman biz bunlar hangi 
//id olarak hangi id var ise onun alt
//kategorisi demektir...
$categories=[
   [
      "id"=>1,
      "parent"=>0,//use id si 0 olacak
      "name"=>"Tutorials"
   ],
   [
      "id"=>2,
      "parent"=>0,//use id si 0 olacak
      "name"=>"Activities"
   ],
   [
      "id"=>3,
      "parent"=>0,//use id si 0 olacak
      "name"=>"News"
   ],
   [
      "id"=>4,
      "parent"=>1,//use id si 0 olacak
      "name"=>"Php"
   ],
   [
      "id"=>5,
      "parent"=>1,//parent 1 ise o zaman id=1 tutorials oldugu icin bu tutorials in bir alt kategorisi demektir..
      "name"=>"Bootstrap"
   ],
   [
      "id"=>6,
      "parent"=>2,//parent 1 ise o zaman id=1 tutorials oldugu icin bu tutorials in bir alt kategorisi demektir..
      "name"=>"Football"
   ],
   [
      "id"=>7,
      "parent"=>2,//parent 1 ise o zaman id=1 tutorials oldugu icin bu tutorials in bir alt kategorisi demektir..
      "name"=>"Basketbol"
   ],
   [
      "id"=>8,
      "parent"=>3,//parent 1 ise o zaman id=1 tutorials oldugu icin bu tutorials in bir alt kategorisi demektir..
      "name"=>"SportNews"
   ],
   [
      "id"=>9,
      "parent"=>3,//parent 1 ise o zaman id=1 tutorials oldugu icin bu tutorials in bir alt kategorisi demektir..
      "name"=>"PoliticNews"
   ],
   [
      "id"=>10,
      "parent"=>4,//use id si 0 olacak
      "name"=>"Fonksiyonlar"
   ],
   [
      "id"=>11,
      "parent"=>4,//use id si 0 olacak
      "name"=>"Objeler"
   ],
   [
      "id"=>12,
      "parent"=>10,//use id si 0 olacak
      "name"=>"Recrusive Fonksiyonlar"
   ],

];

//Kategorileri listelerken, parentlarinna bakacagiz...ve ona gore listeleyecegiz
//Kulllanici eger parent verir ise, o zaman o parent taki kategorileri getirecegiz ama
//kullanici parent vermez ise o zaman, biz zaten direk en usttek i parent id si olan 0 i verecegiz

//Burda istedikk
function lisMyCategories($myCategories, $parent=0){
      foreach ($myCategories as $category) {
         if($category["parent"]===$parent) 
         {
            echo $category["name"]. "</br>"; 
         }
         # code..
      }
}

lisMyCategories($categories,1);

echo "</br>";
echo "</br>";
//Simdi bir fonksiyon yazalim, verilen kategori numrasina gore kategoriyi listelesin ve 
//Eger alt kategori var ise de onu da mevcut kategori nin altindan alt kategori gibi listelesin
//Bunun icin ne yapmamiz gerekkiyor dikkkat edelim, once ana kategori yi listeleyecek ama her bir ana kategoriyi
//listeledikten sonra bir sonrakine gecmeden alt kategorilerini de listeleycek eger var ise....
//Iste recrusive fonksiyonlar bu tarz islemler icin gercekten cok kompleks olmayan cozumler sunabilmemizi sagliyor advance bir sekilde

function listMyCategoriesWithSub($mycategories,$parent=0){
   echo "<ul>";
   foreach ($mycategories as $cat) {
      # code...
         if($cat["parent"]==$parent){
               echo "<li>". $cat["name"] ;
               //Burda sira ile ornegin parent i 0 olan ana kategori nin ismin yazdirir ardindan da deriz ki simdi de 
               //git bu ana kategorinin alt kategorilerini alabilmeki cin, bu ana kategori nin id sini su an icinde bulungmuz fonksiyonun
               //parametresine parent olarak ver
               echo listMyCategoriesWithSub($mycategories,$cat["id"]);
               echo "</li>";
         }
      }
      echo "</ul>";
   }
 
  //SUB MENU MANTGINA RECURSIVE FONKSIYON ILE BESTPRACTISE COZUM URETMEK!!!!
  //Mantigi su sekilde kuruyoruz sirasi ile once 0. index teki ana kategorilerden Tutorials i 
  //gosterecek sonra tutorials in alt kategorilerini listemeesi icn alt kategrileri ne idi alt kategorilerinin
  //parent i onun id sine esit idi o zaman biz tutorials in id sini gelip de iciinde bulundug fonksiyonu tekrar
  //kendi icinde invoke edersem ve de parametredeki parent kismina da tutorials in id sini verir isem o zaman ne yapacak
  //gidip parent i tutorials in id sine olan lari gidip bulup getirecek....Iste bestpractise sub menu mantigmizi bu sekilde
  //recursive fonksiyonlarla kurabilriiz
  //Yani bu mantikta, biz reusable bir yapi kurduk ve artik istedgimz kadar ic ice sub menu olusturabiliyoruz ve 
  //rahat bir sekilde yonetebilyoruz....HARIKA BIR COZUM SUNDU BIZE....

listMyCategoriesWithSub($categories);

//PEKI BIZ BU DEGERI ECHO ILE YAZDIRMAK DEGILD DE BIR DEGERE RETURN ETMEK ISTESE IDIK NASIL YAPARDIK....
//BU BIZIM JAVASCRIPT ILE MVC YAPARKEN CALISTGIMIZ MANTIGA COK BENZIYOR

function listCategoriesWithSub($mycategories,$parent=0){
   $html="";
   $html.= "<ul>";
   foreach ($mycategories as $cat) {
      # code...
         if($cat["parent"]==$parent){
               $html.= "<li>". $cat["name"] ;
               //Burda sira ile ornegin parent i 0 olan ana kategori nin ismin yazdirir ardindan da deriz ki simdi de 
               //git bu ana kategorinin alt kategorilerini alabilmeki cin, bu ana kategori nin id sini su an icinde bulungmuz fonksiyonun
               //parametresine parent olarak ver
               $html.= listCategoriesWithSub($mycategories,$cat["id"]);
               $html.= "</li>";
         }
      }
      $html.= "</ul>";
      return $html;
   }

   echo  "------------------------"."</br></br>";

   echo listCategoriesWithSub($categories);


   echo "-------------------------"."</br>";



//RECRUSIEVE FONKSIYHONLARA YINE BESTPRACTSIE KULLANIM...IC ICE OLAN DIZILERDEEN ICERDEKINE ERISMEK ISTEDIGMIZDE
//O ZAMAN DA BU REUSABLE VE KALICI BIR SEKILDE EN ICERDE ARANAN BIR ELEMNT BILE OLSA BIZ BU SEKILDE ONA ERISEBILIYOURZ...
//HARIKA BESTPRACTISE KULLANIM...
$myArr=[
    "name"=>"Adem",
    "surname"=>"Erbas",
    "sports"=>[
        "swimming"=>"yes",
        "running"=> "yes",
        "tennis"=>[
            "table_tennis"=>"yes",
            "lawn_tennis"=>"no",

        ]
    ]
        ];


echo "-------------------". is_array($myArr);
        function findElement($arr, $element){
            foreach ($arr as $key=>$item) {
              echo "forech dongusune girdi"."</br>";
              echo "element: ". $element. "</br>";
              echo "key:  ".$key. "</br>";
              if(is_array($item)==0): echo "item: ".$item. "</br>";
            else:print_r($item);
         endif;
              if($key===$element){        
               echo "</br>resres"."<h3>parmetre altinda dizi oldugu icin buryaa girdi</h3>" . "</br>";
                return $item;
              }elseif(is_array($item)) {
                    return findElement($item,$element);
                    //Eger sonuc u bulabiliyor ise de sonucu dondursun geriye...
              }
            }           
        }

        $res= findElement($myArr,"table_tennis");
        if(is_array($res)): print_r($res);
      else:echo $res;
      endif; 
?>