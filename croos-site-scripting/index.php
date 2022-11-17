<?php 

//Kullanicidan aldigimiz verileri eger filtrelemez isek kullanici bize bir javascript kodu gonderip bunu bizim sistemizde calistirabilir
//VE bu sayede bircok izni olmayan bilgiyi calabilirler
//En basitinden cookie lerde eger degerli bilgiler tutuluyor ise onlara erisip onlari elde edebilirler
//XSS-Cross site scripting
//<script>jskodu gonderilerek aciktan faydalanilmis olunuyyor</script>

if(isset($_POST["about"])){
    echo $_POST['about'];
}


?>

<form action="" method="post">
    About: <br>
    <textarea name="about" id="" cols="30" rows="10"></textarea> <br>
    <button type="submit">Submit</button>

</form>