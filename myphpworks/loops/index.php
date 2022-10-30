<?php

for ($i=0; $i <10 ; $i++) {
    # code...
    echo $i . '<br/>' ;

}
$test=12;
echo "<h2>$test</h2>";
/*
Biz html elementleri icinde php kullanabilirken ayni zamanda php etiketleri icersinde de tirnak icinde de
html etiketleri kullanabiliyoruz
Ve o html etiketleri arasinda da biz php icindeki degiskenleri kullanabiliyoruz...
*/

$cities=["Skien","Porsgrunn","Larvik","Tønsberg"];


for ($i=0; $i <count($cities) ; $i++) {
    # code...
    echo $cities[$i]. ' </br>';
}

//String icinde degisken yazabiliyorurz php de
//
foreach ($cities as $key => $value) {
    echo "$key : " . "$value". "</br>" ;
}
echo "-----------------------------------------------------";


//foreach de biz php de index veya key degerlerini de alabiliyoruz..
foreach ($cities as $value) {
    # code...
    echo "this is just valueeee:  $value". "</br>";
}


echo "-----------------------------------------------------";

//php de dikkat edelim, bize true false yerine 1 veya 0 verir yani 1 i true, 0 i false kabul eder
//ama 0 i biz ekranda goremiyoruz ancak 1 i ekranda gorebiliyoruz
$number=14;
while(1){
    echo "test: $number";
    if($number<=20){
          echo "<h5> $number </h5>";
    }else {
        break;
       // return;
    }

    $number++;
}


$number=10;
do {
echo "$number". "<br/>";

    if($number<=0){
        return ;
    }

$number--;

    # code...
} while (true);
?>

