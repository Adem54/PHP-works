<?php 

//Formumuzda girilen verileri sayfa yenilenmeden ajax teknigii ile php dosyasina gonderip orda veritabanina kaydedip eger 
//islem basarili ise basarili degil ise de hata mesajini geri front-end e gonderecegiz

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="appp.js"></script>
    <title>Document</title>
    <style>
        #success{
            padding: 10px;
            background-color: green;
            color: #fff;
            display: none;
        }
        #error{
            padding: 10px;
            background-color: red;
            color: #fff;
            display: none;
        }


    </style>
</head>
<body>
   
    <!--
    Form gonderme islevini durdurumak!    
    form attributune onsubmit='return false;'  dersek artik forma submit butonuna tiklansa da form gonderme islevi yapmior bunu biz normalde onSubmit te preventDefault methodunu uygulayarak yapiyorduk
Peki neden kaldirdik biz bu ozelligi cunku biz bu islemi jquery kisminda yapacagiz
-->

<div id="success"></div>
<div id="error"></div>
    <form action="" id="contact-form" method="POST" onsubmit="return false;">
        Name-surname: <br>
        <input  type="text" id="namesurname" placeholder="Name-Surname" name="namesurname"><br><br>
        E-post  <br>
        <input type="text" id="epost" placeholder="E-post" name="epost"> <br><br>  
        Message: <br>
        <textarea name="message" id="msg" cols="30" rows="10"></textarea> <br><br>
        <!--
        BESTPRACTISE...
        Biz ajax.php de index.php deki form isleminin olup olmadigini yani, formun gonderilip gonderilmedigni anlamak icin type ini hidden yaptimgz inputu kontrol edebiliriz  
        type submit olan input un submit olan name ini n gonderilip gonderilmedginden anlayacagiz cek edebilecegiz, yani form butonunun tiklanip tiklanmadingi kontrol edebiliriz..
        BESTPRACTISE...BUNLAR COK CA KULLANILIYOR...DIKKAT EDELIM..COK ISMIZE YARAYACAK....BESTPRACTISE....
        ajax.php de form butonuna tiklanmis mi tiklanmamis mi diye
        Biz 2  yontem ile ajax.php de form butonuna tiklanmis mi tiklanmamis mi diye kontrol edebiliriz..yani formun gonderilip gonderilmedignin kontrol edebiliriz 1.si type i hidden bir input elementi olusturarak ve attribute de name e submit, value="1" veririz ki deger in gittigni anlayalim bir de bunu biz sirf submit butonuna kullanici tiklamis mi tiklamamis mi onu check etmk icin yaptgimz icin type i hidden yapariz altta yaptigimz gibi.
        Aslinda biz app.js de form dan gelen  let formData=$("#contact-form").serialize();
     console.log(formData); form icindeki inputlari kontrol ederken submit butonuna tiklayinca hic bir alan doldurulmasa bile biz namesurname=&epost=&message=&submit=1 bu sekilde form butonuna tiklandigi zaman, tiklanildigini type i hidden yaptgimz input sayesinde anlayabiliyoruz
        2.si de app.js de, ajax.php ye data gonderirken o datayi ek olarak bir '&type=contact' seklinde formData+&
        type=contact yaparak bunu gidip ajax.php de kontrol 
        edebiliriz...BESTPRACTISE...
          $.post("ajax.php",{...form_data+"&type=contact"},(response)=>{
          EVET BU TARZ COZUMLERE PHP DE ZAMAN ZAMAN BASVURACAGIZ, OZELLIKLE BAZI SAYFALARA GIRIYORUZ AMA ORAYA GIRDGIMZ DURUM ILE ILIGLI IF LOGICI YAZMAK ISTIYOR AMA O SAYFA GIRDIGMIZ ZAMAN I NASIL SORGULAYACAGIMZI BILMIYORSAK ISTE BOYLE DURUMLARDA HEP BU MANTIGI DEVREYE SOKARIZ O SAYFAYA GIRILDIGINDE BIR GET REQUEST INE &TYPE="" EKLERIZ VE SONRA DA HEMEN $_GET VEYA $_POST ILE SORGULAYABILIRZ TYPE DIYE BIR KEY IN VAR MI DIYE...  
         ajax. da isset ile check edip de post istdginde neler gonderilmis gormek istersek

           if(isset($_POST["form_data"])){
           print_r($_POST["form_data"]);
            form alanlarini doldurup da submit yapinca inspect yaparsak ve ajax.php post request ini network menu sunden incelersek data nin ajax.php den alinip response unda ne oldgunu gorebiliriz ajax.php de yazdgimiz echo ya gore
         namesurname=as&epost=asd&message=fdsasdfsa&submit=1&type=contactform-data geldi 
    -->
        <input  name="submit" value="1" type="hidden"/>
        <button id="submit-btn"  type="submit">Submit</button>
    </form>
</body>
</html>
<!--
Eger bir form icerisinde bir button type olarak submit ise buna tiklaninca bu otomatik olarak formu komple submit eder yani gonderir

 -->