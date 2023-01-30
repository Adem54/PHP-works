<?php 
#Gelen datayi alalim once
//print_r($_FILES);
/*
Dikkat edelim...bu sekilde geliyor
$_FILES=[file=>[
    name=>[

]]]
file dizisi icerisinde name,type,tmp_name,error,size dizileri ile birlikte gelecek
file: {
name: {
0: "Adem.jpg",
1: "BobilerWebSite.txt",
2: "Faydali kurslar.docx",
3: "Klagebrev.pdf"
},
type: {
0: "image/jpeg",
1: "text/plain",
2: "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
3: "application/pdf"
},
tmp_name: {
0: "C:\wamp64\tmp\php1B67.tmp",
1: "C:\wamp64\tmp\php1B68.tmp",
2: "C:\wamp64\tmp\php1B69.tmp",
3: "C:\wamp64\tmp\php1B6A.tmp"
},
error: {
0: "0",
1: "0",
2: "0",
3: "0"
},
size: {
0: "52705",
1: "106",
2: "12809",
3: "55821"
}
}

*/

//parametre olarak sadedce files i gonderecegiz...
//yani $_FILES["file"]
function multi_upload($files){
    //
    $result=[];
    //1.HATA DURUMUNU-ERROR U KONTROL EDERIZ ILK OLARAK
    //1. olarak dosyalar eger gonderilmezse bos gonderilirse error:4 olark gelir ama dosyalar secilier de upload a tiklanirsa o zaman error:0 olarak geliyordu ondan dolayi biz dosya bos mu gonderimis ilk hamle yoksa dosya secilmis de mi gonderilmis onu cek ederiz
    foreach ($files["error"] as $index => $error) {
            if($error == 4){
                $result["error"]="Please choose the file";//Burda ki olay su biz burda hepsinde ayni mesaji vermek istiyoruz ondan dolayi foreach icindeyiz ama hepsi tekrar tekrar ayni stringi atama yapiyor her donuste
            }elseif($error!=0){
                $result["error"][]="There is a problem when the file upload".$files["name"][$index];
                //Ancak burda istiyoruz ki hangi isimdeki dosyalarda hata oldugunu da gorelim dolayisi ile o zaman dizi icine yazsin ve hepsinde mesaj ayni olsun ama sonlarna dosya isimleri eklensin yani dizi icine ekleye ekleye gidecek foreach de her hata durumunda.....burasi guzel ve onmeli....
                //Ekstra farkli bir sekildeki hatayi da $result["hata"][] diziye eklemis oluyoruz ayni push etmek gibi eklemis oluyoruz aslinda 
            }
    }
        //Hata durumunu kontrol ettik simdi de eger hata yoksa devam et diyecegiz
        //Yani error 4 ve 0 harici rakam degil 0 ise yani o zaman dosyalar i gondermistir kullanici o zaman
        //biz hicbir hatayi, $result dizi degiskenimize atmamis oluruz ve de result dizisi icerisinde $error key i olmayacak bunu da 
        //nasil sorgulariz isset ile eger $result icinde error key i yok ise devam et. demekki ok dosyalari kullanici gondermis
        //Artik gonderilen dosyalar yuklenmis mi ona bakacagiz..
        if(!isset($result["error"])){
            //2.olarak hata yok ise doysa uzantillarini kontrol ettirelim...
            //Kendimiz hemen gecerli dosya uzanitis arrayimizi olusturalimm...
            //mimetypes lara karsilik gelecek olan tanimnlar $_FILES icindeki file in icindeki type larda geldigi icin biz dosya uzantisini burdan kontrol ediyoruz...ve kendimiz hangi dosylar olmasini istiyorsak onlarin dizisini olusturacagiz ve onlari cek edecegiz gelen ler icinde bizim olmasini istediklerimiz var mi diye...
            $valid_file_extentions=[
                  "image/jpeg"  
            ];

            foreach ($files["type"] as $index => $type) {
             
                if(!in_array($type,$valid_file_extentions)){
                
                    $result["error"][]="File extension is not valid". $files["name"][$index];
                    // print_r($result["error"]);
                }
            }           
            //3.olarak yine hata yoksa burda da boyutu kontrol edelim...
            if(!isset($result["error"])){
                //boyutlari kontrol edecgiz bu seferde
                $maxSize=(1024*1024);
                foreach ($files["size"] as $index => $size) {
                   if($size > $maxSize){
                    $result["error"][]="File is greater size then extected".$files["names"][$index];
                   }
                }

            }
            //Burda da hatatmiz yok ise dosyalari yuklememiz gerekecek ve her dosyaya uniq bir isim uretmemiz gerekecek ve 
            //bu uniq isimlerin sonuna bize gelen dosya uzantilarini eklememiz gerekecek ve dolayisi ile de biz elimizdeki bir stringi arasindaki . ya gore parcalayip dizi yapabiliyorduk explode ile....coook onemli ordan da uzantiyi alabilirz ve dizinin son elemnani olarak eklenir onu da yine end mehtodu ile dizinin son elemanini alabilriz...
            if(!isset($result["error"])){
                   
                foreach ($files["tmp_name"] as $index => $tmp) {
                    //Dosya yukleme islmini biz move_upload_file ile yuklerken bize dosya isimleri vs lazim olduguicin tmp_name i dondurup dosya adini almak istedik
                    $file_name=$files["name"][$index];//dosya adimiz bu idi
                  
                    //Bu basarili gerceklesir ise true donuyor
                    $upload=move_uploaded_file($tmp,"./upload/".$file_name);
                    if($upload){
                           $result["file"][]="upload/".$file_name; 
                    }else {
                        $result["error"][]="File is not uploaded! #". $file_name;
                    }
                }
             }
        }
        return $result;
}

$result=multi_upload($_FILES["file"]);


//Zaten hata var ise hata yi dondurecek baska birsey gelmeyecek dosya yuklenmemis olacak...
//Ama hata yok ise o zaman da zaten...demekki dosya yuklenmis olacak ve yuklenen dosyalari gostririz muhtemleen
//Simdi biz sistemimizi kendi olusturdugmuz result dizisi icerisine attgimiz dosya ve error dizileri uzerinden islemimizi yuruttuk
//dolayisi ile her zaman patlamamk icin saglam gitmek icin hep sorgulayarak gitmemiz gerekecek.....TYPESAFE BIR DIL DEGIL BIZE EDITOR DE HATA DURUMUNU DONDUREN BIR COMPILE OLAYI YOK ONDAN DA DOLAYI....BIZIM KENDIMIZIN BU CEK ETME ISLEMLERINI IYI YAPMAMIZ GEREKECEK...

if(isset($result["file"])){

    print_r($result["file"]);
    if(isset($result["error"])){

      print_r($result["error"]);
    }
}

  
else {
    //
}


?>