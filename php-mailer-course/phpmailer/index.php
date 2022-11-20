<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//use ile namespace kullaniliyor cunku ayni isimde class lar veya directory ler olabilir onlarin birbirine karismamasi icin namespace kullanmak cok onmelidir, php de  ve namespace ler use ile kullanilir

require 'vendor\autoload.php';

require 'C:\PHPMailer\src\SMTP.php';
require 'C:\PHPMailer\src\PHPMailer.php';
require 'C:\PHPMailer\src\Exception.php';


$email = new PHPMailer(TRUE);




?>