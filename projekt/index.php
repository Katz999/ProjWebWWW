<!DOCTYPE html>
<html lang="pl">
<head>
    <!-- Ustawienia kodowania znaków, języka oraz autora strony -->
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="pl" />
    <meta name="Author" content="M" />

    <!-- Tytuł strony oraz link do arkusza stylów -->
    <title>Historia Linuxa</title>
    <link rel="stylesheet" href="./css/styles.css">

    <!-- Import jQuery oraz skryptów JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="./js/kolorujtlo.js" type="text/javascript"></script>
    <script src="./js/timedate.js" type="text/javascript"></script>
    <script>
        // Skrypty jQuery do obsługi animacji
        $(document).ready(function() {
            // Animacja Testowa 1
            $("#animacjaTestowa1").on("click", function() {
                $(this).animate({
                    width: "500px",
                    opacity: 0.4,
                    fontSize: "3em",
                    borderWidth: "10px"
                }, 1500);
            });

            // Animacja Testowa 2
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

            // Animacja Testowa 3
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
    <!-- Nagłówek strony -->
    <header>
        <h1>Historia Linuxa</h1>
    </header>

    <!-- Nawigacja strony -->
    <nav>
        <ul>
            <!-- Linki do różnych sekcji strony -->
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

    <!-- Formularz do zmiany koloru tła -->
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

    <!-- Bloki testowe do animacji -->
    <div class="test-block" id="animacjaTestowa2">Kliknij, a się powiększę</div>
    <div class="test-block" id="animacjaTestowa1">Kliknij, a się powiększę</div>
    <div class="test-block" id="animacjaTestowa3">Kliknij, abym urósł</div>

    <!-- Treść strony wyświetlana dynamicznie -->
    <div class="content">
        <?php
        // Import pliku showpage.php oraz ustawienie raportowania błędów
        require_once 'showpage.php';
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

        // Sprawdzenie, czy istnieje parametr 'id' w adresie URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Wywołanie funkcji do wyświetlenia treści strony w zależności od parametru 'id'
            echo PokazPodstrone($id);
        } else {
            // Jeśli brak parametru 'id', wyświetlenie strony głównej
            echo PokazPodstrone(1);
        }
        ?>
    </div>

    <!-- Wyświetlanie zegara oraz daty -->
    <div id="zegarek"></div>
    <div id="data"></div>

    <!-- Stopka strony zawierająca link do panelu administracyjnego oraz informacje o autorze -->
    <footer>
        <a href="./admin/admin.php">Panel Administracyjny</a>
        <?php
        // Informacje o autorze
        $nr_indeksu = "164446";
        $nrGrupy = "4";
        echo "Autor: Michał Zembrowski " . $nr_indeksu . " grupa " . $nrGrupy . " <br /><br />";
        ?>
    </footer>
</body>
</html>

