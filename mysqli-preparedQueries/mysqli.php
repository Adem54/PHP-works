<?php 
/*
$sCompId = mb_strtoupper(mysqli_escape_string($db, t_filterstring($sCompId)));
$sUserId = mb_strtoupper(mysqli_escape_string($db, t_filterstring($sUserId)));
$sPwd = mb_strtoupper(mysqli_escape_string($db, t_filterstring($sPwd)));
$sSql = "SELECT id,userid,u_name,u_password FROM users WHERE userid='" . $sUserId . "' AND u_password='" . $sPwd."'";

$res = sql_select($db, $sSql);
$row_count=mysqli_num_rows($res);
$row = mysqli_fetch_array($res);

*/

$mysqli = new mysqli("localhost", "root", "", "link");
if($mysqli->connect_error) {
  exit('Error connecting to database'); //Should be a message a typical user could understand in production
}else{
    echo "connected to link database successfully";
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli->set_charset("utf8mb4");

//$sSql = "SELECT id,userid,u_name,u_password FROM users WHERE userid='" . $sUserId . "' AND u_password='" . $sPwd."'";

$stmt = $mysqli->prepare("SELECT * FROM users WHERE userid = ?");
$_POST['userid']="IP";
$_POST['u_password']="Tra3088";
$pswFromUser=$_POST['u_password'];



//yAPILACAK SEY SU, VERITABANINDAN GELEN PASSWORDU HASHSLEYECEGIZ, KULLANICIDAN GELEN I DE DIREK PASSWORD_VERIFY DA KULLANACAGIZ...


//ROBLEM BURDA ISTE BESTRPACTISE..MYSQL CASEINSENSITIVE...KULLANICI PASSWORDU BUYUK HARFLE GIRDIGI ZAMAN DA ONU ESITLIYOR

$stmt->bind_param("s", $_POST['userid']);
$stmt->execute();
// fetching result would go here, but will be covered later

$result = $stmt->get_result();


if($result->num_rows === 0) exit('No rows');
echo $result->num_rows."<br>";


// $row = $result->fetch_assoc();
// echo($row["U_PASSWORD"]);

while($row = $result->fetch_assoc()) {
 $pswdS[]=($row["U_PASSWORD"]);
  //   $ids[] = $row['userid'];
  //   $psws[] = $row['u_password'];
 
  }

  //db den gelen password:"tra3088"

  // print_r($pswdS);

  foreach ($pswdS as  $psw) {
  //  echo $psw;
 $hashedPswFromDB=password_hash($psw, PASSWORD_DEFAULT);
if(password_verify($pswFromUser,$hashedPswFromDB)){
  echo "Userspassword:  ".$pswFromUser." is matching password in DB";
}else {
  echo "Password is wrong";
}
  }

  $stmt->close();
  exit();

exit();



//Hver gang vi invoker fetch_assoc, vi get nexte data from starting index zero




//Vi kan ta hele data i an array
// $arr=$result->fetch_all(MYSQLI_ASSOC);
// print_r($arr);







/*

$stmt = $mysqli->prepare("SELECT * FROM myTable WHERE name = ? AND age = ?");
$stmt->bind_param("si", $_POST['name'], $_POST['age']);
$stmt->execute();
fetching result would go here, but will be covered later
$stmt->close();

$stmt = $mysqli->prepare("SELECT * FROM myTable WHERE name = ?");
$stmt->bind_param("s", $_POST['name']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows === 0) exit('No rows');
while($row = $result->fetch_assoc()) {
  $ids[] = $row['id'];
  $names[] = $row['name'];
  $ages[] = $row['age'];
}
var_export($ages);
$stmt->close();
[22, 18, 19, 27, 36, 7]


try {
  $mysqli->autocommit(FALSE); //turn on transactions
  $stmt1 = $mysqli->prepare("INSERT INTO myTable (name, age) VALUES (?, ?)");
  $stmt2 = $mysqli->prepare("UPDATE myTable SET name = ? WHERE id = ?");
  $stmt1->bind_param("si", $_POST['name'], $_POST['age']);
  $stmt2->bind_param("si", $_POST['name'], $_SESSION['id']);
  $stmt1->execute();
  $stmt2->execute();
  $stmt1->close();
  $stmt2->close();
  $mysqli->autocommit(TRUE); //turn off transactions + commit queued queries
} catch(Exception $e) {
  $mysqli->rollback(); //remove all queries from queue if error (undo)
  throw $e;
}



One Row

$result->fetch_assoc() - Fetch an associative array
$result->fetch_row() - Fetch a numeric array
$result->fetch_object() - Fetch an object array
All

$result->fetch_all(MYSQLI_ASSOC) - Fetch an associative array
$result->fetch_all(MYSQLI_NUM) - Fetch a numeric array

$stmt = $mysqli->prepare("SELECT id, name, age FROM myTable WHERE name = ?");
$stmt->bind_param("s", $_POST['name']);
$stmt->execute();
$arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
if(!$arr) exit('No rows');
var_export($arr);
$stmt->close();

If you need to modify the result set, then you should probably use a while loop with fetch_assoc() and fetch each row one at a time.

$arr = [];
$stmt = $mysqli->prepare("SELECT id, name, age FROM myTable WHERE name = ?");
$stmt->bind_param("s", $_POST['name']);
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()) {
  $arr[] = $row;
}
if(!$arr) exit('No rows');
var_export($arr);
$stmt->close();

[
  ['id' => 27, 'name' => 'Jessica', 'age' => 27], 
  ['id' => 432, 'name' => 'Jimmy', 'age' => 19]
]
*/

?>