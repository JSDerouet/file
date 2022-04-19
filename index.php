<?php
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $uploadDir = 'public/uploads/';

    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);

    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);

    $authorizedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

    $maxFileSize = 1000000;

    if ((!in_array($extension, $authorizedExtensions))) {

        $errors[] = 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png ou Webp!';
    }

    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {

        $errors[] = "Votre fichier doit faire moins de 1M !";
    }

    if (empty($errors)) {
        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    foreach ($errors as $error) : ?>
        <li><?= $error ?></li>
    <?php endforeach; ?>
    <form method="post" enctype="multipart/form-data">

        <label for="imageUpload">Upload an profile image</label>

        <input type="file" name="avatar" id="imageUpload" />

        <button name="send">Send</button>

    </form>
    <?php if (file_exists('public/uploads/' . $fileName)) : ?>
        <img src=public/uploads/<?= $fileName ?>>
    <?php endif ?>
</body>

</html>