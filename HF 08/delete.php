<?php
require ('conn.php');
session_start();
if(!isset($_SESSION['logged_in']) || !($_SESSION['logged_in'])){
    header("Location: login.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["id"])){
        $id = $_POST["id"];

        $conn = $GLOBALS['conn'];
        if($conn->connect_error){
            var_dump($conn->error_list);
            die("Nem tudtam kapcsolódni <br>");
        }
        else {
            if ($conn->query("DELETE FROM hallgatok WHERE id = " . $id)) {
                header("Location: index.php");
            }
            else {
                die("Sikertelen törlés");
            }
        }


    }
}