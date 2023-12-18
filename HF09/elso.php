<?php

function getProductInfo($productId) {
    $url = "https://fakestoreapi.com/products/$productId";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

function calculateCartTotal($userId) {
    $url = "https://fakestoreapi.com/carts/user/$userId";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $cart = json_decode($response, true);

    $total = 0;

    foreach ($cart as $order) {
        foreach ($order['products'] as $product) {
            $productInfo = getProductInfo($product['productId']);
            $total += $productInfo['price'] * $product['quantity'];
        }
    }

    return $total;
}

// Felhasználó által megadott userId lekérése az űrlapról
$userId = isset($_POST['userId']) ? $_POST['userId'] : 1;

// Az összérték kiszámítása
$total = calculateCartTotal($userId);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kosár Összérték Kalkulátor</title>
</head>
<body>

<h1>Kosár Összérték Kalkulátor</h1>
<p>Adatok forrása: <a href="https://fakestoreapi.com/ ">fake store API</a></p>
<form method="post" action="">
    <label for="userId">Felhasználó ID:</label>
    <input type="number" name="userId" id="userId" value="<?php echo $userId; ?>" min="1" required>
    <input type="submit" value="Számol">
</form>

<p>A(z) <?php echo $userId; ?>-es user kosarának összértéke: $<?php echo $total; ?></p>

</body>
</html>
