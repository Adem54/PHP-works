<?php

//POST DEGERLERI GELMIS MI CEK EDELIM

//Kategori adi gonderilmis ve bos degil ise
//Yan yana ve ile kullanmanin dez avantaji dogrudan kullaniciyi hataya gore yonlendirmede zorluk yasayabiliriz
//Onun icin && ile yanyana kullanmak yerine ic ice kullanacagiz
if(isset($_POST['name'])){
    if(empty($_POST['name'])): echo "Please, fill inn category field";

        
else:
    //Kategori alani bos degil ise
    //KATEGORI EKLE
    $query=$db->prepare("INSERT INTO CATEGORIES SET NAME=:NAME");
    $add_category= $query->execute([":NAME"=>$_POST['name']]);
    //BESTPRACTISE..INSERT ISLEMINDEKI EXECUTE I EGER BIR DEGISKENE ATARSAK ISLEM BASARILI ISE 1-TRUE BASARILI DEGIL ISE 0-FALSE VERECEKTIR
    //BUNU BILELIM..YANI SADECE SELECT ISLEMLERINDE BIZ ISLEMIMIZI DEGISKENE ATAYIP DA CEK ETME ISLEMINI YAPMIYORUZ BU ISLEMLERI BIZ AYNI ZMANDA
    //INSERT-UPDATE-DELETE DE YAPABILIRZ ISLEMIN BASARILI BIR SEKILDE GERCEKLESIP GERCEKLESMEDIGINI CHECK EDEBILMEK ICIN
    if($add_category){
     header("Location:index.php?page=categories");
    }else {
     echo "Category is not added";
    }

endif;
}

?>


<!-- action hic yazilmaz veya action value si bos birakilir ise o zaman bu submit islemminde
 post degerlerinin icin de bulundugu sayfaya gidecegini gosterir -->
<form action="" method="POST">

        CategoryName: <br>
        <input type="text" name="name"><br><br>
        <button type="submit">Submit</button>

</form>