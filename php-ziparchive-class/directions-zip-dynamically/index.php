<?php 
//TUM DIZIN VE ALT DIZINLERDEKI DOSYALARI DINAMIK OLARAK SECEREK ZIPLEMEK
//EGER KARSIMIZA DIZI VE ICERISINDE VALUE SIDE YINE DIZI OLAN VE IC ICE BU SEKILDE NESTED BELKI 3-4 KADEME VEYA SEVIYE IC ICE GIDEN YA DA DAHA DA DA KARMASIK DURUMLAR ILE KARSILASABILIRIZ BIRDE AYNI MANTIKTA BIR DOSYA VE KLASOR ALTINDA BIRCOK HEM FILE, HEM DE DIRECTION(FOLDER) OLABILIR VE ONLARIN DA YINE KENDI ALTLARINDA FILE VE DIRECTORY LER OLABILIR BU DA AYNI MANTIKTA BELKI 3-4 KADEME,SEVIYE NESTED OLARAK DOSYA VEYA DIZINLERIMZ OLABILIR HATTA YERINE GORE DAHA FAZLA OLABILIR VE BIZ KLASORUMUZ ALTINDAKI DOSYA VE DIZINLER VE ONLARIN ALTLARINDAKI TUM DOSYALARI BIR PROCESS DEN GECIRMEK ISTIYORUZ ORNEGIN AMA ISTIYORUZ KI HICBIR DOSYAYI DISARDA BIRAKMASIN IC ICE NE KADAR DOSYA VAR ISE HEPSINE BU ISLEMI UYGULASIN ISTE BOYLE BIR DURUMDA DA YINE KARSIMIZA COZUM OLARAK RECRUSIVE FUNCTIONS LAR CIKIYOR....HARIKA MUKEMMEL BIR SEKILDE ISMIZI GORURLER...


//Recrusive fonksiyonumuzu yazalim oncelikle

function get_directory_list($dir){
    static $files=[];//BESTPRACTSE..Her fonksiyon invoke edildiginde yeni bir dizi olusturmuyor eger daha once hic yok ise 1 kez olusturur, birkez olusturduktan sonra her seferinde o diziyi kouruyor ve ayni dizi icerisne isleme devam ediyor ve bu sayede biz her fonksiyon invoke ettigmizde o dizinin en son invoke edildigi fonksiyon icerisinde maruz kaldigi islemi guncel olarak almis oluyoruz....Static array olusturuyoruz cunku, her fonksiyonmuz calistiginda bu array sifirdan baslamak yerine bu fonksiyon bir onceki invoke edildginde icinde hangi degerler var ise onlari ile gelsin onlari korumus olarak gelsin neden cunku biz nested directionlarimiz alt alta gittikce her birinin altindakikleri almak icin get_directory_list recursive fonksionunu belkide birkac kez ya da daha fazla invoke edecegiz ve bu fonksiyonun bricok kez invoke edilerek kullanilmasi aslinda yine total de tek bir islem yapiyoruz ama ayni fonksiyonu belki 4-5 kez calistiriyoruz ve bu fonksiyonlarin 1.kez invoke edilmesi ile en son invoke edilmesi arasinda baglanti var ve ayni datanin her invoke ediliste kaldigi yerden devam etmesi gerekiyor ..iste static olarak diziyi bu fonksiyon icinde tanimlamamai bize boyle bir bestpractise kazandiriyordu..Iste static olarak diziyi tanimalamanin gercek hayatta kullanilmasi tam da bu sekilde olur..
    $files_and_dirs=glob($dir);
    foreach ($files_and_dirs as $file) {
        if(is_dir($file))//directory olup olmadigini kontrol et, eger directory ise o zaman da 
            get_directory_list($file."/*");
        else
            //Eger dizin degil de dosya ise o zaman $files[] dizimizin icerisine atiyoruz
           // $files[]=basename(__FILE__)!==$file ? $file : null;
           if(basename(__FILE__)!==$file):
            $files[]=$file;
        endif; 
           
           //uzerinde bulundugmuz dizini eklemesin diyoruz
         
    }
    return $files;//Burda verilen $dir olarak veirlen path altindaki tum dosya ve klasor-dizin(directory) altindaki dosyalar ve onlarin da altindaki direciton larin altindaki dosyalari hepsini bu dizi de isimlerini alabiliyoruz..O zaman artik ismiz kolaylasti biz bu fonksiyonu foreacc icerisnde dondurup icindeki dosyalari tek tek alarak her birinisin zip islemine dahil edebilriz

}
// echo "<pre>";
 //print_r(get_directory_list("adem/*"));//Ilk baslarken, adem ismindeki ana klasorumuzden baslamasni istiyoruz
//glog("adem/*) ademklasoru altindaki tum dosya ve klasorleri al,
//glob(adem/*.php) adem klasoru altindaki tum php dosyalarini al demektir

$zip=new ZipArchive();
 $zip->open("front-end.zip",ZipArchive::CREATE);
//  $zip->addFile("assets/flowers.jpg","myflowers.jpg");
//  $zip->close();

$all_files=get_directory_list("adem/*");

 // $files=glob("*");
foreach ($all_files as $file) {
 //   if($file!=basename(__FILE__))://uzerinde bulundgumuz index.php yi haric birak demis oluyoruz, bu kontrolu usstteki islemde yapiyoruz
      
      //  echo is_dir($file) ? $file."<br>" : null;
        
       $zip->addFile($file);
   // endif;
}

 $zip->close();

//Bir fonksiyon yazalim, parametrede default deger olarak icinde bulundugu klasor altindaki dosyalari 
//verecek, bir path adresi verelim...__DIR__ gibi...sonra da icinde bulundgumuz directory deki dosya ve direction lari listeleyerek eger dosya ise direk zip dosyasina atsin, yok directory ise de o zaman icinde bulundugu fonksiyonu bir daha invoke derek(recrusive func), parametreye o directory ismini ver ve o directory altindaki dosyalari da check edip onlari bu sefer de ziplesin..

?>