<?php
session_start();
if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || !isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit();
}


require ('conn.php');
$conn = $GLOBALS['conn'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nev']) && isset($_POST['szak'])) {
        $nev = $_POST['nev'];
        $szak = $_POST['szak'];
        if (!isset($_POST['atlag'])) {
            $atlag = 0.0;
        } else {
            $atlag = $_POST['atlag'];
        }

        // Módosítás: Használjunk prepared statementet a paraméterekkel
        $insert = $conn->prepare("INSERT INTO hallgatok (nev, szak, atlag) VALUES (?, ?, ?)");
        $insert->bind_param("ssd", $nev, $szak, $atlag);

        if ($insert->execute()) {
            header("Location: index.php");
        } else {
            echo "Hiba a beszúrás során: " . $insert->error;
        }
    }
} else {
    header("Location: index.php");
}
?>
