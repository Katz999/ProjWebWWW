<?php

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
    mysqli_stmt_bind_param($stmt, 's', $id_clear);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

 
    $row = mysqli_fetch_assoc($result);

    
    echo '<form action="?action=update&id=' . $row['id'] . '" method="post">';
    echo 'Title: <input type="text" name="title" value="' . $row['page_title'] . '"><br>';
    echo 'Content: <textarea name="content">' . $row['page_content'] . '</textarea><br>';
    echo 'Active: <input type="checkbox" name="active" ' . ($row['is_active'] ? 'checked' : '') . '><br>';
    echo '<input type="submit" value="Update">';
    echo '</form>';

    
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}


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
        mysqli_stmt_bind_param($stmt, 'ssi', $title, $content, $active);
        mysqli_stmt_execute($stmt);

        
        mysqli_stmt_close($stmt);
        mysqli_close($link);

        echo 'New page added successfully!';
    }


    echo '<form action="?action=add" method="post">';
    echo 'Title: <input type="text" name="title"><br>';
    echo 'Content: <textarea name="content"></textarea><br>';
    echo 'Active: <input type="checkbox" name="active"><br>';
    echo '<input type="submit" name="submit" value="Add Page">';
    echo '</form>';
}


if (isset($_GET['action']) && $_GET['action'] === 'add') {
    DodajNowaPodstrone();
}

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
    mysqli_stmt_bind_param($stmt, 's', $id_clear);
    mysqli_stmt_execute($stmt);

 
    mysqli_stmt_close($stmt);
    mysqli_close($link);

    echo 'Page deleted successfully!';
}


if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id_to_delete = $_GET['id'];
    UsunPodstrone($id_to_delete);
}

session_start();

include 'cfg.php';


if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
 
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
      
        echo 'Welcome to the admin panel!';
    }

} else {
   
    if (isset($_POST['submit'])) {
        $enteredLogin = $_POST['login'];
        $enteredPass = $_POST['pass'];

        if ($enteredLogin === $login && $enteredPass === $pass) {
            
            $_SESSION['logged_in'] = true;

            
            header('Location: admin.php');
            exit;
        } else {
           
            echo 'Invalid login credentials. Please try again.';
            FormularzLogowania();
        }
    } else {
        
        FormularzLogowania();
    }
}


function FormularzLogowania()
{
    echo '<h2>Login</h2>';
    echo '<form action="" method="post">';
    echo 'Login: <input type="text" name="login" required><br>';
    echo 'Password: <input type="password" name="pass" required><br>';
    echo '<input type="submit" name="submit" value="Login">';
    echo '</form>';
}


?>
