
<form action="" method="GET">
    Számlaszám: <input type="text" name="id" value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>"><br>
    Név: <input type="text" name="nev" value="<?php echo isset($_GET['nev']) ? htmlspecialchars($_GET['nev']) : ''; ?>"><br>
    Egyenleg: <input type="text" name="egyenleg" value="<?php echo isset($_GET['egyenleg']) ? htmlspecialchars($_GET['egyenleg']) : ''; ?>"><br>
    Szamla típusa:
    <input type="radio" name="szamlatipus" value="takarek" <?php echo (isset($_GET['szamlatipus']) && $_GET['szamlatipus'] === 'takarek') ? 'checked' : ''; ?>> Takarék
    <input type="radio" name="szamlatipus" value="hitel" <?php echo (isset($_GET['szamlatipus']) && $_GET['szamlatipus'] === 'hitel') ? 'checked' : ''; ?>> Hitel<br>
    <input type="checkbox" name="feltetel" value="true" <?php echo isset($_GET['feltetel']) ? 'checked' : ''; ?>> Elfogadom a feltételeket<br>
    <input type="submit" value="submit" name="elkuld">
</form>


<?php

require_once ("Szamla.php");
if(!isset($_COOKIE["errorColor"]))
    setcookie("errorColor", "red", time() + 3600, "/");

if(!isset($_COOKIE["welcomeColor"]))
    setcookie("welcomeColor", "green", time() + 3600, "/");

if(isset($_COOKIE["clicks"])){

    $_COOKIE["clicks"] = $_COOKIE["clicks"]+1;
    $errors = [];
    if (isset($_REQUEST["id"])) {
        $id = $_REQUEST["id"];
        if (!is_numeric($id) || $id <= 0) {
            $errors[] = "Hibás számlaszám!";
        }
    }
    else {
        $errors[] = "Számlaszám megadása kötelező!";
    }

    if (isset($_REQUEST["nev"])) {
        $nev = $_REQUEST["nev"];
        if (empty($nev)) {
            $errors[] = "Név megadása kötelező!";
        }
    }
    else {
        $errors[] = "Név megadása kötelező!";
    }

    if (isset($_REQUEST["egyenleg"])) {
        $egyenleg = $_REQUEST["egyenleg"];
        if (!is_numeric($egyenleg)) {
            $errors[] = "Hibás egyenleg formátum!";
        }
    }
    else {
        $errors[] = "Egyenleg megadása kötelező!";
    }

    if (isset($_REQUEST["szamlatipus"])) {
        $szamlatipus = $_REQUEST["szamlatipus"];
    }

    else {
        $errors[] = "Számlatípus megadása kötelező!";
    }

    if (!isset($_REQUEST["feltetel"])) {
        $errors[] = "Feltétel elfogadása kötelező!";
    }

// Most a $errors tömb tartalmazza az összes validációs hibát
    if (empty($errors)) {
        $szamla = new Szamla($id, $nev);
        $szamla->egyenleg = $egyenleg;

        echo "<span>ID: <strong>$id</strong> </span><br>";
        echo "<span>Nev: <strong>$nev</strong></span><br>";
        echo "<span>Egyenleg: <strong>$egyenleg</strong></span>";

        if (isset($_GET["szamlatipus"]) && $_GET["szamlatipus"] === "takarek") {
            echo "<p style='color: " . $_COOKIE["welcomeColor"] . ";'>Üdvözöllek a TakarékBankban</p>";
        } else {
            echo "<p style='color: " . $_COOKIE["welcomeColor"] . ";'>Üdvözöllek a HitelBankban</p>";
        }
    }

    else {
        // Van hiba, kezeld le a hibákat, például kiírhatod őket vagy visszatérhetsz a felhasználói felületre
        foreach ($errors as $error) {
            echo "<p style='color: " . $_COOKIE["errorColor"] . ";'>" . $error . "</p>";
        }
    }
}
else
    setcookie("clicks", 1, time()+3600, "/");

