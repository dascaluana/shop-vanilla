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
        <th><?= protect('Image') ?></th>
        <th><?= protect('Add to cart') ?></th>
    </tr>

    <?php while ($row = $stmt->fetch()) :
        $id = $row['id'];
        ?>
        <tr>
            <td>
                <?php if (strlen($row['title'])) : ?>
                    <b><?= protect('Title') ?>: </b><?= protect($row['title']) ?><br />
                <?php endif ?>

                <?php if (strlen($row['description'])) : ?>
                    <b><?= protect('Description') ?>: </b><?= protect($row['description']) ?><br />
                <?php endif ?>

                <?php if (strlen($row['price'])) : ?>
                    <b><?= protect('Price') ?>: </b><?= protect($row['price']) ?>
                <?php endif ?>
            </td>
            <td>
                <?php if (strlen($row['image'])) : ?>
                    <img width="100" src="images/<?= $row['image'] ?>">
                <?php endif ?>
            </td>
            <td align="center">
                <a href="index.php?id=<?= $id ?>"><?= protect('Add') ?></a>
            </td>
        </tr>
    <?php endwhile ?>

</table>
<a href="cart.php"><?= protect('Go to cart') ?></a>
<?php include('footer.php') ?>