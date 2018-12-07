<?php

include ('common.php');

if (isset($_GET['id'])) {
    if(FALSE !== ($key = array_search($_GET['id'],$_SESSION['id'])))
    {
        unset($_SESSION['id'][$key]);
        $_SESSION['id'] = array_values($_SESSION['id']);
    }
    header("Location: cart.php");
}

$arr = $_SESSION['id'] ?: [0];
$in = str_repeat('?,', count($arr) - 1) . '?';
$sql = "SELECT * FROM `products` WHERE `id` IN ($in)";
$stmt = $conn->prepare($sql);
$stmt->execute($arr);

$msg = "";
$data = [];

if (isset($_POST['submit']))  {

    if ($_POST["details"] == "" || $_POST["name"] == "" || $_POST["message"] == "") {
        $_SESSION['msg'] = trans('Fill All Fields..');
    } else {
        $email = $_POST['details'];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if (!$email) {
            $_SESSION['msg'] = trans("Invalid Sender's Email");
        } else {
            $admin_email = EMAIL_ADMIN;
            $subject = $_POST['name'];
            $message = $_POST['message'];
            $message = wordwrap($message, 70);

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: '.$email."\r\n";

            if ($_SESSION['id']) {

                $table = '<table border="1">';
                $table .= '<tr><th>' . trans('Title') . '</th><th>' . trans('Title') . '</th><th>' . trans('Price') . '</th></tr>';

                while (($row = $stmt->fetch()) !== false) {

                    $table .= '<tr><td>';
                    $table .= $row['title'];
                    $table .= '</td>';
                    $table .= '<td>';
                    $table .= $row['description'];
                    $table .= '</td>';
                    $table .= '<td>';
                    $table .= $row['price'];
                    $table .= '</td></tr>';

                    unset($_SESSION['id'][0]);
                    $_SESSION['id'] = array_values($_SESSION['id']);
                }

                $table .= '</table>';

            }

            $message = trans('Message') . ":\n" . $message . "\n" . $table;

            mail($admin_email, $subject, $message, $headers);
            $_SESSION['msg'] = trans('Your mail has been sent successfuly!');
        }
    }

    header("Location: cart.php");
}

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
                <a href="cart.php?id=<?= $id ?>"><?= trans('Remove') ?></a>
            </td>
        </tr>
    <?php endwhile ?>

</table>
<br />

<form action="" method="post">
    <?php if (isset($_SESSION['msg'])) : ?>
        <div class="alert alert-danger">
            <?= $_SESSION['msg'] ?>
            <?php unset($_SESSION['msg']); ?>
        </div>
    <?php endif ?>

    <table>
        <tr>
            <td><?= trans('Name') ?>:</td>
            <td><input type="text" name="name" value=""></td>
        </tr>

        <tr>
            <td><?= trans('Email') ?>:</td>
            <td><input type="text" name="details" value=""></td>
        </tr>

        <tr>
            <td><?= trans('Comments') ?>:</td>
            <td><textarea name="message" rows="5" cols="22"></textarea></td>
        </tr>

        <tr>
            <td><a href="index.php"><?= trans('Go to index') ?></a></td>
            <td><input type="submit" name="submit" value="<?= trans('Checkout') ?>"/></td>
        </tr>
    </table>

</form>