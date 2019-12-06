<?php
// Define connection parameters
$host = "localhost";
$username = "wpadmin";
$passwd = "EvaMarielle19*";
$dbname = "sipreif";

//mysqli_connect(host, username, password, dbname)
$link = @mysqli_connect($host, $username, $passwd, $dbname) or die("ERROR: Unable to connect: " . mysqli_connect_error());
?>