<?php
    require("connect.php");
    header('Content-Type: application/json; charset=utf-8');
    $jsonResponse = new stdClass;
    $jsonResponse->status = "OK";
    $result = array();

    try{
        $stmt = $db->query("SELECT pets.name, owners.name AS owner, pets.chip, pets.rabies_shot, owners.phone
                            FROM pets 
                            JOIN owners ON pets.owner_id = owners.id");
    }
    catch(Exception $e){
        $jsonResponse->status = "Error";
        $jsonResponse->message = "sql query error";
        echo(json_encode($jsonResponse));
        die();
    }

    // for every row retrieved, add to result array
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($result, $row);
    }

    $jsonResponse->list = $result;
    echo(json_encode($jsonResponse));
?>