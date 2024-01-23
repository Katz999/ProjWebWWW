<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = "shop_categories";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

class ZarzadzanieKategoriami {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->createTable();
    }

    private function createTable() {
        $query = "
        CREATE TABLE IF NOT EXISTS kategorie (
            id INT AUTO_INCREMENT PRIMARY KEY,
            matka INT DEFAULT 0,
            nazwa VARCHAR(255) NOT NULL
        )
        ";
        $this->conn->query($query);
    }

    public function dodajKategorie($nazwa, $matka = 0) {
        $query = "
        INSERT INTO kategorie (matka, nazwa) VALUES (?, ?)
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $matka, $nazwa);
        $stmt->execute();
        $stmt->close();
    }

    public function usunKategorie($id_kategorii) {
        $query = "
        DELETE FROM kategorie WHERE id = ?
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id_kategorii);
        $stmt->execute();
        $stmt->close();
    }

    public function edytujKategorie($id_kategorii, $nowa_nazwa) {
        $query = "
        UPDATE kategorie SET nazwa = ? WHERE id = ?
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $nowa_nazwa, $id_kategorii);
        $stmt->execute();
        $stmt->close();
    }

    public function pokazKategorie() {
        $query = "
        SELECT * FROM kategorie
        ";
        $result = $this->conn->query($query);

        $kategorie = array();

        while ($row = $result->fetch_assoc()) {
            $kategorie[] = $row;
        }

        return $kategorie;
    }
}

$zarzadzanieKategoriami = new ZarzadzanieKategoriami($conn);

// Przykładowe użycie
$zarzadzanieKategoriami->dodajKategorie("Elektronika");
$zarzadzanieKategoriami->dodajKategorie("Telewizory", 1);
$zarzadzanieKategoriami->dodajKategorie("Telefony", 1);

$kategorie = $zarzadzanieKategoriami->pokazKategorie();

echo "<pre>";
print_r($kategorie);
echo "</pre>";

$conn->close();

?>

