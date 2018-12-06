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
        $errors['title'][] = "Title is required";
    }

    if (!preg_match("/^[a-zA-Z ]*[0-9]*$/", $title)) {
        $errors['title'][] = "Only letters, numbers and white space allowed";
    }

    if (empty($price)) {
        $errors['price'][] = "Price is required";
    }

    if (!is_numeric($price)) {
        $errors['price'][] = "Data entered was not numeric";
    }

    if (empty($description)) {
        $errors['description'][] = "Description is required";
    }

    if (!$errors) {

        if (isset($_GET['id'])) {

            $sql2 = "UPDATE `products` SET title = ?, description = ?, price = ? WHERE id = ?";
            $conn->prepare($sql2)->execute([$title, $description, $price, $_GET['id']]);

            $_SESSION['msg'] = "Data is updated!";

        } else {

            $sql2 = "INSERT INTO `products`(`title`, `description`, `price`) VALUES (?, ?, ?)";
            $conn->prepare($sql2)->execute([$title, $description, $price]);

            $_SESSION['msg'] = "Data iserted in DB!";
        }

        header("Location: products.php");
    }
}

?>

<form action="" method="post">
    <table>
        <tr>
            <td>Title:</td>
            <td>
                <input type="text" name="title" placeholder="Title" value="<?= $title ?>">
                <?php if (isset($errors['title'])) : ?>
                    <?php foreach ($errors['title'] as $val) : ?>
                        <div class="error"><?= $val ?></div>
                    <?php endforeach ?>
                <?php endif ?>
            </td>
        </tr>

        <tr>
            <td>Description:</td>
            <td>
                <textarea type="text" name="description" rows="5" cols="22" placeholder="Description"><?= $description; ?></textarea>
                <?php if (isset($errors['description'])) : ?>
                    <?php foreach ($errors['description'] as $val) : ?>
                        <div class="error"><?= $val ?></div>
                    <?php endforeach ?>
                <?php endif ?>
            </td>
        </tr>

        <tr>
            <td>Price:</td>
            <td>
                <input type="text" name="price" placeholder="Price" value="<?= $price ?>">
                <?php if (isset($errors['price'])) : ?>
                    <?php foreach ($errors['price'] as $val) : ?>
                        <div class="error"><?= $val ?></div>
                    <?php endforeach ?>
                <?php endif ?>
            </td>
        </tr>

        <tr>
            <td>Image:</td>
            <td>
                <input name="text" name="image" placeholder="Image" value="" size="11">
                <input type='submit' name='browse' value='Browse'/>
            </td>
        </tr>

        <tr>
            <td><a href="products.php">Products</a></td>
            <td><input type='submit' name='save' value='Save'/></td>
        </tr>
    </table>
</form>
