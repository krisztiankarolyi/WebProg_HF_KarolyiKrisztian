<?php

if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || !isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit();
}

?>
<style>input{width: 100%; padding: 5px 10px;}
  </style>
<form action="insert.php" method="post" style="width: 90%; margin: auto; text-align: center;">
    <h2>Új Hallgató Hozzáadása</h2> <hr>
    Név:<br>
    <input required type="text" name="nev"><br><br>
    Szak:<br>
    <input required type="text" name="szak"><br><br>
    Átlag:<br>
    <input required type="text" name="atlag"><br><br>
    <input type="submit" name="add" value="Hozzáadás">
</form>