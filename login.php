<?php

include ('common.php');

if (! empty($_POST)) {

    if ($_POST['username'] == $usernameAdmin && $_POST['password'] == $passwordAdmin) {

        $_SESSION["loggedIn"] = true;
        header("Location: products.php");

    } else {

        $_SESSION['msg'] = "Invalid username and password";
    }

}
?>

<form action="" method="post">
    <?php if(isset($_SESSION['msg'])) : ?>
        <div class="alert alert-danger">
            <?= $_SESSION['msg'] ?>
            <?php unset($_SESSION['msg']) ?>
        </div>
    <?php endif ?>
    <input type="text" name="username" placeholder="Username" required><br />
    <input type="password" name="password" placeholder="Password" required><br />
    <input type="submit" value="Log in">
</form>
