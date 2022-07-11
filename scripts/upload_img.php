<?php

$game_pin = $_POST["game_PIN"];
$target_dir = "../media/uploads/$game_pin";

if (!is_dir($target_dir)){
    mkdir($target_dir);
}

if (isset($_FILES['file']['name'])) {

    /* Getting file name */
    $filename = $_FILES['file']['name'];

    /* Location */
    $location = $target_dir . "/" . $filename;
    $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
    $imageFileType = strtolower($imageFileType);

    /* Valid extensions */
    $valid_extensions = array("jpg", "jpeg", "png");

    $response = 0;

    /* Check file extension */
    if (in_array(strtolower($imageFileType), $valid_extensions)) {
        /* Upload file */
        if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
            $response = "./media/uploads/$game_pin/$filename";
        }
    }

    echo $response;
    exit;
}

echo 0;


//
//$game_pin = $_POST["game_PIN"];
//
//
//
//$target_dir = "../media/uploads/pages";
//
//if (!is_dir($target_dir)){
//    mkdir($target_dir);
//}
//
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//$uploadOk = 1;
//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//
//// Check if image file is a actual image or fake image
//if(isset($_POST["submit"])) {
//    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//    if($check !== false) {
//        echo "File is an image - " . $check["mime"] . ".";
//        $uploadOk = 1;
//    } else {
//        echo "File is not an image.";
//        $uploadOk = 0;
//    }
//}
