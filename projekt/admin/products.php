<?php

include('../cfg.php');

//              ******************************************
//Funkcja odpowiadająca za wylogowywanie

function Wyloguj()
{
    session_start();
    session_destroy();
    header("Location: ../index.php");
    exit();
}

//Przycisk wylogowania
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

//przycisk do zmiany strony

function SwitchSite($url, $tekstPrzycisku) {
    echo '<form action="' . $url . '">';
    echo '<input type="submit" value="' . $tekstPrzycisku . '">';
    echo '</form>';
}


// Funkcja która dodaje produkt do bazy danych

function DodajProdukt($conn, $produkt) {
    $query = "INSERT INTO produkty (tytul, opis, data_utworzenia, data_modyfikacji, data_wygasniecia, cena_netto, podatek_vat, ilosc_sztuk, status_dostepnosci, kategoria, gabaryt_produktu, zdjecie) VALUES (?, ?, NOW(), NOW(), ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssddiissss', $produkt['tytul'], $produkt['opis'], $produkt['data_wygasniecia'], $produkt['cena_netto'], $produkt['podatek_vat'], $produkt['ilosc_sztuk'], $produkt['status_dostepnosci'], $produkt['kategoria'], $produkt['gabaryt_produktu'], $produkt['zdjecie']);
        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            // Handle error, e.g., log it or display an error message
            echo "Error adding product: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        // Handle prepare error
        echo "Error preparing statement: " . mysqli_error($conn);
    }
}


// Funkcja która usuwa produkt z bazy danych


function UsunProdukt($conn, $id) {
    $query = "DELETE FROM produkty WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
}


//Funkcja która edytuje produkt w bazie danych


function EdytujProdukt($conn, $id, $noweDane) {
    $query = "UPDATE produkty SET tytul = ?, opis = ?, data_modyfikacji = NOW(), data_wygasniecia = ?, cena_netto = ?, podatek_vat = ?, ilosc_sztuk = ?, status_dostepnosci = ?, kategoria = ?, gabaryt_produktu = ?, zdjecie = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ssddiissssi', $noweDane['tytul'], $noweDane['opis'], $noweDane['data_wygasniecia'], $noweDane['cena_netto'], $noweDane['podatek_vat'], $noweDane['ilosc_sztuk'], $noweDane['status_dostepnosci'], $noweDane['kategoria'], $noweDane['gabaryt_produktu'], $noweDane['zdjecie'], $id);
        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            // Handle error, e.g., log it or display an error message
            echo "Error updating product: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        // Handle prepare error
        echo "Error preparing statement: " . mysqli_error($conn);
    }
}


//  Funkcja która wyświetla liste produkt z bazy danych dla użytkownika

function Pokazprodukty($conn) {
    $query = "SELECT * FROM produkty";
    $result = mysqli_query($conn, $query);

    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Kategoria</th><th>Tytuł</th><th>Opis</th><th>Podatek VAT</th><th>Cena netto</th><th>Ilość sztuk</th><th>Zdjęcie</th></tr>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['kategoria'] . '</td>';
        echo '<td>' . $row['tytul'] . '</td>';
        echo '<td>' . $row['opis'] . '</td>';
        echo '<td>' . $row['podatek_vat'] . '</td>';
        echo '<td>' . $row['cena_netto'] . '</td>';
        echo '<td>' . $row['ilosc_sztuk'] . '</td>';
        echo '<td><img src="' . $row['zdjecie'] . '" alt="Zdjęcie produktu"></td>';
        echo '</tr>';
    }
    echo '</table>';
}


// Funkcja która wyświetla formularz do wypełniania w celu dodania produktu 


function DodajProduktForm($conn) {
    echo '
    <h2>Dodaj nowy produkt</h2>
    <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
    <p>Tytuł produktu</p> <input type="text" name="tytul"/>
    <p>Opis produktu</p> <textarea name="opis"></textarea>
    <p>Data wygaśnięcia produktu</p> <input type="date" name="data_wygasniecia"/>
    <p>Cena netto produktu</p> <input type="number" step="0.01" name="cena_netto"/>
    <p>Podatek VAT produktu</p> <input type="number" step="0.01" name="podatek_vat"/>
    <p>Ilość sztuk produktu</p> <input type="number" name="ilosc_sztuk"/>
    <p>Status dostępności produktu</p> <input type="checkbox" name="status_dostepnosci"/>
    <p>Kategoria produktu</p> <input type="text" name="kategoria"/>
    <p>Gabaryt produktu</p> <input type="text" name="gabaryt_produktu"/>
    <p>Zdjęcie produktu</p> <input type="text" name="zdjecie"/>
    <br>
    <input type="submit" name="add_button" value="Dodaj"/>
    </form>
    ';

    if(isset($_POST['add_button'])) {
        $produkt = array(
            'tytul' => $_POST['tytul'],
            'opis' => $_POST['opis'],
            'data_wygasniecia' => $_POST['data_wygasniecia'],
            'cena_netto' => $_POST['cena_netto'],
            'podatek_vat' => $_POST['podatek_vat'],
            'ilosc_sztuk' => $_POST['ilosc_sztuk'],
            'status_dostepnosci' => isset($_POST['status_dostepnosci']) ? 1 : 0,
            'kategoria' => $_POST['kategoria'],
            'gabaryt_produktu' => $_POST['gabaryt_produktu'],
            'zdjecie' => $_POST['zdjecie']
        );

        DodajProdukt($conn, $produkt);

        // Redirect after adding a new product
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
}

// Funkcja która wyświetla formularz do wypełniania w celu usunięcia produktu 


function UsunProduktForm($conn) {
    echo '
    <h2>Usuń produkt</h2>
    <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
    <p>ID produktu do usunięcia</p> <input type="number" name="id"/>
    <br>
    <input type="submit" name="del_button" value="Usuń"/>
    </form>
    ';

    if(isset($_POST['del_button'])) {
        $id = $_POST['id'];
        UsunProdukt($conn, $id);
    }
}

//   Funkcja która wyświetla formularz do wypełniania w celu edytowania produktu 


function EdytujProduktForm($conn) {
    echo '
    <h2>Edytuj produkt</h2>
    <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">
    <p>ID produktu do edycji</p> <input type="number" name="id"/>
    <p>Nowy tytuł produktu</p> <input type="text" name="tytul"/>
    <p>Nowy opis produktu</p> <textarea name="opis"></textarea>
    <p>Nowa data wygaśnięcia produktu</p> <input type="date" name="data_wygasniecia"/>
    <p>Nowa cena netto produktu</p> <input type="number" step="0.01" name="cena_netto"/>
    <p>Nowy podatek VAT produktu</p> <input type="number" step="0.01" name="podatek_vat"/>
    <p>Nowa ilość sztuk produktu</p> <input type="number" name="ilosc_sztuk"/>
    <p>Nowy status dostępności produktu</p> <input type="checkbox" name="status_dostepnosci"/>
    <p>Nowa kategoria produktu</p> <input type="text" name="kategoria"/>
    <p>Nowy gabaryt produktu</p> <input type="text" name="gabaryt_produktu"/>
    <p>Nowe zdjęcie produktu</p> <input type="text" name="zdjecie"/>
    <br>
    <input type="submit" name="edit_button" value="Edytuj"/>
    </form>
    ';

    if(isset($_POST['edit_button'])) {
        $id = $_POST['id'];
        $noweDane = array(
            'tytul' => $_POST['tytul'],
            'opis' => $_POST['opis'],
            'data_wygasniecia' => $_POST['data_wygasniecia'],
            'cena_netto' => $_POST['cena_netto'],
            'podatek_vat' => $_POST['podatek_vat'],
            'ilosc_sztuk' => $_POST['ilosc_sztuk'],
            'status_dostepnosci' => isset($_POST['status_dostepnosci']) ? 1 : 0,
            'kategoria' => $_POST['kategoria'],
            'gabaryt_produktu' => $_POST['gabaryt_produktu'],
            'zdjecie' => $_POST['zdjecie']
        );

        EdytujProdukt($conn, $id, $noweDane);
    }
}


// Poniżej znajduje się podstawowy szkelet strony wraz z wywołaniami poszczególnych funkcji

?>


<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/admin.css">
    <title> produkty</title>
</head>

<body>
    <div class="container">
        <?php
        echo WylogujButton();
        echo SwitchSite('control_panel.php', 'Podstrony');
        echo SwitchSite('categories.php', 'Kategorie');
        DodajProduktForm($conn);
        EdytujProduktForm($conn);
        UsunProduktForm($conn);
        Pokazprodukty($conn);
        ?>
    </div>

</body>

</html>
