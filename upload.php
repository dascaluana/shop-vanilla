<?php

function uploadImg ()
{
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (isset($_POST['submit'])) {

        $check  = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

        if ($check !== false) {
            $_SESSION['img'] = "FIle is an image- " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $_SESSION['img'] = "File is not an image.";
            $uploadOk = 0;
        }
    }

    if (file_exists($target_file)) {
        $_SESSION['img'] = "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $_SESSION['img'] = "sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $_SESSION['img'] = "sorry, only jpg, jpeg and png files are allowed.";
        $uploadOk = 0;
    }

    return $uploadOk;
}

?>



