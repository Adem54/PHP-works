<?php 

require "db.php";


//Bu sekilde XSS-Cross site scriptinge karsi onlem almamiz gerekir
function clean($str){
    // return htmlspecialchars($str);
    return $str;
}



//uye kullanicimzda baglandi diyelim veritabanina
//eger id diye bir parametre yoksa calismayi durdru diyecegiz, var ise de sorgu yapalim 
if(!isset($_GET["id"])){
    exit;

}


$query=$db->prepare("SELECT * FROM users WHERE id=?");
$query->execute([$_GET["id"]]);
$user=$query->fetch(PDO::FETCH_ASSOC);

// print_r($user);
//http://localhost/test/PHP-works/php-security/croos-site-scripting/user.php?id=1 id 1 e get istegi gonderirsek 
/*
id si 1 olan kullanicin bilgilerini alacagiz veritabanindan
{
id: "1",
name: "ademerbas",
epost: "adem@gmail.com",
password: "admin",
about: "This is about adem."
},


http://localhost/test/PHP-works/php-security/croos-site-scripting/user.php?id=3
deyince 3 numarali user in bilgilerini aldik hatta abouttan gelen script kodunu bile calistrdi tararycimiz

{
id: "3",
name: "attacker",
epost: "attacker@gmail.com",
password: "attacker",
about: "</text><script> alert("hak yiyen hack yer"); </script>"
}
*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3><?php echo $user["name"]?></h3>
    <p>
            <?php echo clean($user["about"])?>
<!-- sistemimize script gonderen kullanicinn direk script kodu geliyor buraya ve bu script kodumuz calistiryoruz
<script> alert("hak yiyen hack yer"); </script>
biz chrome de ve bu bizim ciddi bir xss-cross side scripting yani disardan sistmeimiz e javascript kodu calistirarak mudahele edilmesi guvenlik acigi burda javscript ile bizim cookie, localstorage da data tutuyrsak onlara erisme tehlikesi var 
Bu tehlikenin sebebi su kullanicidan alinan bilgi yeterli guvenlik kontrolunden gecirilmeden database e kaydedildigi icin bu tehlikeye maruz kaliyor sistemimz, yani filtreleme yapmamisiz 
Bunun icin biz bir clean diye fonksiyon yazip orda filtreleme yapacagiz htmlspecielchars ile

COOK ONEMLI BIR GUVENLIK ONLEMIDIR
Biz bir filtrelemden gecirirsek yukarda ki clean fonksiyonumuz ile ve database den gelen datyai o filtrelemden gecirrisek o zaman artik sistemimiz kullanicidan gelebilecek script kodu yazma tehlikesine o yazilan script kodunu normal bir yazi gibi okumasini sgalyarak kod olarak gormemesini saglamis oluruz... attacker
<script> alert("hak yiyen hack yer"); </script>

-->
    </p>
</body>
</html>