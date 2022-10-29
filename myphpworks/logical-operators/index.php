<?php

//Mantiksal operatorler

# &&-AND
# || - OR
# !- DEGIL ISE

$a=6;
$b=8;

if($a===$b){
    echo "a ve b birbirine esittir";
}else {
    echo "a ve b birbirine esit degildir";

}


if($a===5){
    echo "a degeri 5 e esittir";
}else if($a===6)
{
    echo "a degeri 6 ya esittir";
}else {
    echo "a degeri ne 5 e ne de 6 ya esittir";
}



switch ($a) {
    case 5:
        # code...
        break;
        case 6:
            # code...
            break;
            case 7:
            case 8:
                # code...
                break;
    
    default:
        # code...
        break;
}

//Switch case alternatif kullanimi

switch($a):
    case 5:
        echo "1";
        break;

        case 6:
            echo "2";//Burasi ni yazdirir
            break;
            case 7:
                echo "3";
                break;

           default:
           echo "5";
            endswitch;     

//if else in alternatif kullanimi

if($a===12):
    echo "3";
  elseif($a===15):
    echo "6";
  else:
    echo "7";//Burayi yazdirir
  endif;      



?>

<?php

//1 degeri true 0 degeri false i temsil eder

$x=6;

$res=$x === 5 ? 12 : 20;
echo $res;



?>