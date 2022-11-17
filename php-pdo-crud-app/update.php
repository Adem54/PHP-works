<?php //require_once "header.php"; index.php ye dahil ettigmiz icin burda zaten gozukecek ondan dolayi burda kullanmaya gerek yok?> 
<?php 

//BU BAKIS ACISI VE MANTIGI KAVRAMAMIZ GEREKIYOR....
//BIZ GET ICINE GELEN VEYA POST ICINE GELEN DATA LAR I IF ILE
// KONTROL EDEREK ORDAKI DATALARIN DURUMULARINA GORE SAYFA YONLENDIRMELERI
// REQUIRE_ONCE,INCLUDE,REUQIRE ILE YAPIORUZ PHP DE
//BURDA VERITABANINDAN GUNCELLEME ISLEMINI YAPACAGIZ...
//GUNCELLEME ISLEMINDE BIZIM NEYE IHTIYACIMIZ VAR, HANGI DATAYI 
//GUNCELLEYECEGIMIZI BILEMIZ GEREKIYOR 
//YANI BIZIM GUNCELLEYECEGIMIZ DATANIN ID SINI ALMAMIZ GERKEIYOR,
// YANI GUNCELLE SAYFASINA GET METHODU ILE ID NIN GONDERILMESI GEREKIYOR
//YANI GET METHODU NA ID NASIL GONDERILIYORDU DIKKAT EDELIM...
//ILLAKI FORM DAN DATA NIN METHOD GET VS YAZILMASINA GEREK YOKTU
//URL UZERINDEN DE ID ILE GELINEBILIYORDU PEKI URL UZEIRNDEN REDIRECT
// YAPABILMEYI HANGI HTML ELEMNTIN UZEIRNEN YAPABILYORDUK
//A ETIKETI ILE YAPIYORUZ..KI BUNU ZATEN FRONT-ENT DE REACT-TA TA BU SEKKILDE YAPILYOR AYNI SEKILDE....
//VE DE URL I A ICINDEKI HREF DE YAZABILYORUZ VE BIZIM DATAMIZI LISTELEDIGMIZ 
//SAYFA OLAN HOMEPAGE.PHP DE BIZ GUNCELLE A ELMENTININ HRFINDE TIKLANAN ID NIN ID SININ DE
//GONDERILMESINI SAGLAYACAGIZ...

//UPDATE TUTORIALS SET KOLON1=VALUE1UPDATED,KOLON2=VALUE2UPDATED WHERE ID=3....
//PREPARE ILE YAPACAGIZ....

//HERZAMAN GELMESINI BEKLEDGIMZ GET ILE ID,OLUR VEYA BASKA BIR DATA OLUR KONTROL ETMEDEN GECMEYELIMM..
//.PHP BIRAZ BURALARDA COK YOGUN DIKKAT EDILMESI GEREKEN BIR DIL
if(!isset($_GET['id']) || empty($_GET['id'])){//eger id gelmiyor ise ana sayfyaya yonlendirecek bizi
    header("Location:index.php");
    exit();
}else{
    //buraya kadar hic id GEt icine gelmemis ise yani tanimsiz ise, 
    //ve de gonderilmis ama bos gonderilmis ise bunu da kontrol ettik 
    //simdi de gelen id database de olmayan bir id ise onu kontrol edelim
    // ve yine eger gelen id database de olmayan bir id ise o zaman da yine onu ana sayfaya yonlendirelim...
    /*
    BESTPRACTISE...KONTROLLLERIMIZ--DATADETAIL-UPDATE-DELETE...ISLEMLREINDE..COOK ONEMLI...
    1-isset ile GET ICINE id diye bir key ile bir sey gonderil mis mi onu kontrol etttik
    2-isset kontrolunden gecen id key inin bos bir string olup olmadingi cek ettik empty methodu ile
    3-Simdi artik bir id value si bos olmayan bir id values i geldginden eminiz ama bu id
     nin bizim veritabnaimizda var olan bir id oldugundan emin olmamiz gerekir simdi de...
    */
    $id=$_GET['id'];//isseti gectim hata almayacagimdan eminim ondan dolayi degiskene atama y apiyoruz
    $query=$db->prepare("SELECT * FROM TUTORIALS WHERE id= ?");
    $query->execute([$id]);
    $tutorial=$query->fetch(PDO::FETCH_ASSOC);
   // print_r($tutorial);//category_id icerisinde string olarak geliyor
    if(!$tutorial):
        header("Location:index.php");
        exit();
endif;
//COK ONEMLI...BURDA $tutorial dizisi icinde category_id $tutorial['category_id'] bize 7,8,9 gibi bir
//string olarak geliyor
//string olarak gelen category_id leri parcalayp tekrar diziye atacagiz ki asagida
//form icinde kategoriler icinden burda var olan kategorilerimzi aktif hale getirelim
//dizi icine atarsak in_array ile dizi icinde var mi bunlar diye sorgulama yapabiliyoruz...
//bundan dolayi arraya atacagiz..BU VERITABANINDAN CEKTIMIZ KATEGORY_ID OLDUGU ICN VARCHAR ILE
//TANIMLAMISTIK ARALARINDA VIRGUL OLAN STRING OLARAK GELIYOR
$tutorial_categories=explode(",",$tutorial['category_id']);

//FORMDAN GELECEK OLAN DATALARI ALACAGIMIZ ICIN BIZ POST ILE DATA GELMSI MI ONCE ONA BAKALIM ,
// DAHA DOGRUSU POST ILE GUNCELLE BUTONUNA TIKLANMIS MI CEK EDELIM....

//1-ilk olarak isset ile post gonderilmis mi onu cek ediyoruz
//2.sonra o if icine girip bu seferde gonderilen value ler empty mi gonderilm is onu cek ederiz
//empty gonderilmis ise null yapariz sonra da bir altta empty olanlar icin kullaniciya yonlendirici
// hata  mesaji veririz...

if(isset($_POST['submit'])){

   // $title=empty($_POST["title"]) ? $tutorial['title'] : $_POST["title"];
    $title=($_POST["title"]) ?? $tutorial['title'] ;//Burasi update sayfasi once 
    //eger kullanici yeni data girmis ise onu versin yok vermemis ise o zaman da database den alsin diirek datayi....
    $contain=$_POST["contain"] ?? $tutorial['contain'];
   // $contain=empty($_POST["contain"]) ? $tutorial['title'] : $_POST["contain"];
    $confirm=$_POST["confirm"] ?? "0";//onay eger post tan geliyorsa ki postta zaten
    // veritabanindan alacak eger girilmez ise o zaman da posttan gelmis ise onu verecek yok
    // veritabaninda 0 girilmis ise zaten 0 olur 1 ise de zaten 1 olur 
   // $category_id=$_POST['category'] ?? $tutorial['category_id'];//Eger kullanici herhangi bir id secmis ise onu alsin yok
    //kullanici bos vs gonderir ise o zaman da direk tutorial in kategory id sinde ne var ise onu alsn diyoruz 
    //yani kategori veritabaninda ne ise onu alsin
//Ama biz asagida kontrol edebilmek ve kullaniciya da bir mesaj verebilmek icn yani kullanici eger kategori secmedi ise o zamn
//null olsun ki biz de kullaniciya hata mesaji verebilelim...
          // $category_id=$_POST['category'] ?? null;
          //Bu data form daki select-optiondan dizi olarak gelen data ve biz bunu burdan alip nerde kullanacagiz, sql update islemi icerisinde
          //kullanacagiz, sql icinde biz string olarak kullanacagiz datayi guncellerken dolayi ile o zaman bizim bu array i string e cevirmem gerekecek..
          //Hicbirsey ezbere degil, yaptigimz herseyi mantik uzerine kurgulayalim...adim adim konusarak yapalim...tek tek..
            $category_id=isset($_POST['category']) && is_array($_POST['category']) ? implode(",",$_POST['category']) : null;
            //Eger kategori yok ise null yapiyoruz cunku bir altta bunu kontrol ederek kullaniciya mesaj vermek istiyoruz..
    if(!$title){
        echo "There is no title"."</br>";
    }elseif(!$contain){
        echo "There is no contain"."</br>";
    }elseif(!$category_id){
        echo "Choose category"."</br>";
    }else{
          //ARTIK BURDA GUNCELLEME ISLEMINI FORMDAN GLEEN DATALARLA YAPABILIRIZ...  
            $update_query=$db->prepare("UPDATE TUTORIALS SET title=:title, contain=:contain, category_id=:category_id, confirm=:confirm where id=:id");
    $updated_data=[
        ":title"=> $title,
        ":contain"=> $contain,
        ":confirm"=> $confirm,
        ":category_id"=> $category_id,
        ":id"=>$tutorial['id']
    ];

    $update=$update_query->execute($updated_data);
    //CRUD OPERASYONLARI SONUNDA KULLANICIYA BIR ERROR,SUCCESS DURUMUNU DONEN BOOLEAN,
    // MESSAGE VE DE ISTEGE GORE DE DATA DA DONDUREBILEN BIR CLASS OLUSTURMAMIZ GEREKEBILIR...
    //BU DA AKLIMIZDA BULUNSUN BU DA BESTPRACTISE DIR...
    if($update){
        echo "Your data is updated succesffuly ";
        //DAta basarili bir sekilde eklendi ve onu index.php den read sayfasina yonlendirecegiz
     //   header("Location:index.php?page=read&id=".$id); burda id yi $_GET['id'] den aldik
        header("Location:index.php?page=read&id=".$tutorial['id']);
        //BIZ DATAYI GUNCELLEYIP UPDATE YAPINCA EGER UNCOFIRMED SECER ISEK READ SAYFASI
        // EGER UNCONFIRMED ISE O ZAMAN DA HOMEPAGE E YONLENDIRDIGI ICIN UNCONFIRMED DA 
        //DATA DETAYINI GORMEMIZE IZIN VERMIYOR DU YINE DE HOMEPAGE DE DATAMIZIN UPDATE OLDGUGUNU GOREBILIRZ....
        //AMA CONFIRMED YAPARSAK DATA DETAYININ DEGISTGINI DIREK READ SAYFASINDNA GORURUZ..
    }else {
        echo "Your data is failed";
    }
    }
}

}


?>

<?php 
//BU ARADA EGER SQL SORGUMUZ ICERISINDE HERHANGI BIR DATA GIRMEYECEKSEK WHERE ILE VEYA DIGER
//SQL KEYWORDLER I ILE ID, VEYA KOLONLARDAN HERHANGII BIRILERINE DATA GONDERMEYCEKSEK ILLA DA PREPARE 
//KULLANMAMIZ SART DEGIL MESELA BURDA DIRE QUERY ILE DE ALABILIRDIK DATA YI
$query=$db->prepare("SELECT * FROM CATEGORIES ORDER BY NAME ASC");
$query->execute();
$get_categories=$query->fetchAll(PDO::FETCH_ASSOC);
//print_r($get_categories);//biunun icerisinde de id string olarak geliyor bunu bilelim onemli..
?>
<!-- UPDATE ISLEMINDE....COOOK ONEMLI.... -->
<form action="" method="POST">
    Title: <br>
    <input type="text" value="<?php  echo $_POST['title'] ?? $tutorial['title']   ?>" name="title"> <br><br>
    Contain: <br>
    <textarea name="contain"  cols="30" rows="10"><?php  echo $_POST['contain'] ?? $tutorial['contain']   ?></textarea><br><br>
    <!--BESTPRACTISE...CATEGOYR YI UPDATE FORMU ICERISINE YERLESTIRDIK VE UPDATE ISLEMI YAPAAGIMIZ DATA HANGI KATEGORI SECMISSE ONCEDEN
O KATEGORI GELSIN DIYORUZ GELIR GELMEZ DE......ONEMLI..BESTPRACTISE BUNLARI COK KULLANAAGIZ
-->
    Categories: <br>
    <select name="category[]" multiple size="5"   >
      <!--   <option value="">--Choose category--</option>kullanici hic kategori secmez ise burasi gozukecek..coklu secim yapmaya izin verdgimz icin artik kategori sec default option i kaldirabiliriz-->
        <?php  foreach ($get_categories as $category) { ?>
            <!--
            MUKEMMEL BESTPRACTISE...COK DIKKAT EDELIMM.    
            Burda veritabnindan string olarak gelen, category id lerimiz i aralarina virgul koyarak tekrardan array icine attik ki 
        biz tek tek listeldgimz kategorilerimizin id lerinin  o arrray icinde olup olmadiklarini kontrol edebilelim, ve de bu sekilde 
        veritabnindan gelen birden fazla id lerimizi bir kerede kolay bir sekilde cekttirebiliyoruz
        -->
            <option <?php  echo in_array($category['id'],$tutorial_categories) ? 'selected': null ?>  value="<?php echo $category['id'] ?>">
        <?php echo $category['name']  ?>
        </option>
       <?php }  ?>
        
    </select>    
    <br><br>
    Confirm: <br>
    <select name="confirm" >
        <!-- BESTPRACTISE...BURASI COOOK ONEMLI..BURAYI COK IYI INCELEYELIM....BURAYI COK KULLANAAGIZ...... -->
        <option <?php echo $tutorial['confirm']== 1 ? 'selected': null  ?> value="1">Confirmed</option>
        <option <?php echo $tutorial['confirm']== 0 ? 'selected': null ?> value="0">Unconfirmed</option>
    </select>    
    <br><br>
    <!-- biz type i hidden olan bu input mutlaka gideecek form gonderildigi  zaman ve biz bu hidden li 
    submit gonderilmis mi ona bakacagiz eger bu var ise yani name deki submit var ise demekki bu form 
    submit edilmis diyerek form icindeki diger degerleri kontrol edecegiz -->
    <input type="hidden" name="submit" value="1"/>
    <button type="submit">Update</button>

</form>