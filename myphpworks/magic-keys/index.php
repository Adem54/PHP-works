<?php
//Magic keys
# \t-TAB
# \n-NEW LINE
# \\-\ ters slas kullanirken bu sekilde kullaniriz yoksa, tek kullanimda \ozel bir karakter olarak algilar
# \$=>string ler icerisinde, degiskenleri yine basinda $ isareti ile degisken olarak kullanabiyoruz, ama direk $ isaretini
//bir degisken olarak kullanirsak o zaman da \$ bu sekilde kullaniriz
# \'
# \"

# NERDE  NE ICIN KULLANILIR
# 1-Sadece cift tirnak lar icerisinde kullanilabilir sihirli karakterler
# Sadece string ifadelerde kullanilabiliyor

$test="AdemErbas";
// \t tab karakterine basinca bosluk biraktimiz gibi bosluk birakyor php de
// \n de bir alt satira indirir
$test="tayfun\t\t\t\nerbilen";
echo $test;

// $city="Skien\nPorsgrunn";
// echo $city;

?>

<?php
/*
When you run a PHP script in a browser, it will be rendered as HTML by default. If the books you’re using show otherwise, then either the code or the illustration is inaccurate. You can use “view source” to view what was sent to the browser and you’ll see that your line feeds are present.

PHP web-server da run edilip browser dan cikti alniyor yani html olarak cikti aliyoruz, html olarak render edilyor 
dolayisi ile kaynak kodunu gormek zaten mumkun olmaz bu ciddi bir guvenlik acigi olurdu ve biz de gidip facebook un o zaman kaynak
kodlarini gorebilirdik

You can't do that. Because the server side script (here PHP scripts) execute on the web server and its output is embedded inside HTML which is then thrown back to your browser. So all you can view is the HTML. Just imagine, if what you asked was possible, then evryone would have the source code of facebook, flipkart in their hands now.
*/
echo "Line 1\nLine\\ 2";
//Line 1 Line 2

?>

<?php  

$age=34;

echo "My age is $age";//Bu cok onemli, string icinde biz basina dolar isaret koyarak degskenmizi kullanabilyoruz
//Ama tek tirnak icinde kullanamayiz buna dikkat edelim


echo "Hello what is it \$";
//Tek tirnakta bunlar gecerli degil, tek tirnak icnde degsken de kullanmiyoruz zaten

//Cift tirnak icin cift tirnagi kacis karakterleri ile bu sekilde kullaniriz..
//Aynisi tek tirnak icin de gecerlidir
echo "Adem dedi ki \"Benim adim Adem\" ";
echo 'Adem dedi ki \'Benim adim Adem\' ';
?>

