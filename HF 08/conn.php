<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "egyetem";

global $conn;
$conn = new mysqli($servername, $username, $password, $dbname);
