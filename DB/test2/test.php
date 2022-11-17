<?php  
 declare(strict_types=1);


// phpinfo();

// function test(){
//     $value=1;
//     $value++;
//     return $value;
// }

// $res=test();
// echo $res;
// print_r([4,6,7])


// function testReturn(): ?string//Sonucu nulll da donebilir demektir
// {
//     return 'elePHPant';
// }

// var_dump(testReturn());//

// function testReturn(): ?string
// {
//     return null;
// }

// var_dump(testReturn());

// function test(?string $name)//parametre almayabilir de demektir
// {
//     var_dump($name);
// }

// Asagida goruldugu gibi hata almiyoruz
// test('elePHPant');
// test(null);
// test();


$arr=[
    "name"=>"Adem",
    "surname"=>"Erbas"
];

//  print_r($arr) ;
echo $arr["name"];//Bu sekiilde key uzerinden value ye erisebiliyoruz..
echo "</br>";

//Burda dizi icine bir baska dizi elemnt olarak ekleniyor

$arr[]=[ 'mail'=>"sMailTo", 'name'=>'Zehra' ];
//print_r($arr);
echo "</br>";
echo $arr["0"]["name"];
// phpinfo();

?>