<?php

include ('common.php');

if (isset($_GET['id'])) {
    if(FALSE !== ($key = array_search($_GET['id'],$_SESSION['id'])))
    {
        unset($_SESSION['id'][$key]);
        $_SESSION['id'] = array_values($_SESSION['id']);
    }
}

$stmt = $conn->query("SELECT * FROM `products` WHERE `id` IN ( '" . implode( "', '" , $_SESSION['id'] ) . "' )");
?>

<table border="1">
    <tr>
        <th>Product</th>
        <th>Add to cart</th>
    </tr>

    <?php while ($row = $stmt->fetch()) :
        $id = $row['id'];
    ?>
        <tr>
            <td>
                <?= $row['title'] ?><br />
                <?= $row['description'] ?><br />
                <?= $row['price'] ?>
            </td>
            <td align="center">
                <a href="cart.php?id=<?= $id ?>">Remove</a>
            </td>
        </tr>
    <?php endwhile ?>

</table>
<br />

<form action="" method="post">
    <input type="text" name="name" placeholder="Name" required><br />
    <input type="text" name="details" placeholder="Contact details" required><br />
    <input type="text" name="commnents" placeholder="Comments" required><br />
    <a href="index.php">Go to index</a>
    <input type='submit' name='checkout' value='Checkout'/>
</form>
