<?php

include('../cfg.php');

// Funkcja do wylogowywania użytkownika
function Wyloguj()
{
    session_start();
    session_destroy();
    header("Location: ../index.php");
    exit();
}

// Funkcja generująca przycisk do wylogowywania
function WylogujButton()
{
    echo '<form method="get">
            <input name= "wylogowywanie" type="submit" value="Wyloguj"></button>
          </form>';
}

// Sprawdzenie, czy naciśnięto przycisk wylogowywania
if(isset($_GET['wylogowywanie']) && $_GET['wylogowywanie']=='Wyloguj')
{
    Wyloguj();
}

// Funkcja generująca przycisk do przełączania się między stronami
function SwitchSite($url, $tekstPrzycisku) {
    echo '<form action="' . $url . '">';
    echo '<input type="submit" value="' . $tekstPrzycisku . '">';
    echo '</form>';
}

// Funkcja wyświetlająca listę podstron
function ListaPodstron() {
    global $conn;
    
    $query = "SELECT id, page_title FROM page_list";
    $result = mysqli_query($conn, $query);
    echo "<h2>Lista Podstron</h2>";
    
    while($row = mysqli_fetch_array($result)){
        echo '<p>' .$row['id'] . ' ' .$row['page_title']. '</p>';
    }
}

// Funkcja wyświetlająca formularz edycji podstrony
function EdytujPodstrone() {

    $edit = '
    <h2>Edytuj Podstronę</h2>
    <form method="post" name="edit" enctype="multipart/form-data" action="' . $_SERVER['REQUEST_URI'] . '">
    <p>Id</p> <input type="text" name="id_strony"/>
    <p>Tytuł podstrony</p> <input type="text" name="page_title"/>
    <p>Treść podstrony</p> <textarea name="page_content" rows="5" cols="50"></textarea>
    <p>Status podstrony</p> <input type="checkbox" name="status"/>
    <br>
    <input type="submit" name="edycja_button" value="Edytuj"/>
    </form>
    ';
    echo $edit;

    // Edycja podstrony z informacjami podanymi z formularza
    global $conn;
    if(isset($_POST['edycja_button'])) {
        $id = $_POST['id_strony'];
        $tytul = $_POST['page_title'];
        $tresc = $_POST['page_content'];
        $status = isset($_POST['status']) ? 1 : 0;

        if(!empty($id)) {
            $query = "UPDATE page_list SET page_title = '$tytul', page_content = '$tresc', status = '$status' WHERE id = '$id' LIMIT 1";
            $result = mysqli_query($conn, $query);

            if ($result) {
                header("Location: ".$_SERVER['PHP_SELF']);
                exit();
            } else {
                echo '<p class="error">Błąd podczas edycji podstrony.</p>';
            }
        }
    }
}

// Funkcja wyświetlająca formularz dodawania nowej podstrony
function DodajPodstrone() {
    $add = '
    <h2>Dodaj nową podstronę</h2>
    <form method="post" name="edit" enctype="multipart/form-data" action="' . $_SERVER['REQUEST_URI'] . '">
    <p>Tytuł podstrony</p> <input type="text" name="page_title_add"/>
    <p>Treść podstrony</p> <textarea name="page_content_add" rows="5" cols="50"></textarea>
    <p>Status podstrony</p> <input type="checkbox" name="status_add"/>
    <br>
    <input type="submit" name="add_button" value="Dodaj"/>
    </form>
    ';
    echo $add;

    // Dodawanie nowej podstrony z informacjami podanymi z formularza
    global $conn;
    if(isset($_POST['add_button'])) {
        $tytul = $_POST['page_title_add'];
        $tresc = $_POST['page_content_add'];
        $status = isset($_POST['status_add']) ? 1 : 0;

        $query = "INSERT INTO `page_list` (`page_title`, `page_content`, `status`) VALUES ('$tytul','$tresc','$status')";
        $result = mysqli_query($conn, $query);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}

// Funkcja wyświetlająca formularz usuwania podstrony
function UsunPodstrone() {
    $del = '
    <h2>Usun Podstronę</h2>
    <form method="post" name="del" enctype="multipart/form-data" action="' . $_SERVER['REQUEST_URI'] . '">
    <p>Id </p> <input type="text" name="id_del"/>
    <input type="submit" name="del_button" value="Usun"/>
    </form>
    ';
    echo $del;

    // Usuwanie podanej przez użytkownika podstrony
    global $conn;
    if (isset($_POST['del_button'])) {
        $id = $_POST['id_del'];
        $query = "DELETE FROM page_list WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $query);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Podstrony</title>
</head>

<body>
    <div class="container">
        <?php
        echo ListaPodstron();
        echo SwitchSite('products.php', 'Produkty');
        echo SwitchSite('categories.php', 'Kategorie');
        echo '<h2>Podstrony</h2>';
        echo EdytujPodstrone();
        echo DodajPodstrone();
        echo UsunPodstrone();        
        echo WylogujButton();
        ?>
    </div>
</body>

</html>

