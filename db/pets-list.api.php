<?php
    require_once("connect.php");
    header('Content-Type: application/json; charset=utf-8');
    $JsonResponse = new stdClass;
    $JsonResponse->status = "OK";
    $result = array();

    try{
        $stmt = $db->query("SELECT id,name FROM pets");
    }
    catch(Exception $e){
        $JsonResponse->status = "Error";
        $JsonResponse->message = "sql query error";
        echo(json_encode($JsonResponse));
        die();
    }

    // for every row retrieved, add to result array
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($result, $row);
    }

    $JsonResponse->list = $result;
    echo(json_encode($JsonResponse));
?>