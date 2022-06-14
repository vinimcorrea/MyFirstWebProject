<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    if (!$session->isLoggedIn()) die(http_response_code(403));
    

    require_once(__DIR__ . '/../database/connection.db.php');
    
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/category.class.php');

    require_once(__DIR__ . '/../templates/forms.tpl.php');

    $db = getDatabaseConnection();

    // Insert image data into database
    $stmt = $db->prepare("INSERT INTO Image VALUES(NULL, ?)");
    $stmt->execute(array($_POST['image_title']));

    // Get image ID
    $id = $db->lastInsertId();
    $image_id = $id;

    // Create folders if they don't exist

    if (!is_dir('../images')) mkdir('../images');
    if (!is_dir('../images/banners')) mkdir('../images/banners');
    if (!is_dir('../images/banners/originals')) mkdir('../images/banners/originals');
    if (!is_dir('../images/banners/thumbs_small')) mkdir('../images/banners/thumbs_small');
    if (!is_dir('../images/banners/thumbs_medium')) mkdir('../images/banners/thumbs_medium');

    // Generate filenames for original, small and medium files
    $originalFileName = "../images/banners/originals/$id.jpg";
    $smallFileName = "../images/banners/thumbs_small/$id.jpg";
    $mediumFileName = "../images/banners/thumbs_medium/$id.jpg";

    $fileTempName = $_FILES['ctg-image']['tmp_name'];

    // Move the uploaded file to its final destination
    move_uploaded_file($fileTempName, $originalFileName);

    // Crete an image representation of the original image
    $original = imagecreatefromjpeg($originalFileName);
    if (!$original) $original = imagecreatefrompng($originalFileName);
    if (!$original) $original = imagecreatefromgif($originalFileName);

    if (!$original) die();      

    $width = imagesx($original);     // width of the original image
    $height = imagesy($original);    // height of the original image
    $square = min($width, $height);  // size length of the maximum square

    // Create and save a small square thumbnail
    $small = imagecreatetruecolor(200, 200);
    $f_to_int = ($width>$square)?($width-$square)/2:0;
    imagecopyresized($small, $original, 0, 0, (int) $f_to_int, ($height>$square)?($height-$square)/2:0, 200, 200, $square, $square);
    imagejpeg($small, $smallFileName);

    // Calculate width and height of medium sized image (max width: 400)
    $mediumwidth = $width;
    $mediumheight = $height;
    if ($mediumwidth > 400) {
        $mediumwidth = 400;
        $mediumheight = $mediumheight * ( $mediumwidth / $width );
    }

    // Create and save a medium image
    $medium = imagecreatetruecolor($mediumwidth, (int) $mediumheight);
    imagecopyresized($medium, $original, 0, 0, 0, 0, $mediumwidth, (int) $mediumheight, $width, $height);
    imagejpeg($medium, $mediumFileName);


    Category::createCategory($db, $_POST['ctg-name'], (int) $image_id);


    header('Location: ../index.php');
?>