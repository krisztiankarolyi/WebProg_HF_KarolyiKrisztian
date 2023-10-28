<!DOCTYPE html>
<html>
<head>
    <title>6. Házifeladat első verzió</title>
    <!-- itt egy fájlon belül van a feldolgozás és az űrlap visszaadása a kliens böngészője felé-->
</head>
<body>

<?php
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
        if ($file_type != "pdf" || $file_size > 3145728 ) { // 3MB = 3 * 1024 * 1024 = 3 145 728 bájt
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

function test_input($data) {
    // érdemesnek találtam egy többszörös string szűrést végző függvényt csinálni kódmegtakarítás miatt
    $data = trim($data); // a felesleges szóközök, tabulátorok, stb. levétele a szöveg elejéről és végéről
    $data = htmlspecialchars($data); // a speciális karaktereket a biztonság kedvéért html elemekké alakítja, így egít elkerülni az injekciókat és a keresztszkripteléseket.
    return $data;
}
?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($firstNameErr == "" && $lastNameErr == "" && $emailErr == "" && $attendErr == "" && $abstractErr == "" && $termsErr == "") {
        // Csak az illetve az űrlap sikeres elküldését követően jelenítem meg az adatokat
        echo "<h2 style='color: green'> Thank you, your registration was successfull </h2>";
        echo "<p>Name: " .$firstName . " ".$lastName ."</p>";
        echo "<p>Email: " . $email . "</p>";
        echo "<p>Events to Attend:  </p>";
        echo "<ol>";
        foreach ($attend as $event){
            echo "<li>".$event."</li>";
        }
        echo "</ol>";
        echo "<p>T-Shirt Size: " . $tshirt . "</p>";
        echo "<p>Abstract File: <a href='".$savedFilePath."'>" . $abstract . "</a></p>";
        echo"<hr>";
    }
}
?>

<h3>Online conference registration</h3>

<form method="post" action="" enctype="multipart/form-data">
    <label for="fname"> First name:
        <input type="text" name="firstName" value="<?php echo $firstName; ?>">
        <span style="color: red;"><?php echo $firstNameErr; ?></span> <!-- A hibaüzeneteket megjelenítem a megfelelő helyen -->
    </label>
    <br><br>
    <label for="lname"> Last name:
        <input type="text" name="lastName" value="<?php echo $lastName; ?>">
        <span style="color: red;"><?php echo $lastNameErr; ?></span>
    </label>
    <br><br>
    <label for="email"> E-mail:
        <input type="text" name="email" value="<?php echo $email; ?>">
        <span style="color: red;"><?php echo $emailErr; ?></span>
    </label>
    <br><br>
    <label for="attend"> I will attend:<br>
        <!-- ha az egyes jelölőnégyzetek értékei benne vannak a tömbben, tehát a beküldés előtt be voltak jelölve, akkor php-val ráolvasom a tag-re a checked tulajdonságot, így visszaállítva a korábbi munkamenetbeli állapotot -->
        <input type="checkbox" name="attend[]" value="Event1" <?php if (isset($_POST["attend"]) && in_array("Event1", $_POST["attend"])) echo "checked"; ?>>Event 1<br>
        <input type="checkbox" name="attend[]" value="Event2" <?php if (isset($_POST["attend"]) && in_array("Event2", $_POST["attend"])) echo "checked"; ?>>Event2<br>
        <input type="checkbox" name="attend[]" value="Event3" <?php if (isset($_POST["attend"]) && in_array("Event3", $_POST["attend"])) echo "checked"; ?>>Event3<br>
        <input type="checkbox" name="attend[]" value="Event4" <?php if (isset($_POST["attend"]) && in_array("Event4", $_POST["attend"])) echo "checked"; ?>>Event4<br>
        <span style="color: red;"><?php echo $attendErr; ?></span>
    </label>
    <br><br>
    <label for="tshirt"> What's your T-Shirt size?<br>
        <select name="tshirt"
            <option value="P" <?php if ($tshirt == "Please select") echo "selected"; ?>>Please select</option>
            <option value="S" <?php if ($tshirt == "S") echo "selected"; ?>>S</option>
            <option value="M" <?php if ($tshirt == "M") echo "selected"; ?>>M</option>
            <option value="L" <?php if ($tshirt == "L") echo "selected"; ?>>L</option>
            <option value="XL" <?php if ($tshirt == "XL") echo "selected"; ?>>XL</option>
        </select>
    </label>
    <br><br>
    <label for="abstract"> Upload your abstract<br>
        <input type="file" name="abstract">
        <span style="color: red;"><?php echo $abstractErr; ?></span>
    </label>
    <br><br>
    <input type="checkbox" name="terms" value="" <?php if (isset($_POST['terms'])) echo "checked"; ?>>I agree to terms & conditions.
    <span style="color: red;"><?php echo $termsErr; ?></span>
    <br><br>
    <input type="submit" name="submit" value="Send registration">
</form>


</body>
</html>
