<?php
    require_once("connect.php");
    header('Content-Type: application/json; charset=utf-8');
    $jsonResponse = new stdClass;
    $jsonResponse->status = "OK";
    $result = array();

    try{
        $stmt = $db->query("SELECT id,name FROM owners");
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
    echo (json_encode($jsonResponse))
?>