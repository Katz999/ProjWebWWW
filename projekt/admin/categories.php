<?php

include('../cfg.php');


//                Funkcja odpowiadająca za wylogowywanie

function Wyloguj()
{
    session_start();
    session_destroy();
    header("Location: ../index.php");
    exit();
}

//              Przycisk wylogowywania

function WylogujButton()
{
    echo '<form method="get">
            <input name= "wylogowywanie" type="submit" value="Wyloguj"></button>
          </form>';
}

if(isset($_GET['wylogowywanie']) && $_GET['wylogowywanie']=='Wyloguj')
{
    Wyloguj();
}

//              Przycisk do zmiany strony

function SwitchSite($url, $tekstPrzycisku) {
    echo '<form action="' . $url . '">';
    echo '<input type="submit" value="' . $tekstPrzycisku . '">';
    echo '</form>';
}

// Funkcja odpowiadająca za dodawanie kategorii do bazie danych

function DodajKategorie($conn, $nazwa, $matka = 0) {
    $query = "INSERT INTO categories (nazwa, matka) VALUES ('$nazwa', $matka)";
    mysqli_query($conn, $query);
}

//Funkcja odpowiadająca za usuwanie kategorii z bazy danych

function UsunKategorie($conn, $id) {
    $query = "DELETE FROM categories WHERE id = $id LIMIT 1";
    mysqli_query($conn, $query);
}


//  Funkcja odpowiadająca za usuwanie edycję kategorii w bazie danych

function EdytujKategorie($conn, $id, $nazwa, $matka) {
    $query = "UPDATE categories SET nazwa = '$nazwa', matka = $matka WHERE id = $id LIMIT 1";
    mysqli_query($conn, $query);
}


// Funkcja odpowiadająca za wyświetlanie kategorii oraz podkategorii

function PokazKategorie($conn, $matka = 0, $prefix = '') {
    $query = "SELECT * FROM categories WHERE matka = $matka";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo $prefix . $row['id'] . ' ' . $row['nazwa'] . "<br>";
        PokazKategorie($conn, $row['id'], $prefix . '--');
    }
}


//  Funkcja odpowiadająca za wyświetlanie formularza który wypełniamy

function DodajKategorieForm($conn) {
    echo '
    <h1>Dodaj nową kategorię</h1>
    <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
    <p>Nazwa kategorii</p> <input type="text" name="nazwa"/>
    <p>ID kategorii nadrzędnej (0 dla kategorii głównej)</p> <input type="number" name="matka" value="0"/>
    <br>
    <input type="submit" name="add_button" value="Dodaj"/>
    </form>
    ';

    if(isset($_POST['add_button'])) {
        $nazwa = $_POST['nazwa'];
        $matka = $_POST['matka'];
        DodajKategorie($conn, $nazwa, $matka);
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
}


//  Funkcja odpowiadająca za wyświetlanie formularza który wypełniamy

function UsunKategorieForm($conn) {
    echo '
    <h1>Usuń kategorię</h1>
    <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
    <p>ID kategorii do usunięcia</p> <input type="number" name="id"/>
    <br>
    <input type="submit" name="del_button" value="Usuń"/>
    </form>
    ';

    if(isset($_POST['del_button'])) {
        $id = $_POST['id'];
        UsunKategorie($conn, $id);
    }
}


//     Funkcja odpowiadająca za wyświetlanie formularza który wypełniamy


function EdytujKategorieForm($conn) {
    echo '
    <h1>Edytuj kategorię</h1>
    <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
    <p>ID kategorii do edycji</p> <input type="number" name="id"/>
    <p>Nowa nazwa kategorii</p> <input type="text" name="nazwa"/>
    <p>ID nowej kategorii nadrzędnej</p> <input type="number" name="matka"/>
    <br>
    <input type="submit" name="edit_button" value="Edytuj"/>
    </form>
    ';

    if(isset($_POST['edit_button'])) {
        $id = $_POST['id'];
        $nazwa = $_POST['nazwa'];
        $matka = $_POST['matka'];
        EdytujKategorie($conn, $id, $nazwa, $matka);
    }
}


//   Poniżej znajduje się podstawowy szkelet strony wraz z wywołaniami poszczególnych funkcji

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/admin.css">
    <title> Kategorie</title>
</head>

<body>
    <div class="container">
        <?php
        echo WylogujButton();
        echo SwitchSite('products.php', 'Produkty');
        echo SwitchSite('control_panel.php', 'Podstrony');
        DodajKategorieForm($conn);
        EdytujKategorieForm($conn);
        UsunKategorieForm($conn);
        PokazKategorie($conn);
        ?>
    </div>

</body>

</html>


