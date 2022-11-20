<?php 

/*
Film sitelerinde alt yazilar dosyalar icerisinde tutuluyor ve cok fazla dosya olabilir ve biz bunlari yuklerdekn zipleyip de yuklememiz gerekecek ve kullanicilar bu zip dosyalari indirirkende onlara zip dosyalarinin iceriginde neler var gostrememiz gerekebilir ondan dolayi bu cok onemlidir
*/

function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}

$zip=new ZipArchive();

if($zip->open("front-end.zip")===true):
    // $zip->addFile("adem.txt","ademm.txt");
  //  echo $zip->getFromName("adem/style.css");//Dosya icerigini dondurup ekrana basacak
    //:root,* { margin: 0; padding: 0; box-sizing: border-box; }
    //getFromName ile zip dosyasi icerisindeki herhangi bir dosyanin icerigine erisebiliyoruz
 //  echo "<br>";
//    echo $zip->getFromName("adem/WebOblig2/index.html");//Dosya icerigini dondurup ekrana basacak

//Birde statIndex methdu ile yine daha farkli detaylar alabilirz zip dosyasi icindenki dosyalarla ilgili

$firstFile=$zip->statIndex(1);//Burda index vererek 0,1,2 diye tum dosyalarin detayini gorebilirz
//print_r($firstFile);
/*
statIndex methodunu kullanarak zip icindeki 
{
name: "adem/WebOblig2/HCIforklaringsfilen.docx",
index: "0",
crc: "1146611276",
size: "14356",
mtime: "1665759066",//zipleme tarihi
comp_size: "11625",
comp_method: "8",
encryption_method: "0"
}
*/

//Ama biz bu islemi manuel olarak yapmamiz dogru olmaz ondan dolayi zip dosyamiz iceriisndeki tum dosyalarin detaylarina eriselim o zaman dinamik bir sekilde eriselim o zaman
//echo $zip->numFiles;//Bize zip icerisinde bulunan dosya sayisini veriyor
$length_total_files=$zip->numFiles;
for ($i=0; $i <$length_total_files; $i++) { 
       $stat=$zip->statIndex($i);
     //  print_r($stat);//Bu sekilde de her dosyamiz icin, dosya bilgilerini iceren bir dizi donuyor 
      echo $stat["name"]."(" .formatSizeUnits($stat["size"]).")(".date('Y-m-d H:i:s',$stat['mtime']) .")"."<br>";//Bu sekilde zip dosyamiz icerisindeki tum dosyalarin name ini alabiliriz, aslinda pathini aliyoruz..
      //Gelen data icerisinde bellekte ne kadar yer kapladigi da bulunmaktadir bunun icinde biz bir fonksiyon olusturup o fonksiyona parametre olarak uzunluk burda bize gelen data icerisinden size i paramtreye verirsek kac kb a karsilik geldigini bulabiliriz
      /*
        adem/WebOblig2/HCIforklaringsfilen.docx
        adem/WebOblig2/Readme.docx
        adem/WebOblig2/Sale.html
        .
        .
        adem/style.css
        adem/test.html
      */
}
    $zip->close();

    // echo "File is added";
else:
    echo "File is not added";
endif;


?>