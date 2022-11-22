<?php 

//BESTPRACTSIE...FORM BUTONA TIKLANDIGNI NASIL ANLARIZ
//Eger submit diye bir input gonderilmis ise default olarak value atanmis bir submit geliyorsa demekki
//butona tiklanmis demektir ordan anlayabliiriz butona tiklanip tiklanmadigini
if(isset($_POST["submit"])){
    print_r($_POST);
    exit;
}
//Biz asagidaki form degerlerini curl ile gondermek istersek nasil yaapcagiz ona bakalim


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
    <form action="" method="post">
        Name: <br><br>
        <input type="text" name="name">
        <br><br>
        Surname: <br><br>
        <input type="text" name="surname">
        <br><br>
        Profession:
        <select name="profession" >
            <option value="null">--Velg profession--</option>
            <option value="accountant">Accountant</option>
            <option value="developer">Developer</option>
        </select>
        <button type="submit" name="submit" value="1">Submit</button>


    </form>
</body>
</html>