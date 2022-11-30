<?php 

//$arr=glob(__DIR__."/*",GLOB_ONLYDIR);
$arr=glob(__DIR__."/*/");
// print_r($arr);
/*
{
0: "C:\Users\ae_netsense.no\utv\test\PHP-works\php-listallfilesorfoldersinarraywith_glob/test1",
1: "C:\Users\ae_netsense.no\utv\test\PHP-works\php-listallfilesorfoldersinarraywith_glob/test2"
},

*/


foreach ($arr as $key => $value) {
   // echo rtrim($value,"/")."<br>";//1-rtrim ile en sagdaki / kaldirldi 
  $arr[$key]= rtrim($value,"/");

}


foreach ($arr as $key => $value) {
    $arr[$key]=explode("/",$value);/*  {
        0: "C:\Users\ae_netsense.no\utv\test\PHP-works\php-listallfilesorfoldersinarraywith_glob",
        1: "test1"
        }, {
0: "C:\Users\ae_netsense.no\utv\test\PHP-works\php-listallfilesorfoldersinarraywith_glob",
1: "test2"
}*/
  echo end($arr[$key])."<br>";//test1,test2 ye bu sekilde erismis olyoruz amacimiza ulastik yani
}





?>
<ul>
    <!-- <?php foreach ($arr as $key => $value):?>
    <li> <?php require ($value."/index.php");  ?>  </li>
    <?php endforeach;?> -->
</ul>