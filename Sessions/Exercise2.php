<?php
session_start();

if (!isset($_SESSION['inventory'])) {
    $_SESSION['inventory'] = [
        'milk' => 0,
        'soft drink' => 0
    ];
}

$inventory = $_SESSION['inventory'];

$error = "";


if (isset($_POST['worker'])) {
    $_SESSION['worker'] = $_POST['worker'];
}

if (isset($_POST['add'])) {
    $product = $_POST['product'];
    $quantity = (int) $_POST['quantity'];

    $inventory[$product] += $quantity;
    $_SESSION['inventory'] = $inventory;
}

if (isset($_POST['remove'])) {
    $product = $_POST['product'];
    $quantity = (int) $_POST['quantity'];

    if ($inventory[$product] >= $quantity) {
        $inventory[$product] -= $quantity;
        $_SESSION['inventory'] = $inventory;
    } else {
        $error = "No se pueden quitar más unidades de las disponibles";
    }
}


if (isset($_POST['reset'])) {
    unset($_SESSION['worker']);
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Supermarket management</title>
</head>

<body>

    <h2>Supermarket managemennt</h2>

    <form method="post">

        <label>Worker name:</label>
        <input type="text" name="worker" value="<?= $_SESSION['worker'] ?? '' ?>">
        <br><br>

        <label>Choose product:</label>
        <select name="product">
            <option value="milk">Milk</option>
            <option value="soft drink">Soft Drink</option>
        </select>
        <br><br>

        <label>Product quantity:</label>
        <input type="number" name="quantity" min="1">

        <br><br>

        <button type="submit" name="add">add</button>

        <button type="submit" name="remove">remove</button>
        <button type="submit" name="reset">reset</button>

    </form>

    <h3>Inventory:</h3>
    <p>worker: <?= $_SESSION['worker'] ?? '' ?></p>
    <p>unitss milk: <?= $inventory['milk'] ?></p>
    <p>units soft drink: <?= $inventory['soft drink'] ?></p>

    <?php if ($error): ?>
        <p><?= $error ?></p>
    <?php endif; ?>

</body>

</html>