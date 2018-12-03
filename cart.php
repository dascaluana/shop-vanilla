<?php

include ('common.php');

if (isset($_POST['index_button'])) {
    header("Location: index.php");
}

$stmt = $conn->query('SELECT * FROM products');
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
                <a href = "">Remove</a>
            </td>
        </tr>
    <?php endwhile ?>

</table>
<br />

<form action="" method="post">
    <input type="text" name="name" placeholder="Name" required><br/>
    <input type="text" name="details" placeholder="Contact details" required><br/>
    <input type="text" name="commnents" placeholder="Comments" required>
</form>
<form action='' method='post'>
    <input type='submit' name='index_button' value='Go to index'/>
    <input type='submit' name='checkout' value='Checkout'/>
</form>
