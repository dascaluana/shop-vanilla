<?php

include ('common.php');

if (!empty($_POST)) {

    if ($_POST['username'] == USER_ADMIN && $_POST['password'] == PASSWORD_ADMIN) {

        $_SESSION["loggedIn"] = true;
        header("Location: products.php");

    } else {

        $_SESSION['msg'] = protect("Invalid username or password");
    }

}
?>
<?php include('header.php') ?>
<form action="" method="post">
    <?php if(isset($_SESSION['msg'])) : ?>
        <div class="alert alert-danger">
            <?= $_SESSION['msg'] ?>
            <?php unset($_SESSION['msg']) ?>
        </div>
    <?php endif ?>
    <input type="text" name="username" placeholder="<?= protect('Username') ?>"><br />
    <input type="password" name="password" placeholder="<?= protect('Password') ?>"><br />
    <input type="submit" value="<?= protect('Log in') ?>">
</form>
<?php include('footer.php') ?>