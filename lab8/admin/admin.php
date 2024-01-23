<?php

function EdytujPodstrone($id)
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
    $id_clear = htmlspecialchars($id);
    $query = "SELECT * FROM page_list WHERE id=? LIMIT 1";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $id_clear);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    // Fetch the result
    $row = mysqli_fetch_assoc($result);

    // Display the edit form
    echo '<form action="?action=update&id=' . $row['id'] . '" method="post">';
    echo 'Title: <input type="text" name="title" value="' . $row['page_title'] . '"><br>';
    echo 'Content: <textarea name="content">' . $row['page_content'] . '</textarea><br>';
    echo 'Active: <input type="checkbox" name="active" ' . ($row['is_active'] ? 'checked' : '') . '><br>';
    echo '<input type="submit" value="Update">';
    echo '</form>';

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}

// Example usage
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    EdytujPodstrone($id);
}

function DodajNowaPodstrone()
{
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'moja_strona';

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
        $active = isset($_POST['active']) ? 1 : 0; // Convert checkbox value to 1 or 0

        // Establish a database connection
        $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        // Check the connection
        if (!$link) {
            die('Przerwane połączenie: ' . mysqli_connect_error());
        }

        // Use prepared statement to prevent SQL injection
        $query = "INSERT INTO page_list (page_title, page_content, is_active) VALUES (?, ?, ?) LIMIT 1";
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, 'ssi', $title, $content, $active);
        mysqli_stmt_execute($stmt);

        // Close the statement and connection
        mysqli_stmt_close($stmt);
        mysqli_close($link);

        echo 'New page added successfully!';
    }

    // Display the add new page form
    echo '<form action="?action=add" method="post">';
    echo 'Title: <input type="text" name="title"><br>';
    echo 'Content: <textarea name="content"></textarea><br>';
    echo 'Active: <input type="checkbox" name="active"><br>';
    echo '<input type="submit" name="submit" value="Add Page">';
    echo '</form>';
}

// Example usage
if (isset($_GET['action']) && $_GET['action'] === 'add') {
    DodajNowaPodstrone();
}

function UsunPodstrone($id)
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
    $id_clear = htmlspecialchars($id);
    $query = "DELETE FROM page_list WHERE id=? LIMIT 1";

    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $id_clear);
    mysqli_stmt_execute($stmt);

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($link);

    echo 'Page deleted successfully!';
}

// Example usage
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id_to_delete = $_GET['id'];
    UsunPodstrone($id_to_delete);
}

session_start();

include 'cfg.php';

// Check if the user is already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // If logged in, allow access to administrative methods
    if (isset($_GET['action'])) {
        $action = $_GET['action'];

        switch ($action) {
            case 'edit':
                EdytujPodstrone($_GET['id']);
                break;
            case 'delete':
                UsunPodstrone($_GET['id']);
                break;
            case 'add':
                DodajNowaPodstrone();
                break;
            default:
                echo 'Invalid action.';
        }
    } else {
        // If no specific action, display a welcome message or other content
        echo 'Welcome to the admin panel!';
    }

} else {
    // If not logged in, check login credentials
    if (isset($_POST['submit'])) {
        $enteredLogin = $_POST['login'];
        $enteredPass = $_POST['pass'];

        if ($enteredLogin === $login && $enteredPass === $pass) {
            // If login is successful, set session variables
            $_SESSION['logged_in'] = true;

            // Redirect to avoid form resubmission on refresh
            header('Location: admin.php');
            exit;
        } else {
            // If login fails, display an error message and the login form
            echo 'Invalid login credentials. Please try again.';
            FormularzLogowania();
        }
    } else {
        // Display the login form if not submitted
        FormularzLogowania();
    }
}

// Function to display the login form
function FormularzLogowania()
{
    echo '<h2>Login</h2>';
    echo '<form action="" method="post">';
    echo 'Login: <input type="text" name="login" required><br>';
    echo 'Password: <input type="password" name="pass" required><br>';
    echo '<input type="submit" name="submit" value="Login">';
    echo '</form>';
}


// Include your other methods and functions here

?>
