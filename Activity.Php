<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Activity 1</title>
</head>
<body>
    <h3>
        <b>Vendo Machine</b>
    </h3>

    <form method="POST">
        <fieldset style="width: 420px; height: 120px;">
            <legend>Products</legend>
            <label>
                <input type="checkbox" name="item1" value="Coke" <?php if (isset($_POST['item1'])) echo 'checked'; ?>> Coke - ₱15<br>
                <input type="checkbox" name="item2" value="Sprite" <?php if (isset($_POST['item2'])) echo 'checked'; ?>> Sprite - ₱20<br>
                <input type="checkbox" name="item3" value="Royal" <?php if (isset($_POST['item3'])) echo 'checked'; ?>> Royal - ₱20<br>
                <input type="checkbox" name="item4" value="Pepsi" <?php if (isset($_POST['item4'])) echo 'checked'; ?>> Pepsi - ₱15<br>
                <input type="checkbox" name="item5" value="Mountain Dew" <?php if (isset($_POST['item5'])) echo 'checked'; ?>> Mountain Dew - ₱20<br>
            </label>
        </fieldset>

        <fieldset style="height: 35px;width: 420px;">
            <legend>Options:</legend>
            <label>Size</label>
            <select name="size">
                <option value="regular" <?php if (isset($_POST['size']) && $_POST['size'] == 'regular') echo 'selected'; ?>>Regular</option>
                <option value="up" <?php if (isset($_POST['size']) && $_POST['size'] == 'up') echo 'selected'; ?>>Up-Size (add ₱5)</option>
                <option value="jumbo" <?php if (isset($_POST['size']) && $_POST['size'] == 'jumbo') echo 'selected'; ?>>Jumbo (add ₱10)</option>
            </select>
            <label>Quantity</label>
            <input type="number" name="quantity" id="quantity" min="1" max="10" style="width: 100px;" value="<?php echo isset($_POST['quantity']) ? $_POST['quantity'] : ''; ?>">
            <input type="submit" value="Check out">
        </fieldset>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Array to hold selected product names and their prices
        $selectedProducts = [];
        $productPrices = [
            "Coke" => 15,
            "Sprite" => 20,
            "Royal" => 20,
            "Pepsi" => 15,
            "Mountain Dew" => 20
        ];

        // Collect selected products
        if (isset($_POST['item1'])) { $selectedProducts[] = "Coke"; }
        if (isset($_POST['item2'])) { $selectedProducts[] = "Sprite"; }
        if (isset($_POST['item3'])) { $selectedProducts[] = "Royal"; }
        if (isset($_POST['item4'])) { $selectedProducts[] = "Pepsi"; }
        if (isset($_POST['item5'])) { $selectedProducts[] = "Mountain Dew"; }

        // Handle product selection and price calculation
        if (!empty($selectedProducts)) {
            $size = $_POST['size'];  // Selected size
            $quantity = $_POST['quantity'];  // Quantity selected
            $sizePrice = 0; // Default size price

            // Calculate size price
            if ($size == "up") {
                $sizePrice = 5;
            } elseif ($size == "jumbo") {
                $sizePrice = 10;
            }

            // Initialize total price and total items count
            $totalPrice = 0;
            $totalItems = 0;

            echo "<hr><h4><b> Purchase Summary:</b></h4>";

            // Loop through selected products and calculate amounts
            foreach ($selectedProducts as $product) {
    $productPrice = $productPrices[$product];
    // Apply size price for each item
    $itemPrice = ($productPrice + $sizePrice) * $quantity;

    // Display individual product details with normal-sized middle dot
    echo '   <span style="font-weight: bold;">·</span> ' . $quantity . ' pieces of Regular ' . $product . ' Amounting to ₱ ' . $itemPrice . '<br>';

    // Add to total amount
    $totalPrice += $itemPrice;
    $totalItems += $quantity;
}

            // Display the total items and total amount
            echo "<br><b>Total number of items : $totalItems</b><br>";
            echo "<b>Total amount: ₱ " . $totalPrice . "<br><b>";
        } else {
            // If no products are selected
            echo "<hr>No product selected.";
        }
    }
    ?>
</body>
</html>
