<?php 
// link z którego otwieram ten plik: http://localhost:8080/search.php
    // echo 'Hello World!'; 
    // echo 'Hello ' . htmlspecialchars($_GET["name"]) . '!'; // przy wpisaniu http://localhost:8080/search.php/?name=klaudia pojawia się napis Hello klaudia
    // znak $ oznacza zmienną
    if($_GET["name"] ?? false){ // if do weryfikacji, czy zmienna została zdefiniowana - jeśli nie, wyświetli pustą stronę
        $fileContent = file_get_contents("cities.json"); // czyta zawartość pliku do nowej zmiennej
        // echo $fileContent; // wyświetla nową zmienną
        $decoded = json_decode($fileContent);
        // PĘTLA:
        $przerwij = 0;
        // tablica do zbierania:
        $tablica = [];
        foreach($decoded as &$city){
            $found = stripos($city->name, htmlspecialchars($_GET["name"])); // $_GET pobiera to, co zostało wpisane w link po znaku "?", htmlspecialchars wybiera z tego tylko tekst wpisany po "name="
            if($found != false){
                $przerwij += 1;
                array_push($tablica, $city->name);
            }
            if($przerwij == 10){
                break;
            }
        }
        return $tablica;
    }


// http://localhost:8080/KlaudiaToJa.github.io/google/search.php/?name=k // dla folderu w htdocs
?>