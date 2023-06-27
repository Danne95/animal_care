<?php
    try{
        $db = new PDO('mysql:host=localhost;dbname=animal_clinic_db;charset=utf8','root', '');
    }
    catch(Exception $e){
        echo"Error connecting to db <br>";
    }
?>