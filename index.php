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
<?php include('header.php') ?>
<table border="1">
    <tr>
        <th><?= protect('Product') ?></th>
        <th><?= protect('Add to cart') ?></th>
    </tr>

    <?php while ($row = $stmt->fetch()) :
        $id = $row['id']; ?>
        <tr>
            <td>
                <b><?= protect('Title') ?>: </b><?= protect($row['title']) ?><br />
                <b><?= protect('Description') ?>: </b><?= protect($row['description']) ?><br />
                <b><?= protect('Price') ?>: </b><?= protect($row['price']) ?>
            </td>
            <td align="center">
                <a href="index.php?id=<?= $id ?>"><?= protect('Add') ?></a>
            </td>
        </tr>
    <?php endwhile ?>

</table>
<a href="cart.php"><?= protect('Go to cart') ?></a>
<?php include('footer.php') ?>