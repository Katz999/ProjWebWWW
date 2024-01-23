<?php

class SystemZarzadzaniaProduktami {
    private $conn;

    public function __construct($host, $username, $password, $database) {
        $this->conn = new mysqli($host, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Błąd połączenia z bazą danych: " . $this->conn->connect_error);
        }
    }

    public function dodajProdukt($tytul, $opis, $cenaNetto, $podatekVAT, $iloscSztuk, $statusDostepnosci, $kategoria, $gabarytProduktu, $zdjecieLink) {
        $tytul = $this->conn->real_escape_string($tytul);
        $opis = $this->conn->real_escape_string($opis);
        $kategoria = $this->conn->real_escape_string($kategoria);
        $gabarytProduktu = $this->conn->real_escape_string($gabarytProduktu);
        $zdjecieLink = $this->conn->real_escape_string($zdjecieLink);

        $query = "
            INSERT INTO produkty (tytul, opis, cena_netto, podatek_vat, ilosc_dostepnych_sztuk, status_dostepnosci, kategoria, gabaryt_produktu, zdjecie_link)
            VALUES ('$tytul', '$opis', '$cenaNetto', '$podatekVAT', '$iloscSztuk', '$statusDostepnosci', '$kategoria', '$gabarytProduktu', '$zdjecieLink')
        ";

        $this->conn->query($query);
    }

    public function usunProdukt($produktId) {
        $query = "DELETE FROM produkty WHERE id = '$produktId'";
        $this->conn->query($query);
    }

    public function edytujProdukt($produktId, $tytul, $opis, $cenaNetto, $podatekVAT, $iloscSztuk, $statusDostepnosci, $kategoria, $gabarytProduktu, $zdjecieLink) {
        $tytul = $this->conn->real_escape_string($tytul);
        $opis = $this->conn->real_escape_string($opis);
        $kategoria = $this->conn->real_escape_string($kategoria);
        $gabarytProduktu = $this->conn->real_escape_string($gabarytProduktu);
        $zdjecieLink = $this->conn->real_escape_string($zdjecieLink);

        $query = "
            UPDATE produkty
            SET tytul = '$tytul', opis = '$opis', cena_netto = '$cenaNetto', podatek_vat = '$podatekVAT',
                ilosc_dostepnych_sztuk = '$iloscSztuk', status_dostepnosci = '$statusDostepnosci',
                kategoria = '$kategoria', gabaryt_produktu = '$gabarytProduktu', zdjecie_link = '$zdjecieLink'
            WHERE id = '$produktId'
        ";

        $this->conn->query($query);
    }

    public function pokazProdukty() {
        $query = "SELECT * FROM produkty";
        $result = $this->conn->query($query);

        while ($row = $result->fetch_assoc()) {
            echo "<pre>";
            print_r($row);
            echo "</pre>";
        }
    }

    public function __destruct() {
        $this->conn->close();
    }
}

// Przykładowe użycie
$systemProduktow = new SystemZarzadzaniaProduktami('localhost', 'username', 'password', 'nazwa_bazy_danych');

// Dodaj kilka przykładowych produktów
$systemProduktow->dodajProdukt('Telewizor', 'Nowoczesny telewizor LED', 1500.00, 0.23, 50, 'Dostępny', 'Elektronika', 'Duży', 'link_do_zdjecia1.jpg');
$systemProduktow->dodajProdukt('Smartphone', 'Smartphone z najnowszymi funkcjami', 800.00, 0.23, 100, 'Dostępny', 'Elektronika', 'Średni', 'link_do_zdjecia2.jpg');
$systemProduktow->dodajProdukt('Konsola do gier', 'Nowoczesna konsola do gier', 1200.00, 0.23, 30, 'Niedostępny', 'Elektronika', 'Średni', 'link_do_zdjecia3.jpg');

// Wyświetl produkty
$systemProduktow->pokazProdukty();
?>

