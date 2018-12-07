<?php

include ('common.php');

$title = $description = $price = "";

if (isset($_GET['id'])) {

    $sql = "SELECT * FROM `products` WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_GET['id']]);

    if ($row = $stmt->fetch()) {

        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
    }
}

$errors = [];

if (!empty($_POST['save'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if (empty($title)) {
        $errors['title'][] = trans('Title is required');
    }

    if (!preg_match("/^[a-zA-Z ]*[0-9]*$/", $title)) {
        $errors['title'][] = trans('Only letters, numbers and white space allowed');
    }

    if (empty($price)) {
        $errors['price'][] = trans('Price is required');
    }

    if (!is_numeric($price)) {
        $errors['price'][] = trans('Data entered was not numeric');
    }

    if (empty($description)) {
        $errors['description'][] = trans('Description is required');
    }

    if (!$errors) {

        if (isset($_GET['id'])) {

            $sql2 = "UPDATE `products` SET title = ?, description = ?, price = ? WHERE id = ?";
            $conn->prepare($sql2)->execute([$title, $description, $price, $_GET['id']]);

            $_SESSION['msg'] = trans('Data is updated!');

        } else {

            $sql2 = "INSERT INTO `products`(`title`, `description`, `price`) VALUES (?, ?, ?)";
            $conn->prepare($sql2)->execute([$title, $description, $price]);

            $_SESSION['msg'] = trans('Data inserted in DB!');
        }

        header("Location: products.php");
    }
}

?>

<form action="" method="post">
    <table>
        <tr>
            <td><?= trans('Title') ?>:</td>
            <td>
                <input type="text" name="title" value="<?= $title ?>">
                <?php if (isset($errors['title'])) : ?>
                    <?php foreach ($errors['title'] as $val) : ?>
                        <div class="error"><?= $val ?></div>
                    <?php endforeach ?>
                <?php endif ?>
            </td>
        </tr>

        <tr>
            <td><?= trans('Description') ?>:</td>
            <td>
                <textarea type="text" name="description" rows="5" cols="22"><?= $description; ?></textarea>
                <?php if (isset($errors['description'])) : ?>
                    <?php foreach ($errors['description'] as $val) : ?>
                        <div class="error"><?= $val ?></div>
                    <?php endforeach ?>
                <?php endif ?>
            </td>
        </tr>

        <tr>
            <td><?= trans('Price') ?>:</td>
            <td>
                <input type="text" name="price"  value="<?= $price ?>">
                <?php if (isset($errors['price'])) : ?>
                    <?php foreach ($errors['price'] as $val) : ?>
                        <div class="error"><?= $val ?></div>
                    <?php endforeach ?>
                <?php endif ?>
            </td>
        </tr>

        <tr>
            <td><?= trans('Image') ?>:</td>
            <td>
                <input name="text" name="image" value="" size="11">
                <input type="submit" name="browse" value="<?= trans('Browse') ?>"/>
            </td>
        </tr>

        <tr>
            <td><a href="products.php"><?= trans('Products') ?></a></td>
            <td><input type="submit" name="save" value="<?= trans('Save') ?>"/></td>
        </tr>
    </table>
</form>
