
<?php
  
  //Bu sekilde yeni key ekleyince hata aliyoruz
    $person=[
        "name"=>"Adem"
    ];
    $person["surname"]="Erbas";
 
    
//ama bu sekilde ekleyince yeni key ve vale hata almiyoruz
    $c=array("a"=>"blue","b"=>"green");
    $c["d"]="red";
   // print_r($c);

/*
ARRAYLER PHP DE... COOK FARKLI EFEKTIFKLIKTE KULLANILABILIYORLAR
Php de array ler normal yazilim dillerindeki arraylerden cok daha fazlasini ifade ediyor bunu iyi  bilmek gerekiyor
php deki array ler javascriptte ki obje lerdeki prototyping mantiginin aynisi gibi kullaniliyor
Ornegin, daha onceden tanimlamadgimz bir key- i ekleyerek basip geciyoruz direk....COK HARIKA BIR OZELLIK.


*/

$array=["person"=>[
    "name"=>"ADEM"
]];

$array[]=["mypath"=>"app/categories/index.php"];
//Burda array dizisi icerisine bir dizi eklenmis, key i de eger daha once sayi olarak index var ise onu takip eder yok ise 0 dan baslar
print_r($array);
//print_r($array["person"]["name"]);
//$array dizisiinn person key inin value si de bir dizidir ve name de o dizinin bir key idir
//Ozellikle islem yaparken, bu syntax i kontrol etmek icin 
$var=$array["person"]["name"] ?? "";//BU TERNARY NIN KISALTILMIS HALIDIR
//BU SYNTAX ILE COK FAZLA KULLANILYOR CUNKU ARAY ICERISINE DATA BELLI BIR DUZENE GORE EKLEMEYE CALISIRKEN BAZEN ISTISNALAR CIKARAK
//DATAYI EKLEMEYE ENGEL SEYLER CIKIYOR...O TARZ DURUMLARDA ISLEMIMIZI GARANTI ETMEK ICIN...BU SYNTAX I COK KULLANIRIZ




?>