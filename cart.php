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

    if ($_POST['details'] == "" || $_POST['name'] == "" || $_POST['message'] == "") {
        $_SESSION['msg'] = protect('Fill All Fields..');
    } else {
        $email = $_POST['details'];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if (!$email) {
            $_SESSION['msg'] = protect("Invalid Sender's Email");
        } else {
            $admin_email = EMAIL_ADMIN;
            $subject = $_POST['name'];
            $message = $_POST['message'];
            $message = wordwrap($message, 70);

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: '.$email."\r\n";

            if ($_SESSION['id']) {

                $prodId = [];

                $table = '<table border="1">';
                $table .= '<tr><th>' . protect('Image') . '</th><th>' . protect('Title') . '</th><th>' . protect('Description') . '</th><th>' . protect('Price') . '</th></tr>';

                while (($row = $stmt->fetch()) !== false) {

                    $table .= '<tr><td>';
                    $table .= protect($row['image']);
                    $table .= '</td><td>';
                    $table .= protect($row['title']);
                    $table .= '</td><td>';
                    $table .= protect($row['description']);
                    $table .= '</td><td>';
                    $table .= protect($row['price']);
                    $table .= '</td></tr>';

                    array_push($prodId, $row['id']);

                    unset($_SESSION['id'][0]);
                    $_SESSION['id'] = array_values($_SESSION['id']);
                }

                $table .= '</table>';
            }

            $msg = protect('Message') . ":\n" . $message . "\n" . $table;

            mail($admin_email, $subject, $msg, $headers);

            $date = date('Y-m-d H:i:s');

            $sql = "INSERT INTO `order`(`created_at`, `name`, `email`, `comments`) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$date, $subject, $email, $message]);

            $last_id = $conn->lastInsertId();
            $id = $last_id;

            foreach ($prodId as $val) {
                $sql = "INSERT INTO `order_products`(`order_id`, `product_id`) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$id, $val]);
            }

            $_SESSION['msg'] = protect('Your mail has been sent successfuly!');
        }
    }

    header("Location: cart.php");
}

?>
<?php include('header.php') ?>
<table border="1">
    <tr>
        <th><?= protect('Product') ?></th>
        <th><?= protect('Image') ?></th>
        <th><?= protect('Remove') ?></th>
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
                <a href="cart.php?id=<?= $id ?>"><?= protect('Remove') ?></a>
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
            <td><?= protect('Name') ?>:</td>
            <td><input type="text" name="name" value=""></td>
        </tr>

        <tr>
            <td><?= protect('Email') ?>:</td>
            <td><input type="text" name="details" value=""></td>
        </tr>

        <tr>
            <td><?= protect('Comments') ?>:</td>
            <td><textarea name="message" rows="5" cols="22"></textarea></td>
        </tr>

        <tr>
            <td><a href="index.php"><?= protect('Go to index') ?></a></td>
            <td><input type="submit" name="submit" value="<?= protect('Checkout') ?>"/></td>
        </tr>
    </table>

</form>
<?php include('footer.php') ?>