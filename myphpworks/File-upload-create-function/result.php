<?php 
/*
tmp_name:gecici adresi, gecici olark yuklendigi yer
file: {
name: "Adem.jpg",
type: "image/jpeg",
tmp_name: "C:\wamp64\tmp\php7841.tmp",
error: "0",
size: "52705"
}

Dosyaya hicbirysey yuklemeden gonderirsek o zaman da dosya asagidaki sekilde gelir
Yani error ile geliyor, dosya yuklenince error 0, dosya yuklenmeden upload edilirse dosya 4 olarak geliyor
file: {
name: "",
type: "",
tmp_name: "",
error: "4",
size: "0"
}
*/
/* 

BESTPRACTISE...EGER BIR ISLEM YAPIYORUZ VE ISLEMI FONKSIYONA ALMAK ISTIYORZ AMA ISLEM ICIERISINDE VERMEMIZ GEREKEN BIR DEN FAZLA FARKLI TURDE, DEGISKEN VAR ISE O ZAMAN DA BIZ BIR TANE ARRAY OLSTURURUZ VE ICERISINE IHTIYACIMZ OLAN DATALRI EKLERIZ VE BIZIM IHTIYACIMZ OLAN FONKSIYON ICINDE SONUCLARI ORNEGIN MESAJI, DOSYA UZANTISINI VS GIBI SONUCLARI AYRI AYRI TUTABIELCEGMIZ BIR ARRAY OLUSTRURUZU DAHA GENIS DUSUNELIM HER ZAMN HICBIR ZAMAN SABIT, EZBERE DUSUNMEYELIMMM */

//parametre olarak $_FILES["file"] almasini bekliyoruz
//2.parametre olarak boyut-limiti verelim, eger verilmez ise de 1 mb olsun limit(Bu da cok onemldir, yani bize surekliligi saglaayan islemlerden biri de varasyilan paramtreler vererek yine en kotu senaryolarda durumu toparlayabiliyoruz.....)
function upload_file($file,$file_size=1,$file_extentions=null){
$result=[];

    if($file["error"]===4){
        $result["error"]= "Please choose your file";
    }else {
    
        if(is_uploaded_file($file["tmp_name"]))
        {
        
            //BU DA YINE COK ONEMLI UYGULAYABILECEGIMZ BIR ORNEK....ISTERSEK KENDIMIZ HANGI UZANTILI DOSYA ISTIYORSAK ONU YUKLEYEBILIRIZ ISTERSEK DE HICBIRSEY YAPMAYIZ SADECE RESIM YUKLEYEME ISLEMI YAPAN BIR FONKSIYON OLMUS OLUR...
            //Bunu da yine kullanici disardan girmek isterse girsin ya da eger oyle bir sey yoksa burdaki array olsun yok ise de girlmez ise de bu rasi olsun
            //Eger disardan gelir ise disardan gelen data kullanilsin yok disardan gelmez ise o zaman da icerde ki hazir array kullanilsin demis oluyoruz...
        $valid_file_extentions=$file_extentions ? $file_extentions : [
            "image/jpeg",
            "image/png",
            "image/gif"
        ];
    
      
        $my_file_extention=$file["type"];
        if(in_array($my_file_extention,$valid_file_extentions)){
    
            $valid_file_size=(1024*1024*$file_size);//Kullanici kac girerse o kadar mg olacak girmezsse default olarak 1mb olacak
            if($file["size"]<= $valid_file_size ){
                        $fileExt=explode(".",$file["name"]);
                        $fileActualExt = strtolower(end($fileExt));
                       $name=uniqid();
                    
                       $upload=move_uploaded_file($file["tmp_name"],"./upload/".$name);
                        if($upload){
                              //Yuklenmis ise de onu bir resim olarak gosterebiliriz  
                             
                             //  "<img src='./upload/".$_FILES["file"]["name"]. "' alt='adem'  />"; 
                               $result["file"]="PHP-works/myphpworks/File-upload-create-function/upload/".$name;
                        }else {
                            $result["error"]=  "There was a problem uploading the file";
                        }
                        
            }else {
                $result["error"]= "File could be maxs 3 mg size";
            }
    
        }else{
            $result["error"]=  "File could be just .jpeg, png or gif";
        }
        }else{
            $result["error"]=  "There is an error occured when the file uploaded";   
        }
    
    }
    return $result;
}

//ISTEDGIMIZ UZANTIDA, ISTDIGIMZ LIMITTE DOSYA YUKLEYEN FONKSIYON OLUSTURMAK....

$result=upload_file($_FILES["file"],2);//3.parametre olarak ["text/plain"] verirsek mimetypes olarak arkada bu sekilde dosyalar birbirinden ayirt ediliyor, o zaman sadece txt dosyalarinin yuklenmesine izin vermis oluru..txt uzantsinini ["text/plain"] e karsilik geldigini internetten cek edebiliriz
if(isset($result["error"])){
    echo $result["error"];
}else {
    echo "Dosya yuklendi gormek icin asagidaki linke tiklamaliyiz"."</br>";
    echo $result["file"]. "</br>";
    echo "<a href='"."/". $result["file"]. "'>Click to see your file</a>";
  //  "<a href='". $result["file"]  ."'></a>";
    //Dikkat edelim html elementini zaten tirnak icinde yaziyoruz birde html elemnti nin attributu tirnak icinde yazilir
    //Ama attributu icindeki tirnak arasina php variable yazilacak o zaman biz attribut un 1. tirnagi ile 2. tirnagi arasinda
    //php yazacagimz sekilde en a etiketini basinda ve sonunda olan tirnaklari kapatip araya php kodu yazacagiz tabi birlestirmek icin . syntax i kullaniriz
}

?>

