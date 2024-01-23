<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $baza = 'moja_strona';
    $database = '';
	$login = 'admin'
	$pass = 'admin'

    $link = mysqli_connect($dbhost,$dbuser,$dbpass,$baza);
    if(!$link) echo '<b>przerwane polaczenie</b>';
    if(mysqli_select_db($link,$baza)) echo 'nie wybrano bazy';