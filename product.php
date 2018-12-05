<?php

include ('common.php');

if (! empty($_POST)) {

    $sql2 = "UPDATE `products` SET title = ? WHERE id = ?";
    $conn->prepare($sql2)->execute(['title', $_GET['id']]);
}

?>

<form action="" method="post">
    <input type="text" name="title" placeholder="Title" value=""><br />
    <input type="text" name="description" placeholder="Description" value=""><br />
    <input name="text" name="price" placeholder="Price" value=""><br />
    <input name="text" name="image" placeholder="Image" value="" size="11">
    <input type='submit' name='submit' value='Browse'/><br />
    <a href="products.php">Products</a>
    <input type='submit' name='save' value='Save'/>
</form>
