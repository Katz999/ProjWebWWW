<?php
$a = 3422;
$b = 342234;
$nr_indeksu = 164446;
$nrGrupy = 4;
echo "zmienna $_GET zmienna przekazywana przez adres URL";
echo 'cześć ' . htmlspecialchars($_GET["imie"]) . '!';
echo "Michał Zembrowski ".$nr_indeksu." grupa ".$nrGrupy."<br /><br />";
echo "Zastosowanie metody include() <br /><br />";
echo "funkcja include dodaje funkcje oraz zmienne danego pliku"
include 'nowy.php';
echo "podobne do include, ale dany plik jest wymagany"
require_once 'nowy.php';
echo "Warunki if, else, elseif, switch: służą do warunkowego wykonywania poleceń<br /><br />";
if ($a > $b){
    echo "a jest większe niż b<br /><br />";}
elseif($a = $b){
    echo "a jest równe b<br /><br />";
}
else {
    echo "b jest większe niż a<br /><br />";
}
echo "Warunek while: wykonuje dane polecenie dopóki dany warunek jest spełniony <br /><br />"
$i = 1;
while ($i <= 10):
    echo $i;
    $i++;
endwhile;
echo "Pętla for:"
for ($x = 0; $x <= 10; $x++) {
  echo "Numer: $x <br>";
} 
