

<?php
/*
//   $options = getopt("ab:cd:");
//   var_dump($options);

  $options = getopt("abc");
    var_dump($options);

php getopt.php -a -b -d
Bu seklde run edince 3 tane, parametre vermis olyoruz ve o parametreler command prompta bu sekilde geliyor

array(2) {
  ["a"]=>
  bool(false)
  ["b"]=>
  bool(false)
}

1.parametre sadece string verebilmek icn, ama 2.paramtre array de verebilmek icindirphp

  $options = getopt("ab:cd:");
  var_dump($options);

php getopt.php -a -b hello -d world

array(3) {
    ["a"]=>
    bool(false)
    ["b"]=>
    string(5) "hello"
    ["d"]=>
    string(5) "world"
}

*/
$shortopts  = "";
$longopts  = [
   "debug:",
	"type:"
];

// $options = getopt(implode('', array_keys($parameters)), $parameters);
$options = getopt(implode("",$longopts));


var_dump($options);

// exit();
//$options = getopt($shortopts, $longopts);
//$options = getopt();
//$options=[]; hatayi ortadan kaldirmak icin yaptim bunu
// $options=[];
// echo implode("",$longopts);
echo "<h5>options</h5>";
// var_dump($options);

foreach ($options as $option=>$value)
{//mb_strtolower bunun sayesinde girilebilecek her turlu ozel karakteri de kucultebilyor
	switch (mb_strtolower($option))
	{
		case 'debug':
			$m_bDebug = true;
			break;

		case 'type':
			$m_sExecType = $value; // Execution type. ftp or edi
			break;
		
		default: // Just skip other options.
			break;
	}
}


?>

 
<hr>
<hr>
<?php


// $shortopts  = "";
// $shortopts .= "f:";  // Required value
// $shortopts .= "v::"; // Optional value
// $shortopts .= "abc"; // These options do not accept values

// $longopts  = array(
//     "required:",     // Required value
//     "optional::",    // Optional value
//     "option",        // No value
//     "opt",           // No value
// );
// $options = getopt($shortopts, $longopts);
// var_dump($options);
// print_r($options);
?>