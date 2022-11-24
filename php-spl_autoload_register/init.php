<?php 

function autoload($className)
{
	$dir 		= __DIR__;
	$classPath 	= "classes/".$className.'.php';
    // echo $classPath;

	require($classPath);
}

spl_autoload_register('autoload');


?>