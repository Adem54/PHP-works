<?php declare(strict_types=1);

// function parse_line(string $str){

//     $lineLen=strlen($str);
//     for ($i=0; $i <$lineLen ; $i++) { 
//         $ch=substr($str,$i,1);//sira ile karakterleri aliyoruz bu sekilde

//         switch ($ch) {
//             case ';':
//                 # code...
//                 echo $ch."<br>";
//                 break;
//             case "a":
//                 echo $ch."<br>";
//                 break;
//             default:
//                 # code...
//                 break;
//         }
//     }

// }

// parse_line("hello world welcoma");


 function parse_line( string $sLine)
	{
	
		$iLineLen = strlen($sLine);
		$sWord = "";
		

		for ($i = 0; $i < $iLineLen; $i++)
		{
			$ch = substr($sLine, $i, 1);
			//"environment=dev" i karakter olarak tek tek cek ediyor
			switch ($ch)
			{
				case '[':
					echo "[ "."<br>";
					break;

				case ']':
					echo "] "."<br>";
				
					$sWord = "";
					break;

				case '=':
					echo "= "."<br>";
                
				
					break;
				//environment i okurken karakter karakter, case ";": buraya cok ca giriyor
				//buna bakalim
				//$sHeading=["GENERAL"]   $sLine="environment=dev" 		
				case ';': // Comment skip the rest of the line.
				case '#':
					echo ";    ";
					
					break;

				default:
					$sWord .= $ch;
					break;
			}
		}
    }

    parse_line("environment");
?>