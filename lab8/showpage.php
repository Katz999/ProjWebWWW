<?php
function PokazPodstrone($id)
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
    mysqli_stmt_bind_param($stmt, 's', $id_clear);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $row = mysqli_fetch_array($result);

    if (empty($row['id'])) {
        $web = '[nie_znaleziono_strony]';
    } else {
        $web = $row['page_content'];
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);

    return $web;
}

function ListaPodstron()
{
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'moja_strona';

    // Establish a database connection
    $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Check the connection
    if (!$link) {
        die('Przerwane połączenie: ' . mysqli_connect_error());
    }

    // Use prepared statement to prevent SQL injection
    $query = "SELECT id, page_title FROM page_list";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    // Display the list of pages
    echo '<ul>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<li>';
        echo 'ID: ' . $row['id'] . ' | Title: ' . $row['page_title'];
        echo ' | <a href="?action=edit&id=' . $row['id'] . '">Edit</a>';
        echo ' | <a href="?action=delete&id=' . $row['id'] . '">Delete</a>';
        echo '</li>';
    }
    echo '</ul>';

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}

// Handle actions (edit/delete) if present in the URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    // Depending on the action, you can include logic for edit/delete
    if ($action === 'edit') {
        echo 'Editing page with ID ' . $id;
        // Add your editing logic here
    } elseif ($action === 'delete') {
        echo 'Deleting page with ID ' . $id;
        // Add your deletion logic here
    }
}

// Example usage
ListaPodstron();
?>
