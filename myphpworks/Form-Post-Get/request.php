

<?php 
//Biz degerleri post ile de gondersek, get ile de gondersek request ile degerleri alabiliyoruz

//Form elemntleri doldurulup submit yapilirsa url de biz 
//http://localhost/PHP-works/myphpworks/Form-Post-Get/request?search2=zehra+erbas&search3=zeynep+erbas
//Ayni getteki gibi bu sekilde girilen degerleri key=value mantiginda aliriz ve datalar arasinda & olmalidr
//ayrida php dosyamizin sonrasinda ? ile baslar key=value ile girilen datalar burda key name attributu ne ise odur
//print_r($_REQUEST);

/*

{
search2: "zehra erbas",
search3: "zeynep erbas"
},
Bu sekilde biz get requesti yakalamis oluyoruz
Peki method post olsa idi ne olurdu
o zaman tabi ki url de herhangi birsey goremeyiz ancak yine post requestimizi de biz
$_REQUEST ILE yakalayabiliriz

form action i bos birakir veya hicbirsey yazmaz isek o zaman default olarak ayni kendi sayfasina gonderir datalari
eger form action i <form action="request.php?id=3" method="post"> boyle yaparsak url de 
YANI BURDA YAPILAN ASLINDA HEM GET PARAMETRESI OLAN ID YI GONDERIP HEM DE POST METHODU NU UYGULAMAK OLUYOR
http://localhost/PHP-works/myphpworks/Form-Post-Get/request.php?id=3
ve yine gonderilen datalari post requesti yakalayabiliyoruz....$_REQUEST ILE
DIKKAT EDELIM...URL DEKI ID YI DE ALABILIYORUZ
{
id: "3",
search2: "zehra erbas",
search3: "zeynep erbas"
},

GET VEYA POST AYIRT ETMEKSIZIN HER GELEN DEGERI $_REQUEST ICERISINDE ERISEBILIYORUZ... 
EGER DATAYI REQUEST ILE ALMAK ISTERSEK GET VE POST ISLEMLERIMIZDE YAPTIGMIZ ZAAFIYET ISLEMLERININ AYNISINI REQUEST ILE DATA ALIRSAK  ORDA DA
BUNU YAPABILIRIZ

*/


function form_filter($request){
    return is_array($request) ? array_map("form_filter",$request)  : htmlspecialchars(trim($request));
    //Burda su cook onemli kullanici html yazamamasi gerekir...cok onemlidir
   }
   
   $_REQUEST=array_map("form_filter",$_REQUEST);

//PHP de biz isset ile data nin var olup olmadigini kontrol ederiz cunku php de data nn var olup olmadigini 
//ornegin direk dizi icinde var mi diye kontroll etmeye caliisr isek eger data gelmez ise hata aliyoruz
function request($name)
{
    if(isset($_REQUEST[$name]))
    return $_REQUEST[$name];
};

//http://localhost/PHP-works/myphpworks/Form-Post-Get/request.php?id=3
//Burda ?id=3 de  id name i temsil eder 3 de ona kullanici tarafindan atanan degeri...
echo request("id");
echo request("search2");
echo request("search3");
echo "</br>";

//BU ARDA SUNA DIKKAT EDLEIM POST METHODU ILE GONDEIRLMIS BIR DATAYA GIDIP DE $_GET ILE ERISEMEYIZ
//AMA URL E YAZILAN ID GIBI DEGERLER ZATEN GET METHODU ILE GONDERILDGI ICN ONA HEM GET ILE HEM DE POST ILE
//ERISIRIZ....
//echo $_GET["search2"];//burda bu dataya erisemeyiz cunku, search2 post methodu ile gonderilmistir ancak, get ile almaya calisiyourz..
echo $_GET["id"];//ama id dersek erisebilirz url de yazildigi icin get requesttir

//REQUEST KISACAASI HEM GET HEM DE POST ILE GONDERILEN DATALARIN HEPSINE ERISEBILMEMIZI SAGLAR


?>

<form action="request.php?id=3" method="post">

Search:

<input type="text" name="search2">
<input type="text" name="search3">

<br/>
<button type="submit">submit</button>
</form>

