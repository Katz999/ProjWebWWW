<!DOCTYPE html>
<html>
    <body>  
    <div class="container">
            <div class="content">       
        <?php
    $nr_indeksu = '164446';
    $nr_grupy = '4';

    echo 'Michał Zembrowski '.$nr_indeksu. ' grupa '.$nr_grupy.'<br/><br/>';

    echo 'Zastosowanie metody include()<br/>';

    include './admin/admin.php';


    echo 'Zastosowanie metody require()<br/>';

    require 'test.php';

    echo 'include: Jeśli plik nie zostanie znaleziony, skrypt kontynuuje wykonywanie, a jedynie wyświetli się ostrzeżenie.
    require_once: Jeśli plik nie zostanie znaleziony, skrypt przerwie wykonanie z błędem fatalnym. <br/>';
    echo 'Zastosowanie warunków if, else, elseif, switch <br/>';



    $x = 3;
    $y = 4;

    if($x < $y)
    {
        echo 'Zmienna y jest większa od zmiennej x <br/>';
    }elseif($x > $y) {
        echo 'Zmienna x jest większa od zmiennej y <br/>';
    }
    else {
        echo 'Obie zmienne są sobie równe<br/>';
    }
    

    echo 'Zastosowanie pętli while i for <br/>';

    $i = 1;

    while($i < 10)
    {
        echo $i++.'<br/>';
    }


    for ($j = 0; $j <= 10; $j++) {
        echo "Numer: $j <br/>";
      }
    
      echo 'Zastosowanie $_GET, $_POST, $_SESSION <br/>';
      echo 'Cześć ' . htmlspecialchars($_GET["name"]) . '!<br/>';
      
      
    ?>
        </div>
    </div>
    </body>
</html>
