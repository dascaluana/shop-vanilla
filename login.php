<?php

if (! empty($_POST)) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $_SESSION["username"] = $_POST['username'];
        $_SESSION["password"] = $_POST['password'];
        $_SESSION["loggedin"] = true;
        header("Location: cart.php");
    }
}
?>

<form action="" method="post">
    <input type="text" name="username" placeholder="Username" required><br />
    <input type="password" name="password" placeholder="Password" required><br />
    <input type="submit" value="Log in">
</form>
