<?php 

//Delete sayfasina geldigi zaman bu sekilde
//http://localhost/test/pdo-database/index.php?page=delete&id=2

echo $_GET['id'];
//1-Once get methodu icinde id var mi isset ile bunu kontrol et
//2-Gelen id bos mu dolu mu, gel mis ok ama ici bos mu dolu mu
//3-Id gelmis ama gelen id benim veritabanim icerisinde bulunyor mu select ile gelen id yi kontrol et var mi 

if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location:index.php");
    exit();//Bundan sonraki kodlari calistirmasin
}else {
    $query=$db->prepare("SELECT * FROM TUTORIALS WHERE ID=:ID");
    $query->execute([":ID"=>$_GET['id']]);
    $tutorial=$query->fetch(PDO::FETCH_ASSOC);
    if(!$tutorial){
    header("Location:index.php");

    }

//GELEN ID BIZIM VERITABANIMIZDA VAR ISE O ZAMAN ARTIK SILEBILIRIZ
//NORMAL DE SUNU UNUTMAYALIM SILME ISLEMLERINDE KULLANICIYA BIR POP UP ILE CONFIRM -ONAYLAMA YAPTIRARAK SILMEMIZ GEREKIR..BU SARTTIR
    $id=$_GET['id'];
$delete_query=$db->prepare("DELETE FROM TUTORIALS where id=?");
$delete_query->execute([$id]);
if($delete_query){
    header("Location:index.php");
}

}





?>