<?php
//Cookies
//Session lari biz olusturudugmuzda eger tarayici kapatilirsa session lar yok oluyor
//Ama cookies de bunlar kullanici tarafinda olusturuldugu icin, tarayici kapansa bile kullanici tekrardan tarayiciyi actiginda o cookies ler i kullanabilyor   

//Cookies leri nasil olusturuyoruz
//setcookie() fonksiyonu var ve bundan sonra da 
//$_COOKIE degiskeni ile cekecegiz bu datalari
//setcookie("website","udemy",time()+20);//key:value mantigindadir...
//setcookie("website2","udemy",time()+20);//key:value mantigindadir...
//3.paramtre time degiskenidir ve cookie nin gecerlilik suresini belirtir
//time() su anki tarihi verir ve +10 demek su anki andan itibaren 10 saniye gecerli olsun demektir


/*
Default olarak gelen cookie ler var birde...
{
website: "udemy",//biz setcookie diye olusturduktan sonra sayfayi calistiririz ardindan ise, setcookie yi kaldirirz ki her sayfa yenilendiginde tekrar tekrar cookie olusturmasin....ve 20 saniye sonra bizim olusturudugmuz cookieler gitmis olur
website2: "udemy",
_ga: "GA1.1.1641642320.1667434247",
__gads: "ID=a3fad5f5bc8a4506-22c898a163ce0001:T=1667434245:RT=1667434245:S=ALNI_MbQrLR1rHp90CqL2cCKYnJoBm9rPA",
__gpi: "UID=00000b7bbe8c9894:T=1667434245:RT=1667434245:S=ALNI_MYVNZPkjCZlt4zSJu5r8AR2HfQuiw",
PHPSESSID: "3fb6718i3vf4aato7dpb75qd04"
}
*/

//PEKI COOKIE LERIMZIN 1 GUN BOYUNCA TUTULMASINI ISTERSEK O AMAN TIME()+ 1 GUN KAC SANIYE ISE ONU YAZARIZ

//setcookie("name","Adem",time()+84600);//1gunluk cookie, 1 gun boyunca bu datayi tutacak
//setcookie("name","Adem",time()+86400*30);//1 aylik cookie, 1 gun boyunca bu datayi tutacak
//Bu cookieleri tarayicimizda inspect yapinca application altinda cookies da bu datlari goregbilirz ve de expire tarihini de gorebilecegiz
//Bu cookie nerde olusuyor kullanici pc sinde olusuyor ve kapatsak bile cookie gecerliligini surdurebilirz
//Ancak biz diyelim ki, olustrduk ve zamani ni da uzun tuttuk ama silmek istiyorz ne yapariz o zaman
//php de dogrudan  silme fonksiyonu olmadigi icin, biz tekrardan setcookie fonksiyonunu ayni degerler ile sdece time i gecmis tarihe girersek o zaman zaten gecerliligini yitirecek ve silinmis olacak
//setcookie("name","Adem",time()-3453);

print_r($_COOKIE);

//NEDEN COOKIE KULLANIRIZ...BAZEN KULLANICILAR ICIN BAZI DEGERLERI TUTMAMIZ GEREKEBILIYOR O TARZ DURUMLARDA KULLANABILRIZ
?>