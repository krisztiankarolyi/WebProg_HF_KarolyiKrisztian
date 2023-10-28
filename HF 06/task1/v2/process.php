<?php
$savedFilePath = "";
$firstName = $lastName = $email = $attend = $tshirt = $abstract = $terms = "";
$firstNameErr = $lastNameErr = $emailErr = $attendErr = $abstractErr = $termsErr = "";

$savedFilePath = "";
$firstName = $lastName = $email = $attend = $tshirt = $abstract = $terms = "";
//a hibaüzenetek egyszerűbb megjelenítése érdekében változókban tárolom azokat. Minden újratöltéskor újra inicializálódnak, így nem marad ott az űrlapon egy régi hibaüzenet feleslegesen
$firstNameErr = $lastNameErr = $emailErr = $attendErr = $abstractErr = $termsErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //csak POST kérésen (a beküldés gomb megnyomásán) keresztül van értelme a kiértékelésnek, mert pl az oldal betöltésekor GET kéréssel egyből hibákat kapna a user, itt azért kell lekezelni, mert egyetlen fájlban van az űrlap és a kiértékelés
    // minden adat esetén megnézem, hogy meg lett-e adva, és ha igen, akkor helyes-e. Ha igen, akkor eltárolom, különben a hibaüzenetet eltárolom a megfelelő globális változóban.
    if (empty($_POST["firstName"])) {
        $firstNameErr = "First name is required";
    } else {
        $firstName = test_input($_POST["firstName"]);
    }

    if (empty($_POST["lastName"])) {
        $lastNameErr = "Last name is required";
    } else {
        $lastName = test_input($_POST["lastName"]);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    // az attend az egy csoportba tartozó checkboxok tömbje, (minden kipipált attend nevű checkbox értéke belekerül a tömbbe. Tehát legalább egy eleme kell legyen a tömbnek)
    if (!isset($_POST["attend"]) || count($_POST["attend"]) < 1) {
        $attendErr = "At least one event must be selected";
    } else {
        $attend = $_POST["attend"];
    }

    if ($_POST["tshirt"] == "P") {
        //a feladat szövege nem kérte, hogy kötelező legyen a pólóméret megadása. 'P' esetben nem választott semmit, ez is helyes.
        $tshirt = "(You did not provide a t-shirt size) ";
    } else {
        $tshirt = test_input($_POST["tshirt"]);
    }

    if (empty($_FILES["abstract"]["name"])) {
        $abstractErr = "Abstract file is required";
    } else {
        $file_name = $_FILES["abstract"]["name"];
        $file_size = $_FILES["abstract"]["size"];
        $file_type = pathinfo($file_name, PATHINFO_EXTENSION); // lekérem a kiterjesztést
        if ($file_type != "pdf" || $file_size > 3145728) { // 3MB = 3 * 1024 * 1024 = 3 145 728 bájt
            $abstractErr = "Invalid abstract file. Only PDF files up to 3MB are allowed.";
        } else {
            $abstract = $file_name;
            $upload_directory = __DIR__ . "/../uploaded"; // a fájlok elmentését ki szerettem volna próbálni, hogy egy külün mappába másolom a temporális fájlt
            $uploaded_file_tmp = $_FILES["abstract"]["tmp_name"];
            $uploaded_file_name = $_FILES["abstract"]["name"];
            $savedFilePath = $upload_directory . "/" . $uploaded_file_name;
            move_uploaded_file($uploaded_file_tmp, $savedFilePath);
        }
    }

    if (!isset($_POST["terms"])) {
        $termsErr = "You must agree to terms & conditions";
    } else {
        $terms = "Terms & conditions accepted";
    }
}
else {
    header('urlap.php');
}

function test_input($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($firstNameErr == "" && $lastNameErr == "" && $emailErr == "" && $attendErr == "" && $abstractErr == "" && $termsErr == "") {
        // Csak az illetve az űrlap sikeres elküldését követően jelenítem meg az adatokat
        echo "<h2 style='color: green'> Thank you, your registration was successfull </h2>";
        echo "<p>Name: " . $firstName . " " . $lastName . "</p>";
        echo "<p>Email: " . $email . "</p>";
        echo "<p>Events to Attend:  </p>";
        echo "<ol>";
        foreach ($attend as $event) {
            echo "<li>" . $event . "</li>";
        }
        echo "</ol>";
        echo "<p>T-Shirt Size: " . $tshirt . "</p>";
        echo "<p>Abstract File: <a href='" . $savedFilePath . "'>" . $abstract . "</a></p>";
        echo "<hr>";
    }
}


//  Visszaadjuk a feldolgozás során kapott értékeket és hibaüzeneteket az űrlapnak
include('urlap.php');
?>