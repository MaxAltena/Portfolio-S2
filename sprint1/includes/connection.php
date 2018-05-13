<?php

$servername = "studmysql01.fhict.local";
$dbname = "dbi371527";
$username = "dbi371527";
$password = "fhict123";

try {
	$PDO = new PDO("mysql:host=" . $servername . "; dbname=" . $dbname, $username, $password);
} 
catch (PDOException $e) {
    exit("Unable to create connection to DataBase " . $dbname);
}

?>