<?php
include ('common.php');

$sql = "SELECT * FROM `products` p JOIN `order_products` up ON p.id = up.product_id JOIN `order` u ON u.id = up.order_id WHERE u.id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_GET['id']]);

?>
<?php include('header.php') ?>
<table border="1">
    <tr>
        <th><?= protect('Title') ?></th>
        <th><?= protect('Description') ?></th>
        <th><?= protect('Price') ?></th>
        <th><?= protect('Image') ?></th>
    </tr>

    <?php while ($row = $stmt->fetch()) : ?>
        <tr>
            <td>
                <?php if (strlen($row['title'])) : ?>
                    <?= protect($row['title']) ?><br />
                <?php endif ?>
            </td>

            <td>
                <?php if (strlen($row['description'])) : ?>
                    <?= protect($row['description']) ?><br />
                <?php endif ?>
            </td>

            <td>
                <?php if (strlen($row['price'])) : ?>
                    <?= protect($row['price']) ?>
                <?php endif ?>
            </td>

            <td>
                <?php if (strlen($row['image'])) : ?>
                    <img width="100" src="images/<?= $row['image'] ?>">
                <?php endif ?>
            </td>
        </tr>
    <?php endwhile ?>
</table>
<a href="orders.php"><?= protect('Go to orders') ?></a>
<?php include('footer.php') ?>