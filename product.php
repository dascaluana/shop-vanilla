<?php

include ('common.php');
include ('upload.php');

$title = $description = $price = "";

$errors = [];

if (isset($_GET['id'])) {

    $sql = "SELECT * FROM `products` WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_GET['id']]);

    $row = $stmt->fetch();

    if ($_GET['id'] == $row['id']) {
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $image = $row['image'];
    } else {
        $_SESSION['id'] = protect("ID is not found in DB.");
        header("Location: products.php");
    }
}

if (!empty($_POST['save'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    if (empty($title)) {
        $errors['title'][] = protect('Title is required');
    }

    if (!preg_match("/^[a-zA-Z ]*[0-9]*$/", $title)) {
        $errors['title'][] = protect('Only letters, numbers and white space allowed');
    }

    if (empty($price)) {
        $errors['price'][] = protect('Price is required');
    }

    if (!is_numeric($price)) {
        $errors['price'][] = protect('Data entered was not numeric');
    }

    if (empty($description)) {
        $errors['description'][] = protect('Description is required');
    }

    if (!$errors) {

        if (isset($_GET['id'])) {

            //$uploadOk = uploadImg();

           // if ($uploadOk == 0) {
                //$errors['img'][] = "Sorry your file was not uploaded";
           // } else {

            $sql2 = "UPDATE `products` SET title = ?, description = ?, price = ? WHERE id = ?";
            $conn->prepare($sql2)->execute([stripTags($title), $description, stripTags($price), stripTags($_GET['id'])]);

            $_SESSION['msg'] = protect('Data is updated!');

           // }



        } else {

            $sql2 = "INSERT INTO `products`(`title`, `description`, `price`) VALUES (?, ?, ?)";
            $conn->prepare($sql2)->execute([stripTags($title), $description, stripTags($price)]);

            $_SESSION['msg'] = protect('Data inserted in DB!');
        }

        header("Location: products.php");
    }
}

?>
<?php include('header.php') ?>

<form action="" method="post">
    <table>
        <tr>
            <td><?= protect('Title') ?>:</td>
            <td>
                <input type="text" name="title" value="<?= protect($title) ?>">
                <?php if (isset($errors['title'])) : ?>
                    <?php foreach ($errors['title'] as $val) : ?>
                        <div class="error"><?= $val ?></div>
                    <?php endforeach ?>
                <?php endif ?>
            </td>
        </tr>

        <tr>
            <td><?= protect('Description') ?>:</td>
            <td>
                <textarea type="text" name="description" rows="5" cols="22"><?= protect($description); ?></textarea>
                <?php if (isset($errors['description'])) : ?>
                    <?php foreach ($errors['description'] as $val) : ?>
                        <div class="error"><?= $val ?></div>
                    <?php endforeach ?>
                <?php endif ?>
            </td>
        </tr>

        <tr>
            <td><?= protect('Price') ?>:</td>
            <td>
                <input type="text" name="price"  value="<?= protect($price) ?>">
                <?php if (isset($errors['price'])) : ?>
                    <?php foreach ($errors['price'] as $val) : ?>
                        <div class="error"><?= $val ?></div>
                    <?php endforeach ?>
                <?php endif ?>
            </td>
        </tr>

        <tr>
            <td><?= protect('Image') ?>:</td>
            <td>
                <input name="text" name="image" value="" size="11">
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </form>
            </td>
        </tr>

        <tr>
            <td><a href="products.php"><?= protect('Products') ?></a></td>
            <td><input type="submit" name="save" value="<?= protect('Save') ?>"/></td>
        </tr>
    </table>
</form>
<?php if (isset($_SESSION['img'])) : ?>
    <div class="error"><?= $_SESSION['img'] ?></div>
    <?php unset($_SESSION['id']); ?>
<?php endif ?>

<?php include('footer.php') ?>