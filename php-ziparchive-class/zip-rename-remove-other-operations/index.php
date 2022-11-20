<?php 

//ZIP ICINDEKI DOSYA ISIMLERINI DEGISTIRMEK
//ZIP ICINDEKI DOSYA ISIMLERINI SILMEK
$zip=new ZipArchive();
if($zip->open("front-end.zip")===true){
    //index uzerinden zip icindeki dosya ismini degistirmek
$zip->renameIndex(0, "adem/WebOblig2/forklaring.docx");
//Isme gore zip icindeki dosya ismini degistirmek
$zip->renameName("adem/WebOblig2/Sale.html","adem/WebOblig2/Salg.html");

//Delete islemleri
//deleteName
$zip->deleteName("adem/test.html");
//Index
$zip->deleteIndex(($zip->numFiles-1));//Her seferinde en sonuncu elementi siliyor

//Bu arada eger dizin silmek istersek yani directory yani folder yani klsor silmek istersek o zamn
//eger ici bos ise silmeye izin verir eger icerisinde dosyalar var ise silmeye izn vermeyebilir

    $length_all_files=$zip->numFiles;
    for ($i=0; $i <$length_all_files ; $i++) { 
        $stat=$zip->statIndex($i);//Her bir dosyaya ait detay bilgileri dizi icinde aliyoruz burda
        echo $stat["name"]."<br>";
    }

    $zip->close();
}else{

}



?>