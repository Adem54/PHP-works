<?php
require("password.php");

error_reporting(E_ALL ^ E_WARNING);//BURASI HARIKA IS GORUYOR..WARNING IN EKRANDA GOZUKMESI YERINE BIZ SADECE WARNINGE AIT MESAJI GOSTEREBILIRIZ.....

$domain_name = "http://ademtest.site/";
$ip_address = "185.215.199.212";
$host_name = "cpweb07.misshosting.no";
$username = "ademtest";
$psw = "j8mVY9d)1!r0GD";

//Kendi mize ait hata sinifimizi olusturyoruz
class FTPException extends Exception {

    protected $message;
    

    public function __construct($message)
    {
        $this->message=$message;
        parent::__construct($message);
    }

public function get_err_msg(){
    return $this->message;
}

}

//Bu ders cok onemli, kullandigmiz tum ftp methodlarini bir ana class altnda nasil kullanriz ona bakacagiz
class FTPManager
{
    //Eger method ve propertieslerim sadece bu class a ait ise disarda kullanilmayacak ise(helper veya tools mantigindaki fonksiyonlari miz yani sadece class icerisinde kompleks islemleri daha az kodla cozme adina yardimci o class icinde olusturulmus fonksyonlar vardir tamamen lokjal olarak kalacak olan, onlar in public olmasina hic gerek yoktur)
//Ayrica hassas datalar ve sadece constructor uzerinden alinmasini istiyor ve disarden herhangi farkli sekillerde mudahele istemiyorsak ,set edilmesin istemiyorsak o zaman kesinlikle private olarak tanimlariz...propertieslerimize ve functions larmizi, class imiz icerisinde

    private  $host;
    private $username;
    private $password;

    public $ft_conn_id;
    public $ftp_innlogging;

    public $mode=FTP_BINARY;
    public $dir=".";//Buraya ana dir, defaul dir gibi kullanabilirz . o an uzerinde bulundugmuz dizini verir bize
    /*
    ONEMLI...COOK ONEMLI...
    Bu normalde php documant bazi IDE ler kendisi olusturuyor ama bu sekilde bir php documentasyon dosyamiz olmasi cook faydali olacaktir daha sonra dan bir class in islevlerini tanimlamasi acisindan, cok faydali ve kullanislidir
        * FTPManager constructor
        * @param $credentials-buraya ftp_credentials veya ftp_config veya direk config de diyebilirdik
        * @throws FTPException
    
    */
    public function __construct($credentials)
    {
        $this->host = $credentials["host"];
        $this->username = $credentials["username"];
        $this->password = $credentials["password"];

        $this->ft_conn_id = ftp_connect($this->host);
        if ($this->ft_conn_id) {
            echo $this->success_msg("connection");
            $this->ftp_innlogging = ftp_login($this->ft_conn_id, $this->username, $this->password);
            if ($this->ftp_innlogging) {
                echo $this->success_msg("innlogging");
            } else {
                echo $this->showErr();
            }
        } else {
           // echo $this->ftp_conn_err(); Bu sekilde yapabilirz ama hata sinifimizi disarda kendi hata sinifimzi tanimlayarak da yapabiliriz
           throw new FTPException($this->ftp_conn_err());
        }
    }

    private function ftp_conn_err()
    {
        return die("Your ftp connection is failed with your host: " . $this->host);
    }


    private  function showErr()
    {
        $error = error_get_last();
        if (isset($error["message"])) :
            return $error["message"];
        endif;
    }

    private function success_msg($item){
        $message=sprintf("Your FTP %s is successfull",$item);
        return $message."<br>";
    }

    //FTP-CONNECTION-LOGGIN ISLEMLERI BURAYA KADAR
//Sonrasinda class icinde hazirlayacagimiz fonskyonlar
//1-Herseyden once hangi directory de calisacagz onu belirleyelim her zaman ki yapacagmiz islemi nerden yapacagimz belli olsun
    //Burda su mantigida anlayalim..C# da get ve set methodlari kendi icerisinde mevcuttu zaten, ki bu C# a has birseydir ama java gibi php gibi diller de ise getter ve setter fonksiyonlarimizi knedimiz olusturarak, private verilen proeprtieslerimiz uzerinden encapsulation islemini cok daha effektif bir sekilde ele alabiliriz bu sayede...yaptigimz islemleri ne icin ve hangi amacla yaptigmiizi bilmek bize cok sey katacaktir
    public function setDirectory($directory){
        //Directory ye disardan  gelen directory yi atayacagiz eger disardan bir deger gelirse
        ftp_chdir($this->ft_conn_id,$directory);
    }

    //BESTPRACTISE...DEFAULT PARAMETRE DEGERI VERMEK.BU COK ZAMAN IHTIYACIMI OLACAK,DEFAULT DEGER VERMEK...VE OLMAMA DURUMUNU VEYA PARAMETRE VERILMEME DURUMUN HER ZAMAN DUSUNMEK....
    public function getDirectory($directory="."){
        
        $files=ftp_nlist($this->ft_conn_id,$directory);
        if(!$files){
            return $files;
        }//istersek else ile devam edip kendimiz bir hata mesaji donebiliriz olmayan bir klasor icindeki dosya ve klasorler listelnmek isterse...Php kendisi bir hata mesaji dondurmedigi icin biz de ekstra birsey yapmadik
        else{
            throw new FTPException("There is no files or folders under directoryname: ".$directory);
        }
    }

    //KULLANACAGIMZ PHP MEHTODLARI PARAMETRE OLARAK NE ALACAK ISE BIZ DE ONLARI KENDI FONKSIYONUMUZ DA PARAMETRE OLARAK DUSUNEREK ONLARI, DISARDASN ALACAGIZ

    public function rename($oldName,$newName){
        $ftpRename=ftp_rename($this->ft_conn_id,$oldName,$newName);
        if(!$ftpRename){
            throw new FTPException("Your renamechanging is failed");
        }
        return true;//Hersey yolunda demektir
    }

     public function delete($file){
        $file_del=ftp_delete($this->ft_conn_id,$file);
        if(!$file_del){
            throw new FTPException("Your delete process is failed");
        }
        return true;//Silme islemi gerceklesiyor ise true donsun diyoruz
     }   

     public function makeDir($dirName){
        $create=ftp_mkdir($this->ft_conn_id,$dirName);
        if(!$create){
            throw new FTPException("Your file-creation is failed");
        }
        return $create;
     }

     public function removeDir($dirName){
           $remove_dir=ftp_rmdir($this->ft_conn_id,$dirName);     
        if(!$remove_dir):throw new FTPException($this->showErr());
     else:
        return true;
     endif;
     }

     public function upload($local,$remote){
      
       $upload= ftp_put($this->ft_conn_id,$remote,$local,$this->mode);//self::FTP_MODE(bunu biz yukarda const olarak tanimlayip FTP_BINARY yi verdik const degeri olarak) self::FTP_MODE=FTPManager::FTP_MODE ile ayni seydir
       
       //self::FTP_MODE(bunu biz yukarda const olarak tanimlayip FTP_BINARY yi verdik const degeri olarak) self::FTP_MODE=FTPManager::FTP_MODE ile ayni seydir
       //const olarak tanimnladimgiz icin  FTP_MODE u yarin oburgun degistirmemiz gerektginde degistiremeyiz ondan dolayi biz consttan publice ceviririrz..Dikkat edelim bu degstirebilir olmasi icin..public yaptik ki mode un duruma gore farkli sonuclar elde edilebilsin diye
       if(!$upload):throw new FTPException($this->showErr());
     else:
        return true;
     endif; 
    }

    public function download($local,$remote){
        $download=ftp_get($this->ft_conn_id,$local,$remote,$this->mode);
        if(!$download):throw new FTPException($this->showErr());
    else:
        return true;
    endif;
    }

//REMOTE-SERVER DAKI BIR DOSYA ICERIGINI FTP PROTOKOLU ARACILIGI ILE TARAYIMIZDA ICERIGINI GORMEK
    public function read($remote)
    {
        //php://output yazilabilir bir akis olusturuyor ve sunucuya gonderiyor
        //Suncu da bunu istek yaptigmiz tarayiciya iletiyor
        //Karsi taraftaki dosyanin degerlrini, yani uzak remote server daki dosya degerlerini server a iletiyoruz php_//output ile ve server da istek  yaptigmiz bu tarayiciya geri ilettigi icin bizim ekranimizda bu dosyanin degerlerini gorecegiz
        //Ama problem su ki ekrana echo ile yazdirmasak da yine de ekrana basiyor, okuyor uzak-remote-serverdaki dosyamizi
        //ondan dolayi, bu yuzden bu ciktiyi skstiracagiz yani tamponlayacagiz
        //ob_start(); i baslatiriz ve islemimiz bitince de obgetclean() ile temizleyecegiz
        ob_start();
        $read=ftp_get($this->ft_conn_id,"php://output",$remote,$this->mode);
        $output=ob_get_clean(); //diyerek ben ne zaman istersem o zaman goster demis olyoruz
        return $output;
    }

}

try {
    //constructor da baglanti problemi durumunda Exception firlatacagizm icin class dan instance olustururken yani constructor i invoke ettigmizde hata firlatma durumu soz konusu oldugundan bu ani, yani constructor in invoke edilmesini try-catch icerisinde ele alacagiz
    $ftp = new FTPManager(
        [
            "host" => "185.215.199.212",
            "username" => "ademtest",
            "password" => $password
        ]
    );
    $ftp->setDirectory("./public_html");
    //"./public_html", ./ icinde bulundugmuz klasorun altindaki demek ./public_html icinde bulundgumzu klasorun bir altindaki public_html klasoru demektir...COOOOOK ONEMLI....
   // $ftp->getDirectory();//bu calistiginda eger burda bir hata meydana gelir ise o zaman burdan direk catch bloguna atlayacak ve try da o satirin altindaki diger kodlari calistirmayacaktir
   // print_r($ftp->getDirectory());//Burasi bize public_html altindaki dosya ve klasorlerimizi bize verecektir
   // $ftp->rename("adem_image.jpg","ademm_image.jpg");
   // $ftp->delete("./test");Your delete process is failed-olmayan bir dosyayi silmeye calistigmz icin hata aldik
   // $ftp->delete("test.txt"); test.txt olusturup sildik bu sekkilde
   // echo $ftp->makeDir("adem_testt");
   // $ftp->removeDir("adem_testt");
   echo $ftp->upload("zehra.txt","zehraaaaa.txt");
  //$ftp->download("zehram.txt","zehraa.txt");
  // echo $ftp->read("zehraa.txt");//Bize uzak ftp de okudugumuz dosyanin icerigini tarayicidaki ekranimiza gonderdi...
   $ftp->read("zehraa.txt");//Artik echo yapmayinca ekrana basamiyor cunku biz, skstirma veya tamponlama yaparak biz istedigmz zaman yap dedik
   //Eger verdigmiz bir dosya altinda yuklemek istersek, uzak remote taki servermiza o zamn o dosya a 


} catch (FTPException $e) {
    echo $e->getMessage();//direk Exception icindeki methodu alabilirz
   // echo $e->get_err_msg();//Istersek kendi methodu ndann da hata mesajini alabiliriz
    
}

/*
Yapacagimiz islem sudur
class imizi baslatirken constructor a bazi parametreler gonderecegiz
bunlar genellikle baglanti ile ilgli paramtreler olur

*/
