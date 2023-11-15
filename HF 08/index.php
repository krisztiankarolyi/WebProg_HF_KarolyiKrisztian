<?php
require ('conn.php');

session_start();

if(!isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] || !isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit();
} ?>

<html>
<head>
    <title>HF08 :: CRUD</title>
    <style>
        body{background-color: #333333; color: white}
        a{text-decoration: none; color: white;}
        th{background-color: white; color: black}
        h1{text-align: center}
        tr:nth-child(even){
            background-color: rgb(128, 128, 128);
        }
        tr:nth-child(odd){
            background-color: #444444;
        }
    </style>
</head>
<body> <p>logged in as <  <?php echo $_SESSION['uname']; ?>  > | <a href="logout.php">Logout</a></p><hr><br>
<?php
$conn = $GLOBALS['conn'];

if($conn->connect_error){
    var_dump($conn->error_list);
    die("Nem tudtam kapcsolódni <br>");
}
else{
    $query = $conn->query("select * from hallgatok");
    echo "<div style='display: flex; flex-direction: row; height: auto;'>";
    if($query->num_rows > 0){
        echo "<table style='border-collapse:  collapse; border: 1px solid black; width: 65%;'>";
        echo "<tr><th style='border: 1px solid black;'>ID</th> <th style='border: 1px solid black;'>Név</th><th style='border: 1px solid black;'>Szak</th> <th style='border: 1px solid black;'>Átlag</th><th colspan='2'>Műveletek</th></tr>";
        while($row = $query->fetch_assoc()) {
            echo "<tr>";
            echo "<td style='border: 1px solid black;'>".$row["id"]."</td>";
            echo "<td style='border: 1px solid black;'>".$row["nev"]."</td>";
            echo "<td style='border: 1px solid black;'>".$row["szak"]."</td>";
            echo "<td style='border: 1px solid black;'>".$row["atlag"]."</td>";
            echo "<td style='border: 1px solid black;'><form method='post' action='delete.php' style='margin: 0;'><input type='hidden' name='id' value='" . $row["id"] . "'><a href='#' onclick='this.parentNode.submit();'>Delete</a></form></td>";
            echo "<td style='border: 1px solid black;'><form method='get' action='update.php?id=" . $row['id'] . "' style='margin: 0;'><input type='hidden' name='id' value='" . $row["id"] . "'><a href='#' onclick='this.parentNode.submit();'>Update</a></form></td>";

            echo "</tr>";
        }
        echo "</table>";

    }
    else {
        echo "Nincs eredmény";
    }
        echo "<div style='width: 35%'>";
            include('new.php');
        echo "</div>";
    echo "</div>";
}
?>
</body>
</html>