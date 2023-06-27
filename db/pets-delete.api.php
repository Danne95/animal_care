<?php
    require_once("connect.php");
    header('Content-Type: application/json; charset=utf-8');
    $jsonResponse = new stdClass;
    $jsonResponse->status = "OK";

    $id = $_POST['id'];

    try{
        $stmt = $db->prepare("DELETE FROM pets WHERE id=:id");

        // replace placeholder in query string with the values
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        // if no rows were affected by the execute
        if($stmt->rowCount() == 0){
            throw new Exception('execute failed, no rows were affected');
        }
    }
    catch(Exception $e){
        $JsonResponse->status = "Error";
        $JsonResponse->message = "sql delete error";
        $JsonResponse->extra_debug = $e;
        echo(json_encode($JsonResponse));
        die();
    }

    echo(json_encode($JsonResponse));
?>