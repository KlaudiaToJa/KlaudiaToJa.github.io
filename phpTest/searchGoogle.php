<?php 
    if($_GET["name"] ?? false){ 
        $fileContent = file_get_contents("cities.json");
        $decoded = json_decode($fileContent);
        $przerwij = 0;
        $tablica = [];
        foreach($decoded as &$city){
            $found = stripos($city->name, htmlspecialchars($_GET["name"])); 
            if($found != false){
                $przerwij += 1;
                array_push($tablica, $city);
            }
            if($przerwij == 10){
                break;
            }
        }
        echo json_encode($tablica);
    }
// http://localhost:8080/KlaudiaToJa.github.io/google/searchGoogle.php/?name= // dla folderu w htdocs
?>