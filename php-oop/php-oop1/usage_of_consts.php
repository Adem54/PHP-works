<?php 
//define() ya da const ile sabitleri tanimiyoruz
class File {
    const DIRECTORY=__DIR__;//Su anda icinde bulundgumuz directory yi verirler
    //DIR,FILE
    public function getDirectory(){
        return self::DIRECTORY;
    }
    
}

class myFile extends File {

    public function getMyDirectory(){
        return parent::getDirectory();
    }


}


//constantlara biz class icinde self ile erisiriz disarda ise direk class ismi ile
//eririz...sinifi hic baslatmadan da direk class ismi ile erisiyoruz yani
//Ayrica turetilmis bir sinfdan baseclass taki const lara parent keywordu ile
//erisiyoruz
//  echo File::DIRECTORY;//C:\Users\ae_netsense.no\utv\test\php-oop\php-oop1
//__DIR__ DINAMIK ISLEMLERIMIZDE COK EFFEKTIF BIR SEKILDE KULLLNAMAMIZI SAGLAR...COK ONEMLI
$file=new File;
echo "filedirectory:   ".$file->getDirectory();
//Sabitlerin tanimlanip tanimlanmadigini defined() methodu ile kontrol edebiliyoruz
echo "<br>";
$myFile=new MyFile;
echo $myFile->getMyDirectory();
//subclass lar uzerinden base class taki sabitlere erisirken subclass icerisinden parent keywordunu ve parent:: syntaxini kullanarak erisirz




//PHP NIN KENDI ICERISINDEKI SABITLERI-PHP CONSTANTS
//__DIR__ O AN UZERINDE OLDUGMZU DIRECTORYI VERIR
//__FILE__ O AN CALISMAKTA OLAN PHP DOSYASININ ADINI VERIR
//PHP_VERSION PHP SURUMU
//__LINE__ BU IFADENIN YER ALDIGI SATIRIN SAYSINI VERIR
//PHP_OS PHP NIN CALISTIGI ISLETIM SISTEMI 


/*
Constants are Global
Constants are automatically global and can be used across the entire script.
*/


?>