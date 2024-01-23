<?php

session_start();

include '../cfg.php';

// Funkcja służąca do edycji istniejącej strony o określonym ID.
function EdytujPodstrone($id)
{
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'moja_strona';

    $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (!$link) {
        die('Przerwane połączenie: ' . mysqli_connect_error());
    }

    $id_clear = htmlspecialchars($id);
    $query = "SELECT * FROM page_list WHERE id=? LIMIT 1";

    $stmt = mysqli_prepare($link, $query);

    if (!$stmt) {
        die('Błąd przy przygotowywaniu zapytania: ' . mysqli_error($link));
    }

    mysqli_stmt_bind_param($stmt, 's', $id_clear);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die('Błąd przy pobieraniu wyników: ' . mysqli_error($link));
    }

    $row = mysqli_fetch_assoc($result);

    // Wyświetlenie formularza edycji strony.
    echo '<form action="?action=update&id=' . $row['id'] . '" method="post">';
    echo 'ID: <input type="text" name="id" value="' . $row['id'] . '" readonly><br>';
    echo 'Title: <input type="text" name="title" value="' . $row['page_title'] . '"><br>';
    echo 'Content: <textarea name="content">' . $row['page_content'] . '</textarea><br>';
    echo 'Active: <input type="checkbox" name="active" ' . ($row['is_active'] ? 'checked' : '') . '><br>';
    echo '<input type="submit" value="Update">';
    echo '</form>';

    mysqli_stmt_close($stmt);
    mysqli_close($link);
}

// Funkcja służąca do dodawania nowej strony.
function DodajNowaPodstrone()
{
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'moja_strona';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        $active = isset($_POST['active']) ? 1 : 0;

        $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        if (!$link) {
            die('Przerwane połączenie: ' . mysqli_connect_error());
        }

        $query = "INSERT INTO page_list (page_title, page_content, is_active) VALUES (?, ?, ?) LIMIT 1";
        $stmt = mysqli_prepare($link, $query);

        if (!$stmt) {
            die('Błąd przy przygotowywaniu zapytania: ' . mysqli_error($link));
        }

        mysqli_stmt_bind_param($stmt, 'ssi', $title, $content, $active);
        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            die('Błąd przy wykonaniu zapytania: ' . mysqli_error($link));
        }

        mysqli_stmt_close($stmt);
        mysqli_close($link);

        // Komunikat o pomyślnym dodaniu nowej strony.
        echo 'New page added successfully!';
    }

    // Wyświetlenie formularza dodawania nowej strony.
    echo '<form action="?action=add" method="post">';
    echo 'Title: <input type="text" name="title"><br>';
    echo 'Content: <textarea name="content"></textarea><br>';
    echo 'Active: <input type="checkbox" name="active"><br>';
    echo '<input type="submit" name="submit" value="Add Page">';
    echo '</form>';
}

// Funkcja służąca do usuwania istniejącej strony o określonym ID.
function UsunPodstrone($id)
{
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'moja_strona';

    $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (!$link) {
        die('Przerwane połączenie: ' . mysqli_connect_error());
    }

    $id_clear = htmlspecialchars($id);
    $query = "DELETE FROM page_list WHERE id=? LIMIT 1";

    $stmt = mysqli_prepare($link, $query);

    if (!$stmt) {
        die('Błąd przy przygotowywaniu zapytania: ' . mysqli_error($link));
    }

    mysqli_stmt_bind_param($stmt, 's', $id_clear);
    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        die('Błąd przy wykonaniu zapytania: ' . mysqli_error($link));
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);

    // Komunikat o pomyślnym usunięciu strony.
    echo 'Page deleted successfully!';
}

// Funkcja wyświetlająca formularz logowania lub komunikat o błędnych danych logowania.
function FormularzLogowania()
{
    // Wyświetlenie formularza logowania.
    echo '<h2>Login</h2>';
    echo '<form action="" method="post">';
    echo 'Login: <input type="text" name="login" required><br>';
    echo 'Password: <input type="password" name="pass" required><br>';
    echo '<input type="submit" name="submit" value="Login">';
    echo '</form>';
}

// Obsługa wylogowywania użytkownika.
if (isset($_POST['submit']) && isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Wylogowanie użytkownika.
    session_unset();
    session_destroy();
    header('Location: admin.php');
    exit;
}

// Obsługa logowania użytkownika lub wyświetlenie formularza logowania.
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    if (isset($_POST['submit'])) {
        // ... (walidacja danych logowania)

        if ($enteredLogin === $login && $enteredPass === $pass) {
            // ... (udane logowanie)
        } else {
            // ... (komunikat o błędnych danych logowania)
            FormularzLogowania();
        }
    } else {
        FormularzLogowania();
    }
} else {
    // ... (wyświetlenie opcji dla zalogowanego użytkownika)
    echo 'Zalogowano';
}

?>

