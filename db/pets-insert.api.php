<?php
    require_once("connect.php");
    header('Content-Type: application/json; charset=utf-8');
    $JsonResponse = new stdclass;
    $JsonResponse->status = "OK";

    // sanitize and clean values from user
    $name = trim(htmlspecialchars($_POST['name']));
    $breed = trim(htmlspecialchars($_POST['breed']));
    $age = $_POST['age']; #date_format($_POST['age'], 'Y-m-d');
    $weight = trim(htmlspecialchars($_POST['weight']));
    $chip = $_POST['chip'];
    $owner_id = $_POST['owner_id'];
    $home_clinic_id = $_POST['home_clinic_id'];
    $rabies_shot = date('Y-m-d');
    $last_visit = date('Y-m-d');
    $notes = trim(htmlspecialchars($_POST['notes']));

    try{
        $stmt = $db->prepare("INSERT INTO pets (name, breed, age, weight, chip, owner_id, home_clinic_id, rabies_shot, last_visit, notes) 
                                VALUES (:name, :breed, :age, :weight, :chip, :owner_id, :home_clinic_id, :rabies_shot, :last_visit, :notes)");

        // replace placeholder in query string with the values
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':breed', $breed);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':weight', $weight);
        $stmt->bindParam(':chip', $chip);
        $stmt->bindParam(':owner_id', $owner_id);
        $stmt->bindParam(':home_clinic_id', $home_clinic_id);
        $stmt->bindParam(':rabies_shot', $rabies_shot);
        $stmt->bindParam(':last_visit', $last_visit);
        $stmt->bindParam(':notes', $notes);
        
        $stmt->execute();
        // if no rows were affected by the execute
        if($stmt->rowCount() == 0){
            throw new Exception('execute failed, no rows were affected');
        }
    }
    catch(Exception $e){
        $JsonResponse->status = "Error";
        $JsonResponse->message = "sql insert error";
        $JsonResponse->extra_debug = $e;
        echo(json_encode($JsonResponse));
        die();
    }

    echo(json_encode($JsonResponse));
?>