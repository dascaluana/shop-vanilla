<?php

include ('common.php');

if(!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
}

if (isset($_GET['id'])) {

    $stmt = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $deleted = $stmt->rowCount();

    header("Location: products.php");
}

$sql = "SELECT * FROM `products`";
$stmt = $conn->query($sql);
$stmt->execute();

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
                <a href="product.php?id=<?= $id ?>">Edit</a>
                <a href="products.php?id=<?= $id ?> . '" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
    <?php endwhile ?>

</table>

<a href="product.php">Add</a>
<a href="logout.php">Logout</a>