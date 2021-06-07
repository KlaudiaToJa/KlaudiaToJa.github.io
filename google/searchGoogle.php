<?php 
    if($_GET["name"] ?? false){ 
        $fileContent = file_get_contents("cities.json");
        $decoded = json_decode($fileContent);
        $przerwij = 0;
        $tablica = [];
        echo "[";
        foreach($decoded as &$city){
            $found = stripos($city->name, htmlspecialchars($_GET["name"])); 
            if($found != false){
                $przerwij += 1;
                $miasto = json_encode($city);
                echo $miasto;
                if($przerwij !== 10){
                    echo ", ";
                }
            }
            if($przerwij == 10){
                break;
            }
        }
        echo "]";
        
    }
// http://localhost:8080/KlaudiaToJa.github.io/google/searchGoogle.php/?name= // dla folderu w htdocs
?>