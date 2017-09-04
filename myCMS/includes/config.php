<?php

ob_start();
session_start();

// db properties
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','mycms');

// make a connection to mysql here
$conn = @mysqli_connect (DBHOST, DBUSER, DBPASS, DBNAME);

if(!$conn){
	die( "Sorry! There seems to be a problem connecting to our database.");
}

// define site path
define('DIR','http://localhost/myCMS/');

// define admin site path
define('DIRADMIN','http://localhost/myCMS/admin/');

// define site title for top of the browser
define('SITETITLE','MyCMS');

//define include checker
define('included', 1);

include('functions.php');
?>
