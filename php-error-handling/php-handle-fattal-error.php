<?php 

//fattal error olumcul hata uygulamanin php nin calismasini durduruyor
//Ornegin olmayan bir fonksiyonuy invoke etttimgz zaman fattal_error aliriz
//hem warning, hem de fattal error cunku $test isminde bir degiskene atanmis bilinmeyen bir detgisken olmasi warning dir ayni zamanda bunun bir fonksiyon olmasi ve olmayan bir fonksiyon olup invoke edilmeye calisilmasindan dolayi da fattal_error aliriz
//fattal_error hatalarindan sonraki kodlarimizi calistiramayiz

//E_ERROR FATTAL_ERROR DEMEKTIR ERROR_REPORTING DE
//ONCE FATTAL_ERROR LARIMIZI GIZLERIZ
error_reporting(E_ERROR ^ E_ERROR);
//Tum hatalari goster, E_ERROR yani fattal_error lar haric diyoruz burda
//Bu sekilde yapinca artik fattal_error gelmesi gerekirken ekran da herhangi bir hata goremiyoruz
//Bu sekilde fattal errorun ekran da gorunmesini onluyoruz cunku biz kendimz ekrana daha kullanici dostu bir hata mesaji basacagiz...ondna dolayi normal fattal errorda php nin ekrana basttigi ve ekrani durdurudug fattal error mesajijni gostermememeiz gerekiyor
//Eger ekranin php nin calismasini durduruan bir hata var ise bu son hata olacaktir ve fattal_error olacaktir bu

//register_shutdown_function ile fattal_errordan dolayi sistem durduktan sonra bir fonksiyon calistarbilyoruz

function my_fattal_error(){
   // echo "my_fattal_error is running";
    //Biz ekrani durduran son hatayi biz bu fonkksiyon icerisinde alabiliyoruz
    $error=error_get_last();//inbuild bir php fonksiyonu error_get_last
   // print_r($error);
    /*
    {
    type: "1",
    message: "Uncaught Error: Value of type null is not callable in C:\Users\ae_netsense.no\utv\test\php-error-handling\php-handle-fattal-error.php:26",
    file: "C:\Users\ae_netsense.no\utv\test\php-error-handling\php-handle-fattal-error.php",
    line: "26"
},
    */
    //ekrani durduran fattal error son hatamizin bilgileriine bu sekidle erisebildigmize gore o zaman biz bu hatanin ekrana daha kullanici dostu bir sekidle basilmasini saglayabiliriz...COOK ONEMLI BESTPRACTSIE...
    if($error['type']==1){//fattal error lari y akaliyor bu sekidle
        echo "<div style='background-color:darkred; color:#fff; padding:5px;'>".
        $error['message']."</div>";
    }
    if($error['type']==2){//WARNING error lari y akaliyor bu sekidle
        echo "<div style='background-color:darkred; color:#fff; padding:5px;'>".
        $error['message']."</div>";
    }
}
/* BESTPRACTISE... 
BIZ PHP ICERISINDE IKEN PHP TAGLARINI KAPATIP DOGRUDAN, HTML ETIKETLERII DE YAZABILIRYORUZ AMA ISTERSEK DE PHP DE ECHO ILE EEKRANA BASARKEN DE TIRNAKLAR ICERISINDEN HTML TAGLARI YAZABILIYRUZ..

*/
//BU ARADA ERROR_GET_LAST METHODUN HER TURLU HATAYI YAKALIYOR SADECE FATTAL ERRORLARI DEGIL
//Ekranda son olarak bu register_shutdown_function parametresine girdigmiz fonksiyon icerisinde ekrana birsey yazmis isek onu gorecegiz
register_shutdown_function("my_fattal_error");

$test();//FATTAL_ERROR VERIR
//echo $test;//WARNING VERIYOR

echo "hello world";

?>