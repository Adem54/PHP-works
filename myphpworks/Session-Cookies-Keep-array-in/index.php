<?php
//Session
session_start();


$_SESSION["member"]=[
    "user_name"=>"Adem",
    "password"=>"123",
];

print_r($_SESSION);

//Cookie de ise dizi ekleyecegimz zaman bu sekilde olustururuz
setcookie("member[id]",1,time()+30);
setcookie("member[name]","Adem",time()+30);

print_r($_COOKIE);
?>