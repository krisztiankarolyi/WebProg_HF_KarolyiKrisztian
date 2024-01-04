<?php

require_once("Stock.php");
include("header.html");

session_start();

$stocks = Stock::getList();
?>

<style>
    table {
        border-collapse: separate;
    }
   table, tr, td, th{
        border: 1px solid black;
    }
</style>

<table>
<tr>    
    <th>
        Ticker
    </th>
    <th>
        Name
    </th>
    <th>
        Price
    </th>
    <th>
        Dividend
    </th>
    <th>
        Shares
    </th>
    <th>
        Returns
    </th>
</tr>


<?php

$color = "";
foreach($stocks as $stock)
{
    if($stock["price"] < 100)
        $color = "red";
    else
        $color = "green";

    $returns = round(($stock["price"] * $stock["shares"]) + ($stock["price"] * $stock["dividend"] / 100) * $stock["shares"], 2);
    echo '<tr>
            <td><a href="StockDetails.php?ticker=' . $stock["ticker"] . '">' . $stock["ticker"] . '</a></td>
            <td>' . $stock["name"] . '</td>
            <td>' . $stock["price"] . '</td>
            <td>' . $stock["dividend"] . '</td>
            <td>' . $stock["shares"] . '</td>
            <td style="color: ' . $color . ';">' . $returns . '</td>
        </tr>';

}

?>
</table>