<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'moja_strona';
$login = 'admin'; 
$pass = 'admin'; 
// Ustanowienie połączenia
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Sprawdzenie połączenia
if (!$conn) {
    die('<b>Przerwane połączenie: </b>' . mysqli_connect_error());
}

?>
