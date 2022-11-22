<?php 






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
    <!--Bizim burdaki senaryomuz su, bizim bir admin panelimiz ve ordan biz kullanici veya musterilerimize hizmet sunuyoruz ve ordan kimi zaman musterilere mesaj atmamiz gerekiyor 
Neler i girmemiz gerekir
1-Kime mail gonderilecek
2-Konu
3-Aciklama
4-Ad soyad
-->
<form action="form.php" method="POST" enctype="multipart/form-data">
<input name="epost" type="text" placeholder="E-post adress"><br><br>
<input name="subject" type="text" placeholder="subject"><br><br>
<textarea name="content"  cols="30" rows="10"></textarea><br><br>
<input class="form-control-file" type="file" id="attachment" name="file">

<br><br>


<button type="submit">Submit</button>
</form>


</body>
</html>