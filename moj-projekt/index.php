<!DOCTYPE html>
<html lang="pl">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="pl" />
    <meta name="Author" content="M" />
    <title>Historia Linuxa</title>
    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="./js/kolorujtlo.js" type="text/javascript"></script>
    <script src="./js/timedate.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#animacjaTestowa1").on("click", function() {
                $(this).animate({
                    width: "500px",
                    opacity: 0.4,
                    fontSize: "3em",
                    borderWidth: "10px"
                }, 1500);
            });

            $("#animacjaTestowa2").on({
                "mouseover": function() {
                    $(this).animate({
                        width: 300
                    }, 800);
                },
                "mouseout": function() {
                    $(this).animate({
                        width: 200
                    }, 800);
                }
            });

            $("#animacjaTestowa3").on("click", function() {
                if (!$(this).is(":animated")) {
                    $(this).animate({
                        width: "+=" + 50,
                        height: "+=" + 10,
                        opacity: "-=" + 0.1
                    }, 3000);
                }
            });
        });
    </script>
</head>

<body onload="startclock()">
    <header>
        <h1>Historia Linuxa</h1>
    </header>

    <nav>
        <ul>
            <li><a href="?id=1">Strona główna</a></li>
            <li><a href="?id=2">Historia</a></li>
            <li><a href="?id=3">Kontakt</a></li>
            <li><a href="?id=4">Porównanie</a></li>
            <li><a href="?id=5">Ciekawostki</a></li>
            <li><a href="?id=6">Dystrybucje</a></li>
            <li><a href="?id=7">Filmy</a></li>
            <li><a href="mailto:164446@student.uwm.edu.pl">Wyślij mail</a></li>
        </ul>
    </nav>

    <div class="test-block" id="animacjaTestowa2">Kliknij, a się powiększę</div>
    <div class="test-block" id="animacjaTestowa1">Kliknij, a się powiększę</div>
    <div class="test-block" id="animacjaTestowa3">Kliknij, abym urósł</div>

    <form method="post" name="background">
        <input type="button" value="Zółty" onclick="changeBackground('#FFF000')">
        <input type="button" value="Czarny" onclick="changeBackground('#000000')">
        <input type="button" value="Biały" onclick="changeBackground('#FFFFFF')">
        <input type="button" value="Zielony" onclick="changeBackground('#00FF00')">
        <input type="button" value="Niebieski" onclick="changeBackground('#0000FF')">
        <input type="button" value="Pomarańczowy" onclick="changeBackground('#FF8000')">
        <input type="button" value="Szary" onclick="changeBackground('#c0c0c0')">
        <input type="button" value="Czerwony" onclick="changeBackground('#FF0000')">
    </form>

    <div class="content">
        <?php
        require_once 'showpage.php';
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            echo PokazPodstrone($id);
        } else {
            echo PokazPodstrone(1);
        }
        ?>
    </div>

    <div id="zegarek"></div>
    <div id="data"></div>

    <footer>
    <a href="./admin/admin.php">Panel Administracyjny</a>
    <?php
    $nr_indeksu = "164446";
    $nrGrupy = "4";
    echo "Autor: Michał Zembrowski " . $nr_indeksu . " grupa " . $nrGrupy . " <br /><br />";
    ?>
    </footer>
</body>
</html>

