<?php

require_once ("dbManager.php");
include("header.html");

session_start();

if (isset($_GET["ticker"]))
    $_SESSION["ticker"] = $_GET["ticker"];

if(isset($_SESSION["ticker"])){
  global $conn;
  $sql = $conn->prepare("SELECT * from stocks WHERE ticker = ?");
  $sql->bind_param("s", $_SESSION["ticker"]);
  $sql->execute();
  $result = $sql->get_result()->fetch_assoc();

  echo '<h1>'.$result["name"].' ('.$result["ticker"].'</h1>';
  echo '<p> price: '.$result["price"].'</p>';
  echo '<p> dividend: '.$result["dividend"].'</p>';
  echo '<p> shares: '.$result["shares"].'</p>';

  $conn->close();
}

if(!isset($_SESSION["ticker"]) && !isset($_GET["ticker"]))
    echo "Még nem tekintett meg egy stockot sem!";

