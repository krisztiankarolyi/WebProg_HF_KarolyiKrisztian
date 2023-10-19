<html>
<head>
    <style>

    </style>
</head>
<body>
<?php
//1. Írassuk ki a szorzótáblát az alábbi formában. Egy névtelen függvényt írjunk, amely
//paraméterként megkap egy n számot (pld. n=10-re lásd az ábrát). A színt egy globális
//változóként adjuk át (erre closur-t használunk):
echo "1. feladat <br>";
echo "<table border='1' cellpadding='5'>";
$n = 10;
for ($row = 1; $row <= $n; $row++) {
    echo "<tr>";
    for ($col = 1; $col <= $n; $col++) {
        if ($row == $col) {
            $color = 'aqua';
        } else {
            $color = 'white';
        }
        echo "<td style='background-color: $color; width: 20px; height: 30px;'>".$row * $col."</td>";
    }
    echo "</tr>";
}
echo "</table>";

//2. Az alábbi asszociatív tömböt felhasználva állítsuk elő a következő kimenetet (figyelem: a
//város nevek piros színnel vannak kiíratva):
echo "<br> 2. feladat <br>";
$orszagok = array(
    "Magyarország" => "Budapest",
    "Románia" => "Bukarest",
    "Belgium" => "Brussels",
    "Austria" => "Vienna",
    "Poland" => "Warsaw"
);

echo '<ul>';
foreach ($orszagok as $orszag => $varos) {
    echo '<li>' . $orszag . ' fővárosa <span style="color: red">'.$varos.'</span></li>';
    }
echo '</ul>';

//3. A napok kétdimenziós tömböt írasd ki az alábbi formában (figyelem: a kedd, csütörtök és
//szombat ki van emelve (bold) a kiírásnál):
echo "3. feladat <br>";

$napok = array(
    "HU" => array("H", "K", "Sze", "Cs", "P", "Szo", "V"),
    "EN" => array("M", "Tu", "W", "Th", "F", "Sa", "Su"),
    "DE" => array("Mo", "Di", "Mi", "Do", "F", "Sa", "So")
);

foreach ($napok as $nyelv => $napokListaja) {
    $count = 1;
    echo "$nyelv: ";
    foreach ($napokListaja as $nap) {
        if($count%2 == 0) echo"<b>$nap</b>,  ";
        else echo"$nap, ";
        $count++;
    }
    echo "<br>";
}

//4. Írjunk függvényt, amely egy asszociatív tömb elemeit átalakítja kisbetűs vagy nagybetűs formára
//(old meg klasszikus módon és array_map segítségével is ).
echo "<br>4. feladat <br>";
function atalakit(array &$tomb, string $mod): array{
    $out = array();
    if(strtolower($mod) == "kisbetus"){
        foreach ($tomb as $key=>$val){
            array_push($out, strtolower($val));
        }
    }
    else if(strtolower($mod) == "nagybetus"){
        foreach ($tomb as $key=>$val){
            array_push($out, strtoupper($val));
        }
    }
    else echo "Hibás paraméter! kisbetus / nagybetus lehet!";

    return $out;
}

function atalakitArrayMap(array &$tomb, string $mod): array {
    $mod = strtolower($mod);
    $transformFunction = ($mod === "kisbetus") ? 'strtolower' : (($mod === "nagybetus") ? 'strtoupper' : null);
    if ($transformFunction === null) {
        echo "Hibás paraméter! kisbetus / nagybetus lehet!";
        return [];
    }
	return array_map($transformFunction, $tomb);
}

$szinek = array('A' => 'Kek', 'B' => 'Zold', 'c' => 'Piros');
var_dump(atalakit($szinek, "kisbetus"));
echo"<br>";
var_dump(atalakitArrayMap($szinek, "nagybetus"));

?>
</body>
</html>