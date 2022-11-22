<?php

if(isset($_POST["submit"]) ){
    if(!isset($_POST["username"]) || !isset($_POST["password"])){
        echo "username or password must be filled";
    }elseif($_POST["username"]=="admin" && $_POST["password"]=="admin"){
        //start session
        //ornegin veritabanindan oturum baslattigimizi dusunelim,session i acmis olduk burda 
        $_SESSION["login"]=true;
        header("Location:index.php");
    }else {
        echo "Username or password is wrong";
    }
}


?>

<form action="" method="POST">

Username: <input type="text" name="username"> <br><br>
Password: <input type="password" name="password"> <br><br>
<button type="submit" name="submit" value="1">Log in</button>
</form>