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
        $_SESSION['msg'] = "Fill All Fields..";
    } else {
        $email = $_POST['details'];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if (!$email) {
            $_SESSION['msg'] = "Invalid Sender's Email";
        } else {
            $admin_email = $adminEmail;
            $subject = $_POST['name'];
            $message = $_POST['message'];
            $message = wordwrap($message, 70);

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: '.$email."\r\n";

            if($_SESSION['id']){

                $table = '<table border="1">';
                $table .= '<tr><th>Title</th><th>Description</th><th>Price</th></tr>';

                while(($row = $stmt->fetch()) !== false){

                    $table .= '<tr><td>';
                    $table .= $row['title'];
                    $table .= '</td>';
                    $table .= '<td>';
                    $table .= $row['description'];
                    $table .= '</td>';
                    $table .= '<td>';
                    $table .= $row['price'];
                    $table .= '</td></tr>';

                    //array_push($data, $row['title'], $row['description'], $row['price']);

                    unset($_SESSION['id'][0]);
                    $_SESSION['id'] = array_values($_SESSION['id']);
                }

                $table .= '</table>';

            }

            $message = "Message:\n" . $message . "\n" . $table;

            mail($admin_email, $subject, $message, $headers);
            $_SESSION['msg'] = "Your mail has been sent successfuly!";
        }
    }

    header("Location: cart.php");
}

?>

<table border="1">
    <tr>
        <th>Product</th>
        <th>Add to cart</th>
    </tr>

    <?php while ($row = $stmt->fetch()) :
        $id = $row['id'];
    ?>
        <tr>
            <td>
                <?= $row['title'] ?><br />
                <?= $row['description'] ?><br />
                <?= $row['price'] ?>
            </td>
            <td align="center">
                <a href="cart.php?id=<?= $id ?>">Remove</a>
            </td>
        </tr>
    <?php endwhile ?>

</table>
<br />

<form action="" method="post">
    <?php if(isset($_SESSION['msg'])) :
        ?>
        <div class="alert alert-danger">
            <?= $_SESSION['msg'] ?>
            <?php unset($_SESSION['msg']); ?>
        </div>
    <?php endif ?>
    <input type="text" name="name" placeholder="Name" value=""><br />
    <input type="text" name="details" placeholder="E-mail" value=""><br />
    <textarea name="message" rows="5" cols="22" placeholder="Comments"></textarea><br />
    <a href="index.php">Go to index</a>
    <input type='submit' name='submit' value='Checkout'/>
</form>

