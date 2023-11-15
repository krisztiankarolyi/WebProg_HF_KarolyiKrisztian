<?php
session_start();
// Check if the user is already logged in
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && isset($_SESSION['uname'])) {
    header("Location: index.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["username"]) && isset($_POST["password"])) {
        $uname = $_POST["username"];

        include_once("conn.php");
        $conn = $GLOBALS['conn'];

        if ($conn) {
            $query = $conn->prepare('SELECT id, password, username FROM users WHERE username = ?');
            $query->bind_param("s", $uname);
            $query->execute();
            $result = $query->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $password = $_POST["password"];
                $userpassword =  $row['password'];

                if (password_verify($password, $userpassword)) {
                    echo "sikeres belépés";
                    $_SESSION['logged_in'] = true;
                    $_SESSION['uname'] = $uname;
                    header('Location: index.php');
                    exit();
                } else {
                    echo "<br>Helytelen jelszó <br> ";
                }
            } else {
                echo "A felhasználó nem létezik";
            }
        } else {
            die($conn->error);
        }
    }
}
?>

<html>
<head>
    <title>HF08 :: belépés</title>
    <style>
        body{background-color: #333333; color: white;  }
        form{max-width: 400px; margin: auto}
        input, label{width: 100%; text-align: left; padding: 10px 0px;}
    </style>
</head>
<body>
<form action="" method="POST">
    <h1>Belépés</h1>
    <label for="username">felhasználónév</label>
    <input name="username" type="text" required><br><br>
    <label for="username">jelszó</label>
    <input name="password" type="password"  ><br><br>
    <input type="submit" value="belépés" style="background-color: cadetblue">
</form>
</body>
</html>
