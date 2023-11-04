<?php
// Start or resume the PHP session
session_start();

// Initialize the cart in the session as an empty array
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['remove_from_cart'])) {
    $toDeleteId = $_POST['product_id'];
    unset($_SESSION['cart'][$toDeleteId]);
}

if (isset($_POST['incrase_quantity'])) {
    $productId = $_POST['product_id'];
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] += 1;
    }
}

if (isset($_POST['decrase_quantity'])) {
    $productId = $_POST['product_id'];
    if (isset($_SESSION['cart'][$productId]) && $_SESSION['cart'][$productId]['quantity'] > 1) {
        $_SESSION['cart'][$productId]['quantity'] -= 1;
    }
}

// Calculate the total price of the cart
$sum = 0;
foreach ($_SESSION['cart'] as $item) {
    $sum += $item['quantity'] * $item['price'];
}
?>

    <!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-dark text-light">
<div class="container ">
    <h1 class="mt-3">Shopping Cart</h1>
    <a href="index.php" class="btn btn-primary mt-3 mb-3">Shop more</a>
    <ul class="list-group  text-dark">
        <?php foreach ($_SESSION['cart'] as $productId => $item) { ?>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $item['name']; ?>
                    </div>
                    <div class="col-md-3">
                        $<?php echo $item['price']; ?>
                    </div>
                    <div class="col-md-3">
                        Quantity: <?php echo $item['quantity']; ?>
                        <form method="post" class="float-right">
                            <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                            <input type="submit" name="remove_from_cart" value="Remove from Cart" class="btn btn-danger">
                            <input type="submit" name="incrase_quantity" value="+" class="btn btn-info">
                            <?php if($item['quantity'] > 1){
                                echo "<input type='submit' name='decrase_quantity' value='-' class='btn btn-info'>";
                            }?>

                        </form>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>

<!-- Add Bootstrap JS and jQuery scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
echo  "<p class='text-center font-weight-bold'>Total price: $ $sum</p>";
?>