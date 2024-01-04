<?php

$dbname = "stocksdb";
$host = "localhost";
$port = 3306;
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname, $port);

if($conn->connect_errno)
{
    die("Nem sikerült kapcsolódni a db-re <br>". $conn->connect_error);
}
else
{
   
}