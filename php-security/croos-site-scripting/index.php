<?php 

//Kullanicidan aldigimiz verileri eger filtrelemez isek kullanici bize bir javascript kodu gonderip bunu bizim sistemizde calistirabilir
//VE bu sayede bircok izni olmayan bilgiyi calabilirler
//En basitinden cookie lerde eger degerli bilgiler tutuluyor ise onlara erisip onlari elde edebilirler
//XSS-Cross site scripting
//<script>jskodu gonderilerek aciktan faydalanilmis olunuyyor</script>

if(isset($_POST["about"])){
   // echo htmlspecialchars($_POST['about']);
    echo ($_POST['about']);
}
//Ama chrome normal de  textarea ya kullanci gelir de 
/*
XSS ACIGI NEDIR NASIL  SISTEMIMIZ KORURUZ
<script>alert("hak yiyen hack yeri");</script>
bu sekilde bir javasscript kodu yazar ise bunun XSS acigi, tehdidi oldugu icin Cross site scripting oldugu icin chrome normalde bunu engelliyor ama bunu  farkli tarayicilarda bu engellenmeyebiliyor bu aciga karsi sistemi korumak icin htmlspecialchars fonksiyonu kullanilir yani bizim kullanicidan gelen datayi eger htmlspecialchars icine yazarsak kullanici textarea ya bir script bile  yazsaa Xss cross side scripting bile yazsa biz ona karsi sistemimizi korumus olacagiz,  yani kullanicidan gelebilecek script koduna karsi onlari kod olarak degil text olarak okutulmasini saglayarak sistemi korumus oluyoruz bu cok onemlidir , sistmeimize mudahele edilmesini engellemis oluyoruz
*/


?>

<form action="" method="post">
    About: <br>
    <textarea name="about" id="" cols="30" rows="10"></textarea> <br>
    <button type="submit">Submit</button>

</form>