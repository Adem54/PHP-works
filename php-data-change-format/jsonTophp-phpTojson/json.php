<?php 

//Json da tek tirnak kullanamiyoruz
//Pythondan cikti alip php de kullanirken bunu ya json ya da xml formatindas yapiyoruz

//Php de json dosyalari icin kullanabilecegimz 2 tane fonksiyon var
//1-json_encode:Degerin json karsiligini verir-Ornegin elimzde bir dizimiz var ise bunu json formatinda veriyor bize
//2-json_decode:Bu da json formatindaki data yi ya obje ye ya da array a donduruyor


$arr=["Adem","Erbas","Skien"];
$json=json_encode($arr);
/* echo $json;
[
    "Adem",
    "Erbas",
    "Skien"
  ] */
$arr2=[
    "name"=>"Adem",
    "surname"=>"Erbas",
    "city"=>"Skien",
    "projects"=>["portfolio"=>["id"=>1,"title"=>"Personal-Portfolio"],"github-user"=>["id"=>2,"title"=>"Github-Users"]],
    "kid"=>[
        "name"=>"Zehra",
        "surname"=>"Erbas"
    ]
    ];

  $my_json=json_encode($arr2);
  //
 // echo $my_json;  
  //Sonucu asagidaki gibi veriyorlar bize
  //Sunu bilmemiz gerekiyor json da hem obje yi hem de array i biz, php de dizilerle karsilayacagiz
  //Json da ki objeleri biz php de dizi de key kullanarak karsilayacagiz
  //Yani biz php deki datayi json a cevirirken ona uygun sekilde yazmamiz gerekiyor ki istedigmzin karsiligini alabilelim
  //BURASI COK ONEMLI..CUNKU BIZ UYGULAMAMIZI YAZIP, EN SON ORNEGIN, PHP KULLANARAK BIR API HIZMETI OLSUTRDUK VE BU API HIZMETINI
  //KULLANICILARIMIZA SUNACAGIZ, NASIL SUNACAGIZ TABI KI JSON FORMATINDA SUNUYORUZ BU COOK ONEMLI
  //jSON DA BIZ AYNEN QUERY-SORGULARINDA KULLANDIGZ  ?ID=5 SEKLINDEKI SORUGLARI JSON URL DE DE KULLANABILECEGIMIZ ICIN BIR SORUN YASAMAYIZ
  /*
  {
  "name": "Adem",
  "surname": "Erbas",
  "city": "Skien",
  "projects": {
    "portfolio": {
      "id": 1,
      "title": "Personal-Portfolio"
    },
    "github-user": {
      "id": 2,
      "title": "Github-Users"
    }
  },
  "kid": {
    "name": "Zehra",
    "surname": "Erbas"
  }
}
  
  */
//SIMDI DE JSON BIR DEGISKENI PHP YE CEVIRELIM
//Json icerisinde tek tirnak kullanmiyoruz cift tirnak ama php icerisinde o json data sini
//tek tirnak icerisine aliyhoruz
//Json formatindaki datayi biz php de diziye veya objeye cevirebiliyoruz, json_decode ile

$data_json='{
    "name": "Adem",
    "surname": "Erbas",
    "city": "Skien",
    "projects": ["portfolio", "githbu-user"],
    "kid": {
        "name": "Zehra",
        "surname": "Erbas"
  }
}
';

//echo "<hr>";
//json_decode();//Eger 2.parametreyi true verirsek o zaman php dizsine cevirir, hicbirsey vermezsem ya da false verirsem ki kendisi de default olarak false geliyor zaten, o zaman da obje olarak php ye cevriliyor

$phpArr=json_decode($data_json,true);
// print_r($phpArr);
// echo $phpArr["name"];//seklinde datalarima erisebilecegim
/*
bu sekilde php dizisi olarak alabiliyoruz
{
name: "Adem",
surname: "Erbas",
city: "Skien",
projects: {
0: "portfolio",
1: "githbu-user"
},
kid: {
name: "Zehra",
surname: "Erbas"
}
},
*/


$phpArr=json_decode($data_json);
//print_r($phpArr);
// echo "<br>"."result";
// echo($phpArr->name);//obje oldugu icin bu sekilde dataya erisecegiz artik

//echo "<hr>";
//Bir php dizisini, json a cevirirken illaki obje olarak cevirmek istersek de ona zorlayabiliriz
$my_arr=["adem","netsense","skien"];
//echo json_encode($my_arr,JSON_FORCE_OBJECT);//{"0":"adem","1":"netsense","2":"skien"}
//echo json_encode($my_arr);//["adem","netsense","skien"]
//Encode ile biz php den jsona ceviriryoruz...php de calisirken, php den baska bir dile cevirmek encode olur
//php den jsona cevirmek encode, json dan php ye cevirmek ise decode 


//Bir json dosyasinin icerigini cagirarark decode etme islemi yapacak  olursak
$json_content=file_get_contents("index.json");
$array=json_decode($json_content);
echo "<hr>";
//Bize obje oalrak donuyro datayi...Ama datayi dizi olarak almak istersek eger
print_r($array->name);//Adem

$array=json_decode($json_content,true);
echo "<hr>";
//Bize obje oalrak donuyro datayi...Ama datayi dizi olarak almak istersek eger
print_r($array["name"]);//Adem

?>

