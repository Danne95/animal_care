<?php
    require_once("connect.php");
    header('Content-Type: application/json; charset=utf-8');
    $jsonResponse = new stdClass;
    $jsonResponse->status = "OK";

    // sanitize and clean values from user
    $name = trim(htmlspecialchars($_POST['name']));
    $surname = trim(htmlspecialchars($_POST['surname']));
    $address = trim(htmlspecialchars($_POST['address']));
    $phone = trim(htmlspecialchars($_POST['phone']));

    try{
        $stmt = $db->prepare("INSERT INTO owners (name, surname, address, phone) 
                                VALUES (:name, :surname, :address, :phone)");

        // replace placeholder in query string with the values
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':phone', $phone);

        $stmt->execute();
        // if no rows were affected by the execute
        if($stmt->rowCount() == 0){
            throw new Exception('execute failed, no rows were affected');
        }
    }
    catch(Exception $e){
        $jsonResponse->status = "Error";
        $jsonResponse->message = "sql insert error";
        echo(json_encode($jsonResponse));
        die();
    }

    echo(json_encode($jsonResponse));
?>