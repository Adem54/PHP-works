<?php 

//Php deki dizimizi xml e cevirmek
//SIMPLEXMLELEMENT SINIFI
//Bu sinif ile biz php kodu ile sifirdan bir xml olusturabiliriz
//Ayrica da bir php dizimizi xml e de cevirebiliriz

//php kullanarak biz index.xml dosyamizin icerigi gibi bir xml i nasil olusturabiliriz ona bakalim...
header("Content-type:text/xml");
$xml=new SimpleXMLElement("<adem/>");
$xml->addChild("name","Adem");
$xml->addChild("surname","Erbas");
$xml->addChild("city","Skien");

//su ana kadarki olan xml ciktisini almak istersek de 
//echo $xml->asXML();
//Bu sekilde gosterdigmiz zaman yine xml olarak degil php olarak yorumlandigi icin duz bir metin olarak goruyoruz
//AdemErbasSkien
//Bunun xml olarak yorumlanmasi icinde header fonksiyonu ile Content-type ini text/xml yaparsak o zaman xml olarak alabiliriz sonucu
/*
<adem>
<name>Adem</name>
<surname>Erbas</surname>
<city>Skien</city>
</adem>

*/
//Eger bir tane xml etiketi olusturup onun icerisine de 
//xml etiketleri olusturmak istersek ozaman da asagidaki gibi yapacagz
$projects=$xml->addChild("projects");//<projects/> ana bir etiket olusturmus olyoruz ve onu bir deger e aktarip aktardigmz deger e yine addChild ile yeni bir xml eklersek o zaman iste projects xml elementimizi parent element yapip ona child bir elemtn girmis oluruz
$project=$projects->addChild("project");
$project->addAttribute("id",1);
$project->addChild("id","1");
//Burda id icerisine de eger baska bir xml etiketi eklemek istese idimi o zaman bu id ye deger ekledigm
// $id=$project->addChild("id");
// $title=$project->addChild("title"); eger title altina da xml etiketi eklemek istese idik o zaman da yine $title degiskenine atama yapardik
$project->addChild("title","happening");
/*
<projects><project/></projects>
*/

$project=$projects->addChild("project");
//projects altina 1 tane project xml etiketi daha ekledik
//Ve o project etiketi altina da 2 tane id, ve title xml etiketleri giriyoruz
$project->addAttribute("id",2);
$project->addChild("id","2");
$project->addChild("title","github-user");

$project=$projects->addChild("project");
$project->addAttribute("id","3");
$project->addChild("id","3");
$title=$project->addChild("title","personal-portfolio");
$title->addAttribute("id","11");//title xml etiketine id attribute eklemek istersek bu sekilde ekleyebiliirz
//title xml etiketine eger bir attribute vermek istersek o zaman da


//echo $xml->asXML();


$arr=[
    "name"=>"Adem",
    "surname"=>"Erbas",
    "projects"=>[
        0=>["id"=>1,"title"=>"happening"],
        1=>["id"=>2,"title"=>"github-user"],
        2=>["id"=>3,"title"=>"personal-portfolio"],
    ]
];
/* Normalde bir php dizimizi xml e cevirmek istersek ne yapariz
dizimizi foreach ile dondururuz ve her dongude dizi icindeki degerlerimzi new SimdleXmlElement class i ile bir ana xml etiketi acip onun icerisine atariz

*/
//$my_xml=new SimpleXMLElement("<adem2/>");


//BESTPRACTISE..KENDI FONKSIYONUMUZU YAPTIK...
//XML OLUSTURURKEN...KENDI FONKSIYONUMUZU YAPMIS OLDUK
function array_to_xml($my_arr,$my_xml){
 
    foreach ($my_arr as $key => $value) {
      
      if(!is_array($value)):
        $my_xml->addChild($key,$value);
      else:
        if(is_numeric($key)){
            $key="project";
        }
        array_to_xml($value,$my_xml->addChild($key));
    endif;
    //    if(is_array($value)){
    //     array_to_xml($value);
    //    }else{
    //     $xml->addChild($key,$value);
    //    }
    }
    return $my_xml->asXML();
}
echo array_to_xml($arr, new SimpleXMLElement("<adem2/>"));
// foreach ($arr as $key => $value) {
//     $my_xml->addChild($key,$value);
// }
/*
<adem2>
<name>Adem</name>
<surname>Erbas</surname>
</adem2>

*/
//echo $my_xml->asXML();

?>