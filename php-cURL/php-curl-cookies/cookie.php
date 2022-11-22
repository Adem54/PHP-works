<?php 


echo $_COOKIE["test"];
//eger olmayan bir cookie yi yazdirmaya calisirsak biz 
//Warning: Undefined array key "test" boyle bir hata aliriz
//Bu sayfamizin bulundugu adrese bot yazan curl ile request olarak cookie gondererek, biz normalde tanimlamasak bile, curl ile request gonderince o boot yazdigi php den erisebilmis oldu



?>