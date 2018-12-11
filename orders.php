<?php
include ('common.php');

$sql = "
SELECT * 
FROM `order` AS o 
JOIN `order_products` AS op ON o.id = op.order_id 
JOIN `products` AS p ON p.id = op.product_id";
$stmt = $conn->query($sql);
$stmt->execute();

$orders = [];

while ($row = $stmt->fetch()) {
    $orders[$row['order_id']]['info'] = [
        'id' => $row['order_id'],
        'created_at' => $row['created_at'],
        'name' => $row['name'],
        'email' => $row['email'],
        'comments' => $row['comments'],
    ];

    $orders[$row['order_id']]['products'][$row['product_id']]['info'] = [
        'id' => $row['product_id'],
        'title' => $row['title'],
        'description' => $row['description'],
        'price' => $row['price'],
        'image' => $row['image'],
    ];
}

?>
<?php include('header.php') ?>
<form action="" method="post">
    <table border="1">
        <tr>
            <th><?= protect('Date') ?></th>
            <th><?= protect('Name') ?></th>
            <th><?= protect('Email') ?></th>
            <th><?= protect('Comments') ?></th>
            <th><?= protect('Product') ?></th>
            <th><?= protect('View') ?></th>
        </tr>

        <?php foreach ($orders as $val) : ?>
            <tr>
                <td>
                    <?php if (strlen($val['info']['created_at'])) : ?>
                        <?= protect($val['info']['created_at']) ?><br />
                    <?php endif ?>
                </td>

                <td>
                    <?php if (strlen($val['info']['name'])) : ?>
                        <?= protect($val['info']['name']) ?><br />
                    <?php endif ?>
                </td>

                <td>
                    <?php if (strlen($val['info']['email'])) : ?>
                        <?= protect($val['info']['email']) ?>
                    <?php endif ?>
                </td>

                <td>
                    <?php if (strlen($val['info']['comments'])) : ?>
                        <?= protect($val['info']['comments']) ?>
                    <?php endif ?>
                </td>
                <?php
                    $product = '';
                    foreach ($val['products'] as $prod) {
                        $product .= '- ' . $prod['info']['title'] . PHP_EOL;
                    }
                ?>
                <td><?= nl2br(protect($product)) ?></td>
                <td align="center">
                    <a href="order.php?id=<?= protect($val['info']['id']) ?>"><?= protect('View') ?></a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</form>
<?php include('footer.php') ?>