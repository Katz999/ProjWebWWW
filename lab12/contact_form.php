<?php
require_once("contact.php");

// Utwórz instancję klasy Kontakt
$kontakt = new Kontakt();

// Obsługa formularza kontaktowego
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {
    $action = $_POST["action"];

    switch ($action) {
        case "wyslij_mail":
            $kontakt->WyslijMailKontakt();
            break;

        case "przypomnij_haslo":
            $kontakt->PrzypomnijHaslo();
            break;

        default:
            // Dodaj obsługę dodatkowych akcji, jeśli potrzebujesz
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt i Przypomnienie hasła</title>
    <link rel="stylesheet" href="./css/form.css">
</head>
<body>

<div class="container">
    <?php
    // Wywołaj metodę PokazKontakt() dla wyświetlenia informacji kontaktowych
    $kontakt->PokazKontakt();
    ?>

    <h2>Formularz Kontaktowy</h2>
    <form action="" method="post">
        <input type="hidden" name="action" value="wyslij_mail">
        Imię: <input type="text" name="imie" required><br>
        Email: <input type="email" name="email" required><br>
        Wiadomość: <textarea name="wiadomosc" required></textarea><br>
        <input type="submit" value="Wyślij">
    </form>

    <h2>Przypomnij Hasło</h2>
    <form action="" method="post">
        <input type="hidden" name="action" value="przypomnij_haslo">
        Email: <input type="email" name="email" required><br>
        <input type="submit" value="Przypomnij Hasło">
    </form>
</div>
<?php
$kontakt = new Kontakt();

// Wywołaj metodę WyslijMailKontakt() z przykładowymi danymi
$_POST["temat"] = "Temat wiadomości";
$_POST["tresc"] = "Treść wiadomości";
$_POST["email"] = "nadawca@example.com";
$kontakt->WyslijMailKontakt("adres_odbiorcy@example.com");
?>
</body>
</html>
