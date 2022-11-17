<?php 

require_once "db.php";

//Bu sekilde direk app.js den gonderilen &type=contact ile ya da type i hidden olan ve sirf submit butonunun tiklanip tiklanmadingi cek edebilmek icin index.php de yazdimgz name i submit olan value si de 1 olan input uzerinden den kontrol edebiliyruz, eger diger alanlarin hicbirisi girilmese ve yine de butona tiklanirsa bunu iste bu kontrollerla anlayabiliriz
$result=[];
 if(isset($_POST["type"])){

     //BESTPRACTISE..BU DA BIR YONTEMDIR EGER DATA GELMIS ISE AL GELMEMIS ISE YA  NULLL YA DA FALSE VER KI BIR ALTTA BEN BUNMLARI IF CONDITION DA KULLANABILEYIM...VE FALSE YA DA NULL OLMA DURUMUNDA DA BACKE-END DE SERVER TARAFINDA DA KULLANICIYA VALIDATION YAPIP FEEDBACK MESAJI VEREBILEYIM
     //BURDA SUNA DIKKAT ETMEMIZ GEREKIYOR EGER APP.JS DEN DATA GONDERILIRKEN JQUERY DEKI SERIALIZE ILE FORM ICINDEKI TUM DATALAR ALINMIS ISE O ZAMAN DIREK FORM ELEMNTLERI ICINDEKI NAME ATTRIBUTE LERINE GORE ALINACAGI ICIN BURDA NAME LERI TAM DOGRU KULLANMAK GEREKIYOR 
     $name_surname=$_POST["namesurname"] ?? false;
     $epost=$_POST["epost"] ?? false;
     $msg=$_POST["message"] ?? false;

//BESTPRACTISE...COK DIKKAT EDELIM.....FORM ISLEMLERINDE BU ISLEMLER HEP FIXDIR AMA BIZ BU ARADA BURDA EMPTY KONTROLU DE MUTLAKA YAPMAMIZ GEREKIR CUNKU KULLANICI EGER ALANLARA BOS BOS BASIP DA GONDERIR ISE SPACE TUSU DA BIR BOSLUK KARAKTERI OLARAK ALGILANACAGIZ ICIN PHP TARAFINDAN SANKI DATA GONDERILMIS GIBI KABUL EDILECEKTIR...

     //BURDA BACKEND VALIDATION KONTROLU YAPABILIRIZ
     //BESTPRATISE..email kontrolunu php nin filer_var($email, FILTER_VALIDATE_EMAIL) ile yapabilirz
   
     if(!$name_surname){
        $result["error"]="Name-surname must be filled";
        //target i verme sebebimz kullanicya alert mesaji ile error mesji verince ayni zamanda kullanicya mesaj hangi alan ile geldi ise mouse umuz o alana focuslandiralim, burda target karsina verecegimiz degerler, index.php de form elemtlerininin id leri ile ayni olmalidir ki biz app.js de dinamik olarak response.target ile hangi alan icin mesaj icin error messaji verilyor ise onu dinamik oalrak alacagiz
        $result["target"]="namesurname";
     }elseif(!$epost){
        $result["error"]="Epost must be filled";
        $result["target"]="epost";

     }elseif(!filter_var($epost,FILTER_VALIDATE_EMAIL)){
        $result["error"]="Email is not valid";
     
        $result["target"]="epost";

     }elseif(!$msg){
        $result["error"]="Message must be filled";
        $result["target"]="msg";
     }else{
        //Burda artik islemlerimze devam ededcegiz cunku buraya girdi ise demekki kullanici tum alanlari dogru bir sekkilde doldurmus demektir
                $insert=$db->prepare("INSERT INTO users SET fullname=:fullname,epost=:epost,message=:msg");
        $data=[
           ":fullname"=>$name_surname,
           ":epost"=>$epost,
           ":msg"=>$msg
       ];
      $insert_res= $insert->execute($data);
    if($insert_res){
        $result["success"]="Your user info is inserted successfully";
    }else {
        $result["error"]="An error occured in your insert process";
    }

     }

 //BESTPRACTISE...BURDAN RESPONSE GONDERIRKEN, DIKKAT EDELIM HEM BASARI MESAJIMIZ HEM DE VERITABANINDAN PROBLEM OLMA DURUMUNDA VERECEGIMIZ HATA MESAJIMIZ VEYA VALIDATION PROBLEMINDE BIZIM BACKENDDEN BURDAN GODNERECEGIMZ HATA RESPONSE MESAJIMIZI BIZ AYNI DIZI ICERISINDE GONDERIYORUZ YANI CEVAP YAZDIGMZ DIZI DEGISKENI 1 TANE SABIT HEP ONUN ILE KEY INI BELIRTEREK ONUN ALTINDA MESAJIMIZI GONDERIYORUZ....KI APP.JS DE RESPONSE.RESULT DIYE BURDAN GONDERILEN HATA MESAJINI DIREK ALABILMIS OLALIM...BU DA GUZEL BIR BESTPRACTISE...VE DE DIKKAT EDELIM BURDA ISLEMLERIMIZ ARASINDAS HEP CEVABI RESULT DIZI DEGISKENIMIZ ICERIISINE GIRDIGMZ FARKLI KEY LER ILE ASSIGN EDIYORUZ VE EN SON TUM  IF-ELSE LER BITTIKTYEN SONRA HER TURLU DURUMDA BIZ ECHO ILE RESULTUMUZU JSON_ENCODE ICINDE GONDEREREK KULLANICIYA YAPILAN ISLEMINI SONUCUNU ULASTIRMIS OLUYORUZ
  
}else{
  
}

echo json_encode($result);
//Bu sekilde backendden gonderilen validation feedback messagini da kullaniciya on yuze response etmis oluyoruz

//BESTPRACTSIE app.js den ajax a yapilan post request sonucunda bizim response gonderirken echo ile gondermemiz gerekyor dolayisi ile de burda datayi json a cevirip de echo ile de gonderebilirz ya da datayi istersek bir html elementi icine  yazarak hazir kalip olarak da gonderip app.js de datayi o hali ile alip index.php de html elemntleri icine de yazabiliriz bunun degerlendirmesi duruma gore yapilabilir..echo ile bir diziyi response edebilmek icin de json_encode methjodu ile gondererek yapabiliriz
?>