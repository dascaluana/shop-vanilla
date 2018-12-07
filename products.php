<?php

include ('common.php');

if (!isset($_SESSION['loggedIn'])) {
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
        <th><?= trans('Product') ?></th>
        <th><?= trans('Add to cart') ?></th>
    </tr>

    <?php while ($row = $stmt->fetch()) :
        $id = $row['id'];
    ?>
        <tr>
            <td>
                <b><?= trans('Title') ?>: </b><?= $row['title'] ?><br />
                <b><?= trans('Description') ?>: </b><?= $row['description'] ?><br />
                <b><?= trans('Price') ?>: </b><?= $row['price'] ?>
            </td>
            <td align="center">
                <a href="product.php?id=<?= $id ?>"><?= trans('Edit') ?></a>
                <a href="products.php?id=<?= $id ?> . '" onclick="return confirm('Are you sure?');"><?= trans('Delete') ?></a>
            </td>
        </tr>
    <?php endwhile ?>

</table>

<a href="product.php"><?= trans('Add') ?></a>
<a href="logout.php"><?= trans('Logout') ?></a>

<?php if(isset($_SESSION['msg'])) : ?>
    <div class="alert alert-danger">
        <?= $_SESSION['msg'] ?>
        <?php unset($_SESSION['msg']); ?>
    </div>
<?php endif ?>