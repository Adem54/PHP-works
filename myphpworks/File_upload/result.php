<?php 
//yuklenen dosyanyi biz nasil aliyoruz
//$_FILES ile alabilirz
//print_r($_FILES);
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
//Peki bir dosyanin var olup olmadigini nasil kontrol edecegiz...
//Dikkat edelimmmm bu cook onemlidir...Biz kullanici dosyayi yukemis mi yuklememmis mi asagiki gibi kontrol ederiz ve de burda dikkat edelim her yeniledigimzde de temp_name degisiyor
// if($_FILES["file"]["error"]===4){
//     echo "Please choose your file";
// }else {
//     print_r($_FILES);
// }


//Ya da file_exist ile parametre ye dosya yolu girerek bu dosya yolunda, direction da dosya bulunuyor mu onu sorgulayip kontrol edebiliriz
// if(!file_exists($_FILES["file"]["tmp_name"]))
// {
//         echo "Please choose your file";
//     }else {
//         print_r($_FILES);
//     }

//BIZ temp_name dosya yoluna dosyamz gercekten yuklenmis mi onu farkli bir sekilde de kontrol edebiliriz
//is_uploaded_file()

/*
DOSYA YUKLEME ASAMALARI ASAGIDAKI GIBIDIR...
1-Dosya varmi yani dosya gonderilmis mi formdan onu kontrol ederiz , $_FILES["file"]["error"]===4 ile kontrol ederiz errror 4 ise dosya yoktur hic gelmemistir
2-Eger dosya gonderilmis ise birde dosyanin yuklenme asagmasi vardir...Dosya yuklenmis mi ona bakariz...  is_uploaded_file($_FILES["file"]["temp_name"])
3. Sonra yuklenmesini istedigimz dosya uzantilarinin mimetypes larindan olusan bir dizi olustruruz ki gelen dosya uzantisi nin type i olusturdugmz array icerisinde var mi onu cek etmek icin yani biz jpeg,png,gif dosyalarini istiyorsak kullanici gidip txt dosyayi yuklerse ona da bir feedbaack verebilme adina 
$valid_file_extentions=[
        "image/jpeg",
        "image/png",
        "image/gif"
    ];
      $my_file_extention=$FILES["file"]["type"];
 if(in_array($my_file_extention,$valid_file_extentions)){
4.ARdindan dosya artik istedigmzi uzanti da da olduguna gore o zamn simdi de yuklene dosya uzunlugu bizim istedigmiz uzunlukta mi onu kontrol edelim
Biz yuklenen dosya 3gb i gecmesin istiyoruz

  $valid_file_size=(1024*1024*3);//Maksimum 3 mg lik bir dosya yukleyebilsin kullanici..byte cinsinden 3 gb 
        if($valid_file_size<= $_FILES["file"]["size"]){/
5.Sonra da dosyayi istedigmiz bir klasor altina tasiyabilecegiz..

 $upload=move_uploaded_file($_FILES["file"]["temp_name"],"upload/");
  if($upload){
                          //Yuklenmis ise de onu bir resim olarak gosterebiliriz  
                          echo "<h3>File uploaded succesfully</h3>";
                          echo "<img src='upload/".$_FILES["file"]["name"]. "'/>"; 
                    }else {
                        echo "There was a problem uploading the file";
                    }
    */

if($_FILES["file"]["error"]===4){
    echo "Please choose your file";
}else {
   // print_r($_FILES["file"]);//Dosya var demekki sonra birde dosya yuklenmis mi diye kontrol edelim

    if(is_uploaded_file($_FILES["file"]["tmp_name"]))
    {
    //burda biz kendimz bir dizi olusturacagiz...burdaya dikkat edelim..ezberlerin disina cikmamiz gerekir...
    //gecerli dosya uzantilari, yani biz normalde dosya yuklenince $_FILES["file"]["type"] ile dosya uzantimiz gelecektir
    //biz bize bu type da hangi dosyalar gelebilir onu alabilmek icin kendimz kullaniicdan bize ne tur dosya uzantilari gelebilir onu dusunecegiz..
    //BESTPRACTISE...PROBLEMLERLE UGRASIRKEN DOGRU BAKIS ACISI KAZANMAK...BIZE HERZAMAN HAZIR FONKSIYON ILE DIREK YAZ O DA BIZE DOSYA UZANTISINI VERSIN BU HERZAMANB BOYLE OLMAZ...KIMI ZAMAN BOYLE BIRSEY YOKTUR BIZ GELIP MANUEL BIR SEKILDE...KULLANICIDAN GELEBILECEK DOSYA UZANTILARINDAN BIR DIZI OLUSTURABILIRIZ KENDIMZ VE O DIZI ICINDE KONTROL YAPABILRIZ...BU COOK ONEMLI...BIR PROBLEMLE KARSILASTRIGIMZDA HER TURLU FARKLI VARYASYONDA COZUME, VE ISLEME HAZIR OLMAK COK ONEMLIDIR....TEK KALIP ICINDE KALMAMALYIZ,EZBER LERDEN CIKARAK BAKIS ACIMZI GELISTIRMELIYIZ...
    //Burda gidip mime type listesinden internetten kullanicimz hangi dosya uzantisini yukleme durumu var ise onlardan bir dizi olusturacagiz..
    //Dizimizi olusturduktan sonra in_array icerisinden icerdeki dosya uantilarindan herhangi biri gelmis mi diye kontrol edebilriz...
    
    //Bu dosya uzantillarini mimetypes diye internette ararsak orda jpeg,jpg,png,gif dosyalarina ait ve diger tum dosyalar ati mime types i bulabiliriz...ordan gidip istedigmz dosya uzantilarinin upload olunca yuklenme type i olan mimetypes lari bulururz cunku bir dosya upload edilince $_FILES["file"]["type"] da bize, bu mimetype i veriyor yani biz burda yuklenen dosyamizin bizim yaptigimiz dosya uzantilari listesinde var mi ona bakacagiz...biz kendi istedgimz dosya uzantilarindan bir dosya uzanti yuklenmesi icin kendi istedigmiz dosya uzantilarindan olusan bir dizi olusturup  o mime type larini yazariz ki biz gelen dosyanin uzantisini cek edelim ve kullaniciya sadece bizim istedigmiz type da dosya yuklemesi icin onu uyaralim ve geri bildirim verebilelim...
    $valid_file_extentions=[
        "image/jpeg",
        "image/png",
        "image/gif"
    ];

    //Biz dosya uzantisi bilgisini nerden aliyoruz, $_FILES icindeki file dizisinin icindeki type indisinden dosyanin hangi uzanti ile geldigni bulabiliyoruz
    //Yani
    $my_file_extention=$_FILES["file"]["type"];
    //Yuklenen dosya uzantisi, bizim dosya uzantilari icin olusturdgumuz dosya uzantimiz icinde  var mi onu bu sekilde kontrol edebiliriz
    if(in_array($my_file_extention,$valid_file_extentions)){

        //Dosya boyutunu da kontrol edelim...(bu da bize yine $_FILES icinde geliyor)Yüklenecek dosyanın bayt cinsinden boyutu dur size-
        $valid_file_size=(1024*1024*3);//Maksimum 3 mg lik bir dosya yukleyebilsin kullanici..byte cinsinden 3 gb 
    //    echo $_FILES["file"]["size"]. "</br>";
    //    echo $valid_file_size. "</br>";
    //    die();
    //    exit();
    //TEknik olarak da zaten php de en fazla 2 mb lik bir dosya yukleyebiliriz
        if($_FILES["file"]["size"]<= $valid_file_size ){//Burda dosyanin size ini da kontrol edip kullaniciya hata durumunda bilgi de verebiliyoruz
                    //Condition buraya girerse dosya yukleme ile ilgili tum sartlar saglanmis olacak ve biz de burda dosyayi temp_name den istedigmiz bir yere yukleyebiliriz....upload ismindeki klasor umuze yukleyebiliriz
                    //Burda dosya ismini degistirmezsek bile, dosuya ismini belirtmemiz cok onemldir yoksa hata aliriz
                   
                    //BIZ DOSYAMIZA UNIQ BIR ID URETMEK ISTERSEK NE YAPABILIRIZ ONA BAKALIM
                    //explode("",$str) ile biz bir string i aralarindaki virgul veya bosluga gore bir diziye cevirip diziye atabiliyoruz
                    //Peki biz bu isi ne icin yapmayi dusunuyoruz...dogrudan uzantiyi almak istiyoruz cunku biz uniq isim uretecegiz ama is
                    $fileExt=explode(".",$_FILES["file"]["name"]);
                    $fileActualExt = strtolower(end($fileExt));//end ile array icindeki son elemnti alabiliriz..ve bu sekilde dinamik hale getriririz
                 //   echo($fileActualExt);//{0: "Adem",1: "jpg"}//Bu sekilde 2. elementi alabiliriz
                    //BESTPRACTISE...BIZIM KIMIZ ZAMAN DOSYA UZANTISIINI PARCALAMAMIZ GEREKEBILIR YANI 
                   $name=uniqid("",true).".".$fileActualExt;
                 //   $upload=move_uploaded_file($_FILES["file"]["tmp_name"],"./upload/".$_FILES["file"]["name"]);
                    //burda yuklenen dosya ismini degistirmedik

                   $upload=move_uploaded_file($_FILES["file"]["tmp_name"],"./upload/".$name);
                    //move_uploaded_file a parametre olarak temp_name i veririz ve 2.parametre dosyanin yuklenecegiz path i ve istiyorsak da dosyayay yeni bir isim veiririz ya da hic dokunmayiz hangi isimle yuklendi ise o isimle upload edilir istedgimz klasore
                
                    if($upload){
                          //Yuklenmis ise de onu bir resim olarak gosterebiliriz  
                          echo "<h3>File uploaded succesfully</h3>";
                          echo "<img src='./upload/".$_FILES["file"]["name"]. "' alt='adem'  />"; 
                    }else {
                        echo "There was a problem uploading the file";
                    }
                    
        }else {
            echo "File could be maxs 3 mg size";
        }

    }else{
        echo "File could be just .jpeg, png or gif";
    }
    }else{
        echo "There is an error occured when the file uploaded";   
    }

}


//Mimetype:Farkli uzantilardaki dosyalari tanimlamak icin birbirinden ayri dosya kimlik tanimlayicisidir
//En cok dosya ve mail tarayicilari tarafindan kullanilir
//Bu ozellikle web tarayicilarinda kullanilan bir ayirt etme islemidir ve bu arka planda calisan kodlarin dosyalara ait MIME type eslestirmesi yapilarak gerceklestirilmektedir
//Buna ek olarak file upload işlemleri sırasında yüklenen dosyaların uzantılarını MIME Type bilgilerine göre filtreleyebiliriz. Örneğin .txt dosya uzantısına sahip bir metin dosyası için MIME Type kimlik bilgisi text/plain değeridir. Bu da bize dosya özelliklerinden gelmektedir. PHP programlama dilinde yazılmış bir 
//dosya upload formuna yüklenen dosyanın uzantısı aşağıdaki şekilde alınabilmektedir:
  
 //Bir dosyanin mime type ini php ile bulabiliriz
// echo mime_content_type("result.php")."</br>"; //text/x-php  
// echo mime_content_type("test.txt"); //application/x-empty
?>


<?php 

//Eger dosyayi hic kontrol etmeyelim direk alip yukleyeyim dersek de o zaman copy() fonksiyonunu kullaniriz
//1.parametre olarak gecici dosya ismini veriyoruz sonra da ayni dosya ismi ile kaydet diyoruz
copy($_FILES["file"]["tmp_name"],"upload/".$_FILES["file"]["name"]);
//BURDA HICBIRSEYI KONRTOL ETMEK DIREK SECILEN VE UPLOAD EDILEN DOKUMANI UPLOAD KLASORUMUZ ALTINA YUKLEYECEKTIR
//AMA ONEMLI OLAN KONTROLLERDIR HERZAMAN BU COOK ONEMLIDIR

?>