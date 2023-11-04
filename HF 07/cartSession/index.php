<?php
// Start or resume the PHP session
session_start();

// Initialize the cart in the session as an empty array
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Sample product data
$products = [
    ['id' => 1, 'name' => 'Product A', 'price' => 10.99],
    ['id' => 2, 'name' => 'Product B', 'price' => 14.99],
    ['id' => 3, 'name' => 'Product C', 'price' => 19.99]
];

if (isset($_POST['add_to_cart'])) {
    $productId = $_POST["product_id"];
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] += 1;
    } else {
        $product = getProductById($productId, $products);
        $product = [
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => 1
        ];
        $_SESSION['cart'][$productId] = $product;
    }
}

function getProductById($productId, $products) {
    foreach ($products as $product) {
        if ($product['id'] == $productId) {
            return $product;
        }
    }

    return null;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-dark text-light">
<div class="container">
    <h1 class="mt-3">Product List</h1>
    <ul class="list-group">
        <?php foreach ($products as $product) { ?>
            <li class="list-group-item text-dark">
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $product['name']; ?> - $<?php echo $product['price']; ?>
                    </div>
                    <div class="col-md-6">
                        <form method="post">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <input type="submit" name="add_to_cart" value="Add to Cart" class="btn btn-primary float-right">
                        </form>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>

    <form method="post" action="cart.php" class="mt-3">
        <input type="submit" name="view_cart" value="View Cart" class="btn btn-success">
    </form>
</div>

<!-- Add Bootstrap JS and jQuery scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
