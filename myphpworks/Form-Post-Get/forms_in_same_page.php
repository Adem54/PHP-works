<?php 

//Bazen giris ve kayit ol sayfalari ayni sayfada oluyor ve bazi
//insanlar bunu o sayfada post etmek istiyor
//VE her ikisinde de username ve password oldugu icin biraz karisik olabiliyor

function filter($post){
    return is_array($post) ? array_map("filter",$post) : htmlspecialchars(trim($post));
};


$_POST=array_map("filter",$_POST);

function post($name){
      if(isset($_POST[$name])):return $_POST[$name];
endif; 
};


/* 
BESTPRACTISE...
Simdi bizim elimzde 2 tane formumuz var ve 2 formdan da benzer datalar geliyor ayni baslikta name ler var ve 2 formu da ayni sayfda kullaniyoruz mesela nasil birbirinden ayirt ederiz yani hangi data hangisinden geliyor bunu nasil anlariz....
Her iki form icine de 1 er tane type i hidden yapacagimz input lar veririz ve bu inputlar name lerini ayirt edebilmek icin birisi login, digeri register veririz name olarak ve her ikisine de value olarak "1" veririz
Asagiida oldugu gibi name ler uzerinden kontrol ederek if blogu  yazariz
*/

//Asagidaki yontemle formlarimiz birbirinden bagimsiz olarak hareket ediyor...

//Login-post  edilmis ise burasi gelir
if(post("login")){
    print_r($_POST);
}
/*
Login e tiklayinca da login formunda girdigimz datalar geldi
{
username: "adem54",
password: "123123",
login: "1"
},

*/
//Register-post edilmisse de burasi gelir
if(post("register")){
    print_r($_POST);

}
/*
Register a tiklayinca register da doldudrdugumz datalar geldi
{
username: "zehra",
password: "321321",
email: "zehra@gmail.com",
register: "1"
},
*/

?>

<form action="" method="post"> 
<h3>Login</h3>    
Username:
</br>
<input type="text"  name="username" />
</br>
</br>
Password:
</br>
<input type="password"  name="password" />
<input type="hidden" name="login" value="1" />
</br>
</br>

<button type="submit">Login</button>
</form>

</hr>

<form action="" method="post"> 
<h3>Register</h3>    
Username:
</br>
<input type="text"  name="username" />
</br>
</br>
Password:
</br>
<input type="password"  name="password" />
</br>
</br>
Epost:
</br>
<input type="email"  name="email" />
<input type="hidden" name="register" value="1" />
</br>
</br>

<button type="submit">Register</button>
</form>