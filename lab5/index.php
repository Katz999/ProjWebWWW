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
		<li><a href="?page=glowna">Strona główna</a></li>
        <li><a href="?page=historia">Historia</a></li>
        <li><a href="?page=ciekawostki">Ciekawostki</a></li>
        <li><a href="?page=porownanie">Porównanie</a></li>
		<li><a href="?page=dystrybucje">Dystrybucje</a></li>
		<li><a href="?page=kontakt">Kontakt</a></li>
		<li><a href="?page=Filmy">Filmy</a></li>
    </ul>
</nav>

<div class="content">
	<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
/* po tym komentarzu będzie kod do dynamicznego ładowania stron */
    if (isset($_GET['page'])) {

        $page = basename($_GET['page']);
        
        $pagesDirectory = 'html/';
        
        $filePath = $pagesDirectory . $page . '.html';
        if (file_exists($filePath)) {
            include($filePath);
        } else {
            echo '<p>Nie znaleziono strony!</p>';
        }
    } else {
        include('./html/glowna.html');
    }
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
