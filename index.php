<?php

include ('common.php');

if (isset($_POST['index_button'])) {
    header("Location: cart.php");
}
print_r($_REQUEST["name"]);
$stmt = $conn->query('SELECT * FROM `products`');


?>

<table border="1">
    <tr>
        <th>Product</th>
        <th>Add to cart</th>
    </tr>

    <?php while ($row = $stmt->fetch()) : ?>
        <tr>
            <td>
                <?= $row['title'] ?><br />
                <?= $row['description'] ?><br />
                <?= $row['price'] ?>
            </td>
            <td align="center">
                <a href = "">Add</a>
            </td>
        </tr>
    <?php endwhile ?>

</table>
