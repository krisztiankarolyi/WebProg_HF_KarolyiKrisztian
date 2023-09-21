<?php
/* 1. Az alábbi tömb, minden elemének írassuk ki a típusát és ha numerikus az „Igen” szót,
különben „Nem”. (gettype, is_numeric függvények)
([5, &#39;5&#39;, &#39;05&#39;, 12.3, &#39;16.7&#39;, &#39;five&#39;, &#39;true&#39;, 0xDECAFBAD, &#39;10e200&#39;])*/
$tomb = [5, '5', '05', 12.3, '16.7', 'five', 'true', 0xDECAFBAD, '10e200'];
foreach ($tomb as  $elem)
{
    echo $elem." tipusa: ".gettype($elem);
    if (is_numeric($elem)) echo " Igen ";
    else  echo " Nem ";
    echo "<br>";
}
echo "<br> ---------------------------------------------------------<br>";
/*
 * 2. Egy változóban megadott egész értéket (másodpercek) alakítsuk át órában és jelenítsük
meg. A megjelenítéskor használjunk változó behelyettesítést (variable interpolation) illetve
HTML címkéket (pld. kiemelésre). Az előző műveletet csak akkor végezzük el, ha egész
számunk van, különben egy megfelelő üzenetet írunk ki.
*/
$mp = 8777; $mp_fx = $mp;
if (is_int($mp)) {
    $p = $mp % 60;
    $mp = floor($mp / 60);
    $h = floor($mp / 60);
    $mp = $mp % 60;
    echo "$mp_fx másodperc az  <b>$h óra</b> $mp perc";
} else {
    echo "Ez nem egy egész szám!";
}
echo "<br> ---------------------------------------------------------<br>";
/*
 * 3. Írjál programot, a 4 alapművelet és hatványozás tesztelésére. A bemenő két értéket két
változóban adjuk meg. A kiírásnak legyen egy szöveges része is, amelyet összefűzzük az
eredménnyel.
*/
$a = rand(0, 99); $b = rand(1, 10);
$plus = ($a+$b); $minus = ($a-$b); $mult = $a*$b; $div = $a/$b; $pow = $a ** $b;
echo "<br> $a + $b =". $plus;
echo "<br> $a - $b =". $minus;
echo "<br> $a * $b =". $mult;
echo "<br> $a / $b =" .$div;
echo "<br> $a ^ $b =" .$pow;

echo "<br> ---------------------------------------------------------<br>";
/*4. Írassál ki egy 3x3-as sakktáblát. Használjunk heredoc megjelenítést.*/
$sakktabla = <<<EOT
<table border="1">
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
</table>
EOT;
echo $sakktabla;
echo "<br> ---------------------------------------------------------<br>";
/*
5. Egy számológép működését szimuláljuk egy switch utasítás segítségével. Bemenet két szám
és egy műveleti jel. Figyeljünk a 0-val való osztásra és az érvénytelen műveleti jelre.
Ezekben az esetekben jelenítsünk meg egy üzenetet.
*/
$a = rand(-99,99);
$b = rand(-99,99);
$m = array('%', '/', '+', '-', '*', 'asd');
$m = $m[rand(0, 5)];
if(is_numeric($a) and  is_numeric($b)){
    switch ($m){
        case '%':
            if($b != 0){
                $e = $a % $b;
                echo "$a % $b = ". $e;
            }
            else echo "0-val nem lehet osztani!";
            break;
        case '/':
            $e = $a / $b;
            echo "$a / $b = ". $e;
            break;
        case '*':
            $e = $a * $b;
            echo "$a *  $b = ". $e;
            break;
        case '+':
            $e = $a + $b;
            echo "$a +  $b = ". $e;
            break;
        case '-':
            $e = $a - $b;
            echo "$a -  $b = ". $e;
            break;
        default:
            echo "Érvénytelen művelet jel!";
    }
}
else{
    echo "nem szam!";
}
echo "<br> ---------------------------------------------------------<br>";
/*
 * Készítsél egy feladatot, amely egy bemenő hónap alapján meghatározza az évszakot. Old
meg klasszikus if-el, majd switch-el.
 */

//Bemeneti hónap
$honap = rand(1,12); // Példa: június hónap

// Klasszikus if-else szerkezet
if ($honap >= 3 && $honap <= 5) {
    $evszak = "Tavasz";
} elseif ($honap >= 6 && $honap <= 8) {
    $evszak = "Nyár";
} elseif ($honap >= 9 && $honap <= 11) {
    $evszak = "Ősz";
} else {
    $evszak = "Tél";
}

echo "Klasszikus if-else: A megadott hónap a(z) $evszak évszakba tartozik.";

// Switch szerkezet
switch ($honap) {
    case 3:
    case 4:
    case 5:
        $evszak = "Tavasz";
        break;
    case 6:
    case 7:
    case 8:
        $evszak = "Nyár";
        break;
    case 9:
    case 10:
    case 11:
        $evszak = "Ősz";
        break;
    case 12:
    case 1:
    case 2:
        $evszak = "Tél";
        break;
    default:
        $evszak = "Érvénytelen hónap";
}

echo "\nSwitch szerkezet: A megadott hónap a(z) $evszak évszakba tartozik.";
?>




