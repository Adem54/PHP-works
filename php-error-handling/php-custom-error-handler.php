<?php 

//Hatalarimizi kendimiz yakalayip istedgimz sekilde dosyaya yazma veya veritabanina kaydetme islemlerini yapabilirz

//set_error_handler()

/*
Types of error
no:1 e_error-A fatal run-time error
no:2 warning
no:8 notice
no:256 e_user_error 
no:512 e_user_warning
no: 1024 e_user_notice
no:2048 e_strict
no:8191 E_ALL

*/
function customErrorHandler($no,$msg,$file,$line){
    //Asagidaki gibi html etiketleri arasina yazarak ve style vererek hatalari daha da ozellestirererek kullaniciya daha guzel bir sekilde sunabiliriz
    //Ayrica bu hatalari dosya ya da yazdirabiliriz
    ?>
    
       <!-- <div style="background-color:teal; color:red">
        <h3>An error occured!</h3>
        <p>
            <?php  
            //  echo "msg: ".$msg."<br>";
            //  echo "no: ".$no."<br>";//no:2 Warning
            
            ?>
        </p>
       </div> -->

       <!--Hatayi dosyaya yazdirmak -->
       <?php 
       //Dosya icine yazarken her yeni hata da bir alt satira gecip yazmasi icin "\n" ekleriz sonuna, bir normalde "<br>" ekledigmiz zman sadece biz okurken ekranda alt alta gelerek bize gozukuyor ama yazidigmiz dosya icinde de alt satira kendisni atmasini istersek o zaman "\n" kullanmalyiz
    //BU SEKILDE HATA BILGILIERIMZI ISTEGIMIZ BIR DOSYAYA YAZDIRABILIRIZ
          $error_data=$no. " | " .$msg. " | " .$file. " | " .$line."\n";
       file_put_contents("error.log",$error_data,FILE_APPEND);//
       //FILE_APPEND alt satira gecip de  yazdirsin
       //2 | Undefined variable $test | C:\Users\ae_netsense.no\utv\test\php-error-handling\php-custom-error-handler.php | 52 
       //bu sekilde yazdirabiliyoruz hatamizi yeni bir dosya olusturarak ya da var olan bir dosya ise de ona daa yazacaktir

       //YA DA HATA BILGIMIZERIMIZI VERITABANINA YAZDIRABILIRIZ
       try {
       $db=new PDO("mysql:host=localhost;dbname=errors;port=3306","root","");
       $insert=$db->prepare("INSERT INTO logs SET no=?,msg=?,file=?,line=?");
       $insert->execute([$no,$msg,$file,$line]);
        
       } catch (\Throwable $th) {
        //throw $th;
       }
//Bu sekilde hatamizi hem veritabanimiza yazdiriyoruz hem de istersek istedgimz bir dosya icerisine yazdirabiliyouruz
//Biz bir sistem gelistridigmiz zaman, hatalarimzi her zaman bir yerde tutmak isteriz yakalamk isteriz ve herhangi bir hata olustugu zaman direk gidip kaydettimigz yerden hatanin ne oldugunu cek edebilmis oluruz bu sekilde
       ?>


    <?php 
    }
//Burda ki echo ile biz herhangi bir hata olusma sonucunda ekrana basilan hatayi burda parametreden alabilyoruz, bu php de hazir bir fonksiyon oldugu icin bu sekilde kurgulanmis bir fonksiyondur.Biz burda customErrorHandler icindeki error u kaldirdigmiz zaman asagidaki olmayan bir $test degiskenini yazdirmaya calistigimzda da ekrana hata basmiyor...Yukardaki fonksiyonu tamamen kaldirdigmiz zaman ise normal her zamanki gibi standart hata mesaji ve hatanin hangi satirda oldugunu veriyor
//Kisacasi bu fonksiyon sayesinde biz olusan hatalarin tum detaylarini parametreler  uzerinden elde etmis oluyoruz
//Bilmemiz gereken onemli noktalardan bir tanesi biz set_error_handler icerisnine yazdigmz fonksiyon parametrelerinden sistemi durduracak turde hatalari yakalayamiyoruz ornegin fattal error u yakalyamiyoruz cunku o php nin calismasini durduruyor, burda php nin calismasini durdurmayacak hatalari yakalayabilyoruz

set_error_handler("customErrorHandler");

//echo $test;
//echo substr();//warning hatasi alirz
//file_get_contents("error.log");//Ayni diretory,dizin de bulunan bir dosyayi direk yazabiliriz ve direk icerigi okunacaktir
//echo file_get_contents("./testt/test.txt");
//Ama ayni directory de var olan bir klasor, dizin icerisindeki bir dosyayi okumak icin ise biz o directory ye cikmak icin once ./ yapariz 
//./ ile file dan ayni direcotry de bulunan bir klasore cikariz
echo $test;

//Biz bunu okuyarak, parse ederek kendimize gore parcalayarak istedigmz sekilde tablo olusturup kendi dosyalarimiza yazdirabiliriz ya da hatlalari parse ederek veritabanina da yazdirabiliriz.... 


?>