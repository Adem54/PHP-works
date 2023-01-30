<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="" rel="stylesheet" />
  <title></title>
</head>

<body>
  <!--Eger form islemi icinde file islemi var sa mutlaka, enctype ="multipart/form-data" vermemiz gerekir -->
  <form action="result.php" method="POST" enctype="multipart/form-data">
    Choose file: </br>
    <!--Multiple dosya secebilmek icin, input a attribute olarak multiple yazariz..
Ayrica name olarak da name=file[] seklinde gondeeririz ki birden fazla dosya secerek gondereilelim diye ve bu $_FILES icerisine dizi olarak gidecek
Ayrica biz burdan ornegin select options lar da veya checkbox, larda da datayi multiple gondermek icin name karsina yzdimgz data ismini dizi indexer [] ile birlikte gondeririz.. normalde ve post ile $_POST  ile datayi alirken $_POST dizisi icerisine dizi olarak gelirler o zaman
-->
    <input type="file" multiple name="file[]" />
    <hr>
    <button type="submit">Upload</button>
  </form>
</body>

</html>