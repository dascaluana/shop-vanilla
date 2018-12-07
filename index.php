<?php

include ('common.php');

if (!isset($_SESSION['id'])) {
    $_SESSION['id']= [];
}

if (isset($_GET['id'])) {

    if(!in_array($_GET['id'], $_SESSION['id'])) {
        array_push($_SESSION['id'], $_GET['id']);
    }
    header("Location: index.php");
}

$arr = $_SESSION['id'] ?: [0];
$in = str_repeat('?,', count($arr) - 1) . '?';
$sql = "SELECT * FROM `products` WHERE `id` NOT IN ($in)";
$stmt = $conn->prepare($sql);
$stmt->execute($arr);

?>

<table border="1">
    <tr>
        <th><?= trans('Product') ?></th>
        <th><?= trans('Add to cart') ?></th>
    </tr>

    <?php while ($row = $stmt->fetch()) :
        $id = $row['id']; ?>
        <tr>
            <td>
                <b><?= trans('Title') ?>: </b><?= $row['title'] ?><br />
                <b><?= trans('Description') ?>: </b><?= $row['description'] ?><br />
                <b><?= trans('Price') ?>: </b><?= $row['price'] ?>
            </td>
            <td align="center">
                <a href="index.php?id=<?= $id ?>"><?= trans('Add') ?></a>
            </td>
        </tr>
    <?php endwhile ?>

</table>
<a href="cart.php"><?= trans('Go to cart') ?></a>