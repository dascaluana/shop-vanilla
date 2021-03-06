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
<?php include('header.php') ?>
<table border="1">
    <tr>
        <th><?= protect('Product') ?></th>
        <th><?= protect('Image') ?></th>
        <th><?= protect('Edit/Delete') ?></th>
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
                <a href="product.php?id=<?= $id ?>"><?= protect('Edit') ?></a>
                <a href="products.php?id=<?= $id ?> . '" onclick="return confirm('Are you sure?');"><?= protect('Delete') ?></a>
            </td>
        </tr>
    <?php endwhile ?>

</table>

<a href="product.php"><?= protect('Add') ?></a>
<a href="logout.php"><?= protect('Logout') ?></a>

<?php if(isset($_SESSION['msg'])) : ?>
    <div class="alert alert-danger">
        <?= $_SESSION['msg'] ?>
        <?php unset($_SESSION['msg']); ?>
    </div>
<?php endif ?>

<?php if (isset($_SESSION['id'])) : ?>
    <div class="error">
        <?= $_SESSION['id'] ?>
    </div>
    <?php unset($_SESSION['id']); ?>
<?php endif ?>

<?php include('footer.php') ?>