<?php
session_start();

if (!isset($_SESSION['numbers'])) {
    $_SESSION['numbers'] = [10, 20, 30];
}

$numbers = $_SESSION['numbers'];
$average = null;

if (isset($_POST['modify'])) {
    $position = $_POST['position'];
    $newValue = $_POST['new_value'];

    if (isset($numbers[$position])) {
        $numbers[$position] = $newValue;
        $_SESSION['numbers'] = $numbers;
    }
}

if (isset($_POST['average'])) {
    $average = array_sum($numbers) / count($numbers);
}

if (isset($_POST['reset'])) {
    session_unset();
    session_destroy();
    header("Location: /Sessions/Exercise1.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Exercise 01</title>
</head>

<body>

    <h2>Modify array saved in session</h2>

    <form method="post">

        <label>Position to modify:</label>
        <select name="position">
            <?php foreach ($numbers as $index => $value): ?>
                <option value="<?= $index ?>"><?= $index ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label>New value:</label>
        <input type="number" name="new_value" step="any">
        <br><br>

        <button type="submit" name="modify">Modify</button>
        <button type="submit" name="average">Average</button>
        <button type="submit" name="reset">Reset</button>

    </form>

    <br>

    <strong>Current array:</strong>
    <?= implode(", ", $numbers) ?>

    <?php if ($average !== null): ?>
        <p><strong>Average:</strong> <?= round($average, 2) ?></p>
    <?php endif; ?>

</body>

</html>