<form method="post" action="">
    <input type="hidden" name="elkuldott" value="true">
         Melyik számra gondoltam 1 és 10 között?
    <input name="talalgatas" type="text">
    <br>
    <br>
    <input type="submit" value="Elküld">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST["elkuldott"]) && $_POST["elkuldott"] == "true" && is_numeric($_POST["talalgatas"])) {
        $tipp = intval($_POST["talalgatas"]);

        if (isset($_COOKIE["helyes_szam"])) {
            $helyes_szam = $_COOKIE["helyes_szam"];
        } else {
            $helyes_szam = rand(1, 10);
            setcookie("helyes_szam", $helyes_szam, time() + 3600 * 24 * 365);
        }

        if ($tipp === $helyes_szam) {
            echo "Gratulálok, helyes tipp! Megoldás: ($helyes_szam)";
            $uj_szam = rand(1, 10);
            setcookie("helyes_szam", $uj_szam, time() + 3600 * 24 * 365);
        } elseif ($tipp < 1 || $tipp > 10) {
            echo "A tippnek 1 és 10 között kell lennie!";
        } elseif ($tipp < $helyes_szam) {
            echo "A szám ennél nagyobb! Megoldás: ($helyes_szam)";
        } elseif ($tipp > $helyes_szam) {
            echo "A szám ennél kisebb! Megoldás: ($helyes_szam)";
        }
    }
} else {
    if (!isset($_COOKIE["helyes_szam"])) {
        setcookie("helyes_szam", rand(1, 10), time() + 3600 * 24 * 365);
    }
}


?>