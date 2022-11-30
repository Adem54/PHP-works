<?php 


try {
    //Normal yontem
   $link = mysqli_connect("localhost", "root", "", "link");
   
   
   $sql = "SELECT * FROM users";
   if($result = mysqli_query($link, $sql)){
       //$result obje donuyor
      $row_count=mysqli_num_rows($result);//Eger 0 dan buyuk ise demekki data vardir
       echo mysqli_num_rows($result);//tablodaki row saysini verir
      //Dolayisi ile eger gelen row sayisi 0 dan buyuk ise o zaman listele diyebilirz
      //if(mysqli_num_rows($result) > 0){}
      echo "<br>";
     // $data=mysqli_fetch_array($result);//Direk bu sekilde alirsak o zaman bize ilk karsilastigi satiri getirir ayni dosya okumadaki 
      //get ile yaptgimiz dosya satiri okuma gibi ve ondan dolayi while ile dosya sonuna gleene kadar calis deyip her donguder bir sonraki satir var mi kontrol edilerek yeni satir oldugu muddetce okumaya devam ediyordu
      //
      //print_r($data);
   //    var_dump($data);
   //Olayin ozeti su, mysqli_fetch_array($requery); parametreye mysqli_query($link, $sql) query baslattgimiz method ciktisini verirsek o zaman eger tabloya ya yapilan query ile data listesi var ise tablo da her invoke edildiginde ilk datadan baslayarak her invoke edildgiinde next, bir sonraki datayi dondurecek sira ile o zaman da ornegin biz mysqli_num_rows ile query den donen sonucumuzda kac data var onu alabilyoruz, o zaman datayi tek tek gormek icin  ya, ornegin 10 data gelmis ise query den 10 kez alt alta mysqli_fetch_array($result) yazarak tum datayi aliriz ,cunku her invoke da bir sonraki datayi veriyor, eger data yok ise false verir, ya da ne yapariz bu islemi while dongusu icinde yaparsak zaten cok daha pratik bu islemi yapmis oluruz
   //ach time mysqli_fetch_array() is invoked, it returns the next row from the result set as an array. The while loop is used to loops through all the rows in the result set. 
    //   while($row = mysqli_fetch_array($result)){ 
    //    var_dump($row["title"]);
      
    //    echo "<hr>";
    // } 
   
   }
   
   } catch (\Throwable $th) {
    //baglanti gerceklesirse false int(0) donuyor ama
   var_dump(mysqli_connect_errno());
   //Check connection different 
   if (mysqli_connect_errno()):	echo "ERROR CONNECTING TO DB !";
   else: echo "DB CONNECTION IS SUCCESSFULL"."<br>";
   endif;
}

?>