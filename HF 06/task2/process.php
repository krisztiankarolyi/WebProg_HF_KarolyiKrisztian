<!DOCTYPE html>
<html>
<head>
    <title>Regisztráció eredménye</title>
</head>
<body>
<h2>Regisztráció eredménye</h2>

<?php
$name = $email = $password = $confirm_password = $birthdate = $gender = $country = "";
$interests = [];

$errors = [
        "email" => "",
        "name" => "",
        "password" => "",
        "confirm_password" => "",
        "birthdate" => "",
        "gender" => "",
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"])) {
        $name = test_input($_POST["name"]);
    }
    if (isset($_POST["email"]) && !empty($_POST["email"])) {
        $email = test_input($_POST["email"]);
    }
    else{
        $errors["email"] = "Az email-cím nem lehet üres!";
    }
    if (isset($_POST["password"]) && !empty($_POST["password"])) {
        $password = test_input($_POST["password"]);
    }
    else {
        $errors["password"] = "A jelszó nem lehet üresen hagyva!";
    }
    if (isset($_POST["confirm_password"]) && !(empty($_POST["confirm_password"]))) {
        $confirm_password = test_input($_POST["confirm_password"]);
    }
    else {
        $errors["confirm_password"] = "A jelszó megerősítése nem lehet üresen hagyva!";
    }
    if (isset($_POST["birthdate"])) {
        $birthdate = test_input($_POST["birthdate"]);
    }
    else {
        $errors["birthdate"] = "A születési dátum nem lehet üresen hagyva!";
    }
    if (isset($_POST["gender"])) {
        $gender = test_input($_POST["gender"]);
    }
    else {
        $errors["gender"] = "Nem választottál nemet!";
    }
    if (isset($_POST["country"])) {
        $country = test_input($_POST["country"]);
    }

    if (isset($_POST["interests"])) {
        $interests = $_POST["interests"];
    }

    if (empty($name)) {
        $errors["name"] = "A név mező nem lehet üres.";
    }

    if (!(filter_var($email, FILTER_VALIDATE_EMAIL)) && $email!="") {
        $errors["email"] =   $errors["email"]." Az e-mail cím nem érvényes.";
    }

    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
        $errors["password"] =  $errors["password"]. " A jelszónak minimum 8 karakter hosszúnak kell lennie, és tartalmaznia kell legalább egy nagybetűt, egy számot és egy speciális karaktert.";
    }

    if ($password !== $confirm_password) {
        $errors["password"] = $errors["password"]." A jelszó és a jelszó megerősítése nem egyezik meg.";
    }

    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $birthdate)) {
        $errors["birthdate"] = "A születési dátum érvénytelen.";
    }

    $isOkay = function () use ($errors) {
        foreach ($errors as $key => $val) {
            if(!empty($val))
                return false;
        }
        return  true;
    };

    if ($isOkay()) {
        echo "<p>Sikeres regisztráció!</p>";
        echo "<p>Név: $name</p>";
        echo "<p>E-mail: $email</p>";
        echo "<p>Születési dátum: $birthdate</p>";
        echo "<p>Nem: $gender</p>";
        if (!empty($interests)) {
            echo "<p>Érdeklődési területek: </p> <ol>";
            foreach ($interests as $interest){
                echo "<li>".$interest."</li>";
            }
            echo "</ol>";
        }
        echo "<p>Ország: $country</p>";
    }
    else {
        echo "<h2>Sikertelen regisztráció:</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            if(!empty($error))
            echo "<li style='color: red'>".$error."</li>";
        }
        echo "</ul>";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
echo"<hr>";
include('index.php');
?>

</body>
</html>
