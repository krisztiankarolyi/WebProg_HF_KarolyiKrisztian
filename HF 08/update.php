<html>
<head>
    <title>HF08 :: update</title>
    <style>
        html{background-color: #333333; color: white; }
        body{ margin: auto; text-align: center; max-width: 400px; }
        input{padding: 5px 10px; width: 100%;}
    </style>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || !isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit();
}


require ('conn.php');
$conn = $GLOBALS['conn'];

if($conn){
    if(isset($_POST["id"])){
        $nev = $_POST['nev'];
        $id = $_POST['id'];
        $szak = $_POST['szak'];
        if (!isset($_POST['atlag'])) {
            $atlag = 0.0;
        } else {
            $atlag = $_POST['atlag'];
        }
        $update = $conn->query("UPDATE hallgatok SET nev = '$nev', szak = '$szak', atlag = $atlag WHERE id = $id");

        if ($update) {
            header("Location: index.php");
        } else {
            echo "Hiba a frissítés során: " . update->error;
        }
    }

    if(isset($_GET["id"]))
    {
        $query = "select * from hallgatok where id =".$_GET["id"];
        $result = $conn->query($query);
        if($result){
            $row =  $result->fetch_assoc();
            $nev = $row["nev"];
            $atlag = $row["atlag"];
            $szak = $row["szak"];

            ?>
            <h2>Hallgató adatainak frissítsée</h2>

            <form action="" method="post">
                Név:<br>
                <input type="text" name="nev" value="<?php echo $nev ?>"><br><br>
                Szak:<br>
                <input type="text" name="szak" value="<?php echo $szak ?>"><br><br>
                Átlag:<br>
                <input type="text" name="atlag" value="<?php echo $atlag ?>"><br><br>
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                <input type="submit" name="update" value="Frissít">
            </form>
<?php
        }
        else{
            die("Hiba a frissítés során");
        }
}
    else {
        header("Location: index.php");
    }
}

else {
    header("Location: index.php");
}

?>
</body>
</html>