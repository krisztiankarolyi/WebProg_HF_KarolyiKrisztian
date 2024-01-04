<?php
require_once("Stock.php");
include("header.html");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Set the error message color from the hidden input
    $_SESSION["errorMsgColor"] = isset($_POST["errorMsgColor"]) ? $_POST["errorMsgColor"] : "red";

    if (empty($_POST["ticker"])) array_push($errors, "Ticker is empty!");
    if (empty($_POST["name"])) array_push($errors, "Name is empty!");
    if (empty($_POST["price"])) array_push($errors, "Price is empty!");
    if (empty($_POST["dividend"])) array_push($errors, "Dividend is empty!");
    if (empty($_POST["shares"])) array_push($errors, "Shares is empty!");

    if (!empty($errors)) {
        // Display errors and keep the form values
        foreach ($errors as $error) {
            echo "<i style='color:" . $_SESSION["errorMsgColor"] . "'>" . $error . "<br></i>";
        }
    } else {
        $ticker = htmlspecialchars($_POST["ticker"]);
        $name = htmlspecialchars($_POST["name"]);
        $price = htmlspecialchars($_POST["price"]);
        $dividend = htmlspecialchars($_POST["dividend"]);
        $shares = htmlspecialchars($_POST["shares"]);

        // Additional validation for numeric fields
        if (!is_numeric($price) || $price <= 0) array_push($errors, "Price must be a positive number!");
        if (!is_numeric($dividend) || $dividend < 0) array_push($errors, "Dividend must be a non-negative number!");
        if (!is_numeric($shares) || $shares <= 0 || floor($shares) != $shares)
            array_push($errors, "Shares must be a positive integer!");

        if (!empty($errors)) {
            // Display additional validation errors
            foreach ($errors as $error) {
                echo "<i style='color:" . $_SESSION["errorMsgColor"] . "'>" . $error . "<br></i>";
            }
        } 
        else {
            $stock = new Stock($ticker, $name, $price, $shares, $dividend);
            $stock->save();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Save Stock</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
    <form action="" method="POST">
        <h2>New stock</h2>

        <label>Ticker</label>
        <input type="text" name="ticker" value="<?php if (isset($_POST['ticker'])) echo $_POST['ticker']; ?>"> <br>

        <label>Name</label>
        <input type="text" name="name" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"> <br>

        <label>Price</label>
        <input type="number" name="price" step="0.01" value="<?php if (isset($_POST['price'])) echo $_POST['price']; ?>"> <br>

        <label>Dividend</label>
        <input type="number" name="dividend" step="0.01"  value="<?php if (isset($_POST['dividend'])) echo $_POST['dividend']; ?>"> <br>

        <label>Shares</label>
        <input type="number" name="shares" value="<?php if (isset($_POST['shares'])) echo $_POST['shares']; ?>"> <br>

        <label>Error Message Color</label>
        <select name="errorMsgColor">
            <option value="red">Red</option>
            <option value="green">Green</option>
            <option value="blue">Blue</option>
        </select>

        <input type="submit" value="Save">
    </form>
</body>
</html>
