<?php 

//httponlyCookie
//Ornegin diyelim ki oldu da Xss-cross site script ile yani javascript kodu gondererek input alalarimiza cookiee lerimizden bilgileirimizi calmaya calistilar, boylo durumlarda zaten filtreleme yapacaktik ama ayrica da eger cookie kullanacaksak da o zaman httponlycookie leri kullanmalyiz normal cookielere gore cok daha guvenli olduklari icin, bu sekilde de javascript kodu yazilarak xss-cross-site-script ile cookie lerimizin calinmasinin onune gecebiliriz

setcookie("password","12345",strtotime("+1 day"));//1 gun kalacak olan bir cookie olusturduk ornegin
//Burda biz normal bir cookie ekledik ve bu cookie ye direk javascript kodu ile erisilebiliyor
//document.cookie bu sekilde o chrome tarayicisindan tum cookieleri alabiliyoruz javascript ile bu sekilde bu da disardan tehlikelere acik hale getiriyor

//Ama eger setcookie yi kullanirken 
setcookie("password2","12345678",strtotime("+1 day"), "/",null,null,true);//time dan sonra path=/,domain=null,security=null en son kisma da yani httpOnly kismina true dersek o zaman
//Yine bunu tarayicida application da cookies kismindan gorebiliriz bu httponlycookie kismi true yaptik bunun yukardakinden yani normal cookiden farki application da http kolonunda httponly kismini true yaptgimiz da bir tik isareti goruruz
//Ayrica da httponlycookie mize javascript ile erisilemiyor document.cookie yazarak bu httponlycooki mize erisilemiyor ve bunu sadece biz php ile server tarafinda alabilecegiz... iste bu yuzden her zaman httponlycookie kullanalim normal cookie yerine

?>