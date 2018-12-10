<?php

include ('common.php');

$title = $description = $price = "";

$errors = [];

$ok = 0;

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

if (!empty($_POST['submit'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if (empty($title)) {
        $errors['title'][] = protect('Title is required');
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

        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (isset($_POST['submit']) && !empty($_FILES["fileToUpload"]["name"])) {

            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

            if ($check === false) {
                $errors['upload'][] = trans('File is not an image.');
            }
        }

        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $errors['upload'][] = trans('Error, your file is too large.');
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $errors['upload'][] = trans('Error, only jpg, jpeg and png files are allowed.');
        }


        if (!$errors) {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $_SESSION['msg'] = trans('Data is updated!');

            } else {
                $sql2 = "INSERT INTO `products`(`title`, `description`, `price`) VALUES ('', '', '')";

                $conn->exec($sql2);
                $last_id = $conn->lastInsertId();
                $id = $last_id;

                $_SESSION['msg'] = trans('Data inserted in DB!');
            }

            $sql2 = "UPDATE `products` SET title = ?, description = ?, price = ?, image = ? WHERE id = ?";
            $fileToUpload = $target_file;
            $file = $id . '.' . $imageFileType;
            $target_file = $target_dir . $file;

            if (!move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
                $errors['upload'][] = trans('File wasn\'t uploaded');
            }

            if (!$errors) {
                $conn->prepare($sql2)->execute([stripTags($title), $description, stripTags($price), $file, stripTags($id)]);
                header("Location: products.php");
            }
        }
    }
}

?>
<?php include('header.php') ?>

<form action="" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td><?= protect('Title') ?>:</td>
            <td>
                <input type="text" name="title" value="<?= protect($title) ?>">
                <?php if (isset($errors['title'])) : ?>
                    <?php foreach ($errors['title'] as $val) : ?>
                        <div class="error"><?= protect($val) ?></div>
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
                        <div class="error"><?= protect($val) ?></div>
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
                        <div class="error"><?= protect($val) ?></div>
                    <?php endforeach ?>
                <?php endif ?>
            </td>
        </tr>

        <tr>
            <td><?= protect('Image') ?>:</td>
            <td>
                <?php if (isset($_GET['id'])) : ?>
                    <img src="images/<?= $image ?>">
                <?php endif ?>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <?php if (isset($errors['upload'])) : ?>
                    <?php foreach ($errors['upload'] as $val) : ?>
                        <div class="error"><?= protect($val) ?></div>
                    <?php endforeach ?>
                <?php endif ?>
            </td>
        </tr>

        <tr>
            <td><a href="products.php"><?= protect('Products') ?></a></td>
            <td><input type="submit" name="submit" value="<?= protect('Save') ?>"/></td>
        </tr>
    </table>
</form>
<?php include('footer.php') ?>