<?php

class Kontakt
{
    public function PokazKontakt()
    {
        echo '<h1>Kontakt</h1>';
        echo '<p>Tutaj znajdziesz nasze dane kontaktowe:</p>';
        echo '<p>Email: email@example.com</p>';
        echo '<p>Telefon: 123-456-789</p>';


        echo '<h2>Formularz Kontaktowy</h2>';
        echo '<form action="?action=wyslij_mail" method="post">';
        echo '    Imię: <input type="text" name="imie" required><br>';
        echo '    Email: <input type="email" name="email" required><br>';
        echo '    Wiadomość: <textarea name="wiadomosc" required></textarea><br>';
        echo '    <input type="submit" value="Wyślij">';
        echo '</form>';
    }

    public function WyslijMailKontakt()
    {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $imie = $_POST["imie"];
            $email = $_POST["email"];
            $wiadomosc = $_POST["wiadomosc"];


            mail('adres_odbiorcy@example.com', 'Nowa wiadomość od ' . $imie, $wiadomosc, 'From: ' . $email);

            echo "Wiadomość została wysłana pomyślnie!";
        }
    }

    public function PrzypomnijHaslo()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
            $email = $_POST["email"];

            if ($email === 'admin@example.com') {
       
                $noweHaslo = $this->generujNoweHaslo();

                
                $this->WyslijMailKontakt($email, 'Przypomnienie hasła', 'Twoje nowe hasło: ' . $noweHaslo);

                echo "Nowe hasło zostało wysłane na adres email administratora.";
            } else {
                echo "Brak konta powiązanego z podanym adresem email.";
            }
        }
    }

    private function generujNoweHaslo()
    {

        return substr(md5(rand()), 0, 8);
    }
}


$kontakt = new Kontakt();


$kontakt->PokazKontakt();

function WyslijMailaKontakt($odbiorca)
{
    if (empty($_POST['temat']) || empty($_POST['tresc']) || empty($_POST['email'])) {
        echo '[nie_wypelniles_pola]';
        echo $kontakt->PokazKontakt();
    } else {
        $mail['subject'] = $_POST['temat'];
        $mail['body'] = $_POST['tresc'];
        $mail['sender'] = $_POST['email'];
        $mail['recipient'] = $odbiorca;

        $header = "From: Formularz kontaktowy <" . $mail['sender'] . ">\n";
        $header .= "MIME-version: 1.0\nContent-Type: text/plain; charset=utf-8\nContent-Transfer-Encoding:";
        $header .= "X-Sender: <" . $mail['sender'] . ">\n";
        $header .= "X-Mailer: PRapwww mail 1.2\n";
        $header .= "X-Priority: 3\n";
        $header .= "Return-Path: <" . $mail['sender'] . ">\n";

        mail($mail['recipient'], $mail['subject'], $mail['body'], $header);
        echo '[wiadomosc_wyslana]';
    }
}

?>
