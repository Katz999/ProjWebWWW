
<head>
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Content-Language" content="pl" />
	<meta name="Author" content="Michał Zembrowski" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<title>Historia Linuxa</title>
	<link rel="stylesheet" href="./css/styles.css">
	<script src="./js/kolorujtlo.js" type="text/javascript"></script>
	<script src="./js/timedate.js" type="text/javascript"></script>
</head>

<body onload="startclock()">

<nav>
    <ul>
            <li><a href="?id=1">Strona główna</a></li>
            <li><a href="?id=2">Historia</a></li>
	    <li><a href="?id=3">Kontakt</a></li>
            <li><a href="?id=4">Porównanie</a></li>
	    <li><a href="?id=5">Ciekawostki</a></li>
	    <li><a href="?id=6">Dystrybucje</a></li>
	    <li><a href="?id=7">Filmy</a></li>
    </ul>
</nav>

<div class="content">
<?php
	require_once 'showpage.php';
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
/* po tym komentarzu będzie kod do dynamicznego ładowania stron */
        if (isset($_GET['id'])){
        	$id = $_GET['id'];
                echo PokazPodstrone($id);} 
       else{
                echo PokazPodstrone(1);}
?>
</div>
<div id="zegarek"></div>
<div id="data"></div>
<?php
	$nr_indeksu = "164446";
	$nrGrupy = "4";	
	echo "Autor: Michał Zembrowski ".$nr_indeksu." grupa ".$nrGrupy." <br /><br />";
?>
</body>
