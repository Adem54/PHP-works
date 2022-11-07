<?php 

/*
Sessionlar oturum bilgilerini saklamak için kullanılan yapılardır. Hepimiz illa ki bir siteye üye olup giriş yapmışızdır. İşte giriş yaptığımız sırada kullanıcı adımız ve şifremiz kontrol edilir. Eğer doğruysa bilgilerimiz session'a atanır. Bu en basit örneğiydi daha bir çok alanda kullanılabilir.
Session'lar sunucu tarafında tutulduğu için manipüle edilmesi zordur. Bu nedenle Cookie'lere göre daha güvenlidir.
Eğer kullanıcılar session'şarı silmezse (mesela üyelik girişi yaptıktan sonra çıkış yapmazsa gibi) tarayıcı kapandığı an session silinir.
Php session genellikle oturumları yönetmek, sayfalar arası veri göndermek için kullanılır.
Bir formda kullanici giris yaptigi zaman kullaniciya ornegin mesaj verilmek istendigi zaman success veya error mesaji o zaman kullanici datalari tabi database den de gelebilir ama session da da tutulup kullaniciya bilgi verirken kullanilaiblir hatta database islemini gerekli gereksiz heryerde yapmak istemeyebiliriz
Global bir değişkendir. Yani tanımladıktan sonra istediğiniz yerde kullanabilirsiniz.
Güvenlik olarak sunucu bilgisayarının güvenlik duvarını kullanılır.(cookies lere gore daha guvenlidir)
Session oluşturulduğu zaman; oluşturulan session bilgileri sunucu bilgisayarı üzerinde bir text dosyası içerisinde tutulur.
Kullanıcı oturum kapattığında, siz özel bir komut ile sildiğiniz de ve ya tarayıcı tamamen kapatıldığında silinir (tarayıcı arka planda çalıştığı sürece session tutulmaya devam edilir.).
Biz kendimiz session i zoraki silemmiz gerekir...yani ayni react-taki componentdidmount mantigi useEffect return durumu...yani session i ortadann kaldirmak icin unset veya destructur calistirmam lazim ki session ortadan kalksin cunku tarayici arka planda calistigi surece session silinmeyecektir
Çerezlerdeki (cookie) gibi süre ayarlayamazsınız.

Php Session ve Cookie Arasındaki Fark
Kullanım ve mantık olarak tamamen çerezler(cookie) ile aynıdır;

 Sessionlar sunucu bilgisayarında tutulur. Bu yüzden erişilmesi zordur, güvenliği daha yüksektir.
 Cookie ler kullanıcının bilgisayarında(tarayıcı dosyalarının olduğu yerde) tutulur. Bu yüzden erişilmesi kolaydır, güvenliği düşüktür.
 Sessionlarda zaman ayarı yoktur. Tarayıcı tamamen kapatıldığında, kullanıcı oturumu sonlandırdığında veya özel bir komut ile sildiğinizde silinir.
 Cookie lerde zaman ayarı vardır. Dilediğiniz zamana son kullanma tarihi verirsiniz ve o tarihe kadar verileri tutmaya devam eder. Son kullanma tarihi geldiğinde silinir.
 Sessionda kaydedilen değerin adı ve değer tarayıcıya gönderilmez. Onun yerine PHPSESSID adında bir çerez tanımlanır ve içerisine değer olarak ise şifrelenmiş ve oldukça uzun olan session id değeri atanır. Bilgileri bu şekilde sunucu bilgisayarında tutar ve girenlerin PHPSESSID kimliğine göre kime ait olduklarını bulur ve yeniden düzenler.
 Cookie lerde ise tanımlanan çerezin adı ve değeri tarayıcılara açıkca gönderilir. Bu değerler istenilen süre boyunca tarayıcıda açık bir şekilde saklanır.
Bu sebeplerden dolayı üyelik sistemleri, e-ticaret sistemleri, ödeme sistemleri gibi güvenliğin önemli olduğu noktalarda session kullanılması gerekmektedir hatta kullanımı zorunludur.
*/
//1-Bir oturum baslatmak icin session_start() fonksiyonunu sayfanin en basina yazmamiz gerekiyor
//session i ana php dosyamizda baslatmamiz yeterlidir diger dosyalarda da baslatmaya gerek yoktur tum uygulamada kullanilabilir 
//session i yazaagmiz dosya diger tum dosyalari da cagirdigmiz dosya olmalidir

session_start();//Session baslatiyoruz burdas
//herzaman session start tan once hicbir kod yazmamamiz gerekiyor cook onemli bunu bilelim....
//session i baslattiktan sonra artik bizm $_SESSION["user_name"]="Adem"; seklinde bir dizi degiskenimiz olusmus olyor
//Cannot modify header information-headers already sent by.....() Boyle bir hata alirsak session_start altinda obs_start() yapariz
$_SESSION["user_name"]="Adem";
echo $_SESSION["user_name"];
//ONcelikle biz session_start yapmadan session kullanamioruz
//2.si sessin baslattiktan sonra eger bir $_SESSION[""] dizisine bir data ekledi isek ve de daha sonrasinda session a ekledigmiz datayi silsek bile
//biz o datayi okyabiliriz yani $_SESSION["user_name"] diyerek kullanabiliriz cunku sesssoin server tarafinda girilen bilgileri bir dosya icerisine atip orda tutuyor bizim o degerleri session a yazilmasi iicn onlari 1 kez set etmmmiz yeterlidir daha sonra o set etme islemini kaldirask bile o data sessin dizisin icine yazilmistir ve artik onu yazildigi yerden okyabiliriz...YANI NORMAL VARIABLE MANTIGI GIBI DUSUNMEYELIM..
//SESSION ICERISINDE DATALARIMIZ NE ZAMANA KADAR TUTULUR TA KI BIZ SESSION I MIZI SONLANDIRANA KADAR...BUNU DA NE ILE YAPARIz
//SESION I TAMAMEN KALDIRMAK VE TEMIZLEMEK ISTDIGMIZDE SESSIN_DESTROY VEYA SESSION_UNSET() ILE BU ISLEMI YAPABILIRZ
//session_unset();
//session_destroy();
//PEKI NE ZAMAN YAPARIZ GENELLIKL SESSIN LARI  YOK ETME, KALDIRMA ISLEMINI OZELLIKLE KULLANICI LOGIN OLDU VE SONRA DA LOGOUT OLDU ISTE KULLANICI LOGOUT OLDUGUNDA BIZ SESSION DAKI BILGILERI SILERIZ...COOOK ONEMLI
/*
1-SESSION BASLATMALYIZ
2-SESSION DIZISI ICINE ELEMAN EKLEYEBILIYORUZ,SESSION DA DATAYI TUTMAK ISTEDGIMZ ZAMAN(LOGIN ISLEMLERINE COK KULLANLYOR)
3-SESSION DIZI ICINDE VAR OLAN DATALARI OKUYABILIYORUZ
4-KULLANICI LOGOUT OLDUGUNDA SESSION I SONLANDIRMAK ICIN YA SESSION_DESTROY, YA DA SESSION_UNSET KULLANIRIZ

*/

// $_SESSION["name"]="Zehra";
// $_SESSION["surname"]="Erbas";

session_destroy();
//session degeleerimizi ayri ayri tek tek olarak silmsk isdetimiz zaman bunu unset() parameresine silmek istedigmiz degerimizi  yazarak silebiliriz
//SESSION LARI KALDIRDIK AMA YINE DE DATALRIMIZ MEVCUT DURUYOR SILINMEMIS
//session_unset();//session_unset yapiyoruz ama hala datalarimiz silinmemis yani sesssion icine kaydettigmiz datalarimiz hala silinmemis

//AMA OZELLIKLE SILMEK ISTDIGMIZ DATAYI GELIP UNSET() ICINE YAZARSAK ISTE O ZAMAN SILEBILYORUZ...
//unset($_SESSION["name"]);


print_r($_SESSION);


?>