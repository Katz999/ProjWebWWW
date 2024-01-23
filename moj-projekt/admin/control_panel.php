<?php
include('../cfg.php');

function Wyloguj()
{
    session_start();
    session_destroy();
    header("Location: ../index.php");
    exit();
}

function WylogujButton()
{
    echo '<form method="get"><input name= "wylogowywanie" type="submit" value="Wyloguj"></form>';
}

function SwitchSite($url, $tekstPrzycisku)
{
    echo '<form action="' . $url . '"><input type="submit" value="' . $tekstPrzycisku . '"></form>';
}

function ListaPodstron()
{
    global $conn;
    $query = "SELECT id, page_title FROM page_list";
    $result = mysqli_query($conn, $query);
    echo "<h2>Lista Podstron</h2>";
    while ($row = mysqli_fetch_array($result)) {
        echo '<p>' . $row['id'] . ' ' . $row['page_title'] . '</p>';
    }
}

function EdytujPodstrone()
{
    global $conn;
    $edit = '<h2>Edytuj Podstronę</h2>
    <form method="post" name="edit" enctype="multipart/form-data" action="' . $_SERVER['REQUEST_URI'] . '">
        <p><b>Id</p> <input type="text" name="id_strony"/>
        <p>Tytuł podstrony</p> <input type="text" name="page_title"/>
        <p>Treść podstrony</p> <textarea name="page_content" rows="5" cols="50"></textarea>
        <p>Status podstrony</p> <input type="checkbox" name="status"/>
        <br>
        <input type="submit" name="edycja_button" value="Edytuj"/>
    </form>';
    echo $edit;

    if (isset($_POST['edycja_button'])) {
        // Editing logic
    }
}

function DodajPodstrone()
{
    $add = '<h2>Dodaj nową podstronę</h2>
    <form method="post" name="edit" enctype="multipart/form-data" action="' . $_SERVER['REQUEST_URI'] . '">
        <p><b>Tytuł podstrony</p> <input type="text" name="page_title_add"/>
        <p>Treść podstrony</p> <textarea name="page_content_add" rows="5" cols="50"></textarea>
        <p>Status podstrony</p> <input type="checkbox" name="status_add"/>
        <br>
        <input type="submit" name="add_button" value="Dodaj"/>
    </form>';
    echo $add;

    if (isset($_POST['add_button'])) {
        // Adding logic
    }
}

function UsunPodstrone()
{
    $del = '<h2>Usuń Podstronę</h2>
    <form method="post" name="del" enctype="multipart/form-data" action="' . $_SERVER['REQUEST_URI'] . '">
        <p><b>Podaj id strony do usunięcia </p> <input type="text" name="id_del"/>
        <input type="submit" name="del_button" value="Usuń"/>
    </form>';
    echo $del;

    if (isset($_POST['del_button'])) {
        // Deleting logic
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
    
    SwitchSite('products.php', 'Produkty');
    SwitchSite('categories.php', 'Kategorie');
    echo '<h2>Podstrony</h2>';
    ListaPodstron();
    EdytujPodstrone();
    DodajPodstrone();
    UsunPodstrone();
    echo WylogujButton()
    ?>
</div>
</body>
</html>

